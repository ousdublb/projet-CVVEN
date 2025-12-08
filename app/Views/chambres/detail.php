<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails chambre - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation</a>
        </div>
    </nav>

    <div class="container mt-4">
        <a href="<?= base_url('chambres') ?>" class="btn btn-secondary mb-3">← Retour</a>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2><?= htmlspecialchars($chambre['nom']) ?></h2>
                        <hr>
                        <p><strong>Capacité:</strong> <?= htmlspecialchars($chambre['capacite']) ?> personne(s)</p>
                        <p><strong>Prix par nuit:</strong> €<?= number_format($chambre['prix_par_nuit'], 2, ',', ' ') ?></p>
                        <p><strong>Description:</strong> <?= htmlspecialchars($chambre['description']) ?></p>

                        <?php if (session()->get('role') === 'client'): ?>
                            <a href="<?= base_url('reservation/booking/' . $chambre['id_chambre']) ?>" class="btn btn-primary btn-lg">Réserver cette chambre</a>
                        <?php endif; ?>

                        <?php if (session()->get('role') === 'admin'): ?>
                            <a href="<?= base_url('chambre/edit/' . $chambre['id_chambre']) ?>" class="btn btn-warning">Modifier</a>
                            <a href="<?= base_url('chambre/delete/' . $chambre['id_chambre']) ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
