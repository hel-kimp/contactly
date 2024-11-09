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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>