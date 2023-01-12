<?php
    require_once("controleur.php");
    require_once("./vue_generique.php");
    class VueConnexion extends VueGenerique {      
        public function __construct() {
            parent::__construct();
        }   

        public function form_connexion () {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();   
            ?>         
            <div class="sign-form animate__animated animate__zoomIn">
                <form action="index.php?module=mod_connexion&action=connexion" method="POST">
                    <h2>Connectez-vous!</h2>
                    <div class="inputBox">
                        <input placeholder=" " type="text" name="login" required="required" minlength="4" maxlength="16"/>
                        <span>Username</span>
                    </div>
                    <div class="inputBox">
                        <input  placeholder=" "type="password" name="password" required="required" minlength="4" maxlength="20"/>
                        <span>Password</span>
                    </div>
                    <div class="inputBox">
                        <input  placeholder=" "type="submit" name="" value="Sign In" />
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/></form>
                </form>
                <a id="redirection" href="index.php?action=register&module=mod_connexion">Votre première fois ? Inscrivez-vous !</a><br>
            </div>
            <?php
        }

        public function form_inscription () {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();
            ?>
            <div class="sign-form animate__animated animate__zoomIn">
                <form action="index.php?module=mod_connexion&action=ajout" method="POST">
                    <h2>Inscrivez-vous!</h2>
                    <div class="inputBox">
                        <input placeholder=" " type="email" name="mail" required="required" maxlength="100"/>
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <input placeholder=" "type="text" name="login" required="required" minlength="4"  maxlength="16" />
                        <span>Username</span>
                    </div>
                    <div class="inputBox">
                        <input placeholder=" " type="password" name="password" required="required" minlength="4" maxlength="20"/>
                        <span>Password</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="" value="Sign Up" />
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/></form>
                </form>
                <a id="redirection" href="index.php?action=login&module=mod_connexion">Déjà inscrit ? Connectez-vous !</a><br>
            </div>
            <?php
        }
    }
?>
