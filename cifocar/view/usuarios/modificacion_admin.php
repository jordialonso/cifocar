<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Modificación de datos de usuario</title>
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
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja">
				<img src="images/buttons/delete.png" alt="darse de baja" class="logo" />
				Darse de baja
			</a>
			
			<h2>Formulario de modificación de datos</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="imagen" value="<?php echo $usuarioModificar->imagen;?>" />
				
				<figure>
					<img class="imagenactual" src="<?php echo $usuarioModificar->imagen; ?>" 
						alt="<?php echo $usuarioModificar->user;?>" />
				</figure>
				
				<label>User:</label>
				<input type="text" name="user" required="required" 
					readonly="readonly" value="<?php echo $usuarioModificar->user; ?>" /><br/>		
				
				<label>Nombre:</label>
				<input type="text" name="nombre" required="required" 
					value="<?php echo $usuarioModificar->nombre; ?>"/><br/>
				
				<label>Email:</label>
				<input type="email" name="email" required="required" 
					value="<?php echo $usuarioModificar->email;?>"/><br/>
				
				<label>Nueva imagen:</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>" />		
				<input type="file" accept="image/*" name="imagen" />
				<span class="mini">max <?php echo intval($max_image_size/1024);?>kb</span><br />
				
				<label></label>
				<input type="submit" name="modificar" value="Modificar"/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>