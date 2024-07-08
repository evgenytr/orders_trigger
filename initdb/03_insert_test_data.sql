INSERT INTO categories (category_name) VALUES  
	('Drums'),
    ('Guitars'),
    ('Keyboards'),
    ('Microphones');
    
INSERT INTO products (category_id,name,price) VALUES 
	(1,'Tama',1000),
    (1,'Paiste',100.25),
    (1,'DW',10000),
    (2,'Fender',100),
    (2,'Gibson',500.75),
    (2,'Ibanez',1000),
    (3,'Yamaha',100),
    (3,'Roland',200.25),
    (3,'Korg',6000),
    (4,'Shure',100),
    (4,'Neumann',200.25),
    (4,'AKG',300);
    
INSERT INTO orders (product_id, quantity) VALUES 
	(1,2),
    (1,2),
    (10,5),
    (9,7),
    (11,8); 

INSERT INTO orders (product_id, quantity) VALUES 
	(2,6),
    (3,9),
    (10,5),
    (9,7),
    (11,9); 
    
INSERT INTO orders (product_id, quantity, created_at) VALUES 
	(2,6,TIMESTAMP '2004-10-19 10:23:54'),
    (3,9,TIMESTAMP '2004-10-19 10:23:54'),
    (10,5,TIMESTAMP '2004-10-19 10:23:54'),
    (9,7,TIMESTAMP '2004-10-19 10:23:54'),
    (11,9,TIMESTAMP '2004-10-19 10:23:54'); 