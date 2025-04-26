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

// Vérifier si l'ID est passé dans l'URL
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_Reservation'])) {
    $id = $_GET['ID_Reservation'];
    $reservation = $reservationR->getReservationById($id);

    if (!$reservation) {
        $_SESSION['error'] = "Réservation introuvable.";
        header("Location: listeReservation.php");
        exit();
    }
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

// Récupérer les messages de session
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
?> 
<html>

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
            <li><a href="index.php">Home<br></a></li>
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

  <div class="page-title dark-background" data-aos="fade" style="background-image: url(\assets\img\parking.jpg);">
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

    <div class="form-container">
        <div class="form-box">
            <h2 class="mb-4">Modifier une Réservation</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if ($reservation): ?>
                <form method="POST" action="UpdateReservation.php">
                    <input type="hidden" name="ID_Reservation" value="<?php echo $reservation['ID_Reservation']; ?>">

                    <div class="mb-3">
                        <label class="form-label">ID Parking :</label>
                        <input type="number" class="form-control" name="idParking" value="<?php echo htmlspecialchars($reservation['idParking']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Client :</label>
                        <input type="number" class="form-control" name="idClient" value="<?php echo htmlspecialchars($reservation['idClient']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nom Client :</label>
                        <input type="text" class="form-control" name="nom_client" value="<?php echo htmlspecialchars($reservation['nom_client']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Horaire Début :</label>
                        <input type="time" class="form-control" name="horaire_d" value="<?php echo htmlspecialchars($reservation['horaire_d']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Horaire Fin :</label>
                        <input type="time" class="form-control" name="horaire_f" value="<?php echo htmlspecialchars($reservation['horaire_f']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Statut :</label>
                        <select class="form-select" name="statut" required>
                            <option value="Confirmée" <?php echo ($reservation['statut'] == 'Confirmée') ? 'selected' : ''; ?>>Confirmée</option>
                            <option value="En attente" <?php echo ($reservation['statut'] == 'En attente') ? 'selected' : ''; ?>>En attente</option>
                            <option value="Annulée" <?php echo ($reservation['statut'] == 'Annulée') ? 'selected' : ''; ?>>Annulée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prolongation :</label>
                        <select class="form-select" name="prolongation" required>
                            <option value="Oui" <?php echo ($reservation['prolongation'] == 'Oui') ? 'selected' : ''; ?>>Oui</option>
                            <option value="Non" <?php echo ($reservation['prolongation'] == 'Non') ? 'selected' : ''; ?>>Non</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mode de Paiement :</label>
                        <select class="form-select" name="payment" required>
                            <option value="Carte" <?php echo ($reservation['payment'] == 'Carte') ? 'selected' : ''; ?>>Carte</option>
                            <option value="Espèces" <?php echo ($reservation['payment'] == 'Espèces') ? 'selected' : ''; ?>>Espèces</option>
                            <option value="Mobile" <?php echo ($reservation['payment'] == 'Mobile') ? 'selected' : ''; ?>>Mobile</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Disponibilité :</label>
                        <input type="number" class="form-control" name="disponibilite" 
                        value="<?php echo htmlspecialchars($reservation['disponibilite']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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

        <?php if($success): ?>
        <div class="confirmation-modal" style="display: flex;">
            <div class="modal-content">
                <h3>Succès</h3>
                <p><?php echo $success; ?></p>
                <div class="modal-buttons">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='listeReservation.php'">OK</button>
                </div>
            </div>
        </div>
        <?php endif; ?>
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

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reservationForm');
        const submitBtn = document.getElementById('submitBtn');
        const confirmationModal = document.getElementById('confirmationModal');
        
        if (!form || !submitBtn || !confirmationModal) {
            console.error("Required elements not found!");
            return;
        }

        submitBtn.addEventListener('click', function(e) {
            if (validateForm()) {
                // Remplir le modal avec les données du formulaire
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
            }
        });

        document.getElementById('cancelBtn').addEventListener('click', function() {
            confirmationModal.style.display = 'none';
        });

        document.getElementById('confirmBtn').addEventListener('click', function() {
            confirmationModal.style.display = 'none';
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';
            submitBtn.disabled = true;
            form.submit();
        });

        function validateForm() {
            let isValid = true;
            const errorMessages = [];
            
            // Effacer les erreurs précédentes
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            
            // Récupération des valeurs
            const idParking = document.getElementById('idParking').value;
            const idClient = document.getElementById('idClient').value;
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
                    condition: !/^\d+$/.test(idParking),
                    element: 'idParking',
                    message: "L'ID Parking doit être un nombre"
                },
                {
                    condition: !/^\d+$/.test(idClient),
                    element: 'idClient',
                    message: "L'ID Client doit être un nombre"
                },
                {
                    condition: !nom_client || /\d/.test(nom_client),
                    element: 'nom_client',
                    message: "Le nom ne doit pas contenir de chiffres"
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
                    condition: horaire_d && horaire_f && new Date('1970-01-01T' + horaire_f + ':00') <= new Date('1970-01-01T' + horaire_d + ':00'),
                    element: 'horaire_f',
                    message: "L'heure de fin doit être après l'heure de début"
                },
                {
                    condition: !statut,
                    element: 'statut',
                    message: "Veuillez sélectionner un statut"
                },
                {
                    condition: !prolongation,
                    element: 'prolongation',
                    message: "Veuillez sélectionner une option de prolongation"
                },
                {
                    condition: !payment,
                    element: 'payment',
                    message: "Veuillez sélectionner un mode de paiement"
                },
                {
                    condition: !disponibilite || isNaN(disponibilite),
                    element: 'disponibilite',
                    message: "Veuillez entrer une disponibilité valide"
                }
            ];
            
            // Appliquer les validations
            validations.forEach(validation => {
                if (validation.condition) {
                    const field = document.getElementById(validation.element);
                    const feedback = document.getElementById(validation.element + 'Feedback');
                    
                    if (field) field.classList.add('is-invalid');
                    if (feedback) feedback.textContent = validation.message;
                    
                    isValid = false;
                    errorMessages.push(validation.message);
                }
            });
            
            // Afficher toutes les erreurs en haut
            if (!isValid) {
                const existingAlert = document.querySelector('.alert.alert-danger');
                if (existingAlert) existingAlert.remove();
                
                const errorContainer = document.createElement('div');
                errorContainer.className = 'alert alert-danger mb-4';
                errorContainer.innerHTML = `
                    <strong>Erreurs de validation :</strong>
                    <ul>${errorMessages.map(msg => `<li>${msg}</li>`).join('')}</ul>
                `;
                
                const formContainer = document.querySelector('.form-box');
                if (formContainer) formContainer.prepend(errorContainer);
            }
            
            return isValid;
        }
    });
    </script>
</body>
</html>