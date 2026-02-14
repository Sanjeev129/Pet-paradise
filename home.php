<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Home - Pet Paradise</title></head>
<body>
    <strong><h2>Hello Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!👋</h2></strong>
    <p>You're now logged in to <strong>Pet Paradise</strong>.</p>
    <p><b><a href="logout.php">Logout</a></b></p>
</body>
</html>
<!DOCTYPE html>
<html lang="en" class="White">
<head>
  <meta charset="UTF-8" />
  <title>Pet Paradise - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <style>
    html {
      scroll-behavior: smooth;
    }
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
  

  <!-- Hero Banner -->
  <section
    class="text-center py-20 bg-gradient-to-r from-blue-400 to-indigo-500 text-white"
  >
    <h2 class="text-4xl font-bold mb-4">Find Your Perfect Pet</h2>
    <p class="mb-6 text-lg">
      Browse by category, search your favorites, and save them!
    </p>

    
    

    <div class="flex flex-wrap justify-center gap-4 mt-6">
     <a
        href="gallery.php"
        class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-gray-200 transition inline-block"
      >
      🔍 Explore Pets
      
      </a>
          

      <a
        href="adopt.php"
        class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-gray-200 transition inline-block"
      >
        Adopt a Pet
      </a>
       <a
        href="subscribe.php"
        class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-gray-200 transition inline-block"
      >
        Subscribe for Updates
      </a>
    </div>
  </section>


  

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    const pets = [
      { name: "Max", type: "Dog", img: "https://placedog.net/400/300?id=1" },
      { name: "Whiskers", type: "Cat", img: "6.jpg" },
      { name: "Thumper", type: "Bird", img: "7.jpg" },
      { name: "Puff", type: "Hamster", img: "8.jpg" },
      { name: "Bella", type: "Dog", img: "9.jpg" },
      { name: "Luna", type: "Cat", img: "10.jpg" },
      { name: "Max", type: "Dog", img: "https://placedog.net/400/300?id=1" },
      { name: "Whiskers", type: "Cat", img: "6.jpg" },
      { name: "Thumper", type: "Bird", img: "7.jpg" },
      { name: "Puff", type: "Hamster", img: "8.jpg" },
      { name: "Bella", type: "Dog", img: "9.jpg" },
      { name: "Luna", type: "Cat", img: "10.jpg" },
      { name: "Max", type: "Dog", img: "https://placedog.net/400/300?id=1" },
      { name: "Whiskers", type: "Cat", img: "6.jpg" },
      { name: "Thumper", type: "Bird", img: "7.jpg" },
      { name: "Puff", type: "Hamster", img: "8.jpg" },
      { name: "Bella", type: "Dog", img: "9.jpg" },
      { name: "Luna", type: "Cat", img: "10.jpg" },
    ];

    const searchBar = document.getElementById("searchBar");
    const categoryDropdown = document.getElementById("category");
    const favoritesList = document.getElementById("favoritesList");

    function renderPets(list = pets) {
      const gallery = document.getElementById("gallery");
      gallery.innerHTML = "";
      list.forEach((pet) => {
        const card = document.createElement("div");
        card.className = "glass p-4 rounded-xl shadow-lg text-center";
        card.setAttribute("data-aos", "fade-up");
        card.innerHTML = `
          <img src="${pet.img}" alt="${pet.name}" class="w-full h-32 object-cover rounded mb-2" />
          <h4 class="font-semibold">${pet.name}</h4>
          <p class="text-sm mb-2">${pet.type}</p>
          <button onclick="addFavorite('${pet.name}')" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">❤️ Favorite</button>
        `;
        gallery.appendChild(card);
      });
      AOS.refresh();
    }

    function addFavorite(name) {
      const pet = pets.find((p) => p.name === name);
      const favs = JSON.parse(localStorage.getItem("favorites") || "[]");
      if (!favs.find((f) => f.name === name)) {
        favs.push(pet);
        localStorage.setItem("favorites", JSON.stringify(favs));
        renderFavorites();
      }
    }

    function removeFavorite(name) {
      let favs = JSON.parse(localStorage.getItem("favorites") || "[]");
      favs = favs.filter((p) => p.name !== name);
      localStorage.setItem("favorites", JSON.stringify(favs));
      renderFavorites();
    }

    function renderFavorites() {
      const favs = JSON.parse(localStorage.getItem("favorites") || "[]");
      favoritesList.innerHTML = "";
      favs.forEach((pet) => {
        const card = document.createElement("div");
        card.className = "glass p-4 rounded-xl shadow-md text-center";
        card.innerHTML = `
          <img src="${pet.img}" alt="${pet.name}" class="w-full h-32 object-cover rounded mb-2" />
          <h4 class="font-semibold">${pet.name}</h4>
          <p class="text-sm mb-2">${pet.type}</p>
          <button onclick="removeFavorite('${pet.name}')" class="bg-red-500 text-white px-2 py-1 rounded text-sm">🗑 Remove</button>
        `;
        favoritesList.appendChild(card);
      });
    }

    function applyFilters() {
      const term = searchBar.value.toLowerCase();
      const category = categoryDropdown.value;
      const filtered = pets.filter(
        (p) =>
          (category === "All" || p.type === category) &&
          (p.name.toLowerCase().includes(term) || p.type.toLowerCase().includes(term))
      );
      renderPets(filtered);
    }

    // Events
    searchBar.addEventListener("input", (e) => {
      localStorage.setItem("searchTerm", e.target.value.toLowerCase());
      applyFilters();
    });

    categoryDropdown.addEventListener("change", (e) => {
      localStorage.setItem("selectedCategory", e.target.value);
      applyFilters();
    });

    document.getElementById("resetFilters").addEventListener("click", () => {
      localStorage.removeItem("selectedCategory");
      localStorage.removeItem("searchTerm");
      categoryDropdown.value = "All";
      searchBar.value = "";
      renderPets(pets);
    });

    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    window.addEventListener("DOMContentLoaded", () => {
      const savedCategory = localStorage.getItem("selectedCategory") || "All";
      const savedSearch = localStorage.getItem("searchTerm") || "";
      categoryDropdown.value = savedCategory;
      searchBar.value = savedSearch;
      applyFilters();
      renderFavorites();
    });

    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>


<!DOCTYPE html>
<html lang="en" class="white">
<head>
  <meta charset="UTF-8" />
  <title>Pet Paradise - Favorites</title>
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


  <main class="p-6 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-center">❤️ Your Favorite Pets</h2>
    <div
      id="favoritesList"
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
    ></div>
  </main>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    function renderFavorites() {
      const favoritesList = document.getElementById("favoritesList");
      const favs = JSON.parse(localStorage.getItem("favorites") || "[]");
      favoritesList.innerHTML = "";

      if (favs.length === 0) {
        favoritesList.innerHTML = `<p class="text-center col-span-full text-gray-600 dark:text-gray-400">You have no favorites saved yet.</p>`;
        return;
      }

      favs.forEach((pet) => {
        const card = document.createElement("div");
        card.className = "glass p-4 rounded-xl shadow-md text-center";
        card.setAttribute("data-aos", "fade-up");
        card.innerHTML = `
          <img src="${pet.img}" alt="${pet.name}" class="w-full h-32 object-cover rounded mb-2" />
          <h4 class="font-semibold">${pet.name}</h4>
          <p class="text-sm mb-2">${pet.type}</p>
          <button onclick="removeFavorite('${pet.name}')" class="bg-red-500 text-white px-2 py-1 rounded text-sm">🗑 Remove</button>
        `;
        favoritesList.appendChild(card);
      });
      AOS.refresh();
    }

    function removeFavorite(name) {
      let favs = JSON.parse(localStorage.getItem("favorites") || "[]");
      favs = favs.filter((p) => p.name !== name);
      localStorage.setItem("favorites", JSON.stringify(favs));
      renderFavorites();
    }

    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    window.addEventListener("DOMContentLoaded", () => {
      renderFavorites();
    });

    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>
