DROP TABLE Article;

CREATE TABLE `Article` (
  `ID_article` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `datum_vydani` date DEFAULT NULL,
  `soubor` text,
  `soubor2` varchar(255) DEFAULT NULL,
  `ID_user` int DEFAULT NULL,
  PRIMARY KEY (`ID_article`),
  KEY `ID_user` (`ID_user`),
  CONSTRAINT `Article_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `Users` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO Article VALUES("1","Jak přežít","","1-2022-11-30-1.docx","1-2022-11-30-2.docx","1");
INSERT INTO Article VALUES("2","Jak přidat článek","","2-2022-11-30-1.docx","2-2022-12-02-2.pdf","1");
INSERT INTO Article VALUES("3","Testovací článek","","3-2022-12-04-1.docx","3-2022-12-04-2.docx","1");
INSERT INTO Article VALUES("4","Jak nahrat clanek 2","","4-2022-12-17-1.docx","","5");
INSERT INTO Article VALUES("5","Help pls","","5-2022-12-17-1.docx","","1");
INSERT INTO Article VALUES("6","Článek o ŘSP","","6-2022-12-18-1.pdf","","1");
INSERT INTO Article VALUES("7","testovací článek","","7-2022-12-18-1.docx","","1");
INSERT INTO Article VALUES("8","článek o článku","","8-2022-12-18-1.docx","","1");
INSERT INTO Article VALUES("9","článek","","9-2022-12-18-1.pdf","","1");
INSERT INTO Article VALUES("10","sdfsdf","","10-2022-12-19-1.docx","","5");
INSERT INTO Article VALUES("11","sdafsdf","","11-2022-12-19-1.docx","","5");



DROP TABLE Journal;

CREATE TABLE `Journal` (
  `ID_journal` int NOT NULL AUTO_INCREMENT,
  `vydani` varchar(50) DEFAULT NULL,
  `ID_article` int NOT NULL,
  PRIMARY KEY (`ID_journal`),
  UNIQUE KEY `vydani` (`vydani`),
  KEY `ID_article` (`ID_article`),
  CONSTRAINT `Journal_ibfk_1` FOREIGN KEY (`ID_article`) REFERENCES `Article` (`ID_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




DROP TABLE Recenze;

CREATE TABLE `Recenze` (
  `ID_recenze` int NOT NULL AUTO_INCREMENT,
  `originalita` int DEFAULT NULL,
  `aktualnost` int DEFAULT NULL,
  `jazyk` int DEFAULT NULL,
  `odbornost` int DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `datum_recenze` date DEFAULT NULL,
  `datum_vytvoreni` date DEFAULT NULL,
  `recenzent` int NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'CREATED',
  PRIMARY KEY (`ID_recenze`),
  KEY `recenzent` (`recenzent`),
  CONSTRAINT `Recenze_ibfk_1` FOREIGN KEY (`recenzent`) REFERENCES `Users` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO Recenze VALUES("1","3","2","2","2","asa","2022-11-30","2022-11-30","2","APPROVED");
INSERT INTO Recenze VALUES("2","3","4","3","2","has","2022-11-30","2022-11-30","6","APPROVED");
INSERT INTO Recenze VALUES("3","2","3","1","4","super recenze
","2022-11-30","2022-11-30","2","CREATED");
INSERT INTO Recenze VALUES("4","5","5","1","3","dobry","2022-11-30","2022-11-30","6","CREATED");
INSERT INTO Recenze VALUES("5","4","5","2","3","Velice zajímavý článek.","2022-12-04","2022-12-04","2","CREATED");
INSERT INTO Recenze VALUES("6","1","1","1","1","Tento článek se mi nelíbí.","2022-12-04","2022-12-04","6","CREATED");
INSERT INTO Recenze VALUES("7","5","3","4","5","pog","2022-12-17","2022-12-17","2","APPROVED");
INSERT INTO Recenze VALUES("8","3","4","1","4","lool","2022-12-17","2022-12-17","6","APPROVED");
INSERT INTO Recenze VALUES("9","","","","","","","2022-12-18","2","CREATED");
INSERT INTO Recenze VALUES("10","","","","","","","2022-12-18","2","CREATED");
INSERT INTO Recenze VALUES("11","","","","","","","2022-12-18","2","CREATED");
INSERT INTO Recenze VALUES("12","","","","","","","2022-12-18","6","CREATED");
INSERT INTO Recenze VALUES("13","","","","","","","2022-12-18","6","CREATED");
INSERT INTO Recenze VALUES("14","2","1","4","3","supr","2022-12-18","2022-12-18","2","REVIEWED");



DROP TABLE Rizeni;

CREATE TABLE `Rizeni` (
  `ID_rizeni` int NOT NULL AUTO_INCREMENT,
  `ID_redaktor` int DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'WAITING_FOR_EDITOR',
  `datum_vytvoreni` date NOT NULL,
  `datum_ukonceni` date DEFAULT NULL,
  `recenze1` int DEFAULT NULL,
  `recenze2` int DEFAULT NULL,
  `recenzent1` int DEFAULT NULL,
  `recenzent2` int DEFAULT NULL,
  `komentar_sefredaktora` text,
  `ID_article` int NOT NULL,
  PRIMARY KEY (`ID_rizeni`),
  KEY `ID_redaktor` (`ID_redaktor`),
  KEY `recenze1` (`recenze1`),
  KEY `recenze2` (`recenze2`),
  KEY `recenzent1` (`recenzent1`),
  KEY `recenzent2` (`recenzent2`),
  CONSTRAINT `recenzent1` FOREIGN KEY (`recenzent1`) REFERENCES `Users` (`ID_user`),
  CONSTRAINT `recenzent2` FOREIGN KEY (`recenzent2`) REFERENCES `Users` (`ID_user`),
  CONSTRAINT `Rizeni_ibfk_1` FOREIGN KEY (`ID_redaktor`) REFERENCES `Users` (`ID_user`),
  CONSTRAINT `Rizeni_ibfk_2` FOREIGN KEY (`recenze1`) REFERENCES `Recenze` (`ID_recenze`),
  CONSTRAINT `Rizeni_ibfk_3` FOREIGN KEY (`recenze2`) REFERENCES `Recenze` (`ID_recenze`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO Rizeni VALUES("1","3","ACCEPTED","2022-11-30","2022-12-17","1","2","2","6","","1");
INSERT INTO Rizeni VALUES("2","3","ACCEPTED","2022-11-30","2022-12-17","3","4","2","6","","2");
INSERT INTO Rizeni VALUES("3","3","REVIEWERS_REQUIRED","2022-12-04","","5","6","2","6","","3");
INSERT INTO Rizeni VALUES("4","","WAITING_FOR_EDITOR","2022-12-17","","","","","","","4");
INSERT INTO Rizeni VALUES("5","3","ACCEPTED","2022-12-17","2022-12-17","7","8","2","6","","5");
INSERT INTO Rizeni VALUES("6","3","ACCEPTED","2022-12-18","2022-12-18","9","10","2","2","","6");
INSERT INTO Rizeni VALUES("7","3","ACCEPTED","2022-12-18","2022-12-18","11","12","2","6","","7");
INSERT INTO Rizeni VALUES("8","3","WAITING_FOR_REVIEWS","2022-12-18","","14","13","2","6","","8");
INSERT INTO Rizeni VALUES("9","3","WAITING_FOR_REVIEWERS","2022-12-18","","","","","","","9");
INSERT INTO Rizeni VALUES("10","","WAITING_FOR_EDITOR","2022-12-19","","","","","","","10");
INSERT INTO Rizeni VALUES("11","","WAITING_FOR_EDITOR","2022-12-19","","","","","","","11");



DROP TABLE Ticket_responses;

CREATE TABLE `Ticket_responses` (
  `ID_response` int NOT NULL AUTO_INCREMENT,
  `ID_ticket` int NOT NULL,
  `ID_user` int NOT NULL,
  `R_text` text NOT NULL,
  `R_date` date NOT NULL,
  PRIMARY KEY (`ID_response`),
  KEY `ID_ticket` (`ID_ticket`),
  KEY `ID_user` (`ID_user`),
  CONSTRAINT `Ticket_responses_ibfk_1` FOREIGN KEY (`ID_ticket`) REFERENCES `Tickets` (`ticket_id`),
  CONSTRAINT `Ticket_responses_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `Users` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO Ticket_responses VALUES("5","5","4","Pls pls help help","2022-12-17");
INSERT INTO Ticket_responses VALUES("6","5","4","asd","2022-12-17");
INSERT INTO Ticket_responses VALUES("7","5","4","asd","2022-12-17");
INSERT INTO Ticket_responses VALUES("8","5","1","sdf","2022-12-17");
INSERT INTO Ticket_responses VALUES("9","5","1","asd","2022-12-17");
INSERT INTO Ticket_responses VALUES("10","6","1","aaaaaaaa","2022-12-17");
INSERT INTO Ticket_responses VALUES("11","6","1","Joj","2022-12-17");
INSERT INTO Ticket_responses VALUES("12","5","4","ewasd","2022-12-17");
INSERT INTO Ticket_responses VALUES("13","5","4","yxfcyxc","2022-12-17");
INSERT INTO Ticket_responses VALUES("14","5","4","sdf","2022-12-17");
INSERT INTO Ticket_responses VALUES("15","5","4","aasdasd","2022-12-17");
INSERT INTO Ticket_responses VALUES("16","7","7","chci se zabit
","2022-12-17");
INSERT INTO Ticket_responses VALUES("17","7","7","sdf","2022-12-17");
INSERT INTO Ticket_responses VALUES("18","7","5","do it ne lol","2022-12-17");



DROP TABLE Tickets;

CREATE TABLE `Tickets` (
  `ticket_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `id_creator` int NOT NULL,
  `id_role` int NOT NULL,
  `date_created` date NOT NULL,
  `date_closed` date DEFAULT NULL,
  `date_last_response` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'CREATED',
  PRIMARY KEY (`ticket_id`),
  KEY `id_creator` (`id_creator`),
  CONSTRAINT `Tickets_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `Users` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO Tickets VALUES("5","Pls help me","4","4","2022-12-17","","","WAITING");
INSERT INTO Tickets VALUES("6","Helpme","1","3","2022-12-17","","","CREATED");
INSERT INTO Tickets VALUES("7","pls pls help me","7","4","2022-12-17","","","CLOSED");



DROP TABLE Users;

CREATE TABLE `Users` (
  `ID_user` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO Users VALUES("1","Autor","Autor","autor@autor.cz","$2y$10$p486U8vSX12cCE/PHRWRfehd28eGRxkW3QqiiQcRJveXwhbcX39ku","","","0");
INSERT INTO Users VALUES("2","Recenzent","Recenzent","recenzent@recenzent.cz","$2y$10$ya8V12OXhUQulI8W3C.l0Owb4YCf9Hs8EYYzrQIotJpgyZjmCYP7q","","","1");
INSERT INTO Users VALUES("3","Redaktor","Redaktor","redaktor@redaktor.cz","$2y$10$qYuwjQrb09Zow/O6pniqRefhzvl2hnp67tQG615dmyWifyUIFx5JW","","","2");
INSERT INTO Users VALUES("4","Sefredaktor","Sefredaktor","sefredaktor@sefredaktor.cz","$2y$10$FJj6aYDAcJOtXDHhcsNZ7uBL3yHYdeM.aiNvU4FLy67Ft4i9sT6uy","","","3");
INSERT INTO Users VALUES("5","Admin","Admin","admin@admin.cz","$2y$10$8ze9YAUOHeSSyz.dYMMrcOuunft4AvFWuH5Mb3WnWV9DCAuOCT5Xe","","","4");
INSERT INTO Users VALUES("6","Recenzent2","Recenzent2","recenzent2@recenzent2.cz","$2y$10$AOZMS7H0SkirRedOHdDR4OduCgs4B9PT8HLPvJYZfDZVpbml/KTJ.","","","1");
INSERT INTO Users VALUES("7","Vojtech","Cizek","me@japko.cc","$2y$10$YYnO/lNHhDsOCseB.x4DKeYfRSyoH2c.JW/0VfdsnmrMJNWEgqpia","733157721","Plevnice 4, 39301 Pelhřimov","0");
INSERT INTO Users VALUES("8","Test","Test","test@test.cz","$2y$10$2rrPbWkoEVxFRYUzaABMCe98rjIO0zAuBdIhdtXhK8.GBtCI3kqJO","","","0");
INSERT INTO Users VALUES("9","Vojtěch","Šelepa","selepa01@student.vspj.cz","$2y$10$NniZK.IdPNUWaJbXrxa25.uGYxSUJZIQ/vEIXTkWsGBPBv6uJxEZK","","","0");



DROP TABLE notifications;

CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subjekt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_user` (`ID_user`),
  CONSTRAINT `ID_user` FOREIGN KEY (`ID_user`) REFERENCES `Users` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO notifications VALUES("2","bylo zapsáno","subjekt","1","2022-11-30 20:04:41","3");



