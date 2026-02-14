<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } else {
        $conn = new mysqli("localhost", "root", "", "pet_paradise");

        if ($conn->connect_error) {
            $message = "Database connection failed.";
        } else {
            $stmt = $conn->prepare("INSERT IGNORE INTO subscribers (email) VALUES (?)");
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $message = "Thanks for subscribing! 🐾";
            } else {
                $message = "Subscription failed. Try again.";
            }
            $stmt->close();
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Subscribe - Pet Paradise</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #1e1e2f, #2c2c54);
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .subscribe-box {
      background: rgba(255, 255, 255, 0.05);
      padding: 3rem;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.4);
      backdrop-filter: blur(15px);
      max-width: 500px;
      width: 100%;
      text-align: center;
    }

    .subscribe-box h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .subscribe-box p {
      font-size: 1rem;
      margin-bottom: 2rem;
      color: #ccc;
    }

    .subscribe-box input[type="email"] {
      padding: 0.8rem 1rem;
      width: 80%;
      border: none;
      border-radius: 10px;
      margin-bottom: 1rem;
      outline: none;
    }

    .subscribe-box button {
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 10px;
      background-color: #ff6f61;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .subscribe-box button:hover {
      background-color: #e6594a;
    }

    .message {
      margin-top: 1rem;
      color: #7fff7f;
    }
  </style>
</head>
<body>

<div class="subscribe-box">
  <h2>📬 Subscribe to Pet Paradise</h2>
  <p>Get updates on cute pets, adoption news, and exclusive tips!</p>
  <form method="POST" action="">
    <input type="email" name="email" placeholder="Enter your email" required><br>
    <button type="submit">Subscribe</button>
  </form>
  <?php if (!empty($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>
</div>

</body>
</html>
