<?php
class VehiculoModel{
    //PROPIEDADES
    public $id, $matricula, $modelo, $color, $precio_venta, $precio_compra, $kms, $caballos, $fecha_venta, $estado, $any_matriculacion, $detalles, $imagen, $vendedor, $marca;
 
    //METODOS
    //guarda el usuario en la BDD
    public function guardar(){
        $vehiculo_table = Config::get()->db_vehiculo_table;
        $consulta = "INSERT INTO $vehiculo_table (matricula, modelo, color, precio_venta, kms, caballos, estado, any_matriculacion, detalles, imagen, vendedor, marca)
			VALUES ('$this->matricula','$this->modelo','$this->color',$this->precio_venta,$this->kms,$this->caballos, $this->estado, $this->any_matriculacion,'$this->detalles','$this->imagen','$this->vendedor','$this->marca');";
      
        return Database::get()->query($consulta);
        //echo Database::get()->error;
    }
    
    
    //actualiza los datos del usuario en la BDD
    public function actualizar(){
        $vehiculo_table = Config::get()->db_vehiculo_table;
        $consulta = "UPDATE $vehiculo_table
							  SET   matricula='$this->matricula',
							  		modelo='$this->modelo',
							  		color='$this->color',
							  		precio_venta='$this->precio_venta',
                                    precio_compra='$this->precio_compra',
                                    kms=$this->kms,
							  		caballos=$this->caballos,
                                    fecha_venta='$this->fecha_venta',
							  		estado=$this->estado,
							  		any_matriculacion=$this->any_matriculacion,
                                    detalles='$this->detalles',
							  		imagen='$this->imagen'					  		
							  WHERE id='$this->id';";
        return Database::get()->query($consulta);
    }
    
    
    //elimina el usuario de la BDD
    public function borrar(){
        $vehiculo_table = Config::get()->db_vehiculo_table;
        $consulta = "DELETE FROM $vehiculo_table WHERE id='$this->id';";
        return Database::get()->query($consulta);
    }
    
    public static function getVehiculos($l=0, $o=0, $campo='id' ,$texto='', $campoOrden='id' ,$sentido='ASC'){
        $vehiculo_table = Config::get()->db_vehiculo_table;
        $consulta = "SELECT * FROM $vehiculo_table
		                 WHERE $campo LIKE '%$texto%'
                         ORDER BY $campoOrden $sentido";
        if($l>0)$consulta .= " LIMIT $l";
        if($o>0)$consulta .= " OFFSET $o";
        
        $resultado = Database::get()->query($consulta);
        
        //prepara la lista con los resultados
        $lista=array();
        
        //rellenar la lista con los resultados
        while($vehiculo = $resultado->fetch_object('VehiculoModel'))
            $lista[] = $vehiculo;
            
            $resultado->free();
            return $lista;
    } 
    public static function getVehiculo($id=0){
        
        $consulta = "SELECT * FROM vehiculos WHERE id=$id";
        $conexio = Database::get();
        $resultat = $conexio->query($consulta);
        
        //si no hi ha resultats retorna un null
        if(!$resultat) return null;
        
        $vehiculo = $resultat->fetch_object('VehiculoModel');
        
        $resultat->free();
        
        return $vehiculo;
    }  
    
    public static function getTotal($t='', $c='id'){
        $consulta = "SELECT * FROM vehiculos
                         WHERE $c LIKE '%$t%'";
        
        $conexion = Database::get();
        $resultados = $conexion->query($consulta);
        $total = $resultados->num_rows;
        $resultados->free();
        return $total;
    }
    
}
?>