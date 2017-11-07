<?php
	//CONTROLADOR USUARIO 
	// implementa las operaciones que puede realizar el usuario
	class Usuario extends Controller{

		//PROCEDIMIENTO PARA REGISTRAR UN USUARIO
		public function registro(){

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['max_image_size'] = Config::get()->user_image_max_size;
				$this->load_view('view/usuarios/registro.php', $datos);
			
			//si llegan los datos por POST
			}else{
				//crear una instancia de Usuario
				$u = new UsuarioModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$u->user = $conexion->real_escape_string($_POST['user']);
				$u->password = MD5($conexion->real_escape_string($_POST['password']));
				$u->nombre = $conexion->real_escape_string($_POST['nombre']);
				$u->privilegio = $conexion->real_escape_string($_POST['privilegio']);
				
				$u->admin = isset($_POST['admin'])? 1 : 0;
				$u->email = $conexion->real_escape_string($_POST['email']);
				$u->imagen = Config::get()->default_user_image;
				
				//recuperar y guardar la imagen (solamente si ha sido enviada)
				if($_FILES['imagen']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
					
					$upload = new Upload($_FILES['imagen'], $dir, $tam);
					$u->imagen = $upload->upload_image();
				}
								
				//guardar el usuario en BDD
				if(!$u->guardar())
					throw new Exception('No se pudo registrar el usuario');
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Operación de registro completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		

		//PROCEDIMIENTO PARA MODIFICAR UN USUARIO
		public function modificacion($user){
			//si no hay usuario identificado... error
			if(!$user){
    			if(!Login::getUsuario())
    				throw new Exception('Debes estar identificado para poder modificar tus datos');
    		}else{
    		    $u = Login::getUsuario();
    		    if ($u && $u->privilegio!=0)
    		        throw new Exception('Debes ser administrador');
    		}
			$this->load('model/UsuarioModel.php');
			$usuarioModificar = UsuarioModel::getUsuario($user);
			//si no llegan los datos a modificar
			if(empty($_POST['modificar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['max_image_size'] = Config::get()->user_image_max_size;
				$datos['usuarioModificar']=NULL;
				if($user){
				    //$this->load('model/UsuarioModel.php');
				    //$usuarioModificar = UsuarioModel::getUsuario($user);
				    $datos['usuarioModificar'] = $usuarioModificar;
				    $this->load_view('view/usuarios/modificacion_admin.php', $datos);
				}else{    
				    $this->load_view('view/usuarios/modificacion.php', $datos);
			    }	
			//si llegan los datos por POST
			}else{
				//recuperar los datos actuales del usuario
				$u = Login::getUsuario();
				$conexion = Database::get();
				
				if(!$user){
        			//comprueba que el usuario se valide correctamente
        			$p = MD5($conexion->real_escape_string($_POST['password']));
        			if($u->password != $p)
        				throw new Exception('El password no coincide, no se puede procesar la modificación');
        							
        			//recupera el nuevo password (si se desea cambiar)
        			if(!empty($_POST['newpassword']))
        				$u->password = MD5($conexion->real_escape_string($_POST['newpassword']));
        		}
        		
        		
        		if(!$user){
        		    $u->user = $conexion->real_escape_string($_POST['user']);
        		    $u->nombre = $conexion->real_escape_string($_POST['nombre']);
        		    $u->email = $conexion->real_escape_string($_POST['email']);
        		    $u->imagen = $conexion->real_escape_string($_POST['imagen']);
        		}else{
        		    $u1 = new UsuarioModel();
        		    $conexion = Database::get();
        		    $u1->password = $usuarioModificar->password;
        		    $u1->user = $conexion->real_escape_string($_POST['user']);
        		    $u1->nombre = $conexion->real_escape_string($_POST['nombre']);
        		    $u1->email = $conexion->real_escape_string($_POST['email']);
        		    $u1->imagen = $conexion->real_escape_string($_POST['imagen']);
        		}
        		
				//TRATAMIENTO DE LA NUEVA IMAGEN DE PERFIL (si se indicó)
				if($_FILES['imagen']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
					
					//prepara la carga de nueva imagen
					$upload = new Upload($_FILES['imagen'], $dir, $tam);
					
					//guarda la imagen antigua en una var para borrarla 
					//después si todo ha funcionado correctamente
					if(!$user){
					    $old_img = $u->imagen;
    					//sube la nueva imagen
    					$u->imagen = $upload->upload_image();
					}else{
					    $old_img = $u1->imagen;
					    $u1->imagen = $upload->upload_image();
					}	
				}
				if(!$user){
    				//modificar el usuario en BDD
    				if(!$u->actualizar())
    					throw new Exception('No se pudo modificar');
				}else{
				    if(!$u1->actualizar())
				        throw new Exception('No se pudo modificar');
				}	
		
				//borrado de la imagen antigua (si se cambió)
				//hay que evitar que se borre la imagen por defecto
				if(!empty($old_img) && $old_img!= Config::get()->default_user_image)
					@unlink($old_img);
				
				if(!$user){	
    				//hace de nuevo "login" para actualizar los datos del usuario
    				//desde la BDD a la variable de sesión.
    				Login::log_in($u->user, $u->password);
				}	
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Modificación OK';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		
		//PROCEDIMIENTO PARA DAR DE BAJA UN USUARIO
		//solicita confirmación
		public function baja($id){		
			//recuperar usuario
			$u = Login::getUsuario();
			
			if ($u && $u->privilegio!=0)
			    throw new Exception('Debes ser administrador');
			
			$this->load('model/UsuarioModel.php');
			//$usuarioBorrar = UsuarioModel::getUsuario($id);
			
			//de borrar el usuario actual en la BDD
			if(!UsuarioModel::borrar($id))
				throw new Exception('No se pudo dar de baja. Puede ser que tenga un vehículo asignado.');
					
			//borra la imagen (solamente en caso que no sea imagen por defecto)
			if($u->imagen!=Config::get()->default_user_image)
				@unlink($u->imagen); 
				
			//mostrar la vista de éxito
			$datos = array();
			$datos['usuario'] = $u;
			$datos['mensaje'] = 'Eliminado OK';
			$this->load_view('view/exito.php', $datos);
			
		}
		public function listar(){
		    
		    $usuario=Login::getUsuario();
		    
		    if ($usuario && $usuario->privilegio!=0)
		        throw new Exception('Debes ser administrador');
		        
		    $this->load('model/UsuarioModel.php');
		    $usuarios = UsuarioModel::getUsuarios();
		    
		    if(!$usuarios)
		        throw new Exception('No hay usuarios');
		        
		        $datos = array();
		        $datos['usuario'] = Login::getUsuario();
		        $datos['usuarios'] = $usuarios;
		        
		        $this->load_view('view/usuarios/lista.php', $datos);
		}
	}
?>