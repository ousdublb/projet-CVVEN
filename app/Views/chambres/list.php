<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chambres - Hotel Reservation</title>
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
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('client/dashboard') ?>">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/logout') ?>">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Toutes nos chambres</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Rechercher une chambre</h5>
                <form method="GET" action="<?= base_url('chambres/search') ?>" class="row g-3">
                    <div class="col-md-4">
                        <label for="date_debut" class="form-label">Date d'arrivée</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date_fin" class="form-label">Date de départ</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Admin Panel -->
        <?php if (session()->get('role') === 'admin'): ?>
            <div class="mb-3">
                <a href="<?= base_url('chambres/create') ?>" class="btn btn-success">+ Ajouter une chambre</a>
            </div>
        <?php endif; ?>

        <!-- Rooms Grid -->
        <div class="row">
            <?php if (empty($chambres)): ?>
                <div class="col-12">
                    <p class="alert alert-info">Aucune chambre trouvée.</p>
                </div>
            <?php else: ?>
                <?php foreach ($chambres as $chambre): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($chambre['nom']) ?></h5>
                                <p class="card-text">
                                    <strong>Capacité:</strong> <?= htmlspecialchars($chambre['capacite']) ?> personne(s)<br>
                                    <strong>Prix:</strong> €<?= number_format($chambre['prix_par_nuit'], 2, ',', ' ') ?>/nuit<br>
                                    <strong>Description:</strong> <?= htmlspecialchars(substr($chambre['description'], 0, 100)) ?>...
                                </p>
                                <a href="<?= base_url('chambre/detail/' . $chambre['id_chambre']) ?>" class="btn btn-sm btn-info">Voir détails</a>
                                
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <a href="<?= base_url('chambre/edit/' . $chambre['id_chambre']) ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="<?= base_url('chambre/delete/' . $chambre['id_chambre']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
