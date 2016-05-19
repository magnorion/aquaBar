(function($){
  $.fn.extend({
    aquaBar: function(obj){
      // if mobile, remove the bar (;-;)
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        return false;
      }
      //

      var bar = $(this); // Bar element
      bar.wrap("<div id='social-bar-placement'></div>");
      var place = $("#social-bar-placement");

      // if theres no config
      if(typeof(obj) == 'undefined')
        obj = {};

      // All config
      var conf = {
        height: obj.height || "25",
        background: obj.color || "#00917C",
        facebook: obj.facebook || "false",
        twitter: obj.twitter || "false",
        google: obj.google || "false",
        linkedin: obj.linkedin || "false"
      };

      // Set Config
      bar.css({
        height:conf.height+"px",
        background:conf.background
      });
      place.css({
        height:conf.height+"px"
      });

      // Function to create a social button
      function create_social_btn(type){
        var click = $("<div>");
        click.addClass('social-button '+type+'-social-btn');
        bar.append(click);
      }
      var the_url = window.location.href; // Url ---
      if(conf.facebook == "true"){
        create_social_btn("facebook");
        bar.on('click','.facebook-social-btn',function(){
          var self = $(this);
          window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(the_url),"facebook-share","width=400&height=200");
        });
      }
      if(conf.twitter == "true"){
        create_social_btn("twitter");
        bar.on('click','.twitter-social-btn',function(){
          var self = $(this);
          window.open("https://twitter.com/intent/tweet?text="+encodeURIComponent(the_url),"twitter-share","width=400&height=200");
        });
      }
      if(conf.linkedin == "true"){
        create_social_btn("linkedin");
        bar.on('click','.linkedin-social-btn',function(){
          var self = $(this);
          window.open("https://www.linkedin.com/shareArticle?mini=true&title="+encodeURIComponent(window.location.host)+"&url="+encodeURIComponent(the_url),"linkedin-share","width=400&height=200");
        });
      }

      if(conf.google == "true"){
        create_social_btn("google");
        bar.on('click','.google-social-btn',function(){
          var self = $(this);
          window.open("https://plus.google.com/share?url="+encodeURIComponent(the_url),"google-share","width=600&height=800");
        });
      }

      // creating the arrow (close)
      var arrow = $("<div>");
      arrow.addClass('social-arrow close-arrow');
      bar.append(arrow);

      // creating the arrow (open)
      var arrow = $("<div>");
      arrow.addClass('social-arrow open-arrow');
      place.append(arrow);

      // Close
      bar.on('click','.close-arrow',function(){
        bar.animate({
          top:'100%',
          opacity:0
        },1000,function(){
          $('.open-arrow').css({display:"block"}).animate({opacity:1,top:"0%"},1000);
          bar.css({"z-index":"-999"});
        });
      });

      // Open
      place.on('click','.open-arrow',function(){
        $('.open-arrow').animate({opacity:0,top:"100%"},1000,function(){$('.open-arrow').css({display:"none"})});
        bar.animate({
          top:'0%',
          opacity:1
        },1000,function(){
          bar.css({"zIndex":"99999"});
        });
      });

      // Start Animation
      setTimeout(function(){
        bar.stop().animate({
          opacity:1,
          top:"0%"
        },600);
      },500);
      return bar;
    }
  });
})(jQuery);
