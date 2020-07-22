<?php

if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../webroot/CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../webroot/CSS/main.css" />
    <link href="../webroot/CSS/inscription.css" rel="stylesheet">
    <title>Inscription</title>
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <div class="col align-self-start">
            </div>
            <div class="col align-self-center" id="register-form-container">
                <h1> Inscription </h1>

                <?php

                if (isset($_SESSION["error-mail-taken"])) {
                ?>
                    <div class="alert alert-danger">
                        Ce mail est déjà pris.
                    </div>
                <?php
                    session_destroy();
                }

                if (isset($_SESSION["error-username-taken"])) {
                ?>
                    <div class="alert alert-danger">
                        Ce nom d'utilisateur est déjà pris.
                    </div>
                <?php
                    session_destroy();
                }

                if (isset($_SESSION["error-phone-taken"])) {
                ?>
                    <div class="alert alert-danger">
                        Ce numéro de téléphone est déjà pris.
                    </div>
                <?php
                    session_destroy();
                }

                ?>

                <form action="../controller/globalControl.php" method="POST" id="inscription-form">

                    <p id="error-vide error-message" class="hidden">Certains champs sont vides</p>
                    <!-- Gère les noms -->
                    <p id="error-fullname" class="hidden error-message">Erreur sur les caractères demandés.</p>
                    <div class="form-group">
                        <label for="fullname">Nom complet*</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nom complet">
                    </div>

                    <!-- Gère le username (@) -->
                    <div class="form-group">
                        <p id="error-username" class="hidden error-message">Erreur sur les caractères.</p>
                        <label for="username">Username*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                    </div>

                    <!-- Gère le mot de passe -->
                    <div class="form-group">
                        <p id="error-password" class="hidden error-message">Votre mot de passe doit contenir au moins une lettre
                            minuscule, majuscule, un chiffre et faire entre 8 et 15 caractères.</p>
                        <label for="password">Mot de passe*</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">

                    </div>

                    <!-- Confirmer le mot de passe -->
                    <div class="form-group">
                        <p id="error-confirm-password" class="hidden error-message">Mot de passe non identiques.</p>
                        <label for="confirm-password">Confirmation du mot de passe*</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirmation du mdp">
                    </div>

                    <!-- Gère la date de naissance -->
                    <div class="form-group">
                        <p id="error-date" class="hidden error-message">Vous devez avoir plus de 13 ans pour vous inscrire</p>
                        <label for="date-naissance">Date de naissance*</label>
                        <input type="date" class="form-control" id="date-naissance" name="date-naissance">
                    </div>
                    <br>

                    <!-- Gère l'adresse email -->
                    <div class="form-group">
                        <p id="error-email" class="hidden error-message">Mail au mauvais format.</p>
                        <label class="sr-only" for="email">E-mail*</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="email" name="email-inscription" placeholder="E-mail">
                        </div>
                    </div>

                    <!-- Gère le numero de telephone -->
                    <div class="form-group">
                        <p id="error-tel" class="hidden error-message">Numéro de téléphone au mauvais format.</p>
                        <label for="tel">Téléphone</label>
                        <input type="text" class="form-control" id="tel" name="tel">
                    </div>

                    <!-- Gère le genre -->
                    <div class="form-group">
                        <label for="genre">Genre*</label>
                        <select class="form-control" name="genre" id="genre">
                            <option value="Masculin">Masculin</option>
                            <option value="Feminin">Feminin</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>

                    <!-- Gère le nom de la ville -->
                    <div class="form-group">
                        <p id="error-ville" class="hidden error-message">Erreur sur les caractères.</p>
                        <label for="ville">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville">
                    </div>

                    <!-- Gère le pays -->
                    <div class="form-group">
                        <label for="pays">Pays</label>
                        <select class="form-control" name="pays" id="pays">
                            <option value="France" selected="selected">France </option>

                            <option value="Afghanistan">Afghanistan </option>
                            <option value="Afrique_Centrale">Afrique_Centrale </option>
                            <option value="Afrique_du_sud">Afrique_du_Sud </option>
                            <option value="Albanie">Albanie </option>
                            <option value="Algerie">Algerie </option>
                            <option value="Allemagne">Allemagne </option>
                            <option value="Andorre">Andorre </option>
                            <option value="Angola">Angola </option>
                            <option value="Anguilla">Anguilla </option>
                            <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                            <option value="Argentine">Argentine </option>
                            <option value="Armenie">Armenie </option>
                            <option value="Australie">Australie </option>
                            <option value="Autriche">Autriche </option>
                            <option value="Azerbaidjan">Azerbaidjan </option>

                            <option value="Bahamas">Bahamas </option>
                            <option value="Bangladesh">Bangladesh </option>
                            <option value="Barbade">Barbade </option>
                            <option value="Bahrein">Bahrein </option>
                            <option value="Belgique">Belgique </option>
                            <option value="Belize">Belize </option>
                            <option value="Benin">Benin </option>
                            <option value="Bermudes">Bermudes </option>
                            <option value="Bielorussie">Bielorussie </option>
                            <option value="Bolivie">Bolivie </option>
                            <option value="Botswana">Botswana </option>
                            <option value="Bhoutan">Bhoutan </option>
                            <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                            <option value="Bresil">Bresil </option>
                            <option value="Brunei">Brunei </option>
                            <option value="Bulgarie">Bulgarie </option>
                            <option value="Burkina_Faso">Burkina_Faso </option>
                            <option value="Burundi">Burundi </option>

                            <option value="Caiman">Caiman </option>
                            <option value="Cambodge">Cambodge </option>
                            <option value="Cameroun">Cameroun </option>
                            <option value="Canada">Canada </option>
                            <option value="Canaries">Canaries </option>
                            <option value="Cap_vert">Cap_Vert </option>
                            <option value="Chili">Chili </option>
                            <option value="Chine">Chine </option>
                            <option value="Chypre">Chypre </option>
                            <option value="Colombie">Colombie </option>
                            <option value="Comores">Colombie </option>
                            <option value="Congo">Congo </option>
                            <option value="Congo_democratique">Congo_democratique </option>
                            <option value="Cook">Cook </option>
                            <option value="Coree_du_Nord">Coree_du_Nord </option>
                            <option value="Coree_du_Sud">Coree_du_Sud </option>
                            <option value="Costa_Rica">Costa_Rica </option>
                            <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                            <option value="Croatie">Croatie </option>
                            <option value="Cuba">Cuba </option>

                            <option value="Danemark">Danemark </option>
                            <option value="Djibouti">Djibouti </option>
                            <option value="Dominique">Dominique </option>

                            <option value="Egypte">Egypte </option>
                            <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                            <option value="Equateur">Equateur </option>
                            <option value="Erythree">Erythree </option>
                            <option value="Espagne">Espagne </option>
                            <option value="Estonie">Estonie </option>
                            <option value="Etats_Unis">Etats_Unis </option>
                            <option value="Ethiopie">Ethiopie </option>

                            <option value="Falkland">Falkland </option>
                            <option value="Feroe">Feroe </option>
                            <option value="Fidji">Fidji </option>
                            <option value="Finlande">Finlande </option>
                            <option value="France">France </option>

                            <option value="Gabon">Gabon </option>
                            <option value="Gambie">Gambie </option>
                            <option value="Georgie">Georgie </option>
                            <option value="Ghana">Ghana </option>
                            <option value="Gibraltar">Gibraltar </option>
                            <option value="Grece">Grece </option>
                            <option value="Grenade">Grenade </option>
                            <option value="Groenland">Groenland </option>
                            <option value="Guadeloupe">Guadeloupe </option>
                            <option value="Guam">Guam </option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernesey">Guernesey </option>
                            <option value="Guinee">Guinee </option>
                            <option value="Guinee_Bissau">Guinee_Bissau </option>
                            <option value="Guinee equatoriale">Guinee_Equatoriale </option>
                            <option value="Guyana">Guyana </option>
                            <option value="Guyane_Francaise ">Guyane_Francaise </option>

                            <option value="Haiti">Haiti </option>
                            <option value="Hawaii">Hawaii </option>
                            <option value="Honduras">Honduras </option>
                            <option value="Hong_Kong">Hong_Kong </option>
                            <option value="Hongrie">Hongrie </option>

                            <option value="Inde">Inde </option>
                            <option value="Indonesie">Indonesie </option>
                            <option value="Iran">Iran </option>
                            <option value="Iraq">Iraq </option>
                            <option value="Irlande">Irlande </option>
                            <option value="Islande">Islande </option>
                            <option value="Israel">Israel </option>
                            <option value="Italie">italie </option>

                            <option value="Jamaique">Jamaique </option>
                            <option value="Jan Mayen">Jan Mayen </option>
                            <option value="Japon">Japon </option>
                            <option value="Jersey">Jersey </option>
                            <option value="Jordanie">Jordanie </option>

                            <option value="Kazakhstan">Kazakhstan </option>
                            <option value="Kenya">Kenya </option>
                            <option value="Kirghizstan">Kirghizistan </option>
                            <option value="Kiribati">Kiribati </option>
                            <option value="Koweit">Koweit </option>

                            <option value="Laos">Laos </option>
                            <option value="Lesotho">Lesotho </option>
                            <option value="Lettonie">Lettonie </option>
                            <option value="Liban">Liban </option>
                            <option value="Liberia">Liberia </option>
                            <option value="Liechtenstein">Liechtenstein </option>
                            <option value="Lituanie">Lituanie </option>
                            <option value="Luxembourg">Luxembourg </option>
                            <option value="Lybie">Lybie </option>

                            <option value="Macao">Macao </option>
                            <option value="Macedoine">Macedoine </option>
                            <option value="Madagascar">Madagascar </option>
                            <option value="Madère">Madère </option>
                            <option value="Malaisie">Malaisie </option>
                            <option value="Malawi">Malawi </option>
                            <option value="Maldives">Maldives </option>
                            <option value="Mali">Mali </option>
                            <option value="Malte">Malte </option>
                            <option value="Man">Man </option>
                            <option value="Mariannes du Nord">Mariannes du Nord </option>
                            <option value="Maroc">Maroc </option>
                            <option value="Marshall">Marshall </option>
                            <option value="Martinique">Martinique </option>
                            <option value="Maurice">Maurice </option>
                            <option value="Mauritanie">Mauritanie </option>
                            <option value="Mayotte">Mayotte </option>
                            <option value="Mexique">Mexique </option>
                            <option value="Micronesie">Micronesie </option>
                            <option value="Midway">Midway </option>
                            <option value="Moldavie">Moldavie </option>
                            <option value="Monaco">Monaco </option>
                            <option value="Mongolie">Mongolie </option>
                            <option value="Montserrat">Montserrat </option>
                            <option value="Mozambique">Mozambique </option>

                            <option value="Namibie">Namibie </option>
                            <option value="Nauru">Nauru </option>
                            <option value="Nepal">Nepal </option>
                            <option value="Nicaragua">Nicaragua </option>
                            <option value="Niger">Niger </option>
                            <option value="Nigeria">Nigeria </option>
                            <option value="Niue">Niue </option>
                            <option value="Norfolk">Norfolk </option>
                            <option value="Norvege">Norvege </option>
                            <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
                            <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

                            <option value="Oman">Oman </option>
                            <option value="Ouganda">Ouganda </option>
                            <option value="Ouzbekistan">Ouzbekistan </option>

                            <option value="Pakistan">Pakistan </option>
                            <option value="Palau">Palau </option>
                            <option value="Palestine">Palestine </option>
                            <option value="Panama">Panama </option>
                            <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
                            <option value="Paraguay">Paraguay </option>
                            <option value="Pays_Bas">Pays_Bas </option>
                            <option value="Perou">Perou </option>
                            <option value="Philippines">Philippines </option>
                            <option value="Pologne">Pologne </option>
                            <option value="Polynesie">Polynesie </option>
                            <option value="Porto_Rico">Porto_Rico </option>
                            <option value="Portugal">Portugal </option>

                            <option value="Qatar">Qatar </option>

                            <option value="Republique_Dominicaine">Republique_Dominicaine </option>
                            <option value="Republique_Tcheque">Republique_Tcheque </option>
                            <option value="Reunion">Reunion </option>
                            <option value="Roumanie">Roumanie </option>
                            <option value="Royaume_Uni">Royaume_Uni </option>
                            <option value="Russie">Russie </option>
                            <option value="Rwanda">Rwanda </option>

                            <option value="Sahara Occidental">Sahara Occidental </option>
                            <option value="Sainte_Lucie">Sainte_Lucie </option>
                            <option value="Saint_Marin">Saint_Marin </option>
                            <option value="Salomon">Salomon </option>
                            <option value="Salvador">Salvador </option>
                            <option value="Samoa_Occidentales">Samoa_Occidentales</option>
                            <option value="Samoa_Americaine">Samoa_Americaine </option>
                            <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
                            <option value="Senegal">Senegal </option>
                            <option value="Seychelles">Seychelles </option>
                            <option value="Sierra Leone">Sierra Leone </option>
                            <option value="Singapour">Singapour </option>
                            <option value="Slovaquie">Slovaquie </option>
                            <option value="Slovenie">Slovenie</option>
                            <option value="Somalie">Somalie </option>
                            <option value="Soudan">Soudan </option>
                            <option value="Sri_Lanka">Sri_Lanka </option>
                            <option value="Suede">Suede </option>
                            <option value="Suisse">Suisse </option>
                            <option value="Surinam">Surinam </option>
                            <option value="Swaziland">Swaziland </option>
                            <option value="Syrie">Syrie </option>

                            <option value="Tadjikistan">Tadjikistan </option>
                            <option value="Taiwan">Taiwan </option>
                            <option value="Tonga">Tonga </option>
                            <option value="Tanzanie">Tanzanie </option>
                            <option value="Tchad">Tchad </option>
                            <option value="Thailande">Thailande </option>
                            <option value="Tibet">Tibet </option>
                            <option value="Timor_Oriental">Timor_Oriental </option>
                            <option value="Togo">Togo </option>
                            <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
                            <option value="Tristan da cunha">Tristan de cuncha </option>
                            <option value="Tunisie">Tunisie </option>
                            <option value="Turkmenistan">Turmenistan </option>
                            <option value="Turquie">Turquie </option>

                            <option value="Ukraine">Ukraine </option>
                            <option value="Uruguay">Uruguay </option>

                            <option value="Vanuatu">Vanuatu </option>
                            <option value="Vatican">Vatican </option>
                            <option value="Venezuela">Venezuela </option>
                            <option value="Vierges_Americaines">Vierges_Americaines </option>
                            <option value="Vierges_Britanniques">Vierges_Britanniques </option>
                            <option value="Vietnam">Vietnam </option>

                            <option value="Wake">Wake </option>
                            <option value="Wallis et Futuma">Wallis et Futuma </option>

                            <option value="Yemen">Yemen </option>
                            <option value="Yougoslavie">Yougoslavie </option>

                            <option value="Zambie">Zambie </option>
                            <option value="Zimbabwe">Zimbabwe </option>

                        </select>
                        <p id="error-Pays" class="hidden" style="color: red;">Erreur sur les caractères</p>
                    </div>

                    <!-- Gère le site web -->
                    <div class="form group">
                        <p id="error-web" class="hidden error-message">Le site web n'est pas au bon format.</p>
                        <label for="web">Web</label>
                        <input type="web" class="form-control" id="web" name="web">
                    </div>

                    <p class="info-message"><sup>*</sup>Champs requis.</p>

                    <input type="submit" class="btn btn-info btn-lg" id="inscription" name="inscription" value="S'inscrire">
                    </br>
                    <a href="connexion.php">Déjà inscrit ? Connectez-vous.</a>
            </div>
            </form>
            <div class="col align-self-end">
            </div>
        </div>



    </main>
    <script src="../webroot/javaScript/jQuery.js"></script>
    <script src="../webroot/javaScript/verifInscription.js"></script>
</body>

</html>