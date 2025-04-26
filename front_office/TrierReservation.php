<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ReservationR.php';
include 'C:/xampp/htdocs/gestion parking/Model/Reservation.php';

// Créer une instance du contrôleur
$rc->addReservation($r);  // $r étant l'objet Reservation
$reservations = $rc->getAllReservations();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Réservations</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #2d3e50;
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 20px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #fafafa;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        .action-btns {
            display: flex;
            justify-content: space-around;
        }

        .btn {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination a {
            padding: 10px 20px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Historique des Réservations</h1>

        <table>
            <thead>
                <tr>
                    <th>ID Réservation</th>
                    <th>ID Parking</th>
                    <th>ID Client</th>
                    <th>Horaire Début</th>
                    <th>Horaire Fin</th>
                    <th>Statut</th>
                    <th>Prolongation</th>
                    <th>Paiement</th>
                    <th>Disponibilité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation->getIdReservation(); ?></td>
                    <td><?php echo $reservation->getIdParking(); ?></td>
                    <td><?php echo $reservation->getIdClient(); ?></td>
                    <td><?php echo $reservation->getHoraire_d(); ?></td>
                    <td><?php echo $reservation->getHoraire_f(); ?></td>
                    <td><?php echo $reservation->getStatut(); ?></td>
                    <td><?php echo $reservation->getProlongation(); ?></td>
                    <td><?php echo $reservation->getPayment(); ?></td>
                    <td><?php echo $reservation->getDisponibilite(); ?></td>
                    <td class="action-btns">
                        <a href="editReservation.php?id=<?php echo $reservation->getIdReservation(); ?>" class="btn">Modifier</a>
                        <a href="deleteReservation.php?id=<?php echo $reservation->getIdReservation(); ?>" class="btn btn-delete">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination (If applicable) -->
        <div class="pagination">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">Suivant</a>
        </div>

    </div>

</body>
</html>
