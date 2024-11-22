CREATE TABLE Locataire(
   locataire_id INTEGER PRIMARY KEY,
   nom VARCHAR (128),
   prénom VARCHAR (128),
   email VARCHAR (255),
   mot_de_passe VARCHAR (255),
   telephone INTEGER,
   photo,
);

CREATE TABLE Admin(
   admin_id INTEGER PRIMARY KEY,
   nom VARCHAR (128),
   prénom VARCHAR (128),
   email VARCHAR (255),
   mot_de_passe VARCHAR (255),
   telephone INTEGER,
   photo,
);

CREATE TABLE Propriétaire(
   propriétaire_id INTEGER PRIMARY KEY,
   nom VARCHAR (128),
   prénom VARCHAR (128),
   email VARCHAR (255),
   mot_de_passe VARCHAR (255),
   telephone INTEGER,
   photo,
);

CREATE TABLE Annonce(
   annonce_id INTEGER PRIMARY KEY,
   titre VARCHAR (128),
   prix INTEGER,
   présentation VARCHAR (128),
   localisation,
   date_publication TIMESTAMP,
   statut VARCHAR (128),
   surface INTEGER,
   détaille VARCHAR (255),
   nb_colocatire_max INTEGER,
   nb_pieces INTEGER,
);

CREATE TABLE Avis(
   avis_id INTEGER PRIMARY KEY,
   note INTEGER,
   contenue VARCHAR (128), 

);

CREATE TABLE Favoris(
   favoris_id INTEGER PRIMARY KEY,
   date_ajout TIMESTAMP,
 
);

CREATE TABLE Photo(
   photo_id INTEGER PRIMARY KEY,
   path ,
   type VARCHAR(128),
 
);

CREATE TABLE Galerie(
   galerie_id INTEGER PRIMARY KEY,
   description ,
   date_dépot TIMESTAMP,
 
);

CREATE TABLE Candidature(
   candidature_id INTEGER PRIMARY KEY,
   date_depot TIMESTAMP,
   statut VARCHAR,  
);

CREATE TABLE Notification(
   notification_id INTEGER PRIMARY KEY,
   type ,
   date_envoi TIMESTAMP,
 
);

CREATE TABLE Message(
   message_id INTEGER PRIMARY KEY,
   contenue ,
   date_envoi TIMESTAMP, 
 
);

CREATE TABLE Alerte(
   alerte_id INTEGER PRIMARY KEY,
   prix INTEGER,
   localisation ,
   nb_pieces INTEGER,
   type ,
   surface INTEGER,
 
);