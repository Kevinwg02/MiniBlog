-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 14 mai 2021 à 07:43
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `modulepresse`
--

CREATE TABLE `modulepresse` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `texte` text NOT NULL,
  `created` datetime NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `modulepresse`
--

INSERT INTO `modulepresse` (`id`, `title`, `texte`, `created`, `img`) VALUES
(1, 'Yep, Pop OS 21.04 Will Have Exactly What You’ve Wanted', 'What’s the first thing you do after installing a fresh copy of Linux distro Pop OS? I’d wager the majority of you install Gnome Tweaks, Dash to Dock, or Dash to Panel. Jeremy Soller, Principal Engineer at System76 (the hardware company also responsible for developing Pop OS), is well aware of this.\r\n\r\n“90% of the screenshots on the Pop OS subreddit have a dock,” he says in my upcoming Linux For Everyone interview. “It’s something we want to provide out of the box.”\r\n\r\nFollowing that, Soller drops all kinds of info bombs regarding Pop OS 21.04 (yep, there will be a public beta). Specifically, System76 will be integrating Gnome-Tweaks and building upon it.', '2021-05-05 12:48:00', 'backoffice/office/admin/modules/presse/img/popos.png'),
(2, 'Astronaute, cosmonaute, spationaute, taïkonaute... Que cachent ces différentes appellations ?', 'homas Pesquet est-il un \"astronaute\", un \"cosmonaute\" ou un \"spationaute\" ? A partir de la fin avril, le Français va passer six mois à bord de la Station spatiale internationale (ISS). Il sera en colocation avec d\'autres personnes originaires de différents pays. Mais quel mot précis convient-il d\'utiliser pour parler d\'eux ? \"Etymologiquement, ils sont tous valables pour désigner un voyageur de l\'espace\", explique auprès de franceinfo Edouard Trouillez, lexicographe aux éditions Le Robert. \r\n\r\n\"Astronaute\" vient des mots grecs astron (étoile) et nautes (navigateur). \"Cosmonaute\" trouve lui son origine dans les mots grecs kosmos (univers) et nautes. \"Spationaute\" est en revanche un mot hybride avec un mot latin spatium (espace) et, encore une fois, nautes. En fait, la différence entre tous ces termes réside uniquement dans les passeports des personnes concernées.', '2021-05-05 09:37:00', 'backoffice/admin/modules/presse/img/astro.jpg'),
(3, 'AFSF goes homeschool', ' Florence Fabricant By Florence Fabricant Feb. 1, 2021 Spoons Across America — founded 19 years ago to enhance children’s understanding of cooking and health — has arranged for chefs and food professionals to visit New York City classrooms for interactive teaching sessions. This year, with the reduction and often elimination of in-person schooling, the nonprofit organization has created in-home courses for children to complete with their parents. The Food Exploration Project, suitable for children ages 8 to 11 nationwide, covers elements of taste, seasonal food, nutrition labels, healthy snacking and more, in nine sessions, each about 45 minutes to an hour long. The kit ($30) includes a guide for parents, an activity journal for the child, a child’s knife and an apron. Equipment for additional children is $10 each. There are also two free courses issuing new material twice a month, one called Food Explorers Club (for children ages 8 to 11) and a series of food-related story book segments (for children ages 6 to 7), both offering video sessions with printable materials.', '2021-04-29 21:08:00', 'backoffice/admin/modules/presse/img/dwwm.jpg'),
(4, 'C\'est reparti pour un tour : une première bêta pour macOS 11.4', 'Mise à jour — Malgré le nombre de Mac M1 qui occupent de plus en place dans son catalogue, Apple n\'en oublie pas pour autant les bons vieux Mac Intel ! Les notes de version de cette première bêta annoncent que macOS 11.4 permettra d\'utiliser des cartes graphiques AMD 6800, 6800XT et 6900XT (architecture Navi RDNA2).', '2021-05-05 12:48:00', 'backoffice/admin/modules/presse/img/Mac16.jpg'),
(5, 'NBA: LES MAVERICKS S\'OFFRENT LES NETS, LES LAKERS S\'ENFONCENT CONTRE LES CLIPPERS', 'La mauvaise série continue pour Brooklyn, après un revers contre Portland et deux face à Milwaukee qui ne se retrouve, du coup, plus qu\'à une victoire des New-Yorkais pour s\'emparer de la 2e place à l’Est. Sous les yeux de l\'ex-gloire des Mavs Dirk Nowitzki et de l\'ancien président américain George W. Bush, ce dernier l\'emportant à l\'applaudimètre dans l\'American Airlines Center rempli à environ 20% de sa capacité, les Texans ont fait la différence dans le dernier quart-temps quand Luka Doncic a mis son «fade away» (shoot en suspension arrière) pour donner six longueurs d\'avance aux siens. Le Slovène a ainsi été prépondérant (24 pts, 10 rbds, 8 passes), bien aidé par Tim Hardaway Jr (23 pts), permettant ainsi à Dallas de rester 5e à l’Ouest. En face, les efforts d\'Irving ont été vains (5 rbds, 4 passes, 4 interceptions), d\'autant que Kevin Durant n\'était pas dans un grand soir (20 pts, 9 rbds).', '2021-05-05 12:48:00', 'backoffice/admin/modules/presse/img/nba.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `Grade` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `login`, `Grade`, `pass`) VALUES
(1, 'waag', 'kevin', 'root', 'Admin', '5058f1af8388633f609cadb75a75dc9d');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `modulepresse`
--
ALTER TABLE `modulepresse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `modulepresse`
--
ALTER TABLE `modulepresse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
