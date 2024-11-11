<?php
session_start();
include('backend/database.php');
include('functions.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search = ''; // Standardwert für Sucheingabe
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$contacts = fetchContacts($conn); // Kontakte laden

// Kontakte nach Suchanfrage filtern
if (!empty($search)) {
    $contacts = array_filter($contacts, function ($contact) use ($search) {
        return stripos($contact['contact_name'], $search) !== false || 
               stripos($contact['contact_phone'], $search) !== false || 
               stripos($contact['contact_email'], $search) !== false || 
               stripos($contact['contact_address'], $search) !== false;
    });
}

// Kontakte alphabetisch sortieren
usort($contacts, function ($a, $b) {
    return strcmp($a['contact_name'], $b['contact_name']);
});

$error = '';

?>

<!-- Darstellung -->
<div class="main mt-3">
    <?php include 'frontend/html.php'; ?>
</div>

<!-- Logout-Button -->
<div class="position-fixed top-0 end-0 p-3">
    <a href="logout.php" class="btn btn-outline-dark">Ausloggen</a>
</div>

<script>
    function update_contact(id) {
        $("#updateContactModal").modal("show");
        const fields = ['Name', 'Phone', 'Email', 'Address'];
        fields.forEach(field => {
            $("#updateContact" + field).val($("#contact" + field + "-" + id).text());
        });
        $("#updateContactId").val(id);
    }

    function delete_contact(id) {
        if (confirm("Willst du diesen Kontakt wirklich löschen?")) {
            window.location = "frontend/crud/delete.php?contact=" + id;
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>