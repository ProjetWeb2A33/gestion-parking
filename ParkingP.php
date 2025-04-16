<?php 

include_once __DIR__ . '/../config.php';

class ParkingP {

    public function ListeParking () {
        
        $db = config::getConnexion();

        try {

            $liste = $db->query('SELECT * FROM parking');
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function DeleteParking($ID_Parking) {

        $db = config::getConnexion();

        try {

            $req = $db->prepare('
            DELETE FROM parking WHERE ID_Parking = :ID_Parking
            ');
            $req->execute([
                'ID_Parking' => $ID_Parking
            ]);

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function AjouterParking($Parking) {
        $db = config::getConnexion();

        try {
            $req = $db->prepare('
                INSERT INTO parking (Nom_Parking, Adresse_Parking, Capacite_Totale, Nombre_Dispo, Horaire_Ouv, Horaire_Ferm, Abonnement, Tarification) 
                VALUES (:n, :a, :c, :nd, :ho, :hf, :ab, :t)
            ');

            $req->execute([
                'n' => $Parking->getNomParking(),
                'a' => $Parking->getAdresse(),
                'c' => $Parking->getCapacite(),
                'nd' => $Parking->getNombreDispo(),
                'ho' => $Parking->getHoraireOuv(),
                'hf' => $Parking->getHoraireFerm(),
                'ab' => $Parking->getAbonnement(),
                't' => $Parking->getTarification()
            ]);

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getParkingById($ID_Parking) {
        $db = config::getConnexion(); // Connexion à la base de données
        try {
            // Requête SQL pour récupérer le parking par son ID
            $query = $db->prepare('SELECT * FROM parking WHERE ID_Parking = :id');
            $query->execute(['id' => $ID_Parking]);

            // Vérification si le parking est trouvé
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result; // Retourne le résultat
            } else {
                return null; // Aucun parking trouvé
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function UpdateParking($ID_Parking, $Parking) {
        // Connexion à la base de données
        $db = config::getConnexion();
    
        try {
            // Requête pour mettre à jour les informations du parking
            $req = $db->prepare('
                UPDATE parking 
                SET 
                    Nom_Parking = :n, 
                    Adresse_Parking = :a, 
                    Capacite_Totale = :c, 
                    Nombre_Dispo = :nd, 
                    Horaire_Ouv = :ho, 
                    Horaire_Ferm = :hf, 
                    Abonnement = :ab, 
                    Tarification = :t
                WHERE ID_Parking = :ID_Parking
            ');
    
            // Exécution de la requête avec les paramètres
            $req->execute([
                'n' => $Parking->getNomParking(),
                'a' => $Parking->getAdresse(),
                'c' => $Parking->getCapacite(),
                'nd' => $Parking->getNombreDispo(),
                'ho' => $Parking->getHoraireOuv(),
                'hf' => $Parking->getHoraireFerm(),
                'ab' => $Parking->getAbonnement(),
                't' => $Parking->getTarification(),
                'ID_Parking' => $ID_Parking
            ]);
    
        } catch (Exception $e) {
            // Gestion d'erreur si la mise à jour échoue
            die('Erreur : ' . $e->getMessage());
        }
    }
    
}
?>
