<?php
    /* Mon index pour Apical
     * -> On y appelle tous mes autres fiches php
     * -> C'est la première page sur laquelle l'utilisateur pose les yeux
     */


    /* Appeler "header.php" */
    get_header();
?>
                        <li class="nav-item px-lg-4 dropdown"> <a href="https://apical.xyz/pages/formulairebcrypt" class="dropdown-toggle nav-link text-uppercase text-expanded  " data-toggle="dropdown" data-target="#" aria-haspopup="true" aria-expanded="false">Outils </a>
                            <div class="dropdown-menu">
                                 <?php
                                    //Ajouter les sous-onglets d'Outils
                                    liste_outils();
                                 ?>
                            </div>
                        </li>
                        <li class="nav-item px-lg-4 dropdown"> <a href="https://apical.xyz/contact" class="dropdown-toggle nav-link text-uppercase text-expanded " data-toggle="dropdown" data-target="#" aria-haspopup="true" aria-expanded="false">Aide </a>
                            <div class="dropdown-menu"> 
                                <?php
                                    //Ajouter les sous-onglets d'Aide
                                    liste_aide();
                                ?>
                            </div>
                        </li>
                    </ul>
                    <div class="iconespourmobile">
                        <div id="menuicones" class="porteuroffset fix-menu" data-verticaloffset="47" data-horizontaloffset="0"> <a href="https://apical.xyz"><img src="https://apical.xyz/medias/commun/Accueil-MenuSecondaire.svg" alt="Accueil" title="Accueil" /></a> <a href="#" class="ouvrirpopupchristiane ouvrirpopuprecherche" data-target="#popuprecherche"><img src="https://apical.xyz/medias/commun/Rechercher-MenuSecondaire.svg" alt="Recherche" title="Rechercher" /></a> <a href="#" class="ouvrirpopupchristiane ouvrirpopupauthentification" data-target="#popupauthentification"><img src="https://apical.xyz/medias/commun/Login-MenuSecondaire.svg" alt="Authentification" title="" /></a> </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="contenuprincipal">
            <hr class="divider">
            <?php 
                /* get_bloginfo permet d'insérer le nom du site de l'utilisateur */
            ?>
            <h1 id="titreh1" class="text-center"><?php echo(get_bloginfo('name'));?></h1>
            <hr class="divider bas">
            <div class="contenu">
                <div id="chapitresformation" data-formation-id="38">
                    <div class="boutonshaut">
                        <div class="float-left"> </div>
                        <div class="float-right"> <a id="developperreduire" href="#" class="btn btn-secondary" role="button" data-developper="Tout développer" data-reduire="Tout réduire">Tout développer</a> </div>
                        <div class="push"></div>
                    </div>
                    <div id="dragchapitres">
                        <div class="card border-bottom-0" id="dragchapitre_2557">
                            <?php
                                /* Appelle de la fonction "lister_postes();"
                                 * -> Me permet d'appeler le contenu de chaque poste via une loop
                                 */
                                lister_postes();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="push"></div>
        </div>
    </div>
    <?php
        /* Appeler "sidebar.php" */
        get_sidebar();
        /* Appeler "footer.php" */
        get_footer();
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://apical.xyz/js/jquery.js?id=6a07da9fae934baf3f749e876bbfdd96"></script>
    <script src="https://apical.xyz/js/bootstrap.js?id=01dce07671c51d0027f56de26689e9b0"></script>
    <script src="https://apical.xyz/js/app.js?id=f287b5ddc55a704da9893905227c6dae"></script>
    <script src="https://apical.xyz/js/all.js?id=8cd35d8a531c89f9a609c79b84ab0535"></script>
    <script>
        $(function () {
            $('.reinitialiserCookiesMenuFormations').click(function (event) {
                event.preventDefault();
                var jqxhr = $.get("https://apical.xyz/reinitialiserCookiesMenuFormations")
                    .done(function (response, textStatus, jqXHR) {
                        $('.consulterecemment').remove();
                        afficherPopupInformation('La liste des dernières formations consultées a été réinitialisée avec succès !');
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        afficherPopupErreur('Un problème empêche la réinitialisation de la liste des dernières formations consultées.');
                    });
            });
        });
    </script>
    <script>
        $(function() {
            // *********************************************************************************************
            // *** Drag'n drop *****************************************************************************
            // *********************************************************************************************
            // todo : faire le drag'n drop pour les fiches.
            $('#dragchapitres').sortable({
                handle: $('.glisser'),
                cursor: 'move',
                update: function(event, ui) {
                    var chapitresNouvelOrdre = $(this).sortable('serialize');    // chaîne au format "dragchapitre[]=10&dragchapitre[]=8&dragchapitre[]=9"
        
                    $.ajax({
                        data: chapitresNouvelOrdre,
                        type: 'POST',
                        url: '/chapitres/reordonnerChapitres'
                    });
                }
            });
            // **************************************************************************************************
            // *** Génération de la liste des fiches de tous les chapitres lorsqu'on clique sur Tout développer *
            // **************************************************************************************************
            $("#chapitresformation #developperreduire").click(function() {
                // s'il y a une balise avec la classe encoursdegeneration dans un panel-body, c'est que la liste complète n'a pas été générée
                // if ($('#chapitresformation .panel-group .encoursdegeneration').length) {   // la classe panel-group n'a pas d'équivalent en Bootstrap 4...
                if ($('#chapitresformation .encoursdegeneration').length) {
                    // retrouve le formation_id
                    var formation_id = $('#chapitresformation').attr('data-formation-id');
                    // génère la liste
                    listeFichesFormationDansPanel(formation_id);
                }
            });
            // *********************************************************************************************
            // *** Génération de la liste des fiches d'un chapitre lorsqu'on clique sur son titre  *********
            // *********************************************************************************************
            // les balises ont été générées par ajax donc pas existantes sur le document.ready
            $(document).on('click', '#chapitresformation .card-header a[data-toggle="collapse"]', function(event) {
                // retrouve le card-body (anciennement panel-body) qui contient le chapitre_id et où la liste sera affichée
                // en remontant au panel puis en redescendant sur le panel-body qui est au même niveau que le panel-heading qui contient le lien
                var $panelbody = $(this).parents('.card:first').find('.card-body:first');
        
                // s'il y a une balise avec la classe encoursdegeneration dans un panel-body, c'est que la liste n'a pas été générée
                if ($panelbody.find('.encoursdegeneration').length) {
                    // génère la liste
                    listeFichesChapitreDansPanel($panelbody);
                }
            }); 
        });  
    </script>
</body>
</html>