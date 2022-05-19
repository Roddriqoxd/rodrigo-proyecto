<?php

include "bd/BD.php";
header('Access-Control-Allow-Origin:*');

if($_SERVER['REQUEST_METHOD']=='GET')
{       //isset consulta si esta o no vacio el parametro
    if (isset($_GET['id'])) // si llega el id ingresa al if
    {
    $query="select * from elecciones where id=".$_GET['id'];
    $resultado=metodoGet($query);
    echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    //FETCH que iobtenga solo un registro
    }
    else
    {
        $query="select * from elecciones";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();

}
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
$partido=$_POST['partido'];
$presidente=$_POST['presidente'];
$vicepresidente=$_POST['vicepresidente'];
$query="insert into elecciones(partido, presidente, vicepresidente) values ('$partido', '$presidente', '$vicepresidente')";
$queryAutoIncrement="select MAX(id) as id from elecciones";
$resultado=metodoPost($query, $queryAutoIncrement);
echo json_encode($resultado);
header("HTTP/1.1 200 OK");
exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
$id=$_GET['id'];
$partido=$_POST['partido'];
$presidente=$_POST['presidente'];
$vicepresidente=$_POST['vicepresidente'];
$query="UPDATE elecciones SET partido='$partido',presidente='$presidente', vicepresidente='$vicepresidente' WHERE id='$id'";
$resultado=metodoPut($query);
echo json_encode($resultado);
header("HTTP/1.1 200 OK");
exit();
}
if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
$id=$_GET['id'];
$query="DELETE FROM elecciones WHERE id='$id'";
$resultado=metodoDelete($query);
echo json_encode($resultado);
header("HTTP/1.1 200 OK");
exit();
}
header("HTT/1.1 400 Bad Request");

?>