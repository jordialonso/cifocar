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
<table>
		<tr>
			<th>Marca: </th>
     	</tr>
<?php 

foreach($marcas as $marca){
 ?>   
	<tr>
	<td><?php echo $marca->marca; ?></td>
<?php 
    echo '<td><a href="index.php?controlador=Marca&operacion=editar&parametro='.$marca->marca.'"><img class="boton" src="images/buttons/edit.png" alt="modificar" title="modificar" /></a></td>';
    echo '<td><a href="index.php?controlador=Marca&operacion=borrar&parametro='.$marca->marca.'"><img class="boton" src="images/buttons/delete.png" alt="borrar" title="borrar" /></a></td>';
}
?>	
	</tr>
	</table>


</section>
		
		<?php Template::footer();?>
    </body>
</html>
