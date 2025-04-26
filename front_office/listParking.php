<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

$c = new ParkingP();
$tab = $c->ListeParking();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Stationnement -Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
<style>
    .back-container .btn {
    padding: 12px 20px;
    font-size: 18px;
    text-transform: uppercase;
    border-radius: 30px;
    transition: all 0.3s ease;
}

.back-container .btn:hover {
    background-color: #007bff;
    color: #fff;
    transform: translateY(-3px);
}

</style>
  
</head>

<body class="liste-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
                
            <li><a href="index.php" >Home<br></a></li>
            <li><a href="parking.php" class="active" >Stationnement</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="hotel.php">Vacances</a></li>
            <li><a href="event.php">Evenement</a></li>
            <li><a href="covoiturage.php">Covoiturage</a></li>
            <li><a href="contact.php" >Contact </a></li>
            
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="account.php">Creer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/parking.jpg);">
      <div class="container position-relative">
        <h1>Liste des Parkings</h1>
        
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Stationnement</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="liste" class="liste section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
      <h2 class="text-center">Liste des Parkings Disponibles</h2>


      <form class="row g-2 align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <input type="text" class="form-control" name="Rechercher" placeholder="Rechercher le Parking Par Id">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>

      </form>

    <br><br>
    

          <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>ID_Parking</th>
              <th>Nom Parking</th>
              <th>Adresse</th>
              <th>Capacite</th>
              <th>Hombre Disponibles</th>
              <th>Horaire Ouverture</th>
              <th>Horaire Fermeture</th>
              <th>Type Abonnement</th>
  	          <th>Tarification</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($tab as $parking): ?>
            <tr>
              <td><?= $parking['ID_Parking'] ?></td>
              <td><?= $parking['Nom_Parking'] ?></td>
              <td><?= $parking['Adresse_Parking'] ?></td>
              <td><?= $parking['Capacite_Totale'] ?></td>
              <td><?= $parking['Nombre_Dispo'] ?></td>
              <td><?= $parking['Horaire_Ouv'] ?></td>
              <td><?= $parking['Horaire_Ferm'] ?></td>
              <td><?= $parking['Abonnement'] ?></td>
	          <td><?= $parking['Tarification'] ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      
        <div class="back-container text-center my-4">
            <a href="parking.php" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-arrow-left"></i>⬅️ Retour à la page principale
            </a>
        </div>



    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Optimisation et Gestion Efficace du Stationnement </span>
          </a>
          <p>La gestion de stationnement sur notre site permet d'optimiser l'utilisation des espaces, 
            de réduire les coûts opérationnels et d'améliorer l'expérience utilisateur grâce à des fonctionnalités comme la surveillance en temps réel, 
            la gestion dynamique des tarifs et la possibilité de réserver des places en ligne. 
            Tout est conçu pour fluidifier la circulation et maximiser l'efficacité, notamment pendant les périodes de forte affluence.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Parking et Stationnement</a></li>
            <li><a href="#">Vacances</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Covoiturage</a></li>
            <li><a href="#">stationnement pour evenements</a></li>
          </ul>
        </div>

        

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>La Gazelle,Esprit </p>
          <p>Sidi Bou Siid</p>
          <p>La Marsa</p>
          <p>Manzah 1</p>
          <p>Le Bardo</p>
          <p>Bizerte</p>
          <p>Sfax</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+216 29 111 960</span></p>
          <p><strong>Email:</strong> <span>msellati.habibaeya@esprit.tn</span></p>
        </div>

      </div>
    </div>

    

  </footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>