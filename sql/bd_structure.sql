# ARQUIVO COM AS INSTRUÇÕES DE CRIAÇÃO DO BANCO

CREATE TABLE IF NOT EXISTS product_category(
	category_key INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(80) NOT NULL
);

CREATE TABLE IF NOT EXISTS product_subcategory(
    subcategory_key INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    category_key INT NOT NULL,
    subcategory_name VARCHAR(80) NOT NULL,
    FOREIGN KEY(category_key) REFERENCES product_category(category_key)
);

CREATE TABLE IF NOT EXISTS product_size(
    size_key INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    subcategory_key INT NOT NULL,
    size_name VARCHAR(80) NOT NULL,
    FOREIGN KEY(subcategory_key) REFERENCES product_subcategory(subcategory_key)
);

CREATE TABLE IF NOT EXISTS product(
    product_key INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(120) NOT NULL,
    product_value DECIMAL(7,2) NOT NULL,
    product_photo VARCHAR(50) NOT NULL,
    category_key INT NOT NULL,
    subcategory_key INT NOT NULL,
    product_promotion BOOLEAN DEFAULT FALSE,
    product_promotion_value DOUBLE DEFAULT 0,
    product_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(category_key) REFERENCES product_category(category_key),
    FOREIGN KEY(subcategory_key) REFERENCES product_subcategory(subcategory_key)
)

CREATE TABLE IF NOT EXISTS product_stock(
    product_key INT NOT NULL,
    product_color_name VARCHAR(80) NOT NULL,
    size_key INT NOT NULL,
    product_amount INT NOT NULL,
    PRIMARY KEY(
        product_key,
        product_color_name,
        size_key
    ),
    FOREIGN KEY(product_key) REFERENCES product(product_key),
    FOREIGN KEY(size_key) REFERENCES product_size(size_key)
);