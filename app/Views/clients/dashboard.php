<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Client - Hotel Reservation</title>
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
                        <a class="nav-link" href="<?= base_url('chambres') ?>">Chambres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('client/reservations') ?>">Mes réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('client/edit-profile') ?>">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-md-6">
                <h1>Bienvenue <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?></h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= base_url('chambres') ?>" class="btn btn-primary">Réserver une chambre</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informations personnelles</h5>
                        <p><strong>Nom:</strong> <?= htmlspecialchars($client['nom']) ?></p>
                        <p><strong>Prénom:</strong> <?= htmlspecialchars($client['prenom']) ?></p>
                        <p><strong>Téléphone:</strong> <?= htmlspecialchars($client['telephone']) ?></p>
                        <a href="<?= base_url('client/edit-profile') ?>" class="btn btn-warning btn-sm">Modifier</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistiques</h5>
                        <p><strong>Total réservations:</strong> <?= count($reservations) ?></p>
                        <p><strong>Réservations confirmées:</strong> 
                            <?= count(array_filter($reservations, fn($r) => $r['statut'] === 'confirmee')) ?>
                        </p>
                        <p><strong>Réservations en attente:</strong> 
                            <?= count(array_filter($reservations, fn($r) => $r['statut'] === 'en_attente')) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Vos réservations récentes</h3>
        <?php if (empty($reservations)): ?>
            <p class="alert alert-info">Vous n'avez pas encore de réservations.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Chambre</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $res): ?>
                            <tr>
                                <td><?= htmlspecialchars($res['chambre_nom']) ?></td>
                                <td><?= date('d/m/Y', strtotime($res['date_debut'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($res['date_fin'])) ?></td>
                                <td>
                                    <span class="badge bg-<?= $res['statut'] === 'confirmee' ? 'success' : ($res['statut'] === 'en_attente' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($res['statut']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('reservation/detail/' . $res['id_reservation']) ?>" class="btn btn-sm btn-info">Voir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
