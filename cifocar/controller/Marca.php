<?php
//CONTROLADOR USUARIO
// implementa las operaciones que puede realizar el usuario
class Marca extends Controller{
    
    //PROCEDIMIENTO PARA REGISTRAR UN USUARIO
    public function nuevo(){
        
//         if(!Login::getUsuario())
//             throw new Exception('Debes estar identificado.');
        
        //si no llegan los datos a guardar
        if(empty($_POST['guardar'])){
            
            //mostramos la vista del formulario
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $this->load_view('view/marcas/nuevo.php', $datos);
            
            //si llegan los datos por POST
        }else{
            //crear una instancia de Marca
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
    
    //PROCEDIMIENTO PARA MODIFICAR UN USUARIO
    public function editar($marca){
        //si no hay usuario identificado... error
        //if(!Login::getUsuario())
        //    throw new Exception('Debes estar identificado.');
            
            //si no llegan los datos a modificar
            if(empty($_POST['modificar'])){
                
                //mostramos la vista del formulario
                $datos = array();
                $datos['usuario'] = Login::getUsuario();
                $datos['marca'] = $marca; 
                $this->load_view('view/marcas/modificacion.php', $datos);
                
                //si llegan los datos por POST
            }else{
                
              //  $vehiculo = new VehiculoModel();
              //crear una instancia de Marca
                $this->load('model/MarcaModel.php');
                $conexion = Database::get();
                
                $m = $conexion->real_escape_string($_POST['marca']);
               
                //modificar el usuario en BDD
                if(!MarcaModel::actualizar($m,$marca))
                    throw new Exception('No se pudo modificar');
                                                 
                //mostrar la vista de éxito
                $datos = array();
                $datos['usuario'] = Login::getUsuario();
                $datos['mensaje'] = 'Modificación OK';
                $this->load_view('view/exito.php', $datos);
            }
    }
    
    
    //PROCEDIMIENTO PARA DAR DE BAJA UN USUARIO
    //solicita confirmación
    public function borrar($marca){
        
       // if(!Login::getUsuario())
       //     throw new Exception('Debes estar identificado.');
        
        //si no nos están enviando la conformación de baja
        if(empty($_POST['confirmar'])){
            //carga el formulario de confirmación
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $datos['marca'] = $marca; 
            $this->load_view('view/marcas/baja.php', $datos);
            
            //si nos están enviando la confirmación de baja
        }else{
                $this->load('model/MarcaModel.php');
                //de borrar el usuario actual en la BDD
                if(!MarcaModel::borrar($marca))
                    throw new Exception('No se pudo dar de baja. Comprueba que no exista un vehículo con esta marca.');      
                        
                //mostrar la vista de éxito
                $datos = array();
                $datos['usuario'] = Login::getUsuario();
                $datos['mensaje'] = 'Eliminado OK';
                $this->load_view('view/exito.php', $datos);
        }
    }
    
   
    public function listar(){

        // if(!Login::getUsuario())
        //     throw new Exception('Debes estar identificado.');
        
        $this->load('model/MarcaModel.php');
        $marcas = MarcaModel::getMarcas();

        if(!$marcas)
           throw new Exception('No hay marcas');

        $datos = array();
        $datos['usuario'] = Login::getUsuario();
        $datos['marcas'] = $marcas;

        $this->load_view('view/marcas/lista.php', $datos);
    }
    
    
    
}
//  MarcaModel::actualizar('','');
?>
