<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$ureg = strip_tags($_POST['txt_ureg']);

	if($uname=="")	{
		$error[] = "Cadastre um nome de usuário!";
	}
	else if($umail=="")	{
		$error[] = "Cadastre um email único!";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Por favor cadastre um email válido!';
	}
	else if($upass=="")	{
		$error[] = "Cadastre uma senha";
	}
	else if(strlen($upass) < 6){
		$error[] = "Sua senha deve ter pelo menos seis caracteres";
	}
	else if($ureg=="")	{
		$error[] = "Cadastre uma matrícula";
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email, user_registration FROM users WHERE user_name=:uname OR user_email=:umail OR user_registration=:ureg");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail, ':ureg'=>$ureg));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['user_name']==$uname) {
				$error[] = "Desculpe, esse nome já cadastrado";
			}
			else if($row['user_email']==$umail) {
				$error[] = "Desculpe, email já cadastrado";
			}
			else if($row['user_registration']==$ureg) {
				$error[] = "Desculpe, matrícula já cadastrada";
			}
			else
			{
				if($user->register($uname,$umail,$upass,$ureg)){
					$user->redirect('sign-up.php?joined');
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
<title>Cadastro</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">

        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Cadastro de Usuário</h2><hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Cadastro realizado com sucesso <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Nome de Usuário" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Email" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Senha" />
            </div>
						<div class="form-group">
						<input type="text" class="form-control" name="txt_ureg" placeholder="Matrícula" value="<?php if(isset($error)){echo $ureg;}?>" />
						</div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;CADASTRAR
                </button>
            </div>
            <br />
            <label>Já possui cadastro? <a href="index.php">Entrar</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>
