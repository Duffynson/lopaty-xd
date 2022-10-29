CREATE TABLE Users(
    ID_user INT NOT NULL,
    firstname VARCHAR(250),
    lastname VARCHAR(250),
    email VARCHAR(250),
    password VARCHAR(250),
    role INT NOT NULL,
    PRIMARY KEY (ID_user)
);
    CREATE TABLE Article(
    ID_article INT NOT NULL,
    title VARCHAR(100),
    datum_vydani DATE,
    soubor TEXT,
    ID_user INT,
    PRIMARY KEY (ID_article),
    FOREIGN KEY (ID_user) REFERENCES Users(id_user)
    );

CREATE TABLE Journal(
    ID_journal INT NOT NULL,
    vydani VARCHAR(50),
    ID_article INT NOT NULL,
    FOREIGN KEY (ID_article) REFERENCES Article(ID_article),
    PRIMARY KEY (ID_journal)
);
CREATE TABLE Rizeni(
    ID_rizeni INT NOT NULL,
    redaktor VARCHAR(100),
    status VARCHAR(50),
    datum_vytvoreni DATE,
    datum_ukonceni DATE,
    seznam_recenzi VARCHAR(255),
    komentar_sefredaktora TEXT,
    PRIMARY KEY (ID_rizeni)
    );
CREATE TABLE Recenze(
    ID_recenze INT NOT NULL,
    ID_Rizeni INT NOT NULL,
    originalita INT NOT NULL,
    aktualnost INT NOT NULL,
    jazyk INT NOT NULL,
    text TEXT,
    datum_recenze DATE,
    datum_vytvoreni DATE,
    recenzent VARCHAR(100),
    PRIMARY KEY(ID_recenze),
    ID_rizeni INT NOT NULL,
    FOREIGN KEY (ID_rizeni) REFERENCES Rizeni(ID_rizeni)

);