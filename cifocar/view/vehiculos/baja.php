<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Baja de usuarios</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
			<h2>Formulario de baja de vehículo</h2>
			
			<form method="post" autocomplete="off">
			
				
				<span>Matricula:</span>
				<span><?php echo $vehiculo->matricula; ?></span><br/>
			
				<span>Marca:</span>
				<span><?php echo $vehiculo->marca; ?></span><br/>
				
				<span>Modelo:</span>
				<span><?php echo $vehiculo->modelo; ?></span><br/>
				
				<span>Color:</span>
				<span><?php echo $vehiculo->color; ?></span><br/>
				
				<span>Año matriculación:</span>
				<span><?php echo $vehiculo->any_matriculacion; ?></span><br/>
				
				<span>Imagen:</span>
				<span><?php echo $vehiculo->imagen; ?></span><br/>
				
				<input type="submit" name="confirmar" value="Confirmar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>

