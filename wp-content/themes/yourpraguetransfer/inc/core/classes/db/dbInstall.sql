CREATE TABLE wp_surovina ( 
    id INT NOT NULL AUTO_INCREMENT ,
    nazev_suroviny VARCHAR(512) NULL , 
    mnozstvi INT NULL , 
    jednotka VARCHAR(32) NULL ,
    alergeny VARCHAR(2048) NULL,
    konfiguracni BOOLEAN NULL, 
    konfiguracni_cena FLOAT NULL, 
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka pro evidenci všech surovin';


CREATE TABLE wp_produkt ( 
    nazev VARCHAR(512) NOT NULL , 
    kod VARCHAR(512) NOT NULL , 
    vaha VARCHAR(1024) NOT NULL , 
    je_konfigurovatelny INT NULL DEFAULT NULL , 
    id INT NOT NULL AUTO_INCREMENT , 
    popisek VARCHAR(2048) NOT NULL AFTER, 
    kategorieid INT NOT NULL, 
    obrazek VARCHAR(512) NOT NULL, 
    cena FLOAT NULL, 
    aktivni BOOLEAN NULL, 
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'tabulka pro evidenci všech produktů';


CREATE TABLE wp_surovina_produkt( 
    id INT NOT NULL AUTO_INCREMENT , 
    idsur INT NOT NULL , 
    idprod INT NOT NULL , 
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Spojovací tabulka pro vazbu m:n produkt <> surovina';


CREATE TABLE wp_kategorie ( 
    id INT NOT NULL AUTO_INCREMENT ,
    nazev_kat VARCHAR(512) NOT NULL , 
    velikosti_prod VARCHAR(2048) NOT NULL , 
    obrazek VARCHAR(256) NOT NULL , 
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka pro držení všech kategorií';

CREATE TABLE wp_pobocka (
    nazev_pob VARCHAR(1024) NOT NULL ,
    email VARCHAR(512) NOT NULL , 
    telefon VARCHAR(128) NOT NULL , 
    mesto VARCHAR(256) NOT NULL , 
    psc VARCHAR(6) NOT NULL , 
    cp VARCHAR(64) NOT NULL , 
    ulice VARCHAR(256) NOT NULL , 
    zavreno BOOLEAN NOT NULL , 
    zavreno_txt VARCHAR(512) NOT NULL , 
    rozvoz_mesta VARCHAR(2048) NULL, 
    id INT NOT NULL AUTO_INCREMENT ,
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka pro ukládání poboček';

CREATE TABLE wp_produkt_pobocka ( 
    id INT NOT NULL AUTO_INCREMENT ,
    idprodukt INT NOT NULL , 
    idpobocka INT NOT NULL , 
    cena INT NULL , 
    nazev VARCHAR(512) NULL ,
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf16 COLLATE utf16_croatian_ci COMMENT = 'Tabulka pro spojení produktu s pobočkou';


CREATE TABLE wp_zona ( 
    id INT NOT NULL AUTO_INCREMENT , 
    body TEXT NOT NULL , 
    idpobocka INT NULL ,
    cas_od VARCHAR(64) NULL,
    cas_do VARCHAR(64) NULL,
    priorita INT NULL,
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka sloužící pro ukládání jednotlivých bodů polygonu zón';

CREATE TABLE wp_spravce_pobocka ( 
    id INT NOT NULL AUTO_INCREMENT , 
    iduzivatel INT NOT NULL , 
    idpobocka INT NOT NULL ,
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka pro spojení uživatele WP a pobočky';

CREATE TABLE wp_oteviraci_doba ( 
    id INT NOT NULL AUTO_INCREMENT , 
    den INT NOT NULL , 
    od  VARCHAR(5) NULL DEFAULT NULL, 
    do VARCHAR(5) NULL DEFAULT NULL, 
    idpobocka INT NULL , 
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka sloužící pro záznam o otevírací době k dané pobočce';

CREATE TABLE wp_kategorie_pobocka ( 
    id INT NOT NULL AUTO_INCREMENT , 
    idkategorie INT NOT NULL , 
    idpobocka INT NOT NULL , 
    nazev VARCHAR(512) NOT NULL , 
    aktivni BOOLEAN NULL, 
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf16 COLLATE utf16_czech_ci COMMENT = 'Tabulka sloužící pro masku pro pobočku';

CREATE TABLE wp_zakaznik ( 
    jmeno VARCHAR(1024) NOT NULL , 
    prijmeni VARCHAR(1024) NOT NULL , 
    ulice VARCHAR(1024) NULL , 
    cp VARCHAR(256) NULL , 
    mesto VARCHAR(1024) NULL , 
    psc VARCHAR(6) NULL , 
    email VARCHAR(256) NULL , 
    iduser INT NOT NULL,
    telefon VARCHAR(128) NULL ,
    id INT NOT NULL AUTO_INCREMENT , 
    idpobocka INT NULL ,
    PRIMARY KEY (id)
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_czech_ci COMMENT = 'Tabulka sloužící pro evidenci zákazníků';