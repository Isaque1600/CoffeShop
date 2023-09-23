-- Active: 1694518027618@@127.0.0.1@3306
create schema cafeteria;

use cafeteria;

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
 
 ) 
 */

CREATE Table empresa (
    cnpj varchar(18) PRIMARY KEY,
    nomeFantasia varchar(50) null,
    razaoSocial varchar(50) null,
    dataAbertura date null,
    cep varchar(50) null,
    logradouro varchar(50) null,
    numero VARCHAR(10) null,
    bairro varchar(30) null,
    municipio varchar(30) null,
    uf varchar(2) null,
    incricaoEstadual varchar(30) null,
    atividadePrincipal varchar(100) null)

/* CREATE TABLE configuracoes(
 
 ) */

create table
    categorias(categoriaId int primary key auto_increment,
    nome VARCHAR(30) null UNIQUE)

CREATE Table
    produtos(
        produtoId int PRIMARY KEY auto_increment,
        nome varchar(30) null,
        status varchar(20) null,
        quantidade int null,
        valor double null,
        codBarras int null UNIQUE
    )

CREATE Table
    produtos_categoria(
        produto_categoriaId int PRIMARY KEY,
        categoria int null,
        Foreign Key (produto_categoriaId) REFERENCES produtos(produtoId),
        Foreign Key (categoria) REFERENCES categorias(categoriaId)
    )

CREATE Table
    ocupacoes(
        ocupacaoId int PRIMARY KEY auto_increment,
        nome varchar(20) not null UNIQUE
    )

create table
    pessoas(
        pessoaId int PRIMARY KEY auto_increment,
        cpf_cnpj varchar(18) null UNIQUE KEY,
        nome VARCHAR(30) null,
        sobrenome VARCHAR(30) null,
        tipo varchar(15) null,
        email VARCHAR(50) null UNIQUE KEY,
        senha VARCHAR(300) null,
        salario double NULL,
        dataEntrada date null,
        ocupacao int null,
        nivelAcesso INT(2) null,
        Foreign Key (ocupacao) REFERENCES ocupacoes(ocupacaoId)
    )

CREATE Table 
    pessoas_categoria(
        pessoa_categoriaId int PRIMARY KEY AUTO_INCREMENT,
        idpessoa int not null,
        categoria int NULL,
        Foreign Key (idPessoa) REFERENCES pessoas(pessoaId),
        Foreign Key (categoria) REFERENCES categorias(categoriaId)
    )

CREATE Table
    formaPagamento(
        formaPagamentoId int PRIMARY KEY auto_increment,
        tipo varchar(20) null
    )

CREATE Table
    vendas(
        vendaId int PRIMARY KEY,
        pessoaId int not null,
        venda_itemId int not null,
        valor double null,
        cpf_cnpj VARCHAR(18) null,
        numeroCartao int NULL,
        cvv int null,
        dataVencimento varchar(5) null,
        nomeNoCartao varchar(30) null,
        Foreign Key (cpf_cnpj) REFERENCES pessoas(cpf_cnpj),        
        Foreign Key (venda_itemId) REFERENCES vendas_item(venda_itemId),
        Foreign Key (pessoaId) REFERENCES pessoas(pessoaId)
    )

-- drop table vendas;

CREATE Table
    vendas_item(
        venda_itemId int PRIMARY KEY,
        quantidade int not NULL,
        produtoId int NOT NULL,
        Foreign Key (produtoId) REFERENCES produtos(produtoId)
    )

CREATE VIEW pessoa_Favoritos
AS
SELECT p.pessoaId, p.cpf_cnpj, pc.categoria 
FROM pessoas p, pessoas_categoria pc
WHERE p.pessoaId = pc.idpessoa;