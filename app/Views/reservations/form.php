<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de réservation - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Réserver la chambre: <?= htmlspecialchars($chambre['nom']) ?></h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Détails de la chambre</h5>
                        <p><strong>Capacité:</strong> <?= htmlspecialchars($chambre['capacite']) ?> personne(s)</p>
                        <p><strong>Prix par nuit:</strong> €<?= number_format($chambre['prix_par_nuit'], 2, ',', ' ') ?></p>
                        <p><strong>Description:</strong> <?= htmlspecialchars($chambre['description']) ?></p>
                    </div>
                </div>

                <form method="POST" action="<?= base_url('reservation/create') ?>">
                    <?= csrf_field() ?>

                    <input type="hidden" name="id_chambre" value="<?= htmlspecialchars($chambre['id_chambre']) ?>">

                    <div class="form-group mb-3">
                        <label for="date_debut" class="form-label">Date d'arrivée</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" required value="<?= htmlspecialchars($date_debut ?? '') ?>">
                        <?php if (isset($errors['date_debut'])): ?>
                            <small class="text-danger"><?= $errors['date_debut'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date_fin" class="form-label">Date de départ</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required value="<?= htmlspecialchars($date_fin ?? '') ?>">
                        <?php if (isset($errors['date_fin'])): ?>
                            <small class="text-danger"><?= $errors['date_fin'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nb_personnes" class="form-label">Nombre de personnes</label>
                        <input type="number" class="form-control" id="nb_personnes" name="nb_personnes" min="1" max="<?= htmlspecialchars($chambre['capacite']) ?>" required value="<?= old('nb_personnes', 1) ?>">
                        <?php if (isset($errors['nb_personnes'])): ?>
                            <small class="text-danger"><?= $errors['nb_personnes'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Confirmer la réservation</button>
                </form>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
