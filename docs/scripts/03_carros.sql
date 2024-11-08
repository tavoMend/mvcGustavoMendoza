
create table carros(
codigo int not null primary key auto_increment comment 'primary key ' ,
modelo varchar(120),
marca varchar(120), 
anio int , 
kilometraje int,
chasis varchar(120), 
color varchar(64),
registro varchar(120),
cilindraje int, 
notas text ,
rodeje varchar(120),
estado char(3),
creado datetime ,
precioventa decimal(13,2),
preciominimo decimal(13,2),
actualizado datetime
)comment 'tabla donde se registran los carros del dealer ';