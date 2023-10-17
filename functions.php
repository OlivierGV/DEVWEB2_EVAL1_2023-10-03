<?php
    /* Les foncitons de mon thème Apical
     * -> Première fonction : lister les postes de l'utilisateur
     * -> Deuxième fonction : - aucune -
     */

    //Lister les éléments des posts
    function lister_postes ()
    {
        //Création de la variable wpdb qui me permet d'utiliser la DATABASE peut importe le préfixe que j'ai choisis.
        global $wpdb;
        //Mes paramètres
        $maTable = "wp_posts";
        //Ma requête
        $requete = "SELECT id AS id_du_post, post_title, post_content AS commentaire FROM $maTable";
        //Mes résultats
        $resultat = $wpdb->get_results($requete);
        $erreur_sql = $wpdb->last_error;
        //Afficher un message correspondant à la fin de l'action
        if ("" == $erreur_sql){
            if($wpdb->num_rows > 0){
                    foreach($resultat as $enreg)
                    {
                        ?>
                        <div class="card border-bottom-0">                                                           
                            <div class="card-header" id="">
                                <a data-toggle="collapse" href="#<?php echo($enreg->id_du_post); ?>"> <!-- le href permet la liste déroulante -->
                                    <span class="titrealigneboutons"><?php echo($enreg->post_title); ?></span>
                                </a>
                            </div>
                            <div class="collapse" aria-expanded="false" id="<?php echo($enreg->id_du_post); ?>"> <!-- L'id et le href doivent être identiques -->
                                <div class="card-body aucune-marge-haut-bas listefichesajax">
                                    <span class="encoursdegeneration"><?php echo($enreg->commentaire) ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }      
                    ?>
            <?php
            }
            else //Si aucune données n'a été trouvées
            {
                echo '<div class="message-avertissement">';
                _e("Aucune donnée ne correspond à vos critères.");
                echo '</div>';
            }
        }
        else //Si aucune connexion n'a été établie
        {
            echo '<div class="message-erreur">';
            _e("Un problème est survenu.");
            echo '</div>';
        }
    }

    function contenu_sidebar(){
            echo('
            <div class="popupchristiane" id="popuprecherche">
        <form method="get" action="https://apical.xyz/rechercherFormationsPagesAjax"> <input name="rechercher" type="text" id="rechercher" placeholder="Rechercher" required /> <a id="soumettrerecherche" href="#"><img src="https://apical.xyz/medias/commun/BoutonRechercher.svg" class="boutonrechercher" title="Rechercher dans tout le site" alt="Soumettre" /></a> </form> <span class="boutonrefermer"></span>
    </div>
    <div class="popupchristiane" id="popupauthentification">
        <div id="menuusager" class="cache">
            <p><label id="prenomnomfamille"></label></p> <a class="btn btn-secondary" href="https://apical.xyz/usagers/-1/modification">Profil</a> <a class="btn btn-secondary" id="deconnecter" href="#">Déconnecter</a>
        </div>
        <div id="formulaireauthentification"> <span id="messageauthentification"></span>
            <form method="post" action="https://apical.xyz/usagers/authentifier" class="form-horizontal"> <input type="hidden" name="_token" value="EFGolN8urKrEnhBYRRavZ4YPwHzJ3smIHDRnNeYy">
                <div class="form-group row"> <label for="login" class="control-label col-sm-5 requis">Usager: </label>
                    <div class=col-sm-6> <input type="text" class="form-control" name="login" id="login" autofocus> </div>
                </div>
                <div class="form-group row"> <label for="motdepasse" class="control-label col-sm-5 requis">Mot de passe: </label>
                    <div class=col-sm-6> <input type="password" class="form-control" name="motdepasse" id="motdepasse"> </div>
                </div>
                <div class="form-group row">
                    <div class="control-label col-sm-5"></div>
                    <div class="col-sm-6">
                        <div class="form-check"> <label for="resterconnecte" class="form-check-label" checked> <input class="form-check-input" type="checkbox" id="resterconnecte" name="resterconnecte"> Rester connecté </label> </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="control-label col-sm-5"></div>
                    <div class="col-sm-6"> <a id="soumettreauthentification" class="btn btn-secondary" href="#">Soumettre</a> </div>
                </div>
                <div class="form-group row">
                    <div class="control-label col-sm-5"></div>
                    <div class="col-sm-6"> <a href="https://apical.xyz/usagers/creation">Nouvel usager</a> </div>
                </div>
            </form>
        </div> <span class="boutonrefermer"></span>
    </div>
    <div class="popupchristiane" id="popupbienvenue"></div>');
    }

    function formations_blogue() {
        $id_pages = get_all_page_ids();
        foreach($id_pages as $page)
        {
            //titre
            $titre = get_the_title($page);
            //hyperlien
            $lien = get_page_link($page);
            //n'afficher que Formations et Blogue
            if($titre == 'Formations' || $titre == 'Blogue')
            {
                insertion_site($lien, $titre);
            }
            
        }
    }

    function liste_outils() {
        $id_pages = get_all_page_ids();
        $retour_positif = false;
        if($id_pages != null) {
            foreach($id_pages as $page){
                $retour_positif = true;
                //titre
                $titre = get_the_title($page);
                //hyperlien
                $lien = get_page_link($page);
                //Pour les pages ayant le nom adéquat
                if($titre == 'Hachage bcrypt' || $titre == 'Générateur aléatoire' || $titre == 'Icônes Font Awesome'){
                    $retour_positif = true;
                    echo ('<a href="' . $lien . '"class="dropdown-item">'. $titre . '</a>');
                }        
            }
            //Afficher à l'utilisateur que son dropdown est vide
            si_non_dispo($retour_positif);
        }                    
    }

    function liste_aide() {
        $id_pages = get_all_page_ids();
        $retour_positif = false;
        if($id_pages != null) {
            $classe_divider = 0;
            foreach($id_pages as $page){
                //titre
                $titre = get_the_title($page);
                //hyperlien
                $lien = get_page_link($page);
                //Pour les pages ayant le nom adéquat
                if($titre == 'Contact' || $titre == 'À propos'){
                    $retour_positif = true;
                    verif_divider($classe_divider);
                    echo ('<a href="' . $lien . '"class="dropdown-item">'. $titre . '</a>');
                }        
            }
            //Afficher à l'utilisateur que son dropdown est vide
            si_non_dispo($retour_positif);
        }                    
    }

    //Pour sauver de l'espace dans mes fonctions précédentes
    function insertion_site(string $lien, string $titre)
    {
        echo ('<li class="nav-item px-lg-4">');
        echo ('<a href="' . $lien . '" class="nav-link text-uppercase text-expanded boucle-1">' . $titre . '</a>');
        echo ('</li>');
    }

    //Pour savoir si oui ou non, nous devons instaurer un divider
    function verif_divider(int $classe_divider){
        if($classe_divider > 0)
        {
            echo ('<div class="dropdown-divider"></div>');
        }
        else
        {
            $classe_divider += 1;
        }
    }

    //Vérifier que les noms de page correspondent
    function si_non_dispo($retour_positif){
        if($retour_positif == false){
            echo '<a class="dropdown-item " href="#">Non disponible</a>';
        }
    }

?>