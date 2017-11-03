<?php
//CONTROLADOR USUARIO
// implementa las operaciones que puede realizar el usuario
class Vehiculo extends Controller{
    
    //PROCEDIMIENTO PARA REGISTRAR UN USUARIO
    public function nuevo(){
        
//         if(!Login::getUsuario())
//             throw new Exception('Debes estar identificado.');
        
        //si no llegan los datos a guardar
        if(empty($_POST['guardar'])){
            
            //mostramos la vista del formulario
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $datos['max_image_size'] = Config::get()->image_max_size;
     
            //mostrar todas las marcas
            $this->load('model/MarcaModel.php');
            $marcas = MarcaModel::getMarcas();
            $datos['marcas']=$marcas;
            
            $this->load_view('view/vehiculos/nuevo.php', $datos);
            
            //si llegan los datos por POST
        }else{
            //crear una instancia de Usuario
            $this->load('model/VehiculoModel.php');
            $vehiculo = new VehiculoModel();
            $conexion = Database::get();
            
            //tomar los datos que vienen por POST
            //real_escape_string evita las SQL Injections
            $vehiculo->matricula = $conexion->real_escape_string($_POST['matricula']);
            $vehiculo->modelo = $conexion->real_escape_string($_POST['modelo']);
            $vehiculo->color = $conexion->real_escape_string($_POST['color']);
            $vehiculo->precio_venta = $conexion->real_escape_string($_POST['precio_venta']);
            $vehiculo->kms = $conexion->real_escape_string($_POST['kms']);
            $vehiculo->caballos = $conexion->real_escape_string($_POST['caballos']);
            $vehiculo->estado = $conexion->real_escape_string($_POST['estado']);
            $vehiculo->any_matriculacion = $conexion->real_escape_string($_POST['any_matriculacion']);
            $vehiculo->detalles = $conexion->real_escape_string($_POST['detalles']);
            $vehiculo->imagen = Config::get()->default_vehiculo_image;
            $vehiculo->vendedor = $conexion->real_escape_string($_POST['vendedor']);
            $vehiculo->marca = $conexion->real_escape_string($_POST['marca']);
            
            
            //recuperar y guardar la imagen (solamente si ha sido enviada)
            if($_FILES['imagen']['error']!=4){
                //el directorio y el tam_maximo se configuran en el fichero config.php
                $dir = Config::get()->vehiculo_image_directory;
                $tam = Config::get()->image_max_size;
                
                $upload = new Upload($_FILES['imagen'], $dir, $tam);
                $vehiculo->imagen = $upload->upload_image();
            }
            
            //guardar el usuario en BDD
            if(!$vehiculo->guardar())
                throw new Exception('No se pudo introducir el vehículo');
                
            //mostrar la vista de éxito
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $datos['mensaje'] = 'Operación de registro completada con éxito';
            $this->load_view('view/exito.php', $datos);
        }
    }
    
    public function ver($id=0){
        
        if(!$id)
            throw new Exception('No se ha indicado la ID del vehículo');
            
            $this->load('model/VehiculoModel.php');
            $vehiculo = VehiculoModel::getVehiculo($id);
            
            if(!$vehiculo)
                throw new Exception('No existe el vehículo seleccionado');
                
                $datos = array();
                $datos['usuario'] = login::getUsuario();
                $datos['vehiculo'] = $vehiculo;
                $this->load_view('view/vehiculos/detalles.php', $datos);
    }
    
    //PROCEDIMIENTO PARA MODIFICAR UN USUARIO
    public function editar($id){
        //si no hay usuario identificado... error
        //if(!Login::getUsuario())
        //    throw new Exception('Debes estar identificado.');
        $this->load('model/VehiculoModel.php');
        $vehiculo = VehiculoModel::getVehiculo($id);
        
        //si no llegan los datos a modificar
        if(empty($_POST['modificar'])){
            
            //mostramos la vista del formulario
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $datos['vehiculo'] = $vehiculo;
            $datos['max_image_size'] = Config::get()->image_max_size;
            
            //mostrar todas las marcas
            $this->load('model/MarcaModel.php');
            $marcas = MarcaModel::getMarcas();
            $datos['marcas']=$marcas;
            
            $this->load_view('view/vehiculos/modificacion.php', $datos);
            
            //si llegan los datos por POST
        }else{
    
            $vehiculo = new VehiculoModel();
            $conexion = Database::get();
            $vehiculo->id = $conexion->real_escape_string($_POST['id']);
            $vehiculo->matricula = $conexion->real_escape_string($_POST['matricula']);
            echo 'Matricula después: '.$vehiculo->matricula;
            $vehiculo->modelo = $conexion->real_escape_string($_POST['modelo']);
            $vehiculo->color = $conexion->real_escape_string($_POST['color']);
            $vehiculo->precio_venta = $conexion->real_escape_string($_POST['precio_venta']);
            $vehiculo->kms = $conexion->real_escape_string($_POST['kms']);
            $vehiculo->caballos = $conexion->real_escape_string($_POST['caballos']);
            $vehiculo->estado = $conexion->real_escape_string($_POST['estado']);
            $vehiculo->any_matriculacion = $conexion->real_escape_string($_POST['any_matriculacion']);
            $vehiculo->detalles = $conexion->real_escape_string($_POST['detalles']);
            $vehiculo->imagen = Config::get()->default_vehiculo_image;
            //$vehiculo->vendedor = $conexion->real_escape_string($_POST['vendedor']);
            $vehiculo->marca = $conexion->real_escape_string($_POST['marca']);
            
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
    public function borrar($id=0){
      
        //if(!Login::getUsuario())
        //    throw new Exception('Debes estar identificado.');
        $this->load('model/VehiculoModel.php');
        $vehiculo = VehiculoModel::getVehiculo($id);
        
        //si no nos están enviando la conformación de baja
        if(empty($_POST['confirmar'])){
            //carga el formulario de confirmación
            $datos = array();
            $datos['usuario'] = Login::getUsuario();
            $datos['vehiculo'] = $vehiculo;
            $this->load_view('view/vehiculos/baja.php', $datos);
            
            //si nos están enviando la confirmación de baja
        }else{
            //$this->load('model/VehiculoModel.php');
               
                //de borrar el usuario actual en la BDD
                if(!$vehiculo->borrar())
                    throw new Exception('No se pudo dar de baja');           
                        
                //mostrar la vista de éxito
                $datos = array();
                $datos['usuario'] = Login::getUsuario();
                $datos['mensaje'] = 'Eliminado OK';
                $this->load_view('view/exito.php', $datos);
        }
    }
    
    public function listar($pagina){
        
        // if(!Login::getUsuario())
        //     throw new Exception('Debes estar identificado.');
        
        //si me piden APLICAR un filtro
        if(!empty($_POST['filtrar'])){
            //recupera el filtro a aplicar
            $f = new stdClass(); //filtro
            $f->texto = htmlspecialchars($_POST['texto']);
            $f->campo = htmlspecialchars($_POST['campo']);
            $f->campoOrden = htmlspecialchars($_POST['campoOrden']);
            $f->sentidoOrden = htmlspecialchars($_POST['sentidoOrden']);
            
            //guarda el filtro en un var de sesión
            $_SESSION['filtroRecetas'] = serialize($f);
        }
        
        //si me piden QUITAR un filtro
        if(!empty($_POST['treureFiltre']))
            unset($_SESSION['filtroRecetas']);
            
            
        //comprobar si hay filtro
        $filtro = empty($_SESSION['filtroRecetas'])? false : unserialize($_SESSION['filtroRecetas']);
        
        //para la paginación
        $num = 5; //numero de resultados por página
        $pagina = abs(intval($pagina)); //para evitar cosas raras por url
        $pagina = empty($pagina)? 1 : $pagina; //página a mostrar
        $offset = $num*($pagina-1); //offset
        
        $this->load('model/VehiculoModel.php');
        
        if(!$filtro){
            $vehiculos = VehiculoModel::getVehiculos($num, $offset);
            //total de registros (para paginación)
            $totalRegistros = VehiculoModel::getTotal();
            
        }else{
            //recupera las recetas con el filtro aplicado
            $vehiculos = VehiculoModel::getVehiculos($num, $offset, $filtro->campo, $filtro->texto, $filtro->campoOrden, $filtro->sentidoOrden);
            //total de registros (para paginación)
            $totalRegistros = VehiculoModel::getTotal($filtro->texto, $filtro->campo);
            
        }   
        
        if(!$vehiculos)
            throw new Exception('No hay vehículos');
            
        $datos = array();
        $datos['usuario'] = login::getUsuario();
        $datos['vehiculos'] = $vehiculos;
        $datos['filtro'] = $filtro;
        $datos['paginaActual'] = $pagina;
        $datos['paginas'] = ceil($totalRegistros/$num); //total de páginas (para paginación)
        $datos['totalRegistros'] = $totalRegistros;
        $datos['regPorPagina'] = $num;
        
        
        $this->load_view('view/vehiculos/lista.php', $datos);
    }
    
}
?>