-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 04 déc. 2022 à 22:09
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `HubEvent`
--

-- --------------------------------------------------------

--
-- Structure de la table `Associations`
--

CREATE TABLE `Associations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `numeroRNA` char(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categorie` varchar(50) NOT NULL DEFAULT 'Aucune',
  `adresse` varchar(70) NOT NULL DEFAULT 'Adresse non disponible',
  `signature` varchar(100) NOT NULL DEFAULT 'Aucune signature',
  `populaire` varchar(20) NOT NULL DEFAULT 'NonPopulaire',
  `recent` varchar(20) NOT NULL DEFAULT 'NonRecent',
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Associations`
--

INSERT INTO `Associations` (`id`, `mail`, `name`, `description`, `numeroRNA`, `image`, `categorie`, `adresse`, `signature`, `populaire`, `recent`, `dateCreation`) VALUES
(91, 'restoducoeur@gmail.com', 'Les Restos du Coeur', 'Fondés par Coluche en 1985, les Restos du Cœur est une association loi de 1901, reconnue d’utilité publique, sous le nom officiel de « les Restaurants du Cœur – les Relais du Cœur ». \r\n\r\nIls ont pour but « d’aider et d’apporter une assistance bénévole aux personnes démunies, notamment dans le domaine alimentaire par l’accès à des repas gratuits, et par la participation à leur insertion sociale et économique, ainsi qu’à toute action contre la pauvreté sous toutes ses formes ».', 'w922406753', '91.jpeg', 'Alimentaire', '42 rue de Clichy, 75009 PARIS', 'Notre aide ne se limite pas à l\'alimentaire', 'Populaire', 'NonRecent', '2022-12-02 10:18:01'),
(92, 'croixrouge@gmail.com', 'La croix rouge', 'Les bénévoles de la Croix-Rouge française s’engagent quotidiennement dans les missions les plus diverses. Ils investissent leur temps et leur énergie pour venir en aide et soulager les souffrances.\r\n\r\nPar leur dévouement, nos 60 000 bénévoles entretiennent l’espoir d’un lendemain meilleur auprès de toutes les personnes en situation de vulnérabilité.\r\n\r\nCes interventions nécessitent des moyens importants et nous avons besoin de vous pour continuer nos actions. Chaque don compte !\r\n\r\nSi chaque jour, nos bénévoles peuvent agir concrètement sur le terrain, c’est grâce à vos dons ponctuels ou dons réguliers. Mobilisez-vous à nos côtés pour les aider. Faites un don !', 'w724306459', '92.jpeg', 'Santé', '98 rue Didot, 75694 Paris', 'Partout, pour tous', 'Populaire', 'NonRecent', '2022-12-02 10:18:01'),
(93, 'unicef@gmail.com', 'Unicef', 'L’UNICEF – pour United Nations International Children’s Emergency Fund, soit Fonds des Nations unies pour l’enfance – est une agence des Nations unies, créée en 1946, dont le siège est à New York, aux États-Unis. Elle est chargée, dans le monde entier, de défendre les droits des enfants, de répondre à leurs besoins essentiels et de favoriser leur plein épanouissement.\r\n\r\nLa priorité est donnée aux enfants les plus vulnérables, notamment victimes de la guerre, de catastrophes naturelles, de la pauvreté extrême et de toute forme de violence ou d’exploitation dans les pays les plus démunis. Elle intervient également en cas d’urgence en coordination avec les organismes des Nations unies, les principales organisations humanitaires, et les gouvernements nationaux.', 'w344488853', '93.jpeg', 'Santé', '7 Rue Saint-Lazare, 75009 Paris', 'Faisons avancer l\'humanité', 'Populaire', 'NonRecent', '2022-12-02 10:18:01'),
(94, 'naturenvironnement@gmail.com', 'France Nature Env', 'Fondée en 1968, France Nature Environnement se bat pour la protection de la nature et de l’environnement. Reconnue d’utilité publique en 1976, France Nature Environnement est présumée satisfaire aux obligations du contrat d’engagement républicain. Une équipe fédérale, composée de près de 180 bénévoles et 45 salarié·es, s’y investit au quotidien.\r\n\r\nNous réunissons directement 25 associations territoriales (qui sont souvent elles-mêmes des fédérations d’associations), 11 associations nationales, qui se mobilisent pour une cause environnementale spécifique, et 11 associations correspondantes, qui partagent nos préoccupations.', 'w631390433', '94.jpg', 'Environnement', '2 Rue de la Clôture, 75019 PARIS', 'Revoir des abeilles', 'Populaire', 'NonRecent', '2022-12-02 10:18:01'),
(96, 'actioncontrelafaim@gmail.com', 'Action contre la faim', 'Créée en 1979, notre association loi 1901 est une organisation non-gouvernementale de solidarité internationale (ONG) – Action contre la Faim – lutte contre la faim dans le monde. Les conflits, les dérèglements climatiques, la pauvreté, les inégalités d’accès à l’eau, aux soins, sont autant de causes de la malnutrition. \r\n\r\nNotre mission est de sauver des vies en éliminant la faim par la prévention, la détection et le traitement de la sous-nutrition, en particulier pendant et après les situations d’urgence liées aux conflits et aux catastrophes naturelles.', 'w532413342', '96.jpeg', 'Alimentaire', '102 rue de paris, 93558 Montreuil', 'Manger, boire, Un droit pour tous', 'Populaire', 'NonRecent', '2022-12-02 10:18:01'),
(103, 'wwf@gmail.com', 'WWF FRANCE', 'La mission de WWF : Arrêter la dégradation de l’environnement dans le monde et construire un avenir où les êtres humains pourront vivre en harmonie avec la nature.<br />\r\nSes champs d’action visent à protéger la planète selon cinq axes :<br />\r\nLa vie des océans : Préserver les écosystèmes marins<br />\r\nL’alimentation : Favoriser des systèmes alimentaires durables<br />\r\nLa vie sauvage : Sauver les espèces emblématiques menacées (panda, tigre, lutte contre le braconnage en Afrique…)<br />\r\nProtéger le poumon vert de la planète', 'w123456734', '103.jpg', 'Environnement', 'Gland, Suisse', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:02:07'),
(104, 'seasheperd@gmail.com', 'SEA SHEPERD', 'Sea Shepherd dénonce la destruction de la faune marine et la surpêche. L’ONG est particulièrement engagée dans la lutte contre la pêche illégale, la chasse à la baleine, la chasse aux dauphins au Japon, la chasse aux globicéphales aux îles Féroé, la chasse aux phoques et la surpêche liée à la pêche industrielle.<br />\r\nPour ce faire, les militants de l’association interviennent de manière active et non violente dans les cas d’atteintes illégales à la vie marine et aux écosystèmes marins.', 'w123453451', '104.jpg', 'Environnement', ' Washington, EU', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:04:36'),
(105, 'spa@gmail.com', 'SPA FRANCE', 'Depuis 176 ans, la SPA se dédie corps et âme quotidiennement à améliorer la vie de chaque animal. Nous partageons au sein de la SPA une vision et des valeurs communes : celle d’une relation entre l’Homme et l’animal basée sur le respect, le partage et la bienveillance. Il est de notre responsabilité de respecter et de protéger l’animal.', 'w123456345', '105.png', 'Environnement', '39, bd Berthier', 'Sauvez des animaux', 'NonPopulaire', 'Recent', '2022-12-03 20:07:19'),
(106, 'GreenPeace@gmail.com', 'Green Peace', 'Changements climatiques, inégalités grandissantes, injustices sociales, migrations et conflits armés… Tous les grands défis de notre époque, auxquels nous devons répondre de toute urgence, sont intimement liés – tout comme les structures de pouvoir qui en sont à l’origine et les mentalités qui s’en accommodent. C’est pourquoi, à Greenpeace, nous sommes convaincus qu’il est indispensable d’agir pour les transformer conjointement.<br />\r\n', 'w123456347', '106.png', 'Environnement', ' Amsterdam, Pays-Bas', 'Pour nôtre planète', 'NonPopulaire', 'Recent', '2022-12-03 20:11:35'),
(107, 'Amnesty@gmail.com', 'Amnesty ', 'On dit souvent “L’important c’est de participer”. Mais lorsqu\'il s’agit de droits humains, l’important c’est aussi de gagner. Nous voulons combattre, ensemble, pour sans cesse remporter des victoires, l’une après l’autre. Car nous en remportons… mais cela ne se sait pas assez.<br />\r\nNos principales valeurs sont la solidarité, l’indépendance et l’impartialité.<br />\r\nEt forts de ces valeurs, nous changeons des vies, nous changeons des lois.<br />\r\n', 'w123456987', '107.png', 'Environnement', ' Londres, Royaume-Un', 'Vous avez des Droits', 'NonPopulaire', 'Recent', '2022-12-03 20:13:42'),
(108, 'SecoursPopulaire@gmail.com', 'Secours Populaire', 'Issu du peuple, animé par lui, le Secours populaire promeut une relation d’égal à égal véritablement unique et un accueil inconditionnel. Présent partout, au bout de la rue comme au bout du monde avec son réseau de partenaires, il valorise systématiquement l’initiative comme mode d’action.', 'w123456356', '108.jpeg', 'Alimentaire', 'Paris France', 'Nous sommes tous humain', 'NonPopulaire', 'Recent', '2022-12-03 20:15:21'),
(109, 'emmaus@gmail.com', 'Emmaüs Solidarité', 'Association laïque, reconnue d’intérêt général, membre d’Emmaüs France et d’Emmaüs International, EMMAÜS Solidarité œuvre au quotidien pour que chacun trouve ou retrouve une place dans la société. Le champ d’intervention principal d’EMMAÜS Solidarité est centré sur les personnes et les familles les plus fragiles, les  plus désocialisées et les plus blessées par la vie : celles qui vivent à la rue.', 'w123456980', '109.jpg', 'Aucune', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:20:12'),
(110, 'medecinsdumonde@gmail.com', 'Médecins du Monde', 'Médecins du monde est une ONG médicale de solidarité internationale créée en 1980. Elle intervient en France et à l\'étranger, afin de soigner les populations les plus vulnérables, les victimes de conflits armés, de catastrophes naturelles, celles et ceux qui n’ont pas accès aux soins. Association humanitaire indépendante, Médecins du monde dénonce les atteintes à la dignité et aux droits de l’Homme et plaide pour améliorer la situation des personnes vulnérables. ', 'w123456324', '110.jpeg', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:21:37'),
(111, 'msf@gmail.com', ' MSF FRANCE', 'Médecins Sans Frontières est une association médicale humanitaire internationale, créée en 1971 à Paris par des médecins et des journalistes.<br />\r\nDepuis cinquante ans, Médecins Sans Frontières apporte une assistance médicale à des populations dont la vie ou la santé sont menacées, en France ou à l’étranger : principalement en cas de conflits armés, mais aussi d\'épidémies, de pandémies, de catastrophes naturelles ou encore d\'exclusion des soins.<br />\r\n', 'w123456721', '111.png', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:24:41'),
(112, 'pp@gmail.com', 'Petits Prince', 'Suivre les enfants sur la durée de la maladie<br />\r\nL’Association Petits Princes est la seule association en France à réaliser plusieurs rêves pour un même enfant malade si son état le nécessite, en fonction de l\'évolution de sa pathologie et de ses traitements. Les bénévoles de l’Association sont en contact régulier avec les enfants, leur famille et le personnel médical pour assurer un soutien dans la durée.<br />\r\n', 'w123456353', '112.png', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:25:55'),
(113, 'HandicapInternational@gmail.com', 'Handicap Inter', 'Depuis 40 ans, nos équipes et nos partenaires démontrent que des solutions sont possibles, en s’appuyant sur les individus, leurs familles et leurs communautés, et en prenant en compte les ressources humaines, les savoir-faire et les matériaux disponibles sur place.<br />\r\nL’association propose une approche globale qui vise à améliorer les conditions de vie des personnes handicapées ou vulnérables en combinant un ensemble d’actions complémentaires <br />\r\n', 'w123456545', '113.jpg', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:27:02'),
(114, 'vca@gmail.com', 'Vivre Comme Avant', 'A Vivre Comme Avant, nous tenons à ce qu’aucune femme n’ait à affronter, sans accompagnement, le cancer du sein.<br />\r\nNous souhaitons que chaque femme atteinte d’un cancer du sein trouve une alliée :<br />\r\nqui saura l’écouter, la comprendre, l’accompagner pour l’aider à passer au mieux le cap de l’hospitalisation et des traitements<br />\r\nqui l’encouragera dans les traitements et les suivis médicaux<br />\r\nqui, ne serait-ce que le temps d’une rencontre ou d’un échange téléphonique.', 'w123456323', '114.jpg', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:28:08'),
(115, 'lcc@gmail.com', 'LCC FRANCE', 'Créée en 1918, la Ligue contre le cancer est une association loi 1901 reconnue d’utilité publique reposant sur la générosité du public et sur l’engagement de ses bénévoles et salariés formés grâce à une école de formation agréée pour répondre aux besoins des personnes concernées par le cancer. Notre fédération, composée de 103 Comités départementaux présents sur tout le territoire national, est apolitique et indépendante financièrement.<br />\r\n<br />\r\n', 'w123456956', '115.jpg', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:29:30'),
(116, 'premiereurgence@gmail.com', 'Première urgence ', 'Première Urgence Internationale vient en aide aux victimes civiles, marginalisées ou exclues par les effets de catastrophes naturelles, de guerres et de situations d’effondrement économique.<br />\r\nNotre vocation : défendre les droits fondamentaux de la personne, tels que définis dans la Déclaration universelle des droits de l’homme de 1948.<br />\r\n', 'w123456932', '116.png', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:30:49'),
(117, 'SavetheChildren@gmail.com', 'Save the Children ', 'Dans le monde entier, trop d\'enfants commencent leur vie en étant désavantagés, simplement à cause de ce qu\'ils sont et d\'où ils viennent.<br />\r\nDes millions d\'enfants meurent de causes évitables, confrontés à la pauvreté, à la violence, à la maladie et à la faim. Ils sont pris dans des zones de guerre et des catastrophes qu\'ils n\'ont pas contribué à créer. Et ils sont privés d\'éducation et d\'autres droits fondamentaux qui leur sont dus.<br />\r\n', 'w123456969', '117.jpg', 'Santé', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:31:40'),
(118, 'fage@gmail.com', 'FAGE', 'La FAGE a pour but de garantir l\'égalité des chances de réussite dans le système éducatif. C\'est pourquoi elle agit pour l\'amélioration constante des conditions de vie et d\'études des jeunes en déployant des activités dans le champ de la représentation et de la défense des droits. En gérant des services et des œuvres répondant aux besoins sociaux, elle est également actrice de l\'innovation sociale.', 'w123456343', '118.jpg', 'Sportif', 'Adresse non disponible', 'Aucune signature', 'NonPopulaire', 'Recent', '2022-12-03 20:32:16');

-- --------------------------------------------------------

--
-- Structure de la table `AvoirUnRole`
--

CREATE TABLE `AvoirUnRole` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idAsso` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `AvoirUnRole`
--

INSERT INTO `AvoirUnRole` (`id`, `role`, `idUser`, `idAsso`) VALUES
(70, 'Createur', 9, 91),
(71, 'Createur', 9, 92),
(72, 'Createur', 9, 93),
(73, 'Createur', 9, 94),
(74, 'Createur', 9, 95),
(76, 'Createur', 9, 96),
(91, 'Membre', 11, 91),
(92, 'Support', 12, 92),
(96, 'Createur', 13, 103),
(97, 'Createur', 14, 104),
(98, 'Createur', 15, 105),
(99, 'Createur', 16, 106),
(100, 'Createur', 17, 107),
(101, 'Createur', 18, 108),
(102, 'Createur', 11, 109),
(103, 'Createur', 12, 110),
(104, 'Createur', 11, 111),
(105, 'Createur', 12, 112),
(106, 'Createur', 13, 113),
(107, 'Createur', 14, 114),
(108, 'Createur', 15, 115),
(109, 'Createur', 16, 116),
(110, 'Createur', 17, 117),
(111, 'Createur', 18, 118),
(112, 'Support', 14, 91),
(113, 'Membre', 13, 91),
(114, 'Support', 16, 92),
(115, 'Membre', 15, 92),
(116, 'Support', 17, 93),
(117, 'Membre', 18, 93),
(118, 'Support', 13, 94),
(119, 'Membre', 15, 94),
(120, 'Support', 14, 95),
(121, 'Membre', 15, 95),
(122, 'Support', 16, 96),
(123, 'Membre', 17, 96);

-- --------------------------------------------------------

--
-- Structure de la table `Events`
--

CREATE TABLE `Events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `dateStart` datetime NOT NULL,
  `dateEnd` datetime NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'prochainement',
  `progression` int(11) NOT NULL DEFAULT '0',
  `populaire` varchar(20) NOT NULL DEFAULT 'NonPopulaire',
  `recent` varchar(20) NOT NULL DEFAULT 'NonRecent',
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Events`
--

INSERT INTO `Events` (`id`, `name`, `type`, `dateStart`, `dateEnd`, `description`, `image`, `statut`, `progression`, `populaire`, `recent`, `dateCreation`) VALUES
(6, 'Zevent', 'Jeux-Video', '2022-12-03 23:18:00', '2023-01-14 23:18:00', 'Le Z Event est un marathon caritatif annuel organisé depuis 2016 et se déroulant sur trois jours. Il réunit des streameurs francophones dans le but de récolter des dons reversés à une association.', '6.jpeg', 'en-cours', 0, 'Populaire', 'NonRecent', '2022-12-02 10:17:33'),
(10, 'Squid Game ', 'Culturel', '2022-12-03 11:58:00', '2022-12-09 11:58:00', 'Qu\'est-ce que le Squid Game ? Dans Squid Game, 456 personnes criblées de dettes sont invitées par une mystérieuse organisation pour jouer à six jeux pendant une durée de six jours afin d\'obtenir le jackpot de 33 789 041 d\'euros. Toutefois, il y a un piège dans le jeu, si le participant perd, il meurt.', '10.png', 'en-cours', 21, 'Populaire', 'NonRecent', '2022-12-02 10:17:33'),
(14, 'One Piece', 'Culturel', '2022-12-02 23:25:00', '2023-01-07 23:25:00', 'Lorem ipsum dolor sit amet. Est alias temporibus et dolorum excepturi quo fugit enim qui consectetur assumenda. Et dolore quidem ea voluptatem laboriosam sed distinctio ipsum id molestias dolores aut officia ipsum.\r\nVel omnis fugit ex corporis quaerat quo voluptate quae et voluptatum optio non quia officiis et voluptas nostrum non molestiae laboriosam. Qui temporibus aliquam qui dolorem blanditiis qui saepe accusantium quo dolor eligendi sit deserunt commodi ad corrupti veritatis. ', '14.jpeg', 'en cours', 5, 'Populaire', 'NonRecent', '2022-12-02 10:17:33'),
(15, 'Aide à la Penurie', 'Humanitaire', '2022-12-07 09:00:00', '2022-12-11 19:00:00', 'Rejoignez nous afin d\'obtenir des provisions pour les plus défavoriser', '15.jpg', 'prochainement', 0, 'NonPopulaire', 'NonRecent', '2022-12-03 23:51:53'),
(16, 'Sauvons l\'Afrique', 'Humanitaire', '2022-12-20 23:56:00', '2022-12-30 23:56:00', '70% des peuples africains meurt de faim et souffre aidons les!', '16.jpg', 'prochainement', 0, 'NonPopulaire', 'NonRecent', '2022-12-03 23:56:41'),
(17, '1 seule Maison', 'Ecologoie', '2023-01-11 00:00:00', '2023-01-14 23:59:00', 'Sauvons les pandas du monde en voie de disparition', '17.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:00:01'),
(18, 'Avant NOUS', 'Ecologoie', '2022-12-14 00:01:00', '2022-12-16 00:02:00', 'NOUS AIMONS LA POISCAILLE NOUS ETIONS DE LA POISCAILLE', '18.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:02:10'),
(19, 'UNE VIE SAUVER', 'Humanitaire', '2022-12-23 00:04:00', '2022-12-25 00:04:00', 'ADOPTER UN CHAT ET SAUVER UNE VIE', '19.jpeg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:04:53'),
(20, 'UNE PLANTE UNE VIE', 'Ecologoie', '2022-12-05 00:07:00', '2022-12-08 00:08:00', 'Plantons des arbres et sauvons notre belle planète', '20.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:08:08'),
(21, 'LA SANTER', 'Humanitaire', '2022-12-21 00:09:00', '2022-12-29 00:09:00', 'SANTER POUR TOUS ', '21.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:10:03'),
(22, 'TOUS HUMAIN', 'Humanitaire', '2022-12-10 00:11:00', '2022-12-17 00:11:00', 'Aidons nous, aidons les autres', '22.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:11:34'),
(23, 'Dons de vêtements', 'Humanitaire', '2022-12-21 00:12:00', '2022-12-22 00:12:00', 'Donner ce que vous ne mettez plus et faites des heureux', '23.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:13:01'),
(24, 'PRESERVONS NOUS', 'Humanitaire', '2022-12-22 00:14:00', '2022-12-28 00:14:00', 'Aider nous participer', '24.jpeg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:15:04'),
(25, 'UN MEDOC', 'Humanitaire', '2022-12-05 00:18:00', '2022-12-07 00:18:00', 'PARTICIPER', '25.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:18:22'),
(26, 'TOUS DES ENFANTS', 'Humanitaire', '2022-12-18 00:19:00', '2022-12-25 00:19:00', 'PARTICIPER!', '26.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:20:03'),
(27, 'HANDICAP', 'Humanitaire', '2023-01-11 00:22:00', '2023-01-25 00:22:00', 'PARTICIPER!', '27.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:22:17'),
(28, 'SOULEVONS NOUS', 'Humanitaire', '2023-02-10 00:23:00', '2023-02-28 00:23:00', 'BATTONS NOUS!', '28.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:24:07'),
(29, 'LEVER DE FOND', 'Humanitaire', '2022-12-15 00:25:00', '2022-12-24 00:25:00', 'PARTICIPER!', '29.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:25:13'),
(30, 'PARLONS SPORT', 'Sportif', '2022-12-04 00:26:00', '2022-12-06 00:26:00', 'JOURNER SPORTIF AVEC DE NOMBREUX CLUB. PARTICIPER!', '30.jpg', 'en-cours', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:26:28'),
(31, 'JOURNER GAMING', 'Jeux-Video', '2022-12-15 00:28:00', '2022-12-22 00:28:00', 'Pour tout les étudiants qui aime les jeux journée avec de nombreuses compétitions. Convivial, venez nombreux!', '31.jpeg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:28:35'),
(32, 'PREVENTION', 'Culturel', '2023-03-09 00:30:00', '2023-04-14 00:30:00', 'PREVENTION CONTRE LE CANCER DU SEINS ET SOUTIENT AUX FEMMES', '32.jpg', 'prochainement', 0, 'NonPopulaire', 'Recent', '2022-12-04 00:30:59');

-- --------------------------------------------------------

--
-- Structure de la table `Faq`
--

CREATE TABLE `Faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `reponse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Faq`
--

INSERT INTO `Faq` (`id`, `question`, `reponse`) VALUES
(1, 'Pouvons nous mettre des commentaires lorsque nous sommes pas membre du site?', 'Oui il est possible de émettre des avis même si vous n\'êtes pas recensé en tant que membre.'),
(2, 'Est ce que ça marche?', 'oui ça marche va te reposer!');

-- --------------------------------------------------------

--
-- Structure de la table `Organiser`
--

CREATE TABLE `Organiser` (
  `idEvent` bigint(20) UNSIGNED NOT NULL,
  `idAsso` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Organiser`
--

INSERT INTO `Organiser` (`idEvent`, `idAsso`) VALUES
(14, 91),
(15, 92),
(10, 93),
(16, 93),
(6, 96),
(17, 103),
(18, 104),
(19, 105),
(20, 106),
(21, 107),
(22, 108),
(23, 109),
(24, 110),
(25, 111),
(26, 112),
(27, 113),
(32, 114),
(28, 115),
(29, 116),
(30, 117),
(31, 118);

-- --------------------------------------------------------

--
-- Structure de la table `Participer`
--

CREATE TABLE `Participer` (
  `idUsers` bigint(20) UNSIGNED NOT NULL,
  `idEvents` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Participer`
--

INSERT INTO `Participer` (`idUsers`, `idEvents`) VALUES
(9, 6),
(12, 10),
(12, 14);

-- --------------------------------------------------------

--
-- Structure de la table `Signalement`
--

CREATE TABLE `Signalement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `raison` text NOT NULL,
  `idEvent` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Suivre`
--

CREATE TABLE `Suivre` (
  `idUsers` bigint(20) UNSIGNED NOT NULL,
  `idAssos` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Suivre`
--

INSERT INTO `Suivre` (`idUsers`, `idAssos`) VALUES
(9, 96),
(9, 94),
(9, 93),
(12, 93),
(12, 91),
(9, 91),
(11, 91),
(13, 91),
(13, 91),
(17, 91),
(9, 92);

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `PP` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`id`, `login`, `password`, `mail`, `PP`, `isAdmin`) VALUES
(2, 'merwan', '$2y$10$8clgnwIMbOxUYBYB4f4qjubOvLEuBs8jERzArIyt0dK1luBhbM.GG', 'merwan@gmail.com', 'Default.png', 0),
(9, 'Adil', '$2y$10$0OsItYqTRn3B3zmq2h4aW.M4le8Zd0ptq9HJ6HRm4GeQUGLcoWOaS', 'adil@gmail.com', '9.png', 1),
(11, 'Rayan', '$2y$10$Al9Y5LO0TDzIU2Tgguj60OjIL0273lzRT50isQWjI/q2popKz4JsW', 'rayan@gmail.com', '11.png', 0),
(12, 'Selma', '$2y$10$y0/Gsv0opud2gYH4TGl/JOjPDbGkCWsWSjcoLklpTYx7YAirLTIz2', 'selma@gmail.com', '12.jpeg', 0),
(13, 'Guylain', '$2y$10$0AY.Q7d03a1NJABNnwIae.idg.rJmJX3u/C2.hRQJijmRTyTlnujG', 'guylain@gmail.com', 'Default.png', 0),
(14, 'Geoffray ', '$2y$10$EJL9MGreit0MQwJxZ2n0TOZQ9IMYbr7K4Ad82CedN7ecdJCZaRY7K', 'groff@gmail.com', 'Default.png', 0),
(15, 'ninho', '$2y$10$3DOptaNVJeqGjEXWjVT28.o5/Y7G93CyJkJ59uAM6K5PUNNeuDgCi', 'ninho@gmail.com', '15.jpg', 0),
(16, 'Nasser', '$2y$10$woD55JWeWwvg4bubA9XLh.ghQZM.HlWiDGPQHiUNoPzrKmXbz2ahq', 'djanhit@gmail.com', '16.jpg', 0),
(17, 'NIRO', '$2y$10$o6LCL2.8vSJ7P5/.JO./AuH/W1AKq3f0glr2A9280jIdWs.UYnNFu', 'niro@gmail.com', '17.jpg', 0),
(18, 'Aurelien', '$2y$10$vIQictwOCqDYfqD.g6rTN.mgXvVdIdE1YzJC.C61ddorJAuS1Raqi', 'bossard@gmail.com', 'Default.png', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Associations`
--
ALTER TABLE `Associations`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `AvoirUnRole`
--
ALTER TABLE `AvoirUnRole`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_AvoirUnRole_Users` (`idUser`),
  ADD KEY `fk_AvoirUnRole_Assos` (`idAsso`);

--
-- Index pour la table `Events`
--
ALTER TABLE `Events`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `Faq`
--
ALTER TABLE `Faq`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `Organiser`
--
ALTER TABLE `Organiser`
  ADD PRIMARY KEY (`idEvent`,`idAsso`),
  ADD KEY `fk_idAsso` (`idAsso`);

--
-- Index pour la table `Participer`
--
ALTER TABLE `Participer`
  ADD PRIMARY KEY (`idUsers`,`idEvents`),
  ADD KEY `fk_idEvents` (`idEvents`);

--
-- Index pour la table `Signalement`
--
ALTER TABLE `Signalement`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_idEvent_signalement` (`idEvent`),
  ADD KEY `fk_idUser_signalement` (`idUser`);

--
-- Index pour la table `Suivre`
--
ALTER TABLE `Suivre`
  ADD KEY `fk_idUsers` (`idUsers`),
  ADD KEY `fk_idAssos` (`idAssos`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Associations`
--
ALTER TABLE `Associations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT pour la table `AvoirUnRole`
--
ALTER TABLE `AvoirUnRole`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `Faq`
--
ALTER TABLE `Faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Signalement`
--
ALTER TABLE `Signalement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Organiser`
--
ALTER TABLE `Organiser`
  ADD CONSTRAINT `fk_idAsso` FOREIGN KEY (`idAsso`) REFERENCES `associations` (`id`),
  ADD CONSTRAINT `fk_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `events` (`id`);

--
-- Contraintes pour la table `Participer`
--
ALTER TABLE `Participer`
  ADD CONSTRAINT `fk_idEvents` FOREIGN KEY (`idEvents`) REFERENCES `Events` (`id`),
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUsers`) REFERENCES `Users` (`id`);

--
-- Contraintes pour la table `Signalement`
--
ALTER TABLE `Signalement`
  ADD CONSTRAINT `fk_idEvent_signalement` FOREIGN KEY (`idEvent`) REFERENCES `Events` (`id`),
  ADD CONSTRAINT `fk_idUser_signalement` FOREIGN KEY (`idUser`) REFERENCES `Users` (`id`);

--
-- Contraintes pour la table `Suivre`
--
ALTER TABLE `Suivre`
  ADD CONSTRAINT `fk_idAssos` FOREIGN KEY (`idAssos`) REFERENCES `Associations` (`id`),
  ADD CONSTRAINT `fk_idUsers` FOREIGN KEY (`idUsers`) REFERENCES `Users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
