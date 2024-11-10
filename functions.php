<?php
function fetchContacts($conn) {
    $stmt = $conn->prepare("SELECT contact_id, contact_name, contact_phone, contact_email, contact_address FROM contacts");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 
?>