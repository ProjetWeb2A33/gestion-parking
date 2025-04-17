# EasyParki – 🚗 Gestion de Stationnement

## Description du Projet
La gestion de stationnement consiste à superviser et organiser de manière intelligente les places de parking disponibles dans une ou plusieurs zones urbaines, en tenant compte de la disponibilité en temps réel, la réservation, la durée d’occupation, les prolongations et l’analyse des usages.
Dans EasyParki, ce module est conçu pour fluidifier la mobilité, réduire le stress des conducteurs et maximiser l'utilisation des infrastructures existantes.

---

## Objectifs Fonctionnels
1️⃣ Suivi en temps réel des places disponibles
Afficher en permanence l’état de chaque place de stationnement :
🔵 Disponible – 🔴 Occupée – 🟡 Réservée – ⚫ Hors service

Mettre à jour l’état automatiquement après chaque réservation, annulation ou prolongation.

2️⃣ Réservation d’une place
Permettre aux utilisateurs de :

Choisir une place disponible

Définir une plage horaire (début/fin)

Réserver via un formulaire simple

Générer un code de confirmation de réservation.

3️⃣ Prolongation de stationnement
Offrir la possibilité de prolonger une réservation active :

Vérification automatique si la place est libre après l’horaire initial

Mise à jour de l’horaire et du montant

4️⃣ Annulation de réservation
Permettre aux utilisateurs d’annuler une réservation avant l’heure de début

Libérer automatiquement la place pour d’autres utilisateurs

5️⃣ Gestion des états de stationnement
L’admin peut manuellement :

Mettre une place en maintenance

Marquer une place comme réservée d’office

Réinitialiser une place après départ

6️⃣ Visualisation graphique des emplacements
Intégrer une interface cartographique ou tableau dynamique affichant :

L’emplacement exact de chaque place

L’état via un code couleur

7️⃣ Statistiques d’utilisation
Générer des rapports :

Taux d’occupation moyen

Périodes de forte demande

Durée moyenne de stationnement

8️⃣ Gestion dynamique de la disponibilité
Adapter en temps réel le nombre de places affichées comme disponibles en fonction :

Des réservations

Des départs détectés

Des prolongations validées


---

##  Architecture du Projet
/Model/
  ├── Parking.php            
  └── Reservation.php     

/Controller/
  ├── ParkingP.php              
  └── ReservationR.php        

/view/
│   ├── wetransfer_template-front_2025-04-07_1901/
│   │   └── template front/
│   │       └── Logis/
│   ├── material-dashboard-master/
│   │   └── material-dashboard-master/
│   │       └── pages/
│   ├── AddParking.php
│   ├── AddReservation.php
│   ├── UpdateReservation.php
│   ├── UpdateParking.php
│   ├── listeReservation.php
│   └── listParking.php
├── git/
└── (autres dossiers non spécifiés)
 
├──/View/Back/
│     
|────── /material-dashboard-master/material-dashboard-master\pages\
│    ├── tables.php
│    │   - Type : PHP Source File
│    │   - Taille : 19 KB
│    │   - Dernière modification : 16/04/2025 23:35
│    |
│    └── tables1.php
│    └──   - Type : PHP Source File
│    └──    - Taille : 22 KB
│    └──   - Dernière modification : 16/04/2025 23:35 ├── tables.php     
│          
├──  AddParking.php
│   ├── AddReservation.php
│   ├── UpdateReservation.php
│   ├── UpdateParking.php
│   ├── listeReservation.php
│   └── listParking.php

  /config/
  └── config.php   
           
## Modèle de Données
### Table : 

### Parking

id_parking	INT (PK)	Identifiant unique du parking
Nom_Parking	TEXT	Nom du parking
Adresse_Parking	TEXT	Adresse du parking
Capacite_Totale	INT	Nombre total de places
Nombre_Dispo	INT	Nombre de places disponibles
Horaire_Ouv	TIME	Heure d’ouverture
Horaire_Ferm	TIME	Heure de fermeture
Abonnement	TEXT	Type d’abonnement disponible
Tarification	FLOAT	Tarification en monnaie locale


### Reservation

idReservation	INT (PK)	Identifiant unique de la réservation
idParking	INT (FK)	Référence vers le parking réservé
idClient	INT	Identifiant du client
nom_client	TEXT	Nom du client
horaire_d	DATETIME	Heure de début de réservation
horaire_f	DATETIME	Heure de fin de réservation
statut	TEXT	Statut (En attente, Confirmée, Annulée…)
prolongation	TEXT	Indique si une prolongation est demandée (Oui/Non)
payment	TEXT	Mode de paiement (Carte, Espèces…)
disponibilite	INT	Nombre de places disponibles au moment de la réservation
	
## Installation & Configuration
### Cloner le projet :


bash
git clone(https://github.com/ProjetWeb2A33/gestion-parking)
cd gestion-parking


