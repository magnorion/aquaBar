<?php
  $con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
  mysqli_select_db( $con, DB_NAME );
  $table_name = 'aqua_bar';

  $height = "";
  $color = "";
  $builder_btn = array(
    "facebook" => '<li id="facebook"></li>',
    "twitter" => '<li id="twitter"></li>',
    "linkedin" => '<li id="linkedin"></li>',
    "google" => '<li id="google"></li>'
  );

  $search_data = mysqli_query($con,"SELECT * FROM $table_name WHERE id = '1' ");

  if(mysqli_num_rows($search_data) > 0){
    $data = mysqli_fetch_array($search_data);

    $height = $data['tamanho'];
    $color = $data['cor'];

    if($data['botoes'] != ""){
      $explode = explode(";",$data['botoes']);
      foreach($explode as $index => $value){
        if($value == "facebook"){
          $builder_btn['facebook'] = '<li id="facebook" class="selected"></li>';
        }else if($value == "twitter"){
          $builder_btn['twitter'] = '<li id="twitter" class="selected"></li>';
        }else if($value == "linkedin"){
          $builder_btn['linkedin'] = '<li id="linkedin" class="selected"></li>';
        }else if($value == "google"){
          $builder_btn['google'] = '<li id="google" class="selected"></li>';
        }
      }
    }
  }
?>
<h1> Configuração da Social Bar </h1>
<div id="config-place">
  <h2> Barra </h2>
  <form name="social-bar-config">
    <div>
      <label>Cor:</label>
      <input type="text" value="<?php echo $color ?>" name="social-bar-color" />
      <span> ( Digite a cor em HEX ) </span>
    </div>
    <div>
      <label>Tamanho:</label>
      <input type="text" value="<?php echo $height ?>" name="social-bar-height" />
      <span> ( Digite o tamanho da barra ) </span>
    </div>
    <div id="social-config-placement">
      <h2> Botões da barra </h2>
      <p> Selecione os botões sociais. </p>
      <ul id="social-buttons">
        <?php
          foreach($builder_btn as $index => $value){
            echo $value."\n";
          }
        ?>
      </ul>
    </div>
    <button id="social-btn-submit"> Atualizar os dados </button>
  </form>
  <div id="msg-data-result">
    <p> </p>
  </div>
</div>
