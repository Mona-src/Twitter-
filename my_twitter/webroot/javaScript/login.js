$(document).ready(function() {
  function switchId() {
    // on stock le chemin vers les éléments qu'on veut changer dans des variables constantes (qui ne bougeront jamais)
    const input = $("#identifiant"); // chemin vers le name de l'input
    const label = $("#labelid"); //chemin vers le texte du label
    const btn = $("#switch"); // chemin vers le texte du bouton switch

    if (input.attr("placeholder") === "Email") {
      //si le name de l'input du formulaire est set sur "email"

      input.attr("placeholder", "Numéro de telephone"); // on change le texte du placeholder aussi
      label.text("Phone number"); // on change le texte du label aussi

      btn.val("Email address"); // on change le texte du bouton a coté aussi
    } else {
      input.attr("placeholder", "Email"); // on change le texte du placeholder par "email"
      $("#labelid").text("Email address"); // on change le texte du label aussi
      btn.val("Phone number"); // on change le texte du bouton à côté aussi
    }
  }

  $("#switch").click(function() {
    switchId(); // ici on appelle la fonction switch qu'on vient de créer au dessus, dès qu'on clique sur le bouton avec l'id "switch" dans le formulaire
  });
});
