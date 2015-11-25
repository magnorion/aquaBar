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

          ?>
          <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
          </script>
          <?

          require_once($build_bar);
        }
      }else{
        wp_enqueue_script('aqua-bar-admin_script',plugins_url('aqua_bar/admin/js/script.min.js'));
        wp_enqueue_style('aqua-bar-admin_style',plugins_url('aqua_bar/admin/css/style.css'));
        add_action( 'admin_menu', array( $this, 'admin_load' ) ); // Aqua slider admin assets
      }
    }
    public function admin_load(){
      $icon = plugins_url("aqua_slider/admin/css/imgs/aqua-slider-ico.png");
			add_menu_page('Aqua Bar', 'Aqua Bar', 10, 'aqua_bar/admin/index.php','',$icon);
    }
  }
  $socialBar = new aqua_bar;

  function post_data(){
    require_once("admin/data/post_data.php");
  }

  function get_data(){
    require_once("admin/data/get_data.php");
  }

  add_action( 'wp_ajax_post_data', 'post_data' );
  add_action( 'wp_ajax_nopriv_post_data', 'post_data' );

  add_action( 'wp_ajax_get_data', 'get_data' );
  add_action( 'wp_ajax_nopriv_get_data', 'get_data' );
?>
