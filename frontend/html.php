<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactly</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="alert alert-dark text-center" role="alert">
    <h3>Contactly</h3>
</div> 

<!-- Hinzufügen Button -->
<div class="col-md-4 text-end">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addContactModal">
    <i class="fa-regular fa-user"></i>&nbsp;Kontakt hinzufügen
    </button>
 </div>

<!-- Kontakte Tabelle -->
     <div class="main mt-3">
            <div class="card" style="padding: 20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Telefonnummer</th>
                            <th>E-mail</th>
                            <th>Adresse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $row): ?>
                            <tr>
                                <td id="contactName-<?= $row['contact_id'] ?>"><?= htmlspecialchars($row['contact_name']) ?></td>
                                <td id="contactPhone-<?= $row['contact_id'] ?>"><?= htmlspecialchars($row['contact_phone']) ?></td>
                                <td id="contactEmail-<?= $row['contact_id'] ?>"><?= htmlspecialchars($row['contact_email']) ?></td>
                                <td id="contactAddress-<?= $row['contact_id'] ?>"><?= htmlspecialchars($row['contact_address']) ?></td>
                                <td>
                                    <div>
                                        <button type="button" class="btn btn-secondary" onclick="update_contact('<?= $row['contact_id'] ?>')">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="delete_contact('<?= $row['contact_id'] ?>')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <a href="backend/vcard.php?contact_id=<?= $row['contact_id'] ?>" class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-address-card"></i> vCard
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Fenster für Kontakt hinzufügen -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hinzufügen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="frontend/crud/add.php" method="POST" class="add-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="contactName">Name</label>
                        <input type="text" class="form-control" id="contactName" name="contact_name" placeholder="Vor- und Nachname" required>
                    </div>
                    <div class="form-group">
                        <label for="contactPhone">Telefonnummer</label>
                        <input type="text" class="form-control" id="contactPhone" name="contact_phone" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">E-mail</label>
                        <input type="email" class="form-control" id="contactEmail" name="contact_email" required>
                    </div>
                    <div class="form-group">
                        <label for="contactAddress">Adresse</label>
                        <input type="text" class="form-control" id="contactAddress" name="contact_address" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-dark">Speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fenster für Kontakt aktualisieren -->
<div class="modal fade" id="updateContactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Aktualisieren</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="frontend/crud/update.php" method="POST" class="add-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="updateContactName">Name</label>
                        <input type="text" class="form-control" id="updateContactName" name="contact_name" required>
                    </div>
                    <div class="form-group">
                        <label for="updateContactPhone">Telefonnummer</label>
                        <input type="text" class="form-control" id="updateContactPhone" name="contact_phone" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label for="updateContactEmail">E-mail</label>
                        <input type="email" class="form-control" id="updateContactEmail" name="contact_email" required>
                    </div>
                    <div class="form-group">
                        <label for="updateContactAddress">Adresse</label>
                        <input type="text" class="form-control" id="updateContactAddress" name="contact_address" required>
                    </div>
                    <input type="hidden" name="contact_id" id="updateContactId"> <!-- Verstecktes Feld für die Kontakt-ID -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-dark">Aktualisieren</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>