$(document).ready(function() {
  $("#write-tweet-container").on("input", function() {

    let length = $("#write-tweet-container")[0].value.length;

    $("#char-count").text(length + "/140");

    if (length > 140) {
      $("#write-tweet-container").css("background-color", "red");
      $("#submit-tweet").attr("disabled", "true");
    } else {
      $("#write-tweet-container").css("background-color", "inherit");
      $("#submit-tweet").removeAttr("disabled");
    }

    if (length === 0) {
      $("#submit-tweet").attr("disabled", "true");
    }
  });
});