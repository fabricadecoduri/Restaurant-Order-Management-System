<?php
include '_dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['checkout'])) {
        // Preluăm informațiile de livrare
        $city = $_POST["city"];
        $street = $_POST["street"];
        $number = $_POST["number"];
        $block = $_POST["block"];
        $apartment = $_POST["apartment"];
        $phone = $_POST["phone"];
        $notes = $_POST["notes"];
        $totalPrice = $_POST["amount"];

        // Concatenează adresa completă
        $address = $city . ", " . $street . " nr. " . $number . ", bloc " . $block . ", ap. " . $apartment;

        // Verificăm dacă există un utilizator conectat
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];

            // Salvează comanda în baza de date
            $sql = "INSERT INTO `orders` (`userId`, `address`, `phoneNo`, `amount`, `orderStatus`, `orderDate`) 
                    VALUES ('$userId', '$address', '$phone', '$totalPrice', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $orderId = $conn->insert_id;

            if ($result) {
                // Creăm sesiunea Stripe pentru procesarea plății
                $_SESSION['orderId'] = $orderId; // Stocăm ID-ul comenzii pentru a-l folosi după plata cu succes

                // Redirecționăm utilizatorul către pagina de checkout pentru a procesa plata
                header('Location: checkout.php');
                exit();
            }
        } else {
            echo "Utilizatorul nu este autentificat.";
        }
    }
}
?>