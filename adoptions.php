<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: alogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="white">
<head>
  <meta charset="UTF-8" />
  <title>Adoption Requests - Pet Paradise</title>
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
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body class="text-gray-900 dark:text-white">

  <!-- Navbar -->
  <header class="flex justify-between items-center p-6 bg-white dark:bg-gray-800 shadow-md">
    <h1 class="text-2xl font-bold">🐾 Pet Paradise</h1>
   
    <div class="flex items-center gap-4">
      <button onclick="toggleTheme()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">🌓</button>
    </div>
  </header>

  <main class="p-6 max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold mb-8 text-center" data-aos="fade-down">📋 Adoption Requests</h2>

    <!-- Filters: Status + Search -->
    <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
      <div class="flex items-center gap-2">
        <label for="statusFilter" class="font-semibold">Filter by Status:</label>
        <select id="statusFilter" onchange="loadAdoptionRequests()" class="px-3 py-1 rounded border dark:bg-gray-800 dark:text-white">
          <option value="All">All</option>
          <option value="Pending">Pending</option>
          <option value="Accepted">Accepted</option>
          <option value="Declined">Declined</option>
        </select>
      </div>
      <div class="flex items-center gap-2">
        <label for="searchInput" class="font-semibold">Search:</label>
        <input id="searchInput" type="search" placeholder="Search by Pet, Name, Email..." 
               oninput="loadAdoptionRequests()" 
               class="px-3 py-1 rounded border dark:bg-gray-800 dark:text-white w-full sm:w-72" />
      </div>
    </div>

    <!-- Requests Table -->
    <div id="requestsContainer" class="overflow-x-auto glass p-4 rounded-xl shadow-xl" data-aos="zoom-in">
      <table id="requestsTable" class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
            <th class="p-3">#</th>
            <th class="p-3">Pet</th>
            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Message</th>
            <th class="p-3">Date</th>
            <th class="p-3">Status</th>
            <th class="p-3">Actions</th>
          </tr>
        </thead>
        <tbody id="requestsBody" class="text-sm dark:text-gray-100"></tbody>
      </table>
      <p id="noData" class="text-center text-gray-600 dark:text-gray-400 mt-6 hidden">No adoption requests found.</p>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });

    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    function loadAdoptionRequests() {
      const requests = JSON.parse(localStorage.getItem("adoptionRequests") || "[]");
      const tbody = document.getElementById("requestsBody");
      const noData = document.getElementById("noData");
      const filter = document.getElementById("statusFilter").value.toLowerCase();
      const searchTerm = document.getElementById("searchInput").value.toLowerCase();

      tbody.innerHTML = "";

      // Filter by status
      let filtered = requests.filter(r => filter === "all" || (r.status && r.status.toLowerCase() === filter));

      // Filter by search term in pet, name, email
      if (searchTerm) {
        filtered = filtered.filter(r =>
          (r.pet && r.pet.toLowerCase().includes(searchTerm)) ||
          (r.name && r.name.toLowerCase().includes(searchTerm)) ||
          (r.email && r.email.toLowerCase().includes(searchTerm))
        );
      }

      if (filtered.length === 0) {
        noData.classList.remove("hidden");
        return;
      }
      noData.classList.add("hidden");

      filtered.forEach((req, index) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td class="p-3 border-b">${index + 1}</td>
          <td class="p-3 border-b">${req.pet}</td>
          <td class="p-3 border-b">${req.name}</td>
          <td class="p-3 border-b">${req.email}</td>
          <td class="p-3 border-b">${req.message || "-"}</td>
          <td class="p-3 border-b">${new Date(req.time).toLocaleString()}</td>
          <td class="p-3 border-b font-semibold">${req.status || "Pending"}</td>
          <td class="p-3 border-b space-x-2">
            <button onclick="updateStatus(${requests.indexOf(req)}, 'Accepted')" class="px-2 py-1 bg-green-600 text-white text-xs rounded">✔ Accept</button>
            <button onclick="updateStatus(${requests.indexOf(req)}, 'Declined')" class="px-2 py-1 bg-yellow-600 text-white text-xs rounded">✖ Decline</button>
            <button onclick="deleteRequest(${requests.indexOf(req)})" class="px-2 py-1 bg-red-600 text-white text-xs rounded">🗑️ Delete</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }

    function updateStatus(index, newStatus) {
      const requests = JSON.parse(localStorage.getItem("adoptionRequests") || "[]");
      if (requests[index]) {
        requests[index].status = newStatus;
        localStorage.setItem("adoptionRequests", JSON.stringify(requests));
        loadAdoptionRequests();
      }
    }

    function deleteRequest(index) {
      const requests = JSON.parse(localStorage.getItem("adoptionRequests") || "[]");
      if (index >= 0 && confirm("Are you sure you want to delete this request?")) {
        requests.splice(index, 1);
        localStorage.setItem("adoptionRequests", JSON.stringify(requests));
        loadAdoptionRequests();
      }
    }

    window.addEventListener("DOMContentLoaded", loadAdoptionRequests);
  </script>
</body>
</html>
