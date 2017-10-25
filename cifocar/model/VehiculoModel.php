<?php
class VehiculoModel{
    //PROPIEDADES
    public $id, $user, $password, $nombre, $privilegio=100, $admin=0, $email, $imagen='', $fecha;
    
    //METODOS
    //guarda el usuario en la BDD
    public function guardar(){
        $user_table = Config::get()->db_user_table;
        $consulta = "INSERT INTO $user_table(user, password, nombre, privilegio, admin, email, imagen)
			VALUES ('$this->user','$this->password','$this->nombre',100,0,'$this->email', '$this->imagen');";
        
        return Database::get()->query($consulta);
    }
    
    
    //actualiza los datos del usuario en la BDD
    public function actualizar(){
        $user_table = Config::get()->db_user_table;
        $consulta = "UPDATE $user_table
							  SET password='$this->password',
							  		nombre='$this->nombre',
							  		email='$this->email',
							  		imagen='$this->imagen'
							  WHERE user='$this->user';";
        return Database::get()->query($consulta);
    }
    
    
    //elimina el usuario de la BDD
    public function borrar(){
        $user_table = Config::get()->db_user_table;
        $consulta = "DELETE FROM $user_table WHERE user='$this->user';";
        return Database::get()->query($consulta);
    }
}
?>