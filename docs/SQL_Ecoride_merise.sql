#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: roles
#------------------------------------------------------------

CREATE TABLE roles(
        role_id      Int  Auto_increment  NOT NULL ,
        role_name    Varchar (255) NOT NULL ,
        role_details Varchar (255) NOT NULL
	,CONSTRAINT roles_PK PRIMARY KEY (role_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        u_id            Int  Auto_increment  NOT NULL ,
        u_lastname      Varchar (255) ,
        u_firstname     Varchar (255) ,
        u_picture       Varchar (255) NOT NULL ,
        u_adress        Varchar (255) NOT NULL ,
        u_postal_code   Varchar (255) NOT NULL ,
        u_city          Varchar (255) NOT NULL ,
        u_dob           Date NOT NULL ,
        u_phone         Varchar (255) NOT NULL ,
        u_role          Varchar (255) NOT NULL ,
        u_password      Varchar (255) NOT NULL ,
        u_register_date Date NOT NULL ,
        u_isActive      TinyINT NOT NULL ,
        crd_sum         Int NOT NULL ,
        crd_quantity    Int NOT NULL ,
        crd_bonus       Int NOT NULL ,
        u_pseudo        Varchar (255) NOT NULL ,
        u_email         Varchar (255) NOT NULL ,
        reserv_id       Int NOT NULL
	,CONSTRAINT users_Idx INDEX (u_pseudo,u_email)
	,CONSTRAINT users_PK PRIMARY KEY (u_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cars
#------------------------------------------------------------

CREATE TABLE cars(
        c_id           Int  Auto_increment  NOT NULL ,
        c_brand        Varchar (255) NOT NULL ,
        c_model        Varchar (255) NOT NULL ,
        c_color        Varchar (255) NOT NULL ,
        c_energy       Varchar (255) NOT NULL ,
        c_date_license Date NOT NULL ,
        c_license      Varchar (255) NOT NULL ,
        u_id           Int NOT NULL
	,CONSTRAINT cars_Idx INDEX (c_license)
	,CONSTRAINT cars_PK PRIMARY KEY (c_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: travels
#------------------------------------------------------------

CREATE TABLE travels(
        t_id               Int  Auto_increment  NOT NULL ,
        t_city_departure   Varchar (255) ,
        t_city_arrival     Varchar (255) NOT NULL ,
        t_date_hour_dep    Datetime NOT NULL ,
        t_places_available Int NOT NULL ,
        t_price_per_person Int NOT NULL ,
        t_status           Varchar (255) NOT NULL ,
        driver_id          BigInt NOT NULL ,
        u_id               Int NOT NULL
	,CONSTRAINT travels_PK PRIMARY KEY (t_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reviews
#------------------------------------------------------------

CREATE TABLE reviews(
        rw_id       Int  Auto_increment  NOT NULL ,
        rw_score    Int NOT NULL ,
        rw_comment  Text NOT NULL ,
        rw_datetime Datetime NOT NULL ,
        rw_status   Varchar (255) NOT NULL ,
        reserv_id   Int NOT NULL
	,CONSTRAINT reviews_PK PRIMARY KEY (rw_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reservations
#------------------------------------------------------------

CREATE TABLE reservations(
        reserv_id          Int  Auto_increment  NOT NULL ,
        reserv_date        Date NOT NULL ,
        reserv_status      Varchar (255) NOT NULL ,
        reserv_nb_person   Int NOT NULL ,
        reserv_total_price Int NOT NULL ,
        reserv_option      Varchar (255) NOT NULL ,
        t_id               Int NOT NULL
	,CONSTRAINT reservations_PK PRIMARY KEY (reserv_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: assigner
#------------------------------------------------------------

CREATE TABLE assigner(
        role_id Int NOT NULL ,
        u_id    Int NOT NULL
	,CONSTRAINT assigner_PK PRIMARY KEY (role_id,u_id)
)ENGINE=InnoDB;




ALTER TABLE users
	ADD CONSTRAINT users_reservations0_FK
	FOREIGN KEY (reserv_id)
	REFERENCES reservations(reserv_id);

ALTER TABLE cars
	ADD CONSTRAINT cars_users0_FK
	FOREIGN KEY (u_id)
	REFERENCES users(u_id);

ALTER TABLE travels
	ADD CONSTRAINT travels_users0_FK
	FOREIGN KEY (u_id)
	REFERENCES users(u_id);

ALTER TABLE reviews
	ADD CONSTRAINT reviews_reservations0_FK
	FOREIGN KEY (reserv_id)
	REFERENCES reservations(reserv_id);

ALTER TABLE reservations
	ADD CONSTRAINT reservations_travels0_FK
	FOREIGN KEY (t_id)
	REFERENCES travels(t_id);

ALTER TABLE assigner
	ADD CONSTRAINT assigner_roles0_FK
	FOREIGN KEY (role_id)
	REFERENCES roles(role_id);

ALTER TABLE assigner
	ADD CONSTRAINT assigner_users1_FK
	FOREIGN KEY (u_id)
	REFERENCES users(u_id);
