<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createItem'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $categoryId = $_POST["categoryId"];
        $price = $_POST["price"];

        $sql = "INSERT INTO `pizza` (`pizzaName`, `pizzaPrice`, `pizzaDesc`, `pizzaCategorieId`, `pizzaPubDate`) VALUES ('$name', '$price', '$description', '$categoryId', current_timestamp())";   
        $result = mysqli_query($conn, $sql);
        $pizzaId = $conn->insert_id;
        if ($result){
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newName = 'produs-'.$pizzaId;
                $newfilename=$newName .".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/tavernarsr.ro/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>
                        window.location=document.referrer;
                    </script>';
            }
        }
        else {
            echo "<script>
                    window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['removeItem'])) {
        $pizzaId = $_POST["pizzaId"];
        $sql = "DELETE FROM `pizza` WHERE `pizzaId`='$pizzaId'";   
        $result = mysqli_query($conn, $sql);
        $filename = $_SERVER['DOCUMENT_ROOT']."/tavernarsr.ro/img/produs-".$pizzaId.".jpg";
        if ($result){
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>
            window.location=document.referrer;
            </script>";
        }
    }
    if(isset($_POST['updateItem'])) {
        $pizzaId = $_POST["pizzaId"];
        $pizzaName = $_POST["name"];
        $pizzaDesc = $_POST["desc"];
        $pizzaPrice = $_POST["price"];
        $pizzaCategorieId = $_POST["catId"];

        $sql = "UPDATE `pizza` SET `pizzaName`='$pizzaName', `pizzaPrice`='$pizzaPrice', `pizzaDesc`='$pizzaDesc', `pizzaCategorieId`='$pizzaCategorieId' WHERE `pizzaId`='$pizzaId'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateItemPhoto'])) {
        $pizzaId = $_POST["pizzaId"];
        $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'produs-'.$pizzaId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/tavernarsr.ro/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
                echo "<script>
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>
            window.location=document.referrer;
                </script>';
        }
    }
}
?>