<?php
include 'action.php';
include 'comments.inc.php';
error_reporting(E_ALL & ~E_NOTICE);
?>
<html>
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 mt-3 bg-info p-4 rounded">
          <h2 class="bg-light p-2 rounded text-center text-dark"><?= $vid ?></h2>
          <div class="text-center">
            <img src="<?= $vphoto; ?>" width="300" class="img-thumbnail">
          </div>
          <h4 class="text-light">Название: <?= $vname; ?></h4>
          <h4 class="text-light">Время: <?= date('d M Y H:i',strtotime($vpublication)); ?></h4>
          <h4 class="text-light">Описание: <?= $vdescription; ?></h4>
          <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
          <script src="https://yastatic.net/share2/share.js"></script>
          <div class="mt-3 ya-share2" data-services="vkontakte,facebook,odnoklassniki"></div>
          <?php
              echo "<form method='post' action='".setComments($conn, $vid)."'>
                      <input class='w-100 mt-5 mb-2' type='text' name='uid' placeholder='Введите имя' required><br>
                      <textarea class='w-100 mb-2' name='message'></textarea><br>
                      <div class='g-recaptcha' data-sitekey='6LdgIa8UAAAAAH1S8DbBNw2XV9OPIZjvFjps1XVd'></div>
                      <button type='submit' name='commentSubmit'>Comment</button>
                    </form>";
              if(isset($_POST['commentSubmit']) && $Failed_verification){
                echo "<h4 style='color:red'>Verification failed!</h4>";
              }
              getComments($conn, $vid);
           ?>
        </div>
      </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </body>
</html>
