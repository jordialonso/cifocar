<?php
//CONTROLADOR USUARIO
// implementa las operaciones que puede realizar el usuario
class Marcas extends Controller{
    
    //PROCEDIMIENTO PARA REGISTRAR UN USUARIO
    public function nuevo(){
        
//         if(!Login::getUsuario())
//             throw new Exception('Debes estar identificado.');
        
        //si no llegan los datos a guardar
        if(empty($_POST['guardar'])){
            
            //mostramos la vista del formulario
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            //$datos['max_image_size'] = Config::get()->image_max_size;
            $this->load_view('view/marcas/nuevo.php', $datos);
            
            //si llegan los datos por POST
        }else{
            //crear una instancia de Usuario
            $this->load('model/MarcaModel.php');
            $conexion = Database::get();
            
            //tomar los datos que vienen por POST
            //real_escape_string evita las SQL Injections
            $m = $conexion->real_escape_string($_POST['marca']);
            
            //guardar el usuario en BDD
            if(!MarcaModel::guardar($m))
                throw new Exception('No se pudo introducir la marca');
                
            //mostrar la vista de éxito
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $datos['mensaje'] = 'Operación de registro completada con éxito';
            $this->load_view('view/exito.php', $datos);
        }
    }
    HTMLENTITIES($DATOS) <SCRIPT> &FD
    
    //PROCEDIMIENTO PARA MODIFICAR UN USUARIO
    public function modificacion(){
        //si no hay usuario identificado... error
        if(!Login::getUsuario())
            throw new Exception('Debes estar identificado.');
            
            //si no llegan los datos a modificar
            if(empty($_POST['modificar'])){
                
                //mostramos la vista del formulario
                $datos = array();
                $datos['usuario'] = Login::getUsuario();
                $datos['max_image_size'] = Config::get()->image_max_size;
                $this->load_view('view/marcas/modificacion.php', $datos);
                
                //si llegan los datos por POST
            }else{
                
                $vehiculo = new VehiculoModel();
                
                //TRATAMIENTO DE LA NUEVA IMAGEN DE PERFIL (si se indicó)
                if($_FILES['imagen']['error']!=4){
                    //el directorio y el tam_maximo se configuran en el fichero config.php
                    $dir = Config::get()->vehiculo_image_directory;
                    $tam = Config::get()->image_max_size;
                    
                    //prepara la carga de nueva imagen
                    $upload = new Upload($_FILES['imagen'], $dir, $tam);
                    
                    //guarda la imagen antigua en una var para borrarla
                    //después si todo ha funcionado correctamente
                    $old_img = $vehiculo->imagen;
                    
                    //sube la nueva imagen
                    $vehiculo->imagen = $upload->upload_image();
                }
                
                //modificar el usuario en BDD
                if(!$vehiculo->actualizar())
                    throw new Exception('No se pudo modificar');
                            
                //borrado de la imagen antigua (si se cambió)
                //hay que evitar que se borre la imagen por defecto
                if(!empty($old_img) && $old_img!= Config::get()->default_vehiculo_image)
                    @unlink($old_img);
                    
                                                 
                //mostrar la vista de éxito
                $datos = array();
                $datos['usuario'] = Login::getUsuario();
                $datos['mensaje'] = 'Modificación OK';
                $this->load_view('view/exito.php', $datos);
            }
    }
    
    
    //PROCEDIMIENTO PARA DAR DE BAJA UN USUARIO
    //solicita confirmación
    public function borrar(){
        
        if(!Login::getUsuario())
            throw new Exception('Debes estar identificado.');
        
        //si no nos están enviando la conformación de baja
        if(empty($_POST['confirmar'])){
            //carga el formulario de confirmación
            $datos = array();
            $datos['usuario'] = $u;
            $this->load_view('view/vehiculos/borrar.php', $datos);
            
            //si nos están enviando la confirmación de baja
        }else{
                
                //de borrar el usuario actual en la BDD
                if(!$u->borrar())
                    throw new Exception('No se pudo dar de baja');
                    
                    //borra la imagen (solamente en caso que no sea imagen por defecto)
                    if($u->imagen!=Config::get()->default_user_image)
                        @unlink($u->imagen);
                        
                        //cierra la sesion
                        Login::log_out();
                        
                        //mostrar la vista de éxito
                        $datos = array();
                        $datos['usuario'] = null;
                        $datos['mensaje'] = 'Eliminado OK';
                        $this->load_view('view/exito.php', $datos);
        }
    }
    
}
//  MarcaModel::actualizar('','');
?>
