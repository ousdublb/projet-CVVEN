# 🏨 Système de Réservation d'Hôtel - CodeIgniter 4

Bienvenue dans ce système complet de gestion de réservations d'hôtel construit avec **CodeIgniter 4**.

## 📋 Table des matières

1. [Caractéristiques](#caractéristiques)
2. [Structure du projet](#structure-du-projet)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Routes](#routes)
6. [Utilisation](#utilisation)
7. [Tests](#tests)

---

## ✨ Caractéristiques

- ✅ **Authentification complète** (Login, Register, Logout)
- ✅ **Gestion des rôles** (Admin, Client)
- ✅ **CRUD Chambres** (Admin uniquement)
- ✅ **CRUD Réservations** (Clients)
- ✅ **Recherche de disponibilité** des chambres
- ✅ **Tableau de bord client** avec l'historique des réservations
- ✅ **Tableau de bord admin** avec statistiques
- ✅ **Filtres de sécurité** (AuthFilter, AdminFilter)
- ✅ **Design responsive** avec Bootstrap 5
- ✅ **Validation des données** côté serveur
- ✅ **Migrations de base de données**

---

## 📁 Structure du projet

```
app/
├── Controllers/
│   ├── AuthController.php          # Authentification
│   ├── ClientController.php        # Gestion du profil client
│   ├── ChambreController.php       # Gestion des chambres
│   ├── ReservationController.php   # Gestion des réservations
│   ├── AdminController.php         # Tableau de bord admin
│   └── TestController.php          # Tests de connexion BD
├── Models/
│   ├── UserModel.php               # Modèle utilisateurs
│   ├── ClientModel.php             # Modèle clients
│   ├── ChambreModel.php            # Modèle chambres
│   └── ReservationModel.php        # Modèle réservations
├── Views/
│   ├── auth/
│   │   ├── login.php               # Page de connexion
│   │   └── register.php            # Page d'inscription
│   ├── clients/
│   │   ├── dashboard.php           # Tableau de bord client
│   │   ├── edit_profile.php        # Modification du profil
│   │   └── reservations.php        # Mes réservations
│   ├── chambres/
│   │   ├── list.php                # Liste des chambres
│   │   ├── detail.php              # Détails d'une chambre
│   │   ├── create.php              # Créer une chambre
│   │   ├── edit.php                # Modifier une chambre
│   │   └── search_results.php      # Résultats de recherche
│   ├── reservations/
│   │   ├── form.php                # Formulaire de réservation
│   │   └── detail.php              # Détails d'une réservation
│   └── admin/
│       ├── dashboard.php           # Tableau de bord admin
│       ├── users.php               # Gestion des utilisateurs
│       ├── clients.php             # Gestion des clients
│       └── reservations.php        # Gestion des réservations
├── Filters/
│   ├── AuthFilter.php              # Vérifier la connexion
│   └── AdminFilter.php             # Vérifier le rôle admin
├── Database/
│   ├── Migrations/
│   │   ├── 2024120501_CreateUsersTable.php
│   │   ├── 2024120502_CreateClientsTable.php
│   │   ├── 2024120503_CreateChambresTable.php
│   │   └── 2024120504_CreateReservationsTable.php
│   └── Seeds/
│       └── InitialDataSeeder.php   # Données initiales
└── Config/
    ├── Routes.php                  # Routes de l'application
    └── Filters.php                 # Configuration des filtres
```

---

## 🚀 Installation

### 1. **Prérequis**

- PHP 8.1+
- MySQL/MariaDB
- Composer

### 2. **Installation du projet**

Si vous ne l'avez pas encore fait:

```bash
cd /opt/lampp/htdocs/projet-CVVEN
composer install
```

### 3. **Configuration de la base de données**

Modifiez le fichier `.env`:

```bash
cp env .env
```

Remplissez les paramètres de connexion:

```
database.default.hostname = localhost
database.default.database = hotel_reservation
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 4. **Créer la base de données**

```bash
mysql -u root -e "CREATE DATABASE hotel_reservation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 5. **Exécuter les migrations**

```bash
# IMPORTANT: utilisez le PHP fourni par XAMPP pour éviter les différences d'extensions
# (ex. mysqli) entre le PHP système et celui de XAMPP.
# Option 1 — Exécuter avec le binaire XAMPP (recommandé):
/opt/lampp/bin/php spark migrate

# Option 2 — Si vous préférez utiliser `php` global, assurez-vous que `mysqli` est activé
# pour le CLI système (ou définissez un alias). Exemple d'alias à ajouter dans ~/.bashrc:
# echo "alias php='/opt/lampp/bin/php'" >> ~/.bashrc && source ~/.bashrc
```

### 6. **Charger les données initiales (optionnel)**

```bash
# Utilisez le même binaire PHP que pour les migrations:
/opt/lampp/bin/php spark db:seed InitialDataSeeder
```

---

## ⚙️ Configuration

### Fichier `.env`

```env
# Base de données
database.default.hostname = localhost
database.default.database = hotel_reservation
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi

# Environnement
CI_ENVIRONMENT = development

# Sécurité
app.CSRFProtection = true
app.CSRFTokenRandomize = true
```

### Fichier `app/Config/Filters.php`

Les filtres sont déjà configurés pour les routes appropriées. Les filtres `auth` et `admin` vérifient respectivement l'authentification et le rôle administrateur.

---

## 🛣️ Routes

### **Authentification**

| Méthode | Route | Controller | Description |
|---------|-------|-----------|-------------|
| GET | `/login` | AuthController::loginForm | Formulaire de connexion |
| POST | `/auth/login` | AuthController::login | Traitement de la connexion |
| GET | `/register` | AuthController::registerForm | Formulaire d'inscription |
| POST | `/auth/register` | AuthController::register | Traitement de l'inscription |
| GET | `/auth/logout` | AuthController::logout | Déconnexion |

### **Chambres**

| Méthode | Route | Filtre | Description |
|---------|-------|--------|-------------|
| GET | `/chambres` | - | Liste des chambres |
| GET | `/chambres/search` | - | Rechercher des chambres |
| GET | `/chambre/detail/:id` | - | Détails d'une chambre |
| GET | `/chambre/create` | admin | Formulaire création |
| POST | `/chambre/create` | admin | Créer une chambre |
| GET | `/chambre/edit/:id` | admin | Formulaire modification |
| POST | `/chambre/update/:id` | admin | Modifier une chambre |
| GET | `/chambre/delete/:id` | admin | Supprimer une chambre |

### **Réservations**

| Méthode | Route | Filtre | Description |
|---------|-------|--------|-------------|
| GET | `/reservation/booking/:id` | auth | Formulaire réservation |
| POST | `/reservation/create` | auth | Créer une réservation |
| GET | `/reservation/detail/:id` | auth | Détails réservation |
| GET | `/reservation/cancel/:id` | auth | Annuler réservation |
| GET | `/reservation/confirm/:id` | admin | Confirmer réservation |

### **Client**

| Méthode | Route | Filtre | Description |
|---------|-------|--------|-------------|
| GET | `/client/dashboard` | auth | Tableau de bord client |
| GET | `/client/edit-profile` | auth | Modifier le profil |
| POST | `/client/update-profile` | auth | Enregistrer les modifications |
| GET | `/client/reservations` | auth | Mes réservations |

### **Admin**

| Méthode | Route | Filtre | Description |
|---------|-------|--------|-------------|
| GET | `/admin/dashboard` | admin | Tableau de bord |
| GET | `/admin/users` | admin | Gestion des utilisateurs |
| GET | `/admin/clients` | admin | Gestion des clients |
| GET | `/admin/reservations` | admin | Gestion des réservations |
| POST | `/admin/update-reservation-status/:id` | admin | Changer le statut |
| GET | `/admin/delete-user/:id` | admin | Supprimer un utilisateur |

### **Tests**

| Méthode | Route | Description |
|---------|-------|-------------|
| GET | `/test/database` | Tester la connexion BD |
| GET | `/test/tables` | Vérifier les tables |

---

## 📖 Utilisation

### **1. Première connexion (Admin)**

Après avoir chargé les données initiales:

```
Email: admin@hotel.com
Mot de passe: admin123
```

### **2. Créer un client (S'inscrire)**

1. Aller sur `/register`
2. Remplir le formulaire
3. Cliquer sur "S'inscrire"
4. Se connecter avec les identifiants créés

### **3. Réserver une chambre (Client)**

1. Aller sur `/chambres`
2. Utiliser le formulaire de recherche pour trouver des chambres disponibles
3. Cliquer sur "Réserver cette chambre"
4. Remplir le formulaire de réservation
5. Valider la réservation

### **4. Gérer les chambres (Admin)**

1. Aller sur `/chambres`
2. Cliquer sur "+ Ajouter une chambre"
3. Remplir les informations
4. Valider

### **5. Gérer les réservations (Admin)**

1. Aller sur `/admin/reservations`
2. Voir toutes les réservations
3. Changer le statut (en_attente → confirmee → annulee)

---

## 🧪 Tests

### **Tester la connexion à la base de données**

```bash
# Via le navigateur
http://localhost/projet-CVVEN/test/database

# Réponse attendue
{
    "status": "success",
    "message": "Connexion à la base de données réussie!",
    "database": "hotel_reservation",
    "driver": "MySQLi"
}
```

### **Vérifier les tables**

```bash
http://localhost/projet-CVVEN/test/tables

# Réponse attendue
{
    "status": "success",
    "tables": {
        "users": "OK",
        "clients": "OK",
        "chambres": "OK",
        "reservations": "OK"
    }
}
```

---

## 🔐 Sécurité

- ✅ **Hashage des mots de passe** avec `password_hash()`
- ✅ **Vérification des permissions** avec les filtres
- ✅ **Protection CSRF** activée par défaut
- ✅ **Validation des données** dans tous les formulaires
- ✅ **Requêtes paramétrées** contre les injections SQL

---

## 📝 Notes importantes

1. **Les migrations** créent les 4 tables principales avec les bonnes clés étrangères
2. **Les filtres** sont appliqués automatiquement aux routes appropriées
3. **Les validations** sont définies dans les modèles CodeIgniter
4. **Les vues** utilisent Bootstrap 5 pour le design responsive
5. **Les dates** sont au format Y-m-d pour les comparaisons de disponibilité

---

## 🛠️ Commandes utiles

```bash
# Lancer les migrations
 /opt/lampp/bin/php spark migrate

# Charger les données initiales
 /opt/lampp/bin/php spark db:seed InitialDataSeeder

# Rollback des migrations
 /opt/lampp/bin/php spark migrate:rollback

# Afficher les routes
 /opt/lampp/bin/php spark routes

# Créer un contrôleur
 /opt/lampp/bin/php spark make:controller NomDuControleur

# Créer un modèle
 /opt/lampp/bin/php spark make:model NomDuModele
```

---

## 📞 Support

Pour toute question ou problème, vérifiez:

1. La connexion à la base de données: `/test/database`
2. L'existence des tables: `/test/tables`
3. Les logs dans `writable/logs/`
4. La console du navigateur pour les erreurs JavaScript

---

## 📄 Licence

Ce projet est fourni à titre d'exemple éducatif.

---

**Bon développement! 🚀**
