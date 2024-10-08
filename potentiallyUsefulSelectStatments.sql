USE one_piece_db;

-- Find a particular character someone wants to know more about
SELECT * FROM Characters 
WHERE name IN ('Monkey D. Luffy', 'Roronoa Zoro');

-- Orders the highest bounties to the lowest amount
SELECT name, bounty, haki_user
FROM Characters
ORDER BY bounty DESC;

-- supposed to select characters who have devil fruits 
SELECT c.name, df.name AS devil_fruit
FROM Characters c
JOIN Character_DevilFruit cd ON c.character_id = cd.character_id
JOIN Devil_Fruits df ON cd.fruit_id = df.fruit_id
WHERE df.name IS NOT NULL;



