<?php
session_start();
include('backend/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Benutzer anhand des Benutzernamens finden
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    // Passwort überprüfen
    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Weiterleitung zur Startseite
        exit();
    } else {
        echo "Ungültiger Benutzername oder Passwort.";
    }
}
?>

<!-- Login-Formular -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-dark text-center" role="alert">
            <h3>Login</h3>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <div class="form-group mb-3">
                                <label for="username">Benutzername</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Gib Deinen Benutzernamen ein" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Passwort</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Gib Dein Passwort ein" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Einloggen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>