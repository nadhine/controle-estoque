<?php
session_start();
require_once('class.provider.php');

$provider = new PROVIDER();

if(isset($_POST['btn-signup']))
{
	$vname = strip_tags($_POST['txt_vname']);
	$vcnpj = strip_tags($_POST['txt_vcnpj']);
	$vfdate = strip_tags($_POST['txt_vfdate']);
	$vldate = strip_tags($_POST['txt_vldate']);

	if($vname=="")	{
		$error[] = "Cadastre um nome do fornecedor";
	}
	else if($vcnpj=="")	{
		$error[] = "Cadastre um CNPJ!";
	}
	else if($vfdate=="")	{
	    $error[] = 'Cadastre uma data de inicio do contrato';
	}
	else if($vldate=="")	{
		$error[] = "Cadastre uma data de fim do contrato";
	}
	else
	{
		try
		{
			$stmt = $provider->runQuery("SELECT provider_name, provider_cnpj, provider_firstdate, provider_lastdate FROM providers WHERE provider_name=:vname OR provider_cnpj=:vcnpj");
			$stmt->execute(array(':vname'=>$vname, ':vcnpj'=>$vcnpj));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['provider_name']==$vname){
				$error[] = "Desculpe, esse fornecedor já foi cadastrado";
			}
      else if($row['provider_cnpj']==$vcnpj){
        $error[] = "Desculpe, esse fornecedor já foi cadastrado";
      }
			else{
				if($provider->register($vname,$vcnpj,$vfdate,$vldate)){
				}
			}

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>

<body>
	<div class="container">
	  <!-- Trigger the modal with a button -->
	  <button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-open-file"></i>&nbsp;Novo Fornecedor</button>
	  <!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->

	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h2 class="modal-title">Novo Fornecedor</h2>
	        </div>
	        <div class="modal-body">
						<form method="post">
												<?php
					  			if(isset($error))
					  			{
					  			 	foreach($error as $error)
					  			 	{
												?>
					                       <div class="alert alert-danger">
					                          <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
					                       </div>
																 <?php
					  				}
					  			}
					  			else if(isset($_GET['joined']))
					  			{
											?>
					                   <div class="alert alert-info">
					                        <i class="glyphicon glyphicon-log-in"></i> &nbsp; Cadastro realizado com sucesso <a href='index.php'>Voltar</a>
					                   </div>
														 <?php
					  			}
									?>
					              <div class="form-group">
					              <input type="text" class="form-control" name="txt_vname" placeholder="Nome do Fornecedores" value="<?php if(isset($error)){echo $vname;}?>" />
					              </div>
					              <div class="form-group">
					              <input type="text" class="form-control" name="txt_vcnpj" placeholder="CNPJ" value="<?php if(isset($error)){echo $vcnpj;}?>" />
					              </div>
					              <div class="form-group">
					              	<input type="date" class="form-control" name="txt_vfdate" placeholder="Data do Início do Contrato" value="<?php if(isset($error)){echo $vfdate;}?>"/>
					              </div>
					  						<div class="form-group">
					  						<input type="date" class="form-control" name="txt_vldate" placeholder="Data do Término do Contrato" value="<?php if(isset($error)){echo $vldate;}?>" />
					  						</div>
					              <div class="clearfix"></div><hr />
					              <div class="form-group">
					              	<button type="submit" class="btn btn-primary" name="btn-signup">
					                  	<i class="glyphicon glyphicon-open-file"></i>&nbsp;CADASTRAR
					                  </button>
					              </div>
					              <br />
					          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>

	    </div>
	  </div>

  <div class="tab-pane active">
    <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Fornecedor</th>
            <th scope="col">CNPJ</th>
            <th scope="col">Fim do Contrato</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Extra</td>
            <td>505154512152</td>
            <td>15/05/2019</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Boi Vivo</td>
            <td>340864786048478</td>
            <td>06/10/2020</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Vendinha</td>
            <td>7846746545564564</td>
            <td>11/05/2021</td>
          </tr>
        </tbody>
    	</table>
    </div>
  </div>
</body>
