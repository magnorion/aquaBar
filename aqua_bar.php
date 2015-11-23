<?php
  /*
    Plugin Name: Aqua Bar
    Description: Plugin social bar
    Author: Grupo Cruzeiro do sul
    Author Uri: http://www.cruzeirodosuleducacional.edu.br/
    Version: 1.0
  */

  class aqua_bar{
    public function __construct(){
      wp_enqueue_script('livereload','http://localhost:460/livereload.js'); // Remove this in the end!
      if(!is_admin()){
        function aquaBar(){
          wp_enqueue_script('aqua-bar-script',plugins_url('aqua_bar/js/script.min.js'));
          wp_enqueue_style('aqua-bar-style',plugins_url('aqua_bar/css/style.css'));
          $build_bar = plugins_url('aqua_bar/build/index.php');
          require_once($build_bar);
        }
      }else{
        wp_enqueue_script('aqua-bar-admin_script',plugins_url('aqua_bar/admin/js/script.min.js'));
        wp_enqueue_style('aqua-bar-admin_style',plugins_url('aqua_bar/admin/js/style.css'));
        add_action( 'admin_menu', array( $this, 'admin_load' ) ); // Aqua slider admin assets
      }
    }
    public function admin_load(){
      $icon = plugins_url("aqua_slider/admin/css/imgs/aqua-slider-ico.png");
			add_menu_page('Aqua Bar', 'Aqua Bar', 10, 'aqua_bar/admin/index.php','',$icon);
    }
  }

  $socialBar = new aqua_bar;
?>
