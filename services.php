<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Services | First-Hand Cars</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      color: #001f3f;
      line-height: 1.6;
      min-height: 100vh;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: #002f5f;
      color: #fff;
      padding: 10px 18px;
      border-radius: 6px;
      text-decoration: none;
      font-family: monospace;
      font-weight: bold;
      transition: background-color 0.3s ease;
      box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
      z-index: 999;
    }

    .back-button:hover {
      background-color: #001f3f;
    }

    .services-section {
      background-color: #003366; /* Navy Blue */
      color: white;
      padding: 15px 20px 40px;
      text-align: center;
      border-top: 3px solid #f5c518;
      border-bottom: 3px solid #f5c518;
    }

    .services-section h1 {
      font-size: 3rem;
      font-family: Georgia, serif;
      font-weight: bold;
      margin-bottom: 10px;
      color: #ffffff;
    }

    .services-section p {
      font-size: 1.2rem;
      color: #dcdcdc;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      padding: 40px 40px 80px;
      max-width: 1200px;  
      margin: 0 auto;
    }

    .service-card {
      background-color: #f7f7f7;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 25px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .service-card i {
      font-size: 2.5rem;
      color: #003366;
      margin-bottom: 15px;
    }

    .service-card h3 {
      margin-bottom: 10px;
      font-size: 1.3rem;
      color: #001f3f;
    }

    .service-card p {
      font-size: 0.95rem;
      color: #333;
    }

    @media (max-width: 768px) {
      .services-section h1 {
        font-size: 2rem;
      }

      .services-section p {
        font-size: 1rem;
      }

      .back-button {
        top: 10px;
        left: 10px;
        padding: 8px 14px;
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

  <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Home</a>

  <section class="services-section">
    <h1>Our Services</h1>
    <p>We provide full-service solutions for your vehicle buying journey</p>
  </section>

  <section class="services-grid">
    <div class="service-card">
      <i class="fas fa-car"></i>
      <h3>Car Selection Assistance</h3>
      <p>We help you find the right car based on your preferences, needs, and budget.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-money-check-alt"></i>
      <h3>Financing Options</h3>
      <p>Flexible financing solutions to suit your financial situation and get you on the road quickly.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-handshake"></i>
      <h3>Insurance Support</h3>
      <p>We assist in securing the best insurance deals to protect your new vehicle.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-truck"></i>
      <h3>Home Delivery</h3>
      <p>Your chosen car delivered directly to your doorstep for maximum convenience.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-wrench"></i>      
      <h3>Free Service</h3>
      <p>Enjoy free maintenance services for a limited time post-purchase.</p>
    </div>

    <div class="service-card">
      <i class="fas fa-shield-alt"></i>
      <h3>Extended Warranty</h3>
      <p>Optional extended warranties are available for extra peace of mind.</p>
    </div>
  </section>

</body>
</html>
