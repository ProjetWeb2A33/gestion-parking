<?php
session_start();
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';
include 'C:/xampp/htdocs/gestion parking/Model/Parking.php';

$parkingP = new ParkingP();
$parking = null;

// Vérifier si l'ID est passé dans l'URL (GET) pour afficher les données existantes
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_Parking'])) {
    $id = $_GET['ID_Parking'];
    $parking = $parkingP->getParkingById($id);

    if (!$parking) {
        $_SESSION['error'] = "Parking introuvable.";
        header("Location: listParking.php");
        exit();
    }
}

// Traitement de la soumission du formulaire (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si tous les champs sont présents
    $requiredFields = [
        'ID_Parking', 'Nom_Parking', 'Adresse_Parking', 
        'Capacite_Totale', 'Nombre_Dispo', 'Horaire_Ouv',
        'Horaire_Ferm', 'Abonnement', 'Tarification'
    ];

    $missingFields = array_diff($requiredFields, array_keys($_POST));

    if (!empty($missingFields)) {
        $_SESSION['error'] = "Champs manquants : " . implode(', ', $missingFields);
        header("Location: updateParking.php?ID_Parking=" . $_POST['ID_Parking']);
        exit();
    }

    try {
        $parkingObj = new Parking(
            $_POST["Nom_Parking"],
            $_POST["Adresse_Parking"],
            $_POST["Capacite_Totale"],
            $_POST["Nombre_Dispo"],
            $_POST["Horaire_Ouv"],
            $_POST["Horaire_Ferm"],
            $_POST["Abonnement"],
            $_POST["Tarification"]
        );

        if ($parkingP->UpdateParking($_POST['ID_Parking'], $parkingObj)) {
            $_SESSION['success'] = "Parking modifié avec succès.";
            header("Location: listParking.php");
            exit();
        } else {
            throw new Exception("La mise à jour a échoué.");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Erreur : " . $e->getMessage();
        header("Location: updateParking.php?ID_Parking=" . $_POST['ID_Parking']);
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
  <title>EasyParki - Modifier Parking</title>
  
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
          <a class="nav-link active bg-gradient-primary text-white" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item dropdown-menu-container">
          <a class="nav-link text-dark" href="javascript:;">
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
              <span class="material-symbols-rounded">add_circle</span>
              Ajouter un plan de vacance
            </a>
            <a href="addHotel.php" class="dropdown-item">
              <span class="material-symbols-rounded">hotel</span>
              Ajouter un Hotel
            </a>
            <a href="listHotels.php" class="dropdown-item">
              <span class="material-symbols-rounded">list</span>
              List des Hotels
            </a>
            <a href="listPlanVacance.php" class="dropdown-item">
              <span class="material-symbols-rounded">calendar_month</span>
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
        <h2 class="mb-4">Modifier un Parking</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if($parking): ?>
        <form method="POST" action="updateParking.php" id="parkingForm">
          <input type="hidden" name="ID_Parking" value="<?= $parking['ID_Parking'] ?>">

          <div class="mb-3">
            <label class="form-label">Nom du Parking :</label>
            <input type="text" class="form-control" name="Nom_Parking" id="Nom_Parking" 
                   value="<?= htmlspecialchars($parking['Nom_Parking']) ?>" required>
            <div class="form-feedback" id="Nom_ParkingFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Adresse :</label>
            <input type="text" class="form-control" name="Adresse_Parking" id="Adresse_Parking" 
                   value="<?= htmlspecialchars($parking['Adresse_Parking']) ?>" required>
            <div class="form-feedback" id="Adresse_ParkingFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Capacité Totale :</label>
            <input type="number" class="form-control" name="Capacite_Totale" id="Capacite_Totale" 
                   value="<?= htmlspecialchars($parking['Capacite_Totale']) ?>" min="20" required>
            <div class="form-feedback" id="Capacite_TotaleFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Nombre de Places Disponibles :</label>
            <input type="number" class="form-control" name="Nombre_Dispo" id="Nombre_Dispo" 
                   value="<?= htmlspecialchars($parking['Nombre_Dispo']) ?>" required>
            <div class="form-feedback" id="Nombre_DispoFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Horaire d'Ouverture :</label>
            <input type="number" class="form-control" name="Horaire_Ouv" id="Horaire_Ouv" 
                   value="<?= htmlspecialchars($parking['Horaire_Ouv']) ?>" min="0" max="23" required>
            <div class="form-feedback" id="Horaire_OuvFeedback"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Horaire de Fermeture :</label>
            <input type="number" class="form-control" name="Horaire_Ferm" id="Horaire_Ferm" 
                   value="<?= htmlspecialchars($parking['Horaire_Ferm']) ?>" min="0" max="23" required>
            <div class="form-feedback" id="Horaire_FermFeedback"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Type d'Abonnement :</label>
            <select class="form-select" name="Abonnement" id="Abonnement" required>
              <option value="">Sélectionner un abonnement</option>
              <option value="Mensuel" <?= $parking['Abonnement'] == 'Mensuel' ? 'selected' : '' ?>>💼 Mensuel</option>
              <option value="Annuel" <?= $parking['Abonnement'] == 'Annuel' ? 'selected' : '' ?>>🌟 Annuel</option>
              <option value="Premium" <?= $parking['Abonnement'] == 'Premium' ? 'selected' : '' ?>>👑 Premium</option>
            </select>
            <div class="form-feedback" id="AbonnementFeedback"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tarification :</label>
            <select class="form-select" name="Tarification" id="Tarification" required>
              <option value="">Sélectionner une tarification</option>
              <option value="Place basique" <?= $parking['Tarification'] == 'Place basique' ? 'selected' : '' ?>>🅿️ Place basique</option>
              <option value="Place Services véhicules" <?= $parking['Tarification'] == 'Place Services véhicules' ? 'selected' : '' ?>>🔌 Place Services véhicules</option>
              <option value="Place Événementielle" <?= $parking['Tarification'] == 'Place Événementielle' ? 'selected' : '' ?>>🎉 Place Événementielle</option>
            </select>
            <div class="form-feedback" id="TarificationFeedback"></div>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="listParking.php" class="btn btn-secondary">Annuler</a>
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
    const form = document.getElementById('parkingForm');
    
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
        const nomParking = document.getElementById('Nom_Parking').value.trim();
        const adresseParking = document.getElementById('Adresse_Parking').value.trim();
        const capaciteTotale = parseInt(document.getElementById('Capacite_Totale').value);
        const nombreDispo = parseInt(document.getElementById('Nombre_Dispo').value);
        const horaireOuv = parseInt(document.getElementById('Horaire_Ouv').value);
        const horaireFerm = parseInt(document.getElementById('Horaire_Ferm').value);
        const abonnement = document.getElementById('Abonnement').value;
        const tarification = document.getElementById('Tarification').value;
        
        // Validation des champs
        const validations = [
            {
                condition: !nomParking.toLowerCase().startsWith('parking'),
                element: 'Nom_Parking',
                message: "Le nom doit commencer par 'Parking'"
            },
            {
                condition: /\d/.test(adresseParking),
                element: 'Adresse_Parking',
                message: "L'adresse ne doit pas contenir de chiffres"
            },
            {
                condition: isNaN(capaciteTotale) || capaciteTotale < 20,
                element: 'Capacite_Totale',
                message: "La capacité doit être d'au moins 20 places"
            },
            {
                condition: isNaN(nombreDispo) || nombreDispo > capaciteTotale,
                element: 'Nombre_Dispo',
                message: "Le nombre de places disponibles doit être inférieur ou égal à la capacité totale"
            },
            {
                condition: isNaN(horaireOuv) || horaireOuv < 0 || horaireOuv > 23,
                element: 'Horaire_Ouv',
                message: "L'horaire d'ouverture doit être entre 0 et 23"
            },
            {
                condition: isNaN(horaireFerm) || horaireFerm < 0 || horaireFerm > 23,
                element: 'Horaire_Ferm',
                message: "L'horaire de fermeture doit être entre 0 et 23"
            },
            {
                condition: horaireFerm <= horaireOuv,
                element: 'Horaire_Ferm',
                message: "L'heure de fermeture doit être après l'heure d'ouverture"
            },
            {
                condition: !abonnement,
                element: 'Abonnement',
                message: "Veuillez sélectionner un type d'abonnement"
            },
            {
                condition: !tarification,
                element: 'Tarification',
                message: "Veuillez sélectionner une tarification"
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
            window.location.href = 'listParking.php';
        }, 2000);
    <?php endif; ?>
  });
</script>
</body>
</html>