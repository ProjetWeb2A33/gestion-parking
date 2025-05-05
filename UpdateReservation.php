<?php
session_start();
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';
include 'C:/xampp/htdocs/gestion parking/Model/Reservation.php';

// Activer le mode debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

$reservationR = new ReservationR();
$reservation = null;
$error = "";
$success = "";
$availableParkings = $reservationR->getAvailableParkings();

// Vérifier si l'ID est passé dans l'URL (GET) pour afficher les données existantes
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_Reservation'])) {
    $id = $_GET['ID_Reservation'];
    $reservation = $reservationR->getReservationById($id);

    if (!$reservation) {
        $_SESSION['error'] = "Réservation introuvable.";
        header("Location: listeReservation.php");
        exit();
    }
}

// Traitement de la soumission du formulaire (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si tous les champs sont présents
    $requiredFields = [
        'ID_Reservation', 'idParking', 'idClient', 'nom_client', 
        'horaire_d', 'horaire_f', 'statut',
        'prolongation', 'payment', 'disponibilite'
    ];

    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        $_SESSION['error'] = "Champs manquants ou vides : " . implode(', ', $missingFields);
        header("Location: UpdateReservation.php?ID_Reservation=" . $_POST['ID_Reservation']);
        exit();
    }

    try {
        $reservationObj = new Reservation(
            (int)$_POST["idParking"], 
            (int)$_POST["idClient"],
            $_POST["nom_client"],
            $_POST["horaire_d"],
            $_POST["horaire_f"],
            $_POST["statut"],
            $_POST["prolongation"],
            $_POST["payment"],
            $_POST["disponibilite"],
            $_POST["email"]
        );

        if ($reservationR->UpdateReservation($_POST['ID_Reservation'], $reservationObj)) {
            $_SESSION['success'] = "Réservation modifiée avec succès.";
            header("Location: listeReservation.php");
            exit();
        } else {
            throw new Exception("La mise à jour a échoué.");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
        header("Location: UpdateReservation.php?ID_Reservation=" . $_POST['ID_Reservation']);
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
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
    
    .is-invalid {
        border-color: #dc3545;
    }
    
    .invalid-feedback {
        color: #dc3545;
        display: block;
        margin-top: 5px;
    }
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
    /* Hero Section */
    .page-title {
        position: relative;
        padding: 180px 0 120px;
        background: linear-gradient(rgba(10, 29, 55, 0.85), rgba(10, 29, 55, 0.85)), url('assets/img//55.png') center/cover no-repeat;
        color: white;
        text-align: center;
        }
        
        .page-title h1 {
        font-family: Arial, sans-serif;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        animation: fadeInDown 1s ease;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .page-title p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 30px;
        animation: fadeInUp 1s ease;
        opacity: 0.9;
        }

        /* Header */
        .header {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 999;
        transition: all 0.3s;
        }

        /* Logo */
        .sitename {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.8rem;
        background: linear-gradient(to right, #0d3f72, #3a5cb3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        }

        /* Navigation */
        .navmenu ul {
        display: flex;
        margin: 0;
        padding: 0;
        list-style: none;
        }

        .navmenu ul li {
        position: relative;
        margin: 0 12px;
        }

        .navmenu ul li a {
        color: #2d3748;
        font-weight: 500;
        padding: 10px 0;
        position: relative;
        transition: all 0.3s;
        }

        .navmenu ul li a:hover,
        .navmenu ul li a.active {
        color: #0d3f72;
        }

        .navmenu ul li a:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(to right, #0d3f72, #3a5cb3);
        transition: width 0.3s;
        }

        .navmenu ul li a:hover:after,
        .navmenu ul li a.active:after {
        width: 100%;
        }

        /* Bouton */
        .btn-getstarted {
        background: linear-gradient(to right, #0d3f72, #3a5cb3);
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        }

        .btn-getstarted:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(13, 63, 114, 0.2);
        }

        /* Titre de page */
        .page-title {
        padding: 180px 0 100px;
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
        margin-top: 80px; /* Pour compenser le header fixe */
        }

        .page-title h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
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
          <li><a href="index.php">Home</a></li>
          <li><a href="parking.php" class="active">Stationnement</a></li>
          <li><a href="service.php">Services</a></li>
          <li><a href="hotel.php">Vacances</a></li>
          <li><a href="event.php">Evenement</a></li>
          <li><a href="covoiturage.php">Covoiturage</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="account.php">Creer un compte</a>
    </div>
  </header>

  <div class="page-title dark-background" data-aos="fade" style="background-image: url('assets/img/parking.png');">
    <div class="container position-relative">
        <h1>Modifier Votre Reservation</h1>
    </div>
</div>
  </div>

  <main class="main">
    <div class="form-container">
        <div class="form-box">
            <h2 class="mb-4">Modifier une Réservation</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
        
        <?php if($reservation): ?>
        <form method="POST" action="UpdateReservation.php" id="reservationForm">
          <input type="hidden" name="ID_Reservation" value="<?= $reservation['ID_Reservation'] ?>">

          <div class="mb-3">
            <label class="form-label">Parking :</label>
            <select class="form-select" name="idParking" id="idParking" required>
                <option value="">Sélectionner un parking</option>
                <?php foreach ($availableParkings as $parking): ?>
                <option value="<?= $parking['ID_Parking'] ?>" 
                    <?= $reservation['idParking'] == $parking['ID_Parking'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($parking['Nom_Parking']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

         <div class="mb-3">
            <label class="form-label">ID Client :</label>
            <input type="number" class="form-control" name="idClient" id="idClient" 
                value="<?= isset($reservation['idClient']) ? htmlspecialchars($reservation['idClient']) : '' ?>"  required>
            <div class="form-feedback" id="idClientFeedback"></div>
         </div>
          
          <div class="mb-3">
            <label class="form-label">Nom du Client :</label>
            <input type="text" class="form-control" name="nom_client" id="nom_client" 
                   value="<?= htmlspecialchars($reservation['nom_client']) ?>" required>
            <div class="form-feedback" id="nom_clientFeedback"></div>
          </div>
          
           
          <div class="mb-3">
            <label class="form-label">Horaire du début :</label>
            <input type="time" class="form-control" name="horaire_d" id="horaire_d" 
                value="<?= isset($reservation['horaire_d']) ? htmlspecialchars($reservation['horaire_d']) : '' ?>" 
                required>
            <div class="form-feedback" id="horaire_dFeedback"></div>
          </div>

            <div class="mb-3">
                <label class="form-label">Horaire de la Fin :</label>
                <input type="time" class="form-control" name="horaire_f" id="horaire_f" 
                    value="<?= isset($reservation['horaire_f']) ? htmlspecialchars($reservation['horaire_f']) : '' ?>" 
                    required>
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
                <div class="form-feedback invalid-feedback" id="prolongationFeedback"></div>
                </div>

	  <div class="mb-3">
            <label class="form-label">Mode de Paiement :</label>
            <select class="form-select" name="payment" id="payment" required>
              <option value="">Sélectionner un mode de paiement </option>
              <option value="Carte" > 💳 Carte</option>
              <option value="Espèces"> 💵 Espèces</option>
              <option value="Mobile"> 📱 Mobile</option>
            </select>
            <div class="form-feedback invalid-feedback" id="paymentFeedback"></div>
            </div>

          <div class="mb-3">
            <label class="form-label">Disponibilite :</label>
            <input type="number" class="form-control" name="disponibilite" id="disponibilite" required>
            <div class="form-feedback" id="disponibiliteFeedback"></div>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="listeReservation.php" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>

        <?php endif; ?>
      </div>
    </div>

<div class="confirmation-modal" id="confirmationModal">
          <div class="modal-content">
              <h3>Confirmer la modification</h3>
              <div class="mb-3">
                  <p><strong>ID Parking:</strong> <span id="modalID"></span></p>
                  <p><strong>ID Client:</strong> <span id="modalIdc"></span></p>
                  <p><strong>Nom Client:</strong> <span id="modalNom"></span></p>
                  <p><strong>Horaires:</strong> <span id="modalHoraire"></span></p>
                  <p><strong>Statut:</strong> <span id="modalStatut"></span></p>
                  <p><strong>Prolongation:</strong> <span id="modalProlongation"></span></p>
                  <p><strong>Paiement:</strong> <span id="modalPayement"></span></p>
                  <p><strong>Disponibilité:</strong> <span id="modalDisponibilite"></span></p>
              </div>
              <div class="modal-buttons">
                  <button type="button" class="btn btn-secondary" id="cancelBtn">Annuler</button>
                  <button type="button" class="btn btn-primary" id="confirmBtn">Confirmer</button>
              </div>
          </div>
        </div>

        
      </div>
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
          </p>
          
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

          
          <p class="mt-4"><strong>Phone:</strong> <span>+216 29 111 960</span></p>
          <p><strong>Email:</strong> <span>msellati.habibaeya@esprit.tn</span></p>
        </div>

      </div>
    </div>

    

</footer>

  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
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
        statutFeedback.classList.remove('invalid-feedback');
        statutFeedback.classList.add('valid-feedback');
    } else {
        statutInput.classList.remove('is-valid');
        statutInput.classList.add('is-invalid');
        statutFeedback.textContent = "Veuillez sélectionner un statut.";
        statutFeedback.classList.remove('valid-feedback');
        statutFeedback.classList.add('invalid-feedback');
    }

        // Validation pour la prolongation
        const prolongationInput = document.getElementById('prolongation');
const prolongationFeedback = document.getElementById('prolongationFeedback');

prolongationInput.addEventListener('change', function () {
    const value = prolongationInput.value.trim();
    if (value) {
        prolongationInput.classList.remove('is-invalid');
        prolongationInput.classList.add('is-valid');
        prolongationFeedback.textContent = "Prolongation valide.";
        prolongationFeedback.classList.remove('invalid-feedback');
        prolongationFeedback.classList.add('valid-feedback');
    } else {
        prolongationInput.classList.remove('is-valid');
        prolongationInput.classList.add('is-invalid');
        prolongationFeedback.textContent = "Veuillez sélectionner une prolongation.";
        prolongationFeedback.classList.remove('valid-feedback');
        prolongationFeedback.classList.add('invalid-feedback');
    }
});
    // Validation pour le mode de paiement
    const paymentInput = document.getElementById('payment');
const paymentFeedback = document.getElementById('paymentFeedback');

paymentInput.addEventListener('change', function () {
    const value = paymentInput.value.trim();
    if (value) {
        paymentInput.classList.remove('is-invalid');
        paymentInput.classList.add('is-valid');
        paymentFeedback.textContent = "Mode de paiement valide.";
        paymentFeedback.classList.remove('invalid-feedback');
        paymentFeedback.classList.add('valid-feedback');
    } else {
        paymentInput.classList.remove('is-valid');
        paymentInput.classList.add('is-invalid');
        paymentFeedback.textContent = "Veuillez sélectionner un mode de paiement.";
        paymentFeedback.classList.remove('valid-feedback');
        paymentFeedback.classList.add('invalid-feedback');
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

    
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        const horaireD = document.getElementById('horaire_d').value;
        const horaireF = document.getElementById('horaire_f').value;
        const idParking = document.getElementById('idParking').value;
        const idClient = document.getElementById('idClient').value;
        if (!horaireD || !horaireF) {
            e.preventDefault();
            alert('Veuillez saisir les horaires');
            return;
        }
        
        if (horaireF <= horaireD) {
            e.preventDefault();
            document.getElementById('horaire_fFeedback').textContent = 
                "L'heure de fin doit être après l'heure de début";
            return;
        }
    });

    const form = document.getElementById('reservationForm');
    
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
        } else {
            // Afficher un indicateur de chargement sur le bouton submit
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';
            submitBtn.disabled = true;
        }
    });
    
    // Fonction de validation du formulaire améliorée
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
        const horaire_d = document.getElementById('horaire_d').value.trim();
        const horaire_f = document.getElementById('horaire_f').value.trim();
  	    const statut = document.getElementById('statut').value.trim();
        const prolongation = document.getElementById('prolongation').value.trim();
        const payment = document.getElementById('payment').value.trim();
        const disponibilite = parseInt(document.getElementById('disponibilite').value);

        // Validation des champs
        const validations = [
            {
                condition: !/^\d{1,8}$/.test(idParking),
                element: 'idParking',
                message: "L'ID Parking doit contenir entre 1 et 8 chiffres"
            },
            {
                condition: !/^\d{1,8}$/.test(idClient),
                element: 'idClient',
                message: "L'ID Client doit contenir entre 1 et 8 chiffres"
            },
            {
                condition: /\d/.test(nom_client),
                element: 'nom_client',
                message: "le nom ne doit pas contenir de chiffres"
            },
           {
                condition: isNaN(horaired) || horaire_d < 0 || horaire_d > 23,
                element: 'horaire_d',
                message: "L'horaire du debut doit être entre 0 et 23"
            },
            {
                condition: isNaN(horairef) || horaire_f < 0 || horaire_f > 23,
                element: 'horaire_f',
                message: "L'horaire de la fin doit être entre 0 et 23"
            },
            {
                condition: horaire_f <= horaire_d,
                element: 'horaire_f',
                message: "L'heure de la fin doit être après l'heure du debut"
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
                document.getElementById(validation.element + 'Feedback').textContent = validation.message;
                document.getElementById(validation.element).classList.add('is-invalid');
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
    
    // Afficher le modal de succès si la modification a réussi
    <?php if(isset($_SESSION['success'])): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
        
        setTimeout(function() {
            window.location.href = 'listeReservation.php';
        }, 2000);
    <?php endif; ?>
  });
</script>
</body>
</html>