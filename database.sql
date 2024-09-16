CREATE TABLE `authors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `authors` VALUES (1,'Pierre','Boulle',NULL);
INSERT INTO `authors` VALUES (2,'Luiz Eduardo','de Oliveira','Leo');
INSERT INTO `authors` VALUES (3,'Isaac','Asimov',NULL);
INSERT INTO `authors` VALUES (4,'Robert','Silverberg',NULL);


CREATE TABLE `books` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `description` text,
  `exchangeable` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` VALUES (2,'La planète des singes','la-planete-des-singes.webp','Y a-t-il des êtres humains ailleurs que dans notre galaxie ? C\'est la question que se pose Ulysse Mérou, lorsque, de leur vaisseau spatial, ils observent le paysage d\'une planète proche de Bételgeuse : on y aperçoit des villes, des routes curieusement semblables à celle de notre terre. Après s\'y être posés, les trois hommes découvrent que la planète est habitée par des singes.\nCeux-ci s\'emparent d\'Ulysse Mérou et se livrent sur lui à des expériences. Il faudra que le journaliste fasse, devant les singes, la preuve de son humanité...',0);
INSERT INTO `books` VALUES (3,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 1 : La catastrophe','aldebaran-t1.webp','Aldébaran, quelque part dans l\'espace et dans le futur... Une planète accueillante où s\'est installée, en 2079, la première colonie terrienne envoyée au-delà du système solaire. C\'était il y a plus de cent ans, déjà. Depuis, les liaisons radio sont coupées. Alors, peu à peu, la vie s\'est organisée. Un jour, d\'étranges phénomènes surviennent: des créatures marines aux formes curieuses apparaissent. L\'eau devient solide. La mantrisse, cette chose douée de raison et d\'intelligence, commence à faire parler d\'elle… Plonger dans la lecture d\'Aldébaran est une expérience envoûtante. Le dessinateur Moebius, qui signe la préface, décrit d\'ailleurs les lecteurs de la série comme \"une des sectes les plus sympathiques et inoffensives qui soient\". Le charme est d\'autant plus redoutable qu\'il agit lentement, tel un anesthésiant. Et le dessin de Léo est étonnant : ici, pas d\'esbroufe ni d\'effets de style. Nulle trace de cette surenchère graphique si fréquente dans les récits de science-fiction. Juste un trait réaliste et sobre qui donne parfois l\'impression que tout se passe aujourd\'hui, près de nous…',1);
INSERT INTO `books` VALUES (4,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 2 : La blonde','aldebaran-t2.webp','Aldébaran, quelque part dans l\'espace et dans le futur...\nUne planète accueillante où s\'est installée, en 2079, la première colonie terrienne envoyée au-delà du système solaire. C\'était il y a plus de cent ans, déjà. Depuis, les liaisons radio sont coupées. Alors, peu à peu, la vie s\'est organisée. Un jour, d\'étranges phénomènes surviennent : des créatures marines aux formes curieuses apparaissent. L\'eau devient solide. La mantrisse, cette chose douée de raison et d\'intelligence, commence à faire parler d\'elle…\nPlonger dans la lecture d\'\"Aldébaran\" est une expérience envoûtante. Le dessinateur Moebius, qui signe la préface, décrit d\'ailleurs les lecteurs de la série comme \"une des sectes les plus sympathiques et inoffensives qui soient\". Le charme est d\'autant plus redoutable qu\'il agit lentement, tel un anesthésiant. Et le dessin de Léo est étonnant : ici, pas d\'esbroufe ni d\'effets de style. Nulle trace de cette surenchère graphique si fréquente dans les récits de science-fiction. Juste un trait réaliste et sobre qui donne parfois l\'impression que tout se passe aujourd\'hui, près de nous…',1);
INSERT INTO `books` VALUES (5,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 3 : La photo','aldebaran-t3.webp','Nous retrouvons Aldebaran, la planète où a été fondée la première colonie humaine hors du système solaire. Les habitants d\'Arena Blanca y vivaient heureux, loin de la tyrannie de l\'armée et de Monseigneur Algernon Loomis, jusqu\'à ce qu\'un monstre marin les engloutisse sous une marée de bave. Parmi les rescapés, Marc et Kim, deux ados qui s\'entendent comme chien et chat, tentent de rejoindre Anatolie, la capitale. C\'est là qu\'ils tombent sur \"la blonde\", Alexa, biologiste et amie de Driss, l\'homme qui en savait long sur la catastrophe d\'Arena. Marc croupit dans une prison depuis trois ans et demi, mais Monsieur Pad, curieux petit bonhomme et magouilleur de première, le fait évader. A Anatolie, Marc retrouve Gwen, la fille du sénateur Valdomiro Lopes, José le musicien, et Kim, qui a changé : d\'ado anguleuse, elle est devenue une bien jolie jeune fille. Mais les choses n\'étant jamais simples, José est amoureux de Kim, qui aime Marc, qui aime sûrement Kim mais ne le sait pas encore. Quant à Driss et Alexa, ils sont sur une île, en train de guetter l\'arrivée des grégoires, sympathiques bestioles d\'environ cinq tonnes qui seraient l\'une des formes de la mantrisse, le colossal monstre marin doué d\'intelligence. Pendant ce temps, Marc, Kim et Monsieur Pad s\'introduisent clandestinement au musée d\'Anatolie et étudient d\'étranges photos qui, décidément, posent sur Alexa et Driss une foule de questions sans réponse. Après la Catastrophe et la Blonde, le troisième volet d\'une aventure envoûtante, entre fantastique et SF, pleine de mystères, d\'inventions pittoresques et d\'amours compliquées.',1);
INSERT INTO `books` VALUES (6,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 4 : Le groupe','aldebaran-t4.webp','Pour les colons terriens qui occupent la planète Aldebaran, tout semble planifié. Mais peu à peu des événements insolites se produisent. Sans nouvelles de la Terre, Aldebaran est isolée. Coupés de tout contact, les habitants d\'Aldebaran doivent faire face à plusieurs bouleversements aux conséquences inquiétantes. Le danger principal semble venir de l\'océan d\'où surgissent des créatures monstrueuses et hostiles. Mais qui possède vraiment une explication à cette évolution aussi terrifiante qu\'incontrôlable ? Marc et Kim, deux adolescents qui ont survécu à l\'anéantissement de leur village, rejoignent la capitale, Anatolie, afin de trouver une réponse. Une série captivante qui sera bientôt suivie par un nouveau cycle : Bételgeuse.',0);
INSERT INTO `books` VALUES (7,'Les mondes d\'Aldébaran - Cycle 1 d\'Aldébaran, tome 5 : La créature','aldebaran-t5.webp','Aldébaran, quelque part dans l\'espace et dans le futur... Une planète accueillante où s\'est installée, en 2079, la première colonie terrienne envoyée au-delà du système solaire. C\'était il y a plus de cent ans, déjà. Depuis, les liaisons radio sont coupées. Alors, peu à peu, la vie s\'est organisée. Un jour, d\'étranges phénomènes surviennent : des créatures marines aux formes curieuses apparaissent. L\'eau devient solide. La mantrisse, cette chose douée de raison et d\'intelligence, commence à faire parler d\'elle… Plonger dans la lecture d\'\"Aldébaran\" est une expérience envoûtante. Le dessinateur Moebius, qui signe la préface, décrit d\'ailleurs les lecteurs de la série comme \"une des sectes les plus sympathiques et inoffensives qui soient\". Le charme est d\'autant plus redoutable qu\'il agit lentement, tel un anesthésiant. Et le dessin de Léo est étonnant : ici, pas d\'esbroufe ni d\'effets de style. Nulle trace de cette surenchère graphique si fréquente dans les récits de science-fiction. Juste un trait réaliste et sobre qui donne parfois l\'impression que tout se passe aujourd\'hui, près de nous… -Philippe Actère-\nHeureusement, l\'histoire n\'est pas finie, car l\'auteur nous annonce le départ d\'un astronef pour Bételgeuse, constellation d\'Orion...',0);
INSERT INTO `books` VALUES (8,'Tout sauf un homme','tout-sauf-un-homme.webp','La petite fille n\'a jamais voulu croire qu\'il s\'appelle NDR-113 ; elle l\'a appelé Andrew ; le nom lui restera. De fait, Andrew n\'est pas un robot comme les autres. A peine est-il entré au service des Martin qu\'il se lance dans la sculpture sur bois, où il fait preuve de dons éclatants. Se pourrait-il qu\'un moins qu\'humain soit génial ? Petite Mademoiselle grandit. Elle voudrait qu\'Andrew obtienne la liberté, ce dont la société qui l\'a construit ne veut à aucun prix. Elle voudrait qu\'il soit transféré dans un corps de chair. Il obtiendra même, sans l\'avoir voulu, d\'être reconnu comme un bienfaiteur de l\'humamité. Mais il reste immortel, et pour lui, à ce titre, il est difficile d\'être un homme.',1);


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


CREATE TABLE `messages` (
  `id` int unsigned NOT NULL,
  `from_id` int unsigned DEFAULT NULL,
  `to_id` int unsigned DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `messages_users_FK` (`from_id`),
  KEY `messages_users_FK_1` (`to_id`),
  CONSTRAINT `messages_users_FK` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `messages_users_FK_1` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_unique` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
