DROP DATABASE IF EXISTS bitllescatalanes;
CREATE DATABASE bitllescatalanes;
USE bitllescatalanes;

CREATE TABLE Players (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    mail VARCHAR(120),
    code VARCHAR(15) NOT NULL,
    partner BOOLEAN NOT NULL,
    image VARCHAR(100) DEFAULT 'default_image.png',
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Roles (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(40) NOT NULL
);

CREATE TABLE Users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    mail VARCHAR(120) NOT NULL,
    role INTEGER NOT NULL,
    image VARCHAR(100) DEFAULT 'default_image.png',
    last_login TIMESTAMP,
    attemp_logins INTEGER
);

CREATE TABLE Status (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE Field (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    field_name VARCHAR(120) DEFAULT 'pista'
);

CREATE TABLE Tournament (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type INTEGER NOT NULL,
    normal_price FLOAT NOT NULL,
    partner_price FLOAT NOT NULL,
    image VARCHAR(100) DEFAULT 'default_image.png',
    expected_date VARCHAR(50),
    start_date TIMESTAMP,
    end_date TIMESTAMP
);

CREATE TABLE Type_Tournament (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    draw_case VARCHAR(255),
    winner_prize VARCHAR(255) DEFAULT NULL
);

CREATE TABLE Player_History_Stats (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_player INTEGER NOT NULL,
    number_game_makes INTEGER NOT NULL,
    total_points_all_game INTEGER NOT NULL,
    last_game_points INTEGER NOT NULL,
    best_game_points INTEGER NOT NULL,
    accuracy FLOAT NOT NULL
);

CREATE TABLE Referee_Tournament (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_tournament INTEGER NOT NULL,
    id_user_referee INTEGER NOT NULL,
    id_field INTEGER NOT NULL
);

CREATE TABLE Rounds (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_player INTEGER NOT NULL,
    id_field INTEGER NOT NULL,
    id_status INTEGER NOT NULL
);

CREATE TABLE Tournament_Round (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_tournament INTEGER NOT NULL,
    id_round INTEGER NOT NULL,
    finish_hour TIME DEFAULT NULL
);

CREATE TABLE Stats_Player_Tournament (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_player INTEGER NOT NULL,
    id_tournament INTEGER NOT NULL,
    total_points INTEGER NOT NULL,
    accuracy FLOAT NOT NULL
);

-- Añadir claves foráneas
ALTER TABLE Users
ADD CONSTRAINT fk_users_role FOREIGN KEY (role) REFERENCES Roles(id);

ALTER TABLE Player_History_Stats
ADD CONSTRAINT fk_player_history_stats_player FOREIGN KEY (id_player) REFERENCES Players(id);

ALTER TABLE Referee_Tournament
ADD CONSTRAINT fk_referee_tournament_tournament FOREIGN KEY (id_tournament) REFERENCES Tournament(id),
ADD CONSTRAINT fk_referee_tournament_user FOREIGN KEY (id_user_referee) REFERENCES Users(id),
ADD CONSTRAINT fk_referee_tournament_field FOREIGN KEY (id_field) REFERENCES Field(id);

ALTER TABLE Rounds
ADD CONSTRAINT fk_rounds_player FOREIGN KEY (id_player) REFERENCES Players(id),
ADD CONSTRAINT fk_rounds_field FOREIGN KEY (id_field) REFERENCES Field(id),
ADD CONSTRAINT fk_rounds_status FOREIGN KEY (id_status) REFERENCES Status(id);

ALTER TABLE Tournament_Round
ADD CONSTRAINT fk_tournament_round_tournament FOREIGN KEY (id_tournament) REFERENCES Tournament(id),
ADD CONSTRAINT fk_tournament_round_round FOREIGN KEY (id_round) REFERENCES Rounds(id);

ALTER TABLE Stats_Player_Tournament
ADD CONSTRAINT fk_stats_player_tournament_player FOREIGN KEY (id_player) REFERENCES Players(id),
ADD CONSTRAINT fk_stats_player_tournament_tournament FOREIGN KEY (id_tournament) REFERENCES Tournament(id);

ALTER TABLE Tournament
ADD CONSTRAINT fk_tournament_type FOREIGN KEY (type) REFERENCES Type_Tournament(id);
