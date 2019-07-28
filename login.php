<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>


  <div class="container">
    <form class="form-signin" method="post">
      <h2>Login</h2>

      <input type="text" name="username" class="form-control" placeholder="Username" required>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      <a href="index.php" class="btn btn-lg btn-primary btn-block">Registration</a>
    </form>
  </div>
  <?php
    session_start();
    require('connect.php');
    if(isset($_POST['username']) and isset($_POST['password'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $query = "SELECT * FROM users WHERE username='$username' and password='$password'";
      $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
      $count = mysqli_num_rows($result);
      if ($count == 1){
        $_SESSION['username'] = $username;
      } else {
        $fmsg = "Ошибка";
      }
    }
    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      echo "Hello ".$username." ";
      echo "Вы вошли";
      echo "<a href='logout.php' class='btn btn-lg btn-primary'>Logout</a>";
    }
  ?>
</body>
</html>
