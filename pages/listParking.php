<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

$c = new ParkingP();
// $tab = $c->ListeParking();
$parkingsActifs = $c->getParkingsActifs();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  <title>EasyParki - Liste Des Parkings </title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- Pour le pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
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
    
    /* Modal styles */
    .confirmation-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1050;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
    }
    
    .confirmation-modal.active {
      opacity: 1;
      visibility: visible;
    }
    
    .modal-content {
      background: white;
      border-radius: 16px;
      padding: 30px;
      width: 450px;
      max-width: 90%;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      text-align: center;
      transform: scale(0.9);
      transition: transform 0.3s ease;
      animation: modalFadeIn 0.4s ease forwards;
    }
    
    .confirmation-modal.active .modal-content {
      transform: scale(1);
    }
    
    .modal-content h3 {
      color: var(--primary-dark);
      margin-bottom: 20px;
      font-weight: 600;
    }
    
    .modal-content p {
      color: #555;
      margin-bottom: 25px;
    }
    
    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
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
        /* Styles pour les boutons */
    .btn {
        border-radius: 6px; /* Coins légèrement arrondis */
        padding: 6px 12px; /* Réduction de la taille des boutons */
        font-size: 14px; /* Taille de texte plus petite */
        font-weight: 500; /* Texte légèrement en gras */
        transition: all 0.3s ease; /* Animation fluide */
        letter-spacing: 0.5px; /* Espacement des lettres */
    }

    /* Couleur principale pour les boutons */
    .btn-primary {
        background-color: #4da6ff; /* Bleu clair */
        border-color: #4da6ff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #3a8de0; /* Bleu plus foncé au survol */
        border-color: #3a8de0;
        transform: translateY(-2px); /* Légère élévation au survol */
        box-shadow: 0 4px 12px rgba(77, 166, 255, 0.3); /* Ombre */
    }

    /* Couleur secondaire pour les boutons */
    .btn-secondary {
        background-color: #6c757d; /* Gris */
        border-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Gris plus foncé au survol */
        border-color: #5a6268;
        transform: translateY(-2px); /* Légère élévation au survol */
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3); /* Ombre */
    }

    /* Bouton PDF */
    .btn-export-pdf {
        background: linear-gradient(135deg, rgb(0, 162, 255), rgb(0, 162, 255)); /* Dégradé bleu */
        color: white;
        border: none;
        font-weight: bold;
        padding: 6px 12px; /* Taille réduite */
        font-size: 14px; /* Texte plus petit */
        border-radius: 6px; /* Coins arrondis */
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-export-pdf:hover {
        background: linear-gradient(135deg, rgb(0, 142, 235), rgb(0, 142, 235)); /* Couleur légèrement plus foncée au survol */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px); /* Légère élévation */
    }

    .btn-export-pdf:active {
        transform: translateY(0); /* Réinitialise l'élévation au clic */
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
    }

  </style>

</head>

<body class="g-sidenav-show bg-gray-100">
  
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
            <a href="historiqueParking.php" class="submenu-item">
              <i class="fas fa-clipboard-list"></i>
              Historiques des Reservations
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
      <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Liste Des Parkings</h2>
            <?php if (count($parkingsActifs) > 0): ?>
            <a href="AddParking.php" class="btn btn-primary">
              <i class="fas fa-plus me-2"></i>Ajouter un Parking
            </a>
              <div class="button-container d-flex justify-content-center gap-3 mt-4">
              <button id="sortByNameBtn" class="btn btn-primary">
                  <i class="fas fa-sort-alpha-down me-1"></i> Trier par Nom
              </button>
              <div class="input-group" style="max-width: 300px;">
                  <input type="text" id="searchByIdInput" class="form-control" placeholder="Rechercher par ID">
                  <button id="searchByIdBtn" class="btn btn-secondary">
                      <i class="fas fa-search me-1"></i> Rechercher
                  </button>
              </div>
              <button onclick="exportToPDF()" class="btn btn-export-pdf">
                  <i class="fas fa-file-pdf me-1"></i> Exporter en PDF
              </button>
          </div>

          
        </div>
        
          </div>
        </div>

        
        <table id="parkingTable" class="table table-striped align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom Parking</th>
            <th>Adresse</th>
            <th>Capacité</th>
            <th>Nombre Disponible</th>
            <th>Horaire Ouverture</th>
            <th>Horaire Fermeture</th>
            <th>Abonnement</th>
            <th>Tarification</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($parkingsActifs as $parking): ?>
      <tr>
            <td><?= $parking['ID_Parking'] ?></td>
            <td><?= $parking['Nom_Parking'] ?></td>
            <td>
              <i class="fas fa-map-marker-alt" style="color:rgb(7, 3, 113); margin-right: 5px;"></i>
              <span style="color:rgb(7, 3, 113); font-weight: bold;"><?= $parking['Adresse_Parking'] ?></span>
            </td>
            <td><?= $parking['Capacite_Totale'] ?></td>
            <td><?= $parking['Nombre_Dispo'] ?></td>
            <td><?= $parking['Horaire_Ouv'] ?></td>
            <td><?= $parking['Horaire_Ferm'] ?></td>
            <td><?= $parking['Abonnement'] ?></td>
            <td><?= $parking['Tarification'] ?></td>
            <td>
            <div class="d-flex gap-2">
                <a href="UpdateParking.php?ID_Parking=<?= $parking['ID_Parking'] ?>" 
                   onclick="confirmModify(event, <?= $parking['ID_Parking'] ?>)" 
                   class="btn btn-sm btn-primary">
                   <i class="fas fa-edit"></i> Modifier
                </a>
                <a href="DeleteParking.php?ID_Parking=<?= $parking['ID_Parking'] ?>" 
                   onclick="confirmDelete(event, <?= $parking['ID_Parking'] ?>)" 
                   class="btn btn-sm btn-danger">
                   <i class="fas fa-trash"></i> Supprimer
                </a>
            </div>
        </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<?php else: ?>
  <p>Aucun parking actif trouvé.</p>
  <?php endif; ?>
      </div>
    </div>
  </main>
  
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  <script>
    
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
                <p>Êtes-vous sûr de vouloir modifier ce parking ?</p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
                    <button onclick="this.closest('.modal-overlay').remove()" 
                            class="btn btn-secondary" 
                            style="padding: 8px 20px">
                        Annuler
                    </button>
                    <a href="UpdateParking.php?ID_Parking=${id}" 
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
                <p>Êtes-vous sûr de vouloir supprimer ce parking ?</p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
                    <button onclick="this.closest('.modal-overlay').remove()" 
                            class="btn btn-secondary" 
                            style="padding: 8px 20px">
                        Annuler
                    </button>
                    <a href="DeleteParking.php?ID_Parking=${id}" 
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

function exportToPDF() {
    const btn = event.target;
    const originalHtml = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Génération...';
    btn.disabled = true;

    setTimeout(() => {
        try {
            const jsPDF = window.jspdf.jsPDF; // Correctly access jsPDF
            const doc = new jsPDF({
                orientation: 'landscape'
            });

            // Titre
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(18);
            doc.setTextColor(10, 29, 55);
            doc.text('Liste des Parkings - EasyParki', 14, 20);

            // Date
            doc.setFont('helvetica', 'normal');
            doc.setFontSize(10);
            doc.text('Généré le: ' + new Date().toLocaleDateString(), 14, 28);

            // Préparation des données
            const headers = [
                "ID", 
                "Nom Parking", 
                "Adresse", 
                "Capacité", 
                "Nombre Disponible", 
                "Horaire Ouverture", 
                "Horaire Fermeture", 
                "Abonnement", 
                "Tarification"
            ];

            // Récupération des données depuis le tableau HTML
            const table = document.getElementById('parkingTable');
            if (!table) {
                throw new Error("Le tableau avec l'ID 'parkingTable' est introuvable.");
            }

            const rows = [];
            for (let i = 1; i < table.rows.length; i++) {
                const row = table.rows[i];
                const rowData = [];
                for (let j = 0; j < row.cells.length; j++) {
                    rowData.push(row.cells[j].textContent.trim());
                }
                rows.push(rowData);
            }

            // Génération du PDF
            doc.autoTable({
                head: [headers],
                body: rows,
                startY: 35,
                margin: { left: 14 },
                styles: { 
                    fontSize: 8,
                    cellPadding: 3,
                    overflow: 'linebreak'
                },
                headStyles: { 
                    fillColor: [10, 29, 55],
                    textColor: 255,
                    fontStyle: 'bold'
                },
                alternateRowStyles: {
                    fillColor: [240, 240, 240]
                },
                columnStyles: {
                    0: { cellWidth: 20 },
                    1: { cellWidth: 30 },
                    2: { cellWidth: 40 },
                    3: { cellWidth: 20 },
                    4: { cellWidth: 25 },
                    5: { cellWidth: 30 },
                    6: { cellWidth: 30 },
                    7: { cellWidth: 25 },
                    8: { cellWidth: 25 }
                }
            });

            // Sauvegarde
            doc.save('parkings_easyparki_' + new Date().toISOString().slice(0, 10) + '.pdf');

        } catch (error) {
            console.error("Erreur PDF:", error);
            alert("Erreur lors de la génération du PDF : " + error.message);
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    }, 100);
}

// Sorting by Name
document.getElementById('sortByNameBtn').addEventListener('click', () => {
    const table = document.getElementById('parkingTable');
    const rows = Array.from(table.querySelectorAll('tbody tr'));

    rows.sort((a, b) => {
        const nameA = a.cells[1].textContent.trim().toLowerCase();
        const nameB = b.cells[1].textContent.trim().toLowerCase();
        return nameA.localeCompare(nameB);
    });

    const tbody = table.querySelector('tbody');
    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
});

// Search by ID
document.getElementById('searchByIdBtn').addEventListener('click', () => {
    const searchValue = document.getElementById('searchByIdInput').value.trim();
    const table = document.getElementById('parkingTable');
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const idCell = row.cells[0].textContent.trim();
        if (idCell === searchValue) {
            row.style.display = ''; // Show matching row
        } else {
            row.style.display = 'none'; // Hide non-matching rows
        }
    });

    if (!searchValue) {
        rows.forEach(row => row.style.display = ''); // Show all rows if input is empty
    }
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

                             
                                                                                     
