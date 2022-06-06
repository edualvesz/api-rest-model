<?php


class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=integra_moodle_tray", "root", "");
	}

	function fetch_all()
	{
		$Year = date("Y"); 
		//$query = "SELECT * FROM cupom_embaixador ORDER BY id_cupom DESC";
		$query = "SELECT * FROM cupom_embaixador WHERE ano_referencia = ".$Year." ORDER BY id_cupom DESC limit 1;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}


	function enviar()
	{
		if(isset($_POST["email"]))
		{	
			$buscaultimo = $this->fetch_all();

			$cupom = $buscaultimo[0]['cupom'];
			$ultimas = (int)substr($cupom, -3);                  //isola os tres ultimos caracteres para depois somar mais um
			$cupom = $ultimas+1;
			//return $cupom;
			$Year = date("Y");
			$cupom = $Year.'EMBAIXADOR'.sprintf("%03s",$cupom);
			$email = $_POST['email'];
			$form_data = array(
			':_cupom' => $cupom,
			);
			$query = "
			INSERT INTO cupom_embaixador (cupom, ano_referencia, email) VALUES (:_cupom, '$Year', '$email')";
			$statement = $this->connect->prepare($query);
			//$query->bindValue(':_cupom', $cupom, PDO::PARAM_STR);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'cupom'	=>	$cupom
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'erro'	=>	'Parametro invalido'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM cupom_embaixador WHERE id_cupom='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['id_cupom'] = $row['id_cupom'];
				$data['cupom'] = $row['cupom'];
				$data['email'] = $row['email'];
			}
			return $data;
		}
	}

	function atualizar()
	{
		if(isset($_POST["cupom"]))
		{
			$form_data = array(
				':_id'			=>	$_POST['id'],
				':_cupom'	=>	$_POST['cupom'],
				':_email'	=>	$_POST['email'],
			);
			$query = "
			UPDATE cupom_embaixador SET cupom = :_cupom, email = :_email WHERE id_cupom = :_id";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM cupom_embaixador WHERE id_cupom = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>