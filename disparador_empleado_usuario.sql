delimiter //
CREATE DEFINER=`root`@`localhost` TRIGGER `empleado_crear_usuario` after insert ON `empleados` 
FOR EACH ROW 
BEGIN
	
   insert into users (id, DNI, password) values (new.id, new.dni, concat(new.nombre, new.dni));

        
END//
