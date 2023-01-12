<?php
    require_once("controleur.php");
    require_once("./vue_generique.php");

    class VueEvent extends VueGenerique {
        public function __construct() {
            parent::__construct();
        }

        public function afficheEvenement($event, $association, $participant) {
            $imagelien = "img/Evenements/".htmlspecialchars($event["image"])."";
            $imagetime = filemtime($imagelien);
            ?>
            <link href="css/evenement.css" rel="stylesheet" />
            <div class="container-event">
                <div class="background-image animate__animated animate__zoomIn">
                    <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                    <div class="shadow-img"></div>
                </div>
                <div class="event-detail animate__animated animate__fadeInLeft">
                    <div>
                        <h6>Statut</h6>
                        <span><?php echo $event["statut"]; ?></span>
                    </div> 
                    <div>
                        <h6>Types</h6>
                        <span><?php echo $event["type"]; ?></span>
                    </div> 
                    <div>
                        <h6>Participants</h6>
                        <span><?php echo count($participant)?></span>
                    </div> 
                </div>
                <div class="event-content">
                    <div class="title animate__animated animate__zoomIn">
                        <h1><?php echo $event["name"]; ?></h1>
                    </div>
                    <div class="event-main">
                        <div class="informations animate__animated animate__animated animate__fadeInUp">
                            <div>
                                <h6>Organisateur:</h6>
                                <a href="index.php?module=mod_association&id=<?php echo $association["id"]; ?>"><span><?php echo htmlspecialchars($association["name"]); ?></span></a>
                            </div>
                            <div>
                                <h6>Durée:</h6>
                                <span id="duree"></span>
                            </div>
                        </div>
                        <div class="description animate__animated animate__fadeInUp">
                            <span> <?php echo $event["description"];?></span>
                        </div>
                    </div>
                    <div class="event-start animate__animated animate__fadeInUp">
                        <?php if ($event["statut"] == "en-cours") {?>
                            <span>Compte à rebours avant la fin</span>
                            <h2 id="countDate"></h2>
                            <?php if(isset($_SESSION["connexion"])){
                                    if(!in_array(array("idUsers"=> $_SESSION["connexion"],$_SESSION["connexion"]), $participant)) {
                                        ?>                                        
                                        <form action="index.php?module=mod_evenement&action=participer&id=<?php echo $event["id"]; ?>" method="POST">
                                            <div class="button-container">
                                                <span class="mas">LET'S GO</span>
                                                <button type="submit" name="Hover">PARTICIPER</button>
                                            </div>
                                        </form>
                                        <a href="index.php?module=mod_evenement&action=signalement&id=<?php echo $event["id"]; ?>">
                                            <div class="button-container-signaler">
                                                <button type="submit" name="Hover"><i class="fa-regular fa-flag"></i> Signaler</button>
                                            </div>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <form action="index.php?module=mod_evenement&action=annuler&id=<?php echo $event["id"]; ?>" method="POST">
                                            <div class="button-container">
                                                <span class="mas">CONFIRMER</span>
                                                <button type="submit" name="Hover">NE PLUS PARTICIPER</button>
                                            </div>
                                        </form>
                                        <a href="index.php?module=mod_evenement&action=signalement&id=<?php echo $event["id"]; ?>">
                                            <div class="button-container-signaler">
                                                <button type="submit" name="Hover"><i class="fa-regular fa-flag"></i> Signaler</button>
                                            </div>
                                        </a>
                                        <?php
                                    }       
                                } else {  
                                    ?>
                                    <form action="index.php?module=mod_connexion&action=login" method="POST">
                                        <div class="button-container">
                                            <span class="mas">LET'S GO</span>
                                            <button type="submit" name="Hover">PARTICIPE</button>
                                        </div>
                                    </form>
                                    <a href="index.php?module=mod_connexion&action=login">
                                            <div class="button-container-signaler">
                                                <button type="submit" name="Hover"><i class="fa-regular fa-flag"></i> Signaler</button>
                                            </div>
                                    </a>
                                    <?php 
                                }
                            }?>
                        <input type="hidden" id="date-start" value="<?php echo $event["dateStart"]?>"/>
                        <input type="hidden" id="date-end" value="<?php echo $event["dateEnd"]?>"/>
                    </div>
                </div>
                <script>     
                    const countText = document.getElementById("countDate");
                    const valueDateEnd = document.getElementById("date-end").value.toString();
                    var date = valueDateEnd.split(" ")[0];
                    date = date.split("-");
                    var time = valueDateEnd.split(" ")[1];
                    time = time.split(":");

                    function getChrono() {
                        const now = new Date().getTime();
                        const countdownDate = new Date(date[0], date[1] - 1, date[2], time[0], time[1], time[2]).getTime();
                        const distanceBase = countdownDate - now;

                        const days = Math.floor(distanceBase / (1000 * 60 * 60 * 24));
                        const hours = Math.floor(distanceBase % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                        const minutes = Math.floor(distanceBase % (1000 * 60 * 60) / (1000 * 60));
                        const seconds = Math.floor(distanceBase % (1000 * 60)  / 1000);
                        if (countText !== null) {
                            countText.innerText = `${days}j ${hours}h ${minutes}m ${seconds}s`;
                        }
                    }
                    getChrono();
                    const countDownInterval = setInterval(() => {
                        getChrono();
                    }, 1000);


                    const dureText = document.getElementById("duree");
                    const valueDateStart = document.getElementById("date-start").value.toString();

                    var date2 = valueDateStart.split(" ")[0];
                    date2 = date2.split("-");
                    const dateEnd = new Date(date[0], date[1] - 1, date[2]).getTime();
                    const dateStart = new Date(date2[0], date2[1] - 1, date2[2]).getTime();
                    const duree = dateEnd - dateStart;
                    const dureeDays = Math.floor(duree / (1000 * 60 * 60 * 24));
                    if (dureeDays == 0) {
                        dureText.innerText = `Moins d'un jour`;
                    } else if (dureeDays == 1) {
                        dureText.innerText = `1 jour`;
                    } else {
                        dureText.innerText = `${dureeDays} jours`;
                    }
                </script>
            </div>
            <?php
        }

        public function signalement($event){
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time(); 
            ?>
            <div class="sign-form">
                <form action="index.php?module=mod_evenement&action=signaler&id=<?php echo $event["id"]; ?>" method="POST">
                    <label class="main__input-label">Quel est la raison de votre signalement ?</label>
                    <textarea class="main__input description" name="description" id="description" type="text" required="required" minlength="4" maxlength="500"></textarea>
                    <div>
                    <button type="submit"  class="btn btn-follow">Envoyer</button>
                    </div>
                    <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                </form>
            </div>
            <?php
        }
 
        public function afficherTousLesEvents($events){
            ?>
            <link href="css/reset.css" rel="stylesheet" />
            <link href="css/filter.css" rel="stylesheet" />
            <div class="cd-header">
                <div class="animate__animated animate__fadeInDown">
                    <div class="container">
                        <div class="glitch" data-text="Participe à un événement">Participe à un événement</div>
                        <div class="glow">Participe à un événement</div>
                    </div>
                </div>
                <div class="animate__animated animate__fadeInUp">
                    <div class="py-2">
                        <p class="subtitle s2">N'attend plus participe maintenant !</p>
                    </div>
                </div>
                <div class="scanlines"></div>
            </div>

            <div class="cd-main-content">
                <div class="cd-tab-filter-wrapper">
                    <div class="cd-tab-filter">
                        <ul class="cd-filters">
                            <li class="placeholder"> 
                                <a data-type="all" href="#0">Tous</a> 
                            </li> 
                            <li class="filter"><a class="selected" href="" data-type="all">Tous</a></li>
                            <li class="filter" data-filter=".Populaire"><a href="#0" data-type="En Tendance">En Tendance</a></li>
                            <li class="filter" data-filter=".Recent"><a href="#0" data-type="Derniers Ajouts">Derniers Ajouts</a></li>
                        </ul>
                    </div> 
                </div> 

                <section class="cd-gallery">
                    <ul>
                        <?php
                            foreach($events as $e){
                            $imagelien = "img/Evenements/".htmlspecialchars($e["image"])."";
                            $imagetime = filemtime($imagelien);
                                ?>                  
                                <li class="mix <?php echo $e["name"]; ?> <?php echo $e["type"]; ?> <?php echo $e["statut"]; ?> <?php echo $e["populaire"]; ?> <?php echo $e["recent"]; ?>">
                                    <a href="index.php?module=mod_evenement&id=<?php echo $e["id"]; ?>">
                                        <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>" alt="Image">
                                        <span><?php echo htmlspecialchars($e["name"]); ?></span></a>
                                    </a>
                                </li>
                                <?php
                            }
                        ?>
                        <li class="gap"></li>
                        <li class="gap"></li>
                        <li class="gap"></li>
                    </ul>
                    <div class="cd-fail-message">Aucun résultat trouvé</div>
                </section> 
                <div class="cd-filter">
                    <form>
                        <div class="cd-filter-block">
                            <h4>Recherche</h4>
                            
                            <div class="cd-filter-content">
                                <input type="search" placeholder="recherche un evenement...">
                            </div> 
                        </div> 

                        <div class="cd-filter-block">
                            <h4>Types</h4>

                            <ul class="cd-filter-content cd-filters list">
                                <li>
                                    <input class="filter" data-filter=".Jeux-Video" type="checkbox" id="checkbox1">
                                    <label class="checkbox-label" for="checkbox1">Jeux Video</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Culturel" type="checkbox" id="checkbox2">
                                    <label class="checkbox-label" for="checkbox2">Culturel</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Humanitaire" type="checkbox" id="checkbox3">
                                    <label class="checkbox-label" for="checkbox3">Humanitaire</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Sportif" type="checkbox" id="checkbox4">
                                    <label class="checkbox-label" for="checkbox4">Sportif</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Ecologoie" type="checkbox" id="checkbox5">
                                    <label class="checkbox-label" for="checkbox5">Ecologoie</label>
                                </li>
                            </ul> 
                        </div> 

                        

                        <div class="cd-filter-block">
                            <h4>Statut</h4>

                            <ul class="cd-filter-content cd-filters list">
                                <li>
                                    <input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>
                                    <label class="radio-label" for="radio1">Tous</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".prochainement" type="radio" name="radioButton" id="radio2">
                                    <label class="radio-label" for="radio2">Prochainement</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".en-cours" type="radio" name="radioButton" id="radio3">
                                    <label class="radio-label" for="radio3">En cours</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".terminé" type="radio" name="radioButton" id="radio4">
                                    <label class="radio-label" for="radio4">Terminé</label>
                                </li>
                            </ul> 
                        </div> 
                    </form>

                    <a href="#0" class="cd-close"><i class="fa-solid fa-xmark"></i></a>
                </div> <!-- cd-filter -->
                <a href="#0" class="cd-filter-trigger"> Filtres</a>
            </div>
            <script src="js/jquery.mixitup.min.js"></script>
            <script src="js/filtre.js"></script> 
        <?php
        }
    }
?>