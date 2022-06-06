<?php

//test_api.php

include('Api.php');

$api_object = new API();

if($_GET["action"] == 'fetch_all')
{
	$data = $api_object->fetch_all();
}

if($_GET["action"] == 'enviar')
{
	$data = $api_object->enviar();
}

if($_GET["action"] == 'fetch_single')
{
	$data = $api_object->fetch_single($_GET["id"]);
}

if($_GET["action"] == 'atualizar')
{
	$data = $api_object->atualizar();
}

if($_GET["action"] == 'delete')
{
	$data = $api_object->delete($_GET["id"]);
}

echo json_encode($data);

?>