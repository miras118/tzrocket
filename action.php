<?php
session_start();
include 'config.php';

$update = false;
$id = "";
$name = "";
$photo = "";
$description = "";

if(isset($_POST['add'])){
  $name = $_POST['name'];
  $photo = $_FILES['image']['name'];
  $description = $_POST['description'];
  $upload = "uploads/".$photo;
  $query = "INSERT INTO crud (name, photo, description) VALUES (?,?,?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sss", $name, $upload, $description);
  $stmt->execute();
  move_uploaded_file($_FILES['image']['tmp_name'], $upload);
  header('location:crud.php');
  $_SESSION['response']="Successfully Inserted to the database!";
  $_SESSION['res_type']="success";
}

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql = "SELECT photo FROM crud WHERE id=?";
  $stmt2 = $conn->prepare($sql);
  $stmt2->bind_param("i",$id);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  $row = $result2->fetch_assoc();
  $imagepath = $row['photo'];
  unlink($imagepath);

  $query = "DELETE FROM crud WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i",$id);
  $stmt->execute();

  $query2 = "DELETE FROM comments WHERE parentid=?";
  $stmt2 = $conn->prepare($query2);
  $stmt2->bind_param("i",$id);
  $stmt2->execute();

  header('location:crud.php');
  $_SESSION['response']="Successfully Deleted!";
  $_SESSION['res_type']="danger";
}

if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $query = "SELECT * FROM crud WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i",$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $id = $row['id'];
  $name = $row['name'];
  $photo = $row['photo'];
  $description = $row['description'];

  $update = true;
}

if(isset($_POST['update'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $oldimage = $_POST['oldimage'];
  if(isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
    $newimage = "uploads/".$_FILES['image']['name'];
    unlink($oldimage);
    move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
  } else {
    $newimage = $oldimage;
  }
  $query = "UPDATE crud SET name=?, photo=?, description=? WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssi",$name,$newimage,$description,$id);
  $stmt->execute();

  $_SESSION['response'] = "Updated Successfully!";
  $_SESSION['res_type'] = "primary";
  header('location:crud.php');
}

if(isset($_GET['details'])){
  $id = $_GET['details'];
  $query = "SELECT * FROM crud WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i",$id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $vid = $row['id'];
  $vname = $row['name'];
  $vphoto = $row['photo'];
  $vdescription = $row['description'];
  $vpublication = $row['publication'];
}
?>
