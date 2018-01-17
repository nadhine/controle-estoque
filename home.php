<?php

	require_once("session.php");

	require_once("class.user.php");
	$auth_user = new USER();


	$user_id = $_SESSION['user_session'];

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

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

<nav class="navbar">
      <div class="tabbable">
          <ul class="nav nav-tabs">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="glyphicon glyphicon-user"></span>&nbsp;Olá,  <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Ver Perfil</a></li>
								<li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sair</a></li>
							</ul>
						</li>
            <li class="active"><a href="#produtos" data-toggle="tab">Produtos</a></li>
            <li><a href="#fornecedores" data-toggle="tab">Fornecedores</a></li>
            <li><a href="#movimentos" data-toggle="tab">Movimentações</a></li>
          </ul>
      </div>
</nav>

<div class="tab-content" style="margin-top:80px;">

    <div class="tab-pane active" id="produtos">
			<div class="embed-responsive embed-responsive-16by9">
			    <iframe class="embed-responsive-item" src="products.php" allowfullscreen></iframe>
			</div>
    </div>

		<div class="tab-pane" id="fornecedores">
			<div class="embed-responsive embed-responsive-16by9">
			    <iframe class="embed-responsive-item" src="newprovider.php" allowfullscreen></iframe>
			</div>
		</p>
		</div>

		<div class="tab-pane " id="movimentos">
			<div class="embed-responsive embed-responsive-16by9">
			    <iframe class="embed-responsive-item" src="newmovement.php" allowfullscreen></iframe>
			</div>
		</div>

</div>
<p class="blockquote-reverse" style="margin-top:200px;">
Programming Blog Featuring Tutorials on PHP, MySQL, Ajax, jQuery, Web Design and More...<br /><br />
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
