# ARQUIVO CONTENDO AS INSERÇÕES PADRÕES DO BANCO CO

INSERT INTO product_category(category_name)
VALUES('Roupas'),('Calçados'),('Acessórios');

# INSERÇÕES PARA ROUPAS
INSERT INTO product_subcategory(category_key, subcategory_name)
VALUES(1, 'Vestidos'),
      (1, 'Macacões'),
      (1, 'Croppeds'),
      (1, 'Shorts'),
      (1, 'Conjuntos');

INSERT INTO product_size(category_key, size_name)
VALUES(1, 'P'),
      (1, 'M'),
      (1, 'G'),
      (1, 'GG'),
      (1, 'Tamanho Único');

# INSERÇÕES PARA CALÇADOS
INSERT INTO product_subcategory(category_key, subcategory_name)
VALUES(2, 'Mules'),
      (2, 'Sandálias'),
      (2, 'Sapatilhas'),
      (2, 'Tênis'),
      (2, 'Saltos');

INSERT INTO product_size(category_key, size_name)
VALUES(2, '34'),
      (2, '35'),
      (2, '36'),
      (2, '37'),
      (2, '38'),
      (2, '39'),
      (2, '40'),
      (2, '41'),
      (2, '42'),
      (2, '43'),
      (2, '44'),
      (2, 'Tamanho Único');
    
# INSERÇÕES PARA ACESSÓRIOS
INSERT INTO product_subcategory(category_key, subcategory_name)
VALUES(3, 'Bolsas'),
      (3, 'Colares'),
      (3, 'Pulseiras');

INSERT INTO product_size(category_key, size_name)
VALUES (3, 'Tamanho Único');


