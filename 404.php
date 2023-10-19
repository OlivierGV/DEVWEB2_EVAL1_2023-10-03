<?php
    /* Appeler header
     * -> Le haut de la page
     */
    get_header();

    /* Afficher une erreur 404
    */
    echo("<h1> Erreur 404 </h1>");

    /* Appeler la sidebar
    */
    get_sidebar();
    
    /* Appeler footer
     * -> Le fin de la page
     */
    get_footer();
?>