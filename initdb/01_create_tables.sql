CREATE TABLE IF NOT EXISTS categories (
        id SERIAL PRIMARY KEY,
        category_name VARCHAR(100) NOT NULL
    );
    
CREATE TABLE IF NOT EXISTS products (
        id SERIAL PRIMARY KEY,
        category_id INT REFERENCES categories (id),
        name VARCHAR(100) NOT NULL,
        price NUMERIC(10,2) NOT NULL CHECK (price > 0)
    );

CREATE TABLE IF NOT EXISTS orders (
        id SERIAL PRIMARY KEY,
        product_id INT REFERENCES products (id),
        quantity INT NOT NULL CHECK (quantity > 0),
        created_at TIMESTAMP DEFAULT NOW()
        ); 

CREATE TABLE IF NOT EXISTS statistics (
        category_id INT REFERENCES categories (id),
        total_products INT,
        day DATE,
        PRIMARY KEY (category_id, day)
    );