<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Hotel Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #667eea;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-register {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }
        .btn-register:hover {
            opacity: 0.9;
            color: white;
            text-decoration: none;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>📝 Inscription</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('auth/register') ?>">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= old('email') ?>">
                <?php if (isset($errors['email'])): ?>
                    <small class="text-danger"><?= $errors['email'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                <?php if (isset($errors['mot_de_passe'])): ?>
                    <small class="text-danger"><?= $errors['mot_de_passe'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="mot_de_passe_confirm" class="form-label">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="mot_de_passe_confirm" name="mot_de_passe_confirm" required>
                <?php if (isset($errors['mot_de_passe_confirm'])): ?>
                    <small class="text-danger"><?= $errors['mot_de_passe_confirm'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required value="<?= old('nom') ?>">
                <?php if (isset($errors['nom'])): ?>
                    <small class="text-danger"><?= $errors['nom'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required value="<?= old('prenom') ?>">
                <?php if (isset($errors['prenom'])): ?>
                    <small class="text-danger"><?= $errors['prenom'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" required value="<?= old('telephone') ?>">
                <?php if (isset($errors['telephone'])): ?>
                    <small class="text-danger"><?= $errors['telephone'] ?></small>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-register">S'inscrire</button>
        </form>

        <div class="login-link">
            Déjà inscrit? <a href="<?= base_url('login') ?>">Se connecter ici</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
