jQuery(function($) {

  $(document).ready(function() {
      // Configure/customize these variables.
      var showChar = 174;  // How many characters are shown by default
      var ellipsestext = "...";
      var moretext = "Leer más >";
      var lesstext = "< Leer menos";


      $('.more').each(function() {
          var content = $(this).html();

          if(content.length > showChar) {
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);
              var html = c +
                  /*'<span class="moreellipses">' + ellipsestext + '</span>*/'<span class="morecontent"><span>'
                  + h + '</span><a href="" class="morelink" tabindex="1">'
                  + moretext + '</a></span>';
              $(this).html(html);
          }
      });

      $(".morelink").click(function(){
          if($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext);
          }
          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
      });
  });

});
