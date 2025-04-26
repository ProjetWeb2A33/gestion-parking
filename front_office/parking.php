<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gestion de Stationnement et de Parking - Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

 
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    }

    .testimonial-item {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        width: 250px; /* Taille réduite */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
        transition: all 0.3s ease;
    }

    .testimonial-item:hover {
        transform: scale(1.05); /* Effet d'agrandissement au survol */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .testimonial-item h3 {
        font-size: 18px;
        color: #333;
        margin-bottom: 15px;
    }

    .testimonial-item p {
        font-size: 14px;
        color: #555;
        margin: 15px 0;
        line-height: 1.6;
    }

    .testimonial-item .quote-icon-left,
    .testimonial-item .quote-icon-right {
        color: #007bff;
        font-size: 16px;
    }

    .testimonial-item a {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 25px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .testimonial-item a:hover {
        background-color: #0056b3;
    }

  </style>

  
</head>

<body class="about-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        
      <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
                
            <li><a href="index.php" >Home<br></a></li>
            <li><a href="parking.php" class="active">Stationnement</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="hotel.php">Vacances</a></li>
            <li><a href="event.php">Evenement</a></li>
            <li><a href="covoiturage.php">Covoiturage</a></li>
            <li><a href="contact.php">Contact </a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="account.php">Creer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/parking.jpg);">
      <div class="container position-relative">
        <h1>EasyParki</h1>
        <p>"EasyParki : Stationnement simplifié, expérience optimisée !"</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Parking et Stationnement</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Parking et Stationnement Section -->
    <section id="Parking et Stationnement" class="Parking et Stationnement section">

        

      <div class="container">

        <div class="row gy-4">

            <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
                <img src="assets/img/stat.jpg" class="img-fluid" alt="">
                
            </div>

            <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
              <img src="C:\Users\msell\OneDrive\Desktop\education\projet\web\easy parki\logo.png" class="img-fluid" alt="">
            </div>

            <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                <h3>Gestion de Reservation et de Parking</h3>
                <p>Une gestion intelligente pour optimiser le stationnement et offrir une expérience fluide et sécurisée.</p>
                <ul>
                    <li>
                        <i class="bi bi-diagram-3"></i>
                        <div>
                          <h5>Réserver une place</h5>
                          <p>Permet la réservation à l’avance une place de parking .</p>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-broadcast"></i>
                        <div>
                          <h5>Scanner un QR code pour l'entrée et la sortie.</h5>
                          <p>Simplifie l'accès au parking grâce à un QR code scanné à l'entrée et à la sortie.</p>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-broadcast"></i>
                        <div>
                          <h5>Suggestion intelligente de parking avec l'IA.</h5>
                          <p>Utilise l'IA pour recommander les parkings les plus adaptés selon l'adresse .</p>
                        </div>
                    </li>              
                    <li>
                        <i class="bi bi-broadcast"></i>
                        <div>
                          <h5>Visualiser les tarifs.</h5>
                          <p>Présente les différents tarifs de stationnement selon la durée ou la zone choisie.</p>
                        </div>
                    </li>
                
                </ul>
            </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
      </div>

    </section><!-- /Stats Section -->

    

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">


        <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">

                <script type="application/json" class="swiper-config">
                  {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                      "pagination": {
                          "el": ".swiper-pagination",
                          "type": "bullets",
                          "clickable": true
                      }
                  }
                    
                </script>
                

                <div class="swiper-wrapper">


                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Consulter les parkings </h3>
                      <a href="listParking.php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Reserver une place</h3>
                      <a href="AddReservation.php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Liste des reservations</h3>
                      <a href="listeReservation.php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Visualiser les tarifs </h3>
                      <a href="tarifs.php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    
                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Scanner un code Qr pour l'entrée et la sortie</h3>
                      <a href=".php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Historique de stationnement</h3>
                      <a href=".php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Suggestion d'un parking avec l'IA</h3>
                      <a href="disponibilite.php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                    <div class="testimonial-item">
                      <h3>Disponibilité des places parkings</h3>
                      <a href="disponibilite.php">Voir plus</a>
                      <p>
                        <i class="bi bi-quote quote-icon-left"></i>
                        <span>Ne le ratez pas</span>
                        <i class="bi bi-quote quote-icon-right"></i>
                      </p>
                    </div>
                    </div><!-- End testimonial item -->

                </div>
                
                <div class="swiper-pagination"></div>
          </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>L'importance de la gestion de stationnement et parking</span>
        <h2>L'importance de la gestion de stationnement et parking</h2>
        <p>"Optimisez votre quotidien en maîtrisant la gestion de stationnement et de parking : 
          une solution clé pour libérer du temps, réduire les coûts et améliorer l'expérience de vos utilisateurs !"</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="faq-container">

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Comment votre solution de gestion de stationnement peut-elle m'aider à réduire les coûts opérationnels et améliorer l'efficacité de mon parc de stationnement ?</h3>
                <div class="faq-content">
                  <p>Notre solution optimise l’utilisation de l’espace, réduit les coûts de maintenance et améliore la rentabilité grâce à la gestion automatisée et à l’analyse en temps réel.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Quelles fonctionnalités spécifiques offrez-vous pour garantir une gestion fluide des parkings, surtout en période de forte affluence ?</h3>
                <div class="faq-content">
                  <p>Elle surveille l’occupation en temps réel, ajuste les tarifs dynamiquement et offre une plateforme mobile pour faciliter l’accès et fluidifier les flux.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Faq Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Optimisation et Gestion Efficace du Stationnement </span>
          </a>
          <p>Une gestion intelligente du stationnement pour optimiser l’espace, réduire les coûts et améliorer l’expérience utilisateur.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Parking et Stationnement</a></li>
            <li><a href="#">Vacances</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Covoiturage</a></li>
            <li><a href="#">stationnement pour evenements</a></li>
          </ul>
        </div>

        

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>La Gazelle,Esprit </p>
          <p>Sidi Bou Siid</p>
          <p>La Marsa</p>
          <p>Manzah 1</p>
          <p>Le Bardo</p>
          <p>Bizerte</p>
          <p>Sfax</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+216 29 111 960</span></p>
          <p><strong>Email:</strong> <span>msellati.habibaeya@esprit.tn</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Logis</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>