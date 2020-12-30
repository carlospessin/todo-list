<?php
if(isset($_POST['id'])){
  require 'db.php';

  $id = $_POST['id'];

  if(empty($id)){
     echo 'error';
  }else {
      $todos = mysqli_query ($db, "SELECT id, checked FROM tasks WHERE id='$id'") or die(mysqli_error($db));
      // $todos = $db->prepare("SELECT id, checked FROM tasks WHERE id=?");
      // $todos->execute([$id]);

      $todo=( $todos) ? mysqli_fetch_assoc( $todos) : false;
      // $todo = $todos->fetch();
      $uId = $todo['id'];
      $checked = $todo['checked'];

      $uChecked = $checked ? 0 : 1;

      $res = $db->query("UPDATE tasks SET checked=$uChecked WHERE id=$uId");

      if($res){
          echo $checked;
      }else {
          echo "error";
      }
      $db = null;
      exit();
  }
}else {
  header("Location: index.php?mess=error");
}
?>