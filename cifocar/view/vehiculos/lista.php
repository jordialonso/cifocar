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
    			div.innerHTML = '<img class="imagenGrande" src="'+imagen.src+'" /><img class="cerrar" src="images/cerrar.jpg" onclick="cerrarImagen()"/>';
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

<p>Hay <?php echo $totalRegistros; ?> registros<?php echo $filtro? ' para el filtro indicado':'';?>.</p>
   <!--  <p>Mostrando del <?php echo ($paginaActual-1)*$regPorPagina+1;?> al <?php echo ($paginaActual)*$regPorPagina;?>.</p> -->


<?php if (!$filtro){ ?>
	<form method="post" class="filtro" action="index.php?controlador=Vehiculo&operacion=listar&parametro=1">
       <label>Filtro:</label>
       <input type="text" name="texto" placeholder="buscar..."/>
       <select name="campo">
           <option value="marca">Marca</option>
           <option value="modelo">Modelo</option>
           <option value="matricula">Matricula</option>
           <option value="estado">Estado</option>
           <option value="color">Color</option>
       </select>
       <label>Orden:</label>
       <select name="campoOrden">
           <option value="any_matriculacion">Año matriculación</option>
           <option value="caballos">Caballos</option>
           <option value="kms">Kms</option>
       </select>
       <select name="sentidoOrden">
           <option value="ASC">ascendent</option>
           <option value="DESC">descendent</option>
       </select>
       <input type="submit" name="filtrar" value="Filtrar"/>
	</form>
	<?php }else{ ?>
	<form method="post" class="filtro" action="index.php?controlador=Vehiculo&operacion=listar&parametro=1">
		<input type="submit" name="treureFiltre" value="Ocultar filtre"/>
	</form>
	<?php } ?>
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
	<td><?php  
	switch($vehiculo->estado){
				        case 0: echo 'En venda';break;
				        case 1: echo 'Reservado';break;
				        case 2: echo 'Vendido';break;
				        case 3: echo 'Devolución';break;
				        case 4: echo 'Baja';break;
	}			    
	?></td>
	<td><?php echo $vehiculo->any_matriculacion; ?></td>
	
<?php
echo '<td><a href="index.php?controlador=Vehiculo&operacion=ver&parametro='.$vehiculo->id.'"><img class="boton" src="images/buttons/view.png" alt="ver detalles" title="ver detalles" /></a></td>';
    echo '<td><a href="index.php?controlador=Vehiculo&operacion=editar&parametro='.$vehiculo->id.'"><img class="boton" src="images/buttons/edit.png" alt="modificar" title="modificar" /></a></td>';
    if($usuario && $usuario->admin)
        echo '<td><a href="index.php?controlador=Vehiculo&operacion=borrar&parametro='.$vehiculo->id.'"><img class="boton" src="images/buttons/delete.png" alt="borrar" title="borrar" /></a></td>';
}
?>	
	</tr>
	</table>
	<p>Viendo la página <?php echo $paginaActual.' de '.$paginas; ?> páginas de resultados</p>
            <ul class="paginacion">
                <?php
                    //poner enlace a la página anterior
                    if($paginaActual>1){
                        echo "<li><a href='index.php?controlador=Vehiculo&operacion=listar&parametro=1'>Primera</a></li>";
                    }
                
                    //poner enlace a la página anterior
                    if($paginaActual>2){
                        echo "<li><a href='index.php?controlador=Vehiculo&operacion=listar&parametro=".($paginaActual-1)."'>Anterior</a></li>";
                    }
                    //poner enlace a la página siguiente
                    if($paginaActual<$paginas-1){
                        echo "<li><a href='index.php?controlador=Vehiculo&operacion=listar&parametro=".($paginaActual+1)."'>Siguiente</a></li>";
                    }
                    
                    //Poner enlace a la última página
                    if($paginas>1 && $paginaActual<$paginas){
                        echo "<li><a href='index.php?controlador=Vehiculo&operacion=listar&parametro=$paginas'>Ultima</a></li>";
                    }
                ?>
            </ul>
	

</section>
<div id="imagenGrande">
</div>	
		<?php Template::footer();?>
    </body>
</html>

