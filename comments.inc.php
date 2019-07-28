<?php
function setComments($conn, $vid){
  if(isset($_POST['commentSubmit'])){
    $uid = $_POST['uid'];
    $message = $_POST['message'];
    $secretKey = '6LdgIa8UAAAAAITUlvPYYvpYq_Em6CMiQGR6ZmyE';
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $response = json_decode($response);
    if($response->success){
      $sql = "INSERT INTO comments (uid, parentid, date, message) VALUES ('$uid','$vid',NOW(),'$message')";
      $result = $conn->query($sql);
      $sql2 = "UPDATE crud SET comments=comments+1 WHERE id='$vid'";
      $result2 = $conn->query($sql2);
    } else {
      global $Failed_verification;
      $Failed_verification = 'failed';
    }
  }
}

function getComments($conn, $vid){
  $sql = "SELECT * FROM comments WHERE parentid='$vid' ORDER BY date DESC";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()){
    echo "<div class='bg-white rounded pl-1'><p>";
    echo $row['uid']."<br>";
    echo date('d M Y H:i',strtotime($row['date']))."<br>";
    echo nl2br($row ['message']);
    echo "</p></div>";
  }

}
