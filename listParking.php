<?php
include 'C:/xampp/htdocs/gestion parking/Controller/ParkingP.php';

$c = new ParkingP();
$tab = $c->ListeParking();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>EasyParki - EasyParki Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <style>
    /* Dropdown styling */
    .nav-item.dropdown {
      position: relative;
    }
  
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      min-width: 220px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      padding: 10px 0;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
    }
  
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
  
    .dropdown-item {
      padding: 12px 20px;
      color: #0a1d37 !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.2s ease;
      position: relative;
      overflow: hidden;
    }
  
    .dropdown-item:before {
      content: '';
      position: absolute;
      left: -100%;
      top: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #4da6ff33 0%, #0a1d3733 100%);
      transition: all 0.3s ease;
      z-index: -1;
    }
  
    .dropdown-item:hover {
      padding-left: 25px;
      color: #0a1d37 !important;
    }
  
    .dropdown-item:hover:before {
      left: 0;
    }
  
    .dropdown-item i {
      color: #4da6ff;
      font-size: 1.2em;
      transition: all 0.3s ease;
    }
  
    .dropdown-item:hover i {
      transform: scale(1.1);
    }
    /* Add custom card styles */
    .parking-cards {
      padding: 50px 0;
    }

    .parking-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      margin-bottom: 30px;
      overflow: hidden;
    }

    .parking-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 32px rgba(0,0,0,0.15);
    }

    .card-header {
      background: #0a1d37;
      color: #fff;
      padding: 20px;
      position: relative;
    }

    .card-category {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #4da6ff;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.9em;
    }

    .card-body {
      padding: 25px;
    }

    .parking-info {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .parking-info i {
      color: #4da6ff;
      font-size: 1.2em;
      width: 25px;
      text-align: center;
    }

    .parking-status {
      display: flex;
      justify-content: space-between;
      background: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-top: 20px;
    }

    .available-spaces {
      color: #28a745;
      font-weight: 600;
    }
  </style>

  <!-- Favicons -->
  <link href="assets/img/logoo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

</head>

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
      background: url('assets/img/55.png') center/cover no-repeat;
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
.card-category {
    background: #0a1d37; /* Bleu foncé */
    color: #ffffff; /* Texte blanc */
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.9em;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Ombre subtile */
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

    
    <section class="parking-cards">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <?php foreach ($tab as $parking) { ?>
            <div class="col-lg-4 col-md-6">
              <div class="parking-card">
                <div class="card-header">
                  <h3><?= $parking['Nom_Parking'] ?></h3>                  
                  <span class="card-category"><?= $parking['Adresse_Parking'] ?> </span>
                </div>
                <div class="card-body">
                  <div class="parking-info">
                  <i class="bi bi-box"></i> <!-- Icône pour la capacité totale -->
                  <div>
                      <p class="mb-0"><?= $parking['Capacite_Totale'] ?></p>
                    </div>
                  </div>

                  <div class="parking-status">
                    <div>
                      <p class="mb-0 small text-muted">Horaire</p>
                      <p class="mb-0"><?= $parking['Horaire_Ouv'] ?> h</p>
		                  <p class="mb-0"><?= $parking['Horaire_Ferm'] ?> h</p>
                    </div>
                    <div>
                      <p class="mb-0 small text-muted">Available Now</p>
                      <p class="mb-0 available-spaces"><?= $parking['Nombre_Dispo'] ?> Disponibles</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

  

 


</main>

<footer id="footer" class="footer dark-background">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-5 col-md-12 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="sitename">EasyParki</span>
        </a>
        <p>EasyParki est une plateforme intelligente et centralisée qui facilite la mobilité urbaine durable en offrant des solutions intégrées pour le stationnement, le covoiturage, les transports publics, la recharge électrique et la gestion d’événements.</p>
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
          <li><a href="#">Accueil</a></li>
          <li><a href="#">À propos de nous</a></li>
          <li><a href="#">Nos services</a></li>
          <li><a href="#">Conditions d'utilisation</a></li>
          <li><a href="#">Politique de confidentialité</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-6 footer-links">
        <h4>Nos services</h4>
        <ul>
          <li><a href="#">Stationnement</a></li>
          <li><a href="#">Vacances</a></li>
          <li><a href="#">Covoiturage</a></li>
          <li><a href="#">Recharges électriques</a></li>
          <li><a href="#">Evenement</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
        <h4>Contactez-nous</h4>
        <p>18, rue de l'Usine </p>
        <p> ZI Aéroport Charguia II 2035 Ariana</p>
        <p>Tunisie</p>
        <p class="mt-4"><strong>Téléphone :</strong> <span>+216 50 084 004</span></p>
        <p><strong>Email :</strong> <span>contact@easyparki.com</span></p>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">EasyParki</strong> <span>Tous droits réservés</span></p>
    <div class="credits">
      <!-- Tous les liens dans le footer doivent rester intacts. -->
      <!-- Vous pouvez supprimer les liens uniquement si vous avez acheté la version pro. -->
      <!-- Informations sur la licence : https://bootstrapmade.com/license/ -->
      <!-- Achetez la version pro avec un formulaire de contact PHP/AJAX fonctionnel : [buy-url] -->
      Designé par <a href="https://bootstrapmade.com/">Asteria</a>
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