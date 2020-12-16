-- 
-- Base de données :  `festival`
-- MySQL
-- version ETUDIANTS - 2019/2020
--
use acrepiliere_festival; 

insert into Lieu values ('001','Place du lac', "", 200);
insert into Lieu values ('002','Amphitéatre', "", 20);
insert into Lieu values ('003','Centre ville', "", 70);
insert into Lieu values ('004','Boutiques', "", 50);

-- les dirigeants sont fictifs
insert into Etablissement values ('0350785N', 'Collège de Moka', '2 avenue Aristide Briand BP 6', '35401', 'Saint-Malo', '0299206990', null,1,'Monsieur','Dupont','Alain');
insert into Etablissement values ('0350773A', 'Collège Ste Jeanne d''Arc-Choisy', '3, avenue de la Borderie BP 32', '35404', 'Paramé', '0299560159', null, 1,'Madame','Lefort','Anne');  
insert into Etablissement values ('0352072M', 'Institution Saint-Malo Providence', '2 rue du collège BP 31863', '35418', 'Saint-Malo', '0299407474', null, 1,'Monsieur','Durand','Pierre');   
insert into Etablissement values ('0352025K', 'Centre de rencontres internationales', '37 avenue du R.P. Umbricht BP 108', '35407', 'Saint-Malo', '0299000000', null, 0, 'Monsieur','Guenroc','Guy');

insert into TypeChambre values ('C1', '1 lit');
insert into TypeChambre values ('C2', '2 à 3 lits');
insert into TypeChambre values ('C3', '4 à 5 lits');
insert into TypeChambre values ('C4', '6 à 8 lits');
insert into TypeChambre values ('C5', '8 à 12 lits');
 
-- certains groupes sont incomplètement renseignés
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g001','Groupe folklorique du Bachkortostan',40,'Bachkirie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g002','Marina Prudencio Chavez',25,'Bolivie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g003','Nangola Bahia de Salvador',34,'Brésil','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g004','Bizone de Kawarma',38,'Bulgarie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g005','Groupe folklorique camerounais',22,'Cameroun','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g006','Syoung Yaru Mask Dance Group',29,'Corée du Sud','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g007','Pipe Band',19,'Ecosse','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g008','Aira da Pedra',5,'Espagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g009','The Jersey Caledonian Pipe Band',21,'Jersey','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g010','Groupe folklorique des Émirats',30,'Emirats arabes unis','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g011','Groupe folklorique mexicain',38,'Mexique','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g012','Groupe folklorique de Panama',22,'Panama','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g013','Groupe folklorique papou',13,'Papouasie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g014','Paraguay Ete',26,'Paraguay','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g015','La Tuque Bleue',8,'Québec','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g016','Ensemble Leissen de Oufa',40,'République de Bachkirie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g017','Groupe folklorique turc',40,'Turquie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g018','Groupe folklorique russe',43,'Russie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g019','Ruhunu Ballet du village de Kosgoda',27,'Sri Lanka','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g020','L''Alen',34,'France - Provence','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g021','L''escolo Di Tourre',40,'France - Provence','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g022','Deloubes Kévin',1,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g023','Daonie See',5,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g024','Boxty',5,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g025','Soeurs Chauvel',2,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g026','Cercle Gwik Alet',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g027','Bagad Quic En Groigne',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g028','Penn Treuz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g029','Savidan Launay',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g030','Cercle Boked Er Lann',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g031','Bagad Montfortais',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g032','Vent de Noroise',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g033','Cercle Strollad',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g034','Bagad An Hanternoz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g035','Cercle Ar Vro Melenig',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g036','Cercle An Abadenn Nevez',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g037','Kerc''h Keltiek Roazhon',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g038','Bagad Plougastel',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g039','Bagad Nozeganed Bro Porh-Loeiz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g040','Bagad Nozeganed Bro Porh-Loeiz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g041','Jackie Molard Quartet',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g042','Deomp',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g043','Cercle Olivier de Clisson',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g044','Kan Tri',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g045', 'Panama Fuerte Raza', 14, 'Panama', 'N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g046', 'Le Ballet Rey', 25, 'Bielorussie', 'N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g047', 'Soïg Siberil et Etienne Grandjean', 2, 'France - Bretagne', 'N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g048', 'Le Bour-Bodros', 3, 'France-Bretagne', 'N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g049', 'Ensemble Kidra Budaya', 15, 'Indonésie', 'N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g050', ' Compagna Folklorica  Camagua', 20, 'Cuba', 'N');

-- les offres sont fictives
insert into Offre values ('0350785N', 'C1', 5);
insert into Offre values ('0350785N', 'C2', 10);
insert into Offre values ('0350785N', 'C3', 5);

insert into Offre values ('0350773A', 'C2', 15);
insert into Offre values ('0350773A', 'C3', 1);

insert into Offre values ('0352072M', 'C1', 5);
insert into Offre values ('0352072M', 'C2', 10);
insert into Offre values ('0352072M', 'C3', 3);

-- les attributions sont fictives
insert into Attribution values ('0350785N', 'C1', 'g001', 1);
insert into Attribution values ('0350785N', 'C1', 'g002', 2);
insert into Attribution values ('0350785N', 'C1', 'g003', 2);
insert into Attribution values ('0350785N', 'C2', 'g001', 2);
insert into Attribution values ('0350785N', 'C2', 'g002', 1);
insert into Attribution values ('0350785N', 'C3', 'g001', 2);
insert into Attribution values ('0350785N', 'C3', 'g002', 1);

insert into Attribution values ('0350773A', 'C2', 'g004', 2);
insert into Attribution values ('0350773A', 'C3', 'g005', 1);

insert into Attribution values ('0352072M', 'C1', 'g006', 1);
insert into Attribution values ('0352072M', 'C2', 'g007', 3);
insert into Attribution values ('0352072M', 'C3', 'g006', 3);

INSERT INTO Utilisateur VALUES (1,'Madame','Aubert', 'Lise', 'laubert@saint-malo.fr', 'laubert', 'mdplaubert');
INSERT INTO Utilisateur VALUES (2,'Monsieur','Dupont', 'Alain', 'adupont@saint-malo.fr', 'adupont', 'mdpadupont');
INSERT INTO Utilisateur VALUES (3,'Madame','Joubert', 'Julie', 'jjoubert@saint-malo.fr', 'jjoubert', 'mdpjjoubert');




 INSERT INTO `acrepiliere_festival`.Representation (`id`, `idGroupe`, `idLieu`, `dateRepres`, `heureDebut`, `heureFin`) VALUES
('001', 'g001', '001', '2021-07-01', '10:10:00', '12:00:00'),
('002', 'g030', '002', '2021-07-01', '12:30:00', '15:00:00'),
('003', 'g014', '001', '2021-07-02', '09:45:00', '11:35:00'),
('004', 'g017', '003', '2021-07-02', '20:20:00', '22:30:00'),
('005', 'g003', '002', '2021-07-03', '09:10:00', '11:10:00'),
('006', 'g048', '003', '2021-07-03', '21:00:00', '23:00:00'),
('007', 'g050', '002', '2021-07-04', '11:00:00', '13:00:00'),
('008', 'g036', '004', '2021-07-05', '10:00:00', '12:00:00'),
('009', 'g028', '001', '2021-07-05', '19:00:00', '21:30:00');