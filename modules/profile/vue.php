<?php
    require_once("controleur.php");
    require_once("./vue_generique.php");
    class VueProfile extends VueGenerique {      
        public function __construct() {
            parent::__construct();
        }   

        public function afficheProfile ($user, $assos, $participation) {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            $imagelien = "img/Users/".htmlspecialchars($user["PP"])."";
            $imagetime = filemtime($imagelien);
            ?> 
            <div class="profile-container">
                <div class="bar">
                    <div class="profile-header">
                        <a class="actionprofile-active" href="index.php?module=mod_profile">Mon compte</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=gerer">Mes associations</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=evenement">Mes participations</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=creer">Créer association</a>
                        <a class="disconnect" href="index.php?module=mod_profile&action=logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                    <div class="profile">
                        <div class="logo">
                            <form id = "form_image" action="index.php?module=mod_profile&action=modifphoto" method="POST" enctype="multipart/form-data">
                                <label for="file">
                                    <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                </label>
                                <input accept="image/*" type="file" id="file" name="photo" onchange="loadFile(event)"/>
                            </form>
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        <p class="name"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    </div>
                    <div class="details">
                        <p><i class="fa-solid fa-hand-fist"></i> Participation <span><?php echo count($participation); ?> </span></p>
                        <p><i class="fa-solid fa-chart-simple"></i> Contribution <span><?php echo count($assos); ?></span></p>        
                    </div>
                </div>
            </div>
            <div class="content-account">
                    <div class="tab-settings">
                        <h3>Mes Réglages</h3>
                        <div class="case">
                            <a class="case-link" href="index.php?module=mod_profile"><i class="fa-solid fa-pen"></i> Modifier profile</a>
                        </div>
                        <div class="case">
                            <a class="case-link" href="index.php?module=mod_profile&action=settingpassword"><i class="fa fa-key text-center mr-1"></i> Mot de passe</a>
                        </div>
                        <div class="case">
                            <a class="case-link" href="index.php?module=mod_profile&action=settingnotif"><i class="fa fa-bell text-center mr-1"></i> Notifications</a>
                        </div>
                        <div class="case">
                        <a class="case-link" href="index.php?module=mod_profile&action=settingdesactive"&token="<?php echo $_SESSION['token']; ?>"><i class="fa-solid fa-lock-open"></i> Désactiver</a>
                        </div>
                    </div>
                    <div class="tab-content">
            <?php
        }

        public function formInfo() {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-account">
                <h3>Informations du compte</h3>
                <form action="index.php?module=mod_profile&action=modifinfo" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="login" class="form-control" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>" required="required" minlength="4" maxlength="16">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="mail" class="form-control" value="<?php echo htmlspecialchars($_SESSION["email"]) ; ?>" required="required" maxlength="100">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            </div>
            </div>
            <?php
        }

        public function formPassword() {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-password">
                <h3>Mets à jour ton mot de passe</h3>
                <form action="index.php?module=mod_profile&action=modifmdp" method="POST">
                    <div class="row">
                        <div class="form-group">
                            <label>Ancien mot de passe</label>
                            <input type="password" name="oldpwd" class="form-control" required="required" minlength="4" maxlength="20">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Nouveau mot de passe</label>
                            <input type="password" name="newpwd" class="form-control" required="required" minlength="4" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label>Confirme mot de passe</label>
                            <input type="password" name="newpwd2" class="form-control" required="required" minlength="4" maxlength="20">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            </div>
            </div>
            <?php
        }

        public function formNotif() {
            ?>
            <div class="setting-notif">
                <h3>Mes notifications</h3>
                <form action="index.php?module=mod_profile&action=settingnotif" method="POST">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification1">
                            <label class="form-check-label" for="notification1">
                                Être averti lorsqu'un événement d'une des associations que vous suivez commence !
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification2" >
                            <label class="form-check-label" for="notification2">
                                Être averti lorsqu'un événement en tendance commence !
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification3" >
                            <label class="form-check-label" for="notification3">
                                Être averti des nouveautés du site web !
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Sauvegarder</button>
                        <button type="reset" class="btn-cancel">Annuler</button>
                    </div>
                </form>
            </div>
            </div>
            </div>
            <?php
        }

        public function formDesactive() {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="setting-desactive">
                <h3>Supprimer mon compte</h3>
                <form action="index.php?module=mod_profile&action=desactive" method="POST">
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="pwd" class="form-control" required="required" minlength="4" maxlength="20">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                            <label class="form-check-label" for="confirmation">
                                Êtes-vous sûr de vouloir supprimer votre compte ?
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-valide">Supprimer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            </div>
            </div>
            <?php
        }

        public function afficheGerer ($user, $assos, $participation, $abonnements) {
            $imagelien = "img/Users/".htmlspecialchars($user["PP"])."";
            $imagetime = filemtime($imagelien);
            ?>
            <div class="profile-container">
                <div class="bar">
                    <div class="profile-header">
                        <a class="actionprofile" href="index.php?module=mod_profile">Mon compte</a>
                        <a class="actionprofile-active" href="index.php?module=mod_profile&action=gerer">Mes associations</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=evenement">Mes participations</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=creer">Créer association</a>
                        <a class="disconnect" href="index.php?module=mod_profile&action=logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                    <div class="profile">
                        <div class="logo">
                            <form id = "form_image" action="index.php?module=mod_profile&action=modifphoto" method="POST" enctype="multipart/form-data">
                                <label for="file">
                                    <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                </label>
                                <input accept="image/*" type="file" id="file" name="photo" onchange="loadFile(event)"/>
                            </form>
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        <p class="name"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    </div>
                    <div class="details">
                        <p><i class="fa-solid fa-hand-fist"></i> Participation <span><?php echo count($participation);?></span></p>
                        <p><i class="fa-solid fa-chart-simple"></i> Contribution <span><?php echo count($assos);?></span></p>        
                    </div>
                </div>
            </div>
            <div class="association-gerer">
                <section class="thumbSection">
                    <h2 class="thumbTitle">Mes Associations</h2>
                    <div class="thumbTiles swiper-container swiper1">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php
                                if (count($assos) == 0) {
                                    echo '<p>Vous n\'avez aucune association.</p></div>';
                                } 
                            ?>
                            <!-- Slides -->
                            <?php
                                foreach($assos as $a) {
                                    $imagelien = "img/Associations/".htmlspecialchars($a["image"])."";
                                    $imagetime = filemtime($imagelien);
                                    ?>
                                    <div class="swiper-slide">
                                        <a class="thumbTiles" href="index.php?module=mod_association&id=<?php echo $a["id"]; ?>">
                                            <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                        </a>
                                        <h1><?php echo htmlspecialchars($a["name"]); ?></h1>
                                    </div>
                                    <?php
                                }       
                            ?>
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-pagination swiper-pagination1"></div>
                        <div class="swiper-button-prev prev-btn1"></div>
                        <div class="swiper-button-next next-btn1"></div>
                    </div>
                </section>
            </div>
            <div class="association-gerer">
                <section class="thumbSection">
                    <h2 class="thumbTitle">Mes Abonnements</h2>
                    <div class="thumbTiles swiper-container swiper2">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php
                                if (count($abonnements) == 0) {
                                    echo '<p>Vous n\'avez aucun abonnements.</p></div>';
                                } 
                            ?>
                            <!-- Slides -->
                            <?php
                                foreach($abonnements as $a) {
                                    $imagelien = "img/Associations/".htmlspecialchars($a["image"])."";
                                    $imagetime = filemtime($imagelien);
                                    ?>
                                    <div class="swiper-slide">
                                        <a class="thumbTiles" href="index.php?module=mod_association&id=<?php echo $a["id"]; ?>">
                                            <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                        </a>
                                        <h1><?php echo htmlspecialchars($a["name"]); ?></h1>
                                    </div>
                                    <?php
                                }       
                            ?>
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev prev-btn2"></div>
                        <div class="swiper-button-next next-btn2"></div>
                        <div class="swiper-pagination swiper-pagination2"></div>
                    </div>
                </section>
            </div>
            <script>
                var mySwiper = new Swiper('.swiper1', {
                    // Optional parameters
                    pagination: '.swiper-pagination1',
                    paginationClickable: true,
                    spaceBetween: 4,
                    slidesPerView: 4,
                    freeMode: true,
                    infinite: true,
                    loopAdditionalSlides: 5,
                    speed: 300,
                    mobileFirst:true,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.next-btn1',
                        prevEl: '.prev-btn1',
                    },
                    breakpoints: {
                        // when window width is >= 320px
                        320: {
                        slidesPerView: 3,
                        spaceBetween: 4
                        },
                        // when window width is >= 480px
                        480: {
                        slidesPerView: 3,
                        spaceBetween: 4
                        },
                        // when window width is >= 640px
                        640: {
                        slidesPerView: 4,
                        spaceBetween: 4
                        }
                    }
                })
                var mySwiper = new Swiper('.swiper2', {
                    // Optional parameters
                    pagination: '.swiper-pagination2',
                    paginationClickable: true,
                    spaceBetween: 4,
                    slidesPerView: 4,
                    freeMode: true,
                    infinite: true,
                    loopAdditionalSlides: 5,
                    speed: 300,
                    mobileFirst:true,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.next-btn2',
                        prevEl: '.prev-btn2',
                    },
                    breakpoints: {
                        // when window width is >= 320px
                        320: {
                        slidesPerView: 2,
                        spaceBetween: 4
                        },
                        // when window width is >= 480px
                        480: {
                        slidesPerView: 2,
                        spaceBetween: 4
                        },
                        // when window width is >= 640px
                        640: {
                        slidesPerView: 4,
                        spaceBetween: 4
                        }
                    }
                })
            </script>
            <?php
        }

        public function afficheCreer ($user, $assos,$participation) {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();    
            $imagelien = "img/Users/".htmlspecialchars($user["PP"])."";
            $imagetime = filemtime($imagelien);
            ?>
            <div class="profile-container">
                <div class="bar">
                    <div class="profile-header">
                        <a class="actionprofile" href="index.php?module=mod_profile">Mon compte</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=gerer">Mes associations</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=evenement">Mes participations</a>
                        <a class="actionprofile-active" href="index.php?module=mod_profile&action=creer">Créer association</a>
                        <a class="disconnect" href="index.php?module=mod_profile&action=logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                    <div class="profile">
                        <div class="logo">
                            <form id = "form_image" action="index.php?module=mod_profile&action=modifphoto" method="POST" enctype="multipart/form-data">
                                <label for="file">
                                    <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                </label>
                                <input accept="image/*" type="file" id="file" name="photo" onchange="loadFile(event)"/>
                            </form>
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        <p class="name"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    </div>
                    <div class="details">
                        <p><i class="fa-solid fa-hand-fist"></i> Participation <span><?php echo count($participation);?></span></p>
                        <p><i class="fa-solid fa-chart-simple"></i> Contribution <span><?php echo count($assos);?></span></p>        
                    </div>
                </div>
            </div>
            <div class="association-add">
                <div class="association-img">
                    <img src="img/background-form.jpeg">
                </div>
                <div class="association-form">
                    <form class="formadd" action="index.php?module=mod_association&action=ajoutassociation" method="POST" enctype="multipart/form-data">
                        <div class="typewriter">
                            <h2>  
                                <a href="" class="typewrite" data-period="2000" data-type='[ "Crée une association.", "Organise des événements.", "Lance des cagnottes.", "Tout ça, Maintenant !" ]'>
                                    <span class="wrap"></span>
                                </a>
                            </h2>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="mail" required="required" maxlength="100" />
                            </div>
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="name" required="required" minlength="4" maxlength="20"/>
                            </div>
                            <div class="form-group">
                                <label>Numero RNA</label>
                                <input type="text" name="RNA" required="required" pattern="w[0-9]{9}"/>
                            </div>  
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="description" type="text" name="desc" required="required" minlength="6" maxlength="500"></textarea>
                            </div>
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="" value="Valider" />
                        </div>
                        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                    </form>
                    <div id="particles-js"></div>
                </div>
            </div>
            <script src="js/particles.js"></script>
            <script src="js/app.js"></script>
            <script src="js/typewrite.js"></script>
            <?php
        }


        public function afficheEvenement($user, $assos,$participation){
            $imagelien = "img/Users/".htmlspecialchars($user["PP"])."";
            $imagetime = filemtime($imagelien);
            ?>
            <div class="profile-container">
                <div class="bar">
                    <div class="profile-header">
                        <a class="actionprofile" href="index.php?module=mod_profile">Mon compte</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=gerer">Mes associations</a>
                        <a class="actionprofile-active" href="index.php?module=mod_profile&action=evenement">Mes participations</a>
                        <a class="actionprofile" href="index.php?module=mod_profile&action=creer">Créer association</a>
                        <a class="disconnect" href="index.php?module=mod_profile&action=logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                    <div class="profile">
                        <div class="logo">
                            <form id = "form_image" action="index.php?module=mod_profile&action=modifphoto" method="POST" enctype="multipart/form-data">
                                <label for="file">
                                    <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                </label>
                                <input accept="image/*" type="file" id="file" name="photo" onchange="loadFile(event)"/>
                            </form>
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        <p class="name"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                    </div>
                    <div class="details">
                        <p><i class="fa-solid fa-hand-fist"></i> Participation <span><?php echo count($participation)?></span></p>
                        <p><i class="fa-solid fa-chart-simple"></i> Contribution <span><?php echo count($assos)?></span></p>        
                    </div>
                </div>
            </div>
            <div class="association-gerer">
                <section class="thumbSection">
                    <h2 class="thumbTitle">Mes Participations</h2>
                    <div class="thumbTiles swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php
                                if (count($participation) == 0) {
                                    echo '<p>Vous n\'avez participez à aucun événement.</p></div>';
                                } 
                            ?>
                            <!-- Slides -->
                            <?php
                                foreach($participation as $p) {
                                    $imagelien = "img/Evenements/".htmlspecialchars($p["image"])."";
                                    $imagetime = filemtime($imagelien);
                                    ?>
                                    <div class="swiper-slide">
                                        <a class="thumbTiles" href="index.php?module=mod_evenement&id=<?php echo $p["id"]; ?>">
                                            <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                        </a>
                                        <h1><?php echo htmlspecialchars($p["name"]); ?></h1>
                                    </div>
                                    <?php
                                }       
                            ?>
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev prev-btn1"></div>
                        <div class="swiper-button-next next-btn1"></div>
                    </div>
                </section>
            </div>
            <script>
                var mySwiper = new Swiper('.swiper-container', {
                    // Optional parameters
                    spaceBetween: 4,
                    slidesPerView: 4,
                    freeMode: true,
                    infinite: true,
                    loopAdditionalSlides: 5,
                    speed: 300,
                    mobileFirst:true,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.next-btn1',
                        prevEl: '.prev-btn1',
                    },
                    breakpoints: {
                        // when window width is >= 320px
                        320: {
                        slidesPerView: 2,
                        spaceBetween: 4
                        },
                        // when window width is >= 480px
                        480: {
                        slidesPerView: 2,
                        spaceBetween: 4
                        },
                        // when window width is >= 640px
                        640: {
                        slidesPerView: 4,
                        spaceBetween: 4
                        }
                    }
                })
            </script>


            <?php
        }


    }
?>
