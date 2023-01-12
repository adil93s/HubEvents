<?php
    require_once("controleur.php");
    require_once("./vue_generique.php");
    class VueAssociation extends VueGenerique {      
        public function __construct() {
            parent::__construct();
        }   

        public function afficheGerer($asso, $user){
            ?>
            <div class="side-bar">
                <ul>
                    <li>
                        <a>
                            <span class="icon"></span>
                            <span class="title">Bonjour, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href = "index.php?module=mod_association&action=informations&id=<?php echo $asso["id"] ?>">
                            <span class="icon"><i class="fa-solid fa-gear"></i></span>
                            <span class="title">Réglages</span>
                        </a>
                    </li>                    
                    <li>
                        <a href = "index.php?module=mod_association&action=evenement&id=<?php echo $asso["id"] ?>">
                            <span class="icon"><i class="fa-solid fa-bolt"></i></span>
                            <span class="title">Événements</span>
                        </a>
                    </li>                    
                    <li>
                        <form id = "form_image" action="index.php?module=mod_association&action=editbanniere&id=<?php echo $asso["id"] ?>" method="POST" enctype="multipart/form-data">
                            <label for="file">
                                <span class="icon"><i class="fa-regular fa-image"></i></span>
                                <span class="title">Banniere</span>
                            </label>
                            <input accept="image/*" type="file" id="file" name="photoassociation" onchange="loadFileAssociation(event)"/>
                        </form>
                    </li>
                </ul>
                <div class="toggle"><span>Connecté en tant que <?php echo $user["role"]; ?></span></div>
            </div>
            <script>
                let navigation = document.querySelector('.side-bar');
                let toggle = document.querySelector('.toggle');
                toggle.onclick = function() {
                    navigation.classList.toggle('active');
                }
            </script>
            <?php
        }

        public function afficheAssociation($asso, $membre, $events, $abonnes) {
            $imagelien = "img/Associations/".htmlspecialchars($asso["image"])."";
            $imagetime = filemtime($imagelien);
            ?>
            <link href="css/association.css" rel="stylesheet" />
            <div class="container-fluid pt-5">
                <div class="row removable">
                    <div class="col-xl-7">
                        <div class="card card-profile p-3 mb-4 animate__animated animate__fadeInLeft">
                            <div class="min-height-200 border-radius-xl page-header">
                                <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                            </div>
                            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                                <div class="row gx-4">
                                    <div class="col-auto">
                                        <div class="avatar avatar-xl position-relative">
                                            <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                        </div>
                                    </div>
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h5 class="mb-1">
                                                <?php echo htmlspecialchars($asso["name"]); ?>
                                            </h5>
                                            <p class="mb-0 font-weight-bold text-sm">
                                                <?php echo htmlspecialchars($asso["signature"]) ; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto ms-auto mt-3">
                                        <div class="d-flex justify-content-center mt-4">
                                        <?php
                                        if(isset($_SESSION["connexion"])){
                                            if(!in_array(array("idUsers"=> $_SESSION["connexion"],$_SESSION["connexion"]), $abonnes)){
                                                ?><a href="index.php?module=mod_association&action=suivre&id=<?php echo $asso["id"]; ?>" class="btn btn-follow"> S'abonner </a><?php       
                                            } else {
                                                ?><a href="index.php?module=mod_association&action=nePlusSuivre&id=<?php echo $asso["id"]; ?>" class="btn btn-unfollow"> Se désabonner </a><?php       
                                            }            
                                        } else {    
                                            ?><a href="index.php?module=mod_connexion&action=login" class="btn btn-follow"> S'abonner </a><?php       
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-11 mx-auto">
                                    <h5 class="mb-2">À propos de nous</h5>
                                    <p>
                                        <?php echo nl2br(htmlspecialchars($asso["description"])); ?>
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="card mb-4 animate__animated animate__fadeInRight">
                            <div class="card-header pb-0">
                                <h6>Nos événements</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Evenement</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Participants</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Statut</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Progression</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if (count($events) == 0) {
                                                echo '<tr><td>Aucun événements organisé.</td></tr>';
                                            } 
                                        ?>
                                        <!-- Slides -->
                                        <?php
                                            foreach($events as $e) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div>
                                                                <img src="img/Evenements/<?php echo htmlspecialchars($e["image"]); ?>" class="avatar avatar-sm rounded-circle me-2">
                                                            </div>
                                                            <div class="my-auto">
                                                                <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($e["name"]); ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0"><?php echo $e["participants"];?></p>
                                                    </td>
                                                    <td>
                                                        <span class="text-xs font-weight-bold"><?php echo $e["statut"]; ?></span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span class="me-2 text-xs font-weight-bold"><?php echo $e["progression"]; ?>%</span>
                                                            <div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="<?php echo $e["progression"]; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $e["progression"]; ?>%;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="index.php?module=mod_evenement&id=<?php echo $e["id"]; ?>" class="btn btn-link text-secondary mb-0">
                                                            <span>Voir +</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }       
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="card mb-4 animate__animated animate__fadeInRight">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Contributeurs</h6>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-group">
                                    <?php
                                        foreach($membre as $m) {
                                            ?>
                                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                                <div class="avatar me-3">
                                                    <img src="img/Users/<?php echo htmlspecialchars($m["PP"]); ?>" alt="kal" class="border-radius-lg shadow">
                                                </div>
                                                <div class="d-flex align-items-start flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo htmlspecialchars($m["login"]) ?></h6>
                                                    <p class="mb-0 text-xs"><?php echo $m["role"] ?></p>
                                                </div>
                                                <a class="btn btn-link btn-sm ms-auto" href="mailto:<?php echo htmlspecialchars($m["mail"]); ?>">Send message</a>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>


                        <div class="card mb-5 animate__animated animate__fadeInLeft">
                            <div class="card-header pb-0 p-3">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Plus de détails</h6>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-envelope opacity-7" aria-hidden="true"></i>
                                    <div class="ms-3">
                                        <h6 class="mb-0">Email</h6>
                                        <span class="text-xs mb-0 text-primary"><?php echo htmlspecialchars($asso["mail"]); ?></span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mt-4">
                                    <i class="fa-solid fa-location-dot opacity-7" aria-hidden="true"></i>
                                    <div class="ms-3">
                                        <h6 class="mb-0">Siège Social</h6>
                                        <span class="text-xs mb-0 text-primary"><?php echo htmlspecialchars($asso["adresse"]); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mt-4">
                                    <i class="fa-solid fa-bars-staggered opacity-7" aria-hidden="true"></i>
                                    <div class="ms-3">
                                        <h6 class="mb-0">Catégories</h6>
                                        <span class="text-xs mb-0 text-primary"><?php echo $asso["categorie"]; ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mt-4">
                                    <i class="fa-solid fa-heart-circle-check opacity-7" aria-hidden="true"></i>
                                    <div class="ms-3">
                                        <h6 class="mb-0">Numéro RNA</h6>
                                        <span class="text-xs mb-0 text-primary"><?php echo htmlspecialchars($asso["numeroRNA"]); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    

        public function formulaireInformations($asso, $membre) {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();
            $imagelien = "img/Associations/".$asso["image"]."";
            $imagetime = filemtime($imagelien);
            ?>
            <div class="setting-association">
                <div class="sidebar">
                    <div class="sidebar__header">
                        <img class="sidebar__avatar" src="<?php echo ("".$imagelien."?".$imagetime.""); ?>"/>
                        <p><?php echo $asso["name"]?></p>
                    </div>
                    <div class="sidebar-item">
                        <i class="fa fa-cog"></i> Réglages
                    </div>
                    <div class="sidebar-item">
                        <i class="fa fa-user-plus"></i> Membres
                        <div class="sidebar__label"><?php echo $membre;?>/10</div>
                    </div>
                    <div class="sidebar-item">
                        <i class="fa-solid fa-lock"></i> Supprimer
                    </div>
                </div>
                <div class="setting_main">
                    <div class="setting_header">
                        <h2>Réglages</h2>
                    </div>
                    <div class="setting_container">
                        <div class="setting_form">
                            <form action="index.php?module=mod_association&action=editinformation&id=<?php echo $asso["id"]; ?>" method="POST">
                                <label class="main__input-label">Email</label>
                                <input class="main__input" name="mail" type="email" required="required" value="<?php echo htmlspecialchars($asso["mail"]) ; ?>" maxlength="100"></input>
                                <label class="main__input-label">Signature/Slogan</label>
                                <input class="main__input" name="signature" type="text" required="required" value="<?php echo htmlspecialchars($asso["signature"]) ; ?>" minlength="6" maxlength="40"></input>
                                <label class="main__input-label">Description</label>
                                <textarea class="main__input" name="description" id="description" type="text" name="description" minlength="6" maxlength="500" required="required"><?php echo htmlspecialchars($asso["description"]); ?></textarea>
                                <label class="main__input-label">Adresse</label>
                                <input class="main__input" name="adresse" type="text" required="required" minlength="6" maxlength="20" value="<?php echo htmlspecialchars($asso["adresse"]) ; ?>"></input>
                                <label class="main__input-label">Catégories</label>
                                <input class="categorie" type="radio" name="categorie" required value="Santé" <?php if ($asso["categorie"] == "Santé") {echo "checked=\"checked\""; } ?>>Santé
                                <input class="categorie" type="radio" name="categorie" value="Alimentaire" <?php if ($asso["categorie"] == "Alimentaire") {echo "checked=\"checked\""; } ?>>Alimentaire
                                <input class="categorie" type="radio" name="categorie" value="Environnement" <?php if ($asso["categorie"] == "Environnement") {echo "checked=\"checked\""; } ?>>Environnement 
                                <input class="categorie" type="radio" name="categorie" value="Sportif" <?php if ($asso["categorie"] == "Sportif") {echo "checked=\"checked\""; } ?>>Sportif 
                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                                </br><button type="submit" class="btn-valide">Sauvegarder</button>
                                <button type="reset" class="btn-cancel" href="index.php?module=mod_association&id=<?php echo $asso["id"]; ?>">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="setting_main">
                    <div class="setting_header">
                        <h2>Membres</h2>
                    </div>
                    <div class="setting_container">
                        <div class="setting_form">
                            <label class="main__input-label">Ajoute/Retire un utilisateur</label>
                            <input type="text" class="main__input" id="searchInput" placeholder="Start typing...">
                            <div class = "usercard">
                                <div class = "profilecard">
                                    <div>
                                        <img id="user-icon" src="img/vide.png" alt>
                                    </div>
                                    <div>
                                        <span id="username"></span>
                                    </div>
                                </div>
                                <div>
                                    <div class="addUser">
                                        <div class="user-form">
                                            <span>Quel rôle ?</span>
                                            <form action="index.php?module=mod_association&action=addmembre&id=<?php echo $asso["id"]; ?>" method="POST">
                                                <div>
                                                    <input class="role" type="radio" name="role" required value="Administrateur"/>Administrateur
                                                    <input class="role" type="radio" name="role" value="Support"/>Support
                                                    <input class="role" type="radio" name="role" value="Membre"/>Membre
                                                </div>
                                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                                                <input type="hidden" name="userID" class="userID" value=""/>
                                                <div>
                                                    <input type="submit" id="adduser" class="btn-valide" value="Ajouter"/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="removeUser">
                                        <div class="user-form">
                                            <form action="index.php?module=mod_association&action=removemembre&id=<?php echo $asso["id"]; ?>" method="POST">
                                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                                                <input type="hidden" name="userID" class="userID" value=""/>
                                                <div>
                                                    <input class="form-check-input" type="checkbox" value="" require="required">
                                                    <label class="form-check-label">Êtes-vous sûr de vouloir retirer cette personne ?</label>
                                                </div>
                                                <div>
                                                    <input type="submit" id="removeuser" class="btn-valide" value="Retirer"/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="setting_main">
                    <div class="setting_header">
                        <h2>Supprimer</h2>
                    </div>
                    <div class="setting_container">
                        <div class="setting_form">
                            <form action="index.php?module=mod_association&action=supprimer&id=<?php echo $asso["id"]; ?>" method="POST">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="confirmation" required="required" >
                                    <label class="form-check-label" for="confirmation">
                                        Êtes-vous sûr de vouloir supprimer votre association ?
                                    </label>
                                </div>
                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                                <div>
                                    <button type="submit" class="btn-valide">Supprimer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('.setting_main:first').show();
                    $('.sidebar-item:first').addClass('active');
                    $('.setting_form').show();

                    
                    $(".sidebar-item").each(function(index) {
                        $(this).click(function() {
                            $('.sidebar-item').removeClass('active');
                            $(this).addClass('active');
                            $(".setting_main").hide();
                            $(".setting_main").eq(index).show();        
                        })
                    })

                    const params = new Proxy(new URLSearchParams(window.location.search), {
                        get: (searchParams, prop) => searchParams.get(prop),
                    });
                    var id = params.id;

                    $('#searchInput').autocomplete({
                        source: function( request, response ) {
                            $.ajax({
                                type: "POST",
                                url: "recherche_user.php",
                                dataType: "json",
                                data: {
                                    username: request.term
                                },
                                success: function( data ) {
                                    response( data );
                                }
                            });
                        },
                        minLength: 2,
                        select: function( event, ui ) {
                            $( "#searchInput" ).val( ui.item.value);
                            $( ".userID" ).val( ui.item.id);
                            $(".usercard").css('display', 'flex');
                            $( "#username" ).html( ui.item.value);
                            $( "#user-icon" ).attr( "src", "img/Users/" + ui.item.icon);
                            $.ajax({
                                type: "POST",
                                url: "verifie_role.php",
                                dataType: "json",
                                data: {
                                    idUser: ui.item.id,
                                    idAsso: id
                                }, 
                                success: function( data ) {
                                    if (data.role == "false") {
                                        $(".removeUser").hide();
                                        $(".addUser").show();
                                    } else {
                                        $(".addUser").hide();
                                        $(".removeUser").show();
                                    }
                                }
                            });
                        }
                    }).data("ui-autocomplete")._renderItem = function(ul, item) {
                        return $("<li class='ui-autocomplete-row'></li>")
                        .data("item-autocomplete", item)
                        .append(item.label)
                        .appendTo(ul);
                    };
                });
            </script>
            <?php
        }

        public function formulaireEvenement($association, $events) {
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();
            $imagelien = "img/Associations/".$association["image"]."";
            $imagetime = filemtime($imagelien);
            ?>
            <div class="setting-association">
                <div class="sidebar">
                    <div class="sidebar__header">
                        <img class="sidebar__avatar" src="<?php echo ("".$imagelien."?".$imagetime.""); ?>"/>
                        <p><?php echo $association["name"]?></p>
                    </div>
                    <div class="sidebar-item">
                        <i class="fa-regular fa-calendar-plus"></i> Organiser événement
                    </div>
                    <div class="sidebar-item">
                        <i class="fa-solid fa-calendar-days"></i> Nos événements
                        <div class="sidebar__label"><?php echo count($events);?>/15</div>
                    </div>
                </div>
                <div class="setting_main">
                    <div class="setting_header">
                        <h2>Organiser événement</h2>
                    </div>
                    <div class="setting_container">
                        <div class="setting_form create">
                            <form action="index.php?module=mod_evenement&action=ajoutevenement&id=<?php echo $_GET["id"]; ?>" method="POST" enctype="multipart/form-data">
                                <label class="main__input-label">Nom</label>
                                <input class="main__input" name="name" type="text" required="required" minlength="4" maxlength="20"></input>
                                <label class="main__input-label">Description</label>
                                <textarea class="main__input" name="description" id="description" type="text" name="description" required="required" minlength="4" maxlength="500"></textarea>
                                <label class="main__input-label">Date de début</label>
                                <input class="main__input" type="datetime-local" name="dateS" required="required" />
                                <label class="main__input-label">Date de fin</label>
                                <input class="main__input" type="datetime-local" name="dateF" required="required" />
                                <label class="main__input-label">Types</label>
                                <input class="categorie" type="radio" name="type" required value="Ecologoie">Ecologoie
                                <input class="categorie" type="radio" name="type" value="Sportif">Sportif
                                <input class="categorie" type="radio" name="type" value="Humanitaire">Humanitaire
                                <input class="categorie" type="radio" name="type" value="Culturel">Culturel
                                <input class="categorie" type="radio" name="type" value="Jeux-Video">Jeux Video
                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                                </br><button type="submit" class="btn-valide">Organiser</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="setting_main">
                    <div class="setting_header">
                        <h2 id="text_header">Nos événements</h2>
                    </div>
                    <div class="setting_container">
                        <div class="setting_form swiper">
                            <section class="thumbSection">
                                <div class="thumbTiles swiper-container swiperGererEvent">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <?php
                                            if (count($events) == 0) {
                                                echo '<p>Vous n\'avez organisez aucun événement.</p></div>';
                                            } 
                                        ?>
                                        <!-- Slides -->
                                        <?php
                                            foreach($events as $e) {
                                                $imagelien = "img/Evenements/".htmlspecialchars($e["image"])."";
                                                $imagetime = filemtime($imagelien);
                                                ?>
                                                <div class="swiper-slide">
                                                    <a class="thumbTiles">
                                                        <div class="thumbImage">
                                                            <input class="event-name" type="hidden" value="<?php echo htmlspecialchars($e["name"])?>" />
                                                            <input class="event-description" type="hidden" value="<?php echo htmlspecialchars($e["description"])?>" />
                                                            <input class="event-img" type="hidden" value="<?php echo $imagelien; ?>"/>
                                                            <input class="event-dateS" type="hidden" value="<?php echo $e["dateStart"]?>" />
                                                            <input class="event-dateF" type="hidden" value="<?php echo $e["dateEnd"]?>" />
                                                            <input class="event-type" type="hidden" value="<?php echo $e["type"]?>" />
                                                            <input class="event-id" type="hidden" value="<?php echo $e["id"]?>" />
                                                            <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>">
                                                        </div>
                                                    </a>
                                                    <h1><?php echo htmlspecialchars($e["name"]) ?></h1>
                                                </div>
                                                <?php
                                            }       
                                        ?>
                                    </div>

                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev prev-btn3"></div>
                                    <div class="swiper-button-next next-btn3"></div>
                                </div>
                            </section>
                        </div>
                        <div class="setting_form edit">
                            <form id="form" action="index.php?module=mod_evenement&action=modifevent&id=<?php echo $_GET["id"]; ?>" method="POST" enctype="multipart/form-data">
                                <label class="main__input-label">Banniere</label>
                                <input class="main__input" accept="image/*" type="file" name="imagevenement"/>
                                <label class="main__input-label">Description</label>
                                <textarea class="main__input description" name="description" id="description" type="text" required="required" minlength="4" maxlength="500"></textarea>
                                <label class="main__input-label">Date de début</label>
                                <input class="main__input dateS" type="datetime-local" name="dateS" required="required" />
                                <label class="main__input-label">Date de fin</label>
                                <input class="main__input dateF" type="datetime-local" name="dateF" required="required" />
                                <label class="main__input-label">Types</label>
                                <input class="categorie" type="radio" name="type" required value="Ecologoie">Ecologoie
                                <input class="categorie" type="radio" name="type" value="Sportif">Sportif
                                <input class="categorie" type="radio" name="type" value="Humanitaire">Humanitaire
                                <input class="categorie" type="radio" name="type" value="Culturel">Culturel
                                <input class="categorie" type="radio" name="type" value="Jeux-Video">Jeux Video
                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>"/>
                                </br><button type="submit" class="btn-valide">Sauvegarder</button>
                                <button type="reset" class="btn-cancel">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('.setting_main:first').show();
                    $('.setting_form.create').show();
                    $('.setting_form.swiper').show();
                    $('.sidebar-item:first').addClass('active');
                    
                    $(".sidebar-item").each(function(index) {
                        $(this).click(function() {
                            $('.sidebar-item').removeClass('active');
                            $(this).addClass('active');
                            $(".setting_main").hide();
                            $(".setting_main").eq(index).show();        
                        })
                    })

                    $(".thumbImage").each(function(index) {
                        $(this).click(function() {
                            var id = $(this).find(".event-id").val();
                            var name = $(this).find(".event-name").val();
                            var type = $(this).find(".event-type").val();
                            var image = $(this).find(".event-img").val();
                            var description = $(this).find(".event-description").val();
                            var dateS = $(this).find(".event-dateS").val();
                            var dateF = $(this).find(".event-dateF").val();
                            $(".setting_form.swiper").hide();
                            $(".setting_form.edit").show();   
                            $(".description").val(description);
                            $("#text_header").html(name);
                            $(".dateF").val(dateF);
                            $(".dateS").val(dateS);
                            $(".categorie[value='" + type + "']").attr('checked', true);
                            document.getElementById('form').action = "index.php?module=mod_evenement&action=modifevent&id=" + id;
                        })
                    })

                    $(".btn-cancel").each(function(index) {
                        $(this).click(function() {
                            $(".setting_form.edit").hide();        
                            $(".setting_form.swiper").show();
                            $("#text_header").html("Nos événements");
                        })
                    })


                });
                var mySwiper = new Swiper('.swiper-container', {
                    // Optional parameters
                    spaceBetween: 2,
                    slidesPerView: 2,
                    freeMode: true,
                    infinite: true,
                    loopAdditionalSlides: 5,
                    speed: 300,
                    mobileFirst:true,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.next-btn3',
                        prevEl: '.prev-btn3',
                    },
                    breakpoints: {
                        // when window width is >= 320px
                        320: {
                        slidesPerView: 1,
                        spaceBetween: 2
                        },
                        // when window width is >= 480px
                        480: {
                        slidesPerView: 1,
                        spaceBetween: 2
                        },
                        // when window width is >= 640px
                        640: {
                        slidesPerView: 2,
                        spaceBetween: 4
                        }
                    }
                })
            </script>
            <?php
        }

        public function afficherListeAssociations($associations){
            ?>
            <link href="css/reset.css" rel="stylesheet" />
            <link href="css/filter.css" rel="stylesheet" />
            <header class="cd-header">
                <div class="animate__animated animate__fadeInDown">
                    <div class="container c2">
                        <div class="glitch" data-text="Soutien une association">Soutien une association</div>
                        <div class="glow">Soutien une association</div>
                    </div>
                </div>
                <div class="animate__animated animate__fadeInUp">
                    <div class="py-2">
                        <p class="subtitle">N'attend plus soutiens les !</p>
                    </div>
                </div>
                <div class="scanlines"></div>
            </header>

            <div class="cd-main-content">
                <div class="cd-tab-filter-wrapper">
                    <div class="cd-tab-filter">
                        <ul class="cd-filters">
                            <li class="placeholder"> 
                                <a data-type="all" href="#0">Tous</a> 
                            </li> 
                            <li class="filter"><a class="selected" href="" data-type="all">Tous</a></li>
                            <li class="filter" data-filter=".Populaire"><a href="#0" data-type="En Tendance">Plus populaire</a></li>
                            <li class="filter" data-filter=".Recent"><a href="#0" data-type="Derniers Ajouts">Derniers Ajouts</a></li>
                        </ul>
                    </div> 
                </div> 

                <section class="cd-gallery">
                    <ul>
                        <?php
                            foreach($associations as $a){
                            $imagelien = "img/Associations/".htmlspecialchars($a["image"])."";
                            $imagetime = filemtime($imagelien);
                                ?>                  
                                <li class="mix <?php echo $a["name"]; ?> <?php echo $a["categorie"]; ?> <?php echo $a["populaire"]; ?> <?php echo $a["recent"]; ?>">
                                    <a href="index.php?module=mod_association&id=<?php echo $a["id"]; ?>">
                                        <img src="<?php echo ("".$imagelien."?".$imagetime.""); ?>" alt="Image">
                                        <span><?php echo htmlspecialchars($a["name"]); ?></span></a>
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
                                <input type="search" placeholder="recherche une association...">
                            </div> 
                        </div> 

                        <div class="cd-filter-block">
                            <h4>Catégorie</h4>

                            <ul class="cd-filter-content cd-filters list">
                                <li>
                                    <input class="filter" data-filter=".Alimentaire" type="checkbox" id="checkbox1">
                                    <label class="checkbox-label" for="checkbox1">Alimentaire</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Santé" type="checkbox" id="checkbox2">
                                    <label class="checkbox-label" for="checkbox2">Santé</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Environnement" type="checkbox" id="checkbox3">
                                    <label class="checkbox-label" for="checkbox3">Environnement</label>
                                </li>

                                <li>
                                    <input class="filter" data-filter=".Sportif" type="checkbox" id="checkbox4">
                                    <label class="checkbox-label" for="checkbox4">Sportif</label>
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
