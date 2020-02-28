#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: MOVIE
#------------------------------------------------------------

CREATE TABLE MOVIE(
        idmovie     Int  Auto_increment  NOT NULL ,
        title       Varchar (255) NOT NULL ,
        releaseyear Int NOT NULL ,
        posterurl   Varchar (530) NOT NULL ,
        synopsis    TEXT NOT NULL,
        runtime     Varchar (255) NOT NULL ,
        genre       Varchar (255) NOT NULL ,
        director    Varchar (255) NOT NULL ,
        production  Varchar (255) NOT NULL
	,CONSTRAINT MOVIE_PK PRIMARY KEY (idmovie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: USERS
#------------------------------------------------------------

CREATE TABLE USERS(
        username  Varchar (255) NOT NULL ,
        email     Varchar (255) NOT NULL ,
        firstname Varchar (255) NOT NULL ,
        lastname  Varchar (255) NOT NULL ,
        password  Varchar (255) NOT NULL ,
        type      Varchar (255) NOT NULL
	,CONSTRAINT USERS_PK PRIMARY KEY (username)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ACTOR
#------------------------------------------------------------

CREATE TABLE ACTOR(
        idactor   Int  Auto_increment  NOT NULL ,
        name Varchar (255) NOT NULL ,
        actorurl  Varchar (530) NOT NULL
	,CONSTRAINT ACTOR_PK PRIMARY KEY (idactor)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DIRECTOR
#------------------------------------------------------------

CREATE TABLE DIRECTOR(
        iddirector  Int  Auto_increment  NOT NULL ,
        firstname   Varchar (255) NOT NULL ,
        lastname    Varchar (255) NOT NULL ,
        directorurl Varchar (255) NOT NULL
	,CONSTRAINT DIRECTOR_PK PRIMARY KEY (iddirector)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ACT
#------------------------------------------------------------

CREATE TABLE ACT(
        idactor Int NOT NULL ,
        idmovie Int NOT NULL
	,CONSTRAINT ACT_PK PRIMARY KEY (idactor,idmovie)

	,CONSTRAINT ACT_ACTOR_FK FOREIGN KEY (idactor) REFERENCES ACTOR(idactor)
	,CONSTRAINT ACT_MOVIE0_FK FOREIGN KEY (idmovie) REFERENCES MOVIE(idmovie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DIRECT
#------------------------------------------------------------

CREATE TABLE DIRECT(
        iddirector Int NOT NULL ,
        idmovie    Int NOT NULL
	,CONSTRAINT DIRECT_PK PRIMARY KEY (iddirector,idmovie)

	,CONSTRAINT DIRECT_DIRECTOR_FK FOREIGN KEY (iddirector) REFERENCES DIRECTOR(iddirector)
	,CONSTRAINT DIRECT_MOVIE0_FK FOREIGN KEY (idmovie) REFERENCES MOVIE(idmovie)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RATE
#------------------------------------------------------------

CREATE TABLE RATE(
        username Varchar (255) NOT NULL ,
        idmovie  Int NOT NULL
	,CONSTRAINT RATE_PK PRIMARY KEY (username,idmovie)

	,CONSTRAINT RATE_USERS_FK FOREIGN KEY (username) REFERENCES USERS(username)
	,CONSTRAINT RATE_MOVIE0_FK FOREIGN KEY (idmovie) REFERENCES MOVIE(idmovie)
)ENGINE=InnoDB;
ALTER TABLE `RATE` ADD `rate` INT NULL AFTER `idmovie`;

#------------------------------------------------------------
# Table: COMMENT
#------------------------------------------------------------

CREATE TABLE COMMENT(
        username Varchar (255) NOT NULL ,
        idmovie  Int NOT NULL
	,CONSTRAINT COMMENT_PK PRIMARY KEY (username,idmovie)

	,CONSTRAINT COMMENT_USERS_FK FOREIGN KEY (username) REFERENCES USERS(username)
	,CONSTRAINT COMMENT_MOVIE0_FK FOREIGN KEY (idmovie) REFERENCES MOVIE(idmovie)
)ENGINE=InnoDB;
