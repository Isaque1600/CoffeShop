--@block drop db

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

INSERT INTO produtos (nome, quantidade, valor, path) values ("café preto", 10, 0, "prod/cafe-preto");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café latte", 10, 0, "prod/cafe-latte");
INSERT INTO produtos (nome, quantidade, valor, path) values ("capuccino", 10, 0, "prod/capuccino");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café americano", 10, 0, "prod/cafe-americano");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café espresso", 10, 0, "prod/cafe-espresso");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café mocha", 10, 0, "prod/cafe-mocha");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café com leite", 10, 0, "prod/cafe-com-leite");
INSERT INTO produtos (nome, quantidade, valor, path) values ("café com creme", 10, 0, "prod/cafe-com-creme");
INSERT INTO produtos (nome, quantidade, valor, path) values ("bolo de chocolate", 10, 0, "prod/bolo-de-chocolate");
INSERT INTO produtos (nome, quantidade, valor, path) values ("torta de limão", 10, 0, "prod/torta-de-limão");
INSERT INTO produtos (nome, quantidade, valor, path) values ("croissant", 10, 0, "prod/croissant");
INSERT INTO produtos (nome, quantidade, valor, path) values ("cookie", 10, 0, "prod/cookie");
INSERT INTO produtos (nome, quantidade, valor, path) values ("bolo de cenoura com chocolate", 10, 0, "prod/bolo-de-cenoura-com-chocolate");
INSERT INTO produtos (nome, quantidade, valor, path) values ("brownie", 10, 0, "prod/brownie");
INSERT INTO produtos (nome, quantidade, valor, path) values ("torta de frango", 10, 0, "prod/torta-de-frango");
INSERT INTO produtos (nome, quantidade, valor, path) values ("waffle com morangos", 10, 0, "prod/waffle-com-morangos");
INSERT INTO produtos (nome, quantidade, valor, path) values ("donuts", 10, 0, "prod/donuts");
INSERT INTO produtos (nome, quantidade, valor, path) values ("pão-de-queijo", 10, 0, "prod/pao-de-queijo");
INSERT INTO produtos (nome, quantidade, valor, path) values ("torrada", 10, 0, "prod/torrada");
INSERT INTO produtos (nome, quantidade, valor, path) values ("sonho", 10, 0, "prod/sonho");

CREATE TABLE IF NOT EXISTS produtos_categoria (
    idProduto int NOT NULL,
    idCategoria int NULL,
    PRIMARY KEY(idProduto, idCategoria),
    FOREIGN KEY (idProduto) REFERENCES produtos (produtoId),
    FOREIGN KEY (idCategoria) REFERENCES categorias (categoriaId)
);

-- drop table produtos_categoria;

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

CREATE TABLE IF NOT EXISTS vendas (
    vendaId int PRIMARY KEY,
    pessoaId int NOT NULL,
    valor double NULL,
    cpf_cnpj VARCHAR(18) NULL,
    numeroCartao int NULL,
    cvv int NULL,
    dataVencimento varchar(5) NULL,
    nomeNoCartao varchar(30) NULL,
    FOREIGN KEY (cpf_cnpj) REFERENCES pessoas (cpf_cnpj),
    FOREIGN KEY (pessoaId) REFERENCES pessoas (pessoaId)
);

CREATE TABLE IF NOT EXISTS vendas_item (
    venda_itemId int PRIMARY KEY,
    vendaId int NOT NULL,
    produtoId int NOT NULL,
    quantidade int NOT NULL,
    preco_unit double NOT NULL,
    subtotal double NOT NULL,
    FOREIGN KEY (produtoId) REFERENCES produtos (produtoId),
    FOREIGN KEY (vendaId) REFERENCES vendas (vendaId)
);



-- @block views
-- drop table vendas;
CREATE VIEW pessoa_Favoritos AS
SELECT
    p.pessoaId as pessoaId,
    p.cpf_cnpj as cpf_cnpj,
    pc.categoria as categoria
FROM
    pessoas p,
    pessoas_categoria pc
WHERE
    p.pessoaId = pc.idpessoa;

CREATE VIEW produtos_Categorias AS
SELECT
    p.produtoId as protudoId,
    p.codBarras as codBarras,
    pc.categoria as categoria
FROM
    produtos p,
    produtos_categoria pc
WHERE
    p.produtoId = pc.produto_categoriaId;
