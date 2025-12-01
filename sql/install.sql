CREATE DATABASE zoo_encycloedie;
USE zoo_encycloedie;

CREATE TABLE Habitat(
    id_hab INT PRIMARY KEY AUTO_INCREMENT,
    name_hab VARCHAR(100),
    desc_hab TEXT
)

CREATE TABLE Animal(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name_anim VARCHAR(100),
    type_alimentaire VARCHAR(100),
    anim_image VARCHAR(150),
    habitat_id INT,
    FOREIGN KEY (habitat_id) REFERENCES Habitat(id_hab)
)
