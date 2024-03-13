-- --------------------------------------------------------

--
-- Structure de la table 'personne' 
--

DROP TABLE IF EXISTS personne;
CREATE TABLE personne (
  id int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(50) DEFAULT NULL,
  prenom varchar(50) DEFAULT NULL,
  age int(11) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Contenu de la table 'personne'
--

INSERT INTO personne VALUES(1, 'Alavie', 'Irenée', 24);
INSERT INTO personne VALUES(2, 'L''couver', 'Jérémy', 14);
INSERT INTO personne VALUES(5, 'Aulet', 'Thierry', 27);
INSERT INTO personne VALUES(7, 'O''Faringite', 'Reine', 57);
INSERT INTO personne VALUES(8, 'Duman', 'Mariette', 35);
INSERT INTO personne VALUES(9, 'Tabille', 'Raoul', 80);
INSERT INTO personne VALUES(10, 'Comaindieu', 'Thibaut', 61);
INSERT INTO personne VALUES(13, 'O''Balcon', 'Noël', 26);
INSERT INTO personne VALUES(15, 'Adessin', 'Blanche', 78);
INSERT INTO personne VALUES(17, 'Leupoisson', 'Benoît', 27);
INSERT INTO personne VALUES(19, 'Leifeilei', 'Olivier', 40);
INSERT INTO personne VALUES(21, 'Noyeux', 'Joël', 17);
INSERT INTO personne VALUES(24, 'Tohozamande', 'Olga', 22);
INSERT INTO personne VALUES(27, 'Kon', 'Elie', 39);
INSERT INTO personne VALUES(31, 'Use', 'Jacques', 33);
INSERT INTO personne VALUES(34, 'Alor', 'Marthe', 10);
INSERT INTO personne VALUES(36, 'Tabaniol', 'Alphonse', 27);
INSERT INTO personne VALUES(39, 'Diratamair', 'Oswald', 69);
INSERT INTO personne VALUES(42, 'Couvert', 'Armelle', 38);
INSERT INTO personne VALUES(45, 'Saitrukla', 'Symphorien', 19);
INSERT INTO personne VALUES(49, 'Stiti', 'Louis', 70);
INSERT INTO personne VALUES(52, 'Aidelaine', 'Gilles', 75);
INSERT INTO personne VALUES(55, 'Possible', 'Alain', 78);
INSERT INTO personne VALUES(56, 'Fessonro', 'Adèle', 22);
INSERT INTO personne VALUES(58, 'Nerve', 'Aimé', 29);
INSERT INTO personne VALUES(60, 'Laporte', 'Sonia', 19);
INSERT INTO personne VALUES(62, 'Neuf Sang', 'Emile', 47);
INSERT INTO personne VALUES(65, 'Contraire', 'Davy', 58);
INSERT INTO personne VALUES(68, 'Tinople', 'Constant', 54);
INSERT INTO personne VALUES(70, 'Assicmonpote', 'Thècle', 16);
INSERT INTO personne VALUES(72, 'Adonaideux', 'Hermann', 77);
INSERT INTO personne VALUES(74, 'Aniaitalettre', 'Jérôme', 31);
INSERT INTO personne VALUES(76, 'Taitraijeune', 'Thérèse', 56);
INSERT INTO personne VALUES(78, 'Toutte', 'Arielle', 49);
INSERT INTO personne VALUES(81, 'Dau', 'Léger', 32);
INSERT INTO personne VALUES(85, 'Deulisse', 'Fleur', 70);
INSERT INTO personne VALUES(88, 'Peuleurido', 'Firmin', 47);
INSERT INTO personne VALUES(89, 'Aibaitiz', 'Alfred', 26);
INSERT INTO personne VALUES(91, 'Issaifaite', 'Juste', 64);
INSERT INTO personne VALUES(93, 'Eulssai', 'Edwige', 25);
INSERT INTO personne VALUES(96, 'Arne', 'Luc', 73);
INSERT INTO personne VALUES(98, 'Sanse', 'René', 75);
INSERT INTO personne VALUES(101, 'Oleihome', 'Aline', 34);
INSERT INTO personne VALUES(102, 'Airinaire', 'Yvette', 71);
INSERT INTO personne VALUES(106, 'Kussonet', 'Simon', 46);
INSERT INTO personne VALUES(108, 'Ayencoin', 'Laure', 22);
INSERT INTO personne VALUES(110, 'Attan', 'Charles', 37);
INSERT INTO personne VALUES(114, 'Monte Le Poil', 'Geoffroy', 16);
INSERT INTO personne VALUES(117, 'Peusseussoir', 'Saturnin', 47);
INSERT INTO personne VALUES(120, 'Sansonner', 'André', 27);
INSERT INTO personne VALUES(123, 'Sanfraper', 'André', 50);
INSERT INTO personne VALUES(126, 'Durine', 'Anne-Alice', 44);
INSERT INTO personne VALUES(129, 'Deussan', 'Anne-Alice', 35);
INSERT INTO personne VALUES(133, 'Baul', 'Gérald', 67);
INSERT INTO personne VALUES(137, 'Mayard', 'Colin', 24);
INSERT INTO personne VALUES(138, 'Bienlepeti', 'Ambroise', 12);
INSERT INTO personne VALUES(141, 'Eumoileu', 'Odile', 60);
INSERT INTO personne VALUES(145, 'Leuceipa', 'Judicaël', 32);
INSERT INTO personne VALUES(148, 'Pavumirza', 'Xavier', 30);
INSERT INTO personne VALUES(150, 'Comarespire', 'Armand', 17);
INSERT INTO personne VALUES(152, 'Vozafair', 'Roger', 78);
INSERT INTO personne VALUES(154, 'Anchier', 'Yvon', 19);
INSERT INTO personne VALUES(156, 'Tombay', 'Yvon', 73);
INSERT INTO personne VALUES(159, 'Imbute', 'Marc', 70);
INSERT INTO personne VALUES(163, 'Beurgueur', 'Cochise', 43);
INSERT INTO personne VALUES(165, 'Bondeparme', 'Jean', 47);
INSERT INTO personne VALUES(167, 'Kiroul Namace Pamouce', 'Pierre', 13);
INSERT INTO personne VALUES(171, 'Baymole', 'Rémi', 31);
INSERT INTO personne VALUES(173, 'Ceheff Sey Pocybl', 'Hassan', 44);
INSERT INTO personne VALUES(175, 'Duveldyv', 'Ralph', 50);
INSERT INTO personne VALUES(177, 'Lahpay', 'Vishnou', 36);
INSERT INTO personne VALUES(179, 'Gallo', 'Romain', 25);
INSERT INTO personne VALUES(181, 'Leglas', 'Parkinson', 25);
INSERT INTO personne VALUES(183, 'Airien Kompry', 'Johnny', 44);
INSERT INTO personne VALUES(184, 'Digra', 'Omar', 35);
INSERT INTO personne VALUES(187, 'Fraimieux De La Fermay', 'Yves', 57);
INSERT INTO personne VALUES(189, 'Ekkraz Lehpri', 'Mahmoud', 65);
INSERT INTO personne VALUES(190, 'Emphaillite', 'Mélusine', 43);
INSERT INTO personne VALUES(194, 'Mavalley', 'Colette et Berthe', 71);
INSERT INTO personne VALUES(196, 'Dalor', 'Omer', 78);
INSERT INTO personne VALUES(200, 'Dumonde', 'Séraphin', 32);
INSERT INTO personne VALUES(202, 'Tousseul', 'Sébastienne', 26);
INSERT INTO personne VALUES(203, 'Lakuice', 'Leïlou', 58);
INSERT INTO personne VALUES(206, 'Naimar', 'Jean', 50);
INSERT INTO personne VALUES(207, 'Deibon''nouvel', 'Jonathan', 53);
INSERT INTO personne VALUES(208, 'Karr', 'Otto', 25);
INSERT INTO personne VALUES(209, 'Eipan', 'Ahmed', 38);
INSERT INTO personne VALUES(213, 'Cusset du Poullay', 'Edmond', 53);
INSERT INTO personne VALUES(216, 'Fran', 'Emile', 62);
INSERT INTO personne VALUES(219, 'Sailair', 'Jacques', 69);
INSERT INTO personne VALUES(222, 'Age', 'Karen', 71);
INSERT INTO personne VALUES(225, 'Deutable', 'Marcel', 35);
INSERT INTO personne VALUES(228, 'Aipoivre', 'Marcel', 25);
INSERT INTO personne VALUES(231, 'Kolog', 'Ginette', 75);
INSERT INTO personne VALUES(235, 'Judeux', 'Josette', 79);
INSERT INTO personne VALUES(238, 'De Monte Carlo', 'Coralie', 61);
INSERT INTO personne VALUES(240, 'Terphone', 'Alain', 76);
INSERT INTO personne VALUES(243, 'Neifaidaipir', 'Jean', 46);
INSERT INTO personne VALUES(247, 'Neifaidaimeyeur', 'Jean', 11);
INSERT INTO personne VALUES(249, 'Zieubleux', 'Bruno', 60);
