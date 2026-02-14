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
  <title>Adopt a Pet - Pet Paradise</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #fdfbfb, #ebedee);
    }
    .dark body {
      background: linear-gradient(to right, #1f2937, #111827);
    }
    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body class="text-gray-900 dark:text-white">

  <!-- Navbar -->
  <header class="flex justify-between items-center p-6 bg-white dark:bg-gray-800 shadow-md">
    <h1 class="text-2xl font-bold">🐾 Pet Paradise</h1>
    <nav class="flex items-center gap-6">
      <a href="home.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Home</a>
      <a href="gallery.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Gallery</a>
      <a href="favorites.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Favorites</a>
      <a href="adopt.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Adopt</a>
      <a href="about.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">About</a>
      <a href="contact.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Contact</a>
    </nav>
    <div class="flex items-center gap-4">
      <button onclick="toggleTheme()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">🌓</button>
     
    </div>
  </header>

  <!-- Page Content -->
  <main class="p-6 max-w-3xl mx-auto">
    <h2 class="text-3xl font-bold mb-8 text-center" data-aos="fade-down">🐶 Adopt a Pet</h2>

    <form id="adoptForm" class="glass p-6 rounded-xl shadow-xl space-y-6" data-aos="zoom-in">
      <div>
        <label for="pet" class="block font-semibold mb-1">Choose a Pet</label>
        <select id="pet" name="pet" required class="w-full p-2 rounded border dark:bg-gray-800 dark:border-gray-600">
          <option value="">-- Select a Pet --</option>
          <option value="Max">Max (Dog)</option>
          <option value="Whiskers">Whiskers (Cat)</option>
          <option value="Luna">Luna (Cat)</option>
          <option value="Bella">Bella (Dog)</option>
        </select>
      </div>

      <div>
        <label for="name" class="block font-semibold mb-1">Your Name</label>
        <input type="text" id="name" name="name" required class="w-full p-2 rounded border dark:bg-gray-800 dark:border-gray-600" />
      </div>

      <div>
        <label for="email" class="block font-semibold mb-1">Your Email</label>
        <input type="email" id="email" name="email" required class="w-full p-2 rounded border dark:bg-gray-800 dark:border-gray-600" />
      </div>

      <div>
        <label for="message" class="block font-semibold mb-1">Message (optional)</label>
        <textarea id="message" name="message" rows="4" class="w-full p-2 rounded border dark:bg-gray-800 dark:border-gray-600"></textarea>
      </div>

      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
        Submit Adoption Request
      </button>
    </form>
  </main>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });

    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    // Save and load adoption form data from localStorage
    const form = document.getElementById("adoptForm");
    const petInput = document.getElementById("pet");
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const messageInput = document.getElementById("message");

    // Load saved values on page load
    window.addEventListener("DOMContentLoaded", () => {
      const saved = JSON.parse(localStorage.getItem("latestAdoption") || "{}");
      if (saved.pet) petInput.value = saved.pet;
      if (saved.name) nameInput.value = saved.name;
      if (saved.email) emailInput.value = saved.email;
      if (saved.message) messageInput.value = saved.message;
    });

    // Save form submission in localStorage
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const adoptionData = {
        pet: petInput.value,
        name: nameInput.value,
        email: emailInput.value,
        message: messageInput.value,
        time: new Date().toISOString(),
      };

      // Save latest form
      localStorage.setItem("latestAdoption", JSON.stringify(adoptionData));

      // Append to full history
      const history = JSON.parse(localStorage.getItem("adoptionRequests") || "[]");
      history.push(adoptionData);
      localStorage.setItem("adoptionRequests", JSON.stringify(history));

      alert(`Thank you, ${adoptionData.name}! Your request for ${adoptionData.pet} is saved.`);
      form.reset();
    });
  </script>
</body>
</html>
