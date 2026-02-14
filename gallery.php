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
  <title>Pet Paradise - Gallery</title>
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
      <a href="adopt.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Adopt pets</a>
      <a href="favorites.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Favorites</a>
      <a href="about.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">About</a>
      <a href="contact.php" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-semibold">Contact</a>
    </nav>
    <div class="flex items-center gap-4">
      <button onclick="toggleTheme()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">🌓</button>
     
    </div>
  </header>

  <main class="p-6 max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-center">🐶 Pet Gallery</h2>

    <!-- Search Bar -->
    <div class="max-w-md mx-auto mb-8">
      <input
        type="text"
        id="searchInput"
        placeholder="Search pets by name or type..."
        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
        autocomplete="off"
      />
    </div>

    <div
      id="gallery"
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
    ></div>
  </main>

  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    const pets = [
      { name: "Max", type: "Dog", img: "https://placedog.net/400/300?id=1" },
      { name: "Whiskers", type: "Parrot", img: "11.jpg" },
      { name: "Thumper", type: "Rabbit", img: "15.jpg" },
      { name: "Puff", type: "Hamster", img: "https://placebear.com/400/300" },
      { name: "Bella", type: "Dog", img: "https://placedog.net/400/300?id=2" },
      { name: "Luna", type: "Cat", img: "https://placekitten.com/401/300" },
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

    const gallery = document.getElementById("gallery");
    const searchInput = document.getElementById("searchInput");

    function renderPets(list = pets) {
      gallery.innerHTML = "";
      if(list.length === 0) {
        gallery.innerHTML = `<p class="col-span-full text-center text-gray-600 dark:text-gray-400">No pets found.</p>`;
        return;
      }
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
        alert(`${name} added to favorites!`);
      } else {
        alert(`${name} is already in favorites.`);
      }
    }

    // Search function filtering pets by name or type (case-insensitive)
    function handleSearch() {
      const query = searchInput.value.trim().toLowerCase();
      const filteredPets = pets.filter(pet =>
        pet.name.toLowerCase().includes(query) || pet.type.toLowerCase().includes(query)
      );
      renderPets(filteredPets);
      localStorage.setItem("gallerySearchInput", searchInput.value);
    }

    // Theme toggle
    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    // Load saved search input from localStorage on page load
    window.addEventListener("DOMContentLoaded", () => {
      const savedSearch = localStorage.getItem("gallerySearchInput") || "";
      searchInput.value = savedSearch;
      handleSearch();
    });

    searchInput.addEventListener("input", handleSearch);

    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>
