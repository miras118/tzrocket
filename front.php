<html>
<head>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
  <?php
      require_once 'connect.php';
      require_once 'functions.php';
      $posts = get_posts();

      $results_per_page = 1;
      $sql2 = "SELECT * FROM crud";
      $result2 = mysqli_query($connection,$sql2);
      $number_of_results = mysqli_num_rows($result2);
      $number_of_pages = ceil($number_of_results/$results_per_page);

      if(!isset($_GET['page'])){
        $page = 1;
      } else {
        $page = $_GET['page'];
      }

      $this_page_first_result = ($page-1)*$results_per_page;
      $sql3 = "SELECT * FROM crud LIMIT ".$this_page_first_result.','.$results_per_page;
      $result3 = mysqli_query($connection,$sql3);
   ?>
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="page-header">
        <h1>Все записи:</h1>
        <div class="container">
          <?php while($row = mysqli_fetch_array($result3)){ ?>
          <div class="well">
              <div class="media">
              	<a class="pull-left" href="#">
            		<img style="width:150px" class="media-object" src="<?= $row['photo']; ?>">
          		</a>
          		<div class="media-body">
            		<h4 class="media-heading"><?= $row['name']; ?></h4>
                  <p class="text-right"></p>
                  <p><?= $row['description']; ?></p>
                  <p><a class="btn btn-info btn-sm" href="details.php?details=<?= $row['id']; ?>">Read more</a></p>
                  <ul class="list-inline list-unstyled">
          			<li><span><i class="glyphicon glyphicon-calendar"></i> <?= date('d M Y H:i',strtotime($row['publication'])); ?> </span></li>
                    <li>|</li>
                    <span><i class="glyphicon glyphicon-comment"></i> <?= $row['comments']; ?> comments</span>
                    <li>|</li>
        			</ul>
               </div>
            </div>
          </div>
          <?php } ?>
          <?php
            for($page = 1; $page<=$number_of_pages; $page++){
              echo '<a href="front.php?page='.$page.'">'.$page.'</a>';
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-3">

    </div>
  </div>
</div>
</body>
</html>
