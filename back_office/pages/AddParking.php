<?php 
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';
include 'C:/xampp/htdocs/gestion parking/Model/Parking.php';

$error = "";
$success = "";
$parkingP = new ParkingP();

if (
    isset($_POST["Nom_Parking"]) &&
    isset($_POST["Adresse_Parking"]) &&
    isset($_POST["Capacite_Totale"]) &&
    isset($_POST["Nombre_Dispo"]) &&
    isset($_POST["Horaire_Ouv"]) &&
    isset($_POST["Horaire_Ferm"]) &&
    isset($_POST["Abonnement"]) &&
    isset($_POST["Tarification"])
) {
    if (
        !empty($_POST["Nom_Parking"]) &&
        !empty($_POST["Adresse_Parking"]) &&
        !empty($_POST["Capacite_Totale"]) &&
        !empty($_POST["Nombre_Dispo"]) &&
        !empty($_POST["Horaire_Ouv"]) &&
        !empty($_POST["Horaire_Ferm"]) &&
        !empty($_POST["Abonnement"]) &&
        !empty($_POST["Tarification"])
    ) {
        $parking = new Parking(
            $_POST["Nom_Parking"],
            $_POST["Adresse_Parking"],
            $_POST["Capacite_Totale"],
            $_POST["Nombre_Dispo"],
            $_POST["Horaire_Ouv"],
            $_POST["Horaire_Ferm"],
            $_POST["Abonnement"],
            $_POST["Tarification"]
        );
        $parkingP->AjouterParking($parking);
        $success = "Le parking a été ajouté avec succès!";
        // On ne redirige plus immédiatement, on affiche le modal de succès
    } else {
        $error = "Tous les champs sont obligatoires.";
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
  <title>EasyParki - Dashboard</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <title>Ajouter un Parking</title>

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
    /* Style pour le modal de confirmation */
    .confirmation-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        width: 400px;
        max-width: 90%;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
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

            <a class="nav-link text-dark" href="../pages/dashboard.php">
                <i class="material-symbols-rounded opacity-5">dashboard</i>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>

        </li>


        <li class="nav-item dropdown-menu-container">
          <a class="nav-link active bg-gradient-primary text-white" href="javascript:;">
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
            <a class="nav-link text-dark"href="javascript:;">
            
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
        <h2 class="mb-4">Ajouter un Parking</h2>
        <?php if($error): ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" id="ParkingForm">
          <div class="mb-3">
            <label class="form-label">Nom du Parking :</label>
            <input type="text" class="form-control" name="Nom_Parking" id="Nom_Parking" required>
            <div class="form-feedback" id="Nom_ParkingFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Adresse :</label>
            <input type="text" class="form-control" name="Adresse_Parking" id="Adresse_Parking" required>
            <div class="form-feedback" id="Adresse_ParkingFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Capacité Totale :</label>
            <input type="number" class="form-control" name="Capacite_Totale" id="Capacite_Totale" min="20" required>
            <div class="form-feedback" id="Capacite_TotaleFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Nombre de Places Disponibles :</label>
            <input type="number" class="form-control" name="Nombre_Dispo" id="Nombre_Dispo" required>
            <div class="form-feedback" id="Nombre_DispoFeedback"></div>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Horaire d'Ouverture :</label>
            <input type="number" class="form-control" name="Horaire_Ouv" id="Horaire_Ouv" min="0" max="23" required>
            <div class="form-feedback" id="Horaire_OuvFeedback"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Horaire de Fermeture :</label>
            <input type="number" class="form-control" name="Horaire_Ferm" id="Horaire_Ferm" min="0" max="23" required>
            <div class="form-feedback" id="Horaire_FermFeedback"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Type d'Abonnement :</label>
            <select class="form-select" name="Abonnement" id="Abonnement" required>
              <option value="">Sélectionner un abonnement</option>
              <option value="Mensuel">💼 Mensuel</option>
              <option value="Annuel">🌟 Annuel</option>
              <option value="Premium">👑 Premium</option>
            </select>
            <div class="form-feedback" id="AbonnementFeedback"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tarification :</label>
            <select class="form-select" name="Tarification" id="Tarification" required>
              <option value="">Sélectionner une tarification</option>
              <option value="Place basique">🅿️ Place basique</option>
              <option value="Place Services véhicules">🔌 Place Services véhicules</option>
              <option value="Place Événementielle">🎉 Place Événementielle</option>
            </select>
            <div class="form-feedback" id="TarificationFeedback"></div>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <a href="listParking.php" class="btn btn-secondary">Liste des Parkings</a>
            <button type="button" class="btn btn-primary" id="submitBtn">Ajouter</button>
            <a href="dashboard.php" class="btn btn-outline-primary">Retour au Dashboard</a>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Modal de confirmation -->
  <div class="confirmation-modal" id="confirmationModal">
      <div class="modal-content">
          <h3>Confirmer l'ajout</h3>
          <div class="mb-3">
              <p><strong>Nom:</strong> <span id="modalNom"></span></p>
              <p><strong>Adresse:</strong> <span id="modalAdresse"></span></p>
              <p><strong>Capacité:</strong> <span id="modalCapacite"></span> places</p>
              <p><strong>Places disponibles:</strong> <span id="modalDispo"></span></p>
              <p><strong>Horaires:</strong> <span id="modalHoraire"></span></p>
              <p><strong>Abonnement:</strong> <span id="modalAbonnement"></span></p>
              <p><strong>Tarification:</strong> <span id="modalTarification"></span></p>
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
          z-index: 1050;
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
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='listParking.php'">OK</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ParkingForm');
    const submitBtn = document.getElementById('submitBtn');
    const confirmationModal = document.getElementById('confirmationModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    
    // Empêcher la soumission directe du formulaire
    submitBtn.type = 'button';
    
    // Afficher le modal de confirmation au clic sur le bouton Ajouter
    submitBtn.addEventListener('click', function() {
        if (validateForm()) {
            // Remplir le modal avec les données du formulaire
            document.getElementById('modalNom').textContent = document.getElementById('Nom_Parking').value;
            document.getElementById('modalAdresse').textContent = document.getElementById('Adresse_Parking').value;
            document.getElementById('modalCapacite').textContent = document.getElementById('Capacite_Totale').value;
            document.getElementById('modalDispo').textContent = document.getElementById('Nombre_Dispo').value;
            document.getElementById('modalHoraire').textContent = 
                document.getElementById('Horaire_Ouv').value + 'h - ' + 
                document.getElementById('Horaire_Ferm').value + 'h';
            document.getElementById('modalAbonnement').textContent = document.getElementById('Abonnement').value;
            document.getElementById('modalTarification').textContent = document.getElementById('Tarification').value;
            
            confirmationModal.style.display = 'flex';
        }
    });
    
    // Annuler l'ajout
    cancelBtn.addEventListener('click', function() {
        confirmationModal.style.display = 'none';
    });
    
    // Confirmer l'ajout
    confirmBtn.addEventListener('click', function() {
        confirmationModal.style.display = 'none';
        // Afficher un indicateur de chargement
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';
        submitBtn.disabled = true;
        
        // Soumettre le formulaire
        form.submit();
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
    
    // Afficher le modal de succès si l'ajout a réussi
    <?php if($success): ?>
        // Créer un modal de succès dynamiquement
        const successModalHTML = `
            <div class="confirmation-modal" style="display: flex;">
                <div class="modal-content">
                    <h3>Succès</h3>
                    <p><?php echo $success; ?></p>
                    <div class="modal-buttons">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='listParking.php'">OK</button>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', successModalHTML);
        
        // Fermer le modal après 3 secondes
        setTimeout(() => {
            const modal = document.querySelector('.confirmation-modal');
            if (modal) modal.style.display = 'none';
            window.location.href = 'listParking.php';
        }, 3000);
    <?php endif; ?>
  });
</script>
</body>
</html>