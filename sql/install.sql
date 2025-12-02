CREATE DATABASE zoo_encycloedie;
USE zoo_encycloedie;


-- creating table of habitat
CREATE TABLE Habitat(
    id_hab INT PRIMARY KEY AUTO_INCREMENT,
    name_hab VARCHAR(100),
    desc_hab TEXT
)

-- creating table of animal
CREATE TABLE Animal(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name_anim VARCHAR(100),
    type_alimentaire VARCHAR(100),
    anim_image VARCHAR(150),
    habitat_id INT,
    FOREIGN KEY (habitat_id) REFERENCES Habitat(id_hab)
)

-- inserting data to habitat
INSERT INTO habitat (name_hab, desc_hab)
VALUES 
('Savane', 'Habitat de savane, riche en herbes et grands espaces'),
('Jungle', 'Habitat de jungle, dense et tropical'),
('Desert', 'Habitat desertique avec climat sec'),
('Ocean', 'Habitat marin avec une grande biodiversite');

-- inserting data to animal

INSERT INTO Animal (name_anim, type_alimentaire, anim_image, habitat_id)
VALUES
('Lion', 'Carnivore', 'https://cdn.britannica.com/29/150929-050-547070A1/lion-Kenya-Masai-Mara-National-Reserve.jpg', 14),
('Gorille', 'Herbivore', 'https://s28164.pcdn.co/files/gorilla-1920x1080-2024-600x400.jpg', 15),
('Chameau', 'Herbivore', 'https://zoopolis.fr/wp-content/uploads/2022/01/2.-Dromadaires-marchant-a-lamble.jpeg', 16),

('Tigre', 'Carnivore', 'https://www.monde-animal.fr/wp-content/uploads/2020/06/tigre-panthera-tigris.jpg', 15),
('Requin', 'Carnivore', 'https://www.fishipedia.fr/wp-content/uploads/2019/06/REQUIN-BLANC_AP5A9973_FGUERIN.jpg', 17),
('Gazelle', 'Herbivore', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Chinkara_-_Shreeram_M_V_-_Bikaner.jpg/1200px-Chinkara_-_Shreeram_M_V_-_Bikaner.jpg', 14);


