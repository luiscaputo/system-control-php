<?php
require_once '../core/conn.php';
  if(isset($_POST['btn'])){
    $nome = filter_input(INPUT_POST, 'user_name');
    $email = filter_input(INPUT_POST, 'email');
    $senha = md5(filter_input(INPUT_POST, 'senha'));

    $find_email = $pdo->prepare("SELECT * FROM users WHERE email = '$email'");
    $find_email->execute();

    if($find_email->rowCount()>0){
      echo "<script>alert('Já existe um usuário com este email!')</script>";
    }
      else
      {
        $guarda = $pdo->prepare("INSERT INTO users(name, senha, email) values ('$nome', '$senha', '$email')");
        $guarda->execute();
        if($guarda->rowCount()>0){
          $v = $guarda->fetch();
          $id = $v['id'];
          $save_log = $pdo->prepare("INSERT INTO user_logs(id_user, logs_number) Values ('$id', '0')");
          
          echo "<script>alert('Cadastro Efectuado!')</script>";
        }
        else
          echo "<script>alert('Cadastro não efectuado, tente novamente!')</script>";
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/bootstrap.css">
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
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nome de usuário" required=""><br>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required=""><br>
              <input type="password" class="form-control" id="password" name="password" placeholder="Palavra Chave" required=""><br>
          <button class="btn btn-success form-control" name="btn">Cadastrar</button><br>
          <a href="../index.php">Se já tem conta, clica aqui!</a>
        </form>
      </div>
      <div class="col-sm">
      </div>
    </div>
  </div>
</body>
</html>