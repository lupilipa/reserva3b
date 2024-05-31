# reserva3b

create database proj_reserva;

create table usuarios(
id int primary key not null auto_increment,
tipo enum ("admin", "funcionario"),
credencial varchar(100),
email varchar(200),
senha varchar(50)
);

insert into usuarios(id, tipo, credencial, email, senha) values(null, "admin", "admin", "sree3b2024@gmail.com", "boomer");
insert into usuarios(id, tipo, credencial, email, senha) values(null, "funcionario", "tester", "luanamoreiraacc@gmail.com", "tester123");
insert into usuarios(id, tipo, credencial, email, senha) values(null, "funcionario", "objecttester", “luanamoreiraacc@gmail.com", "objecttester123");
insert into usuarios(id, tipo, credencial, email, senha) values(null, "funcionario", "tester3", "icarocerebroderretido@gmail.com", "tester3123");


create table espaços(
	id int primary key not null auto_increment,
nome varchar(150)
);

create table equipamentos(
	id int primary key not null auto_increment,
nome varchar(150)
);

insert into espaços(id, nome) values(null, "Biblioteca");
insert into equipamentos(id, nome) values(null, "Datashow 0001");

create table semana(
	id int primary key not null auto_increment,
dia varchar(20)
);

insert into semana(id, dia) values(null, "Segunda-feira");
insert into semana(id, dia) values(null, "Terça-feira");
insert into semana(id, dia) values(null, “Quarta-feira");
insert into semana(id, dia) values(null, "Quinta-feira");
insert into semana(id, dia) values(null, "Sexta-feira");
insert into semana(id, dia) values(null, "Sábado");
insert into semana(id, dia) values(null, "Domingo");

create table hora_fixo(
	id int primary key not null auto_increment,
horario_inicio_fixo time,
horario_fim_fixo time,
id_semana int,
foreign key (id_semana) references semana(id)
);

create table hora_fixo_esp(
	id int primary key not null auto_increment,
id_espaços int,
foreign key (id_espaços) references espaços(id),
id_hora_fixo int,
foreign key (id_hora_fixo) references hora_fixo(id)
);

create table hora_fixo_equip(
	id int primary key not null auto_increment,
id_equipamentos int,
foreign key (id_equipamentos) references equipamentos(id),
id_hora_fixo int,
foreign key (id_hora_fixo) references hora_fixo(id)
);

insert into hora_fixo(id, horario_inicio_fixo, horario_fim_fixo, id_semana) values(null, "07:30", "08:20", 2);
insert into hora_fixo_esp(id, id_espaços, id_hora_fixo) values(null, 1, 1);
insert into hora_fixo_equip(id, id_equipamentos, id_hora_fixo) values(null, 1, 1);

create table hora_instavel(
	id int primary key not null auto_increment,
hora_instavel_inicio time,
hora_instavel_fim time,
data_instavel date
);

insert into hora_instavel(id, hora_instavel_inicio, hora_instavel_fim, data_instavel) values(null, "09:10", "12:00", “2024-05-30");

create table reservas_esp(
	id int primary key not null auto_increment,
id_espaços int,
foreign key (id_espaços) references espaços(id),
id_hora_instavel int,
foreign key (id_hora_instavel) references hora_instavel(id),
id_usuarios int,
	foreign key (id_usuarios) references usuarios(id),
responsavel varchar(30),
motivo varchar(100)
);

create table reservas_equip(
	id int primary key not null auto_increment,
id_equipamentos int,
foreign key (id_equipamentos) references equipamentos(id),
id_hora_instavel int,
foreign key (id_hora_instavel) references hora_instavel(id),
	id_usuarios int,
	foreign key (id_usuarios) references usuarios(id),
responsavel varchar(30),
motivo varchar(100)
);

insert into reservas_esp(id, id_espaços, id_hora_instavel, id_usuarios, responsavel, motivo) values(null, 1, 1, 2, "Grêmio", "Reunião para lideranças");
insert into reservas_equip(id, id_equipamentos, id_hora_instavel, id_usuarios, responsavel, motivo) values(null, 1, 1, 2, "Grêmio", "Reunião para lideranças");


