<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVVEN Hôtel - Votre Refuge de Luxe</title>
    <meta name="description" content="Découvrez CVVEN Hôtel, votre destination idéale pour un séjour inoubliable">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #8B5A3C;
            --secondary: #D4A574;
            --accent: #2C3E50;
            --light: #F8F9FA;
            --dark: #1A1A1A;
            --success: #27AE60;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            color: var(--accent) !important;
            font-weight: 500;
            margin-left: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white !important;
            border-radius: 25px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 90, 60, 0.3);
        }

        /* ===== HERO SECTION ===== */
        .hero {
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);
            color: white;
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="1200" height="600" fill="url(%23grid)"/></svg>');
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.8s ease;
        }

        .hero p {
            font-size: 1.4rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            animation: fadeInUp 0.8s ease 0.2s backwards;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--secondary), #E8C4A0);
            border: none;
            color: var(--dark);
            padding: 0.9rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0 0.5rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            color: var(--dark);
        }

        .btn-secondary-custom {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 0.9rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0 0.5rem;
        }

        .btn-secondary-custom:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-3px);
        }

        /* ===== SEARCH SECTION ===== */
        .search-section {
            background: white;
            padding: 3rem 0;
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .search-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }

        .search-card h3 {
            color: var(--primary);
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .form-control, .form-select {
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 90, 60, 0.1);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 0.9rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(139, 90, 60, 0.3);
        }

        /* ===== FEATURES SECTION ===== */
        .features {
            padding: 5rem 0;
            background: var(--light);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(139, 90, 60, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card h4 {
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        /* ===== ROOMS SECTION ===== */
        .rooms-section {
            padding: 5rem 0;
            background: white;
        }

        .room-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            background: white;
        }

        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .room-image {
            width: 100%;
            height: 250px;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary);
            position: relative;
            overflow: hidden;
        }

        .room-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .room-content {
            padding: 1.5rem;
        }

        .room-card h5 {
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .room-price {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
        }

        .room-features {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            font-size: 0.9rem;
            color: #666;
        }

        .room-features span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .room-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .room-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(139, 90, 60, 0.3);
        }

        /* ===== TESTIMONIALS SECTION ===== */
        .testimonials {
            padding: 5rem 0;
            background: linear-gradient(135deg, var(--accent) 0%, var(--primary) 100%);
            color: white;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .stars {
            color: #FFD700;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .testimonial-text {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .testimonial-author {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--accent);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-section h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.8rem;
        }

        .footer-section a {
            color: #BDC3C7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--secondary);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
            color: #BDC3C7;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-links a:hover {
            background: var(--secondary);
            border-color: var(--secondary);
            transform: translateY(-3px);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .search-card {
                padding: 1.5rem;
            }

            .btn-primary-custom,
            .btn-secondary-custom {
                padding: 0.7rem 1.5rem;
                font-size: 0.95rem;
                margin: 0.5rem 0.25rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .navbar-brand {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .search-section {
                margin-top: -40px;
                padding: 2rem 0;
            }

            .search-card {
                padding: 1rem;
            }

            .search-btn {
                margin-top: 1rem;
            }

            .section-title h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-hotel"></i> CVVEN Hôtel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('chambres') ?>">
                            <i class="fas fa-door-open"></i> Chambres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">
                            <i class="fas fa-concierge-bell"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">
                            <i class="fas fa-star"></i> Avis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            <i class="fas fa-envelope"></i> Contact
                        </a>
                    </li>
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> <?= session()->get('email') ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <?php if (session()->get('role') === 'admin') : ?>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">
                                        <i class="fas fa-chart-line"></i> Tableau de bord Admin
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/users') ?>">
                                        <i class="fas fa-users"></i> Utilisateurs
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/clients') ?>">
                                        <i class="fas fa-address-book"></i> Clients
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/reservations') ?>">
                                        <i class="fas fa-calendar-check"></i> Réservations
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php else : ?>
                                    <li><a class="dropdown-item" href="<?= base_url('client/dashboard') ?>">
                                        <i class="fas fa-home"></i> Tableau de bord
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('client/reservations') ?>">
                                        <i class="fas fa-calendar-check"></i> Mes réservations
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-auth ms-2" href="<?= base_url('login') ?>">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container hero-content">
            <h1>Bienvenue à CVVEN Hôtel</h1>
            <p>Explorez un monde de confort, de luxe et d'hospitalité exceptionnelle</p>
            <div>
                <a href="<?= base_url('chambres') ?>" class="btn-primary-custom">
                    <i class="fas fa-search"></i> Rechercher une chambre
                </a>
                <a href="#reservations" class="btn-secondary-custom">
                    <i class="fas fa-calendar-alt"></i> En savoir plus
                </a>
            </div>
        </div>
    </section>

    <!-- SEARCH SECTION -->
    <section class="search-section">
        <div class="container">
            <div class="search-card">
                <h3><i class="fas fa-calendar-check"></i> Réservez votre séjour</h3>
                <form method="GET" action="<?= base_url('chambres/search') ?>">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Date d'arrivée</label>
                            <input type="date" class="form-control" name="date_debut" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date de départ</label>
                            <input type="date" class="form-control" name="date_fin" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nombre de personnes</label>
                            <select class="form-select" name="capacite" required>
                                <option value="">Sélectionner...</option>
                                <option value="1">1 personne</option>
                                <option value="2">2 personnes</option>
                                <option value="3">3 personnes</option>
                                <option value="4">4 personnes</option>
                                <option value="5">5+ personnes</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i> Chercher
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="features" id="services">
        <div class="container">
            <div class="section-title">
                <h2>Nos Services Premium</h2>
                <p>Découvrez tout ce qui rend votre séjour inoubliable</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h4>WiFi Haut Débit</h4>
                        <p>Connexion Internet ultra-rapide dans toutes les chambres et espaces communs</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4>Restaurant & Bar</h4>
                        <p>Savourez notre cuisine gastronomique et nos cocktails signature</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-spa"></i>
                        </div>
                        <h4>Spa & Wellness</h4>
                        <p>Détendez-vous dans notre centre spa avec massages et soins premium</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-swimming-pool"></i>
                        </div>
                        <h4>Piscine Chauffée</h4>
                        <p>Piscine extérieure chauffée avec vue panoramique</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                        <h4>Salle de Fitness</h4>
                        <p>Salle de sport équipée des appareils les plus modernes</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <h4>Concierge 24/7</h4>
                        <p>Notre équipe dévouée à votre service en permanence</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-valet"></i>
                        </div>
                        <h4>Stationnement Gratuit</h4>
                        <p>Parking sécurisé et gratuit pour tous les résidents</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-business-time"></i>
                        </div>
                        <h4>Centre d'Affaires</h4>
                        <p>Salles de réunion et équipements professionnels disponibles</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ROOMS SHOWCASE -->
    <section class="rooms-section" id="reservations">
        <div class="container">
            <div class="section-title">
                <h2>Nos Chambres</h2>
                <p>Sélectionnez parmi notre collection exclusive de suites et chambres</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="room-card">
                        <div class="room-image">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="room-content">
                            <h5>Chambre Standard</h5>
                            <p>Confortable et élégante pour un séjour agréable</p>
                            <div class="room-price">à partir de 80€</div>
                            <div class="room-features">
                                <span><i class="fas fa-ruler"></i> 25m²</span>
                                <span><i class="fas fa-user"></i> 2 pers.</span>
                            </div>
                            <a href="<?= base_url('chambres') ?>" class="room-btn">
                                <i class="fas fa-eye"></i> Voir les disponibilités
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="room-card">
                        <div class="room-image">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="room-content">
                            <h5>Suite Deluxe</h5>
                            <p>Luxe et sophistication pour un confort maximal</p>
                            <div class="room-price">à partir de 150€</div>
                            <div class="room-features">
                                <span><i class="fas fa-ruler"></i> 40m²</span>
                                <span><i class="fas fa-user"></i> 3 pers.</span>
                            </div>
                            <a href="<?= base_url('chambres') ?>" class="room-btn">
                                <i class="fas fa-eye"></i> Voir les disponibilités
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="room-card">
                        <div class="room-image">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div class="room-content">
                            <h5>Suite Présidentielle</h5>
                            <p>L'expérience ultime du luxe et du prestige</p>
                            <div class="room-price">à partir de 300€</div>
                            <div class="room-features">
                                <span><i class="fas fa-ruler"></i> 70m²</span>
                                <span><i class="fas fa-user"></i> 4 pers.</span>
                            </div>
                            <a href="<?= base_url('chambres') ?>" class="room-btn">
                                <i class="fas fa-eye"></i> Voir les disponibilités
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="<?= base_url('chambres') ?>" class="btn-primary-custom" style="font-size: 1.1rem;">
                    <i class="fas fa-th-large"></i> Voir toutes les chambres
                </a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title" style="color: white;">
                <h2 style="color: white;">Avis de nos Clients</h2>
                <p style="color: rgba(255,255,255,0.9);">Découvrez ce que nos hôtes pensent de leur séjour</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            ★★★★★
                        </div>
                        <p class="testimonial-text">"Séjour magnifique! Personnel très accueillant, chambres impeccables et services de qualité. Je recommande vivement!"</p>
                        <div class="testimonial-author">
                            <i class="fas fa-user-circle"></i> Marie Dupont
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            ★★★★★
                        </div>
                        <p class="testimonial-text">"Excellent rapport qualité-prix. La location est parfaite, proche de tout. Nous y reviendrons certainement avec notre famille!"</p>
                        <div class="testimonial-author">
                            <i class="fas fa-user-circle"></i> Jean Michel
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            ★★★★★
                        </div>
                        <p class="testimonial-text">"Une expérience inoubliable! Le spa était fantastique et la gastronomie au restaurant était exquise. Bravo à l'équipe!"</p>
                        <div class="testimonial-author">
                            <i class="fas fa-user-circle"></i> Sophie Bernard
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="footer-section">
                        <h5><i class="fas fa-hotel"></i> CVVEN Hôtel</h5>
                        <p>Votre destination idéale pour un séjour luxueux et mémorable.</p>
                        <div class="social-links">
                            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-section">
                        <h5>Navigation</h5>
                        <ul>
                            <li><a href="<?= base_url('chambres') ?>">Chambres</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#testimonials">Avis</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-section">
                        <h5>Compte</h5>
                        <ul>
                            <li><a href="<?= base_url('login') ?>">Connexion</a></li>
                            <li><a href="<?= base_url('register') ?>">Créer un compte</a></li>
                            <li><a href="<?= base_url('client/reservations') ?>">Mes réservations</a></li>
                            <li><a href="<?= base_url('client/edit-profile') ?>">Mon profil</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-section">
                        <h5 id="contact">Contact</h5>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> 123 Rue de l'Hôtel, 75000 Paris</li>
                            <li><i class="fas fa-phone"></i> <a href="tel:+33123456789">+33 1 23 45 67 89</a></li>
                            <li><i class="fas fa-envelope"></i> <a href="mailto:info@cvvenhotel.com">info@cvvenhotel.com</a></li>
                            <li><i class="fas fa-clock"></i> 24h/24, 7j/7</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 CVVEN Hôtel. Tous droits réservés. | 
                    <a href="#">Politique de confidentialité</a> | 
                    <a href="#">Conditions d'utilisation</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation to cards on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                }
            });
        });

        document.querySelectorAll('.feature-card, .room-card, .testimonial-card').forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });
    </script>
</body>
</html>
