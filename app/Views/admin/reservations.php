<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des réservations - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Gestion des réservations</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Chambre</th>
                        <th>Dates</th>
                        <th>Personnes</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td><?= htmlspecialchars($res['id_reservation']) ?></td>
                            <td><?= htmlspecialchars($res['nom'] . ' ' . $res['prenom']) ?></td>
                            <td><?= htmlspecialchars($res['chambre_nom']) ?></td>
                            <td><?= date('d/m/Y', strtotime($res['date_debut'])) ?> - <?= date('d/m/Y', strtotime($res['date_fin'])) ?></td>
                            <td><?= htmlspecialchars($res['nb_personnes']) ?></td>
                            <td>
                                <form method="POST" action="<?= base_url('admin/update-reservation-status/' . $res['id_reservation']) ?>" class="d-inline">
                                    <?= csrf_field() ?>
                                    <select name="statut" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="en_attente" <?= $res['statut'] === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                                        <option value="confirmee" <?= $res['statut'] === 'confirmee' ? 'selected' : '' ?>>Confirmée</option>
                                        <option value="annulee" <?= $res['statut'] === 'annulee' ? 'selected' : '' ?>>Annulée</option>
                                    </select>
                                </form>
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
