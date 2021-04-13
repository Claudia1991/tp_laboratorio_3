---Insert tabla usuarios
insert into usuario (nombre, apellido, clave, mail, fecha_registro, localidad) values
('Esteban' ,'Madou', '2345' ,'dkantor0@example.com', '2021-1-7' ,'Quilmes'),
('German', 'Gerram', '1234', 'ggerram1@hud.gov', '2020-5-8', 'Berazategui'),
('Deloris', 'Fosis' ,'5678', 'bsharpe2@wisc.edu', '2020-11-28', 'Avellaneda'), 
('Brok', 'Neiner', '4567', 'bblazic3@desdev.cn', '2020-12-8' ,'Quilmes') ,
('Garrick', 'Brent' ,'6789', 'gbrent4@theguardian.com', '2020-12-17','Moron') ,
('Bili', 'Baus' ,'0123', 'bhoff5@addthis.com', '2020-11-27' ,'Moreno') 

--Insert tabla productos
insert into producto (codigo_barras, nombre, tipo, stock, precio, fecha_creacion, fecha_modificacion) values 
('77900361', 'Westmacott', 'liquido', 33, 15.87, '2021-09-02', '2020-09-26'),
('77900362' ,'Spirit' ,'solido' ,45 ,69.74 ,'2020-9-18' ,'2020-4-14'),
('77900363' ,'Newgrosh' ,'polvo' ,14, 68.19 ,'2020-11-29' ,'2021-2-11'),
('77900364' ,'McNickle', 'polvo' ,19, 53.51 ,'2020-11-28', '2020-4-17'),
('77900365' ,'Hudd' ,'solido' ,68 ,26.56 ,'2020-12-19' ,'2020-6-19'),
('77900366' ,'Schrader' ,'polvo', 17, 96.54, '2020-8-2', '2020-4-18'),
('77900367' ,'Bachellier', 'solido' ,59, 69.17 ,'2021-1-30', '2020-6-7'),
('77900368' ,'Fleming', 'solido' ,38 ,66.77, '2020-10-26', '2020-10-3'),
('77900369' ,'Hurry' ,'solido' ,44 ,43.01 ,'2020-7-4' ,'2020-5-30-'),
('77900310' ,'Krauss', 'polvo' ,73, 35.73 ,'2021-3-3', '2020-8-30')

--Inser tabla ventas
insert into venta (id_producto, id_usuario, cantidad, fecha_venta) values
(1 ,1 ,2, '2020-7-19'),
(8 ,2 ,3 ,'2020-8-16'),
(7 ,2 ,4 ,'2021-1-24'),
(6 ,3 ,5 ,'2021-1-14'),
(3 ,4 ,6 ,'2021-3-20'),
(5 ,5 ,7 ,'2021-2-22'),
(3 ,4 ,6 ,'2020-12-2'),
(3 ,6 ,6 ,'2020-6-10'),
(2 ,6 ,6 ,'2021-2-4'),
(1 ,6, 1 ,'2020-5-17')

--Ejercicios SQL

--1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.
select * from usuario order by nombre asc

--2. Obtener los detalles completos de todos los productos líquidos.
select * from producto where tipo = 'liquido'

--3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
select * from venta where cantidad between 6 and 10

--4. Obtener la cantidad total de todos los productos vendidos.
select id_producto, sum(cantidad) as cantidad_total_vendida from venta group by id_producto

--5. Mostrar los primeros 3 números de productos que se han enviado.
select id_producto from venta limit 3

---6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
select v.id_producto, p.nombre, u.nombre from venta v 
inner join producto p on p.id = v.id_producto
inner join usuario u on u.id = v.id_usuario

--7. Indicar el monto (cantidad * precio) por cada una de las ventas.
select v.cantidad * p.precio as monto_total from venta v
inner join producto p on p.id = v.id_producto

--8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.
select sum(cantidad) as cantitad_total from venta where id_producto = 3 and id_usuario = 4

--9. Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.
select v.id_producto from venta v 
inner join usuario u on u.id = v.id_usuario
where u.localidad = 'Avellaneda'

--10.Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.
select * from usuario where nombre like '%u%' or apellido like '%u%'

--11. Traer las ventas entre junio del 2020 y febrero 2021.
select * from venta where fecha_venta >= '2020-06-01' and fecha_venta <= '2021-02-28'
select * from venta where fecha_venta between '2020-06-01' and  '2021-02-28'

--12. Obtener los usuarios registrados antes del 2021.
select * from usuario where fecha_registro < '2021'

--13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.
insert into producto (codigo_barras, nombre, tipo, stock, precio, fecha_creacion, fecha_modificacion) values ('77911361', 'chocolate', 'solido', 1, 25.35,CURRENT_DATE , '')

--14.Insertar un nuevo usuario .
insert into usuario (nombre, apellido, clave, mail, fecha_registro, localidad) values
('Claudia' ,'Jara', '2345' ,'grrr@example.com', CURRENT_DATE ,'Avellaneda')

--15.Cambiar los precios de los productos de tipo sólido a 66,60.
update producto set precio = 66.60 where tipo = 'solido'

--16.Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.
update producto set stock = 0 where stock <=20

--17.Eliminar el producto número 1010.
delete from producto where id = 10

--18.Eliminar a todos los usuarios que no han vendido productos.
delete from usuario where id not in (
    select id_usuario from venta
)
