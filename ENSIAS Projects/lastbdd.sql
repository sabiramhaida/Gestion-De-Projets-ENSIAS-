drop database version99; 
## base de donnee ::
create database version99 default character set utf8 collate utf8_general_ci;
use version99;
#End.



#------------------------------------------------------------
# Table: Encadrant
#------------------------------------------------------------

CREATE TABLE Encadrant(
        cin_encad    Varchar (10) NOT NULL ,
        nom_encad    Varchar (20) NOT NULL ,
        prenom_encad Varchar (20) NOT NULL ,
        email_encad  Varchar (100) NOT NULL ,
        mdp_encad    Varchar (40) NOT NULL,
        type_encad   Varchar (3)  default 'int'
        ,CONSTRAINT Encadrant_PK PRIMARY KEY (cin_encad)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: salle_soutenance
#------------------------------------------------------------

CREATE TABLE salle_soutenance(
        num_salle Varchar (100) NOT NULL
        ,CONSTRAINT salle_soutenance_PK PRIMARY KEY (num_salle)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Entreprise
#------------------------------------------------------------

CREATE TABLE Entreprise(
        nom_entreprise Varchar (20) NOT NULL ,
        email          Varchar (100) NOT NULL ,
        Adresse        Varchar (100) NOT NULL,
        mdp_Ese        Varchar (30) NOT NULL
        ,CONSTRAINT Entreprise_PK PRIMARY KEY (nom_entreprise)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Jury
#------------------------------------------------------------

CREATE TABLE Jury(
        cin_jury    Varchar (10) NOT NULL ,
        nom_jury    Varchar (20) NOT NULL ,
        prenom_jury Varchar (20) NOT NULL ,
        mdp_jury    Varchar (40) NOT NULL
        ,CONSTRAINT Jury_PK PRIMARY KEY (cin_jury)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: projet
#------------------------------------------------------------

CREATE TABLE projet(
        id_projet       int not null AUTO_INCREMENT, 
        intitule_sujet  Varchar (100) NOT NULL ,
        desciption      Text NOT NULL ,
        annee_projet    Int NOT NULL ,
        Type_projet     Varchar (4) NOT NULL ,
        id_m_b          int NULL ,
        nom_entreprise  Varchar (20) NULL,
        cin_encad       Varchar (10) Not NULL ,
        cin_jury        Varchar (10) NULL ,
        id_soutenance   int NULL
        ,CONSTRAINT projet_PK PRIMARY KEY (id_projet)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Etudiant
#------------------------------------------------------------

CREATE TABLE Etudiant(
        cne_etud    Varchar (10) NOT NULL ,
        nom_etud    Varchar (30) NOT NULL ,
        prenom_etud Varchar (30) NOT NULL ,
        email_etud  Varchar (100) NOT NULL ,
        mdp_etud    Varchar (40) NOT NULL ,
        annee       Int NOT NULL ,
        id_m_b      int NULL
        ,CONSTRAINT Etudiant_PK PRIMARY KEY (cne_etud)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: monome_binome
#------------------------------------------------------------

CREATE TABLE monome_binome(
        id_m_b    int not null AUTO_INCREMENT,
        type      Varchar (4) NOT NULL ,
        id_projet int NULL
        ,CONSTRAINT monome_binome_PK PRIMARY KEY (id_m_b)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Rendez-vous
#------------------------------------------------------------

CREATE TABLE Rendez_vous(
        id_rv               int not null AUTO_INCREMENT,
        date_rv             Date NOT NULL ,
        travail_a_faire     Varchar (100) NOT NULL ,
        chemin_compte_rendu Varchar (40) NOT NULL ,
        horaire_rv          Time NOT NULL ,
        id_projet           int NOT NULL
        ,CONSTRAINT Rendez_vous_PK PRIMARY KEY (id_rv)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Documentation
#------------------------------------------------------------

CREATE TABLE Documentation(
        id_doc    int not null AUTO_INCREMENT,
        Rapport   Varchar (100) NOT NULL ,
        id_projet int NOT NULL
        ,CONSTRAINT Documentation_PK PRIMARY KEY (id_doc)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: soutenance
#------------------------------------------------------------

CREATE TABLE soutenance(
        id_soutenance      int not null AUTO_INCREMENT, 
        date_soutenance    Date NOT NULL ,
        horaire_soutenance Varchar (5) NOT NULL ,
        id_projet          int NOT NULL ,
        num_salle          Varchar (100) NOT NULL
        ,CONSTRAINT soutenance_PK PRIMARY KEY (id_soutenance),
          UNIQUE KEY key_sout (horaire_soutenance,date_soutenance,num_salle)
)ENGINE=InnoDB;




ALTER TABLE projet
        ADD CONSTRAINT projet_monome_binome0_FK
        FOREIGN KEY (id_m_b)
        REFERENCES monome_binome(id_m_b);

ALTER TABLE projet
        ADD CONSTRAINT projet_Entreprise1_FK
        FOREIGN KEY (nom_entreprise)
        REFERENCES Entreprise(nom_entreprise);

ALTER TABLE projet
        ADD CONSTRAINT projet_Encadrant2_FK
        FOREIGN KEY (cin_encad)
        REFERENCES Encadrant(cin_encad);

ALTER TABLE projet
        ADD CONSTRAINT projet_Jury3_FK
        FOREIGN KEY (cin_jury)
        REFERENCES Jury(cin_jury);

ALTER TABLE projet
        ADD CONSTRAINT projet_soutenance4_FK
        FOREIGN KEY (id_soutenance)
        REFERENCES soutenance(id_soutenance);

ALTER TABLE soutenance
        ADD CONSTRAINT Soutenance_projet_FK0
        FOREIGN key (id_projet)
        REFERENCES projet(id_projet);      

ALTER TABLE soutenance
        ADD CONSTRAINT Soutenance_salle_FK1
        FOREIGN key (num_salle)
        REFERENCES salle_soutenance(num_salle);

ALTER TABLE Rendez_vous
        ADD CONSTRAINT Rendez_vous_projet_FK
        FOREIGN KEY (id_projet)
        REFERENCES projet(id_projet);

ALTER table monome_binome
        ADD CONSTRAINT binome_projet_FK
        FOREIGN KEY (id_projet)
        REFERENCES projet(id_projet);

ALTER table Documentation
        ADD CONSTRAINT document_projet_FK
        FOREIGN KEY (id_projet)
        REFERENCES projet(id_projet);

ALTER TABLE Etudiant
        ADD CONSTRAINT Etudiant_monome_binome0_FK
        FOREIGN KEY (id_m_b)
        REFERENCES monome_binome(id_m_b);
