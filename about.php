<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="white">
<head>
  <meta charset="UTF-8" />
  <title>Pet Paradise - About</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #f0f4f8, #d9e2ec);
    }
    .dark body {
      background: linear-gradient(to right, #1f2937, #111827);
    }
    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body class="text-gray-900 dark:text-gray-100">

  <!-- Navbar -->
  <header class="flex justify-between items-center p-6 bg-white dark:bg-gray-800 shadow-md">
    <h1 class="text-2xl font-bold">🐾 Pet Paradise</h1>
    <nav class="flex items-center gap-6">
      <a href="home.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Home</a>
      <a href="gallery.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Gallery</a>
      <a href="favorites.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Favorites</a>
      <a href="about.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">About</a>
      <a href="adopt.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Adopt pets</a>
      <a href="contact.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Contact</a>
    </nav>
    <div class="flex items-center gap-4">
      <button onclick="toggleTheme()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">🌓</button>
      
    </div>
  </header>

  <main class="p-6 max-w-3xl mx-auto text-center glass rounded-xl shadow-lg mt-10">
    <h2 class="text-3xl font-bold mb-6" data-aos="fade-down">About Pet Paradise</h2>
    <p class="text-lg mb-4" data-aos="fade-up" data-aos-delay="200">
      Welcome to <strong>Pet Paradise</strong>, your ultimate platform for discovering the perfect pet companion! Whether you're looking for a loyal dog, a playful cat, or a charming hamster, we have it all.
    </p>
    <p class="text-lg mb-4" data-aos="fade-up" data-aos-delay="400">
      Our mission is to connect pet lovers with their ideal friends, making it easy to browse, search, and save your favorites. Enjoy a clean, modern design with features that help you find the pet that fits your lifestyle.
    </p>
    <p class="text-lg" data-aos="fade-up" data-aos-delay="600">
      Thanks for visiting Pet Paradise. We hope you find your new best friend here!
    </p>
  </main>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>
