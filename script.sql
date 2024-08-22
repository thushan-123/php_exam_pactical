USE proj_1;

CREATE TABLE user(id INT(5) PRIMARY KEY AUTO_INCREMENT,
                   email VARCHAR(40) ,
                   profile_name VARCHAR(20) UNIQUE,
                   password VARCHAR(50));

CREATE TABLE friends(user_id INT(5), friend_id INT(5));


INSERT INTO user(email, profile_name, password) VALUES
('john.doe@example.com', 'JohnDoe', 'password123'),
('jane.smith@example.com', 'JaneSmith', 'securePass1'),
('mike.jones@example.com', 'MikeJones', 'mike2021'),
('susan.adams@example.com', 'SusanAdams', 'qwerty456'),
('robert.brown@example.com', 'RobertBrown', 'robert!@34'),
('emily.clark@example.com', 'EmilyClark', 'emilypass99'),
('william.moore@example.com', 'WilliamMoore', 'willmoore567'),
('lisa.lee@example.com', 'LisaLee', 'lee_789'),
('james.taylor@example.com', 'JamesTaylor', 'jamest123'),
('david.miller@example.com', 'DavidMiller', 'davemiller22'),
('laura.white@example.com', 'LauraWhite', 'white12345'),
('steve.johnson@example.com', 'SteveJohnson', 'johnson789'),
('karen.wilson@example.com', 'KarenWilson', 'karwil89'),
('daniel.hall@example.com', 'DanielHall', 'hallPass111'),
('nancy.king@example.com', 'NancyKing', 'king4ever!'),
('chris.young@example.com', 'ChrisYoung', 'youngChris22'),
('olivia.scott@example.com', 'OliviaScott', 'scottOlivia77'),
('joshua.evans@example.com', 'JoshuaEvans', 'evansJosh01'),
('amanda.green@example.com', 'AmandaGreen', 'greenLeaf56'),
('brian.hernandez@example.com', 'BrianHernandez', 'brianh78'),
('kimberly.rivera@example.com', 'KimberlyRivera', 'rivera123'),
('kevin.carter@example.com', 'KevinCarter', 'kevincart33'),
('megan.collins@example.com', 'MeganCollins', 'megan.c99'),
('patrick.bailey@example.com', 'PatrickBailey', 'baileyrock45'),
('lauren.james@example.com', 'LaurenJames', 'jamesLauren32'),
('matthew.anderson@example.com', 'MatthewAnderson', 'mattand99'),
('ashley.hill@example.com', 'AshleyHill', 'hillclimb99'),
('andrew.mitchell@example.com', 'AndrewMitchell', 'andmitchell22'),
('kelly.perez@example.com', 'KellyPerez', 'kellypass23'),
('nicholas.martin@example.com', 'NicholasMartin', 'martinNick33'),
('samantha.roberts@example.com', 'SamanthaRoberts', 'sammy1234'),
('jeffrey.thomas@example.com', 'JeffreyThomas', 'jefftomPass'),
('jessica.walker@example.com', 'JessicaWalker', 'walkerJess45'),
('mark.davis@example.com', 'MarkDavis', 'markd55');




