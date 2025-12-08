<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/users') ?>">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/clients') ?>">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('chambres') ?>">Chambres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/reservations') ?>">Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Tableau de bord administrateur</h1>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Utilisateurs</h5>
                        <h2><?= $total_users ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Clients</h5>
                        <h2><?= $total_clients ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Chambres</h5>
                        <h2><?= $total_chambres ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Réservations</h5>
                        <h2><?= $total_reservations ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservation Status -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Réservations en attente</h5>
                        <h3 class="text-warning"><?= $reservations_en_attente ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Réservations confirmées</h5>
                        <h3 class="text-success"><?= $reservations_confirmees ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reservations -->
        <h3>Réservations récentes</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Chambre</th>
                        <th>Dates</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($recent_reservations, 0, 10) as $res): ?>
                        <tr>
                            <td><?= htmlspecialchars($res['id_reservation']) ?></td>
                            <td><?= htmlspecialchars($res['nom'] . ' ' . $res['prenom']) ?></td>
                            <td><?= htmlspecialchars($res['chambre_nom']) ?></td>
                            <td><?= date('d/m/Y', strtotime($res['date_debut'])) ?> - <?= date('d/m/Y', strtotime($res['date_fin'])) ?></td>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
