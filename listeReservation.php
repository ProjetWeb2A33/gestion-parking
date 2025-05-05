<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';

$r = new ReservationR();
$get = $r->ListeReservation();

session_start();
if (isset($_SESSION['success_message'])) {
    $success = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
    
    // Afficher le modal via JavaScript
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        var successModal = new bootstrap.Modal(document.getElementById("successModal"));
        successModal.show();
    });
    </script>';
}
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
    .search-container .form-control {
        border-radius: 25px 0 0 25px;
        padding: 10px 15px;
    }

    .search-container .btn {
        border-radius: 0 25px 25px 0;
        padding: 10px 20px;
    }
</style>
  
</head>

<body class="liste-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
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
        <h1>Liste des Reservations</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Stationnement</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- list Section -->
    <section id="liste" class="liste section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
      <h2 class="text-center">Liste des Reservations Disponibles</h2>

      <form class="row g-2 align-items-center">
        <div class="d-flex justify-content-center align-items-center">
          <div class="search-container text-center my-4">
            <div class="input-group" style="max-width: 400px; margin: 0 auto;">
              <input type="text" id="searchByClientIdInput" class="form-control" placeholder="Rechercher par ID Client">
              <button id="searchByClientIdBtn" class="btn btn-primary">
                <i class="fas fa-search me-1"></i> Rechercher
              </button>
            </div>
          </div>
        </div>
      </form>

    <br><br>

    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>ID Reservation</th>
          <th>Nom Parking</th>
          <th>ID Client</th>
          <th>Nom Client</th>
          <th>Horaire Début</th>
          <th>Horaire Fin</th>
          <th>Statut</th>
          <th>Prolongation</th>
          <th>Paiement</th>
          <th>Disponibilité</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($get as $reservation): ?>
          <tr>
            <td><?= $reservation['ID_Reservation'] ?></td>
            <td><?= htmlspecialchars($reservation['Nom_Parking']) ?></td>            
            <td><?= $reservation['idClient'] ?></td>
            <td><?= $reservation['nom_client'] ?></td>
            <td><?= $reservation['horaire_d'] ?></td>
            <td><?= $reservation['horaire_f'] ?></td>
            <td><?= $reservation['statut'] ?></td>
            <td><?= $reservation['prolongation'] ?></td>
            <td><?= $reservation['payment'] ?></td>
            <td><?= $reservation['disponibilite'] ?></td>
            <td>  
            <div class="d-flex gap-2">
                <a href="UpdateReservation.php?id=<?= $reservation['ID_Reservation'] ?>"  
                  onclick="confirmModify(event, <?= $reservation['ID_Reservation'] ?>)"  
                  class="btn btn-sm btn-primary"> 
                  <i class="fas fa-edit"></i> Modifier 
                </a>  
                <a href="DeleteReservation.php?id=<?= $reservation['ID_Reservation'] ?>" 
                  onclick="confirmDelete(event, <?= $reservation['ID_Reservation'] ?>)" 
                  class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i> Supprimer
                </a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>     
	</table>
      
    <div class="back-container text-center my-4">
        <a href="parking.php" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-arrow-left"></i>⬅️ Retour à la page principale
        </a>
    </div>
    <div class="back-container text-center my-4">
        <a href="http://localhost/gestion%20parking/view/back_office/pages/dashboard.php" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-arrow-left"></i>⬅️ Retour à la page du dashboard
        </a>
    </div>
    </section>
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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></scriptdocument.addEventListener>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  
<script>

// Masquer toutes les lignes au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('.table tbody tr'); // Sélectionne toutes les lignes du tableau
        rows.forEach(row => {
            row.style.display = 'none'; // Masque toutes les lignes au chargement
        });
    });

    // Fonction de recherche par ID Client
    document.getElementById('searchByClientIdBtn').addEventListener('click', (event) => {
        event.preventDefault(); // Empêche le rechargement de la page

        const searchValue = document.getElementById('searchByClientIdInput').value.trim(); // Récupère la valeur saisie
        const table = document.querySelector('.table tbody'); // Sélectionne le corps du tableau
        const rows = table.querySelectorAll('tr'); // Sélectionne toutes les lignes du tableau

        console.log("Valeur recherchée :", searchValue); // Affiche la valeur saisie

        let found = false; // Variable pour vérifier si une correspondance est trouvée

        rows.forEach(row => {
            const clientIdCell = row.cells[2].textContent.trim(); // Colonne 2 : ID Client
            console.log("ID Client dans la ligne :", clientIdCell); // Affiche l'ID Client de chaque ligne

            if (clientIdCell === searchValue) {
                row.style.display = ''; // Affiche la ligne correspondante
                found = true;
            } else {
                row.style.display = 'none'; // Masque les lignes non correspondantes
            }
        });

        // Afficher un message si aucune correspondance n'est trouvée
        if (!found) {
            alert("Aucune réservation trouvée pour l'ID Client : " + searchValue);
        }
    });

  function confirmModify(event, id) {
      event.preventDefault(); // Empêche la redirection immédiate

      // Empêche d'afficher plusieurs modales
      if (document.querySelector('.modal-overlay')) return;

        const modal = document.createElement('div');
        modal.innerHTML = `
        <div class="modal-overlay" style="
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        ">
            <div class="modal-content" style="
                background: white;
                padding: 25px;
                border-radius: 10px;
                width: 400px;
                max-width: 90%;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                text-align: center;
            ">
                <h4 style="margin-top: 0">Confirmer la modification</h4>
                <p>Êtes-vous sûr de vouloir modifier cette reservation ?</p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
                    <button onclick="this.closest('.modal-overlay').remove()" 
                            class="btn btn-secondary" 
                            style="padding: 8px 20px">
                        Annuler
                    </button>
                    <a href="UpdateReservation.php?ID_Reservation=${id}" 
                       class="btn btn-primary" 
                       style="padding: 8px 20px">
                        Confirmer
                    </a>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}



function confirmDelete(event, id) {
    event.preventDefault(); // Empêche le lien de rediriger immédiatement

    // Vérifie s’il y a déjà une modale
    if (document.querySelector('.modal-overlay')) return;

    const modal = document.createElement('div');
    modal.innerHTML = `
        <div class="modal-overlay" style="
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        ">
            <div class="modal-content" style="
                background: white;
                padding: 25px;
                border-radius: 10px;
                width: 400px;
                max-width: 90%;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                text-align: center;
            ">
                <h4 style="margin-top: 0">Confirmer la suppression</h4>
                <p>Êtes-vous sûr de vouloir supprimer cette reservation ?</p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
                    <button onclick="this.closest('.modal-overlay').remove()" 
                            class="btn btn-secondary" 
                            style="padding: 8px 20px">
                        Annuler
                    </button>
                    <a href="DeleteReservation.php?ID_Reservation=${id}" 
                       class="btn btn-danger" 
                       style="padding: 8px 20px">
                        Confirmer
                    </a>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}
document.getElementById('searchByClientIdBtn').addEventListener('click', (event) => {
    event.preventDefault(); // Empêche le rechargement de la page

    const searchValue = document.getElementById('searchByClientIdInput').value.trim(); // Récupère la valeur saisie
    const table = document.querySelector('.table tbody'); // Sélectionne le corps du tableau
    const rows = table.querySelectorAll('tr'); // Sélectionne toutes les lignes du tableau

    console.log("Valeur recherchée :", searchValue); // Affiche la valeur saisie

    // Si le champ est vide, afficher toutes les lignes
    if (!searchValue) {
        rows.forEach(row => row.style.display = ''); // Affiche toutes les lignes
        return;
    }

    let found = false; // Variable pour vérifier si une correspondance est trouvée

    rows.forEach(row => {
        const clientIdCell = row.cells[2].textContent.trim(); // Colonne 2 : ID Client
        console.log("ID Client dans la ligne :", clientIdCell); // Affiche l'ID Client de chaque ligne

        if (clientIdCell === searchValue) {
            row.style.display = ''; // Affiche la ligne correspondante
            found = true;
        } else {
            row.style.display = 'none'; // Masque les lignes non correspondantes
        }
    });

    // Afficher un message si aucune correspondance n'est trouvée
    if (!found) {
        alert("Aucune réservation trouvée pour l'ID Client : " + searchValue);
    }
});

</script>      
<script src="assets/js/main.js"></script>
                                                           
</body>
</html>