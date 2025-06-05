<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
    <title>Cart</title>
    <link rel = "icon" href ="img/pizza-69.jpg" type = "image/x-icon">
    <style>
    #cont{
        min-height : 626px;
    }
.wishlist-item {
    position: relative;
}

.remove-button {
    position: absolute;
    top: 5px;  /* Distanta de sus */
    right: 5px; /* Distanta de dreapta */
}

.remove-button button {
    background-color: transparent; /* Fără fundal */
    border: none; /* Fără bordură */
    color: #dc3545; /* Culoarea iconiței (roșu) */
    padding: 8px; /* Mărimea pătratului */
    width: 32px; /* Lățimea pătratului */
    height: 32px; /* Înălțimea pătratului */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px; /* Colțuri rotunjite, dar pătrățoase */
    transition: background-color 0.3s, color 0.3s; /* Tranziție lină */
}

.remove-button button:hover {
    background-color: rgba(220, 53, 69, 0.1); /* Fundal ușor roșu la hover */
    color: #dc3545; /* Iconița rămâne roșie */
}

.remove-button button:focus {
    outline: none; /* Elimină conturul când butonul este focusat */
}

.remove-button i {
    font-size: 1.5rem; /* Dimensiunea iconiței */
    transition: color 0.3s ease; /* Tranziție lină pentru culoare */
}

.item-image {
    margin-right: 20px;
}

    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>
    <?php 
    if($loggedin){
    ?>
    
    <div class="container" id="cont">
        <div class="row">
<div class="col-lg-8">
    <div class="card wish-list mb-3">
        <h5 class="mb-3">Coșul meu</h5>
        <div class="wishlist-items">
            <?php
                $sql = "SELECT * FROM `viewcart` WHERE `userId`= $userId";
                $result = mysqli_query($conn, $sql);
                $totalPrice = 0;
                $counter = 0;
                $ship = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $pizzaId = $row['pizzaId'];
                    $Quantity = $row['itemQuantity'];
                    $mysql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
                    $myresult = mysqli_query($conn, $mysql);
                    $myrow = mysqli_fetch_assoc($myresult);
                    $pizzaName = $myrow['pizzaName'];
                    $pizzaPrice = $myrow['pizzaPrice'];
                    $total = $pizzaPrice * $Quantity;
                    $totalPrice += $total;
                    $counter++;
            ?>
<div class="wishlist-item d-flex flex-column flex-md-row align-items-center justify-content-between p-3 border-bottom position-relative">
    <!-- Butonul Remove -->
<!-- Butonul Remove -->
<div class="remove-button position-absolute top-0 end-0">
    <form action="partials/_manageCart.php" method="POST" class="h-100">
        <button name="removeItem" class="btn btn-outline-danger p-0 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4 7l16 0" />
                <path d="M10 11l0 6" />
                <path d="M14 11l0 6" />
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
            </svg>
        </button>
        <input type="hidden" name="itemId" value="<?php echo $pizzaId; ?>">
    </form>
</div>

    <!-- Imaginea produsului -->
    <div class="item-image ms-5 me-3">
        <?php
        echo '<img src="img/produs-' . $pizzaId . '.jpg" alt="' . htmlspecialchars($pizzaName) . '" class="img-fluid" width="64" height="64">';
        ?>
    </div>

    <!-- Informațiile despre produs -->
    <div class="item-info flex-grow-1">
        <h6 class="mb-1"><?php echo $pizzaName; ?></h6>
        <strong>
            <p class="mb-0 text-muted">Price: <?php echo $pizzaPrice; ?> RON</p>
            <p class="mb-0 text-muted">Total: <?php echo $total; ?> RON</p>
        </strong>
    </div>

    <!-- Acțiuni: Cantitatea -->
    <div class="item-actions d-flex align-items-center mt-3 mt-md-0">
        <form id="frm<?php echo $pizzaId; ?>" class="me-3">
            <input type="hidden" name="pizzaId" value="<?php echo $pizzaId; ?>">
            <input type="number" name="quantity" value="<?php echo $Quantity; ?>" class="form-control text-center" style="width: 80px;" min="1" onchange="updateCart(<?php echo $pizzaId; ?>)">
        </form>
    </div>
</div>

            <?php } ?>
            <?php if ($counter == 0) { ?>
            <div class="text-center py-5">
                <h5><strong>Your Cart is Empty</strong></h5>
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
            </div>
            <?php } ?>
        </div>
        <?php if ($counter > 0) { ?>
        <div class="cart-summary text-end mt-4">
            <h6>Total: <?php echo $totalPrice; ?> RON </h6>
            <form action="partials/_manageCart.php" method="POST">
                <button name="removeAllItem" class="btn btn-danger btn-sm">Golește coșul</button>
                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
            </form>
        </div>
        <?php } ?>
    </div>
</div>

      <?php if ($counter == 0) { 
      } else { ?>

      <?php if ($totalPrice>350) {
        $ship == 0;
      } else {
        $ship = 20;
      } ?>
            <div class="col-lg-4">
                <div class="card wish-list mb-3">
                    <div class="pt-4 border bg-light rounded p-3">
                        <h5 class="mb-3 text-uppercase font-weight-bold text-center">Order summary</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-light">Total Price<span>Ron <?php echo $totalPrice ?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">Shipping<span>Ron <?php echo $ship?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
                                <div>
                                    <strong>The total amount of</strong>
                                    <strong><p class="mb-0">(including Tax & Charge)</p></strong>
                                </div>
                                <span><strong>Ron <?php echo $totalPrice+$ship ?></strong></span>
                            </li>
                        </ul><br>
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkoutModal">go to checkout</button>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="pt-4">
                        <a class="dark-grey-text d-flex justify-content-between" style="text-decoration: none; color: #050607;" data-toggle="collapse" href="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                            Add a discount code (optional)
                            <span><i class="fas fa-chevron-down pt-1"></i></span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <div class="mt-3">
                                <div class="md-form md-outline mb-0">
                                    <input type="text" id="discount-code" class="form-control font-weight-light"
                                    placeholder="Enter discount code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php } ?>
                                
    <?php 
    }
    else {
        echo '<div class="container" style="min-height : 610px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Înainte de a face comanda ai nevoie să te <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Înregistrezi</a></strong></center></font>
        </div></div>';
    }
    ?>
    <?php require 'partials/_checkoutModal.php'; ?>
    <?php require 'partials/_footer.php' ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script>
        function check(input) {
            if (input.value <= 0) {
                input.value = 1;
            }
        }
        function updateCart(id) {
            $.ajax({
                url: 'partials/_manageCart.php',
                type: 'POST',
                data:$("#frm"+id).serialize(),
                success:function(res) {
                    location.reload();
                } 
            })
        }
    </script>
</body>
</html>