<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

try {
    // Vérifiez si l'ID du parking est spécifié
    if (isset($_GET['ID_Parking']) && is_numeric($_GET['ID_Parking'])) {
        $id = (int)$_GET['ID_Parking'];
        $parkingP = new ParkingP();

        // Appeler la méthode pour supprimer définitivement le parking
        $parkingP->supprimerParkingDefinitivement($id);

        // Redirection après suppression
        header('Location: historiqueParking.php?message=deleted');
        exit();
    } else {
        throw new Exception("ID du parking non spécifié ou invalide.");
    }
} catch (Exception $e) {
    // Gérer les erreurs et afficher un message
    echo "Erreur : " . $e->getMessage();
}