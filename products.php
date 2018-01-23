<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>

<body>
<div class="signin-form">
	<script>function Mudarestado(el) {
	  var display = document.getElementById(el).style.display;
	  if (display == "none")
	    document.getElementById(el).style.display = 'block';
	  else
	    document.getElementById(el).style.display = 'none';
		}
	</script>

  <button type="submit" class="btn btn-primary" name="btn-signup" onclick="Mudarestado('novoproduto')" href="#novoproduto">
      <i class="glyphicon glyphicon-open-file"></i>&nbsp;Novo Produto
  </button>

  <div class="tab-pane active" id="novoproduto" style="display:none">
      <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="newproduct.php" allowfullscreen></iframe>
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
