<?php
function fetchContacts($conn) {
    $stmt = $conn->prepare("SELECT contact_id, contact_name, contact_phone, contact_email, contact_address FROM contacts");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} 

//Filterung und Sortierung der Kontakte
function filterAndSortContacts($contacts, $search = '') {
    // Filtern, wenn ein Suchbegriff vorhanden ist
    if (!empty($search)) {
        $contacts = array_filter($contacts, function ($contact) use ($search) {
            return stripos($contact['contact_name'], $search) !== false ||
                   stripos($contact['contact_phone'], $search) !== false ||
                   stripos($contact['contact_email'], $search) !== false ||
                   stripos($contact['contact_address'], $search) !== false;
        });
    }
    
    // Alphabetisch sortieren
    usort($contacts, function ($a, $b) {
        return strcmp($a['contact_name'], $b['contact_name']);
    });
    
    return $contacts;
}
?>