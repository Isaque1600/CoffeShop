CREATE schema cafeteria;


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
CREATE TABLE empresa (
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
CREATE TABLE categorias (
    categoriaId int PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NULL UNIQUE KEY
);
INSERT into categorias(nome) values('salgado');
INSERT into categorias(nome) values('doce');
INSERT into categorias(nome) values('cafe');
INSERT into categorias(nome) values('suco');
INSERT into categorias(nome) values('refrigerante');
INSERT into categorias(nome) values('bolo');
INSERT into categorias(nome) values('coxinha');
INSERT into categorias(nome) values('pastel');


-- @block
CREATE TABLE produtos (
    produtoId int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(30) NULL,
    STATUS varchar(20) NULL,
    quantidade int NULL,
    valor double NULL,
    codBarras int NULL UNIQUE
);


CREATE TABLE produtos_categoria (
    produto_categoriaId int PRIMARY KEY,
    idProduto int NOT NULL,
    categoria int NULL,
    FOREIGN KEY (idProduto) REFERENCES produtos (produtoId),
    FOREIGN KEY (categoria) REFERENCES categorias (categoriaId)
);

-- drop table produtos_categoria;


CREATE TABLE ocupacoes (
    ocupacaoId int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(20) NOT NULL UNIQUE
);


CREATE TABLE pessoas (
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


CREATE TABLE pessoas_categoria (
    pessoa_categoriaId int PRIMARY KEY AUTO_INCREMENT,
    idpessoa int NOT NULL,
    categoria int NULL,
    FOREIGN KEY (idPessoa) REFERENCES pessoas (pessoaId),
    FOREIGN KEY (categoria) REFERENCES categorias (categoriaId)
);


CREATE TABLE formaPagamento (
    formaPagamentoId int PRIMARY KEY AUTO_INCREMENT,
    tipo varchar(20) NULL
);


CREATE TABLE vendas_item (
    venda_itemId int PRIMARY KEY,
    quantidade int NOT NULL,
    produtoId int NOT NULL,
    FOREIGN KEY (produtoId) REFERENCES produtos (produtoId)
);


CREATE TABLE vendas (
    vendaId int PRIMARY KEY,
    pessoaId int NOT NULL,
    venda_itemId int NOT NULL,
    valor double NULL,
    cpf_cnpj VARCHAR(18) NULL,
    numeroCartao int NULL,
    cvv int NULL,
    dataVencimento varchar(5) NULL,
    nomeNoCartao varchar(30) NULL,
    FOREIGN KEY (cpf_cnpj) REFERENCES pessoas (cpf_cnpj),
    FOREIGN KEY (venda_itemId) REFERENCES vendas_item (venda_itemId),
    FOREIGN KEY (pessoaId) REFERENCES pessoas (pessoaId)
);


-- drop table vendas;
CREATE VIEW pessoa_Favoritos AS
SELECT
    p.pessoaId,
    p.cpf_cnpj,
    pc.categoria
FROM
    pessoas p,
    pessoas_categoria pc
WHERE
    p.pessoaId = pc.idpessoa;

CREATE VIEW produtos_Categorias AS
SELECT
    p.produtoId,
    p.codBarras,
    pc.categoria
FROM
    produtos p,
    pessoas_categoria pc
WHERE
    p.produtoId = pc.pessoa_categoriaId;

create view pessoa_produto_favorito AS
select
    PE.pessoaId,
    PE.nome as nome_pessoa,
    PE.cpf_cnpj,
    PO.produtoId,
    PO.nome as nome_produto,
    POC.categoria
FROM
    pessoas as PE,
    produtos as PO,
    pessoas_categoria as PEC,
    produtos_categoria as POC
WHERE
    PEC.categoria = POC.categoria