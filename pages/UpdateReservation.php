<?php
session_start();
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';
include 'C:/xampp/htdocs/gestion parking/Model/Reservation.php';

$reservationR = new ReservationR();
$reservation = null;
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
            $_POST["email"],
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
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    
    .table-responsive {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      padding: 15px;
    }
    
    #transport-tab {
      border: 2px solid var(--accent-blue);
      border-radius: 8px;
      margin-right: 10px;
      padding: 8px 20px;
      background-color: rgba(77, 166, 255, 0.1);
      transition: all 0.3s ease;
    }
    
    #transport-tab.active {
      background-color: var(--accent-blue) !important;
      color: white !important;
    }
    
    #transport-tab:hover:not(.active) {
      background-color: rgba(77, 166, 255, 0.2);
    }
    
    .bg-gradient-primary {
      background: linear-gradient(195deg, var(--accent-blue), #3a8df1) !important;
    }
    
    .btn-primary {
      background-color: var(--accent-blue) !important;
    }
    
    .badge.bg-success {
      background-color: var(--accent-blue) !important;
    }

    /* Updated dropdown styles */
    .nav-item.dropdown-menu-container {
      position: relative;
      margin-bottom: 15px;
    }

    .vacances-dropdown {
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

    .nav-item.dropdown-menu-container:hover .vacances-dropdown {
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

    .nav-item.dropdown-menu-container {
      position: relative;
      margin-bottom: 15px;
    }

    .stationnement-dropdown {
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

    
    /* Sidebar styles */
    .sidenav {
      background: linear-gradient(195deg, var(--primary-dark) 0%, #0c2461 100%) !important;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .sidenav .nav-link,
    .sidenav .nav-link-text,
    .sidenav .navbar-brand span,
    .sidenav .material-symbols-rounded {
      color: white !important;
      transition: all 0.3s ease;
    }
    
    .sidenav .nav-link:hover {
      background-color: rgba(255,255,255,0.1);
      transform: translateX(5px);
    }
    
    /* Submenu styles */
    .nav-item.has-submenu {
      position: relative;
    }
    
    .submenu {
      position: absolute;
      left: 0;
      top: 100%;
      min-width: 220px;
      background: var(--primary-dark);
      border-radius: 8px;
      padding: 10px 0;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      transform: translateY(-10px);
      z-index: 1000;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }
    
    .nav-item.has-submenu:hover .submenu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .submenu-item {
      padding: 12px 20px;
      color: white !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: all 0.2s ease;
    }
    
    .submenu-item:hover {
      background: rgba(255,255,255,0.1);
      padding-left: 25px;
    }
    
    .submenu-item i {
      margin-right: 12px;
      font-size: 18px;
    }

    /* Form container */
    .form-container {
      background: white;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      margin: 30px auto;
      max-width: 700px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }
    
    .form-container h2 {
      color: var(--primary-dark);
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .form-container h2::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 60px;
      height: 4px;
      background: var(--accent-blue);
      border-radius: 2px;
    }
    
    /* Form elements */
    .form-label {
      font-weight: 500;
      color: var(--dark-gray);
      margin-bottom: 8px;
      display: block;
    }
    
    .form-control, .form-select {
      border-radius: 8px;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--accent-blue);
      box-shadow: 0 0 0 3px rgba(77, 166, 255, 0.2);
    }
    
    .form-control.is-invalid {
      border: 1px solid var(--accent-red) !important;
    }
    
    .form-control.is-valid {
      border: 1px solid var(--accent-green) !important;
    }
    
    /* Buttons */
    .btn {
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 500;
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
    }
    
    .btn-primary {
      background-color: var(--accent-blue);
      border-color: var(--accent-blue);
    }
    
    .btn-primary:hover {
      background-color: #3a8de0;
      border-color: #3a8de0;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(77, 166, 255, 0.3);
    }
    
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #5a6268;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }
    
    /* Feedback messages */
    .error-message {
      color: var(--accent-red);
      margin-bottom: 20px;
      padding: 12px;
      background-color: rgba(244, 67, 54, 0.1);
      border-radius: 8px;
      border-left: 4px solid var(--accent-red);
      animation: fadeIn 0.5s ease;
    }
    
    .success-message {
      color: var(--accent-green);
      margin-bottom: 20px;
      padding: 12px;
      background-color: rgba(76, 175, 80, 0.1);
      border-radius: 8px;
      border-left: 4px solid var(--accent-green);
      animation: fadeIn 0.5s ease;
    }
    
    .form-feedback {
      font-size: 0.875rem;
      margin-top: 0.25rem;
      height: 20px;
      animation: fadeIn 0.3s ease;
    }
    
    .form-feedback.error {
      color: var(--accent-red);
    }
    
    .form-feedback.success {
      color: var(--accent-green);
    }
    
    
    
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes modalFadeIn {
      from { opacity: 0; transform: translateY(-20px) scale(0.95); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    
    /* Floating animation for success elements */
    .floating {
      animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
    
    /* Input focus effect */
    .input-group {
      position: relative;
      margin-bottom: 25px;
    }
    
    .input-group label {
      position: absolute;
      top: -10px;
      left: 15px;
      background: white;
      padding: 0 5px;
      font-size: 0.8rem;
      color: var(--accent-blue);
      font-weight: 500;
      z-index: 1;
      opacity: 0;
      transition: all 0.3s ease;
    }
    
    .form-control:focus ~ label {
      opacity: 1;
      transform: translateY(0);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .form-container {
        padding: 20px;
        margin: 20px 15px;
      }
      
      .modal-buttons {
        flex-direction: column;
      }
      
      .btn {
        width: 100%;
        margin-bottom: 10px;
      }
    }
    
    /* Custom checkbox and radio */
    .form-check-input:checked {
      background-color: var(--accent-blue);
      border-color: var(--accent-blue);
    }
    
    /* Star rating for category */
    .star-rating {
      display: flex;
      gap: 5px;
      margin-top: 5px;
    }
    
    .star-rating i {
      color: #ddd;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .star-rating i.active {
      color: #ffc107;
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
      <a class="navbar-brand px-4 py-3 m-0" href="tables.php">
        <img src="../assets/img/logo.png" class="navbar-brand-img floating" width="50">
        <span class="ms-1 text-white">EasyParki</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item has-submenu">
          <a class="nav-link active" href="javascript:;" style="background: linear-gradient(87deg, #1e3c72 0%, #2a5298 100%);">
            <i class="material-symbols-rounded opacity-5">directions_bus</i>
            <span class="nav-link-text ms-1">Stationnement</span>
          </a>
          <div class="submenu">
            <a href="AddParking.php" class="submenu-item">
            <i class="fas fa-parking"></i>              
            Ajouter un Parking
            </a>
            <a href="AddReservation.php" class="submenu-item">
              <i class="fas fa-calendar-plus"></i>
              Ajouter une Reservation
            </a>
            <a href="listParking.php" class="submenu-item">
              <i class="fas fa-list"></i>
              Liste des Parkings
            </a>
            <a href="listeReservation.php" class="submenu-item">
              <i class="fas fa-clipboard-list"></i>
              Liste des Reservations
            </a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../pages/vacances.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Vacances</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="../pages/covoiturage.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/services.php">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Service</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/evenement.php">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">Evenement</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/notifications.php">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <a class="btn btn-outline-white mt-4 w-100" href=http://localhost/gestion%20parking/view/front_office/index.php>FrontOffice</a>
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
               value="<?= htmlspecialchars($reservation['idClient']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nom du Client :</label>
        <input type="text" class="form-control" name="nom_client" id="nom_client" 
               value="<?= htmlspecialchars($reservation['nom_client']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Horaire du début :</label>
        <input type="time" class="form-control" name="horaire_d" id="horaire_d" 
               value="<?= htmlspecialchars($reservation['horaire_d']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Horaire de la fin :</label>
        <input type="time" class="form-control" name="horaire_f" id="horaire_f" 
               value="<?= htmlspecialchars($reservation['horaire_f']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Statut :</label>
        <select class="form-select" name="statut" id="statut" required>
            <option value="">Sélectionner un statut</option>
            <option value="Confirmée" <?= $reservation['statut'] == 'Confirmée' ? 'selected' : '' ?>>✅ Confirmée</option>
            <option value="En attente" <?= $reservation['statut'] == 'En attente' ? 'selected' : '' ?>>⏳ En attente</option>
            <option value="Annulée" <?= $reservation['statut'] == 'Annulée' ? 'selected' : '' ?>>❌ Annulée</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Type de Prolongation :</label>
        <select class="form-select" name="prolongation" id="prolongation" required>
            <option value="">Sélectionner une prolongation</option>
            <option value="Mensuel" <?= $reservation['prolongation'] == 'Mensuel' ? 'selected' : '' ?>>🔁 Oui</option>
            <option value="Annuel" <?= $reservation['prolongation'] == 'Annuel' ? 'selected' : '' ?>>⛔ Non</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Mode de Paiement :</label>
        <select class="form-select" name="payment" id="payment" required>
            <option value="">Sélectionner un mode de paiement</option>
            <option value="Carte" <?= $reservation['payment'] == 'Carte' ? 'selected' : '' ?>>💳 Carte</option>
            <option value="Espèces" <?= $reservation['payment'] == 'Espèces' ? 'selected' : '' ?>>💵 Espèces</option>
            <option value="Mobile" <?= $reservation['payment'] == 'Mobile' ? 'selected' : '' ?>>📱 Mobile</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Disponibilité :</label>
        <input type="number" class="form-control" name="disponibilite" id="disponibilite" 
               value="<?= htmlspecialchars($reservation['disponibilite']) ?>" required>
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

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</body>
</html>