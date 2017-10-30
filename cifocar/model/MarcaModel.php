<?php
	class MarcaModel{
		//PROPIEDADES DE LA MARCA
		public $marca;
		
		//METODOS
		//guarda el usuario en la BDD
		public static function guardar($marca){
			$marca_table = Config::get()->db_marca_table;
			$consulta = "INSERT INTO $marca_table VALUES ('$marca');";
			return Database::get()->query($consulta);
		}	
		
		//actualiza los datos del usuario en la BDD
		public static function actualizar($mnew, $mold){
			$marca_table = Config::get()->db_marca_table;
			$consulta = "UPDATE $marca_table 
                         SET marca='$mnew' WHERE marca='$mold';";
		
			Database::get()->query($consulta);
			
			//retornar número de filas afectadas
			return Database::get()->affected_rows;
		}
			
		//elimina el usuario de la BDD
		public static function borrar($marca){
			$marca_table = Config::get()->db_marca_table;
			$consulta = "DELETE FROM $marca_table WHERE marca='$marca';";
			return Database::get()->query($consulta);
		}
				
		// $l es limit, $o es offset
		public static function getMarcas($l=0, $o=0, $texto='', $sentido='ASC'){
		    $marca_table = Config::get()->db_marca_table;
		    $consulta = "SELECT marca FROM $marca_table
		                 WHERE marca LIKE '%$texto%' 
                         ORDER BY marca $sentido";
		    if($l>0)$consulta .= " LIMIT $l";
		    if($o>0)$consulta .= " OFFSET $o";
		    
		    
		    $resultado = Database::get()->query($consulta);
		
		    //prepara la lista con los resultados
		    $lista=array();
		    
		    //rellenar la lista con los resultados
		    while($marca = $resultado->fetch_object('MarcaModel'))
		        $lista[] = $marca;
		    
		    $resultado->free();
		    //var_dump($lista);
		    return $lista;
		} 
	
	}	
?>
