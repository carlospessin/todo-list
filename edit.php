<?php
include 'db.php'; 

if(isset($_POST['send'])) {
  $name = $_POST['task'];
  $id = $_POST['id'];

  $sql = "update tasks set name='$name' where id = '$id'";
  $val = $db->query($sql);
 
  if($val) {
    header('Location: index.php');
  }
 }

?>