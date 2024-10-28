CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `hashed_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL DEFAULT '',
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_unique` (`email`),
  UNIQUE KEY `users_unique_1` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` VALUES (3,'Jocelyn','jocelyn@example.org','$2y$10$F1ZwD57VeutAp9kVlpg8nevu5uMKK2egqKq3QOZvx3vMlD8hKVEzK','2022-04-02 15:00:56');
INSERT INTO `users` VALUES (4,'John','john@example.org','$2y$10$BxUvygmqRpdVrAFsyaS0Reb3jf9FkXNgo9p8K8IYpoOtmXjkHCZFy','2024-09-25 20:25:56');
INSERT INTO `users` VALUES (5,'Jeanne','jeanne@example.org','$2y$10$Zae4RkaKbKph5ZaFCrEmQOJXr/GvuzBoBIvecArNLsiY8jlSl7.wK','2024-08-23 15:00:56');
INSERT INTO `users` VALUES (27,'Jim','jim@example.org','$2y$10$mwz/dLIj6VNXPjlnFyXsGu2bqI0Rw154MI9DpmaE6tQ8SbmWn0C6C','2024-10-03 15:00:56');
INSERT INTO `users` VALUES (39,'Charline','charline@example.org','$2y$10$gdG9Rh81VexJbOsqyceE.eJYVlm9aWYnziCicmxVj163v9GNxUhSG','2024-09-23 16:33:42');
INSERT INTO `users` VALUES (71,'Mélanie','melanie@example.org','$2y$10$JfJ789OLA.teFy7XuY.M3OdJyHP.0eEjPpe25zIlPnfzD/B8dZFQG','2024-10-02 19:00:27');
INSERT INTO `users` VALUES (77,'Tom','tom@example.org','$2y$10$NZoR0qEYysJMWNE9Al40BOFY8WjW6oHpDb4PBAjJmouSuLKQEdz7e','2024-10-22 16:56:57');


CREATE TABLE `authors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `nickname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `authors_unique` (`first_name`,`last_name`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `authors` VALUES (1,'Pierre','Boulle','');
INSERT INTO `authors` VALUES (2,'Luiz Eduardo','de Oliveira','Leo');
INSERT INTO `authors` VALUES (3,'Isaac','Asimov','');
INSERT INTO `authors` VALUES (4,'Robert','Silverberg','');
INSERT INTO `authors` VALUES (5,'Jean','Van Hamme','');
INSERT INTO `authors` VALUES (6,'René','Sterne','');
INSERT INTO `authors` VALUES (7,'Chantal','de Spiegeleer','');
INSERT INTO `authors` VALUES (8,'Antoine','Aubin','');
INSERT INTO `authors` VALUES (9,'Étienne','Schréder','');
INSERT INTO `authors` VALUES (10,'Yves','Sente','');
INSERT INTO `authors` VALUES (11,'André','Juillard','');
INSERT INTO `authors` VALUES (12,'André','Franquin','Franquin');
INSERT INTO `authors` VALUES (13,'Philippe',' Francq','');
INSERT INTO `authors` VALUES (14,'Éric','Giacometti','');
INSERT INTO `authors` VALUES (15,'Bertrand','Denoulet','');


CREATE TABLE `books` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `exchangeable` tinyint(1) NOT NULL DEFAULT '0',
  `owner_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_users_FK` (`owner_id`),
  CONSTRAINT `books_users_FK` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` VALUES (2,'La planète des singes','Y a-t-il des êtres humains ailleurs que dans notre galaxie ? C\'est la question que se pose Ulysse Mérou, lorsque, de leur vaisseau spatial, ils observent le paysage d\'une planète proche de Bételgeuse : on y aperçoit des villes, des routes curieusement semblables à celle de notre terre. Après s\'y être posés, les trois hommes découvrent que la planète est habitée par des singes.\r\nCeux-ci s\'emparent d\'Ulysse Mérou et se livrent sur lui à des expériences. Il faudra que le journaliste fasse, devant les singes, la preuve de son humanité...',0,3);
INSERT INTO `books` VALUES (3,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 1 : La catastrophe','test de commentaire2',1,3);
INSERT INTO `books` VALUES (4,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 2 : La blonde','Aldébaran, quelque part dans l\'espace et dans le futur...\r\nUne planète accueillante où s\'est installée, en 2079, la première colonie terrienne envoyée au-delà du système solaire. C\'était il y a plus de cent ans, déjà. Depuis, les liaisons radio sont coupées. Alors, peu à peu, la vie s\'est organisée. Un jour, d\'étranges phénomènes surviennent : des créatures marines aux formes curieuses apparaissent. L\'eau devient solide. La mantrisse, cette chose douée de raison et d\'intelligence, commence à faire parler d\'elle…\r\nPlonger dans la lecture d\'\"Aldébaran\" est une expérience envoûtante. Le dessinateur Moebius, qui signe la préface, décrit d\'ailleurs les lecteurs de la série comme \"une des sectes les plus sympathiques et inoffensives qui soient\". Le charme est d\'autant plus redoutable qu\'il agit lentement, tel un anesthésiant. Et le dessin de Léo est étonnant : ici, pas d\'esbroufe ni d\'effets de style. Nulle trace de cette surenchère graphique si fréquente dans les récits de science-fiction. Juste un trait réaliste et sobre qui donne parfois l\'impression que tout se passe aujourd\'hui, près de nous…',1,3);
INSERT INTO `books` VALUES (5,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 3 : La photo','Nous retrouvons Aldebaran, la planète où a été fondée la première colonie humaine hors du système solaire. Les habitants d\'Arena Blanca y vivaient heureux, loin de la tyrannie de l\'armée et de Monseigneur Algernon Loomis, jusqu\'à ce qu\'un monstre marin les engloutisse sous une marée de bave. Parmi les rescapés, Marc et Kim, deux ados qui s\'entendent comme chien et chat, tentent de rejoindre Anatolie, la capitale. C\'est là qu\'ils tombent sur \"la blonde\", Alexa, biologiste et amie de Driss, l\'homme qui en savait long sur la catastrophe d\'Arena. Marc croupit dans une prison depuis trois ans et demi, mais Monsieur Pad, curieux petit bonhomme et magouilleur de première, le fait évader. A Anatolie, Marc retrouve Gwen, la fille du sénateur Valdomiro Lopes, José le musicien, et Kim, qui a changé : d\'ado anguleuse, elle est devenue une bien jolie jeune fille. Mais les choses n\'étant jamais simples, José est amoureux de Kim, qui aime Marc, qui aime sûrement Kim mais ne le sait pas encore. Quant à Driss et Alexa, ils sont sur une île, en train de guetter l\'arrivée des grégoires, sympathiques bestioles d\'environ cinq tonnes qui seraient l\'une des formes de la mantrisse, le colossal monstre marin doué d\'intelligence. Pendant ce temps, Marc, Kim et Monsieur Pad s\'introduisent clandestinement au musée d\'Anatolie et étudient d\'étranges photos qui, décidément, posent sur Alexa et Driss une foule de questions sans réponse. Après la Catastrophe et la Blonde, le troisième volet d\'une aventure envoûtante, entre fantastique et SF, pleine de mystères, d\'inventions pittoresques et d\'amours compliquées.',1,3);
INSERT INTO `books` VALUES (6,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 4 : Le groupe','Pour les colons terriens qui occupent la planète Aldebaran, tout semble planifié. Mais peu à peu des événements insolites se produisent. Sans nouvelles de la Terre, Aldebaran est isolée. Coupés de tout contact, les habitants d\'Aldebaran doivent faire face à plusieurs bouleversements aux conséquences inquiétantes. Le danger principal semble venir de l\'océan d\'où surgissent des créatures monstrueuses et hostiles. Mais qui possède vraiment une explication à cette évolution aussi terrifiante qu\'incontrôlable ? Marc et Kim, deux adolescents qui ont survécu à l\'anéantissement de leur village, rejoignent la capitale, Anatolie, afin de trouver une réponse. Une série captivante qui sera bientôt suivie par un nouveau cycle : Bételgeuse.',0,3);
INSERT INTO `books` VALUES (7,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 5 : La créature','Aldébaran, quelque part dans l\'espace et dans le futur... Une planète accueillante où s\'est installée, en 2079, la première colonie terrienne envoyée au-delà du système solaire. C\'était il y a plus de cent ans, déjà. Depuis, les liaisons radio sont coupées. Alors, peu à peu, la vie s\'est organisée. Un jour, d\'étranges phénomènes surviennent : des créatures marines aux formes curieuses apparaissent. L\'eau devient solide. La mantrisse, cette chose douée de raison et d\'intelligence, commence à faire parler d\'elle… Plonger dans la lecture d\'\"Aldébaran\" est une expérience envoûtante. Le dessinateur Moebius, qui signe la préface, décrit d\'ailleurs les lecteurs de la série comme \"une des sectes les plus sympathiques et inoffensives qui soient\". Le charme est d\'autant plus redoutable qu\'il agit lentement, tel un anesthésiant. Et le dessin de Léo est étonnant : ici, pas d\'esbroufe ni d\'effets de style. Nulle trace de cette surenchère graphique si fréquente dans les récits de science-fiction. Juste un trait réaliste et sobre qui donne parfois l\'impression que tout se passe aujourd\'hui, près de nous… -Philippe Actère-\nHeureusement, l\'histoire n\'est pas finie, car l\'auteur nous annonce le départ d\'un astronef pour Bételgeuse, constellation d\'Orion...',0,3);
INSERT INTO `books` VALUES (8,'Tout sauf un homme','La petite fille n\'a jamais voulu croire qu\'il s\'appelle NDR-113 ; elle l\'a appelé Andrew ; le nom lui restera. De fait, Andrew n\'est pas un robot comme les autres. A peine est-il entré au service des Martin qu\'il se lance dans la sculpture sur bois, où il fait preuve de dons éclatants. Se pourrait-il qu\'un moins qu\'humain soit génial ? Petite Mademoiselle grandit. Elle voudrait qu\'Andrew obtienne la liberté, ce dont la société qui l\'a construit ne veut à aucun prix. Elle voudrait qu\'il soit transféré dans un corps de chair. Il obtiendra même, sans l\'avoir voulu, d\'être reconnu comme un bienfaiteur de l\'humanité. Mais il reste immortel, et pour lui, à ce titre, il est difficile d\'être un homme.',1,27);
INSERT INTO `books` VALUES (9,'La Malédiction des Trente Deniers - Tome 1','',1,4);
INSERT INTO `books` VALUES (10,'La Malédiction des Trente Deniers - Tome 2','',1,4);
INSERT INTO `books` VALUES (11,'Le Bâton de Plutarque','',1,39);
INSERT INTO `books` VALUES (12,'Lagaffe nous gâte','',1,71);
INSERT INTO `books` VALUES (13,'La frontière de la nuit','',1,5);
INSERT INTO `books` VALUES (14,'Le Centile d\'or','',1,5);


CREATE TABLE `books_authors` (
  `book_id` int unsigned NOT NULL,
  `author_id` int unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `books_authors_authors_FK` (`author_id`),
  CONSTRAINT `books_authors_authors_FK` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `books_authors_books_FK` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books_authors` VALUES (2,1);
INSERT INTO `books_authors` VALUES (3,2);
INSERT INTO `books_authors` VALUES (4,2);
INSERT INTO `books_authors` VALUES (5,2);
INSERT INTO `books_authors` VALUES (6,2);
INSERT INTO `books_authors` VALUES (7,2);
INSERT INTO `books_authors` VALUES (8,3);
INSERT INTO `books_authors` VALUES (8,4);
INSERT INTO `books_authors` VALUES (9,5);
INSERT INTO `books_authors` VALUES (10,5);
INSERT INTO `books_authors` VALUES (9,6);
INSERT INTO `books_authors` VALUES (9,7);
INSERT INTO `books_authors` VALUES (10,8);
INSERT INTO `books_authors` VALUES (10,9);
INSERT INTO `books_authors` VALUES (11,10);
INSERT INTO `books_authors` VALUES (11,11);
INSERT INTO `books_authors` VALUES (12,12);
INSERT INTO `books_authors` VALUES (13,13);
INSERT INTO `books_authors` VALUES (14,13);
INSERT INTO `books_authors` VALUES (13,14);
INSERT INTO `books_authors` VALUES (14,14);
INSERT INTO `books_authors` VALUES (13,15);
INSERT INTO `books_authors` VALUES (14,15);


CREATE TABLE `messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int unsigned NOT NULL,
  `to_id` int unsigned NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `messages_users_FK` (`from_id`),
  KEY `messages_users_FK_1` (`to_id`),
  CONSTRAINT `messages_users_FK` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `messages_users_FK_1` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `messages` VALUES (1,5,3,'test de message de Jeanne pour Jocelyn','2024-10-15 22:25:20',1);
INSERT INTO `messages` VALUES (3,27,3,'test','2024-10-15 22:30:19',1);
INSERT INTO `messages` VALUES (4,39,5,'test','2024-10-15 22:30:19',0);
INSERT INTO `messages` VALUES (5,71,3,'Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor','2024-10-15 22:30:19',1);
INSERT INTO `messages` VALUES (6,71,3,'test message 2','2024-10-16 02:37:11',1);
INSERT INTO `messages` VALUES (7,3,71,'Merci pour cette information !','2024-10-16 14:17:08',0);
INSERT INTO `messages` VALUES (20,3,27,'Désolé je n\'ai rien compris 😟','2024-10-16 14:56:18',1);
INSERT INTO `messages` VALUES (21,3,27,'essai emoji 🦒🐸🐘🪼🦋','2024-10-16 14:57:19',1);
INSERT INTO `messages` VALUES (22,27,3,'Oh c\'est joli !','2024-10-16 14:58:28',1);
INSERT INTO `messages` VALUES (23,27,3,'moi aussi j\'aime les emoji ;☺️🎃🥐🥘🍦🚲🚀','2024-10-16 15:00:15',1);
INSERT INTO `messages` VALUES (24,3,27,'Bon si on parlait un peu de nos livres ?','2024-10-16 15:00:42',1);
INSERT INTO `messages` VALUES (25,27,3,'J\'aime bien les livres de science-fiction, et toi ?','2024-10-16 15:01:24',1);
INSERT INTO `messages` VALUES (26,3,27,'Moi aussi ! Je te conseille la série \"Les mondes d\'Aldébaran\". 😍','2024-10-16 15:02:57',1);
INSERT INTO `messages` VALUES (27,27,3,'Merci je vais essayer, j\'aime bien les bandes dessinées.','2024-10-16 15:32:26',1);
INSERT INTO `messages` VALUES (28,3,39,'Bonjour, le livre \"Le Bâton de Plutarque\" m\'intéresse. Combien le vends-tu ? Merci','2024-10-16 15:48:12',1);
INSERT INTO `messages` VALUES (29,3,27,'👍','2024-10-16 16:14:02',1);
INSERT INTO `messages` VALUES (30,3,5,'Coucou :-)','2024-10-21 16:13:00',0);
INSERT INTO `messages` VALUES (31,3,39,'Tu es là ?','2024-10-22 21:02:22',1);
INSERT INTO `messages` VALUES (32,3,39,'dommage...','2024-10-22 21:10:34',1);
INSERT INTO `messages` VALUES (33,3,4,'Bonjour, est-ce que tu as des livres à échanger ?','2024-10-22 21:12:09',0);
INSERT INTO `messages` VALUES (34,3,4,'Je cherche des livres de science-fiction intéressants.','2024-10-22 21:37:52',0);
