<?php
include '_dbconnect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    if(isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];
        // Check whether this item exists
        $existSql = "SELECT * FROM `viewcart` WHERE pizzaId = '$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Produs adăugat deja în coș.');
                    window.history.back(1);
                    </script>";
        }
        else{
            $sql = "INSERT INTO `viewcart` (`pizzaId`, `itemQuantity`, `userId`, `addedDate`) VALUES ('$itemId', '1', '$userId', current_timestamp())";   
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>
                    window.history.back(1);
                    </script>";
            }
        }
    }
    if(isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `viewcart` WHERE `pizzaId`='$itemId' AND `userId`='$userId'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>
                window.history.back(1);
            </script>";
    }
    if(isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>
                window.history.back(1);
            </script>";
    }

    if (isset($_POST['checkout'])) {
        // Preluăm informațiile de livrare
        $city = $_POST["city"];
        $street = $_POST["street"];
        $number = $_POST["number"];
        $block = $_POST["block"];
        $apartment = $_POST["apartment"];
        $phone = $_POST["phone"];
        $zipcode = $_POST["zipcode"];
        $notes = $_POST["notes"];
        $totalPrice = $_POST["amount"];
    
        // Concatenează adresa completă
        $address = $city . ", " . $street . " nr. " . $number . ", bloc " . $block . ", ap. " . $apartment;
    
        // Verificăm dacă există un utilizator conectat
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
    
            // Salvează comanda în baza de date
            $sql = "INSERT INTO `orders` (`userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) 
                    VALUES ('$userId', '$address', '$zipcode', '$phone', '$totalPrice', 'Stripe', 'Procesată', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $orderId = $conn->insert_id;
    
            if ($result) {
                // Adăugăm articolele comenzii în tabelul `orderitems`
                $addSql = "SELECT * FROM `viewcart` WHERE userId='$userId'";
                $addResult = mysqli_query($conn, $addSql);
                while ($addrow = mysqli_fetch_assoc($addResult)) {
                    $pizzaId = $addrow['pizzaId'];
                    $itemQuantity = $addrow['itemQuantity'];
                    $itemSql = "INSERT INTO `orderitems` (`orderId`, `pizzaId`, `itemQuantity`) VALUES ('$orderId', '$pizzaId', '$itemQuantity')";
                    mysqli_query($conn, $itemSql);
                }
    
                // Ștergem articolele din coșul de cumpărături
                $deletesql = "DELETE FROM `viewcart` WHERE `userId`='$userId'";
                if (mysqli_query($conn, $deletesql)) {
                    if (mysqli_affected_rows($conn) > 0) {
                        echo "Articolele au fost șterse din coș.";
                    } else {
                        echo "Coșul este deja gol.";
                    }
                } else {
                    echo "Eroare la ștergerea articolelor din coș: " . mysqli_error($conn);
                }
    
                // Redirecționăm utilizatorul către pagina de confirmare
                echo '<script>alert("Mulțumim pentru comandă. ID-ul comenzii tale este ' . $orderId . '.");
                    window.location.href="http://localhost/tavernarsr.ro/index.php";
                    </script>';
                exit();
            } else {
                echo "Eroare la salvarea comenzii: " . mysqli_error($conn);
            }
        } else {
            echo "Utilizatorul nu este autentificat.";
        }
    } else {
        echo "Datele de checkout nu au fost trimise.";
    }
    
    
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $pizzaId = $_POST['pizzaId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `viewcart` SET `itemQuantity`='$qty' WHERE `pizzaId`='$pizzaId' AND `userId`='$userId'";
        $updateresult = mysqli_query($conn, $updatesql);
    }
}
?>