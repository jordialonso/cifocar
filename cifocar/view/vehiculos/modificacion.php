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
			
			<h2>Formulario de modificación de datos</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				<figure>
					<img class="imagenactual" src="<?php echo $vehiculo->imagen;?>" 
						alt="<?php echo $vehiculo->imagen; ?>" />
				</figure>
				<input type="hidden" name="id" value="<?php echo $vehiculo->id;?>" />
				
				<label>Marca:</label>
				<select name="marca"> 
				<?php       
					foreach($marcas as $marca){
					    if ($marca->marca != $vehiculo->marca) 
					       echo "<option value='<?php echo $marca->marca; ?>' >$marca->marca</option>";
					    else
					        echo "<option value='<?php echo $marca->marca; ?>' selected='selected'>$marca->marca</option>";
					}
				?>	 
				</select><br/>
				
				<label>Matricula:</label>
				<input type="text" name="matricula" required="required" 
					value="<?php echo $vehiculo->matricula;?>" /><br/>	
				
				<label>Modelo:</label>
				<input type="text" name="modelo" required="required" 
					value="<?php echo $vehiculo->modelo;?>" /><br/>
					
				<label>Color:</label>
				<input type="text" name="color" required="required" 
					value="<?php echo $vehiculo->color;?>" /><br/>	
				
				<label>Precio venta:</label>
				<input type="text" name="precio_venta" required="required" 
					value="<?php echo $vehiculo->precio_venta;?>"/><br/>
				
				<label>Kms:</label>
				<input type="text" name="kms" required="required" 
					value="<?php echo $vehiculo->kms;?>"/><br/>
				
				<label>Caballos:</label>
				<input type="text" name="caballos" required="required" 
					value="<?php echo $vehiculo->caballos;?>" /><br/>
				
				<label>Estado:</label>
				<input type="text" name="estado" required="required" 
					value="<?php echo $vehiculo->estado;?>" /><br/>
				
				<label>Año matriculación:</label>
				<input type="text" name="any_matriculacion" required="required" 
					value="<?php echo $vehiculo->any_matriculacion;?>" /><br/>
				
				<label>Detalles:</label>
				<input type="text" name="detalles" required="required" 
					value="<?php echo $vehiculo->detalles;?>" /><br/>
				
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