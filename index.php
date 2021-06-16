<?php
  require_once 'core/conn.php';
  if(isset($_POST['btn'])){
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password'); 

    $sql = $pdo->prepare("SELECT * FROM users WHERE email = '$email'");
    $sql->execute();
    if($sql->rowCount() > 0){
      $array = $sql->fetch();
      $passKey = $array['senha'];
      if($password != $passKey){
        echo "<script>alert('Senha Errada');</script>";
      }else
        {
          $id = $array['id'];
          $find = $pdo->prepare("SELECT * FROM users_acess WHERE id_user = '$id'");
          $find->execute();
            if($find->rowCount()>0){
              $find_logs = $pdo->prepare("SELECT * FROM user_logs WHERE id_user = '$id'");
              $find_logs->execute();
              $array_logs = $find_logs->fetch();
              $existent_logs = $array_logs['logs_number'];  
              $new_log = $existent_logs + 1;
              $save_news_logs = $pdo->prepare("UPDATE user_logs SET logs_number = '$new_log' WHERE id = '$id'");
              $save_news_logs->execute();
              session_start();
              $_SESSION['id_usuario'] = $id;
              header('location: pages/home.php');      
            }else{
              echo "<script>alert('Seu Cadastro foi efectuado mas ainda não tens acesso a HOME PAGE');</script>";
            }
        }
    }else
      {
        echo "<script>alert('Email não cadastrado');</script>";
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