
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Mysql REST API CRUD</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">PHP Mysql REST API CRUD</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Criar</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Cupom</th>
							<th>email</th>
							<th>Editar</th>
							<th>Apagar</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Adicionar</h4>
		      	</div>
		      	<div class="modal-body">
				  	<div class="form-group">
			        	<input type="hidden" name="id" id="id" class="form-control" />
			        </div>  
		      		<div class="form-group">
			        	<label>Cupom</label>
			        	<input type="text" name="cupom" id="cupom" class="form-control" value="<?php 
							$Year = date("Y"); 
							$number = 2;

							function soma($number){
								return $number+1;
							}
							
							foreach (range(0, 0) as $number) {
								$number = soma($number);
								$result = $Year."EMBAIXADOR".sprintf("%03s",$number++);          //adiciona zeros à esquerda
								echo $result;
							}  ?>" />	
			        </div><br>
					<div class="form-group">
						<label>email</label>
			        	<input type="text" name="email" id="email" class="form-control" required/>
			        </div><br>
					<!-- <label>Utilizado?</label>
					<div class="form-check">
            			<input class="form-check-input" type="radio" name="utilizado" id="red_status" value="">
            			<label for="exempleRadios1">Sim</label>
          			</div>
					  <div class="form-check">
            			<input class="form-check-input" type="radio" name="utilizado" id="red_status" value="" checked>
            			<label for="exempleRadios1">Não</label>
          			</div>   -->
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="enviar" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="enviar" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();

	function fetch_data()
	{
		$.ajax({
			url:"fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('enviar');
		$('#button_action').val('enviar');
		$('.modal-title').text('Add Data');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#cupom').val() == '')
		{
			alert("Enter First Name");
		}
		else if($('#cupom').val() == '')
		{
			alert("Enter Last Name");
		} 
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'enviar')
					{
						alert("O cupom de desconto foi salvo com sucesso!");
					}
					if(data == 'atualizar')
					{
						alert("O cupom foi atualizado.");
					}
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(id);
				$('#id').val(data.id);
				$('#cupom').val(data.cupom);
				$('#email').val(data.email);
				$('#action').val('atualizar');
				$('#button_action').val('atualizar');
				$('.modal-title').text('Atualizar cupom');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Tem certeza que quer apagar esse cupom?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("O cupom foi apagado com sucesso.");
				}
			});
		}
	});

});
</script>