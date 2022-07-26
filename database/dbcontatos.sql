create database dbcontatos;
use dbcontatos;

create table tbl_contatos(
    id int not null primary key auto_increment unique key,
    nome_completo varchar(80) not null,
    data_nascimento date not null,
    profissao varchar(60),
    email varchar(80) not null,
    celular varchar(20) not null,
    telefone varchar(20),
    celular_whatsapp BOOLEAN,
    notificacao_email BOOLEAN,
    envio_sms BOOLEAN
);

desc tbl_contatos;
