$(document).ready(function() {
  $.each($(".message-to-link"), function() {
    $(this).click(function() {
      $.ajax({
        url: "../model/getUserId.php",
        type: "POST",
        dataType: "html",
        data: "username=" + $(this).text(),
        success: function(id, statut) {
          var userId = id;
        }
      });
    //   $.ajax({
    //     url: "../model/getMessages.php",
    //     type: "GET",
    //     dataType: "html",
    //     data: "id-to=" + userId,
    //     success: function(code_html, statut) {}
    //   });
    });
  });
});
