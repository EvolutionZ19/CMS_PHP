-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 oct. 2023 à 07:57
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cmsphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL,
  `categorie_id` int NOT NULL,
  `statut_publication` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `image`, `contenu`, `date`, `categorie_id`, `statut_publication`) VALUES
(15, 'La Chasse au Trésor du Chat Téméraire', 'chat1.png', 'Dans une petite ville tranquille, un chat nommé Whiskers est devenu célèbre pour ses aventures téméraires. Un jour, il a découvert une vieille carte au trésor dans le grenier de sa maison, apparemment laissée par un ancien pirate félin.\r\n\r\nIntrigué, Whiskers a rassemblé une équipe hétéroclite de chats errants, de chiens sympathiques et même d\'un oiseau espiègle pour partir à la recherche du trésor. Ils ont suivi les indices biscuit par biscuit, griffes par griffes, et se sont aventurés dans des endroits inattendus comme le jardin voisin et le bac à sable du parc.\r\n\r\nFinalement, après une quête pleine d\'énigmes déroutantes et de poursuites de papillons, l\'équipe de Whiskers a découvert un coffre au trésor rempli de jouets en peluche, de friandises pour chats et de balles rebondissantes. Bien que ce ne soit pas de l\'or et des diamants, les animaux se sont éclatés en jouant avec leurs nouvelles trouvailles.\r\n\r\nLes résidents de la ville ont été divertis par cette aventure inattendue, et Whiskers est devenu une légende locale en tant que \"Chat Chasseur de Trésor\". Depuis lors, il organise des chasses au trésor régulières pour tous les animaux du quartier.', '2023-09-27', 1, 'en attente'),
(14, 'Le Poulet Traficoteur : Un Coq Courageux Régule la Circulatio', 'poulet1.png', 'Un poulet courageux a été vu en train de diriger la circulation sur une route animée, remplaçant un agent de police fatigué. Les automobilistes se sont arrêtés pour laisser le poulet faire son travail.\r\n\r\nCependant, la scène a pris une tournure comique lorsque le poulet a commencé à donner des contraventions pour excès de vitesse aux voitures. Il a également distribué des graines de tournesol au lieu de contraventions aux conducteurs qui étaient particulièrement obéissants.\r\n\r\nLa police locale a été appelée sur les lieux pour résoudre la situation insolite. Le chef de la police a déclaré qu\'il était impressionné par les compétences de régulation de la circulation du poulet, mais qu\'il devait quand même retourner à la ferme voisine.\r\n\r\nLe poulet est reparti sous les applaudissements des automobilistes, laissant derrière lui une scène de rire et de bonne humeur. Depuis cet événement, le poulet est devenu une légende locale et est surnommé le \"Poulet Traficoteur\".', '2023-09-28', 1, 'publié'),
(6, 'Besty en route pour le ballon d\'or', 'betsy.png', 'Dans un petit village pittoresque, une vache nommée Betsy a été repérée en train de jouer au football avec des enfants du quartier. Armée de ses quatre sabots habiles, Betsy était devenue la star inattendue du terrain local. Elle dribblait, passait et même marquait des buts incroyables, tout en exhibant une agilité surprenante pour une vache.\r\n\r\nLes habitants se sont rassemblés pour encourager Betsy lors de ses matchs impromptus, et certains ont même créé des maillots d\'équipe personnalisés pour elle. Les parties de football de Betsy sont rapidement devenues une attraction locale, attirant des spectateurs de tout le village.\r\n\r\nLorsque les journalistes locaux ont découvert l\'histoire, Betsy est devenue une sensation médiatique, et son histoire a fait le tour du pays. Betsy a prouvé que le talent sportif ne connaît pas de limites, même pour une vache de campagne, et elle est devenue un symbole d\'inspiration pour tous ceux qui rêvent de réaliser l\'impossible.', '2023-09-14', 3, 'publié'),
(10, 'Le cambrioleur maladroit confond une maternelle avec une bijouterie', 'logo.png', 'Dans une série de cambriolages rocambolesques, un voleur maladroit a réussi à confondre une maternelle avec une bijouterie de luxe. L\'incident a eu lieu au milieu de la nuit lorsque le cambrioleur, apparemment désorienté, a escaladé la clôture de l\'établissement.\r\n\r\nArmé d\'un sac de butin vide et d\'une lampe de poche, le cambrioleur s\'est dirigé vers la salle de sieste des enfants, prenant les peluches pour des joyaux précieux. C\'est là qu\'il a été pris en flagrant délit par une armée de poupées et de nounours qui l\'ont entouré en poussant des cris joyeux.\r\n\r\nPaniqué, le cambrioleur a fait demi-tour en courant à toutes jambes, trébuchant sur des blocs de construction et renversant des pots de crayons de couleur. Les cris des peluches ont alerté le gardien de l\'école, qui a appelé la police.\r\n\r\nLe cambrioleur a été arrêté alors qu\'il tentait de s\'échapper par la porte d\'entrée, complètement désemparé. Les policiers ont eu du mal à contenir leur hilarité face à cette situation surréaliste. Le voleur a été inculpé pour effraction, mais sa défense a plaidé que son client souffrait d\'une \"phobie des poupées en peluche\". Une excuse peu convaincante pour le cambrioleur maladroit qui, depuis lors, est devenu la risée de la ville.', '2023-09-29', 1, 'brouillon'),
(11, 'Le chevalier de glace', '23005186-fantaisie-soldat-dans-bataille-numerique-art-illustration-generatif-ai-photo.jpeg', 'Sir Ardent Flambard était un chevalier intrépide dans un monde fantastique où la magie et l\'aventure régnaient en maîtres. Doté d\'une armure luisante de métal forgé dans les flammes d\'un dragon ancien, il chevauchait un destrier majestueux aux crins ardents, nommé Éclat Flamboyant. Né avec le don de contrôler le feu, Sir Ardent avait juré de protéger son royaume contre les forces obscures qui menaçaient de l\'engloutir. Son épée, Forgeflamme, pouvait enflammer le champ de bataille d\'une simple pensée, brûlant les ennemis qui osaient se dresser sur son chemin. Au cours de ses aventures, Sir Ardent se lia d\'amitié avec des créatures magiques, des elfes mystiques et des mages puissants. Ensemble, ils affrontèrent des sorciers maléfiques, des dragons voraces et des armées de ténèbres. Finalement, Sir Ardent Flambard gravit les échelons de la chevalerie et devint le Gardien du Feu, un titre honorifique qui signifiait qu\'il était le protecteur de la flamme sacrée, source de pouvoir et de lumière pour son royaume. Son nom résonne encore aujourd\'hui dans les contes et les légendes, rappelant l\'épopée d\'un chevalier de feu qui défendit courageusement la paix et la magie dans un monde empreint de mystère.', '2023-09-30', 3, 'publié'),
(9, 'Évasion rocambolesque d\'une poule au supermarché', 'a chicken with a red beak in natural light, in the style of vray tracing, southern gothic, uhd image, sketchfab, captivating portraits, forestpunk, rural life scenes.png', 'Dans une petite ville, une poule baptisée \"Cocotte\" a créé un véritable chaos dans un supermarché local. Le volatile, sans doute en quête de graines plus savoureuses, a réussi à échapper à la vigilance des employés du magasin et à pénétrer dans le rayon des produits frais.\r\n\r\nCe n\'était pas une simple incursion, mais une aventure pleine de rebondissements. Cocotte a été repérée en train de picorer les légumes, de courir dans les allées, et même d\'essayer de passer en caisse ! Les clients médusés ont rapidement sorti leurs téléphones pour immortaliser l\'événement.\r\n\r\nFinalement, après une course-poursuite hilarante, les employés du supermarché ont réussi à attraper la fugitive à l\'aide d\'un filet de pêche. Cocotte, visiblement fière de son exploit, a été relâchée saine et sauve dans un jardin voisin.\r\n\r\nLes employés du supermarché en parlent encore en riant, et Cocotte est devenue la coqueluche des réseaux sociaux. C\'était une journée inoubliable où une simple poule a semé la pagaille dans un supermarché paisible.', '2023-09-09', 3, 'publié'),
(12, 'Bataille de boules de neige rose', 'bataille neige.png', '\r\nUne bataille hivernale digne d\'un conte s\'est produite dans un paisible quartier lorsque des enfants ont défié une troupe de flamants roses en marche dans la neige fraîche. Les rires et les cris ont rempli l\'air alors que les jeunes courageux ont lancé des boules de neige en direction des élégants flamants.\r\n\r\nCependant, les oiseaux roses, loin d\'être décontenancés, ont riposté avec une adresse inattendue, utilisant leurs longs cous pour lancer des boules de neige à une vitesse surprenante. Ce duel inattendu a captivé le quartier tout entier, et la rue est rapidement devenue un champ de bataille hivernal où l\'audace des enfants rivalisait avec la grâce des flamants roses.\r\n\r\nFinalement, une trêve amicale a mis fin à cette épique bataille, laissant derrière elle des souvenirs hivernaux aussi joyeux que surprenants pour tous les participants.', '2023-09-28', 3, 'publié'),
(13, 'Noix-tradamus l\'écureuil cambrioleur', 'Noix-tradamus.png', 'Dans une petite ville tranquille, un événement des plus insolites s\'est produit. Un écureuil déterminé s\'est introduit dans une boutique de noix et a organisé un véritable festin nocturne. Les caméras de sécurité ont capturé la scène hilarante de l\'écureuil se servant de la caisse enregistreuse comme d\'un toboggan improvisé pour les noix. Le propriétaire, étonné, a déclaré : \"C\'est le voleur le plus mignon que j\'aie jamais vu !\"\r\n\r\nLes habitants ont rapidement surnommé l\'écureuil \"Noix-tradamus\" en raison de son flair pour dénicher les noix les plus délicieuses. La boutique a depuis pris des mesures de sécurité renforcées pour protéger son stock. L\'histoire de Noix-tradamus est devenue virale sur les réseaux sociaux, faisant de ce petit voleur à fourrure un véritable héros local et une source d\'amusement pour tous', '2023-09-01', 3, 'en attente'),
(16, 'Le Jour où les Pingouins ont Envahi la Plage', 'pinguin2.png', 'Un jour ensoleillé, sur une plage touristique, une situation complètement inattendue s\'est produite lorsque des pingouins ont débarqué en masse sur le sable doré. Les vacanciers et les habitants ont d\'abord cru à une farce, mais il s\'est rapidement avéré que les pingouins étaient bien réels.\r\n\r\nLes pingouins semblaient déterminés à profiter de la journée à la plage. Ils se sont installés confortablement sur des chaises longues, ont construit des châteaux de sable maladroits et ont même organisé une compétition de surf entre eux. Leur enthousiasme a été contagieux, et bientôt, tout le monde sur la plage a rejoint la fête.\r\n\r\nLes sauveteurs ont été surpris par cette invasion amusante, mais ils ont rapidement adapté leurs bouées de sauvetage pour les pingouins. Les vendeurs de glaces ont connu leur meilleure journée de ventes grâce aux pingouins amateurs de poissons congelés.\r\n\r\nFinalement, en fin de journée, les pingouins ont salué la foule, se sont regroupés et ont fait une retraite en direction de la mer, plongeant dans les vagues avec grâce. Les gens ont applaudi leur départ et ont déclaré que c\'était la journée à la plage la plus mémorable de leur vie.\r\n\r\nDepuis cet événement, la plage est devenue célèbre pour ses visites occasionnelles de pingouins, qui continuent de surprendre et d\'amuser tout le monde.', '2023-09-28', 2, 'publié'),
(17, 'Le Chien Chef Pâtissier Crée la Pâtisserie Canine', 'chien2.png', 'Dans une petite ville, un Labrador nommé Max a surpris tout le monde en devenant un chef pâtissier renommé, mais pas pour les humains, pour les chiens ! Max a ouvert sa propre boulangerie canine, proposant des délices tels que des croissants au bacon, des cupcakes au poulet et des biscuits à la carotte.\r\n\r\nChaque jour, les propriétaires de chiens faisaient la queue pour acheter des friandises spéciales pour leurs fidèles amis à quatre pattes. Max a même organisé des ateliers de décoration de biscuits pour les chiens, où les canins pouvaient décorer leurs propres friandises avec de la crème au fromage et des carottes râpées.\r\n\r\nLa pâtisserie de Max est devenue si populaire que les journaux locaux ont commencé à écrire des articles sur le chien pâtissier. Les gens venaient de loin pour visiter la boutique de Max et voir le spectacle hilarant de chiens dégustant des gâteaux d\'anniversaire spéciaux.\r\n\r\nMalheureusement, Max a pris sa retraite bien méritée, mais sa boutique de pâtisserie canine continue de prospérer grâce à son héritage culinaire unique. C\'est devenu un endroit incontournable pour tous les amoureux des chiens qui veulent gâter leurs compagnons à quatre pattes avec des friandises dignes d\'une pâtisserie.', '2023-09-15', 2, 'brouillon');

-- --------------------------------------------------------

--
-- Structure de la table `categories_articles`
--

DROP TABLE IF EXISTS `categories_articles`;
CREATE TABLE IF NOT EXISTS `categories_articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `chemin_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`image_id`, `chemin_image`) VALUES
(7, '23005186-fantaisie-soldat-dans-bataille-numerique-art-illustration-generatif-ai-photo.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL,
  `statut_publication` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `titre`, `image`, `contenu`, `date`, `statut_publication`) VALUES
(2, 'Page de catégorie 2', '2.jpg', 'Articles de catégorie 2', '2023-09-27', 'publié'),
(1, 'Page de la catégorie 1', '1.jpg', 'Tous les articles de catégorie 1', '2023-09-28', 'publie'),
(3, 'Page de catégorie 3', '3.png', 'tous les articles de catégorie 3', '2023-09-01', 'publie');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avatar` blob NOT NULL,
  `niveau_compte` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `mail`, `pseudo`, `pass`, `avatar`, `niveau_compte`) VALUES
(1, 'PUGGIONI', 'Anthony', 'admin@mail.com', 'EvolutionZ', '$2y$10$UTSUrl8O4DJNY5bXzCAxxOgeZBOPjFffv72Wz2I8ysU1x5cXwWES2', 0x6176617461722f363531353831343935653932645f68656c6c636173652d737465616d2d6176617461722e6a7067, 'admin'),
(5, 'Chainey', 'remi', 'remi@mail.com', 'ELYPSE18', '$2y$10$8ZQq./r6ugFNGOqdYrb4K..99cqjtDs59WIjPNBZccC5pXImBimZ.', 0x6176617461722f363531343239333934636163335f6c6f676f2e706e67, 'moderateur'),
(13, 'Zammit', 'Laure', 'laure@mail.com', 'LaureZ83', '$2y$10$MPqlw2Q...MoDhs/L3lrk./NVRK/by6C24Tfh4S9cojkunzgXQsDC', 0x6176617461722f363531343262316130616564355f68656c6c636173652d737465616d2d6176617461722e6a7067, 'moderateur'),
(14, 'testmembre', 'membre', 'membre@mail.com', 'membre1', '$2y$10$z0feM.Yv8KwqGDuaO3LkVejsZUPtt4tPe9pRjrjl4ccWNFRkzzZXq', 0x6176617461722f363531353735623634303963355f68656c6c636173652d737465616d2d6176617461722e6a7067, 'membre');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
