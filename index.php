<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pet Paradise</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    body, html {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
    }

    /* Background video */
    #bgVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      object-fit: cover;
      z-index: -1;
      filter: brightness(0.4);
    }

    /* Navbar */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background: rgba(0, 0, 0, 0.6);
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      color: white;
      backdrop-filter: blur(10px);
    }

    header h1 {
      font-size: 1.8rem;
      font-weight: 600;
    }

    nav a {
      margin: 0 1rem;
      color: #fff;
      text-decoration: none;
      font-weight: 500;
    }

    .auth-buttons a {
      color: #fff;
      text-decoration: none;
      margin-left: 1rem;
      padding: 0.5rem 1rem;
      border: 1px solid white;
      border-radius: 8px;
      transition: background 0.3s;
    }

    .auth-buttons a:hover {
      background: white;
      color: #111;
    }

    /* Hero Section */
    .hero {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      padding: 0 1rem;
    }

    .hero h2 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.3rem;
      max-width: 700px;
    }

    /* Gallery Preview */
    .gallery-preview {
      padding: 4rem 2rem;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      margin-top: -2rem;
      color: white;
    }

    .gallery-preview h3 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: auto;
    }

    .pet-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .pet-card:hover {
      transform: scale(1.05);
    }

    .pet-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .pet-card div {
      padding: 1rem;
    }

    .pet-card h4 {
      margin-bottom: 0.5rem;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 2rem;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      font-size: 0.9rem;
    }

    footer a {
      color: #fff;
      text-decoration: none;
      margin: 0 0.5rem;
    }

    @media (max-width: 600px) {
      .hero h2 { font-size: 2rem; }
      .hero p { font-size: 1rem; }
    }
  </style>
</head>
<body>

  <!-- Background Video -->
  <video autoplay muted loop id="bgVideo">
    <source src="3045714-hd_1920_1080_25fps.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <!-- Header -->
  <header>
    <h1>🐾 Pet Paradise</h1>
    <div class="auth-buttons">
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
      <a href="alogin.php" class="admin-login-btn">Admin Login</a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div>
      <h2>Find Your Perfect Pet Companion</h2>
      <p>Discover pets from around the world looking for a loving home. Your journey to pet happiness starts here!</p>
    </div>
  </section>




  <!-- Footer -->
  <footer>
    &copy; <?= date("Y") ?> Pet Paradise |
    <a href="https://www.instagram.com/zhyrx_11/?hl=en" target="_blank">Instagram</a>
  </footer>

</body>
</html>
