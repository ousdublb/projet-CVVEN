<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une chambre - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Modifier la chambre</h2>

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="<?= base_url('chambre/update/' . $chambre['id_chambre']) ?>">
                    <?= csrf_field() ?>

                    <div class="form-group mb-3">
                        <label for="nom" class="form-label">Nom de la chambre</label>
                        <input type="text" class="form-control" id="nom" name="nom" required value="<?= htmlspecialchars($chambre['nom']) ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <small class="text-danger"><?= $errors['nom'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="capacite" class="form-label">Capacité (nombre de personnes)</label>
                        <input type="number" class="form-control" id="capacite" name="capacite" min="1" max="10" required value="<?= htmlspecialchars($chambre['capacite']) ?>">
                        <?php if (isset($errors['capacite'])): ?>
                            <small class="text-danger"><?= $errors['capacite'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($chambre['description']) ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <small class="text-danger"><?= $errors['description'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="prix_par_nuit" class="form-label">Prix par nuit (€)</label>
                        <input type="number" class="form-control" id="prix_par_nuit" name="prix_par_nuit" step="0.01" min="0" required value="<?= htmlspecialchars($chambre['prix_par_nuit']) ?>">
                        <?php if (isset($errors['prix_par_nuit'])): ?>
                            <small class="text-danger"><?= $errors['prix_par_nuit'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="<?= base_url('chambres') ?>" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
