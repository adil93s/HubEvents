<?php
    require_once("controleur.php");
    require_once("./vue_generique.php");
    class VueAdmin extends VueGenerique {      
        public function __construct() {
            parent::__construct();
        }   
        public function gererAdmin(){
        ?>
        <a href="index.php?module=mod_admin&action=gererUtil">Voir les Utilisateurs </a><br>
        <a href="index.php?module=mod_admin&action=gererAsso">Voir les Associations </a><br>
        <a href="index.php?module=mod_admin&action=gererEvent">Voir les Events </a><br>
        <a href="index.php?module=mod_admin&action=gererFAQ">Voir FAQ </a><br>
        <a href="index.php?module=mod_admin&action=gererSignalement">Voir Signalement </a><br>
        <?php
        }

        public function gererUtil($users){
            
            foreach($users as $u) {
                $imagelien = "img/Users/".htmlspecialchars($u["PP"])."";
                $imagetime = filemtime($imagelien);
                ?>
                <div class="user_edit">
                    <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                    <a href="index.php?module=mod_admin&id=<?php echo $u["id"]; ?>"></a><br>
                    <p> Nom d'utilisateur : <?php echo htmlspecialchars($u['login']); ?></p>
                    <a href="index.php?module=mod_admin&action=modifU&id=<?php echo $u["id"]; ?>">Modifier</a>
                    <a href="index.php?module=mod_admin&action=formsupp&id=<?php echo $u["id"]; ?>">Bannir</a>
                </div>
                <?php
            }       
        }

        public function modifU($info){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-account">
                <h3>Informations du compte</h3>
                <form action="index.php?module=mod_admin&action=modifinfo&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="login" class="form-control" value="<?php echo htmlspecialchars($info['login']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="mail" class="form-control" value="<?php echo htmlspecialchars($info['mail']); ?>" required="required">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            <?php
        }
    
        public function suppU(){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <form action="index.php?module=mod_admin&action=suppU&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                            <label class="form-check-label" for="confirmation">
                                Êtes-vous sûr de vouloir supprimer ce compte ?
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Supprimer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            <?php
        }

        public function gererAsso($asso){
            foreach($asso as $a) {
                ?>
                <div class="user_edit">
                <img src="img/Associations/<?php echo htmlspecialchars($a["image"]); ?>">
                    <a href="index.php?module=mod_admin&id=<?php echo $a["id"]; ?>"></a><br>
                    <p> Association : <?php echo htmlspecialchars($a['name']); ?></p>
                    <a href="index.php?module=mod_admin&action=modifA&id=<?php echo $a["id"]; ?>">Modifier</a>
                    <a href="index.php?module=mod_admin&action=formsuppA&id=<?php echo $a["id"]; ?>">Supprimer</a>
                </div>
                <?php
            }       
        }

        public function modifA($infoA){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-account">
                <h3>Informations de l'association</h3>
                <form action="index.php?module=mod_admin&action=modifinfoA&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($infoA['description']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="mail" class="form-control" value="<?php echo htmlspecialchars($infoA['mail']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Adresse</label>
                            <input type="text" name="adresse" class="form-control" value="<?php echo htmlspecialchars($infoA['adresse']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Categorie</label>
                            <input type="text" name="categorie" class="form-control" value="<?php echo htmlspecialchars($infoA['categorie']); ?>" required="required">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            <?php
        }
        public function suppA(){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <form action="index.php?module=mod_admin&action=suppA&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                            <label class="form-check-label" for="confirmation">
                                Êtes-vous sûr de vouloir supprimer cette association ?
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Supprimer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            <?php
        }
        public function gererEvent($event){
            foreach($event as $a) {
                ?>
                <div class="user_edit">
                <img src="img/evenements/<?php echo htmlspecialchars($a["image"]); ?>">
                    <a href="index.php?module=mod_admin&id=<?php echo $a["id"]; ?>"></a><br>
                    <p> Evènement : <?php echo htmlspecialchars($a['name']); ?></p>
                    <a href="index.php?module=mod_admin&action=modifE&id=<?php echo $a["id"]; ?>">Modifier</a>
                    <a href="index.php?module=mod_admin&action=formsuppE&id=<?php echo $a["id"]; ?>">Supprimer</a>
                </div>
                <?php
            }       
        }
        public function modifE($infoE){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-account">
                <h3>Informations de l'event</h3>
                <form action="index.php?module=mod_admin&action=modifinfoE&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($infoE['name']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($infoE['description']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" value="<?php echo htmlspecialchars($infoE['type']); ?>" required="required">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            <?php
        }

        public function suppE(){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <form action="index.php?module=mod_admin&action=suppE&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                            <label class="form-check-label" for="confirmation">
                                Êtes-vous sûr de vouloir supprimer cette event ?
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Supprimer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            <?php
        }

        public function gererFAQ($faq){
            ?>
            <a href="index.php?module=mod_admin&action=formAdd">Ajouter</a>
            <?php
            foreach($faq as $a) {
                ?>
                <div class="user_edit">
                    <a href="index.php?module=mod_admin&id=<?php echo $a["id"]; ?>"></a><br>
                    <p> Question : <?php echo htmlspecialchars($a['question']); ?></p>
                    <p> Réponse : <?php echo htmlspecialchars($a['reponse']); ?></p>
                    <a href="index.php?module=mod_admin&action=modifFAQ&id=<?php echo htmlspecialchars($a["id"]); ?>">Modifier</a>
                    <a href="index.php?module=mod_admin&action=formsuppFAQ&id=<?php echo htmlspecialchars($a["id"]); ?>">Supprimer</a>
                </div>
                <?php
            }  
        }

        public function modifFAQ($infoF){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-account">
                <h3>Informations FAQ</h3>
                <form action="index.php?module=mod_admin&action=FAQ&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="question" class="form-control" value="<?php echo htmlspecialchars($infoF['question']); ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="reponse" class="form-control" value="<?php echo htmlspecialchars($infoF['reponse']); ?>" required="required">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            <?php  
        }
        public function formaddFAQ(){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
        ?>
        <div class="setting-account">
            <h3>Add FAQ</h3>
            <form action="index.php?module=mod_admin&action=addFAQ" method="POST">
                <div class="form-group">
                    <label>Question</label>
                    <input type="text" name="question" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <label>Réponse</label>
                    <input type="text" name="reponse" class="form-control" required="required">
                </div>
                <div>
                    <button type="submit" class="btn-valide">Sauvegarder</button>
                    <button type="reset" class="btn-cancel">Annuler</button>
                </div>
                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
            </form>
        </div>
        <?php
        }

        public function formsuppFAQ(){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <form action="index.php?module=mod_admin&action=suppFAQ&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                            <label class="form-check-label" for="confirmation">
                                Êtes-vous sûr de vouloir supprimer cet FAQ ?
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Supprimer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            <?php
        }
        
        public function gererSignalement($signalement){
            ?>
            <?php
            foreach($signalement as $a) {
                ?>
                <div class="user_edit">
                    <a href="index.php?module=mod_admin&id=<?php echo $a["id"]; ?>"></a><br>
                    <p> Motif : <?php echo htmlspecialchars($a['raison']); ?></p>
                    <p> Event : <?php echo htmlspecialchars($a['idEvent']); ?></p>
                    <p> Signaler par : <?php echo htmlspecialchars($a['idUser']); ?></p>
                    <a href="index.php?module=mod_admin&action=formsuppS&id=<?php echo $a["id"]; ?>">Supprimer</a>
                </div>
                <?php
            }  
        }

        public function formsuppS(){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <form action="index.php?module=mod_admin&action=suppS&id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                            <label class="form-check-label" for="confirmation">
                                Êtes-vous sûr de vouloir supprimer ce Signalement?
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Supprimer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            <?php
        }
    }
?>