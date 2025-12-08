<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('client/dashboard') ?>">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Modifier mon profil</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="<?= base_url('client/update-profile') ?>">
                    <?= csrf_field() ?>

                    <div class="form-group mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>
                        <?php if (isset($errors['nom'])): ?>
                            <small class="text-danger"><?= $errors['nom'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>
                        <?php if (isset($errors['prenom'])): ?>
                            <small class="text-danger"><?= $errors['prenom'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>" required>
                        <?php if (isset($errors['telephone'])): ?>
                            <small class="text-danger"><?= $errors['telephone'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="<?= base_url('client/dashboard') ?>" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
