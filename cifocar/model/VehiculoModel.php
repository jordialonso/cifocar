<?php
class VehiculoModel{
    //PROPIEDADES
    public $id, $matricula, $modelo, $color, $precio_venta, $precio_compra, $kms, $caballos, $fecha_venta, $estado, $any_matriculacion, $detalles, $imagen;
 
    //METODOS
    //guarda el usuario en la BDD
    public function guardar(){
        $vehiculo_table = Config::get()->db_vehiculo_table;
        $consulta = "INSERT INTO $vehiculo_table (matricula, modelo, color, precio_venta, kms, caballos, estado, any_matriculacion, detalles, imagen)
			VALUES ('$this->matricula','$this->modelo','$this->color',$this->precio_venta,$this->kms,$this->caballos, $this->estado, $this->any_matriculacion,'$this->detalles','$this->imagen');";
        echo $consulta;
         Database::get()->query($consulta);
        echo Database::get()->error;
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
}
?>