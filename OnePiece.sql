DROP DATABASE IF exists one_piece_db;
CREATE DATABASE one_piece_db;
USE one_piece_db;

-- Table: Users
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

-- Table: Characters
CREATE TABLE Characters (
    character_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    devil_fruit VARCHAR(100),   -- Devil fruit ability (if applicable)
    crew VARCHAR(100),          -- Pirate crew
    haki_user BOOLEAN DEFAULT FALSE, -- Whether the character is a Haki user
    bounty DECIMAL(15, 2) DEFAULT 0  -- Bounty amount
);

-- Table: Episodes
CREATE TABLE Episodes (
    episode_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    air_date DATE NOT NULL,
    summary TEXT
);

-- Table: Treasures
CREATE TABLE Treasures (
    treasure_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    value DECIMAL(15, 2) DEFAULT 0,  -- Value of the treasure
    description TEXT,
    location VARCHAR(100)            -- Location where the treasure is found
);

-- Table: Character_Episode (Many-to-Many relationship between Characters and Episodes)
CREATE TABLE Character_Episode (
    character_id INT,
    episode_id INT,
    PRIMARY KEY (character_id, episode_id),
    FOREIGN KEY (character_id) REFERENCES Characters(character_id) ON DELETE CASCADE,
    FOREIGN KEY (episode_id) REFERENCES Episodes(episode_id) ON DELETE CASCADE
);

-- Table: User_Logs (Tracks user actions for auditing purposes)
CREATE TABLE User_Logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

-- Table: Comments (Users can leave comments on episodes)
CREATE TABLE Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    episode_id INT,
    content TEXT NOT NULL,
    comment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (episode_id) REFERENCES Episodes(episode_id) ON DELETE CASCADE
);

-- Table: Bounties_History (Tracks historical changes in a character's bounty)
CREATE TABLE Bounties_History (
    bounty_id INT AUTO_INCREMENT PRIMARY KEY,
    character_id INT,
    bounty INT,
    change_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (character_id) REFERENCES Characters(character_id) ON DELETE CASCADE
);

-- Table: Devil_Fruits (Devil Fruits and their associated characters)
CREATE TABLE Devil_Fruits (
    fruit_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    type ENUM('Paramecia', 'Zoan', 'Logia') NOT NULL,
    description TEXT
);

-- Table: Character_DevilFruit (Many-to-Many relationship for characters with devil fruits)
CREATE TABLE Character_DevilFruit (
    character_id INT,
    fruit_id INT,
    PRIMARY KEY (character_id, fruit_id),
    FOREIGN KEY (character_id) REFERENCES Characters(character_id) ON DELETE CASCADE,
    FOREIGN KEY (fruit_id) REFERENCES Devil_Fruits(fruit_id) ON DELETE CASCADE
);


-- Insert a user
INSERT INTO Users (username, password, email, role)
VALUES ('admin', 'hashed_password', 'admin@onepiece.com', 'admin');

-- Insert a character
INSERT INTO Characters (name, description, devil_fruit, crew, haki_user, bounty)
VALUES ('Monkey D. Luffy', 'Captain of the Straw Hat Pirates', 'Gomu Gomu no Mi', 'Straw Hat Pirates', TRUE, 1500000000);

-- Insert an episode
INSERT INTO Episodes (title, air_date, summary)
VALUES ('The Beginning of the Great Adventure', '1999-10-20', 'Luffy sets out on his journey to become Pirate King.');

-- Insert a treasure
INSERT INTO Treasures (name, value, description, location)
VALUES ('One Piece', 10000000000, 'The ultimate treasure sought by all pirates.', 'Raftel');

-- Insert a devil fruit
INSERT INTO Devil_Fruits (name, type, description)
VALUES ('Gomu Gomu no Mi', 'Paramecia', 'Grants the user a body made of rubber.');

-- Associate a character with an episode
INSERT INTO Character_Episode (character_id, episode_id)
VALUES (1, 1);

-- Associate a character with a devil fruit
INSERT INTO Character_DevilFruit (character_id, fruit_id)
VALUES (1, 1);

SELECT * FROM Characters;

