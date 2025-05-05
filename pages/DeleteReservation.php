<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';

if (isset($_GET['ID_Reservation'])) {
    $id = (int)$_GET['ID_Reservation'];
    $pc = new ReservationR();
    $pc->DeleteReservation($id);  

    // Redirection après suppression
    header('Location: listeReservation.php');
    exit();
} else {
    echo "ID de la reservation non spécifié.";
}
?>
