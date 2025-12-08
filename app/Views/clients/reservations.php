<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations - Hotel Reservation</title>
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
                        <a class="nav-link" href="<?= base_url('chambres') ?>">Chambres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Mes réservations</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (empty($reservations)): ?>
            <div class="alert alert-info">
                Vous n'avez pas encore de réservations.
                <a href="<?= base_url('chambres') ?>" class="btn btn-sm btn-primary">Réserver une chambre</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($reservations as $res): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($res['chambre_nom']) ?></h5>
                                <p class="card-text">
                                    <strong>Dates:</strong> <?= date('d/m/Y', strtotime($res['date_debut'])) ?> - <?= date('d/m/Y', strtotime($res['date_fin'])) ?><br>
                                    <strong>Nombre de personnes:</strong> <?= htmlspecialchars($res['nb_personnes']) ?><br>
                                    <strong>Prix par nuit:</strong> €<?= number_format($res['prix_par_nuit'], 2, ',', ' ') ?><br>
                                    <strong>Statut:</strong> 
                                    <span class="badge bg-<?= $res['statut'] === 'confirmee' ? 'success' : ($res['statut'] === 'en_attente' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($res['statut']) ?>
                                    </span>
                                </p>
                                <div>
                                    <a href="<?= base_url('reservation/detail/' . $res['id_reservation']) ?>" class="btn btn-sm btn-info">Détails</a>
                                    <?php if ($res['statut'] !== 'annulee'): ?>
                                        <a href="<?= base_url('reservation/cancel/' . $res['id_reservation']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Annuler</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
