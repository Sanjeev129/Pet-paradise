<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: alogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - Pet Paradise</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white p-6 shadow-md flex flex-col">
    <h2 class="text-2xl font-bold text-blue-600 mb-8">🐾 Pet Paradise Admin</h2>
    <nav class="flex-grow space-y-4">
      <a href="Adoptions.php" class="block text-gray-700 hover:text-blue-600 text-lg">📋 Adoption Requests</a>
      <a href="Contacts.php" class="block text-gray-700 hover:text-blue-600 text-lg">✉️ Messages</a>
    </nav>
    <form method="POST" action="logout.php" class="mt-10">
      <button type="submit"
              class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 text-lg transition">
        🚪 Logout
      </button>
    </form>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
      <span class="text-gray-600">Welcome, Admin</span>
    </header>

    <!-- Content -->
    <main class="p-8 bg-gray-50 flex-grow">
      <h2 class="text-3xl font-bold mb-8 text-center text-gray-700">Admin Overview</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <!-- Adoption Requests Card -->
        <div id="adoptionCard" class="bg-blue-100 rounded-lg p-6 shadow-md hover:shadow-lg transition cursor-pointer">
          <h3 class="text-xl font-semibold text-blue-700 mb-3">📋 Adoption Requests</h3>
          <p id="adoptionCount" class="text-blue-800 font-bold text-3xl">0</p>
          <a href="Adoptions.php" class="text-blue-600 hover:underline mt-2 inline-block">View details &rarr;</a>
        </div>

        <!-- Contact Messages Card -->
        <div id="messagesCard" class="bg-green-100 rounded-lg p-6 shadow-md hover:shadow-lg transition cursor-pointer">
          <h3 class="text-xl font-semibold text-green-700 mb-3">✉️ Contact Messages</h3>
          <p id="messageCount" class="text-green-800 font-bold text-3xl">0</p>
          <a href="Contacts.php" class="text-green-600 hover:underline mt-2 inline-block">View details &rarr;</a>
        </div>


      </div>
    </main>

  </div>

  <script>
    // Update counts dynamically from localStorage
    function updateDashboardCounts() {
      const adoptionRequests = JSON.parse(localStorage.getItem('adoptionRequests') || '[]');
      const contactMessages = JSON.parse(localStorage.getItem('contactMessages') || '[]');

      document.getElementById('adoptionCount').textContent = adoptionRequests.length;
      document.getElementById('messageCount').textContent = contactMessages.length;
    }

    window.addEventListener('DOMContentLoaded', updateDashboardCounts);
  </script>

</body>
</html>
