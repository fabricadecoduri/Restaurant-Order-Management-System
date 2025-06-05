<?php
require 'vendor/autoload.php';
include 'partials/_dbconnect.php';

\Stripe\Stripe::setApiKey('SECRET_KEY'); // Înlocuiește cu cheia ta secretă Stripe
// Verifică dacă sesiunea de plată a fost creată

if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    try {
        // Recuperați sesiunea de plată
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        if ($session->payment_status === 'paid') {
            $userId = $session->metadata->userId;
            $address = $session->metadata->address;
            $phone = $session->metadata->phone;
            $notes = $session->metadata->notes;

            // Calculează suma totală (în RON, din cenți)
            $totalAmount = $session->amount_total / 100;

            // Adăugați comanda în baza de date
            $sql = "INSERT INTO `orders` (`userId`, `address`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) 
                    VALUES ('$userId', '$address', '$phone', '$totalAmount', 'Stripe', 'Procesată', current_timestamp())";
            mysqli_query($conn, $sql);

            // Obțineți ID-ul comenzii inserate
            $orderId = mysqli_insert_id($conn);

            // Recuperați articolele comenzii
            $line_items = \Stripe\Checkout\Session::allLineItems($session_id, ['limit' => 100]);

            // Adăugați articolele comenzii în tabelul `orderitems`
            foreach ($line_items->data as $item) {
                $pizzaId = $item->price->product; // Presupunând că `pizzaId` este stocat ca `product` în Stripe
                $itemQuantity = $item->quantity;

                $sql = "INSERT INTO `orderitems` (`orderId`, `pizzaId`, `itemQuantity`) 
                        VALUES ('$orderId', '$pizzaId', '$itemQuantity')";
                mysqli_query($conn, $sql);
            }

            // Ștergeți articolele din coșul de cumpărături
            $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
            mysqli_query($conn, $deletesql);

            echo 'Comanda a fost procesată cu succes!';
        } else {
            echo 'Plata nu a fost finalizată.';
        }
    } catch (Exception $e) {
        echo 'Eroare: ' . $e->getMessage();
    }
} else {
    echo 'Nu s-a găsit sesiunea de plată.';
}
?>