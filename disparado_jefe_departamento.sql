delimiter //
CREATE DEFINER=`root`@`localhost` TRIGGER `jefe_departamento` BEFORE UPDATE ON `departamentos` 
FOR EACH ROW 
BEGIN
	
    /*Variables del departamento*/
    declare dep int;


    /*Jefe*/
		if new.jefe is not null then
        
			select departamento into dep from empleados where id = new.jefe;
        
			if new.id is not null then
            
				if  new.id != dep then
					SIGNAL SQLSTATE '02000'
					SET MESSAGE_TEXT = "El jefe insertado no esta en el mismo departamento";
                
				else 
					if new.nombre != null and new.nombre = "Recursos humanos" then
                
						UPDATE `users` set rol = "jefe Recursos humanos"  where users.id = new.jefe;
                    
						UPDATE `users` set rol = "Recursos humanos"  where users.id = old.jefe;
                        
					else 
						if  old.nombre = "Recursos humanos" then 
                
							UPDATE `users` set rol = "jefe Recursos humanos"  where users.id = new.jefe;
                            
                            UPDATE `users` set rol = "Recursos humanos"  where users.id = old.jefe;
                    
						else
							UPDATE `users` set rol = "jefe"  where users.id = new.jefe;
                            
                            UPDATE `users` set rol = null  where users.id = old.jefe;
                    
						end if;
                        
					end if;
                    
				end if;
            
            else
            
				if  old.id != dep then
				SIGNAL SQLSTATE '02000'
					SET MESSAGE_TEXT = "El jefe insertado no esta en el mismo departamento";
                
				else 
					if new.nombre != null and new.nombre like "Recursos humanos" then
                
						UPDATE `users` set rol = "jefe Recursos humanos"  where users.id = new.jefe;
                        
                        UPDATE `users` set rol = "Recursos humanos"  where users.id = old.jefe;
                    
					else 
						if old.nombre like "Recursos humanos" then 
                
							UPDATE `users` set rol = "jefe Recursos humanos"  where users.id = new.jefe;
                            
                            UPDATE `users` set rol = "Recursos humanos"  where users.id = old.jefe;
                    
						else
							UPDATE `users` set rol = "jefe"  where users.id = new.jefe;
                            
                            UPDATE `users` set rol = null  where users.id = old.jefe;
                    
						end if;
                        
					end if;
                    
				end if;
            
            end if;
			
        
        end if;
        
    
END
