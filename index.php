<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>First-Hand Cars | Buy Brand New Cars</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* UNCHANGED STYLING FROM YOUR ORIGINAL CODE */
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
      padding: 15px 30px;
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
      content: ' \25BE'; /* ▼ */
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

    .social-icons {
      position: fixed;
      bottom: 20px;
      left: 20px;
      background: rgba(0, 0, 0, 0.8);
      padding: 10px 15px;
      border-radius: 30px;
      display: flex;
      gap: 15px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

    .social-icons i {
      color: white;
      font-size: 20px;
      transition: transform 0.3s ease, color 0.3s ease;
      cursor: pointer;
    }

    .social-icons i:hover {
      color: #ff5252;
      transform: scale(1.2);
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
  </style>
</head>
<body>

  <!-- NAVIGATION -->
  <nav>
    <a href="#"><i class="fas fa-home"></i> Home</a>
    <a href="#">About Us</a>
    <a href="services.php"><i class="fas fa-car-side"></i> Services</a>

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

  <!-- SOCIAL ICONS -->
  <div class="social-icons">
    <i class="fa-brands fa-instagram"></i>
    <i class="fa-brands fa-facebook"></i>
    <i class="fa-brands fa-youtube"></i>
  </div>

  <!-- HERO SLIDESHOW SECTION -->
  <section class="hero">
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

</body>
</html>
