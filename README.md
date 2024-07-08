# how to run

Run Docker, cd to root of cloned repo, type:
```
docker-compose up 
```

Go to localhost:8080 in browser. You'll see statistics table populated from test data and order form. 
Submit new order and see stats updating immediately.

DB credentials can be changed in .env file.

initdb folder contains sql scripts. 
- 01_create_tables.sql creates database structure.
- 02_create_trigger.sql adds stats update function and trigger that executes it on each row insert to 'orders' table
- 03_insert_test_data.sql inserts categories & products data and some test orders.
