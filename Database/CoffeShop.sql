-- Active: 1702060009878@@127.0.0.1@3306@phpmyadmin
DROP schema cafeteria;
-- @block DB start
CREATE schema IF NOT EXISTS cafeteria;


USE cafeteria;


/* 
 Tabelas (
 
 Empresa
 Configuracoes
 Categorias
 Produtos
 Produtos_Categoria
 Ocupacoes
 Pessoas(
 Clientes
 Funcionarios
 Administrador
 Fornecedores
 )
 Pessoas_Categorias
 Vendas
 Vendas_Item
 FormaPagamento
 
 ); 
 */
CREATE TABLE IF NOT EXISTS empresa (
    cnpj varchar(18) PRIMARY KEY,
    nomeFantasia varchar(50) NULL,
    razaoSocial varchar(50) NULL,
    dataAbertura date NULL,
    cep varchar(50) NULL,
    logradouro varchar(50) NULL,
    numero VARCHAR(10) NULL,
    bairro varchar(30) NULL,
    municipio varchar(30) NULL,
    uf varchar(2) NULL,
    incricaoEstadual varchar(30) NULL,
    atividadePrincipal varchar(100) NULL
);

INSERT INTO empresa values ('11.111.111/0001-11', 'Bonne Café', 'Bonne Café', '2023-12-12', '00000-000', 'rua x', '01', 'y', 'Parelhas', 'RN', 'xxx', 'Cafeteria');


/* CREATE TABLE configuracoes(
 
 ) */

-- @block create table categorias
CREATE TABLE IF NOT EXISTS categorias (
    categoriaId int PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NULL UNIQUE KEY
);
INSERT into categorias(nome) values('cafe');
INSERT into categorias(nome) values('massas');
INSERT into categorias(nome) values('sobremesas');
INSERT into categorias(nome) values('chocolate');
INSERT into categorias(nome) values('morango');
INSERT into categorias(nome) values('vanilla');
INSERT into categorias(nome) values('limao');
INSERT into categorias(nome) values('leite');
INSERT into categorias(nome) values('sorvete');
INSERT into categorias(nome) values('sem gluten');
INSERT into categorias(nome) values('desnatado');
INSERT into categorias(nome) values('descafeinado');
INSERT into categorias(nome) values('queijo');
INSERT into categorias(nome) values('doce');
INSERT into categorias(nome) values('salgado');
INSERT into categorias(nome) values('chantilly');
INSERT into categorias(nome) values('bolo');


-- @block produtos
CREATE TABLE IF NOT EXISTS produtos (
    produtoId int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(30) NULL,
    STATUS varchar(20) NULL,
    quantidade int NULL,
    valor double NULL,
    codBarras int NULL UNIQUE,
    path varchar(100) NOT NULL
);

INSERT INTO produtos (nome, quantidade, valor, path) values ("café preto", 10, 5, "prod/cafe-preto");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café latte", 10, 5, "prod/cafe-latte");
INSERT INTO produtos (nome, quantidade, valor, path) values ("capuccino", 10, 5, "prod/capuccino");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café americano", 10, 5, "prod/cafe-americano");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café espresso", 10, 5, "prod/cafe-espresso");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café mocha", 10, 5, "prod/cafe-mocha");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café com leite", 10, 5, "prod/cafe-com-leite");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café com creme", 10, 5, "prod/cafe-com-creme");
INSERT INTO produtos (nome, quantidade, valor, path) values ("bolo de chocolate", 10, 7, "prod/bolo-de-chocolate");
INSERT INTO produtos (nome, quantidade, valor, path) values ("torta de limão", 10, 7, "prod/torta-de-limão");
INSERT INTO produtos (nome, quantidade, valor, path) values ("croissant", 10, 5, "prod/croissant");
INSERT INTO produtos (nome, quantidade, valor, path) values ("cookie", 10, 3, "prod/cookie");
INSERT INTO produtos (nome, quantidade, valor, path) values ("bolo de cenoura com chocolate", 10, 7, "prod/bolo-de-cenoura-com-chocolate");
INSERT INTO produtos (nome, quantidade, valor, path) values ("brownie", 10, 7, "prod/brownie");
INSERT INTO produtos (nome, quantidade, valor, path) values ("torta de frango", 10, 7, "prod/torta-de-frango");
INSERT INTO produtos (nome, quantidade, valor, path) values ("waffle com morangos", 10, 5, "prod/waffle-com-morangos");
INSERT INTO produtos (nome, quantidade, valor, path) values ("donuts", 10, 3, "prod/donuts");
INSERT INTO produtos (nome, quantidade, valor, path) values ("pão-de-queijo", 10, 5, "prod/pao-de-queijo");
INSERT INTO produtos (nome, quantidade, valor, path) values ("torrada", 10, 0.5, "prod/torrada");
INSERT INTO produtos (nome, quantidade, valor, path) values ("sonho", 10, 3, "prod/sonho");

CREATE TABLE IF NOT EXISTS produtos_categoria (
    idProduto int NOT NULL,
    idCategoria int NULL,
    PRIMARY KEY(idProduto, idCategoria),
    FOREIGN KEY (idProduto) REFERENCES produtos (produtoId),
    FOREIGN KEY (idCategoria) REFERENCES categorias (categoriaId)
);

INSERT INTO produtos_categoria (idProduto, idCategoria) values (1, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (1, 10);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (2, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (2, 8);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (3, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (3, 8);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (3, 16);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (4, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (4, 10);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (5, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (6, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (6, 4);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (6, 16);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (7, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (7, 8);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (8, 1);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (8, 16);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (9, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (9, 17);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (9, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (9, 4);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (10, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (10, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (10, 7);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (11, 2);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (11, 15);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (12, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (12, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (12, 4);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (12, 6);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (13, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (13, 4);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (13, 17);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (13, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (14, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (14, 4);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (14, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (15, 2);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (15, 15);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (16, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (16, 5);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (16, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (16, 10);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (17, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (17, 4);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (17, 5);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (17, 6);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (17, 14);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (18, 2);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (18, 13);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (18, 15);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (19, 2);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (19, 15);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (20, 3);
INSERT INTO produtos_categoria (idProduto, idCategoria) values (20, 14);

-- @block pessoas
CREATE TABLE IF NOT EXISTS ocupacoes (
    ocupacaoId int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(20) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS pessoas (
    pessoaId int PRIMARY KEY AUTO_INCREMENT,
    cpf_cnpj varchar(18) NULL UNIQUE KEY,
    nome VARCHAR(30) NULL,
    sobrenome VARCHAR(30) NULL,
    tipo varchar(15) NULL,
    email VARCHAR(50) NULL UNIQUE KEY,
    senha VARCHAR(300) NULL,
    salario double NULL,
    dataEntrada date NULL,
    ocupacao int NULL,
    nivelAcesso INT (2) NULL,
    FOREIGN KEY (ocupacao) REFERENCES ocupacoes (ocupacaoId)
);

                                                                                            -- senha: caixa 
INSERT INTO pessoas (nome, tipo, email, senha) VALUES ('caixa', 'func', 'caixa@gmail.com', '5MSJswgScdZJN25+KebAlhKyv91q4cKos2csR6oEaUPTRweYLi/zheK8Jm5zGWH7WegycoBs/PdBlzg75P1363uRC7CxAIZ1MiCKM6l1tBtYsgCtssiXarptFTvuCgG4Dm0FLT06Euw1cx8RitfOwhNpnnZexHY6W+iqDku5cic=');


CREATE TABLE IF NOT EXISTS pessoas_categoria (
    idPessoa int NOT NULL,
    idCategoria int NULL,
    PRIMARY KEY (idPessoa, idCategoria),
    FOREIGN KEY (idPessoa) REFERENCES pessoas (pessoaId),
    FOREIGN KEY (idCategoria) REFERENCES categorias (categoriaId)
);

-- @block venda
CREATE TABLE IF NOT EXISTS formaPagamento (
    formaPagamentoId int PRIMARY KEY AUTO_INCREMENT,
    tipo varchar(20) NULL
);

INSERT INTO formaPagamento (tipo) VALUES('pix');
INSERT INTO formaPagamento (tipo) VALUES('debito');

CREATE TABLE IF NOT EXISTS vendas (
    vendaId int PRIMARY KEY AUTO_INCREMENT,
    pessoaId int NOT NULL,
    valor double NULL,
    cpf_cnpj VARCHAR(18) NULL,
    numeroCartao int NULL,
    cvv int NULL,
    dataVencimento varchar(5) NULL,
    nomeNoCartao varchar(30) NULL,
    dataVenda DATE NOT NULL,
    token varchar(6) NULL,
    FOREIGN KEY (cpf_cnpj) REFERENCES pessoas (cpf_cnpj),
    FOREIGN KEY (pessoaId) REFERENCES pessoas (pessoaId)
);

CREATE TABLE IF NOT EXISTS vendas_item (
    venda_itemId int PRIMARY KEY AUTO_INCREMENT,
    vendaId int NOT NULL,
    produtoId int NOT NULL,
    quantidade int NOT NULL,
    preco_unit double NOT NULL,
    subtotal double NOT NULL,
    FOREIGN KEY (produtoId) REFERENCES produtos (produtoId),
    FOREIGN KEY (vendaId) REFERENCES vendas (vendaId)
);

