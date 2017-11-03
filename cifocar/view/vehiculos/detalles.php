<?php if(empty ($GLOBALS['index_access'])) die('no se puede acceder directamente a una vista.'); ?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<title>Modificación de datos de marcas</title>
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
	<figure class="imagen">
        <?php
        echo "<img src='$vehiculo->imagen' alt='Imatge de $vehiculo->modelo' title='Imatge de $vehiculo->modelo' />";
        ?>
    </figure>    
	<h2>Detalles del vehículo <?php echo $vehiculo->modelo;?></h2>
            
    <label>Marca:</label>
    <?php echo $vehiculo->marca;?><br/>

	<label>Matricula:</label>
	<?php echo $vehiculo->matricula;?><br/>
	
	<label>Modelo:</label>
	<?php echo $vehiculo->modelo;?><br/>
	
	<label>Color:</label>
	<?php echo $vehiculo->color;?><br/>
	
	<label>Precio venta:</label>
	<?php echo $vehiculo->precio_venta;?><br/>
	
	<label>Kms:</label>
	<?php echo $vehiculo->kms;?><br/>
	
	<label>Caballos:</label>
	<?php echo $vehiculo->caballos;?><br/>
	
	<label>Estado:</label>
	<?php 
	   switch($vehiculo->estado){
	       case 0: echo 'En venda';break;
	       case 1: echo 'Reservado';break;
	       case 2: echo 'Vendido';break;
	       case 3: echo 'Devolución';break;
	       case 4: echo 'Baja';break;
	   }
	?><br/>
	
	<label>Año matriculación:</label>
	<?php echo $vehiculo->any_matriculacion;?><br/>
	
	<label>Detalles:</label>
	<?php echo $vehiculo->detalles;?><br/>
				
</section>

		<?php Template::footer();?>
    </body>
</html>
