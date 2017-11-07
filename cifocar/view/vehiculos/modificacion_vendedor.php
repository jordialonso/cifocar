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
				<?php echo $vehiculo->marca; ?><br/>	
				
				<label>Matricula:</label>
				<?php echo $vehiculo->matricula; ?><br/>	
				
				<label>Modelo:</label>
				<?php echo $vehiculo->modelo; ?><br/>
					
				<label>Color:</label>
				<?php echo $vehiculo->color; ?><br/>	
				
				<label>Precio venta:</label>
				<?php echo $vehiculo->precio_venta;?><br/>
				
				<label>Kms:</label>
				<?php echo $vehiculo->kms;?><br/>
				
				<label>Caballos:</label> 
				<?php echo $vehiculo->caballos;?><br/>
				
				<label>Estado:</label>
				<select name="estado">
				  	<option value="0" <?php if($vehiculo->estado==0) echo 'selected="selected"'; ?>>En venda</option>
					<option value="1" <?php if($vehiculo->estado==1) echo 'selected="selected"'; ?>>Reservado</option>
					<option value="2" <?php if($vehiculo->estado==2) echo 'selected="selected"'; ?>>Vendido</option>
					<option value="3" <?php if($vehiculo->estado==3) echo 'selected="selected"'; ?>>Devolución</option>
					<option value="4" <?php if($vehiculo->estado==4) echo 'selected="selected"'; ?>>Baja</option>
				</select><br/>
				
				<label>Año matriculación:</label>
				<?php echo $vehiculo->any_matriculacion;?><br/>
				
				<label>Detalles:</label>
				<?php echo $vehiculo->detalles;?><br/>
				
				<input type="submit" name="modificar" value="Modificar"/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>