<?php 

include_once __DIR__ . '/../config.php';

class ReservationR {

    public function historiqueReservation() {
        $db = config::getConnexion();
        try {
            $liste = $db->query('SELECT * FROM reservation');
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
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

    public function GetReservation($ID_Reservation) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('SELECT * FROM reservation WHERE ID_Reservation = :ID_Reservation');
            $req->execute([
                'ID_Reservation' => $ID_Reservation
            ]);
            return $req->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function UpdateReservation($ID_Reservation, $reservation) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('
                UPDATE reservation 
                SET 
                    idParking = :p,
                    nom_client = :nc,
                    idClient = :c,
                    horaire_d = :hd,
                    horaire_f = :hf,
                    statut = :s,
                    prolongation = :pr,
                    payment = :py,
                    disponibilite = :d
                WHERE ID_Reservation = :id
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
                'd'  => $reservation->getDisponibilite(),
                'id' => $ID_Reservation
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getAllReservations() {
        $db = config::getConnexion();
        try {
            $result = $db->query('SELECT * FROM reservation');
            $reservations = [];

            if ($result) {
                foreach ($result as $row) {
                    if (
                        isset($row['ID_Reservation'], $row['idParking'], $row['idClient'], $row['horaire_d'],
                            $row['horaire_f'], $row['statut'], $row['prolongation'], $row['payment'], $row['disponibilite'])
                    ) {
                        $reservation = new Reservation(
                            $row['ID_Reservation'],
                            $row['idParking'],
                            $row['idClient'],
                            $row['horaire_d'],
                            $row['horaire_f'],
                            $row['statut'],
                            $row['prolongation'],
                            $row['payment'],
                            $row['disponibilite']
                        );
                        $reservations[] = $reservation;
                    } else {
                        error_log('Données manquantes dans la ligne de résultat de la réservation.');
                    }
                }
            }

            return $reservations;

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getReservationById($id) {
        $sql = "SELECT * FROM reservation WHERE ID_Reservation = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return false;
        }
    }
}

?>
