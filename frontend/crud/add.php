<?php
include('../../backend/database.php');

// Überprüfen, ob das Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Eingabewerte aus dem POST-Request holen
    $contactName = $_POST['contact_name'];
    $contactPhone = $_POST['contact_phone'];
    $contactEmail = $_POST['contact_email'];
    $contactAddress = $_POST['contact_address'];

    // SQL-Abfrage, um die Daten in die Datenbank einzufügen
    $stmt = $conn->prepare("INSERT INTO contacts (contact_name, contact_phone, contact_email, contact_address) 
                            VALUES (:contact_name, :contact_phone, :contact_email, :contact_address)");

    // Parameter an die SQL-Abfrage binden
    $stmt->bindParam(':contact_name', $contactName);
    $stmt->bindParam(':contact_phone', $contactPhone);
    $stmt->bindParam(':contact_email', $contactEmail);
    $stmt->bindParam(':contact_address', $contactAddress);

    // Abfrage ausführen
    if($stmt->execute()) {
        // Erfolgreich eingefügt, Weiterleitung zur Startseite
        header("Location: ../../index.php");
        exit(); // exit() ist wichtig, um sicherzustellen, dass der Rest des Skripts nicht mehr ausgeführt wird
    } else {
        // Fehlermeldung, falls das Einfügen fehlschlägt
        echo "Fehler beim Hinzufügen des Kontakts.";
    }
}
?>

