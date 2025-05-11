<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

try {
    // Vérifier si l'ID du parking est spécifié
    if (isset($_GET['ID_Parking']) && is_numeric($_GET['ID_Parking'])) {
        $id = (int)$_GET['ID_Parking'];
        $pc = new ParkingP();

        // Appeler la méthode DeleteParking
        $pc->DeleteParking($id);

        // Redirection après suppression
        header('Location: listParking.php?message=success');
        exit();
    } else {
        throw new Exception("ID du parking non spécifié ou invalide.");
    }
} catch (Exception $e) {
    // Gérer les erreurs et afficher un message
    echo "Erreur : " . $e->getMessage();
}
?>