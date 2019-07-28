<?php
include 'action.php';
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
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <?php if(isset($_SESSION['response'])){ ?>
          <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b><?= $_SESSION['response']; ?></b>
          </div>
          <?php } unset($_SESSION['response']); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <h3 class="text-center text-info">Add Record</h3>
          <form action="action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-group">
              <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Введите заголовок" required>
            </div>
            <div class="form-group">
              <textarea name="description" class="form-control" placeholder="Введите описание"><?= $description; ?></textarea>
            </div>
            <div class="form-group">
              <input type="hidden" name="oldimage" value="<?= $photo; ?>">
              <input type="file" name="image" class="custom-file">
              <?php if($photo != ""){ ?>
                <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
              <?php } ?>
            </div>
            <div class="form-group">
              <?php if($update == true){ ?>
              <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
              <?php } else { ?>
                <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
              <?php } ?>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <?php
            $query = "SELECT * FROM crud";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

          ?>
          <h3 class="text-center text-info">Records Present In The Database</h3>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Фото</th>
                <th>Заголовок</th>
                <th>Описание</th>
                <th>Дата публикаци</th>
                <th>Количество комментариев</th>
                <th>Действие</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = $result->fetch_assoc()){ ?>
              <tr>
                <td><?= $row['id']; ?></td>
                <td><img src="<?= $row['photo']; ?>" width="25"></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= date('d M Y H:i',strtotime($row['publication'])); ?></td>
                <td><?= $row['comments']; ?></td>
                <td>
                  <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-2">Просмотр</a>
                  <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Вы хотите удалить эту запись?')">Удалить</a>
                  <a href="crud.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Редактировать</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
