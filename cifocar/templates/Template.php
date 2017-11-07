<?php
	class Template{	
		
		//PONE EL HEADER DE LA PAGINA
		public static function header(){	?>
			<header>
				<figure>
					<a href="index.php">
						<img alt="Robs Micro Framework logo" src="images/logos/logo.png" />
					</a>
				</figure>
				<hgroup>
					<h1>CIFOCAR</h1>
				</hgroup>
			</header>
		<?php }
		
		
		//PONE EL FORMULARIO DE LOGIN
		public static function login(){?>
			<form method="post" id="login" autocomplete="off">
				<input type="text" placeholder="usuario" name="user" required="required" />
				<input type="password" placeholder="clave" name="password" required="required"/>
				<input type="submit" name="login" value="Login" />
			</form>
		<?php }
		
		
		//PONE LA INFO DEL USUARIO IDENTIFICADO Y EL FORMULARIOD E LOGOUT
		public static function logout($usuario){	?>
			<div id="logout">
				<span>
					Hola 
					<a href="index.php?controlador=Usuario&operacion=modificacion" title="modificar datos">
						<?php echo $usuario->nombre;?>
					</a>
					<?php 					           
			              switch ($usuario->privilegio){
			                    case 0: echo ', eres administrador';
			                            break;
			                    case 1: echo ', eres comprador';
			                            if($usuario->admin) echo ' (admin)';
			                            break;
			                    case 2: echo ', eres vendedor';
			                            if($usuario->admin) echo ' (admin)';
			                            break;
			              }
					?>
				</span>
								
				<form method="post">
					<input type="submit" name="logout" value="Logout" />
				</form>
			</div>
		<?php }
		
		
		//PONE EL MENU DE LA PAGINA
		public static function menu($usuario){ 
		    ?>
			<nav>
				<?php if ($usuario && $usuario->privilegio==1){?>
				<ul class="menu">
					<li><a href="index.php">Inicio</a></li>
					<li><a href="index.php?controlador=Vehiculo&operacion=nuevo">Nuevo Vehículo</a></li>
					<li><a href="index.php?controlador=Vehiculo&operacion=listar">Listar Vehículo</a></li>
					<li><a href="index.php?controlador=Marca&operacion=nuevo">Nueva marca</a></li>
					<li><a href="index.php?controlador=Marca&operacion=listar">Listar marca</a></li>
				</ul>
				<?php } ?>
				<?php if ($usuario && $usuario->privilegio==2){?>
				<ul class="menu">
					<li><a href="index.php?controlador=Vehiculo&operacion=listar">Listar Vehículo</a></li>
				</ul>
				<?php } ?>
				<?php if($usuario && $usuario->admin){	?>
				<ul class="menu">
					<li><a href="index.php?controlador=Vehiculo&operacion=listar">Listar Vehículo</a></li>
					<li><a href="index.php?controlador=Usuario&operacion=registro">Registro</a></li>
					<li><a href="index.php?controlador=Usuario&operacion=listar">Listar Usuarios</a></li>
				</ul>
				<?php } ?>
			</nav>
		<?php }
		
		//PONE EL PIE DE PAGINA
		public static function footer(){	?>
			<footer>
				<p> 
					<a href="https://www.facebook.com/cifovalles">CIFO del Vallès 2017</a>. 
         		</p>
			</footer>
		<?php }
	}
?>