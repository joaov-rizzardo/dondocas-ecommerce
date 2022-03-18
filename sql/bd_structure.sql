# ARQUIVO COM AS INSTRUÇÕES DE CRIAÇÃO DO BANCO

CREATE TABLE product_category(
	category_key INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(80) NOT NULL
);

CREATE TABLE product_size (
	size_key INT PRIMARY KEY AUTO_INCREMENT,
    category_key INT NOT NULL,
    size_name VARCHAR(30) NOT NULL,
    FOREIGN KEY (category_key) REFERENCES product_category(category_key)    
);