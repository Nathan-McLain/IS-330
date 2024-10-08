USE one_piece_db;

select * from Characters;


SELECT 
    Characters.name AS Character_Name, 
    Devil_Fruits.name AS Devil_Fruit_Name, 
    Episodes.title AS Episode_Title
FROM 
    Characters
JOIN 
    Character_DevilFruit ON Characters.character_id = Character_DevilFruit.character_id
JOIN 
    Devil_Fruits ON Character_DevilFruit.fruit_id = Devil_Fruits.fruit_id
JOIN 
    Character_Episode ON Characters.character_id = Character_Episode.character_id
JOIN 
    Episodes ON Character_Episode.episode_id = Episodes.episode_id
WHERE 
    Characters.name = 'Monkey D. Luffy';
  
    
INSERT INTO Characters (name, description, devil_fruit, crew, haki_user, bounty)
VALUES ('Nico Robin', 'Archaeologist of the Straw Hat Pirates', 'Hana Hana no Mi', 'Straw Hat Pirates', TRUE, 93000000);

SELECT * FROM Characters WHERE name = 'Nico Robin';


UPDATE Characters
SET bounty = 100000000
WHERE name = 'Nico Robin' Limit 1;

SELECT * FROM Characters WHERE name = 'Nico Robin';


DELETE FROM Characters
WHERE name = 'Nico Robin' Limit 1;

select * from Characters;
