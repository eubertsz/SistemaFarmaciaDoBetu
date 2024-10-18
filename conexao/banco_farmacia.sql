create database if not exists sistema_farmacia;
use sistema_farmacia;

create table if not exists adm (
    id int auto_increment primary key,
    usuario varchar(50) not null unique,
    senha varchar(255) not null 
);

insert into adm (usuario, senha) values ('admin', '0258');

create table medicamentos (
    id int auto_increment primary key,
    nome varchar(255) not null,
    preco decimal(10, 2) not null, 
    quantidade int not null,
    categoria varchar(100) not null,
    validade date not null
);

insert into medicamentos (nome, preco, quantidade, categoria, validade) values
('Neuroxan 30mg', 520.00, 10, 'analgésico', '2027-01-15'),
('Analgil', 60.00, 2, 'analgésico', '2026-03-20'),
('Zepan', 550.00, 1, 'analgésico', '2032-04-10'),
('Piracetam', 12.00, 50, 'antipirético', '2026-07-15'),
('Inflamix', 30.00, 20, 'anti-inflamatório', '2025-01-01'),
('Amoxilina', 85.00, 30, 'antibiótico', '2028-05-30'),
('Hipertensil', 160.00, 25, 'antihipertensivo', '2025-03-01'),
('Omeprazolax', 22.00, 15, 'antiácido', '2026-10-25'),
('Colesteril', 110.00, 12, 'anticolesterol', '2025-02-05');
