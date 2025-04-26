<?php
session_start();
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';
include 'C:/xampp/htdocs/gestion parking/Model/Reservation.php';

$reservationR = new ReservationR();
$reservation = null;

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
            $_POST["disponibilite"]
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
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/easyparki.png">
  <title>EasyParki - Modifier Reservation</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    :root {
      --primary-dark: #0a1d37;
      --accent-blue: #4da6ff;
    }
    
    body {
      background-color: #f8f9fa !important;
    }
    
    .sidenav {
      background-color: var(--primary-dark) !important;
    }
    
    .sidenav .nav-link,
    .sidenav .nav-link-text,
    .sidenav .navbar-brand span,
    .sidenav .material-symbols-rounded {
      color: white !important;
    }
    
    .navbar-main {
      background-color: var(--primary-dark) !important;
      border-bottom: 2px solid var(--accent-blue) !important;
    }
    
    .form-container {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin: 0 auto;
      max-width: 700px;
      margin-top: 30px;
    }
    
    .bg-gradient-primary {
      background: linear-gradient(195deg, var(--accent-blue), #3a8df1) !important;
    }
    
    .btn-primary {
      background-color: var(--accent-blue) !important;
      border: none;
    }
    
    .btn-primary:hover {
      background-color: #3a8df1 !important;
    }
    
    .error-message {
      color: #dc3545;
      margin-bottom: 15px;
      font-weight: 500;
    }
    
    .form-feedback {
      color: #dc3545;
      font-size: 0.875em;
      margin-top: 5px;
    }
    
    .is-invalid {
      border-color: #dc3545 !important;
    }
    
    .back-button {
      color: var(--accent-blue);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }
    
    .back-button:hover {
      text-decoration: underline;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .form-container {
        padding: 20px;
        margin: 20px 15px;
      }
    }
    
    .spinner-border {
        vertical-align: text-top;
    }
    
    /* Dropdown styles */
    .nav-item.dropdown-menu-container {
      position: relative;
      margin-bottom: 15px;
    }

    .vacances-dropdown, .stationnement-dropdown {
      position: absolute;
      left: 0;
      top: 100%;
      min-width: 100%;
      background: white;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      opacity: 0;
      transform: translateY(-10px);
      visibility: hidden;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      margin-top: 5px;
    }

    .nav-item.dropdown-menu-container:hover .vacances-dropdown,
    .nav-item.dropdown-menu-container:hover .stationnement-dropdown {
      opacity: 1;
      transform: translateY(0);
      visibility: visible;
    }

    .dropdown-item {
      padding: 12px 20px;
      color: var(--primary-dark);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.2s ease;
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .dropdown-item:last-child {
      border-bottom: none;
    }

    .dropdown-item:hover {
      background: rgba(77, 166, 255, 0.08);
      padding-left: 24px;
      color: var(--accent-blue);
    }

    .dropdown-item .material-symbols-rounded {
      font-size: 20px;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="../assets/img/logo.png" class="navbar-brand-img" width="50">
        <span class="ms-1 text-white">EasyParki</span>
      </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a  class="nav-link text-dark"  href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item dropdown-menu-container">
          <a class="nav-link active bg-gradient-primary text-white"  href="javascript:;">
            <span class="nav-link-text ms-1">Stationnement</span>
          </a>
          <div class="stationnement-dropdown">
            <a href="AddParking.php" class="dropdown-item">
              Ajouter un parking
            </a>
            <a href="listeReservation.php" class="dropdown-item">
              Liste des Reservations
            </a>
            <a href="listParking.php" class="dropdown-item">
              Liste des Parking
            </a>
            <a href="historiqueReservation.php" class="dropdown-item">
              Historique des reservations
            </a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/services.php">
            <span class="nav-link-text ms-1">Services</span>
          </a>
        </li>

        <li class="nav-item dropdown-menu-container">
          <a class="nav-link text-dark" href="javascript:;">
            <span class="nav-link-text ms-1">Vacances</span>
          </a>
          <div class="vacances-dropdown">
            <a href="addPlanVacance.php" class="dropdown-item">
              
              Ajouter un plan de vacance
            </a>
            <a href="addHotel.php" class="dropdown-item">
              
              Ajouter un Hotel
            </a>
            <a href="listHotels.php" class="dropdown-item">
              
              List des Hotels
            </a>
            <a href="listPlanVacance.php" class="dropdown-item">
              
              List les Plans de Vacance
            </a>
          </div>
        </li>

        <li class="nav-item" style="margin-top: 10px;">
          <a class="nav-link text-dark" href="../pages/evenement.php">
            <span class="nav-link-text ms-1">Evenement</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/covoiturage.php">
            <span class="nav-link-text ms-1">covoiturage</span>
          </a>
        </li>
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.php">
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-in.php">
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-up.php">
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <a class="btn btn-outline-white mt-4 w-100" href="http://localhost/gestion%20parking/view/front_office/index.php">FrontOffice</a>
      </div>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="form-container">
        <h2 class="mb-4">Modifier une Reservation </h2>
        
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if($reservation): ?>
        <form method="POST" action="UpdateReservation.php" id="reservationForm">
          <input type="hidden" name="ID_Reservation" value="<?= $reservation['ID_Reservation'] ?>">

          <div class="mb-3">
            <label class="form-label">ID Parking :</label>
            <input type="number" class="form-control" name="idParking" id="idParking" 
                value="<?= isset($reservation['idParking']) ? htmlspecialchars($reservation['idParking']) : '' ?>"  required>
            <div class="form-feedback" id="idParkingFeedback"></div>
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
                <div class="form-feedback" id="prolongationFeedback"></div>
          </div>

	  <div class="mb-3">
            <label class="form-label">Mode de Paiement :</label>
            <select class="form-select" name="payment" id="payment" required>
              <option value="">Sélectionner un mode de paiement </option>
              <option value="Carte" > 💳 Carte</option>
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
            <a href="listeReservation.php" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>

        <?php endif; ?>
      </div>
    </div>
  </main>

  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    
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