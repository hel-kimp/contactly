<?php
session_start();
include('backend/database.php');
include('functions.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$contacts = fetchContacts($conn); // Kontakte laden

?>

<!-- Darstellung -->
<div class="main mt-3">
    <?php include 'frontend/html.php'; ?>
</div>

<!-- Logout-Button -->
<div class="position-fixed top-0 end-0 p-3">
    <a href="logout.php" class="btn btn-outline-dark">Ausloggen</a>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>