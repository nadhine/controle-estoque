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
			$stmt->execute(array(':pname'=>$pname, ':pvalor'=>$pvalor, ':punit'=>$punit, ':pprovider'=>$pprovider));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			print($row['product_name']);
			if($row['product_name']==$pname){
				$error[] = "Desculpe, esse produto já foi cadastrado";
			}
			else{
				if($product->register($pname,$pvalor,$punit,$pprovider)){
						$product->redirect('newproduct.php?joined');
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Bem vindo, - <?php print($userRow['user_email']); ?></title>
</head>

<body>

  <div class="signin-form">

  <div class="container">

          <form method="post" class="form-signin">
              <h2 class="form-signin-heading">Novo Produto</h2><hr />
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
              	<input type="text" class="form-control" name="txt_punit" placeholder="Unidade" value="<?php if(isset($error)){echo $punit;}?>"/>
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
  </div>

</body>
