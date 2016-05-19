<?php
  /*
    Plugin Name: Aqua Bar
    Description: Plugin social bar
    Author: Magnorion
    Author Uri: http://github.com/magnorion/aquaBar
    Version: 1.0
  */

  class AquaBar{
    public function __construct(){
      if(!is_admin()){
        add_action( 'wp_head', array( $this, 'aquaBar' ) ); // Aqua slider build
      }else{
        add_action( 'admin_menu', array( $this, 'admin_load' ) ); // Aqua slider admin assets
      }
      wp_enqueue_script('livereload','http://localhost:460/livereload.js'); // Remove this in the end!
    }
    public function admin_load(){
      $path = plugin_dir_url(__file__);
      wp_enqueue_script('aqua-bar-admin_script',$path.'admin/js/script.min.js');
      wp_enqueue_style('aqua-bar-admin_style',$path.'admin/css/style.css');

      $icon = $path.'admin/css/img/aqua-bar-ico.png';
			add_menu_page('Aqua Bar', 'Aqua Bar', 10, 'aqua_bar/admin/index.php','',$icon);
    }

    public function aquaBar(){
      $path = plugin_dir_url(__file__);
      wp_enqueue_script('aqua-bar-script',$path.'/js/script.min.js');
      wp_enqueue_style('aqua-bar-style',$path.'/css/style.css');

      echo '<script type="text/javascript">';
      echo 'var ajaxurl ='.admin_url("admin-ajax.php").';';
      echo '</script>';

      require_once('build/index.php');
    }

    public function post_data(){
      require_once("admin/data/post_data.php");
    }

    public function get_data(){
      require_once("admin/data/get_data.php");
    }
  }
  $socialBar = new AquaBar;

  add_action( 'wp_ajax_post_data', array($socialBar,'post_data'));
  add_action( 'wp_ajax_nopriv_post_data', array($socialBar,'post_data'));

  add_action( 'wp_ajax_get_data', array($socialBar,'get_data'));
  add_action( 'wp_ajax_nopriv_get_data', array($socialBar,'get_data'));
?>
