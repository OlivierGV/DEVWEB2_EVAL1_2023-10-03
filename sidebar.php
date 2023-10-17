<div class="popupchristiane" id="popuprecherche">
        <form method="get" action="https://apical.xyz/rechercherFormationsPagesAjax"> <input name="rechercher" type="text" id="rechercher" placeholder="Rechercher" required /> <a id="soumettrerecherche" href="#"><img src="https://apical.xyz/medias/commun/BoutonRechercher.svg" class="boutonrechercher" title="Rechercher dans tout le site" alt="Soumettre" /></a> </form> <span class="boutonrefermer"></span>
    </div>
    <div class="popupchristiane" id="popupauthentification">
        <div id="menuusager" class="cache">
            <p><label id="prenomnomfamille"></label></p> <a class="btn btn-secondary" href="https://apical.xyz/usagers/-1/modification">Profil</a> <a class="btn btn-secondary" id="deconnecter" href="#">Déconnecter</a>
        </div>
        <div id="formulaireauthentification"> <span id="messageauthentification"></span>
            <form method="post" action="wp-login.php" class='form-horizontal'> <input type="hidden" name="_token" value="EFGolN8urKrEnhBYRRavZ4YPwHzJ3smIHDRnNeYy">
                <div class="form-group row"> <label for="login" class="control-label col-sm-5 requis">Usager: </label>
                    <div class=col-sm-6> <input type="text" class="form-control" name="log" id="log" autofocus> </div>
                </div>
                <div class="form-group row"> <label for="motdepasse" class="control-label col-sm-5 requis">Mot de passe: </label>
                    <div class=col-sm-6> <input type="password" class="form-control" name="pwd" id="pwd"> </div>
                </div>
                <div class="form-group row">
                    <div class="control-label col-sm-5"></div>
                    <div class="col-sm-6">
                        <div class="form-check"> <label for="resterconnecte" class="form-check-label" checked> <input class="form-check-input" type="checkbox" id="resterconnecte" name="resterconnecte"> Rester connecté </label> </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="control-label col-sm-5"></div>
                    <div class="col-sm-6"><input type="submit" name="submit" class="btn btn-secondary" value="Soumettre"></div>
                </div>
                <div class="form-group row">
                    <div class="control-label col-sm-5"></div>
                    <div class="col-sm-6"> <a href="https://apical.xyz/usagers/creation">Nouvel usager</a> </div>
                </div>
            </form>
        </div> <span class="boutonrefermer"></span>
    </div>
    <div class="popupchristiane" id="popupbienvenue"></div>