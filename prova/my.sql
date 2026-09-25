create database loja_livro
use loja_livro

create table vendedores(
id int auto_increment not null, 
nome varchar (50) not null,
senha varchar (50) not null,
primary key (id)
)

create table livros (
id int auto_increment not null,
ISBN varchar (67) null,
Nome varchar (67) null,
Categoria varchar (67) null,
Valor varchar (67) null,
Quantidade varchar (67) null,
Genero varchar (67) null,
Editora varchar (67) null,
Escritores varchar (67) null,
Resumo varchar (67) null,
primary key (id)
)