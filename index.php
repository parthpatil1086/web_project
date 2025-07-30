<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>First-Hand Cars | Buy Brand New Cars</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      color: #222;
      line-height: 1.6;
    }

    nav {
      position: sticky;
      top: 0;
      background-color: #1b1f3a;
      padding: 20px 35px;
      display: flex;
      align-items: center;
      gap: 25px;
      z-index: 100;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
      font-size: 16px;
      transition: opacity 0.3s ease;
    }

    nav a:hover {
      opacity: 0.7;
    }

    .nav-right {
      margin-left: auto;
      position: relative;
    }

    .dropdown {
      position: relative;
    }

    .dropdown > a::after {
      content: ' \25BE'; 
      font-size: 0.7em;
      margin-left: 4px;
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #1b1f3a;
      display: none;
      flex-direction: column;
      min-width: 200px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .dropdown-menu a {
      padding: 10px 15px;
      color: #fff;
      text-decoration: none;
      border-bottom: 1px solid #2e335a;
    }

    .dropdown-menu a:hover {
      background-color: #2a2f5a;
    }

    .dropdown:hover .dropdown-menu {
      display: flex;
    }

    .hero {
      position: relative;
      width: 100%;
      height: 85vh;
      overflow: hidden;
      border-top: 4px double #f5deb3;
      border-bottom: 4px double #f5deb3;
    }

    .hero-slide {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .hero-slide.active {
      opacity: 1;
      z-index: 1;
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(15, 15, 15, 0.85);
      padding: 60px 50px;
      color: #f5deb3;
      max-width: 600px;
      border-left: 5px double #f5deb3;
      border-right: 5px double #f5deb3;
      box-shadow: 0 0 15px rgba(0,0,0,0.6);
      border-radius: 12px;
      text-align: center;
      z-index: 2;
    }

    .hero-content h1 {
      font-family: Georgia, serif;
      font-size: 3.5rem;
      margin-bottom: 20px;
    }

    .hero-content p {
      font-size: 1.25rem;
      margin-bottom: 30px;
    }

    .btn-vintage {
      background-color: #d62828;
      color: #fff;
      padding: 12px 28px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-family: monospace;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4);
      letter-spacing: 1px;
    }

    .btn-vintage:hover {
      background-color: #a61c1c;
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      .hero-content {
        padding: 30px 20px;
      }

      .hero-content h1 {
        font-size: 2.2rem;
      }

      .hero-content p {
        font-size: 1rem;
      }

      .hero {
        height: 65vh;
      }
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      scroll-behavior: smooth;
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      color: #000;
    }

    ::selection {
      background: #001f3f;
      color: #fff;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('https://cdn.pixabay.com/photo/2017/04/26/14/02/auto-2268758_1280.jpg') no-repeat center center fixed;
      background-size: cover;
      filter: brightness(1);
      z-index: -2;
    }

    body::after {
      content: "";
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.75);
      z-index: -1;
    }

    section {
      min-height: 100vh;
      padding: 100px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 40px;
      border-bottom: 2px solid rgba(0, 31, 63, 0.1);
    }

    .fade-up {
      opacity: 0;
      transform: translateY(50px);
      transition: all 0.8s ease-in-out;
    }

    .fade-up.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .info-content h2,
    .popular-heading,
    .superior-text h2 {
      font-family: 'Oswald', sans-serif;
      font-size: 3.2rem;
      color: #001f3f;
      text-align: center;
      width: 100%;
      position: relative;
    }

    .info-content h2::after,
    .popular-heading::after,
    .superior-text h2::after {
      content: "";
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: #001f3f;
      border-radius: 2px;
    }

    .tile-grid, .car-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      width: 100%;
      max-width: 1200px;
    }

    .tile-box {
      min-height: 260px;
      display: flex;
      align-items: flex-end;
      padding: 15px;
      font-weight: 700;
      font-size: 1.3rem;
      background-size: cover;
      background-position: center;
      background-color: rgba(255, 255, 255, 0.15);
      color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 31, 63, 0.3);
      transition: transform 0.3s, box-shadow 0.3s, border 0.3s;
      cursor: pointer;
    }

    .tile-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0,31,63,0.5);
      border: 2px solid #001f3f;
    }

    .car-box {
      background: #fff;
      color: #000;
      text-align: center;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      transition: transform 0.3s ease, border 0.3s ease;
      cursor: pointer;
    }

    .car-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0,31,63,0.5);
      border: 2px solid #001f3f;
    }

    .car-box img {
      width: 100%;
      height: 260px;
      object-fit: cover;
    }

    .car-box h3 {
      font-size: 1.6rem;
      margin: 15px 0 10px;
    }

    .car-box p {
      font-size: 1rem;
      margin-bottom: 15px;
    }

    .popular-wrapper, .superior-wrapper {
      max-width: 1200px;
      width: 100%;
    }

    .superior-wrapper {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      gap: 40px;
      align-items: center;
    }

    .superior-text {
      flex: 1;
    }

    .superior-text p {
      font-size: 1.1rem;
      color: #222;
      line-height: 1.6;
    }

    .superior-image {
      flex: 1;
    }

    .superior-image img {
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    footer {
      background: #f9f9f9;
      color: #000;
      padding: 60px 30px;
      text-align: center;
    }

    footer h3 {
      margin-bottom: 15px;
      font-size: 1.7rem;
      color: #001f3f;
    }

    .social-icons-footer {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 15px;
    }

    .social-icons-footer i {
      font-size: 26px;
      cursor: pointer;
      color: #001f3f;
      transition: color 0.3s;
    }

    .social-icons-footer i:hover {
      color: #000;
    }

    .footer-contact-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 40px;
      margin-top: 60px;
      text-align: left;
      border-top: 1px solid #ccc;
      padding-top: 40px;
    }

    .footer-contact-grid ul {
      list-style: none;
      padding: 0;
    }

    .footer-contact-grid ul li {
      margin-bottom: 10px;
      font-size: 0.95rem;
    }

    .footer-contact-grid ul li strong {
      color: #001f3f;
      font-size: 1.05rem;
      display: block;
      margin-bottom: 10px;
    }

    .footer-contact-grid a {
      color: #333;
      text-decoration: none;
      transition: color 0.3s;
    }

    .footer-contact-grid a:hover {
      color: #001f3f;
    }

    @media (max-width: 992px) {
      .superior-wrapper {
        flex-direction: column;
        text-align: center;
      }

      .superior-text h2,
      .popular-heading,
      .info-content h2 {
        text-align: center;
        font-size: 2.2rem;
      }
    }

   html {
  scroll-behavior: smooth;
}

  .footer {
  background-color: #001f3f;
  color: #fff;
  text-align: center;
  padding: 20px 10px;
  font-size: 14px;
  margin-top: 40px;
}
  </style>
</head>
<body>

  <nav>
    <a href="index.php#index_main"><i class="fas fa-home"></i> Home</a>
    <a href="services.php"><i class="fas fa-car-side"></i> Services</a>
    <a href="index.php#contact"><i class="fas fa-phone"></i> Contact</a>
    <a href="index.php#about-us"><i class="fas fa-circle-info"></i> About Us</a>

    <div class="nav-right dropdown">
      <?php if (isset($_SESSION['username'])): ?>
        <a href="#">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
        <div class="dropdown-menu">
          <a href="logout.php">Logout</a>
        </div>
      <?php else: ?>
        <a href="#">Login</a>
        <div class="dropdown-menu">
          <a href="admin_login.php">Admin Login</a>
          <a href="customer_login.php">Customer Login</a>
          <a href="new_customer_register.php">New Customer Registration</a>
        </div>
      <?php endif; ?>
    </div>
  </nav>

  <section class="hero" id="index_main">
    <img src="images/car1.webp" class="hero-slide active" alt="Car 1">
    <img src="images/car2.webp" class="hero-slide" alt="Car 2">
    <img src="images/car3.webp" class="hero-slide" alt="Car 3">
    <img src="images/car4.jpg" class="hero-slide" alt="Car 4">

    <div class="hero-content">
      <h1>Buy Brand New Cars</h1>
      <p>Explore our wide range of first-hand cars with verified specs and manufacturer warranty. Book your dream ride today!</p>
      <a href="car_collection.php"><button class="btn-vintage">BROWSE COLLECTION</button></a>
    </div>
  </section>

  <script>
    let current = 0;
    const slides = document.querySelectorAll('.hero-slide');

    function nextHeroSlide() {
      slides.forEach((slide) => slide.classList.remove('active'));
      current = (current + 1) % slides.length;
      slides[current].classList.add('active');
    }
    setInterval(nextHeroSlide, 4000);
  </script>

  <section class="fade-up">
    <div class="info-content">
      <h2>WHY ALWAYS TRUESTART MOTORS?</h2>
    </div>
    <div class="tile-grid">
      <div class="tile-box" style="background-image: url('https://www.livemint.com/lm-img/img/2025/03/04/600x338/investor_1739974679916_1741070234686.jpg');">Financing For You</div>
      <div class="tile-box" style="background-image: url('https://img.freepik.com/premium-photo/service-concept-person-hand-holding-service-icon-virtual-screen_1296497-175.jpg');">Service is #1 Since 1980</div>
      <div class="tile-box" style="background-image: url('https://www.shutterstock.com/image-photo/transportation-new-very-expensive-cars-260nw-2225940955.jpg');">250+ Vehicles in Stock</div>
      <div class="tile-box" style="background-image: url('https://www.livemint.com/lm-img/img/2025/07/18/600x338/investor_1735983197002_1752834788800.jpg');">Best Rates Guaranteed</div>
    </div>
  </section>
  
  <section class="fade-up">
    <div class="popular-wrapper">
      <h2 class="popular-heading">POPULAR</h2>
      <div class="car-grid">
        <div class="car-box">
          <img src="https://stimg.cardekho.com/images/carexteriorimages/630x420/Hyundai/Creta/7695/1651645683867/front-left-side-47.jpg" alt="Hyundai Creta" />
          <h3>Hyundai Creta</h3>
          <p>Reg-Year: 2022 | Kms: 25,000 | Fuel: Petrol</p>
        </div>
        <div class="car-box">
          <img src="https://media.assettype.com/evoindia/2020-10/c90a66fd-a65f-4fe5-860f-e89f46fbea7c/Kia_Seltos_Anniversary_Edition__1_.jpg" alt="Kia Seltos" />
          <h3>Kia Seltos</h3>
          <p>Reg-Year: 2021 | Kms: 30,000 | Fuel: Diesel</p>
        </div>
        <div class="car-box">
          <img src="https://i.pinimg.com/736x/bb/93/25/bb932535cda32c122661799b180e633f.jpg" alt="Maruti Baleno" />
          <h3>Maruti Baleno</h3>
          <p>Reg-Year: 2020 | Kms: 40,000 | Fuel: Petrol</p>
        </div>
        <div class="car-box">
          <img src="https://www.tatamotors.com/wp-content/uploads/2023/10/Nexon-EV-MAX-DARK-Front-3-4th-1.jpg" alt="Tata Nexon" />
          <h3>Tata Nexon</h3>
          <p>Reg-Year: 2023 | Kms: 10,000 | Fuel: Electric</p>
        </div>
      </div>
    </div>
  </section>

  <section class="fade-up">
    <div class="superior-wrapper">
      <div class="superior-text">
        <h2>Superior Parts & Service</h2>
        <p>Our ASE Master and Certified technicians take special care to diagnose, service, and repair your ride so you can get back on the road fast! Travel with the peace of mind that comes from service work completed at Truestart Motors Sales!</p>
      </div>
      <div class="superior-image">
        <img src="https://resources.servicemycar.com/upimages/blogs/Here-is-Everything-You-Need-to-Know-About-Getting-a-Car-Service-min-20210323120345.png" alt="Superior Service">
      </div>
    </div>
  </section>

  <footer id="about-us">
    <h3>About Our Company</h3>
    <p><strong>TrueStart Motors</strong> is a leading-edge automobile company dedicated to delivering high-performance, reliable, and stylish vehicles to modern drivers. Founded with a vision to revolutionize the driving experience, TrueStart Motors blends innovative engineering with precision design to create cars that not only move but inspire.</p>

  <p>At TrueStart Motors, we believe your journey matters from your first ignition to every destination beyond. With a commitment to excellence, customer satisfaction, and continuous innovation, we are shaping the future of mobility one car at a time.</p><br>
    <p>Our dedicated service centers and responsive support team ensure a seamless ownership journey from booking to maintenance and beyond.</p>

  <p>With our upcoming electric vehicle (EV) lineup and green manufacturing practices, TrueStart Motors is proud to contribute to a cleaner, sustainable automotive future.</p><br>

  <p><strong>Our Mission:</strong> To empower every driver with a vehicle that reflects their ambition and values.</p>

  <p><strong>Our Vision:</strong> To become India’s most admired automotive company by putting innovation, integrity, and customer satisfaction at the heart of everything we do.</p><br><br>
  <h4><strong>TrueStart Motors Where every drive is a new beginning.</strong></h4>

    <div class="social-icons-footer">
      <i class="fab fa-facebook"></i>
      <i class="fab fa-instagram"></i>
      <i class="fab fa-youtube"></i>
    </div>

    <div id="contact" class="footer-contact-grid">
      <ul>
        <li><strong>Contact</strong></li>
        <li><a href="#">number</a></li>
        <li><a href="#">number</a></li>
        <li><a href="#">number</a></li>
        <li><a href="#">number</a></li>
      </ul>
      <ul>
        <li><strong>Support</strong></li>
        <li><a href="#">support_number</a></li>
        <li><a href="#">support_number</a></li>
        <li><a href="#">support_number</a></li>
      </ul>
      <ul>
        <li><strong>Our Branch locations</strong></li>
        <li><a href="#">location 1</a></li>
        <li><a href="#">location 2</a></li>
        <li><a href="#">location 3</a></li>
      </ul>
    </div>
  </footer>

  <div class="footer">
  &copy; 2025 <strong>TrueStart Motors</strong>. All rights reserved.
  </div>

  <script>
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
  </script>
  
</body>
</html>
