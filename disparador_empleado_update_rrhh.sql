delimiter //
CREATE DEFINER=`root`@`localhost` TRIGGER `empleado_update_rrhh` AFTER UPDATE ON `empleados` 
FOR EACH ROW 
BEGIN
	
    /*Variables del departamento*/
    declare nom varchar(255);


    /*Jefe*/
        
        if new.departamento is not null then
        if new.id is not null then
			select nombre into nom from departamentos where id = new.departamento;
					if nom = "Recursos humanos" then
                                    
						UPDATE `users` set rol = "Recursos humanos"  where users.id = new.id;
                        
					else
                            
						UPDATE `users` set rol = null  where users.id = new.id;
                    
					end if;
                    
		else

				select nombre into nom from departamentos where id = new.departamento;
					if nom = "Recursos humanos" then

						UPDATE `users` set rol = "Recursos humanos"  where users.id = old.id;
                        
					else

						UPDATE `users` set rol = null  where users.id = old.id;
                    
					end if;
                        

          
			end if;
        
        end if;
    
END
