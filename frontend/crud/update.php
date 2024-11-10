<?php
include('../../backend/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateContactId = $_POST['contact_id']; // Kontakt-ID erhalten
    $updateContactName = $_POST['contact_name'];
    $updateContactPhone = $_POST['contact_phone'];
    $updateContactEmail = $_POST['contact_email'];
    $updateContactAddress = $_POST['contact_address'];

    // UPDATE SQL-Befehl vorbereiten
    $stmt = $conn->prepare("UPDATE contacts SET contact_name = :contact_name, contact_phone = :contact_phone, contact_email = :contact_email, contact_address = :contact_address WHERE contact_id = :contact_id");
    
    // Parameter binden
    $stmt->bindParam(':contact_name', $updateContactName);
    $stmt->bindParam(':contact_phone', $updateContactPhone);
    $stmt->bindParam(':contact_email', $updateContactEmail);
    $stmt->bindParam(':contact_address', $updateContactAddress);
    $stmt->bindParam(':contact_id', $updateContactId);
    
    // Ausführen des Updates
    if ($stmt->execute()) {
        // Erfolgreich aktualisiert, zurück zur Hauptseite umleiten
        header("Location: http://localhost/contactly/");
        exit();
    } else {
        echo "Fehler beim Aktualisieren des Kontakts.";
    }
}
?>

