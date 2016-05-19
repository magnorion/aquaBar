<div id="aqua-bar-container"></div>
<script>
  (function($){
    $(document).ready(function(){
      $.ajax({
        url:ajaxurl,
        method:"GET",
        data:{
          action:"get_data"
        }
      }).done(function(data){
        var json = JSON.parse(data);
        var breaker = json.social.split(";");

        var facebook = "false",twitter = "false",google = "false",linkedin = "false";
        $.each(breaker,function(index,item){
          if(item == "facebook")
            facebook = "true";
          if(item == "twitter")
            twitter = "true";
          if(item == "linkedin")
            linkedin = "true";
          if(item == "google")
            google = "true";
        });
        var obj_config = {
            "color":json.color,
            "height":json.height,
            "facebook":facebook,
            "twitter":twitter,
            "linkedin":linkedin,
            "google":google
        };

        $("#aqua-bar-container").aquaBar(obj_config);
      });
    });
  })(jQuery);
</script>
