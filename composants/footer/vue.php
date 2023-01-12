<?php
class VueFooter {
    private $contenu;
    public function __construct() {
        $this->contenu= '<div class="footer-top">
                            <img class="hublogo" src="img/logo.png" alt="logo"/>
                            <h1>Participe, Soutien, Aide Les Associations.</h1>
                         </div>
                         <div class="footer-bottom">
                            <div id="footer-left">
                                <h2>Documents Légaux</h2>
                                <a href="index.php?module=mod_footer&action=politique">Politique de confidentialite</a>
                                <a href="index.php?module=mod_footer&action=mention">Mentions legales</a>
                                <a href="index.php?module=mod_footer&action=CGU">Conditions generales</a>
                            </div>
                            <div id="footer-middle">
                                <h2>En Savoir +</h2>
                                <a href="index.php?module=mod_footer&action=info">Qui sommes-nous</a>
                                <a href="index.php?module=mod_footer&action=afficherfaq">FAQ</a>      
                            </div>
                            <div id="footer-right">
                                <h2>Support</h2>
                                <a href="mailto:hubevents@gmail.com">Nous contacter</a>
                                <a href="index.php">Nos reseaux</a>
                            </div>
                         </div>
                         <script>
                            let searchParams = new URLSearchParams(window.location.search);
                            if (searchParams.get("module") == "mod_evenement" && searchParams.has("id") && !searchParams.has("action")) {
                                $(".hublogo").attr("src","img/logo2.png");
                            }
                         </script>';
    }
    
    public function completeContenu(){
    }

    public function getContenue(){
        return $this->contenu;
    }
}
?>