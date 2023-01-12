<?php
class VueMenu {
    private $contenu;
    public function __construct() {
        $this->contenu= '<a href="index.php">Home</a>
                         <a href="index.php?module=mod_evenement">Events</a>
                         <a href="index.php?module=mod_association">Associations </a>';
    }
    
    public function completeContenu(){
        if (isset($_SESSION['connexion'])) {
            $this->contenu.='<a href="index.php?module=mod_profile">Mon Profil</a>';
        } else {
            $this->contenu.='<a href="index.php?action=login&module=mod_connexion">S\'identifier</a>';
        }
    }

    public function vueAdmin(){
        $this->contenu.='<a id="shield" href="index.php?module=mod_admin&action=gererAdmin"><i class="fa-solid fa-shield-halved"></i></a>';
    }

    public function getContenue(){
        return $this->contenu;
    }
}
?>