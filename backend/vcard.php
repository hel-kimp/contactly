<?php
include('../backend/database.php');

function generate_vCard($contact) {
    $vCard = "BEGIN:VCARD\n";
    $vCard .= "VERSION:3.0\n";
    $vCard .= "FN:" . $contact['contact_name'] . "\n";
    $vCard .= "TEL;TYPE=CELL:" . $contact['contact_phone'] . "\n";
    $vCard .= "EMAIL:" . $contact['contact_email'] . "\n";
    $vCard .= "ADR;TYPE=WORK:" . $contact['contact_address'] . "\n";
    $vCard .= "END:VCARD\n";
    return $vCard;
}

if (isset($_GET['contact_id'])) {
    $contactID = $_GET['contact_id'];

    // Kontaktinformationen anhand der ID abrufen
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE contact_id = :contact_id");
    $stmt->bindParam(':contact_id', $contactID);
    $stmt->execute();
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($contact) {
        // vCard generieren und Download auslösen
        header('Content-Type: text/vcard; charset=utf-8');
        header('Content-Disposition: attachment; filename="contact_' . $contactID . '.vcf"');
        echo generate_vCard($contact);
        exit; // Script beenden, damit nur die vCard-Datei gesendet wird
    } else {
        echo "Kontakt nicht gefunden.";
    }
} else {
    echo "Ungültige Anfrage.";
}
?>
