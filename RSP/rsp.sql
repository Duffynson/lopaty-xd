/*vytvoření tabulky pro uživatele*/
CREATE TABLE Users(
    ID_user INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(250) NOT NULL,
    lastname VARCHAR(250) NOT NULL,
    email VARCHAR(250) UNIQUE NOT NULL,
    password VARCHAR(250) NOT NULL,
    phone VARCHAR(15),
    address VARCHAR(100),
    role INT NOT NULL DEFAULT '0',
    PRIMARY KEY (ID_user)
);
/*vytvoření tabulky pro články*/

    CREATE TABLE Article(
    ID_article INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100),
    datum_vydani DATE,
    soubor TEXT,
    ID_user INT,
    PRIMARY KEY (ID_article),
    FOREIGN KEY (ID_user) REFERENCES Users(ID_user)
    );
/*vytvoření tabulky pro časopis*/

CREATE TABLE Journal(
    ID_journal INT NOT NULL AUTO_INCREMENT,
    vydani VARCHAR(50) UNIQUE,
    ID_article INT NOT NULL,
    FOREIGN KEY (ID_article) REFERENCES Article(ID_article),
    PRIMARY KEY (ID_journal)
);
/*vytvoření tabulky pro řízení*/

CREATE TABLE Rizeni(
    ID_rizeni INT NOT NULL AUTO_INCREMENT,
    redaktor VARCHAR(100),
    status VARCHAR(50),
    datum_vytvoreni DATE,
    datum_ukonceni DATE,
    seznam_recenzi VARCHAR(255),
    komentar_sefredaktora TEXT,
    PRIMARY KEY (ID_rizeni)
    );
    /*vytvoření tabulky pro recenze*/

CREATE TABLE Recenze(
    ID_recenze INT NOT NULL AUTO_INCREMENT,
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
