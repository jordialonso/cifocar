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
	<script>
        function basename(path) {
            return path.replace(/\\/g,'/').replace( /.*\//, '' );
        }
        function dirname(path) {
            return path.replace(/\\/g,'/').replace(/\/[^\/]*$/, '');;
        }
		function abrirImagen(imagen){
			
			if(basename(imagen.src)!='vehiculo.png'){
    			var div = document.getElementById('imagenGrande');
    			div.style.display = 'block';
    			div.innerHTML = '<img class="imagen" src="'+imagen.src+'" /><img class="cerrar" src="images/cerrar.jpg" onclick="cerrarImagen()"/>';
			}
		}
		
		function cerrarImagen(){
			var div = document.getElementById('imagenGrande');
			div.style.display = 'none';
		}
	</script>
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
<section id="content">
<table>
		<tr>
			<th>Imagen: </th>
			<th>Matrícula: </th>
			<th>Modelo: </th>
			<th>Color: </th>
			<th>Precio venta: </th>
			<th>Kms: </th>
			<th>Caballos: </th>
			<th>Estado: </th>
			<th>Año matric.: </th>
			<th>Detalles: </th>
     	</tr>
<?php 

foreach($vehiculos as $vehiculo){
 ?>   
	<tr>
	<td><?php echo "<img class='miniatura' src='$vehiculo->imagen' onclick='abrirImagen(this)' />"; ?></td>
	<td><?php echo $vehiculo->matricula; ?></td>
	<td><?php echo $vehiculo->modelo; ?></td>
	<td><?php echo $vehiculo->color; ?></td>
	<td><?php echo $vehiculo->precio_venta; ?></td>
	<td><?php echo $vehiculo->kms; ?></td>
	<td><?php echo $vehiculo->caballos; ?></td>
	<td><?php echo $vehiculo->estado; ?></td>
	<td><?php echo $vehiculo->any_matriculacion; ?></td>
	<td><?php echo $vehiculo->detalles; ?></td>
	
<?php
    echo '<td><a href="index.php?controlador=Vehiculo&operacion=editar&parametro='.$vehiculo->id.'"><img class="boton" src="images/buttons/edit.png" alt="modificar" title="modificar" /></a></td>';
    if($usuario && $usuario->admin)
        echo '<td><a href="index.php?controlador=Vehiculo&operacion=borrar&parametro='.$vehiculo->id.'"><img class="boton" src="images/buttons/delete.png" alt="borrar" title="borrar" /></a></td>';
}
?>	
	</tr>
	</table>


</section>
<div id="imagenGrande">
</div>	
		<?php Template::footer();?>
    </body>
</html>

