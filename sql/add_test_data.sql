INSERT INTO Usraccount (usr_name,usr_password) VALUES ('admin','admpwd');
INSERT INTO Usraccount (usr_name,usr_password) VALUES ('test_usr','testpw');
INSERT INTO Usraccount (usr_name,usr_password) VALUES ('test_usr2','testpw2');

INSERT INTO Drink (usr_id, name, created, approved) VALUES (1,'Kalja',current_date, 'true');
INSERT INTO Ingredient(drink_id,ingrd_name,amount,amount_type) values (1,'Karhun kolmosolut',3,'dl');

