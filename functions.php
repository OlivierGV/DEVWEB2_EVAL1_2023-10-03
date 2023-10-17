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
        $requete = "SELECT wp_posts.post_title AS post_title, wp_posts.id AS post_id, comment_ID AS comment_id, comment_content AS comment FROM wp_posts LEFT JOIN wp_comments ON comment_post_ID = wp_posts.id";
        //Mes résultats
        $resultat = $wpdb->get_results($requete);
        $erreur_sql = $wpdb->last_error;
        //Vérifier s'il y a un erreur
        if ("" == $erreur_sql){
            //Si la requête marche et qu'il y au moins 1 enregistrement
            if($wpdb->num_rows > 0){
                    //Boucle pour chaque résultat trouvé
                    foreach($resultat as $enreg)
                    {
                        ?>
                        <div class="card border-bottom-0">   
                            <!-- Onglet -->                                                      
                            <div class="card-header" id="">
                                <a data-toggle="collapse" href="#<?php echo($enreg->post_id); ?>">
                                    <span class="titrealigneboutons"><?php echo($enreg->post_title); ?></span>
                                </a>
                            </div>
                            <!-- Liste déroulante -->
                            <div class="collapse" aria-expanded="false" id="<?php echo($enreg->post_id); ?>">
                                <div class="card-body aucune-marge-haut-bas listefichesajax">
                                    <span class="encoursdegeneration">                            
                                        <span class="encoursdegeneration">
                                            <!-- Permettre de retourner à l'accueil -->
                                            <a href=<?php home_url(); ?>>
                                            <?php
                                            //Si tu vois un commentaire, affiche-le
                                            if($enreg->comment)
                                                echo($enreg->comment);
                                            //Sinon, informe l'utilisateur
                                            else
                                                echo("Aucun commentaire");
                                            ?>
                                            </a>
                                        </span> 
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }      
            }
            //Si aucune données n'a été trouvées
            else
            {
                echo '<div class="message-avertissement">';
                _e("Aucune donnée ne correspond à vos critères.");
                echo '</div>';
            }
        }
        //Si aucune connexion n'a été établie
        else
        {
            echo '<div class="message-erreur">';
            _e("Un problème est survenu.");
            echo '</div>';
        }
    }

    //Afficher Formations et Blogue
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

    //Afficher Hachage, Générateur et Icônes
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

    //Afficher Contact et À propos
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