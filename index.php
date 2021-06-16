<?php
  require_once 'core/conn.php';
  if(isset($_POST['btn'])){
    $email = filter_input(INPUT_POST, 'email');
    $password = md5(filter_input(INPUT_POST, 'password'));

    $sql = $pdo->prepare("SELECT * FROM users WHERE email = '$email'");
    $sql->execute();
    if($sql->rowCount() > 0){
      $array = $sql->fetch();
      $password = $array['senha'];
      
    }

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/bootstrap.css">
  <title>login</title>
</head>
<body style="background-color:#30363d;">
  <div class="container mt-3 p-3">
    <div class="row">
      <div class="col-sm">

      </div>
      <div class="col-sm">
      <h4 style="color: white;">Sistema de Login - Prof.Pazito</h4><br>
        <form action="" method="post" class="">
              <input type="email" class="form-control" id="user_name" name="email" placeholder="Email" required=""><br>
              <input type="password" class="form-control" id="password" name="password" placeholder="Palavra Chave" required=""><br>
          <button class="btn btn-success form-control" name="btn">Entrar</button><br>
          <a href="pages/cadastro.php">Se não tem conta, clica aqui!</a>
        </form>
      </div>
      <div class="col-sm">
      </div>
    </div>
  </div>
</body>
</html>