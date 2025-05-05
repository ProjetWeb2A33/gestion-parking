<?php 
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';
include 'C:/xampp/htdocs/gestion parking/Controller/MailController.php';
include 'C:/xampp/htdocs/gestion parking/Model/Reservation.php';

$error = "";
$success = "";
$reservationR = new ReservationR();
$availableParkings = $reservationR->getAvailableParkings();

if (
  isset($_POST["idParking"]) &&
  isset($_POST["idClient"]) &&
  isset($_POST["nom_client"]) &&
  isset($_POST["horaire_d"]) &&
  isset($_POST["horaire_f"]) &&
  isset($_POST["statut"]) &&
  isset($_POST["prolongation"]) &&
  isset($_POST["payment"]) &&
  isset($_POST["disponibilite"]) &&
  isset($_POST["email"])
) {
  if (
      !empty($_POST["idParking"]) &&
      !empty($_POST["idClient"]) &&
      !empty($_POST["nom_client"]) &&
      !empty($_POST["horaire_d"]) &&
      !empty($_POST["horaire_f"]) &&
      !empty($_POST["statut"]) &&
      !empty($_POST["prolongation"]) &&
      !empty($_POST["payment"]) &&
      !empty($_POST["disponibilite"]) &&
      !empty($_POST["email"])

  ) {
      // Validation de l'ID du parking
      $idParking = $_POST['idParking'];
      $db = config::getConnexion(); // Assurez-vous que $db est bien défini
      $query = $db->prepare("SELECT COUNT(*) FROM parking WHERE ID_Parking = :ID_Parking");
      $query->execute(['ID_Parking' => $idParking]);
      if ($query->fetchColumn() == 0) {
          $error = "Le parking sélectionné n'est pas valide.";
      } else {
          // Si l'ID du parking est valide, créer l'objet Reservation
          $reservation = new Reservation (
              $_POST["idParking"],
              $_POST["idClient"],
              $_POST["nom_client"],
              $_POST["horaire_d"],
              $_POST["horaire_f"],
              $_POST["statut"],
              $_POST["prolongation"],
              $_POST["payment"],
              $_POST["disponibilite"],
              $_POST["email"]
          );
          $reservationR->AjouterReservation($reservation);
          $success = "La réservation a été ajoutée avec succès!";
          // Envoi de l'email de confirmation
          $mailSent = MailController::envoyerEmailConfirmation(
            $_POST["nom_client"],
            $_POST["horaire_d"],
            $_POST["horaire_f"],
            $_POST["email"] // Adresse email du client
        );

        if ($mailSent) {
            $success = "La réservation a été ajoutée avec succès et un email de confirmation a été envoyé.";
        } else {
            $success = "La réservation a été ajoutée avec succès, mais l'email de confirmation n'a pas pu être envoyé.";
        }
        header("Location: listeReservation.php");
        exit;
        
      }
  } else {
      $error = "Tous les champs sont obligatoires.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gestion de Stationnement et de Parking - Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  
  <style>
    /* Centrage du formulaire */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .form-box {
        width: 100%;
        max-width: 600px;
        padding: 30px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .confirmation-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999; 
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        width: 500px;
        max-width: 95%;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }
    /* Styles pour les champs valides */
.form-control.is-valid {
    border: 2px solid #28a745; /* Bordure verte */
    background-color: #e9f7ef; /* Fond légèrement vert */
}

.form-feedback.valid-feedback {
    color: #28a745; /* Texte vert */
    font-size: 0.875rem;
    margin-top: 5px;
}

/* Styles pour les champs invalides */
.form-control.is-invalid {
    border: 2px solid #dc3545; /* Bordure rouge */
    background-color: #f8d7da; /* Fond légèrement rouge */
}

.form-feedback.invalid-feedback {
    color: #dc3545; /* Texte rouge */
    font-size: 0.875rem;
    margin-top: 5px;
}
  </style>
</head>

<body class="liste-page">

<header id="header" class="header d-flex align-items-center fixed-top">    
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
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
    </div>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
      <div class="container-fluid py-4">
        <div class="form-container">
          <div class="form-box">
            <h2 class="mb-4">Ajouter une Reservation</h2>
            <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" id="reservationForm">
              
            <div class="mb-3">
              <label class="form-label">Parking :</label>
              <select class="form-select" name="idParking" id="idParking" required>
                  <option value="">Sélectionner un parking</option>
                  <?php foreach ($availableParkings as $parking): ?>
                      <option value="<?= $parking['ID_Parking'] ?>"><?= htmlspecialchars($parking['Nom_Parking']) ?></option>
                  <?php endforeach; ?>
              </select>
              <div class="form-feedback" id="idParkingFeedback"></div>
            </div>

              <div class="mb-3">
                <label class="form-label">ID Client :</label>
                <input type="number" class="form-control" name="idClient" id="idClient" required>
                <div class="form-feedback" id="idClientFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Nom Client :</label>
                <input type="text" class="form-control" name="nom_client" id="nom_client" required>
                <div class="form-feedback" id="nom_clientFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Email Client :</label>
                <input type="text" class="form-control" name="email" id="email" required>
                <div class="form-feedback" id="emailFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Horaire Debut:</label>
                <input type="time" class="form-control" name="horaire_d" id="horaire_d" required>
                <div class="form-feedback" id="horaire_dFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Horaire Fin :</label>
                <input type="time" class="form-control" name="horaire_f" id="horaire_f" required>
                <div class="form-feedback" id="horaire_fFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Statut :</label>
                <select class="form-select" name="statut" id="statut" required>
                  <option value="">Sélectionner une statut</option>
                  <option value="Confirmée">✅ Confirmée</option>
                  <option value="En attente"> ⏳ En attente</option>
                  <option value="Annulée"> ❌ Annulée</option>
                </select>
                <div class="form-feedback" id="statutFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Type de Prolongation :</label>
                <select class="form-select" name="prolongation" id="prolongation" required>
                  <option value="">Sélectionner une prolongation</option>       
                  <option value="Mensuel">🔁 Oui</option>
                  <option value="Annuel"> ⛔ Non</option>
                </select>
                <div class="form-feedback" id="prolongationFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Mode de Paiement :</label>
                <select class="form-select" name="payment" id="payment" required>
                  <option value="">Sélectionner un mode de paiement </option>
                  <option value="Carte"> 💳 Carte</option>
                  <option value="Espèces"> 💵 Espèces</option>
                  <option value="Mobile"> 📱 Mobile</option>
                </select>
                <div class="form-feedback" id="paymentFeedback"></div>
              </div>

              <div class="mb-3">
                <label class="form-label">Disponibilite :</label>
                <input type="number" class="form-control" name="disponibilite" id="disponibilite" required>
                <div class="form-feedback" id="disponibiliteFeedback"></div>
              </div>

              <div class="d-flex justify-content-between mt-4">
            <a href="listeReservation.php" class="btn btn-secondary">Liste des Reservations</a>
            <button type="button" class="btn btn-primary" id="submitBtn">Ajouter</button>
            <a href="parking.php" class="btn btn-outline-primary">Retour a la page principale</a>
          </div>
            </form>

          </div>
        </div>

        <div class="confirmation-modal" id="confirmationModal">
      <div class="modal-content">
          <h3>Confirmer l'ajout</h3>
          <div class="mb-3">
              <p><strong>Id Parking:</strong> <span id="modalID"></span></p>
              <p><strong>ID Client:</strong> <span id="modalIdc"></span></p>
              <p><strong>Nom Cient:</strong> <span id="modalNom"></span></p>
              <p><strong>Horaires:</strong> <span id="modalHoraire"></span></p>
              <p><strong>Statut:</strong> <span id="modalStatut"></span></p>
              <p><strong>Prolongation:</strong> <span id="modalProlongation"></span></p>
              <p><strong>Payement:</strong> <span id="modalPayement"></span></p>
	          <p><strong>Disponibilite:</strong> <span id="modalDisponibilite"></span></p>

          </div>
          <div class="modal-buttons">
              <button type="button" class="btn btn-secondary" id="cancelBtn">Annuler</button>
              <button type="button" class="btn btn-primary" id="confirmBtn">Confirmer l'ajout</button>
          </div>
      </div>
  </div>

      <!-- Style supplémentaire pour les modals -->
      <style>
            .confirmation-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999; /* Valeur très élevée */
                justify-content: center;
                align-items: center;
            }
          
          .modal-content {
              background: white;
              padding: 25px;
              border-radius: 10px;
              box-shadow: 0 5px 15px rgba(0,0,0,0.3);
              width: 500px;
              max-width: 95%;
              max-height: 90vh;
              overflow-y: auto;
          }
          
          .modal-buttons {
              display: flex;
              justify-content: flex-end;
              gap: 10px;
              margin-top: 20px;
          }
          
          .spinner-border {
              vertical-align: text-top;
          }
      </style>

       
        <!-- Modal de Succès (Bootstrap) -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Succès</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php echo $success; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='listeReservation.php'">OK</button>
          </div>
        </div>
      </div>
    </div>

    
  </main>
</section>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
  
  
  document.addEventListener('DOMContentLoaded', function() {
    // Validation pour l'ID Parking
    const idParkingInput = document.getElementById('idParking');
    const idParkingFeedback = document.getElementById('idParkingFeedback');

    idParkingInput.addEventListener('input', function () {
        const value = idParkingInput.value.trim();
        if (/^\d{8}$/.test(value)) { // Vérifie si l'ID contient exactement 8 chiffres
            idParkingInput.classList.remove('is-invalid');
            idParkingInput.classList.add('is-valid');
            idParkingFeedback.textContent = "L'ID Parking est valide.";
            idParkingFeedback.classList.remove('error');
            idParkingFeedback.classList.add('success');
        } else {
            idParkingInput.classList.remove('is-valid');
            idParkingInput.classList.add('is-invalid');
            idParkingFeedback.textContent = "L'ID Parking doit contenir exactement 8 chiffres.";
            idParkingFeedback.classList.remove('success');
            idParkingFeedback.classList.add('error');
        }
    });

    // Validation pour l'ID Client
    const idClientInput = document.getElementById('idClient');
    const idClientFeedback = document.getElementById('idClientFeedback');

    idClientInput.addEventListener('input', function () {
        const value = idClientInput.value.trim();
        if (/^\d{8}$/.test(value)) { // Vérifie si l'ID contient exactement 8 chiffres
            idClientInput.classList.remove('is-invalid');
            idClientInput.classList.add('is-valid');
            idClientFeedback.textContent = "L'ID Client est valide.";
            idClientFeedback.classList.remove('error');
            idClientFeedback.classList.add('success');
        } else {
            idClientInput.classList.remove('is-valid');
            idClientInput.classList.add('is-invalid');
            idClientFeedback.textContent = "L'ID Client doit contenir exactement 8 chiffres.";
            idClientFeedback.classList.remove('success');
            idClientFeedback.classList.add('error');
        }
    });

    // Validation pour le Nom Client
    const nomClientInput = document.getElementById('nom_client');
    const nomClientFeedback = document.getElementById('nom_clientFeedback');

    nomClientInput.addEventListener('input', function () {
        const value = nomClientInput.value.trim();
        if (!/\d/.test(value)) { // Vérifie que le nom ne contient pas de chiffres
            nomClientInput.classList.remove('is-invalid');
            nomClientInput.classList.add('is-valid');
            nomClientFeedback.textContent = "Le nom est valide.";
            nomClientFeedback.classList.remove('error');
            nomClientFeedback.classList.add('success');
        } else {
            nomClientInput.classList.remove('is-valid');
            nomClientInput.classList.add('is-invalid');
            nomClientFeedback.textContent = "Le nom ne doit pas contenir de chiffres.";
            nomClientFeedback.classList.remove('success');
            nomClientFeedback.classList.add('error');
        }
    });

    // Validation pour l'email
const emailInput = document.getElementById('email');
const emailFeedback = document.getElementById('emailFeedback');

emailInput.addEventListener('input', function () {
    const value = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex pour valider l'email

    if (emailRegex.test(value)) {
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
        emailFeedback.textContent = "L'email est valide.";
        emailFeedback.classList.remove('error');
        emailFeedback.classList.add('success');
    } else {
        emailInput.classList.remove('is-valid');
        emailInput.classList.add('is-invalid');
        emailFeedback.textContent = "Veuillez entrer une adresse email valide.";
        emailFeedback.classList.remove('success');
        emailFeedback.classList.add('error');
    }
});

    // Validation pour les horaires
    const horaireDebutInput = document.getElementById('horaire_d');
    const horaireFinInput = document.getElementById('horaire_f');
    const horaireDebutFeedback = document.getElementById('horaire_dFeedback');
    const horaireFinFeedback = document.getElementById('horaire_fFeedback');

    function validateHoraires() {
        const horaireDebut = horaireDebutInput.value;
        const horaireFin = horaireFinInput.value;

        if (horaireDebut && horaireFin && horaireFin > horaireDebut) {
            horaireDebutInput.classList.remove('is-invalid');
            horaireDebutInput.classList.add('is-valid');
            horaireDebutFeedback.textContent = "Horaire valide.";
            horaireDebutFeedback.classList.remove('error');
            horaireDebutFeedback.classList.add('success');

            horaireFinInput.classList.remove('is-invalid');
            horaireFinInput.classList.add('is-valid');
            horaireFinFeedback.textContent = "Horaire valide.";
            horaireFinFeedback.classList.remove('error');
            horaireFinFeedback.classList.add('success');
        } else {
            horaireDebutInput.classList.remove('is-valid');
            horaireDebutInput.classList.add('is-invalid');
            horaireDebutFeedback.textContent = "L'horaire de début doit être avant l'horaire de fin.";
            horaireDebutFeedback.classList.remove('success');
            horaireDebutFeedback.classList.add('error');

            horaireFinInput.classList.remove('is-valid');
            horaireFinInput.classList.add('is-invalid');
            horaireFinFeedback.textContent = "L'horaire de fin doit être après l'horaire de début.";
            horaireFinFeedback.classList.remove('success');
            horaireFinFeedback.classList.add('error');
        }
    }

    horaireDebutInput.addEventListener('input', validateHoraires);
    horaireFinInput.addEventListener('input', validateHoraires);

    // Validation pour le statut
    const statutInput = document.getElementById('statut');
    const statutFeedback = document.getElementById('statutFeedback');

    statutInput.addEventListener('change', function () {
        const value = statutInput.value.trim();
        if (value) {
            statutInput.classList.remove('is-invalid');
            statutInput.classList.add('is-valid');
            statutFeedback.textContent = "Statut valide.";
            statutFeedback.classList.remove('error');
            statutFeedback.classList.add('success');
        } else {
            statutInput.classList.remove('is-valid');
            statutInput.classList.add('is-invalid');
            statutFeedback.textContent = "Veuillez sélectionner un statut.";
            statutFeedback.classList.remove('success');
            statutFeedback.classList.add('error');
        }
        // Validation pour la prolongation
const prolongationInput = document.getElementById('prolongation');
const prolongationFeedback = document.getElementById('prolongationFeedback');

prolongationInput.addEventListener('change', function () {
    const value = prolongationInput.value.trim();
    if (value) { // Vérifie qu'une option est sélectionnée
        prolongationInput.classList.remove('is-invalid');
        prolongationInput.classList.add('is-valid');
        prolongationFeedback.textContent = "Prolongation valide.";
        prolongationFeedback.classList.remove('error');
        prolongationFeedback.classList.add('success');
    } else {
        prolongationInput.classList.remove('is-valid');
        prolongationInput.classList.add('is-invalid');
        prolongationFeedback.textContent = "Veuillez sélectionner une prolongation.";
        prolongationFeedback.classList.remove('success');
        prolongationFeedback.classList.add('error');
    }
});

// Validation pour le mode de paiement
const paymentInput = document.getElementById('payment');
const paymentFeedback = document.getElementById('paymentFeedback');

paymentInput.addEventListener('change', function () {
    const value = paymentInput.value.trim();
    if (value) { // Vérifie qu'une option est sélectionnée
        paymentInput.classList.remove('is-invalid');
        paymentInput.classList.add('is-valid');
        paymentFeedback.textContent = "Mode de paiement valide.";
        paymentFeedback.classList.remove('error');
        paymentFeedback.classList.add('success');
    } else {
        paymentInput.classList.remove('is-valid');
        paymentInput.classList.add('is-invalid');
        paymentFeedback.textContent = "Veuillez sélectionner un mode de paiement.";
        paymentFeedback.classList.remove('success');
        paymentFeedback.classList.add('error');
    }
});
    });

    // Validation pour la disponibilité
    const disponibiliteInput = document.getElementById('disponibilite');
    const disponibiliteFeedback = document.getElementById('disponibiliteFeedback');

    disponibiliteInput.addEventListener('input', function () {
        const value = disponibiliteInput.value.trim();
        if (!isNaN(value) && value > 0) {
            disponibiliteInput.classList.remove('is-invalid');
            disponibiliteInput.classList.add('is-valid');
            disponibiliteFeedback.textContent = "Disponibilité valide.";
            disponibiliteFeedback.classList.remove('error');
            disponibiliteFeedback.classList.add('success');
        } else {
            disponibiliteInput.classList.remove('is-valid');
            disponibiliteInput.classList.add('is-invalid');
            disponibiliteFeedback.textContent = "Veuillez entrer une disponibilité valide.";
            disponibiliteFeedback.classList.remove('success');
            disponibiliteFeedback.classList.add('error');
        }
    });
    console.log("DOM fully loaded"); // Debug
    
    const form = document.getElementById('reservationForm');
    const submitBtn = document.getElementById('submitBtn');
    const confirmationModal = document.getElementById('confirmationModal');
    
    if (!form || !submitBtn || !confirmationModal) {
        console.error("Required elements not found!");
        return;
    }

    submitBtn.addEventListener('click', function(e) {
        console.log("Submit button clicked"); // Debug
        
        if (validateForm()) {
            console.log("Form is valid, showing modal"); // Debug
            // Remplir le modal
            document.getElementById('modalID').textContent = document.getElementById('idParking').value;
            document.getElementById('modalIdc').textContent = document.getElementById('idClient').value;
            document.getElementById('modalNom').textContent = document.getElementById('nom_client').value;
            document.getElementById('modalHoraire').textContent = 
                document.getElementById('horaire_d').value + ' - ' + 
                document.getElementById('horaire_f').value;
            document.getElementById('modalStatut').textContent = document.getElementById('statut').value;
            document.getElementById('modalProlongation').textContent = document.getElementById('prolongation').value;
            document.getElementById('modalPayement').textContent = document.getElementById('payment').value;
            document.getElementById('modalDisponibilite').textContent = document.getElementById('disponibilite').value;
            // Afficher le modal
            confirmationModal.style.display = 'flex';
        } else {
            console.log("Form validation failed"); // Debug
        }
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        confirmationModal.style.display = 'none';
    });

    document.getElementById('confirmBtn').addEventListener('click', function() {
        console.log("Confirm button clicked - submitting form"); // Debug
        confirmationModal.style.display = 'none';
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';
        submitBtn.disabled = true;
        form.submit();
    });

    function validateForm() {
        let isValid = true;
        const errorMessages = [];
        
        // Clear previous error messages
        document.querySelectorAll('.form-feedback').forEach(el => el.textContent = '');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        
        // Récupération des valeurs
        const idParking = parseInt(document.getElementById('idParking').value);
        const idClient = parseInt(document.getElementById('idClient').value);
        const nom_client = document.getElementById('nom_client').value.trim();
        const horaire_d = document.getElementById('horaire_d').value;
        const horaire_f = document.getElementById('horaire_f').value;
	      const statut = document.getElementById('statut').value;
        const prolongation = document.getElementById('prolongation').value;
        const payment = document.getElementById('payment').value;
	      const disponibilite = document.getElementById('disponibilite').value;
        
        // Validation des champs
        const validations = [
          {
              condition: !/^\d{8}$/.test(idParking),
              element: 'idParking',
              message: "L'ID Parking doit contenir exactement 8 chiffres"
          },
          {
              condition: !/^\d{8}$/.test(idClient),
              element: 'idClient',
              message: "L'ID Client doit contenir exactement 8 chiffres"
          },
          {
              condition: /\d/.test(nom_client),
              element: 'nom_client',
              message: "le nom ne doit pas contenir de chiffres"
          },
          {
              condition: !horaire_d,
              element: 'horaire_d',
              message: "L'horaire de début est requis"
          },
          {
              condition: !horaire_f,
              element: 'horaire_f',
              message: "L'horaire de fin est requis"
          },
          {
              condition: new Date('1970-01-01T' + horaire_f + ':00') <= new Date('1970-01-01T' + horaire_d + ':00'),
              element: 'horaire_f',
              message: "L'heure de fin doit être après l'heure de début"
          },
          {
              condition: !statut,
              element: 'statut',
              message: "Veuillez sélectionner une statut"
          },
          {
              condition: !prolongation,
              element: 'prolongation',
              message: "Veuillez sélectionner une prolongation"
          },
	        {
                condition: !payment,
                element: 'payment',
                message: "Veuillez sélectionner un mode de payement"
            },
	        {
                condition: !disponibilite,
                element: 'disponibilite',
                message: "Veuillez sélectionner une disponibilite"
            }
        ];
        
        // Appliquer les validations
        validations.forEach(validation => {
            if (validation.condition) {
                const feedbackElement = document.getElementById(validation.element + 'Feedback');
                const inputElement = document.getElementById(validation.element);

                if (feedbackElement) {
                    feedbackElement.textContent = validation.message;
                }
                if (inputElement) {
                    inputElement.classList.add('is-invalid');
                }

                isValid = false;
                errorMessages.push(validation.message);
            }
        });

        
        // Afficher toutes les erreurs en haut si nécessaire
        if (!isValid) {
            const errorContainer = document.createElement('div');
            errorContainer.className = 'alert alert-danger';
            errorContainer.innerHTML = '<strong>Erreurs :</strong><ul>' + 
                errorMessages.map(msg => `<li>${msg}</li>`).join('') + '</ul>';
            
            const formContainer = document.querySelector('.form-container');
            if (formContainer && !document.querySelector('.alert.alert-danger')) {
                formContainer.prepend(errorContainer);
            }
        }
        
        return isValid;
    }
    
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const feedback = document.getElementById(fieldId + 'Feedback');
        
        if (field && feedback) {
            field.classList.add('is-invalid');
            feedback.textContent = message;
        }
    }

     // Afficher le modal de succès si l'ajout a réussi
     <?php if($success): ?>
        // Créer un modal de succès dynamiquement
        const successModalHTML = `
            <div class="confirmation-modal" style="display: flex;">
                <div class="modal-content">
                    <h3>Succès</h3>
                    <p><?php echo $success; ?></p>
                    <div class="modal-buttons">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='listeReservation.php'">OK</button>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', successModalHTML);
        
        // Fermer le modal après 3 secondes
        setTimeout(() => {
            const modal = document.querySelector('.confirmation-modal');
            if (modal) modal.style.display = 'none';
            window.location.href = 'listReservation.php';
        }, 3000);
    <?php endif; ?>
});

</script>
</body>
</html>