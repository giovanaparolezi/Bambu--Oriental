create database bambui3;

use bambui3;

-- Tabela de login (clientes)
create table login(
  id_client int auto_increment primary key,
  nome varchar(100),
  email varchar(100),
  senha varchar(200),
  tell varchar(20)
);

-- Tabela de pedidos
create table pedido(
  id_pedido int auto_increment primary key,
  id_cliente int,
  data_pedido date,
  foreign key (id_cliente) references login(id_client)
);

-- Tabela de itens do pedido
CREATE TABLE itens_pedido (
  id_item INT AUTO_INCREMENT PRIMARY KEY,
  id_pedido INT,
  id_produto INT,
  id_bowl INT,  -- Para indicar um bowl personalizado
  quantidade INT,
  preco_und DECIMAL(10,2),
  subtotal DECIMAL(10,2),
  FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido),
  FOREIGN KEY (id_produto) REFERENCES produto(id_produto),
  FOREIGN KEY (id_bowl) REFERENCES bowl(id_bowl)  -- Relacionamento com a tabela de bowls
);


-- Tabela de produtos
create table produto(
  id_produto int auto_increment primary key,
  nome_produto varchar(300),
  valor_und decimal(10,2),
  nome_categoria varchar(20),
  quantidade int,
  desc_ varchar (300)
);

-- Tabela de ingredientes para bowl
create table bowl_ing(
  id_ing_bowl int auto_increment primary key,
  ingrediente varchar(100),
  valor_ing decimal(10,2)
);

-- Tabela de bowls
create table bowl(
  id_bowl int auto_increment primary key,
  nome_bowl varchar(100),
  valor_bowl decimal(10,2),
  id_tamanho int,
  foreign key (id_tamanho) references tamanho(id_tamanho)
);

-- Tabela de tamanhos de bowls
create table tamanho(
  id_tamanho int auto_increment primary key,
  tamanho varchar(10),
  limt_ing int
);

-- Tabela de relacionamento entre bowls e ingredientes
create table bowl_ingredientes(
  id_bowl_ingredientes int auto_increment primary key,
  id_bowl int,
  id_ing_bowl int,
  valor_bowl_ing decimal(10,2),
  foreign key (id_bowl) references bowl(id_bowl),
  foreign key (id_ing_bowl) references bowl_ing(id_ing_bowl)
);

create table reserva (	
  id_reserva int auto_increment primary key,
  id_cliente int,
  data_reserva date,
  horario_reserva time,
  numero_pessoas int,
  status_reserva varchar(50),
  data_criacao timestamp default current_timestamp,
  foreign key (id_cliente) references login(id_client)
);

-- Inserir os produtos na tabela 'produto'
INSERT INTO produto (nome_produto, valor_und, nome_categoria, quantidade, desc_)
VALUES
    ('hot roll', 25.00, ('mais vendidos'), null, 'Um tipo de sushi empanado e frito, geralmente recheado com salmão e cream cheese'),
    ('sashimi', 30.00, ('mais vendidos'), null, 'O sashimi é um prato japonês que consiste em fatias finas de peixe cru ou frutos do mar'),
    ('ramen', 28.00, ('mais vendidos'), null, 'Sopa de macarrão, acompanhada de carne, ovo cozido, algas e vegetais.'),
    ('nigiri', 23.00, ('mais vendidos'), null, 'O nigiri consiste em uma pequena porção de arroz temperado, coberto por uma fatia de peixe cru.'),
    ('temaki', 30.00, ('mais vendidos'), null, 'Temaki é um tipo de sushi em forma de cone, muito popular em restaurantes japoneses.'),
    ('urumaki', 27.00, ('mais vendidos'), null, 'O uramaki é um tipo de sushi japonês conhecido como "sushi invertido."'),
    ('harumaki', 12.00, ('mais vendidos'), null, 'Rolinho de massa fina, recheado com vegetais ou carne, geralmente frito e servido com molho agridoce.'),
    ('yakisoba', 20.00, ('mais vendidos'), null, 'Prato feito com macarrão, vegetais e carne, cozido em um molho agridoce ou à base de shoyu.'),
    ('edamame temperado', 12.00, 'entradas', null, 'Vagens de soja cozidas no vapor e polvilhadas com sal marinho.'),
    ('sunomono', 10.00, 'entradas', null, 'Vagens de soja cozidas no vapor e polvilhadas com sal marinho.'),
    ('tartar de salmão com avocado', 26.00, 'entradas', null, 'Salmão e avocado temperados com molho de soja.'),
    ('tataki de atum', 12.00, 'entradas', null, 'Atum selado com molho ponzu, cebolinha e gergelim.'),
    ('tempurá de legumes', 15.00, 'entradas', null, 'Legumes crocantes em massa leve de tempurá.'),
    ('gyoza', 18.00, 'entradas', null, 'Legumes crocantes em massa leve de tempurá.'),
    ('shimeji na manteiga', 12.00, 'entradas', null, 'Cogumelos shimeji salteados na manteiga e shoyu.'),
    ('missoshiro', 20.00, 'entradas', null, 'Sopa de missô com tofu e cebolinha.'),
    ('arroz gohan', 10.00, 'acompanhamentos', null, 'Arroz cozido no estilo japonês, perfeito para acompanhar.'),
    ('kimchi', 15.00, 'acompanhamentos', null, 'É um prato tradicional coreano feito de hortaliças fermentadas com temperos.'),
    ('salada de repolho com gergelim', 16.00, 'acompanhamentos', null, 'Um prato leve e refrescante, muito comum na culinária asiática.'),
    ('harumaki', 30.00, 'acompanhamentos', null, 'Rolinho de massa fina, recheado com vegetais ou carne, com molho agridoce.'),
    ('salada de algas', 18.00, 'acompanhamentos', null, 'Um prato leve e refrescante feito principalmente com a alga wakame.'),
    ('tofu grelhado', 10.00, 'acompanhamentos', null, 'Uma preparação onde o tofu é temperado e grelhado até ficar dourado por fora.'),
    ('tsukemono', 20.00, 'acompanhamentos', null, 'São conservas japonesas feitas a partir de vegetais marinados em sal, vinagre, farelo de arroz, sake kasu.'),
    ('daigaku imo', 18.00, 'acompanhamentos', null, 'Cubos de batata doce caramelizados com molho de açúcar e shoyu.'),
    ('negroni', 25.00, 'bebidas', null, 'Coquetel italiano com gin, vermute rosso e Campari, levemente amargo.'),
    ('aperol spritz', 24.00, 'bebidas', null, 'Refrescante e levemente amargo, feito com Aperol, prosecco e água com gás.'),
    ('soda', 12.00, 'bebidas', null, 'Água com gás com xarope de frutas como maracujá, maçã verde ou romã.'),
    ('refrigerantes', 6.00, 'bebidas', null, 'Coca-Cola, Sprite, e Pepsi, nas versões tradicionais e zero açúcar.'),
    ('espresso martini', 28.00, 'bebidas', null, 'Coquetel à base de vodka, café espresso e licor de café.'),
    ('french 75', 30.00, 'bebidas', null, 'Gin, champanhe, suco de limão e um toque de açúcar, refrescante e elegante.'),
    ('água mineral', 5.00, 'bebidas', null, 'Disponível com e sem gás, uma água mineral purificada de alta qualidade.'),
    ('suco natural de frutas', 8.00, 'bebidas', null, 'Sucos frescos de laranja, limão, abacaxi e maracujá, feitos na hora.'),
    ('pudim de matchá', 18.00, 'sobremesas', null, 'Pudim cremoso com sabor intenso de matcha. *8 peças.'),
    ('sushi doce', 20.00, 'sobremesas', null, 'Geralmente feito com frutas, arroz doce e outros ingredientes açucarados. *8 peças.'),
    ('mochi de chá verde', 18.00, 'sobremesas', null, 'Massa de arroz japonesa com recheio de chocolate.'),
    ('tempurá de sorvete', 22.00, 'sobremesas', null, 'Sorvete frito com calda de lichia.'),
    ('petit gateau', 25.00, 'sobremesas', null, 'Bolinho de chocolate quente com sorvete.'),
    ('panna cotta', 18.00, 'sobremesas', null, 'Creme italiano com calda de frutas vermelhas.'),
    ('mousse de maracujá', 19.00, 'sobremesas', null, 'Leve e refrescante feita com polpa de maracujá, leite condensado, creme de leite e gelatina sem sabor.'),
    ('brownie com caramelo', 24.00, 'sobremesas', null, 'Brownie quente, calda de caramelo e sorvete.');
    



INSERT INTO tamanho (tamanho, limt_ing)
VALUES
    ('Pequeno', 3),  -- Bowl pequeno com limite de 3 ingredientes
    ('Médio', 5),    -- Bowl médio com limite de 5 ingredientes
    ('Grande', 7);   -- Bowl grande com limite de 7 ingredientes


INSERT INTO bowl_ing (ingrediente, valor_ing)
VALUES
    ('Arroz', 5.00),
    ('Frango', 7.50),
    ('Peixe', 10.00),
    ('Abacate', 4.00),
    ('Alface', 2.50),
    ('Tomate', 3.00),
    ('Molho de soja', 1.50);

-- Desabilitar as verificações de chave estrangeira
SET FOREIGN_KEY_CHECKS = 0;

-- Agora, você pode excluir a tabela sem o erro
DROP TABLE `produto`;

-- Habilitar novamente as verificações de chave estrangeira
SET FOREIGN_KEY_CHECKS = 1;

ALTER TABLE login CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE pedido CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE itens_pedido CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE produto CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE bowl_ing CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE bowl CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE tamanho CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE bowl_ingredientes CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE reserva CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

SET NAMES utf8mb4;
ALTER DATABASE bambui3 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

ALTER TABLE login CHANGE COLUMN tell telefone VARCHAR(20);


select * from produto;
SHOW VARIABLES LIKE 'character_set%';

SHOW FULL COLUMNS FROM produto;

