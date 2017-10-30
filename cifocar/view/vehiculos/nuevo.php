<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
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
			<h2>Formulario de registro</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				<label>Marca:</label>
				<select name="marca">
    			<?php        
					foreach($marcas as $marca){
					    echo "<option value='$marca->marca'>$marca->marca</option>";
					}
    			?>
    			</select><br/>
			
				<label>Matricula:</label>
				<input type="text" name="matricula" required="required" /><br/>
				
				<label>Modelo:</label>
				<input type="text" name="modelo" required="required" /><br/>
				
				<label>Color:</label>
				<input type="text" name="color" required="required"/><br/>
				
				<label>Precio venta:</label>
				<input type="text" name="precio_venta" required="required"/><br/>
				
				<label>Kms:</label>
				<input type="text" name="kms" required="required"/><br/>
				
				<label>Caballos:</label>
				<input type="text" name="caballos" required="required"/><br/>
				
				<label>Estado:</label>
				<input type="text" name="estado" required="required"/><br/>
				
				<label>Año matriculación:</label>
				<input type="text" name="any_matriculacion" required="required"/><br/>
				
				<label>Detalles:</label>
				<input type="text" name="detalles" required="required"/><br/>
				
				<label>Imagen:</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>" />		
				<input type="file" accept="image/*" name="imagen" />
				<span>max <?php echo intval($max_image_size/1024);?>kb</span><br />
				
				<input type="text" name="vendedor" required="required" /><br/>
				
				<input type="submit" name="guardar" value="Guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>
