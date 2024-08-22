USE proj_1;

CREATE TABLE user(id INT(5) PRIMARY KEY AUTO_INCREMENT,
                   email VARCHAR(40) ,
                   profile_name VARCHAR(20) UNIQUE,
                   password VARCHAR(50));

show tables;