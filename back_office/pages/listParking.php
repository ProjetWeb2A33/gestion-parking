<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

$c = new ParkingP();
$tab = $c->ListeParking();


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


    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin: 30px auto;
      max-width: 600px;
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
    
    .error-message {
      color: red;
      margin-bottom: 15px;
    }

    
    .custom-table {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    .custom-table th {
      background-color: var(--accent-blue) !important;
      color: white !important;
      padding: 1rem;
    }
    
    .custom-table td {
      vertical-align: middle;
      padding: 1rem;
    }

.bg-gradient-primary {
    background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
    border: none;
}

.bg-gradient-primary:hover {
    background: linear-gradient(195deg, #D81B60 0%, #EC407A 100%);
}
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
/* Button Container */
.button-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
    flex-wrap: wrap;
}

/* General Button Styles */
.btn {
    border-radius: 25px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Sort Button */
.btn-primary {
    background: linear-gradient(135deg, rgb(255, 0, 119), rgb(255, 0, 119));
    color: white;
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, rgb(255, 0, 119), rgb(255, 0, 119));
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

/* Search Button */
.btn-secondary {
    background: linear-gradient(135deg, rgb(255, 0, 119), rgb(255, 0, 119));
    color: white;
    border: none;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, rgb(255, 0, 119), rgb(255, 0, 119));
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

/* Export to PDF Button */
.btn-export-pdf {
    background: linear-gradient(135deg,rgb(255, 0, 119), rgb(255, 0, 119));
    color: white;
    border: none;
}

.btn-export-pdf:hover {
    background: linear-gradient(135deg,rgb(255, 0, 119), rgb(255, 0, 119));
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

/* Input Field */
.input-group .form-control {
    border-radius: 25px 0 0 25px;
    border: 1px solid #ced4da;
    padding: 10px 15px;
}

.input-group .btn {
    border-radius: 0 25px 25px 0;
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

        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/evenement.php">
            <span class="nav-link-text ms-1">Evenement</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/covoiturage.php">
            <span class="nav-link-text ms-1">Covoiturage</span>
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
        <a class="btn btn-outline-white mt-4 w-100" href="http://localhost/gestion%20parking/view/front_office/index.php">
          <i class="fas fa-external-link-alt me-2"></i>FrontOffice
        </a>
      </div>
    </div>
  </aside>



  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
   <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="mb-0">Liste Des Parkings</h2>
          <a href="AddParking.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Ajouter un Parking
          </a>
          
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
    </div>
  </main>
  <div class="button-container d-flex justify-content-center gap-3 mt-4">
            <button id="sortByNameBtn" class="btn btn-primary btn-lg">
              <i class="fas fa-sort-alpha-down me-1"></i> Trier par Nom
            </button>
          <div class="input-group" style="max-width: 300px;">
            <input type="text" id="searchByIdInput" class="form-control" placeholder="Rechercher par ID">
            <button id="searchByIdBtn" class="btn btn-secondary">
              <i class="fas fa-search me-1"></i> Rechercher
            </button>
          </div>
          <button onclick="exportToPDF()" class="btn btn-export-pdf btn-lg">
              <i class="fas fa-file-pdf me-1"></i> Exporter en PDF
          </button>
        </div>
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
</body>
</html>

                             
                                                                                     
