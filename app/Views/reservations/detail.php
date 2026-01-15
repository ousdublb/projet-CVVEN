<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la réservation - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">🏨 Hotel Reservation</a>
        </div>
    </nav>

    <div class="container mt-4">
        <a href="<?= session()->get('role') === 'admin' ? base_url('admin/reservations') : base_url('client/reservations') ?>" class="btn btn-secondary mb-3">← Retour</a>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2>Détails de la réservation #<?= htmlspecialchars($reservation['id_reservation']) ?></h2>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Informations du client</h5>
                                <p>
                                    <strong>Nom:</strong> <?= htmlspecialchars($reservation['nom'] ?? '') ?> <?= htmlspecialchars($reservation['prenom'] ?? '') ?><br>
                                    <strong>Email:</strong> <?= htmlspecialchars($reservation['client_email'] ?? $reservation['email'] ?? '—') ?>
                                </p>

                                <h5>Informations de la chambre</h5>
                                <p>
                                    <strong>Chambre:</strong> <?= htmlspecialchars($reservation['chambre_nom']) ?><br>
                                    <strong>Prix par nuit:</strong> €<?= number_format($reservation['prix_par_nuit'], 2, ',', ' ') ?>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5>Détails de la réservation</h5>
                                <p>
                                    <strong>Date d'arrivée:</strong> <?= date('d/m/Y', strtotime($reservation['date_debut'])) ?><br>
                                    <strong>Date de départ:</strong> <?= date('d/m/Y', strtotime($reservation['date_fin'])) ?><br>
                                    <strong>Nombre de personnes:</strong> <?= htmlspecialchars($reservation['nb_personnes']) ?><br>
                                    <strong>Statut:</strong> <span class="badge bg-<?= $reservation['statut'] === 'confirmee' ? 'success' : ($reservation['statut'] === 'en_attente' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($reservation['statut']) ?>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <?php 
                            $date_debut = new \DateTime($reservation['date_debut']);
                            $date_fin = new \DateTime($reservation['date_fin']);
                            $days = $date_fin->diff($date_debut)->days;
                            $total = $days * $reservation['prix_par_nuit'];
                        ?>

                        <div class="alert alert-info">
                            <strong>Nombre de nuits:</strong> <?= $days ?><br>
                            <strong>Total:</strong> €<?= number_format($total, 2, ',', ' ') ?>
                        </div>

                        <?php if ($reservation['statut'] !== 'annulee' && session()->get('role') === 'client'): ?>
                            <a href="<?= base_url('reservation/cancel/' . $reservation['id_reservation']) ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Annuler cette réservation</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
