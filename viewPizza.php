<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title id=title>Pizza</title>
    <link rel = "icon" href ="img/pizza-69.jpg" type = "image/x-icon">
    <style>
    #cont {
        min-height : 578px;
    }

    .description-section {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
    }
    .description-table {
            width: 40%;
    }
    .description-text {
            width: 55%;
    }
    .product-image {
            max-width: 100%;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 10px;
    }

    .product-image-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>
    <div class="container my-5">
        <!-- Product Details Section -->
        <div class="row">
            <?php
            $pizzaId = $_GET['pizzaId'];
            $sql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $pizzaName = $row['pizzaName'];
            $pizzaPrice = $row['pizzaPrice'];
            $pizzaDesc = $row['pizzaDesc'];
            ?>
            <script>
                document.getElementById("title").innerHTML = "<?php echo $pizzaName; ?>";
            </script>

            <!-- Left Section: Image -->
            <div class="col-md-6">
                <div class="product-image-wrapper">
                    <img src="img/produs-<?php echo $pizzaId; ?>.jpg" class="product-image" alt="<?php echo $pizzaName; ?>" width="450" height="450">
                </div>
            </div>

            <!-- Right Section: Details -->
            <div class="col-md-6">
                <h1 class="display-4"><?php echo $pizzaName; ?></h1>
                <p class="text-success font-weight-bold"><?php echo $pizzaPrice; ?> RON / KG</p>

                <?php if ($loggedin) { ?>
                    <form action="partials/_manageCart.php" method="POST">
                        <input type="hidden" name="itemId" value="<?php echo $pizzaId; ?>">
                        <button type="submit" name="addToCart" class="btn btn-primary btn-lg">Adaugă în coș</button>
                    </form>
                <?php } else { ?>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal">Adaugă în coș</button>
                <?php } ?>
            </div>
        </div>

        <!-- Product Description Section -->
        <div class="description-section my-5">
            <!-- Left Side: Table -->
            <div class="description-table">
                <h3 class="mb-3">Detalii produs</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Calibru</th>
                        <td>1kg per bucată</td>
                    </tr>
                </table>
            </div>
            <!-- Right Side: Description -->
            <div class="description-text">
                <h3 class="mb-3">Descriere produs</h3>
                <p>
                    <?php echo $pizzaDesc; ?>
                </p>
            </div>
        </div>
    </div>

    <?php require 'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>