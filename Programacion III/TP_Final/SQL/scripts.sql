--Insert de codigos de empleados
INSERT INTO `Codigos_Usuarios`(`codigo`, `descripcion`) VALUES (1,"Mozo"), (2,"Bartender"), (3,"Cervecero"),(4,"Cocinero"),(5,"Socio")

--Insert de codigos de sectores
INSERT INTO `Sectores_Restaurant`(`codigo`, `descripcion`) VALUES (1,"Cocina"), (2,"Candy bar"), (3,"Barra tragos"),(4,"Barra cervezas")

--Insert de estados pedidos
INSERT INTO `Estados_Pedidos`(`descripcion`) VALUES ("Pendientes") , ("Pendientes") , ("Listo para servir")

--insert estados mesas
INSERT INTO `Estados_Mesas`(`descripcion`) VALUES ("Con cliente esperando pedido"), ("Con cliente comiendo"), ("Con cliente pagando"),("Cerrada")