<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

if (isset($_GET['ID_Parking'])) {
    $id = (int)$_GET['ID_Parking'];
    $pc = new ParkingP();
    $pc->DeleteParking($id);  

    // Redirection après suppression
    header('Location: listParking.php');
    exit();
} else {
    echo "ID du parking non spécifié.";
}
?>

