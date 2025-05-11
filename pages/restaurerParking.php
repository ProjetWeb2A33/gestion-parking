<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

try {
    // Vérifiez si l'ID du parking est spécifié
    if (isset($_POST['ID_Parking']) && is_numeric($_POST['ID_Parking'])) {
        $id = (int)$_POST['ID_Parking'];
        $parkingP = new ParkingP();

        // Appeler la méthode pour restaurer le parking
        $parkingP->restaurerParking($id);

        // Redirection après restauration
        header('Location: listParking.php?message=restored');
        exit();
    } else {
        throw new Exception("ID du parking non spécifié ou invalide.");
    }
} catch (Exception $e) {
    // Gérer les erreurs et afficher un message
    echo "Erreur : " . $e->getMessage();
}