(function($){
  $(document).ready(function(){
    var submit_btn = $("#social-btn-submit"); // Button ---

    // Social butons
    $("#social-buttons").find("li").each(function(){
      var self = $(this);
      self.on('click',function(){
        if(!self.hasClass("selected"))
          self.addClass("selected");
        else
          self.removeClass("selected");
      });
    });

    // Open dialog msg
    function open_msg(msg){
      var modal_msg = $("#msg-data-result");
      modal_msg.children("p").empty().text(msg);
      modal_msg.stop().css({"display":"block"}).animate({
        opacity:1
      },1000,function(){
        setTimeout(function(){
          modal_msg.animate({
            opacity:0
          },1000,function(){
            modal_msg.css({"display":"none"});
          });
        },500);
      });
    }

    // Send data ---
    submit_btn.on('click',function(e){
      e.preventDefault();
      var array = [];
      $("#social-buttons").find("li").each(function(){
        var self = $(this);
        var data;
        if(self.hasClass("selected")){
          data = self.prop("id");
          array.push(data);
        }
      });

      var json = {
        color:$("input[name='social-bar-color']").val(),
        height:$("input[name='social-bar-height']").val(),
        social:array
      };

      $.ajax({
        url:ajaxurl,
        method:"POST",
        data:{
          action:"post_data",
          dados:json
        }
      }).done(function(data){
        var json = JSON.parse(data);
        open_msg(json.msg);
      });
    });

  });
})(jQuery);
