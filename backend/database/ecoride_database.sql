

-- SCRIPT de création des tables --

CREATE TABLE users (
    u_id BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- déclaration de la clé primaire (NOT NULL facultatif, mais bonne pratique)
    u_lastname VARCHAR(255) NOT NULL,
    u_firstname VARCHAR(255) NOT NULL,
    u_pseudo VARCHAR(255) NOT NULL UNIQUE,
    u_picture VARCHAR(255),
    u_email VARCHAR(255) NOT NULL UNIQUE,
    u_adress VARCHAR(255) NOT NULL,
    u_postal_code VARCHAR(255) NOT NULL,
    u_city VARCHAR(255) NOT NULL,
    u_dob DATE NOT NULL,
    u_phone VARCHAR(255),
    u_password VARCHAR(255) NOT NULL,
    u_register_date DATE,
    u_isActive TINYINT,
    crd_sum INT,                                -- gestion des credits utilisateurs
    crd_quantity INT,                           -- gestion des credits utilisateurs
    crd_bonus INT                              -- gestion des credits utilisateurs
    );
CREATE TABLE roles (
    role_id BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- déclaration de la clé primaire (NOT NULL facultatif, mais bonne pratique)
    role_name VARCHAR(255) NOT NULL UNIQUE,
    role_details VARCHAR(255)
);
CREATE TABLE cars (
    c_id BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- déclaration de la clé primaire (NOT NULL facultatif, mais bonne pratique)
    c_brand VARCHAR(255) NOT NULL,
    c_model VARCHAR(255) NOT NULL,
    c_color VARCHAR(255) NOT NULL,
    c_energy VARCHAR(255) NOT NULL,
    c_license VARCHAR(255) NOT NULL,
    c_date_license DATE NOT NULL,

    c_owner_id BIGINT NOT NULL,         -- déclaration de la clé étrangère
    FOREIGN KEY (c_owner_id) REFERENCES users(u_id)
    );


CREATE TABLE roles_assigns(
    user_id BIGINT NOT NULL,
    role_id BIGINT NOT NULL,
    PRIMARY KEY (user_id, role_id), -- déclaration clé primaire composée (table d'association users/roles)
    FOREIGN KEY (user_id) REFERENCES users(u_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE travels (
    t_id BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- déclaration de la clé primaire (NOT NULL facultatif, mais bonne pratique)
    t_city_departure VARCHAR(255) NOT NULL,
    t_city_arrival VARCHAR(255) NOT NULL,
    t_date_hour_dep DATETIME NOT NULL,
    t_places_available INT NOT NULL,
    t_price_per_person INT NOT NULL,
    t_status VARCHAR(255),

    driver_id BIGINT NOT NULL, -- déclaration de la clé étrangère
    FOREIGN KEY (driver_id) REFERENCES users(u_id)
);

CREATE TABLE reservations(
    reserv_id BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- déclaration de la clé primaire (NOT NULL facultatif, mais bonne pratique)
    reserv_date DATE NOT NULL,
    reserv_status VARCHAR(255),
    reserv_nb_person INT NOT NULL,
    reserv_total_price INT,
    reserv_options VARCHAR(255),
    user_id_rsv BIGINT NOT NULL,   --  déclaration de la clé étrangère
    travel_id BIGINT NOT NULL,     --  déclaration de la clé étrangère
    FOREIGN KEY (user_id_rsv) REFERENCES users(u_id),
    FOREIGN KEY (travel_id) REFERENCES travels(t_id) 
);

CREATE TABLE reviews (
    rw_id BIGINT PRIMARY KEY AUTO_INCREMENT NOT NULL, -- déclaration de la clé primaire (NOT NULL facultatif, mais bonne pratique)
    rw_score TINYINT NOT NULL,
    rw_comment TEXT,
    rw_datetime DATETIME,
    rw_status VARCHAR(255),

    reservation_id BIGINT NOT NULL, -- déclaration de la clé étrangère
    FOREIGN KEY (reservation_id) REFERENCES reservations(reserv_id)
);


-- Modification des tables pour insérer les index --



-- remplissage de données tests pour la Bdd Ecoride --

use ecoride_database;
INSERT INTO users (u_lastname, u_firstname, u_pseudo, u_picture, u_email, u_adress, u_postal_code, u_city, u_dob, u_password, u_phone, u_register_date, `u_isActive`, crd_sum, crd_quantity, crd_bonus) 
VALUES 
    ('DUPONT', 'Jean', 'jeanjean', 'url/img/picture1.jpg', 'jean@dupont.fr', '1 rue de la victoire', '75000', 'Paris', '1986-10-24', 'mdpjeandupont', '0708090405', '2025-07-11', True, 20, 20, 0),
    ('MARTIN', 'Sophie', 'sophiemartin', 'url/img/picture2.jpg', 'sophie@martin.fr', '12 avenue des Lilas', '69000', 'Lyon', '1990-03-15', 'mdpsophiemartin', '0612345678', '2025-07-12', True, 15, 15, 5),
    ('BERTRAND', 'Paul', 'paulb', 'url/img/picture3.jpg', 'paul@bertrand.fr', '3 chemin de la Forêt', '31000', 'Toulouse', '1982-11-20', 'mdppaulbertrand', '0623456789', '2025-07-13', True, 25, 25, 0),
    ('DURAND', 'Marie', 'maried', 'url/img/picture4.jpg', 'marie@durand.fr', '25 rue des Glycines', '13000', 'Marseille', '1995-07-01', 'mdpariedurand', '0734567890', '2025-07-14', True, 10, 10, 10),
    ('LEFEVRE', 'Thomas', 'thomle', 'url/img/picture5.jpg', 'thomas@lefevre.fr', '8 place de la Liberté', '59000', 'Lille', '1988-09-05', 'mdpthomaslefevre', '0645678901', '2025-07-15', True, 30, 30, 0),
    ('FOURNIER', 'Camille', 'cam4', 'url/img/picture6.jpg', 'camille@fournier.fr', '44 boulevard Voltaire', '44000', 'Nantes', '1993-01-10', 'mdpcamillefournier', '0756789012', '2025-07-16', True, 18, 18, 2),
    ('BONNET', 'Lucas', 'lucasb', 'url/img/picture7.jpg', 'lucas@bonnet.fr', '7 rue du Moulin', '67000', 'Strasbourg', '1980-04-29', 'mdplucasbonnet', '0667890123', '2025-07-17', True, 22, 22, 0),
    ('BOYER', 'Chloé', 'chloeb', 'url/img/picture8.jpg', 'chloe@boyer.fr', '11 quai des Fleurs', '33000', 'Bordeaux', '1997-12-03', 'mdpchloeboyer', '0778901234', '2025-07-18', True, 12, 12, 8),
    ('MARCHAND', 'Antoine', 'antoinem', 'url/img/picture9.jpg', 'antoine@marchand.fr', '16 rue de la Paix', '35000', 'Rennes', '1985-06-18', 'mdpantoinemarchand', '0689012345', '2025-07-19', True, 28, 28, 0),
    ('DUPUIS', 'Léa', 'leadup', 'url/img/picture10.jpg', 'lea@dupuis.fr', '2 rue des Tilleuls', '76000', 'Rouen', '1992-02-22', 'mdpleadupuis', '0790123456', '2025-07-20', True, 17, 17, 3)
;
INSERT INTO cars (c_brand, c_model, c_color, c_license, c_energy, c_date_license, c_owner_id) 
VALUES 
('PEUGEOT', '3008', 'Noir', 'GP-225-KG','Gasoil', '2023-12-16', 1),
('MINI', 'CLUBMAN', 'VERT', 'EB-029-CM','Essence', '2022-04-23', 2),
('RENAULT', 'Captur', 'Blanc', 'FR-123-AB', 'Essence', '2022-05-10', 3),
('CITROEN', 'C5 Aircross', 'Gris', 'AB-456-CD', 'Hybride', '2024-03-22',4),
('DACIA', 'Duster', 'Rouge', 'XY-789-EF', 'GPL', '2021-11-03',5),
('NISSAN', 'Qashqai', 'Rouge', 'JJ-010-JJ', 'Hybride', '2021-02-14',6),
('KIA', 'Sportage', 'Blanc', 'KK-111-KK', 'Essence', '2024-05-30',7),
('HYUNDAI', 'Tucson', 'Gris', 'LL-222-LL', 'Diesel', '2022-08-16',8),
('TOYOTA', 'Corolla', 'Blanc Perle', 'CD-234-EF', 'Hybride', '2023-07-30', 9),
('FORD', 'Focus', 'Gris Anthracite', 'GH-567-IJ', 'Essence', '2021-10-01', 10)
;
INSERT INTO roles (role_name, role_details) VALUES 
('Passenger', 'Je suis un passager'),
('Driver', 'Je suis un conducteur'),
('Both', 'Je suis conducteur et passager');
INSERT INTO roles (role_name, role_details) VALUES 
('Employee', 'Je suis un employé'),
('Administrateur', 'Je suis Administrateur')
;
INSERT INTO roles_assigns (user_id, role_id) VALUES
(1, 1),
(2, 1),
(3, 3),
(4, 3),
(5, 1),
(6, 2),
(7, 2),
(8, 4),
(9, 3),
(10, 1);


INSERT INTO travels (t_city_departure, t_city_arrival, t_date_hour_dep, t_places_available, t_price_per_person, t_status, driver_id)
VALUES 
('SAINT-MALO','RENNES','2025-07-15 10:00', 3, 10, 'Disponible', 1),
('RENNES','ST-BRIEUC','2025-08-13 19:00', 2, 15, 'En attente', 4)
;

INSERT INTO reviews (rw_score, rw_comment, rw_datetime, rw_status)
VALUES 
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan nulla non imperdiet pharetra. Sed pretium sapien id nisi euismod pulvinar. Sed imperdiet nibh lorem, vel congue diam maximus vel. Vivamus rutrum eros enim, et placerat ipsum congue at. Nam nec nisi nibh. Donec volutpat justo cursus nisl gravida congue.', '2025-12-24 15:15', 'En cours de validation'),
(3, 'Nunc dapibus magna eget dolor pulvinar, eget tempor mauris hendrerit. Phasellus consequat lacus elit, vel tincidunt nisl pharetra et. Aliquam non consequat ligula. Duis blandit sapien sit amet elit tempus commodo. Morbi vel venenatis turpis. Sed lacus tellus, placerat eu nisl a, maximus congue tellus', '2025-07-15 20:20', 'Validé')
;

INSERT INTO reservations (reserv_date, reserv_status, reserv_nb_person, reserv_total_price, reserv_options, user_id_rsv) 
VALUES
('2025-07-22', 'demande', 1, 10, 'pas d\'options', 4),
('2025-07-28', 'demande', 2, 20, 'pas d\'options', 7)
;

