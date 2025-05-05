<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EasyParki - Stationnement</title>
  <meta name="description" content="Reservez vos places en toute simplicité avec EasyParki">
  <meta name="keywords" content="Parking, Stationnement, réservation, tarification">

  <!-- Favicons -->
  <link href="assets/img/logoo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    :root {
  --primary-color: #0d3f72;       
  --primary-dark: #08284d;        
  --secondary-color: #0a1d37;    
  --accent-color: #3a5cb3;        /* Bleu vif */
  --light-color: #f8fafc;         /* Fond très légèrement bleuté */
  --dark-color: #2d3748;          /* Texte foncé doux */
  --text-color: #4a5568;          /* Texte principal */
  --section-bg: #f5f7fa;          /* Arrière-plan des sections */
  --card-bg: #ffffff;             /* Fond des cartes */
  --border-color: rgba(0,0,0,0.08); /* Bordures subtiles */
  --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
}
    
    /* Header & Navigation */
    .header {
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }
    
    .sitename {
  font-family: Arial, sans-serif; /* juste changer la police */
  font-weight: 700;
  color: var(--secondary-color);
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

    
    .navmenu ul li a {
      position: relative;
      color: var(--dark-color);
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .navmenu ul li a:hover,
    .navmenu ul li a.active {
      color: var(--primary-color);
    }
    
    .navmenu ul li a:after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--gradient);
      transition: width 0.3s ease;
    }
    
    .navmenu ul li a:hover:after,
    .navmenu ul li a.active:after {
      width: 100%;
    }
    
    .btn-getstarted {
      background: var(--gradient);
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 50px;
      box-shadow: 0 5px 15px rgba(74, 166, 255, 0.4);
      transition: all 0.3s ease;
    }
    
    .btn-getstarted:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(74, 166, 255, 0.6);
    }
    
    /* Hero Section */
    .page-title {
      position: relative;
      padding: 180px 0 120px;
      background: linear-gradient(rgba(10, 29, 55, 0.85), rgba(10, 29, 55, 0.85)), url('assets/img/55.png') center/cover no-repeat;
      color: white;
      text-align: center;
    }
    
    .page-title h1 {
      font-family: Arial, sans-serif;
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInDown 1s ease;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .page-title p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
      animation: fadeInUp 1s ease;
      opacity: 0.9;
    }
    
    /* About Section - Redesign */
    .about {
      padding: 100px 0;
      position: relative;
      overflow: hidden;
    }
    
    .about::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/wave-bg.svg') center/cover no-repeat;
      opacity: 0.03;
      z-index: -1;
    }
    
    .about h3 {
      font-family: Arial, sans-serif;
      color: var(--secondary-color);
      font-size: 2.5rem;
      margin-bottom: 30px;
      position: relative;
      display: inline-block;
    }
    
    .about h3:after {
      content: '';
      position: absolute;
      bottom: -15px;
      left: 0;
      width: 100px;
      height: 4px;
      background: var(--gradient);
      border-radius: 2px;
    }
    
    .about .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 50px;
    }
    
    .feature-card {
      background: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.4s ease;
      border: 1px solid rgba(0,0,0,0.03);
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
      width: 70px;
      height: 70px;
      background: rgba(13, 63, 114, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      color: var(--primary-color);
      font-size: 1.8rem;
    }
    
    .feature-card h4 {
      font-weight: 600;
      margin-bottom: 15px;
      color: var(--secondary-color);
    }
    
    /* Stats Section - Redesign */
    .stats {
      padding: 100px 0;
      background: var(--gradient);
      color: white;
      position: relative;
      overflow: hidden;
    }
    
    .stats::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/dots-bg.png') center/cover no-repeat;
      opacity: 0.1;
    }
    
    .stats-item {
      padding: 40px 30px;
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(5px);
      transition: all 0.4s ease;
      text-align: center;
      border: 1px solid rgba(255,255,255,0.1);
    }
    
    .stats-item:hover {
      transform: translateY(-10px);
      background: rgba(255, 255, 255, 0.15);
    }
    
    .stats-item span {
      font-size: 3rem;
      font-weight: 700;
      display: block;
      margin-bottom: 10px;
      background: linear-gradient(to right, #fff, #e0f1ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    /* Testimonials - Redesign */
    .testimonials {
      padding: 120px 0;
      background: linear-gradient(135deg, #f8faff 0%, #f0f7ff 100%);
    }
    
    .testimonial-card {
      background: white;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
      transition: all 0.4s ease;
      height: 100%;
      position: relative;
      overflow: hidden;
      border: 1px solid rgba(0,0,0,0.03);
    }
    
    .testimonial-card::before {
      content: '"';
      position: absolute;
      top: 20px;
      right: 30px;
      font-size: 100px;
      font-family: 'Playfair Display', serif;
      color: rgba(13, 63, 114, 0.05);
      line-height: 1;
    }
    
    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    }
    
    .testimonial-img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    
    .stars {
      color: #ffc107;
      margin-bottom: 15px;
      font-size: 1.1rem;
    }
    
    /* CTA Section - Redesign */
    .cta-section {
      padding: 100px 0;
      background: url('assets/img/cta-bg.jpg') center/cover no-repeat;
      position: relative;
      text-align: center;
    }
    
    .cta-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(13, 63, 114, 0.9);
    }
    
    .cta-content {
      position: relative;
      z-index: 2;
    }
    
    .cta-btn {
      background: white;
      color: var(--primary-color);
      font-weight: 600;
      padding: 15px 40px;
      border-radius: 50px;
      transition: all 0.3s ease;
      display: inline-block;
      margin-top: 20px;
    }
    
    .cta-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(255,255,255,0.3);
    }
    
    /* FAQ Section - Redesign */
    .faq-section {
      padding: 100px 0;
      background: #f9fbfe;
    }
    
    .faq-item {
      margin-bottom: 15px;
      border-radius: 12px;
      background: white;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
      overflow: hidden;
      transition: all 0.3s ease;
      border: 1px solid rgba(0,0,0,0.03);
    }
    
    .faq-item:hover {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }
    
    .faq-item h3 {
      padding: 20px 25px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 0;
      font-size: 1.1rem;
      color: var(--secondary-color);
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .faq-item:hover h3 {
      color: var(--primary-color);
    }
    
    .faq-item.active h3 {
      color: var(--primary-color);
    }
    
    .faq-content {
      padding: 0 25px;
      max-height: 0;
      overflow: hidden;
      transition: all 0.4s ease;
    }
    
    .faq-item.active .faq-content {
      padding: 0 25px 25px;
      max-height: 500px;
    }
    
    .faq-toggle {
      transition: transform 0.3s ease;
    }
    
    .faq-item.active .faq-toggle {
      transform: rotate(180deg);
    }
    
    /* Footer - Redesign */
    .footer {
      background: var(--secondary-color);
      color: white;
      padding-top: 100px;
      position: relative;
    }
    
    .footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 15px;
      background: var(--gradient);
    }
    
    .footer-links h4 {
      font-family: Arial, sans-serif;
      margin-bottom: 25px;
      position: relative;
      display: inline-block;
    }
    
    .footer-links h4::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 50px;
      height: 3px;
      background: var(--primary-color);
      border-radius: 3px;
    }
    
    .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 45px;
      height: 45px;
      background: rgba(249, 249, 249, 0.91);
      border-radius: 50%;
      margin-right: 10px;
      color: white;
      transition: all 0.3s ease;
    }
    
    .social-links a:hover {
      background: white;
      color: var(--primary-color);
      transform: translateY(-3px);
    }
    
    /* Animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .page-title h1 {
        font-size: 2.5rem;
      }
      
      .page-title p {
        font-size: 1rem;
      }
      
      .about h3, .section-title h2 {
        font-size: 2rem;
      }
    }
    
    /* Section Title */
    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }
    
    .section-title span {
      color: var(--primary-color);
      font-size: 1rem;
      font-weight: 600;
      letter-spacing: 1px;
      display: block;
      margin-bottom: 15px;
      text-transform: uppercase;
    }
    
    .section-title h2 {
      font-family: Arial, sans-serif;
      color: var(--secondary-color);
      font-size: 2.5rem;
      margin-bottom: 20px;
    }
    
    .section-title p {
      max-width: 700px;
      margin: 0 auto;
      color: #666;
    }
    
    /* Dropdown styling */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      min-width: 220px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      padding: 10px 0;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      border: none;
    }
  
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
  
    .dropdown-item {
      padding: 12px 25px;
      color: var(--secondary-color) !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
    }
  
    .dropdown-item:hover {
      background: rgba(13, 63, 114, 0.05);
      padding-left: 30px;
    }
  
    .dropdown-item i {
      color: var(--primary-color);
      font-size: 1.1em;
      width: 24px;
      text-align: center;
    }
    
    /* Floating Get Started Button */
    .floating-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 99;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: var(--gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 25px rgba(13, 63, 114, 0.3);
      transition: all 0.3s ease;
      font-size: 1.5rem;
      text-decoration: none;
    }
    
    .floating-btn:hover {
      transform: translateY(-5px) scale(1.1);
      box-shadow: 0 15px 30px rgba(13, 63, 114, 0.4);
    }
    
    /* Destination Gallery */
    .destination-gallery {
      padding: 100px 0;
      background: #f9fbfe;
    }
    
    .destination-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.4s ease;
      margin-bottom: 30px;
      position: relative;
    }
    
    .destination-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .destination-img {
      height: 250px;
      object-fit: cover;
      width: 100%;
      transition: transform 0.5s ease;
    }
    
    .destination-card:hover .destination-img {
      transform: scale(1.05);
    }
    
    .destination-info {
      padding: 20px;
      background: white;
      position: relative;
    }
    
    .destination-info h4 {
      margin-bottom: 10px;
      color: var(--secondary-color);
    }
    
    .destination-info p {
      color: #666;
      margin-bottom: 15px;
    }
    
    .price-tag {
      position: absolute;
      top: -20px;
      right: 20px;
      background: var(--gradient);
      color: white;
      padding: 8px 15px;
      border-radius: 50px;
      font-weight: 600;
      box-shadow: 0 5px 15px rgba(13, 63, 114, 0.3);
    }
    
    /* How It Works */
    .how-it-works {
      padding: 100px 0;
      position: relative;
      overflow: hidden;
    }
    
    .how-it-works::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/dots-pattern.png') center/cover no-repeat;
      opacity: 0.05;
      z-index: -1;
    }
    
    .step-card {
      background: white;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.4s ease;
      height: 100%;
      text-align: center;
      position: relative;
      border: 1px solid rgba(0,0,0,0.03);
    }
    
    .step-number {
      width: 60px;
      height: 60px;
      background: rgba(13, 63, 114, 0.1);
      color: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0 auto 20px;
      transition: all 0.3s ease;
    }
    
    .step-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }
    
    .step-card:hover .step-number {
      background: var(--gradient);
      color: white;
      transform: scale(1.1);
    }
    
    /* Newsletter */
    .newsletter {
      padding: 80px 0;
      background: var(--gradient);
      color: white;
      text-align: center;
    }
    
    .newsletter-form {
      max-width: 600px;
      margin: 40px auto 0;
      display: flex;
      background: white;
      border-radius: 50px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .newsletter-input {
      flex: 1;
      border: none;
      padding: 15px 25px;
      outline: none;
      font-size: 1rem;
    }
    
    .newsletter-btn {
      background: var(--secondary-color);
      color: white;
      border: none;
      padding: 15px 30px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .newsletter-btn:hover {
      background: #08172f;
    }
    /* Effet de carte amélioré */
.destination-card {
  background: var(--card-bg);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 15px 40px rgba(0,0,0,0.1);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
}

.destination-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--gradient);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 1;
}

.destination-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}

.destination-card:hover::before {
  opacity: 0.03;
}

/* Animation du badge */
.card-badge {
  position: absolute;
  top: 20px;
  right: 20px;
  background: var(--gradient);
  color: white;
  padding: 6px 15px;
  border-radius: 50px;
  font-weight: 600;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}
  </style>
</head>

<body class="vacation-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Accueil</a></li>
	        <li class="dropdown">
            <a href="parking.php" class="active"> Stationnement</a>
	          <ul class="dropdown-menu">
              <li>
                <a href="listParking.php" class="dropdown-item">
                  <i class="bi bi-building"></i>
                  Consulter Les Parkings
                </a>
              </li>
              <li>
                <a href="AddReservation.php" class="dropdown-item">
                  <i class="bi bi-calendar-plus"></i>
                  Reserver une place parking
                </a>
              </li>
              <li>
                <a href="listeReservation.php" class="dropdown-item">
                  <i class="bi bi-list-task"></i>
                  Voir mes Reservations
                </a>
              </li>
            </ul>
          </li>
          
          <li><a href="hotel.php" >Vacances</a></li>  
          <li><a href="covoiturage.php">Covoiturage</a></li>
          <li><a href="service.php">Service</a></li>
          <li><a href="event.php">Événement</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="account.php">Créer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/parking.jpg);">
      <div class="container position-relative">
        <h1>Votre Place, Votre Parking </h1>
        <p>Simplifiez votre stationnement, profitez de votre temps.</p>
        <div class="mt-4">
          <a href="listParking.php" class="btn btn-light btn-lg px-4 me-2">Explorer les Parkings</a>
          <a href="AddReservation.php" class="btn btn-outline-light btn-lg px-4">Reserver maintenant</a>
        </div>
      </div>
    </div><!-- End Hero Section -->

    <!-- About Section - Redesigned -->
    <section id="about" class="about section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8" data-aos="fade-up">
        <h3 class="text-start">Votre Évasion en Quelques Clics</h3>
        <p class="lead text-start">
          EasyParki révolutionne votre expérience de stationnement en combinant réservation de parkings, gestion de vos places et planification de vos trajets sur une seule plateforme intuitive. Dites adieu au stress du stationnement et profitez d'une mobilité simplifiée au quotidien.
        </p>
      </div>
    </div>
    
    <div class="features-grid" data-aos="fade-up" data-aos-delay="100">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-geo-alt"></i>
        </div>
        <h4>Des Parkings aux Destinations Exclusives </h4>
        <p>Accédez à une sélection soigneusement choisie de parkings et d’emplacements stratégiques, avec des options adaptées à tous les besoins et à tous les budgets. </p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-calendar-check"></i>
        </div>
        <h4>Planification Intelligente</h4>
        <p>Optimisez votre temps grâce à une planification intelligente de votre stationnement : réservez à l'avance, choisissez l'emplacement idéal et gérez vos trajets en toute simplicité.</p>
      </div>
      
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-arrow-repeat"></i>
        </div>
        <h4>Flexibilité Totale</h4>
        <p>Modifiez ou annulez vos réservations facilement, avec des politiques flexibles conçues pour s'adapter à vos besoins changeants.</p>
      </div>
    </div>
  </div>
</section><!-- End About Section -->

    <!-- Stats Section - Redesigned -->
    <section id="stats" class="stats section">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1500" data-purecounter-duration="1" class="purecounter"></span>
              <p>Stationnement Planifié</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="320" data-purecounter-duration="1" class="purecounter"></span>
              <p>Emplacements Stratégiques</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="220" data-purecounter-duration="1" class="purecounter"></span>
              <p>Parkings Partenaires</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
              <p>Heures d'Assistance</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Stats Section -->


    <!-- How It Works -->
    <section id="how-it-works" class="how-it-works">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <span>Comment ça marche</span>
          <h2>Reserver vos places en 3 Étapes</h2>
          <p>Notre processus simple vous permet d’organiser votre stationnement idéal en quelques minutes.</p>
        </div>
        
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4">
            <div class="step-card">
              <div class="step-number">1</div>
              <h3>Choisissez Votre Parkings</h3>
              <p>Découvrez notre sélection de parkings premium et trouvez l’emplacement idéal pour un stationnement sans stress.</p>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="step-card">
              <div class="step-number">2</div>
              <h3>Personnalisez Votre Stationnement</h3>
              <p>Planifiez votre stationnement, réservez votre place et gérez chaque détail de votre expérience en toute simplicité.</p>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="step-card">
              <div class="step-number">3</div>
              <h3>Confirmez et Profitez</h3>
              <p>Finalisez votre réservation et recevez tous les détails de votre stationnement en un seul endroit. Il ne reste plus qu'à profiter !</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End How It Works -->

    <!-- Testimonials Section - Redesigned -->
    <section id="testimonials" class="testimonials section">
      <div class="container section-title" data-aos="fade-up">
        <span>Témoignages</span>
        <h2>Ce que disent nos clients</h2>
        <p>Découvrez les expériences de ceux qui ont reservé avec nous</p>
      </div>

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
  <!-- Slide 1 - Version améliorée -->
  <div class="swiper-slide">
    <div class="testimonial-card" style="background: linear-gradient(135deg, rgba(13,63,114,0.1) 0%, rgba(255,255,255,0.05) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
      <div class="testimonial-header">
        <img src="assets/img/ee.png" class="testimonial-img" alt="Emna Ben Hassine">
        <div class="testimonial-author">
          <h3>Emna Ben Hassine</h3>
          <span>Conductrice Premium</span>
        </div>
        <div class="quote-icon">
          <i class="bi bi-quote" style="color: var(--accent-color); font-size: 2rem; opacity: 0.2;"></i>
        </div>
      </div>
      <div class="stars">
        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
      </div>
      <p class="testimonial-text">
        "Une expérience inoubliable avec EasyParki. La planification de votre stationnement est devenue un jeu d’enfant grâce à leur interface intuitive et leurs recommandations personnalisées."
      </p>
      <div class="testimonial-footer">
        <i class="bi bi-pin-map-fill" style="color: var(--accent-color);"></i> 
        <small>Réservation au Mall, Août 2023</small>
      </div>
    </div>
  </div>

  <!-- Slide 2 -->
  <div class="swiper-slide">
    <div class="testimonial-card" style="background: linear-gradient(135deg, rgba(13,63,114,0.1) 0%, rgba(255,255,255,0.05) 100%);">
      <div class="testimonial-header">
        <img src="assets/img/ss.png" class="testimonial-img" alt="Sarah Jardak">
        <div class="testimonial-author">
          <h3>Sarah Jardak</h3>
          <span>Famille de 4</span>
        </div>
        <div class="quote-icon">
          <i class="bi bi-quote" style="color: var(--accent-color); font-size: 2rem; opacity: 0.2;"></i>
        </div>
      </div>
      <div class="stars">
        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
      </div>
      <p class="testimonial-text">
        En tant que maman, il est souvent difficile de trouver une place de parking quand les enfants sont dans la voiture. Avec EasyParki, j'ai enfin pu me concentrer sur l'essentiel, sans stress. La recherche est simplifiée et le temps gagné est précieux !"
      </p>
      <div class="testimonial-footer">
        <i class="bi bi-pin-map-fill" style="color: var(--accent-color);"></i> 
        <small>Reservation à la plage, Juillet 2023</small>
      </div>
    </div>
  </div>

  <!-- Slide 3 -->
  <div class="swiper-slide">
    <div class="testimonial-card" style="background: linear-gradient(135deg, rgba(13,63,114,0.1) 0%, rgba(255,255,255,0.05) 100%);">
      <div class="testimonial-header">
        <img src="assets/img/hh.png" class="testimonial-img" alt="Habiba Eya">
        <div class="testimonial-author">
          <h3>Habiba Eya</h3>
          <span>conductrice Solo</span>
        </div>
        <div class="quote-icon">
          <i class="bi bi-quote" style="color: var(--accent-color); font-size: 2rem; opacity: 0.2;"></i>
        </div>
      </div>
      <div class="stars">
        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
      </div>
      <p class="testimonial-text">
        "Je recommande EasyParki à toutes les conductrices solo ! Leur système de planification m’a permis de découvrir des places de parking rapidement et d’explorer des expériences locales que je n’aurais jamais trouvées seule."
      </p>
      <div class="testimonial-footer">
        <i class="bi bi-pin-map-fill" style="color: var(--accent-color);"></i> 
        <small>parking à Hammamet, Avril 2023</small>
      </div>
    </div>
  </div>
</div>

<!-- Style personnalisé pour les témoignages -->
<style>
  .testimonial-card {
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(13, 63, 114, 0.1);
    transition: all 0.4s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
  }

  .testimonial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--gradient);
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(13, 63, 114, 0.2);
  }

  .testimonial-card:hover::before {
    opacity: 1;
  }

  .testimonial-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    position: relative;
  }

  .testimonial-img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,255,255,0.3);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-right: 15px;
  }

  .testimonial-author h3 {
    margin: 0;
    color: var(--secondary-color);
    font-size: 1.2rem;
  }

  .testimonial-author span {
    color: var(--accent-color);
    font-size: 0.8rem;
    font-weight: 500;
  }

  .quote-icon {
    position: absolute;
    right: 0;
    top: 0;
  }

  .stars {
    color: #FFC107;
    margin-bottom: 15px;
    font-size: 1.1rem;
  }

  .testimonial-text {
    font-style: italic;
    color: var(--text-color);
    line-height: 1.7;
    margin-bottom: 20px;
    position: relative;
    padding-left: 20px;
  }

  .testimonial-text::before {
    content: '"';
    position: absolute;
    left: 0;
    top: -10px;
    font-size: 3rem;
    color: var(--accent-color);
    opacity: 0.2;
    font-family: serif;
  }

  .testimonial-footer {
    display: flex;
    align-items: center;
    color: var(--text-color);
    font-size: 0.8rem;
    gap: 5px;
  }

  /* Animation des slides */
  .swiper-slide {
    opacity: 0.7;
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: scale(0.95);
  }

  .swiper-slide-active {
    opacity: 1;
    transform: scale(1);
  }
</style>
    </section><!-- End Testimonials Section -->

    <!-- Section Inspiration + Newsletter Redesign -->
<section id="inspiration-cta" class="inspiration-section">
  <div class="container-fluid p-0">
    <div class="row g-0">
      <!-- Colonne Inspiration (50%) -->
      <div class="col-lg-6 inspiration-col" style="background-image: url('assets/img/travel-inspiration.jpg');">
        <div class="inspiration-overlay">
          <div class="inspiration-content" data-aos="fade-right">
          <div class="qr-code-container">
            <h4>QR Code pour le Parking</h4>
            <img src="<?= $qrCodePath ?>" alt="QR Code Parking" style="width: 200px; height: 200px;">
          </div>
            
            <div class="inspiration-grid">
              
              
              
            </div>
            
            
          </div>
        </div>
      </div>
      
      <!-- Colonne Newsletter Redesign (50%) -->
      <div class="col-lg-6 newsletter-col" style="background-color: var(--primary-dark);">
        <div class="newsletter-wrapper" data-aos="fade-left">
          <div class="newsletter-header">
            <i class="bi bi-envelope-open newsletter-icon"></i>
            <h2>Votre Guide Parking sur Mesure</h2>
            <p>Recevez chaque mois des idées adaptées à vos préférences</p>
          </div>
          
          <form class="modern-newsletter-form">
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Votre email" required>
              <button class="btn btn-primary" type="submit">
                <span>S'abonner</span>
                <i class="bi bi-send-fill ms-2"></i>
              </button>
            </div>
            
            <div class="form-footer">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="newsletter-check" checked>
                <label class="form-check-label" for="newsletter-check">
                  J'accepte de recevoir des conseils personnalisés
                </label>
              </div>
            </div>
          </form>
          
          <div class="trust-badges">
            <div class="badge-item">
              <i class="bi bi-shield-lock"></i>
              <span>100% sécurisé</span>
            </div>
            <div class="badge-item">
              <i class="bi bi-x-circle"></i>
              <span>Désabonnement facile</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Nouveau CTA Immersif -->
<section id="immersion-cta" class="immersion-cta">
  <div class="cta-video-wrapper">
    <video autoplay muted loop playsinline>
      <source src="assets/videos/beach-waves.mp4" type="video/mp4">
    </video>
    <div class="cta-video-overlay"></div>
  </div>
  
  <div class="cta-content-wrapper">
  <div class="container">
    <div class="cta-content" data-aos="zoom-in">
      <h2>Trouvez la Meilleure Place Sans Effort</h2>
      <p class="cta-subtitle">Choisissez votre parking ou laissez EasyParki vous recommander le créneau idéal</p>

      <div class="cta-buttons">
        <a href="ajoutReservation.php" class="btn btn-outline-light btn-lg">
          <i class="bi bi-pencil-square me-2"></i> Réservation manuelle
        </a>
        <a href="suggestionIA.php" class="btn btn-primary btn-lg ms-3">
          <i class="bi bi-magic me-2"></i> Suggestion intelligente
        </a>
      </div>

      <div class="cta-features">
        <div class="feature-item">
          <i class="bi bi-check-circle"></i>
          <span>Créneaux optimisés selon vos préférences</span>
        </div>
        <div class="feature-item">
          <i class="bi bi-check-circle"></i>
          <span>Gain de temps, zéro stress</span>
        </div>
      </div>
    </div>
  </div>
</div>

</section>

<style>
  /* Style pour la nouvelle section inspiration + newsletter */
  .inspiration-section {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
    margin: 80px auto;
    max-width: 1400px;
  }
  
  .inspiration-col, .newsletter-col {
    min-height: 500px;
    position: relative;
  }
  
  .inspiration-col {
    background-size: cover;
    background-position: center;
  }
  
  .inspiration-overlay {
    background: linear-gradient(135deg, rgba(13,63,114,0.85) 0%, rgba(10,29,55,0.😎 100%));
    padding: 60px;
    height: 100%;
    color: white;
  }
  
  .inspiration-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin: 30px 0;
  }
  
  .inspiration-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(5px);
    padding: 25px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.15);
    transition: all 0.3s ease;
  }
  
  .inspiration-card:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.15);
  }
  
  .inspiration-card i {
    font-size: 2rem;
    color: var(--accent-color);
    margin-bottom: 15px;
    display: block;
  }
  
  .newsletter-wrapper {
    padding: 60px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  
  .newsletter-header {
    text-align: center;
    margin-bottom: 40px;
    color: white;
  }
  
  .newsletter-icon {
    font-size: 3rem;
    color: var(--accent-color);
    margin-bottom: 20px;
  }
  
  .modern-newsletter-form {
    max-width: 500px;
    margin: 0 auto;
    width: 100%;
  }
  
  .input-group {
    display: flex;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    border-radius: 50px;
    overflow: hidden;
  }
  
  .form-control {
    padding: 15px 25px;
    border: none;
    background: rgba(255,255,255,0.9);
  }
  
  .btn-primary {
    background: var(--accent-color);
    border: none;
    padding: 15px 30px;
    white-space: nowrap;
  }
  
  .form-footer {
    margin-top: 15px;
    color: rgba(255,255,255,0.8);
    font-size: 0.8rem;
  }
  
  .trust-badges {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
  }
  
  .badge-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
  }
  
  /* Style pour le nouveau CTA immersif */
  .immersion-cta {
    position: relative;
    height: 600px;
    border-radius: 16px;
    overflow: hidden;
    margin: 80px auto;
    max-width: 1400px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
  }
  
  .cta-video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
  
  .cta-video-wrapper video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .cta-video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(13,63,114,0.7) 0%, rgba(10,29,55,0.6) 100%);
  }
  
  .cta-content-wrapper {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
  }
  
  .cta-content {
    text-align: center;
    color: white;
    max-width: 800px;
    margin: 0 auto;
  }
  
  .cta-subtitle {
    font-size: 1.2rem;
    margin-bottom: 30px;
    opacity: 0.9;
  }
  
  .cta-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 40px;
  }
  
  .cta-features {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
  }
  
  .feature-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1.1rem;
  }
  
  @media (max-width: 992px) {
    .inspiration-section .row {
      flex-direction: column;
    }
    
    .inspiration-col, .newsletter-col {
      min-height: auto;
      padding: 60px 30px;
    }
    
    .cta-buttons {
      flex-direction: column;
      gap: 15px;
    }
    
    .immersion-cta {
      height: auto;
      padding: 100px 0;
    }
  }
</style>
    <!-- FAQ Section - Redesigned -->
    <section id="faq" class="faq-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <span>FAQ</span>
          <h2>Questions Fréquentes</h2>
          <p>Trouvez les réponses aux questions les plus posées sur nos services de vacances</p>
        </div>
        
        <div class="row justify-content-center">
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-item">
              <h3>Comment votre solution de gestion de stationnement peut-elle m'aider à réduire les coûts opérationnels et améliorer l'efficacité de mon parc de stationnement ?<i class="faq-toggle bi bi-chevron-down"></i></h3>
              <div class="faq-content">
                <p>Notre solution optimise l’utilisation de l’espace, réduit les coûts de maintenance et améliore la rentabilité grâce à la gestion automatisée et à l’analyse en temps réel.</p>
              </div>
            </div>
            
            <div class="faq-item">
              <h3> Quelles fonctionnalités spécifiques offrez-vous pour garantir une gestion fluide des parkings, surtout en période de forte affluence ?<i class="faq-toggle bi bi-chevron-down"></i></h3>
              <div class="faq-content">
                <p>Elle surveille l’occupation en temps réel, ajuste les tarifs dynamiquement et offre une plateforme mobile pour faciliter l’accès et fluidifier les flux.</p>
              </div>
            </div>
            
            <div class="faq-item">
              <h3>Comment fonctionne l'outil de planification ?<i class="faq-toggle bi bi-chevron-down"></i></h3>
              <div class="faq-content">
                <p>Notre outil de planification vous permet d'organiser chaque jour de vos vacances : hébergement, activités, transports et restaurants. Vous pouvez sauvegarder plusieurs versions et partager vos plans avec vos compagnons de voyage.</p>
              </div>
            </div>
            
            
  </main>

  <!-- Floating Button -->
  <a href="AddReservation.php" class="floating-btn" data-aos="fade-up" data-aos-delay="300" title="Reserver maintenant">
    <i class="bi bi-calendar-plus"></i>
  </a>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            <span class="sitename">EasyParki</span>
          </a>
          <p>EasyParki est une plateforme intelligente et centralisée qui facilite la mobilité urbaine durable en offrant des solutions intégrées pour le stationnement, le covoiturage, les transports publics, la recharge électrique et la gestion d'événements.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="contact.php">À propos de nous</a></li>
            <li><a href="service.php">Nos services</a></li>
            <li><a href="terms.html">Conditions d'utilisation</a></li>
            <li><a href="privacy.html">Politique de confidentialité</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Nos services</h4>
          <ul>
            <li><a href="parking.php">Stationnement</a></li>
            <li><a href="hotel.php">Vacances</a></li>
            <li><a href="covoiturage.php">Covoiturage</a></li>
            <li><a href="service.php">Recharges électriques</a></li>
            <li><a href="event.php">Événements</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contactez-nous</h4>
          <p>18, rue de l'Usine <br>
            ZI Aéroport Charguia II 2035 Ariana<br>
            Tunisie</p>
          <p class="mt-4"><strong>Téléphone :</strong> <span>+216 50 084 004</span></p>
          <p><strong>Email :</strong> <span>contact@easyparki.com</span></p>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">EasyParki</strong> <span>Tous droits réservés</span></p>
      <div class="credits">
        Designé par <a href="#">Asteria</a>
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

  <script>
    // FAQ Toggle
    document.querySelectorAll('.faq-item h3').forEach(question => {
      question.addEventListener('click', () => {
        const item = question.parentElement;
        const content = question.nextElementSibling;
        const icon = question.querySelector('.faq-toggle');
        
        item.classList.toggle('active');
        
        if (item.classList.contains('active')) {
          content.style.maxHeight = content.scrollHeight + 'px';
          icon.classList.replace('bi-chevron-down', 'bi-chevron-up');
        } else {
          content.style.maxHeight = '0';
          icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
        }
        
        // Close other open items
        document.querySelectorAll('.faq-item').forEach(otherItem => {
          if (otherItem !== item && otherItem.classList.contains('active')) {
            otherItem.classList.remove('active');
            otherItem.querySelector('.faq-content').style.maxHeight = '0';
            otherItem.querySelector('.faq-toggle').classList.replace('bi-chevron-up', 'bi-chevron-down');
          }
        });
      });
    });
    
    // Initialize AOS animation
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
      offset: 100
    });
    
    // Initialize PureCounter
    new PureCounter();
    
    // Initialize Swiper
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.init-swiper').forEach(swiperEl => {
        const config = JSON.parse(swiperEl.querySelector('.swiper-config').textContent);
        new Swiper(swiperEl, config);
      });
    });
  </script>

</body>

</html>