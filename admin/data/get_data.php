<?php
  if(isset($_GET['action'])){
    require_once("model/aqua-bar-model.php");
    $get_all_data = mysqli_query($con,"SELECT * FROM $table_name WHERE id = '1' ");
    $data = mysqli_fetch_array($get_all_data);

    $json = json_encode(array(
      "color"=>$data['cor'],
      "height"=>$data['tamanho'],
      "social"=>$data['botoes']
    ));
    
    echo $json;

  }else{
    echo "Nothing Here!";
  }
  exit();
?>
