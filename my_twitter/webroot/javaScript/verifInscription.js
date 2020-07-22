$(document).ready(function() {
  function verif_username(username) {
    const specialChars = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?]/;
    if (
      specialChars.test(username) ||
      username === undefined ||
      username === ""
    ) {
      return false;
    }

    return true;
  }

  function verif_mail(mail) {
    if (mail === "") {
      return false;
    }
    let regex = /(.)+(@){1}(.)+(\.){1}(.){2,}/;
    if (regex.test(mail)) {
      return true;
    }
    return false;
  }

  function verif_mdp(mdp) {
    if (mdp === "") {
      return false;
    }
    let regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]){8,15}$/g;
    if (!regex.test(mdp)) {
      return false;
    }
    return true;
  }

  function verif_age(date) {
    let mois = date.substring(5, 7);
    let annee = date.substring(0, 4);

    let today = new Date();

    let mois_today = today.getMonth();
    let annee_today = today.getFullYear();

    let age = annee_today - annee;
    let monthage = mois_today - mois;

    if (monthage > 0) {
      age--;
    }
    if (age < 13 || date === undefined || date === "") {
      return false;
    }
    return true;
  }

  function verif_url(web) {
    let regex = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
    if (regex.test(web)) {
      return true;
    }
    return false;
  }

  function verif_telephone(telephone) {
    let regex = /(0){1}(\d){9}/;
    if (!regex.test(telephone)) {
      return false;
    }
    return true;
  }

  function verif_ville(ville) {
    let regex = /^[a-zA-z] ?([a-zA-z]|[a-zA-z] )*[a-zA-z]$/;
    if (regex.test(ville)) {
      return true;
    }
    return false;
  }

  $("#inscription").click(function(e) {
    e.preventDefault();

    $.each($(".error-message"), function() {
      $(this).addClass("hidden");
    });

    let erreur = 0;

    if (!verif_username($("#username").val())) {
      $("#error-username").removeClass("hidden");
      erreur++;
    }

    if (!verif_username($("#fullname").val())) {
      $("#error-fullname").removeClass("hidden");
      erreur++;
    }

    if (!verif_mail($("#email").val())) {
      $("#error-email").removeClass("hidden");
      erreur++;
    }

    if (!verif_mdp($("#password").val())) {
      $("#error-password").removeClass("hidden");
      erreur++;
    }

    if ($("#confirm-password").val() !== $("#password").val()) {
      $("#error-confirm-password").removeClass("hidden");
      erreur++;
    }

    if (!verif_age($("#date-naissance").val())) {
      $("#error-date").removeClass("hidden");
      erreur++;
    }

    if ($("#web").val() !== "") {
      if (!verif_url($("#web").val())) {
        $("#error-web").removeClass("hidden");
        erreur++;
      }
    }

    if ($("#tel").val() !== "") {
      if (!verif_telephone($("#tel").val())) {
        $("#error-tel").removeClass("hidden");
        erreur++;
      }
    }

    if ($("#ville").val() !== "") {
      if (!verif_ville($("#ville").val())) {
        $("#error-ville").removeClass("hidden");
        erreur++;
      }
    }

    console.log(erreur);
    if (erreur === 0) {
      $("#inscription-form").submit();
    }
  });
});
