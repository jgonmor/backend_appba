delimiter //
CREATE DEFINER=`root`@`localhost` TRIGGER `empleado_jefe_departamento` BEFORE UPDATE ON `empleados` 
FOR EACH ROW 
BEGIN
	
    /*Variables del departamento*/
    declare boss int;


    /*Jefe*/
		if new.departamento is not null then
        
			select jefe into boss from departamentos where id = new.departamento;
        
			if new.id is not null then
            
				if  new.id then
					SIGNAL SQLSTATE '02000'
					SET MESSAGE_TEXT = "No se puede cambiar de departamento porque es el jefe de su actual departamento";
                
				end if;
            
            else
            
				if  old.id  = boss then
					SIGNAL SQLSTATE '02000'
					SET MESSAGE_TEXT = "No se puede cambiar de departamento porque es el jefe de su actual departamento";
                
				end if;
            
            end if;
			
        
        end if;
        
END
