<?php
   session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}

$sql = "SELECT * FROM sitedetail";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$systemName = $row['systemName'];

echo '
<div class="animated-text-container">
    <div class="animated-text">
        <span id="text-1" class="active">Oferte de Până la 35% Reducere.</span>
        <span id="text-2">Carne la x lei/kg</span>
        <span id="text-3">Livrare Gratuită de la 350 lei</span>
    </div>
</div>';

echo '
<style>
    /* Container pentru text animat */
    .animated-text-container {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #007BFF; /* Fundal albastru */
        padding: 20px;
        text-align: center;
        max-width: 100%;
        height: 15px; /* Înălțime fixă pentru centrare */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        position: relative; /* Poziție relativă pentru ca span-urile să fie absolut poziționate */
    }

    /* Stiluri pentru text animat */
    .animated-text {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .animated-text span {
        position: absolute; /* Toate span-urile sunt poziționate la același punct */
        top: 50%; /* Centrare verticală */
        left: 50%; /* Centrare orizontală */
        transform: translate(-50%, -50%); /* Ajustare pentru centrare perfectă */
        color: #fff; /* Text alb */
        font-family: Arial, sans-serif;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0; /* Ascuns implicit */
        transition: opacity 0.5s ease-in-out;
    }

    .animated-text span.active {
        opacity: 1; /* Vizibil când este activ */
    }
</style>';

    echo '<style> 
/* Navbar Styles */
.navbar {
  background-color: #fff; /* Dark background */
  padding: none;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow */
}

/* Navbar Brand */
.navbar-brand {
  font-size: 10px; /* Larger font size for brand */
  font-weight: bold; /* Bold text */
  color: #ffffff; /* White text color */
  transition: color 0.3s; /* Transition for hover effect */
}

.navbar-brand:hover {
  color: green; /* Tomato color on hover */
}

/* Navbar Links */
.nav-link {
  color: #ffffff; /* White text color for links */
  transition: color 0.3s; /* Transition for hover effect */
}

.nav-link:hover {
  color: green; /* Tomato color on hover */
}



/* Active Link */
.nav-item.active .nav-link {
  color: green; /* Tomato color for active link */
  font-weight: bold; /* Bold active link */
}

.nav-item.dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0; /* Pentru a elimina decalajul */
}

.dropdown-menu {
  position: absolute;
  top: 100%; /* Se aliniază sub buton */
  left: 0;
  display: none; /* Ascuns implicit */
  margin: 0;
  padding: 0.5rem 0;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Shadow pentru dropdown */
}


.dropdown-item {
  color: #fff; /* White text for dropdown items */
  background-color: #007bff;
  transition: background-color 0.3s; /* Transition for hover effect */
  border-radius: 4px;
  margin-bottom: 4px;
}

.dropdown-item:hover {
  color: fff;
  background-color: #0027ff; /* Light tomato color on hover */
}


/* ~~~~~~~ DROPDOWN ~~~~ */


/* Mega Dropdown */
.mega-dropdown {
  position: absolute;
  left: 0;
  top: 100%;
  display: none;
  background: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  padding: 10px;
  width: 160px;
}

.mega-dropdown .buton {
  width: 120px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
  margin-top: 5px;
  font-weight: bold;
  font-size: 14px;
}

.mega-dropdown .buton:hover {
  background-color: #0027ff;
}

/* Submenu pentru produse */
.dropdown-submenu {
  position: relative;
}

.submenu-toggle {
  cursor: pointer;
  font-weight: bold;
}


/* Dropdown activ */
.nav-item.dropdown:hover .mega-dropdown {
  display: block;
}





/* Stiluri pentru dropdown-ul tip eMAG */

.dropdown-conectat {
  position: absolute;
  top: 100%
  width: 180px;
  height: 100px
  padding: 20px;
  border: 1px solid #ddd;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
  background-color: #fff;
  border-radius: 5px;
  left: 0;
}


.dropdown-conectat .btn-conectat-deconectare {
  width: 140px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
  margin-top: 5px;
  font-weight: bold;
  font-size: 12px;
}

.dropdown-conectat .btn-conectat-deconectare:hover {
  background-color: #0027ff;
}


.dropdown-emag {
  position: absolute;
  top: 100%; /* Ajustează această valoare pentru a muta dropdown-ul mai jos */
  width: 300px;
  height: 100px
  padding: 20px;
  border: 1px solid #ddd;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
  background-color: #fff;
  border-radius: 5px;
  left: -50%;
}

.dropdown-emag .dropdowns-header {
  font-size: 14px;
  color: #555;
}

.dropdown-emag .dropdown-header i {
  color: #007bff;
}

.dropdown-emag .dropdown-footer {
  margin-top: 5px;
}

.dropdown-emag p {
  font-size: 14px;
  font-weight: bold;
}

.dropdown-emag .btn-emag-inregistrare {
  width: 120px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;

  font-weight: bold;
  font-size: 12px;
}

.dropdown-emag .btn-emag-inregistrare:hover {
  background-color: #0027ff;
}

.dropdown-emag .btn-emag-cont-nou {
  width: 100px;
  background: none;
  color: #808b96;
  border-radius: 5px;

  font-weight: bold;
  font-size: 12px;
}


.dropdown-emag .btn-emag-cont-nou:hover {
  color: black;
}

.dropdown-emag .btn-emag-deconectare {
  width: 150px;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;

  font-weight: bold;
  font-size: 12px;
}

.dropdown-emag .btn-emag-deconectare:hover {
  background-color: #0027ff;
}


.dropdown-emag .btn-link {
  color: #007bff;
  font-size: 14px;
}

.dropdown-emag .btn-link:hover {
  text-decoration: underline;
}


/* butoane navbar */

.nav-buton {
  color: black;
  font-size: 16px;
  padding: 10px 20px; /* Dimensiuni pentru buton */
  text-align: center;
  vertical-align: middle;
  text-decoration: none;
}

.nav-buton:hover {
  color: #007BFF;

}

.nav-buton:focus {
  outline: none;

}

.nav-buton:active {
  outline: none;

}



/* Container pentru câmpul de căutare */
.search-container {
  position: relative; /* Necesită poziționare relativă pentru plasarea absolută a butonului */
  width: 650px; /* Ajustează după nevoie */
}

/* Câmpul de căutare */
.search-control {
  width: 100%; /* Se ajustează la dimensiunea containerului */
  border-radius: 20px;
  border: 1px solid #ced4da;
  padding: 10px 50px 10px 15px; /* Lăsăm spațiu pentru buton */
  transition: border-color 0.3s;
}

/* Stilizarea butonului */
.search-button {
  position: absolute;
  top: 50%; /* Centrare verticală */
  right: 10px; /* Poziție față de marginea dreaptă */
  transform: translateY(-50%);
  background: none; /* Eliminăm fundalul */
  border: none; /* Eliminăm bordura */
  font-size: 18px;
  color: #007BFF;
  cursor: pointer;
}

/* Efect hover pe buton */
.search-button:hover {
  color: #0027ff;
}

/* Focus pe câmpul de căutare */
.search-control:focus {
  border-color: #007BFF;
  box-shadow: 0 0 5px #007BFF;
  outline: none;
}

/* Form Form */
.form-inline {
  flex-grow: 1; /* Allow form to grow */
}

/* Form Input */
.form-control {
  border-radius: 20px; /* Rounded corners */
  border: 1px solid #ced4da; /* Light border */
  transition: border-color 0.3s; /* Transition for focus effect */
}

.form-control:focus {
  border-color: #007BFF; /* Tomato color on focus */
  box-shadow: 0 0 5px #007BFF; /* Light shadow on focus */
  outline: none;
}

/* LOGIN/SIGNUP Button */
.btn-login {
  height: 100%;
  color: black;
  background-color: #f8f9fa;
  /* border: 3px solid #007BFF; */ 
  border: none;
}

.btn-login:hover {
  color: #007bff;
}

.btn-login:focus {
  border: none;
}

.btn-login:active {
  border: none;
}

/* Profile Image */
.image-size-small img {
  border: 2px solid #ffffff; /* White border around profile image */
  border-radius: 50%; /* Circular image */
}

/* Responsive Navbar */
@media (max-width: 768px) {
  .navbar {
      padding: 0.5rem 1rem; /* Adjust padding on smaller screens */
  }

  .navbar-brand {
      font-size: 1.25rem; /* Smaller brand font size */
  }
} 
</style>';

echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">        
      <a class="navbar-brand" href="index.php"> <img src=img/pizza-69.jpg width=50 height=50></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
              <a class="btn nav-buton dropdown-toggle" href="#" id="categoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Produse
            </a>
            <div class="dropdown-menu mega-dropdown" aria-labelledby="categoryDropdown">
              <div class="dropdown-footer text-center">';

            $categoriesSql = "SELECT * FROM categories"; 
            $categoriesResult = mysqli_query($conn, $categoriesSql);
            while($category = mysqli_fetch_assoc($categoriesResult)){
                echo '<a class="btn buton" href="viewPizzaList.php?categorieId=' . $category['categorieId'] . '"> ' . $category['categorieName'] . '</a>';
            }

            echo '</div>
          </li>
        </ul>
<form method="get" action="/tavernarsr.ro/search.php" class="search-inline my-2 my-lg-0 mx-3">
  <div class="search-container">
    <input class="search-control my-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search" required>
    <button class="btn search-button" type="submit"><i class="fas fa-search"></i></button>
  </div>
</form>

        <div class="d-flex ml-auto">'; 

        if($loggedin){
          echo '<ul class="navbar-nav mr-2">
            <li class="nav-item dropdown">
                <a class="btn nav-buton dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fas fa-user"></i> Contul meu
              </a>
              <div class="dropdown-menu dropdown-conectat" aria-labelledby="accountDropdown">
                <div class="dropdown-footer text-center">

                      <a href="viewProfile.php"><button type="button" class="btn btn-conectat-deconectare mx-2"  data-toggle="modal" data-target="viewProfile.php"> Profilul meu</button></a>
                      <a href="viewOrder.php"><button type="button" class="btn btn-conectat-deconectare mx-2"  data-toggle="modal" data-target="viewCart.php"> Comenzile mele</button></a>
                      <a href="partials/_logout.php"><button type="button" class="btn btn-conectat-deconectare mx-2"  data-toggle="modal" data-target="#logout"> Deconectează-te</button></a>

                  </div>
              </div>
            </li>
          </ul>';
        }
        else {
          echo '
<ul class= "navbar-nav mr-2">
<li class="nav-item dropdown">
  <a class="btn nav-buton dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-user""></i> Contul meu
  </a>
  <div class="dropdown-menu dropdown-emag" aria-labelledby="accountDropdown">
    <div class="dropdown-header text-center">
      
      <p class="mt-2">Intră în contul tău pentru acces total !</p>
    </div>
    <div class="dropdown-footer text-center">
          <button type="button" class="btn btn-emag-inregistrare mx-2"  data-toggle="modal" data-target="#loginModal">>> Intra in cont</button>
          <button type="button" class="btn btn-emag-cont-nou mx-2"  data-toggle="modal" data-target="#signupModal">Cont nou</button>
    </div>
  </div>
</li>
</ul>';
        }


        // Cart button aligned to the right
        $countsql = "SELECT SUM(itemQuantity) FROM viewcart WHERE userId=$userId"; 
        $countresult = mysqli_query($conn, $countsql);
        $countrow = mysqli_fetch_assoc($countresult);      
        $count = $countrow['SUM(itemQuantity)'];
        if(!$count) {
          $count = 0;
        }

        echo '<div style="position: relative; display: inline-block;">
        <a href="viewCart.php">
          <button type="button" class="btn-login mx-2" title="MyCart" style="position: relative; padding: 5px;">
            <span style="position: absolute; top: -5px; right: -5px; background-color: red; color: white; border-radius: 100%; padding: 2px 6px; font-size: 12px;">' . $count . '</span>
            <svg xmlns="img/cart.svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16" style="vertical-align: middle;">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span style="margin-left: 5px;">Coșul meu</span>
          </button>
        </a>
      </div>';

        echo '</div>';  // End of flex container
  echo '</div>
    </nav>';
        include 'partials/_loginModal.php';
        include 'partials/_signupModal.php';
    
        if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> You can now login.
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
                </div>';
        }
        if(isset($_GET['error']) && $_GET['signupsuccess']=="false") {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Warning!</strong> ' .$_GET['error']. '
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
                </div>';
        }
        if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> You are logged in
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
                </div>';
        }
        if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Warning!</strong> Invalid Credentials
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
                </div>';
        }
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const texts = document.querySelectorAll('.animated-text span');
        let index = 0;

        setInterval(() => {
            texts[index].classList.remove('active'); // Elimină clasa activă de pe textul curent
            index = (index + 1) % texts.length; // Treci la următorul text
            texts[index].classList.add('active'); // Adaugă clasa activă pe textul următor
        }, 4000); // Schimbă textul la fiecare 3 secunde
    });

    $(document).ready(function() {
    // When clicking on a submenu toggle link
    $('.submenu-toggle').click(function(e) {
      // Prevent the default action (which would cause the menu to close)
      e.preventDefault();

      // Toggle the visibility of the sub-dropdown
      var subDropdown = $(this).next('.sub-dropdown');
      subDropdown.toggleClass('show');  // Add or remove the 'show' class

      // Close all other submenus except the one clicked
      $('.sub-dropdown').not(subDropdown).removeClass('show');
    });

    // Close the submenu if clicked outside
    $(document).click(function(e) {
      if (!$(e.target).closest('.dropdown-submenu').length) {
        $('.sub-dropdown').removeClass('show');
      }
    });
  });
  </script>