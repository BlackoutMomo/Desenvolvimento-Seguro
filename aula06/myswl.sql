create database loja
use loja
create table usuario(
id int auto_increment,
usuario varchar (50) not null,
senha varchar (50) not null,
primary key (id)
)
drop table produtos
create table produtos(
id int auto_increment,
produto varchar(50) not null,
preco int not null,
descricao varchar (150) not null,
primary key (id)
)