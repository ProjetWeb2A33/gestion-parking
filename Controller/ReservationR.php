<?php 

include_once __DIR__ . '/../config.php';

class ReservationR {

    
    public function ListeReservation() {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("
                SELECT 
                    r.ID_Reservation,
                    r.idParking,
                    r.idClient,
                    r.nom_client,
                    r.horaire_d,
                    r.horaire_f,
                    r.statut,
                    r.prolongation,
                    r.payment,
                    r.disponibilite,
                    p.Nom_Parking AS Nom_Parking
                FROM reservation r
                LEFT JOIN parking p ON r.idParking = p.ID_Parking
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function DeleteReservation($ID_Reservation) {

        $db = config::getConnexion();

        try {

            $req = $db->prepare('
            DELETE FROM reservation WHERE ID_Reservation = :ID_Reservation
            ');
            $req->execute([
                'ID_Reservation' => $ID_Reservation
            ]);

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function AjouterReservation($reservation) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('
                INSERT INTO reservation (idParking, nom_client, idClient, horaire_d, horaire_f, statut, prolongation, payment, disponibilite) 
                VALUES (:p, :nc, :c, :hd, :hf, :s, :pr, :py, :d)
            ');
            $req->execute([
                'p'  => $reservation->getIdParking(),
                'nc' => $reservation->getNomClient(),
                'c'  => $reservation->getIdClient(),
                'hd' => $reservation->getHoraireD(),
                'hf' => $reservation->getHoraireF(),
                's'  => $reservation->getStatut(),
                'pr' => $reservation->getProlongation(),
                'py' => $reservation->getPayment(),
                'd'  => $reservation->getDisponibilite()
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    public function getReservationById($id) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("
                SELECT 
                    r.*,
                    p.Nom_Parking AS Nom_Parking
                FROM reservation r
                LEFT JOIN parking p ON r.idParking = p.ID_Parking
                WHERE r.ID_Reservation = :id
            ");
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function UpdateReservation($ID_Reservation, Reservation $reservation) {
        $db = config::getConnexion();

        try {
             $query = $db->prepare("UPDATE reservation SET 
                
                    idParking = :p,
                    idClient = :c,
                    nom_client = :nc, 
                    horaire_d = :hd,
                    horaire_f = :hf,
                    statut = :s,
                    prolongation = :pr,
                    payment = :py,
                    disponibilite = :d
                WHERE ID_Reservation = :id
            ");
            
            return $query->execute([
                'p'  => $reservation->getIdParking(),
                'c'  => $reservation->getIdClient(),
                'nc' => $reservation->getNomClient(),
                'hd' => $reservation->getHoraireD(),
                'hf' => $reservation->getHoraireF(),
                's'  => $reservation->getStatut(),
                'pr' => $reservation->getProlongation(),
                'py' => $reservation->getPayment(),
                'd'  => $reservation->getDisponibilite(),
                'id' => $ID_Reservation
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getAvailableParkings() {
        $db = config::getConnexion();
        try {
            $query = $db->prepare("SELECT ID_Parking, Nom_Parking FROM parking WHERE ID_Parking IS NOT NULL");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

        
    
    
}

?>

         
        


