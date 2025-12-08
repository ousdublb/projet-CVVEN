<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Résultats de recherche</h2>
        <p>Chambres disponibles du <strong><?= date('d/m/Y', strtotime($date_debut)) ?></strong> au <strong><?= date('d/m/Y', strtotime($date_fin)) ?></strong></p>

        <div class="row">
            <?php if (empty($chambres)): ?>
                <div class="col-12">
                    <p class="alert alert-warning">Aucune chambre disponible pour ces dates.</p>
                </div>
            <?php else: ?>
                <?php foreach ($chambres as $chambre): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($chambre['nom']) ?></h5>
                                <p class="card-text">
                                    <strong>Capacité:</strong> <?= htmlspecialchars($chambre['capacite']) ?> personne(s)<br>
                                    <strong>Prix:</strong> €<?= number_format($chambre['prix_par_nuit'], 2, ',', ' ') ?>/nuit
                                </p>
                                <?php if (session()->get('isLoggedIn') && session()->get('role') === 'client'): ?>
                                    <a href="<?= base_url('reservation/booking/' . $chambre['id_chambre'] . '?date_debut=' . $date_debut . '&date_fin=' . $date_fin) ?>" class="btn btn-primary btn-sm">Réserver</a>
                                <?php else: ?>
                                    <a href="<?= base_url('login') ?>" class="btn btn-primary btn-sm">Se connecter pour réserver</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <a href="<?= base_url('chambres') ?>" class="btn btn-secondary mt-3">← Retour</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
