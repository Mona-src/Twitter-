$(document).ready(function() {
  $.ajax({
    url: "../controller/getFollows.php",
    type: "GET",
    data: "follower-username=" + $("#username-display").text(),
    success: function(followers, statut) {
      followers.forEach(element => {
        $("#followers-display").append("<a href='profile_view.php?id="+element["id"]+"'>@"+ element["username"] +"</a></br>")
      });
    }
  });
  $.ajax({
    url: "../controller/getFollows.php",
    type: "GET",
    data: "following-username=" + $("#username-display").text(),
    success: function(following, statut) {
      following.forEach(element => {
        $("#following-display").append("<a href='profile_view.php?id="+element["id"]+"'>@"+ element["username"] +"</a></br>")
      });
    }
  });
  $("#followerId").on("click", function() {
    $("#followers-modal").removeClass("hidden");
  });

  $("#close-followers-modal").on("click", function() {
    $("#followers-modal").addClass("hidden");
  })
  $("#followingId").on("click", function() {
    $("#following-modal").removeClass("hidden");
  });

  $("#close-following-modal").on("click", function() {
    $("#following-modal").addClass("hidden");
  })

  $("#button-unfollow").hover(function() {
    $(this).val("Ne plus suivre");
  })

  $("#button-unfollow").mouseout(function() {
    $(this).val("Abonné");
  })
});
