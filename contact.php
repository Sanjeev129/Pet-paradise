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
  <meta charset="UTF-8">
  <title>Contact Us - Pet Paradise</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #fdfbfb, #ebedee);
    }
    .dark body {
      background: linear-gradient(to right, #1f2937, #111827);
    }
    .glass {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body class="text-gray-900 dark:text-white">

  <!-- Navbar -->
  <header class="flex justify-between items-center p-6 bg-white dark:bg-gray-800 shadow-md">
    <h1 class="text-2xl font-bold">🐾 Pet Paradise</h1>
    <nav class="flex items-center gap-6">
      <a href="home.php" class="hover:text-blue-600 font-semibold">Home</a>
      <a href="gallery.php" class="hover:text-blue-600 font-semibold">Gallery</a>
      <a href="favorites.php" class="hover:text-blue-600 font-semibold">Favorites</a>
      <a href="adopt.php" class="hover:text-blue-600 font-semibold">Adopt</a>
      <a href="about.php" class="hover:text-blue-600 font-semibold">About</a>
      <a href="contact.php" class="text-blue-600 font-semibold">Contact</a>
      
    </nav>
    <div class="flex items-center gap-4">
      <button onclick="toggleTheme()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">🌓</button>
    </div>
  </header>

  <!-- Main Section -->
  <main class="p-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-center" data-aos="fade-down">📬 Contact Us</h2>

    <div class="glass p-6 rounded-xl shadow-lg" data-aos="zoom-in">
      <form id="contactForm" class="space-y-4">
        <div>
          <label class="block mb-1 font-medium">Name</label>
          <input type="text" id="name" required class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-600">
        </div>
        <div>
          <label class="block mb-1 font-medium">Email</label>
          <input type="email" id="email" required class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-600">
        </div>
        <div>
          <label class="block mb-1 font-medium">Message</label>
          <textarea id="message" rows="4" required class="w-full px-4 py-2 rounded border dark:bg-gray-800 dark:border-gray-600"></textarea>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Send Message</button>
        </div>
      </form>
      <p id="successMsg" class="text-green-500 mt-4 hidden">Your message has been saved. Thank you!</p>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });

    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    const form = document.getElementById('contactForm');
    const successMsg = document.getElementById('successMsg');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const message = document.getElementById('message').value.trim();

      const messages = JSON.parse(localStorage.getItem('contactMessages') || '[]');
      messages.push({
        name,
        email,
        message,
        time: new Date().toISOString()
      });

      localStorage.setItem('contactMessages', JSON.stringify(messages));
      form.reset();
      successMsg.classList.remove('hidden');
    });
  </script>
</body>
</html>
