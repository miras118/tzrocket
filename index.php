<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
    require('connect.php');
    if(isset($_POST['username']) && isset($_POST['password'])){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $query = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
      $result = mysqli_query($connection, $query);

      if($result){
        $smsg = "Регистрация прошла успешно";
      } else {
        $fsmsg= "Ошибка";
      }
    }
   ?>
  <div class="container">
    <form class="form-signin" method="post">
      <h2>Registration</h2>
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"><?php echo $smsg; ?></div><?php } ?>
      <?php if(isset($fsmsg)){ ?><div class="alert alert-danger" role="alert"><?php echo $fsmsg; ?></div><?php } ?>
      <input type="text" name="username" class="form-control" placeholder="Username" required>
      <input type="email" name="email" class="form-control" placeholder="Email" required>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      <a href="login.php" class="btn btn-lg btn-primary btn-block">Login</a>
    </form>
    <a href="crud.php">CRUD</a><br>
    <a href="front.php">Постраничный вывод</a>
  </div>
</body>
</html>
