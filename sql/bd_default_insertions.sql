# ARQUIVO CONTENDO AS INSERÇÕES PADRÕES DO BANCO CO

INSERT INTO product_category(category_name)
VALUES('Roupas'),('Calçados'),('Acessórios');

INSERT INTO product_subcategory(category_key, subcategory_name)
VALUES(1, 'Camisetas'),(2, 'Sapatos');

INSERT INTO product_size(subcategory_key, size_name)
VALUES(1, 'P'),(1, 'M'),(1, 'G'),(1, 'Tamanho Único'),(2, '34'),(2, '35'),(2, '36'),(2, '37'),(2, '38');