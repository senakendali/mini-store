CREATE DATABASE IF NOT EXISTS mini_store_php;
USE mini_store_php;

DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    price INT NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NULL,
    product_name VARCHAR(120) NOT NULL,
    price INT NOT NULL DEFAULT 0,
    quantity INT NOT NULL DEFAULT 0,
    total_price INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_transactions_product
        FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO products (name, price, stock) VALUES
('Kopi Susu', 15000, 10),
('Roti Bakar', 12000, 5),
('Teh Lemon', 10000, 8);
