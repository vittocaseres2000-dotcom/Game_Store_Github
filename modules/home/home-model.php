<?php
/*Trabajo_GrupalWeb/modules/home/home-model.php*/

function obtenerProductos($conn){

    $sql = "SELECT * FROM producto LIMIT 5";

    $resultado = mysqli_query($conn,$sql);

    return $resultado;

}
?>