<?php
session_start();
require_once('class.product.php');

$product = new PRODUCT();

if(isset($_POST['btn-signup']))
{
	$pname = strip_tags($_POST['txt_pname']);
	$pvalor = strip_tags($_POST['txt_pvalor']);
	$punit = strip_tags($_POST['txt_punit']);
	$pprovider = strip_tags($_POST['txt_pprovider']);

	if($pname=="")	{
		$error[] = "Cadastre uma descrição do produto";
	}
	else if($pvalor=="")	{
		$error[] = "Cadastre um preço!";
	}
	else if($punit=="")	{
	    $error[] = 'Por favor selecione uma unidade de medida';
	}
	else if($pprovider=="")	{
		$error[] = "Cadastre um fornecedor";
	}
	else
	{
		try
		{
			$stmt = $product->runQuery("SELECT product_name, product_valor, product_unit, product_provider FROM products WHERE product_name=:pname");
			$stmt->execute(array(':pname'=>$pname));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['product_name']==$pname){
				$error[] = "Desculpe, esse produto já foi cadastrado";
			}
			else{
				if($product->register($pname,$pvalor,$punit,$pprovider)){
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
	  <button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-open-file"></i>&nbsp;Novo Produto</button>
	  <!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->

	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h2 class="modal-title">Novo Produto</h2>
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
					              <input type="text" class="form-control" name="txt_pname" placeholder="Descrição do Produto" value="<?php if(isset($error)){echo $pname;}?>" />
					              </div>
					              <div class="form-group">
					              <input type="text" class="form-control" name="txt_pvalor" placeholder="Preço" value="<?php if(isset($error)){echo $pvalor;}?>" />
					              </div>
					              <div class="form-group">
												  <select class="form-control" id="sel1">
														<option name="unit" id="unit_1" value="Unidades">
															<label for="unit_1">Unidade</label>
														<option name="unit" id="unit_2" value="Caixas">
															<label for="unit_2">Caixa</label>
														<option name="unit" id="unit_3" value="Quilos">
															<label for="unit_3">Quilo</label>
														<option name="unit" id="unit_4" value="Gramas">
															<label for="unit_4">Grama</label>
														<option name="unit" id="unit_5" value="Litros">
															<label for="unit_5">Litro</label>
														<option name="unit" id="unit_6" value="Pacote 500g">
															<label for="unit_6">Pacote 500g</label>
														<option name="unit" id="unit_7" value="Maço">
															<label for="unit_7">Maço</label>
														<option name="unit" id="unit_8" value="Tablete">
															<label for="unit_8">Tablete</label>
														<option name="unit" id="unit_9" value="Pacote 100g">
															<label for="unit_9">Pacote 100g</label>
														<option name="unit" id="unit_10" value="Pacote 200g">
															<label for="unit_10">Pacote 200g</label>
														<option name="unit" id="unit_11" value="Pacote 250g">
															<label for="unit_11">Pacote 250g</label>
														<option name="unit" id="unit_12" value="Pacote 400g">
															<label for="unit_12">Pacote 400g</label>
														<option name="unit" id="unit_13" value="Pacote 300g">
															<label for="unit_13">Pacote 300g</label>
														<option name="unit" id="unit_14" value="Pacote 60g">
															<label for="unit_14">Pacote 60g</label>
												  </select>
					              </div>
					  						<div class="form-group">
					  						<input type="text" class="form-control" name="txt_pprovider" placeholder="Fornecedor" value="<?php if(isset($error)){echo $pprovider;}?>" />
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
            <th scope="col">Descrição</th>
            <th scope="col">Quantidade</th>
            <th scope="col">unidade</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Maça</td>
            <td>5</td>
            <td>unidades</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Carne Bovina</td>
            <td>3</td>
            <td>Quilos</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Uva</td>
            <td>7</td>
            <td>caixas</td>
          </tr>
        </tbody>
    	</table>
    </div>
  </div>
</body>
