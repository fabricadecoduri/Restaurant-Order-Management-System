<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href=assets/css/index.css>
    <title>Home</title>
    <link rel = "icon" href ="img/pizza-69.jpg" type = "image/x-icon">

  </head>
<body>
<?php include 'partials/_dbconnect.php';?>
<?php require 'partials/_nav.php' ?>

  <div class="custom-slider-container">
    <div class="custom-slider">
        <div class="custom-slider-slide">
            <img src="img/ca.jpg" alt="Slide 1">
            <div class="slide-content">
                <h2>Lorem ipsum </h2>
                <button class="slide-btn" onclick="handleButtonClick(event)">More</button>
            </div>
        </div>
        <div class="custom-slider-slide">
            <img src="img/carne.jpg" alt="Slide 2">
            <div class="slide-content">
                <h2>Lorem ipsum 2</h2>
                <button class="slide-btn" onclick="handleButtonClick(event)">More</button>
            </div>
        </div>
    </div>
    <div class="custom-slider-dots-container">
        <span class="custom-slider-dot" onclick="goToCustomSlide(0)"></span>
        <span class="custom-slider-dot" onclick="goToCustomSlide(1)"></span>
    </div>
</div>

<div class="categorie"> 
  <?php  
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);

if ($result_categories->num_rows > 0) {
    // Afișează cardurile pentru pizze
    while($category = $result_categories->fetch_assoc()) {
        echo "<h2 class=text-left>" . $category['categorieName'] . "</h2>";

        // Preia pizzele din această categorie
        $categoryId = $category['categorieId'];
        $sql_pizza = "SELECT * FROM pizza WHERE pizzaCategorieId = $categoryId";
        $result_pizza = $conn->query($sql_pizza);

        if ($result_pizza->num_rows > 0) {
            echo "<div class='row'>";
            while($pizza = $result_pizza->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='card'>";
                echo '<img src="img/produs-' . $pizza['pizzaId'] . '.jpg" class="card-img-top" alt="' . $pizza['pizzaName'] . '" width="249px" height="270px">';
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . substr($pizza['pizzaName'], 0, 10) . "</h5>";
                echo "<p class='card-text'><strong>" . $pizza['pizzaPrice'] . " RON</strong></p>";
                echo '<a href="viewPizza.php?pizzaId='. $pizza['pizzaId'] .'" class="btn btn-primary my-2">Vizualizează</a>';
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p class='card-text'><strong>Nu sunt produse în această categorie.</strong></p>";
        }
    }
} else {
    echo "<p class='card-text'><strong>Nu sunt categorii disponibile.</strong></p>";
}
$conn->close();
?>
</div>

  <?php require 'partials/_footer.php' ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script src="assets/js/slide.js"></script>
    <script src="assets/js/produse.js"></script>


</body>
</html>