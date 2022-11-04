-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 nov. 2022 à 10:22
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `messages_prives`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat_general`
--

DROP TABLE IF EXISTS `chat_general`;
CREATE TABLE IF NOT EXISTS `chat_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_auteur` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chat_general`
--

INSERT INTO `chat_general` (`id`, `id_auteur`, `message`) VALUES
(78, 26, 'Bonjour toto tu vas bien ?'),
(77, 38, 'Bonjour'),
(76, 37, 'Tu vas bien rob ?'),
(75, 26, 'Bonjour'),
(74, 37, 'Bonjour'),
(73, 26, 'Bonjour Kelly'),
(72, 36, 'Bonjour Gabriel'),
(71, 35, 'lol'),
(70, 35, 'test'),
(69, 35, 'test'),
(68, 35, 'Petit message'),
(67, 26, 'Coucou Gabriel'),
(66, 35, 'Coucou'),
(65, 26, 'test'),
(64, 32, 'bonjour'),
(63, 28, 'salut'),
(62, 28, 'salut'),
(61, 26, 'test'),
(60, 26, 'test'),
(59, 28, 'test'),
(58, 28, 'test'),
(57, 28, 'test'),
(56, 26, 'test'),
(55, 28, 'test'),
(54, 26, 'test'),
(53, 26, 'Lol'),
(52, 26, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `message`, `id_destinataire`, `id_auteur`) VALUES
(100, 'Bonjour', 38, 26),
(99, 'Bonjour', 26, 38),
(98, 'Bonjour ça va ?', 26, 36),
(97, 'Bonjour', 36, 26),
(96, 'test', 26, 26),
(95, 'test', 33, 32),
(94, 'test', 32, 32),
(93, 'test', 32, 32),
(92, 'test', 32, 32),
(91, 'Bonjour', 26, 31),
(90, 'Bonjour', 31, 26),
(89, 'test', 26, 32),
(88, 'random', 28, 26),
(87, 'test', 28, 26),
(86, 'bobo', 28, 26),
(85, 'test', 28, 26),
(84, 'test', 26, 31),
(83, 'test', 31, 26),
(82, 'test', 26, 31),
(81, 'test', 26, 31),
(80, 'test', 31, 31),
(79, 'test', 31, 31),
(78, 'test', 26, 28),
(77, 'test', 26, 28),
(76, 'test', 26, 28),
(75, 'Coucou rob c\'est Lolita', 26, 28),
(74, 'Coucou Lolita c\'est rob', 28, 26);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `mdp` text NOT NULL,
  `email` text NOT NULL,
  `cle` int(11) NOT NULL,
  `confirme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mdp`, `email`, `cle`, `confirme`) VALUES
(32, 'rogerdu59', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'rogerdu59@gmail.com', 4008836, 0),
(28, 'Lolita', 'dc1af77d2e5ce67bbc5547b1bb56771c0b952c77', 'lolita@gmail.com', 7262436, 0),
(27, 'Noopy', '9bae191728776429ac6c8b87a008bd428cfef637', 'noopy@gmail.com', 8279023, 0),
(25, 'Test', '403926033d001b5279df37cbbe5287b7c7c267fa', 'lalegendedebig@gmail.com', 7902928, 0),
(26, 'rob', '7e09c9d3e96378bf549fc283fd6e1e5b7014cc33', 'jjjj@gmail.com', 4944873, 0),
(31, 'Toto', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'Toto@gmail.com', 1772140, 0),
(33, 'Oumayma', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Oumayma@gmail.com', 8852336, 0),
(35, 'Gabriel', '18a98c35f49808b45edadc75fb1b25ebfd4037d6', 'gabriel@gmail.com', 5060159, 0),
(36, 'Kelly', '1ae6224804504b3fc03ce7710254958474dfd9a9', 'kelly@gmail.com', 3876909, 0),
(37, 'Harry', '23a0b5e4fb6c6e8280940920212ecd563859cb3c', 'harry@gmail.com', 5348518, 0),
(38, 'totodu93', '8a8db8355e296199a8d165a8cea20c70e9b9acf9', 'totodu93@gmail.com', 2483121, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
