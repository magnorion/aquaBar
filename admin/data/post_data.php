<?php
  if(isset($_POST['dados'])){
    require_once("model/aqua-bar-model.php");
    $color = mysqli_real_escape_string($con,$_POST['dados']['color']);
    $height = mysqli_real_escape_string($con,$_POST['dados']['height']);
    if(isset($_POST['dados']['social'])){
      $social_join = implode(";",$_POST['dados']['social']);
      $social = mysqli_real_escape_string($con,$social_join);
    }
    $check_data = mysqli_query($con,"SELECT * FROM $table_name WHERE id != '' ");
    if($check_data->num_rows == 0){
      if(empty($social)){
        $social = "";
        $to_insert = "";
      }else{
        $to_insert = ",botoes";
      }
      $values_to_insert = "'$color','$height','$social'";
      $placement_to_insert = "cor,tamanho".$to_insert;
      $insert_all_data = mysqli_query($con,"INSERT INTO $table_name ($placement_to_insert) VALUES (".$values_to_insert.")") or die(mysqli_error($con));
      if($insert_all_data){
        $data = "Dados Criados!";
        $json = json_encode(array("msg"=>$data));
        echo $json;
      }
    }else{
      if(empty($social)){
        $to_update = "";
      }else{
        $to_update = "botoes = '$social'";
        $update_all_data = mysqli_query($con,"UPDATE $table_name SET cor = '$color', tamanho = '$height', ".$to_update." WHERE id = '1' ") or die(mysqli_error($con));
        if($update_all_data){
          $data = "Dados Atualizados!";
          $json = json_encode(array("msg"=>$data));
          echo $json;
        }
      }
    }
  }else{
    echo "Nothing Here!";
  }
  exit();
?>
