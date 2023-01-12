<?php
    require_once("controleur.php");
    require_once("./vue_generique.php");

    class VueHome extends VueGenerique {
        public function __construct() {
            parent::__construct();
        }

        public function vueHome($event, $asso){
            ?>
            <link href="css/home.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" />
            <link rel="stylesheet" href="css/particle.css">
            <div id="home-main">
                <div id="particle-container">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>

                <!-- banner area -->
                <section class="banner-area font-poppins">
                    <div class="container mx-auto banner-title">
                        <div class="title">
                            <div class="py-2 branding text-dark text-lg sm-text-xl font-bold">
                                <span class="d-block animate__animated animate__fadeInDown animate__faster">Notre misson</span>
                                <span class="d-block animate__animated animate__fadeInDown animate__fast">aider l'humanité,</span>
                                <span class="d-block py-1 animate__animated animate__fadeInDown">
                                    <a href="" class="typewrite t2 text-dark font-bold" data-period="2000" data-type='[ "Crée une association.", "Organise des événements.", "Lance des cagnottes.", "Tout ça, Maintenant !" ]'>
                                        <span class="wrap"></span>
                                    </a>
                                </span>
                            </div>
                            <div class="py-4 animate__animated animate__fadeInUp" >
                                <p class="text-dark">On a besoin de vous, ils ont besoin de vous !</br>Soutiens les associations en participant à leur événements.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /banner area -->

                <!-- agency area -->
                <section class="agency-area">
                    <div class="container mx-auto text-center font-poppins">
                        <span class="text-red d-block animate__animated animate__fadeInDown">En quelques mots</span>
                        <div class="area-title">
                            <h1 class="d-block animate__animated animate__fadeInDown animate__faster text-lg text-dark">
                                HubEvents est le premier site français <br>
                                regroupant autant d'associations
                            </h1>
                        </div>

                        <div class="grid cols-1 lg-cols-3 py-10 animate__animated animate__zoomIn">
                            <div class="grid-item px-5">
                                <div class="text-center text-2xl text-red">
                                    <i class="bi bi-hearts"></i>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-md py-2">Associations</h4>
                                    <p class="text-gray">Nous regroupons plus d'une centaine d'associations situé dans toute la france.</p>
                                </div>
                            </div>
                            <div class="grid-item px-5">
                                <div class="text-center text-2xl text-red">
                                    <i class="bi bi-megaphone"></i>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-md py-2">Evenements</h4>
                                    <p class="text-gray">Des événements tous les jours, avec différents thèmes pour répondre à toutes vos envies.</p>
                                </div>
                            </div>
                            <div class="grid-item px-5">
                                <div class="text-center text-2xl text-red">
                                    <i class="bi bi-mouse"></i>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-md py-2">Supports</h4>
                                    <p class="text-gray">Une équipe de modération à l'écoute des utilisateurs et prêt à vous aider en toute circonstance.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <!-- /agency area -->

                <!-- ready area -->   
                <section class="ready-area container mx-auto py-5 animate__animated animate__zoomIn">
                <div class="flex flex-wrap font-poppins py-10 sm-px-10">
                    <div class="w-50">
                        <h1 class="text-lg sm-text-l text-dark">Êtes-vous prêt à essayer ?</h1>
                        <p class="text-gray">
                            Recenser votre association et organiser des événements gratuitement, inscription en seulement 30 secondes. 
                        </p>
                    </div>
                    <div class="cols py-5">
                        <a href="index.php?module=mod_connexion&action=register" class="btn-shadow text-white btn btn-primary d-block text-center bg-gradient">
                            <span class="text-sm">M'inscrire</span>
                        </a>
                    </div>
                </div>
                </section>
                <!-- /ready area -->   
            </div>
            <script src="js/typewrite.js"></script>
            <!--
            <div class="association-gerer">
                <section class="thumbSection">
                    <h2 class="thumbTitle">Top des Evènements</h2>
                    <div class="thumbTiles swiper-container swiper1">
                        <div class="swiper-wrapper">
                            <?php
                                foreach($event as $a) {
                                    $imagelienE = "img/Evenements/".$a["image"]."";
                                    $imagetimeE = filemtime($imagelienE);
                                    ?>
                                    <div class="swiper-slide">
                                        <a class="thumbTiles" href="index.php?module=mod_evenement&id=<?php echo $a["id"]; ?>">
                                        <img src="<?php echo ("".$imagelienE."?".$imagetimeE.""); ?>">
                                        <h1><?php echo $a["name"]; ?></h1>
                                        </a>
                                    </div>
                                    <?php
                                }       
                            ?>
                        </div>

                        <div class="swiper-pagination swiper-pagination1"></div>
                        <div class="swiper-button-prev prev-btn4"></div>
                        <div class="swiper-button-next next-btn4"></div>
                    </div>
                </section>
            </div>
            <div class="association-gerer">
                <section class="thumbSection">
                    <h2 class="thumbTitle">Top des Associations</h2>
                    <div class="thumbTiles swiper-container swiper2">
                        <div class="swiper-wrapper">
                            <?php
                                foreach($asso as $a) {
                                    ?>
                                    <div class="swiper-slide">
                                        <?php
                                    $imagelienA = "img/Associations/".$a["image"]."";
                                    $imagetimeA = filemtime($imagelienA);
                                    ?>
                                    <a class="thumbTiles" href="index.php?module=mod_association&id=<?php echo $a["id"]; ?>">
                                    <img src="<?php echo ("".$imagelienA."?".$imagetimeA.""); ?>">
                                    <h1><?php echo $a["name"]; ?></h1>
                                    </a>
                                </div>
                                    <?php
                                }       
                            ?>
                        </div>

                        <div class="swiper-button-prev prev-btn5"></div>
                        <div class="swiper-button-next next-btn5"></div>
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
                        nextEl: '.next-btn4',
                        prevEl: '.prev-btn4',
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
                        nextEl: '.next-btn5',
                        prevEl: '.prev-btn5',
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
            -->
            <?php
        }

    }
?>