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
  <title>Contact Messages - Pet Paradise</title>
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
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    table tr:hover {
      background-color: rgba(59, 130, 246, 0.1); /* Tailwind blue-500 with opacity */
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

  <!-- Main Content -->
  <main class="p-6 max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-center" data-aos="fade-down">📩 Your Contact Messages</h2>

    <!-- Controls: Search + Clear All -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
      <input id="searchInput" type="search" placeholder="Search by name, email, or message..." 
             oninput="loadMessages()" 
             class="px-4 py-2 rounded border dark:bg-gray-800 dark:text-white w-full sm:w-80" />

      <button onclick="clearAllMessages()" 
              class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded shadow-md transition duration-200">
        🗑️ Clear All Messages
      </button>
    </div>

    <div class="glass p-6 rounded-xl shadow-lg" data-aos="zoom-in">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead class="bg-gray-200 dark:bg-gray-700">
            <tr class="text-gray-900 dark:text-white">
              <th class="p-3">#</th>
              <th class="p-3">Name</th>
              <th class="p-3">Email</th>
              <th class="p-3">Message</th>
              <th class="p-3">Date</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody id="messageBody" class="text-sm dark:text-gray-100"></tbody>
        </table>
        <p id="noMessages" class="text-center text-gray-600 dark:text-gray-400 mt-6 hidden">No messages submitted yet.</p>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });

    function toggleTheme() {
      document.documentElement.classList.toggle("dark");
    }

    function loadMessages() {
      const messages = JSON.parse(localStorage.getItem("contactMessages") || "[]");
      const tbody = document.getElementById("messageBody");
      const noMessages = document.getElementById("noMessages");
      const searchTerm = document.getElementById("searchInput").value.toLowerCase();

      tbody.innerHTML = "";

      // Filter messages by search term in name, email, or message
      const filtered = messages.filter(msg =>
        (msg.name && msg.name.toLowerCase().includes(searchTerm)) ||
        (msg.email && msg.email.toLowerCase().includes(searchTerm)) ||
        (msg.message && msg.message.toLowerCase().includes(searchTerm))
      );

      if (filtered.length === 0) {
        noMessages.classList.remove("hidden");
        return;
      }
      noMessages.classList.add("hidden");

      filtered.forEach((msg, index) => {
        const tr = document.createElement("tr");
        tr.className = "align-top";
        tr.innerHTML = `
          <td class="p-3 border-b">${index + 1}</td>
          <td class="p-3 border-b font-semibold">${msg.name}</td>
          <td class="p-3 border-b underline text-blue-600">${msg.email}</td>
          <td class="p-3 border-b max-w-xs break-words">${msg.message}</td>
          <td class="p-3 border-b">${new Date(msg.time).toLocaleString()}</td>
          <td class="p-3 border-b">
            <button onclick="deleteMessage(${messages.indexOf(msg)})" 
                    class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition duration-200">
              Delete
            </button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }

    function deleteMessage(index) {
      const messages = JSON.parse(localStorage.getItem("contactMessages") || "[]");
      if (index >= 0 && confirm("Are you sure you want to delete this message?")) {
        messages.splice(index, 1);
        localStorage.setItem("contactMessages", JSON.stringify(messages));
        loadMessages();
      }
    }

    function clearAllMessages() {
      if (confirm("Are you sure you want to delete ALL messages? This action cannot be undone.")) {
        localStorage.removeItem("contactMessages");
        loadMessages();
        alert("All messages have been cleared.");
      }
    }

    window.addEventListener("DOMContentLoaded", loadMessages);
  </script>
</body>
</html>
