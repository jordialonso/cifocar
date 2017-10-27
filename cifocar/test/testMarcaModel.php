<?php
    require '../../config/Config.php';
    require '../../libraries/database_library.php'; 
    require '../MarcaModel.php'; 

//MarcaModel::guardar('Toyota');

$marcas = MarcaModel::getMarcas(10,0,'to','ASC');

foreach($marcas as $m){
    echo "<p>$m->marca</p>";
}

MarcaModel::actualizar('','');