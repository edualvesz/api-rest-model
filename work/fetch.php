<?php

//fetch.php

//error_reporting(E_ALL ^ E_NOTICE);

$api_url = "http://localhost/api_rest_modelo/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
//if (is_countable($result) && count($result) > 0) 
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->id_cupom.'</td>
			<td>'.$row->cupom.'</td>
			<td>'.$row->email.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_cupom.'">Editar</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_cupom.'">Apagar</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Nenhum resultado encontrado.</td>
	</tr>
	';
}

echo $output;

?>