<?php 
    include 'partials/_dbconnect.php';
    require 'partials/_nav.php';

    // Verifică dacă există termenul de căutare
    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
    } else {
        $searchQuery = '';
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Search Results</title>
    <link rel="icon" href="img/pizza-69.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
    #cont {
        min-height: 515px;
    }
    </style>
</head>
<body>
<div class="container my-3">
        <h2 class="py-2">Rezultatul căutării pentru <em>"<?php echo htmlspecialchars($searchQuery); ?>"</em> este:</h2>
        <div class="row">
        <?php 
            $noResult = true;
            $query = $searchQuery;
            $sql = "SELECT * FROM `pizza` WHERE MATCH(pizzaName, pizzaDesc) AGAINST('$query')"; 
            $result = mysqli_query($conn, $sql);
            echo "<div class='row'>";
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $pizzaId = $row['pizzaId'];
                $pizzaName = $row['pizzaName'];
                $pizzaPrice = $row['pizzaPrice'];
                $pizzaDesc = $row['pizzaDesc'];
                
                echo "<div class='col-md-4'>";
                echo "<div class='card'>";
                echo '<img src="img/produs-' . $pizzaId . '.jpg" class="card-img-top" alt="' . $pizzaName . '" width="249px" height="270px">';
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . substr($pizzaName, 0, 10) . "</h5>";
                echo "<p class='card-text'><strong>" . $pizzaPrice . " RON</strong></p>";
                echo '<a href="viewPizza.php?pizzaId='. $pizzaId .'" class="btn btn-primary my-2">Vizualizează</a>';
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }


            echo '';


            // Mesaj dacă nu există rezultate
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1>Nu am putut găsi niciun produs numit: <em> "' . htmlspecialchars($_GET['search']) . '" </em></h1>
                            <p class="lead"> Sugestii: <ul>
                                <li>Verificați dacă cuvintele sunt scrise corect.</li>
                                <li>Căutați alt produs.</li>
                                <li>Dacă nu găsiți denumirea la produsul dorit, probabil produsul nu mai este în stoc sau a fost șters.</li></ul>
                            </p>
                        </div>
                    </div>';
            }
        ?>
        </div>
    </div>



    <?php require 'partials/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>