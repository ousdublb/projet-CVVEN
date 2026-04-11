# 🏨 SYSTÈME DE RÉSERVATION D'HÔTEL - CodeIgniter 4

## 📌 Vue d'ensemble

Ceci est un **système complet et fonctionnel** de gestion de réservations d'hôtel construit avec **CodeIgniter 4**.

Le projet est **prêt à l'emploi** et peut être copié directement dans un projet réel.

---

## 🚀 Démarrage rapide (5 minutes)

```bash
# 1. Créer la base de données
mysql -u root -e "CREATE DATABASE hotel_reservation;"

# 2. Configurer .env
nano .env
# Remplir: database.default.database, username, password

# 3. Exécuter les migrations
php spark migrate

# 4. Charger les données
php spark db:seed InitialDataSeeder

# 5. Accéder à l'application
# Page d'accueil: http://localhost/projet-CVVEN/
# Connexion: http://localhost/projet-CVVEN/login
# Admin: admin@hotel.com / admin123
```

---

## 📂 Fichiers créés (33 fichiers)

### **MODÈLES (4)**
- ✅ `app/Models/UserModel.php` - Gestion utilisateurs
- ✅ `app/Models/ClientModel.php` - Profils clients
- ✅ `app/Models/ChambreModel.php` - Gestion chambres
- ✅ `app/Models/ReservationModel.php` - Gestion réservations

### **CONTRÔLEURS (6)**
- ✅ `app/Controllers/AuthController.php` - Auth (login, register, logout)
- ✅ `app/Controllers/ClientController.php` - Dashboard client
- ✅ `app/Controllers/ChambreController.php` - CRUD chambres
- ✅ `app/Controllers/ReservationController.php` - Gestion réservations
- ✅ `app/Controllers/AdminController.php` - Admin dashboard
- ✅ `app/Controllers/TestController.php` - Tests BD
5)**
- ✅ `app/Views/home.php` - Page d'accueil moderne et responsive
### **VUES (14)**
- ✅ `app/Views/auth/login.php` - Formulaire connexion
- ✅ `app/Views/auth/register.php` - Formulaire inscription
- ✅ `app/Views/clients/dashboard.php` - Tableau de bord client
- ✅ `app/Views/clients/edit_profile.php` - Modification profil
- ✅ `app/Views/clients/reservations.php` - Mes réservations
- ✅ `app/Views/chambres/list.php` - Liste chambres
- ✅ `app/Views/chambres/detail.php` - Détails chambre
- ✅ `app/Views/chambres/create.php` - Créer chambre
- ✅ `app/Views/chambres/edit.php` - Modifier chambre
- ✅ `app/Views/chambres/search_results.php` - Résultats recherche
- ✅ `app/Views/reservations/form.php` - Formulaire réservation
- ✅ `app/Views/reservations/detail.php` - Détails réservation
- ✅ `app/Views/admin/dashboard.php` - Tableau de bord admin
- ✅ `app/Views/admin/users.php` - Gestion utilisateurs
- ✅ `app/Views/admin/clients.php` - Gestion clients
- ✅ `app/Views/admin/reservations.php` - Gestion réservations

### **FILTRES (2)**
- ✅ `app/Filters/AuthFilter.php` - Vérifier connexion
- ✅ `app/Filters/AdminFilter.php` - Vérifier rôle admin

### **MIGRATIONS (4)**
- ✅ `app/Database/Migrations/2024120501_CreateUsersTable.php`
- ✅ `app/Database/Migrations/2024120502_CreateClientsTable.php`
- ✅ `app/Database/Migrations/2024120503_CreateChambresTable.php`
- ✅ `app/Database/Migrations/2024120504_CreateReservationsTable.php`

### **SEEDER (1)**
- ✅ `app/Database/Seeds/InitialDataSeeder.php`

### **CONFIGURATION (1 modifié)**
- ✅ `app/Config/Routes.php` - Toutes les routes de l'app

### **DOCUMENTATION (4)**
- ✅ `INSTALLATION_GUIDE.md` - Guide d'installation complet
- ✅ `PROJECT_SUMMARY.md` - Résumé du projet
- ✅ `QUICKSTART.md` - Démarrage rapide
- ✅ `EXAMPLES.md` - Exemples d'utilisation
- ✅ `FILES_CREATED.txt` - Liste des fichiers
- ✅ `README_COMPLET.md` - Ce fichier

---

## 🎯 Fonctionnalités

| Fonction | Client | Admin |
|----------|--------|-------|
| S'inscrire | ✅ | ❌ |
| Se connecter | ✅ | ✅ |
| Voir chambres | ✅ | ✅ |
| Rechercher chambres | ✅ | ✅ |
| Réserver chambre | ✅ | ❌ |
| Voir ses réservations | ✅ | ❌ |
| Modifier profil | ✅ | ❌ |
| Créer chambre | ❌ | ✅ |
| Modifier chambre | ❌ | ✅ |
| Supprimer chambre | ❌ | ✅ |
| Approuver réservations | ❌ | ✅ |
| Voir tous les clients | ❌ | ✅ |
| Voir statistiques | ❌ | ✅ |

---

## 🔐 Sécurité

- ✅ **Hash des mots de passe** avec `password_hash()`
- ✅ **Sessions sécurisées** avec CodeIgniter
- ✅ **Protection CSRF** activée par défaut
- ✅ **Validation des données** server-side
- ✅ **Requêtes paramétrées** (protection SQL injection)
- ✅ **Filtres d'authentification** pour les routes protégées
- ✅ **Vérification des rôles** (admin/client)

---

## 📊 Structure de la base de données

```
USERS
├── id_user (PK)
├── email (UNIQUE)
├── mot_de_passe (HASH)
├── role (admin/client)
└── timestamps

CLIENTS
├── id_client (PK)
├── id_user (FK → users)
├── nom
├── prenom
├── telephone
└── timestamps

CHAMBRES
├── id_chambre (PK)
├── nom
├── capacite
├── description
├── prix_par_nuit
└── timestamps

RESERVATIONS
├── id_reservation (PK)
├── id_client (FK → clients)
├── id_chambre (FK → chambres)
├── date_debut
├── date_fin
├── statut (en_attente/confirmee/annulee)
├── nb_personnes
└── timestamps
```

---

## 🛣️ Routes disponibles
ccueil**
```
GET  /                         → Page d'accueil moderne
```

### **A
### **Authentification**
```
GET  /login                    → Formulaire connexion
POST /auth/login               → Traiter connexion
GET  /register                 → Formulaire inscription
POST /auth/register            → Traiter inscription
GET  /auth/logout              → Déconnexion
```

### **Chambres**
```
GET  /chambres                 → Liste des chambres
GET  /chambres/search          → Recherche par dates
GET  /chambre/detail/:id       → Détails d'une chambre
GET  /chambre/create           → Formulaire création (admin)
POST /chambre/create           → Créer chambre (admin)
GET  /chambre/edit/:id         → Formulaire modification (admin)
POST /chambre/update/:id       → Modifier chambre (admin)
GET  /chambre/delete/:id       → Supprimer chambre (admin)
```

### **Client**
```
GET  /client/dashboard         → Tableau de bord (auth)
GET  /client/edit-profile      → Modifier profil (auth)
POST /client/update-profile    → Sauvegarder profil (auth)
GET  /client/reservations      → Mes réservations (auth)
```

### **Réservations**
```
GET  /reservation/booking/:id  → Formulaire réservation (auth)
POST /reservation/create       → Créer réservation (auth)
GET  /reservation/detail/:id   → Détails réservation (auth)
GET  /reservation/cancel/:id   → Annuler réservation (auth)
GET  /reservation/confirm/:id  → Confirmer réservation (admin)
```

### **Admin**
```
GET  /admin/dashboard          → Tableau de bord (admin)
GET  /admin/users              → Gestion utilisateurs (admin)
GET  /admin/clients            → Gestion clients (admin)
GET  /admin/reservations       → Gestion réservations (admin)
POST /admin/update-reservation-status/:id → Changer statut (admin)
GET  /admin/delete-user/:id    → Supprimer utilisateur (admin)
```

### **Test**
```
GET  /test/database            → Teste connexion MySQL
GET  /test/tables              → Vérifie les tables
```

---

## 💻 Installation détaillée

### Prérequis
- PHP 8.1+
- MySQL/MariaDB
- Composer
- XAMPP (ou similaire)

### Étapes

1. **Créer la base de données**
   ```bash
   mysql -u root -p
   CREATE DATABASE hotel_reservation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

2. **Configurer `.env`**
   ```bash
   cd /opt/lampp/htdocs/projet-CVVEN
   cp env .env
   nano .env
   ```
   
   Remplir:
   ```env
   database.default.hostname = localhost
   database.default.database = hotel_reservation
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   ```

3. **Installer les dépendances** (si nécessaire)
   ```bash
   composer install
   ```

4. **Exécuter les migrations**
   ```bash
   php spark migrate
   ```

5. **Charger les données initiales**
   ```bash
   php spark db:seed InitialDataSeeder
   ```

6. **Vérifier l'installation**
   ```
   http://localhost/projet-CVVEN/test/database
   http://localhost/projet-CVVEN/test/tables
   ```

7. **Accéder à l'application**
   ```
   http://localhost/projet-CVVEN/login
   Email: admin@hotel.com
   Mot de passe: admin123
   ```

---

## 📖 Documentation

Consultez les fichiers suivants pour plus de détails:

| Fichier | Contenu |
|---------|---------|
| `QUICKSTART.md` | Démarrage rapide en 5 minutes |
| `INSTALLATION_GUIDE.md` | Guide d'installation complet |
| `PROJECT_SUMMARY.md` | Résumé technique du projet |
| `EXAMPLES.md` | Exemples d'utilisation et de code |
| `FILES_CREATED.txt` | Liste complète des fichiers |

---

## 🧪 Tests

### Test de connexion à la BD

**URL**: `http://localhost/projet-CVVEN/test/database`

**Réponse attendue**:
```json
{
    "status": "success",
    "message": "Connexion à la base de données réussie!",
    "database": "hotel_reservation",
    "driver": "MySQLi"
}
```

### Test des tables

**URL**: `http://localhost/projet-CVVEN/test/tables`

**Réponse attendue**:
```json
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

## 🐛 Troubleshooting

### **Erreur: "SQLSTATE[HY000]: General error: 1030"**
**Solution**: La base de données n'existe pas. Créez-la:
```bash
mysql -u root -e "CREATE DATABASE hotel_reservation;"
```

### **Erreur: "Unknown column 'email' in users table"**
**Solution**: Les migrations n'ont pas été exécutées:
```bash
php spark migrate
```

### **Erreur: "Access denied for user 'root'@'localhost'"**
**Solution**: Vérifiez `database.default.password` dans `.env`

### **Les routes retournent 404**
**Solution**: Vérifiez que `Routes.php` est correctement configuré:
```bash
cat app/Config/Routes.php | head -20
```

### **Les vues ne s'affichent pas**
**Solution**: Vérifiez l'existence des fichiers:
```bash
ls -la app/Views/auth/
ls -la app/Views/clients/
```

---

## 🔄 Workflow utilisateur

### **Pour un nouveau client**

```
1. Accéder à /register
   ↓ Remplir formulaire d'inscription
   ↓
2. Créé dans la BD: users + clients
   ↓ Redirection vers /login
   ↓
3. Se connecter avec email/mot de passe
   ↓ Session créée
   ↓
4. Accéder à /chambres
   ↓ Voir toutes les chambres
   ↓
5. Utiliser /chambres/search (dates)
   ↓ Voir les chambres disponibles
   ↓
6. Cliquer sur "Réserver"
   ↓ Formulaire de réservation
   ↓
7. Confirmer la réservation
   ↓ Réservation créée (statut: en_attente)
   ↓
8. Voir dans /client/reservations
   ↓ En attente d'approbation admin
   ↓
9. Admin confirme la réservation
   ↓ Statut change à "confirmee"
```

### **Pour l'admin**

```
1. Se connecter: admin@hotel.com / admin123
   ↓
2. Accéder à /admin/dashboard
   ↓ Voir statistiques
   ↓
3. Aller à /chambres
   ↓ CRUD des chambres
   ↓
4. Aller à /admin/reservations
   ↓ Voir et approuver les réservations
   ↓
5. Aller à /admin/clients
   ↓ Voir la liste des clients
```

---

## 📊 Données de test incluses

### Admin inclus
```
Email: admin@hotel.com
Mot de passe: admin123
Rôle: admin
```

### 4 chambres de démonstration

| Nom | Capacité | Prix/nuit |
|-----|----------|-----------|
| Chambre Standard | 2 | 79.99€ |
| Chambre Deluxe | 3 | 129.99€ |
| Suite | 4 | 199.99€ |
| Chambre Économique | 1 | 49.99€ |

---

## 🛠️ Commandes CodeIgniter

```bash
# Afficher les routes
php spark routes

# Voir les logs
tail -f writable/logs/log-*.log

# Exécuter les migrations
php spark migrate

# Rollback des migrations
php spark migrate:rollback --all

# Charger un seeder
php spark db:seed SeederName

# Créer un contrôleur
php spark make:controller ControllerName

# Créer un modèle
php spark make:model ModelName

# Créer une migration
php spark make:migration MigrationName
```

---

## 🎓 Apprentissage CodeIgniter 4

Ce projet couvre:
- ✅ **Modèles** avec validation et relations
- ✅ **Contrôleurs** avec logique métier
- ✅ **Vues** avec templating PHP
- ✅ **Routes** avec groupes et filtres
- ✅ **Filtres** (middleware) pour sécurité
- ✅ **Migrations** pour schéma BD
- ✅ **Seeders** pour données initiales
- ✅ **Sessions** pour gestion utilisateur
- ✅ **Validation** côté serveur
- ✅ **Requêtes** à la base de données

---

## �� Design & UX

- ✅ **Bootstrap 5** pour le responsive design
- ✅ **Gradients modernes** pour l'authentification
- ✅ **Barres de navigation** sur chaque page
- ✅ **Alertes** pour les messages de succès/erreur
- ✅ **Formulaires** avec validation côté client
- ✅ **Tableaux** pour afficher les listes
- ✅ **Cartes** pour afficher les chambres

---

## �� Déploiement

Pour déployer en production:

1. **Configurer `.env` pour production**
   ```env
   CI_ENVIRONMENT = production
   app.baseURL = https://votre-domaine.com
   ```

2. **Activer les logs**
   ```bash
   chmod 777 writable/logs
   ```

3. **Copier tous les fichiers** sur le serveur

4. **Installer les dépendances**
   ```bash
   composer install --no-dev
   ```

5. **Configurer la base de données** sur le serveur

6. **Exécuter les migrations**
   ```bash
   php spark migrate --env production
   ```

---

## 📝 Licence
👨‍💼 Créateurs du Projet

Ce système de réservation d'hôtel a été conçu et développé par :

- **Ousmane DIAKHO**
- **Zinedine AMOR**
- **Sofiane ATTAL**
- **Asaad AID**

**Étudiants BTS SIO | Lycée René Descartes | 2025/2026**

---

## 🎉 Conclusion

Vous avez maintenant un **système de réservation d'hôtel complet et fonctionnel** avec une **page d'accueil moderne et professionnelle** construit avec CodeIgniter 4.

Le projet inclut:
- ✅ **Page d'accueil élégante** avec design responsive et animations fluides
- ✅ **Système de réservation complet** avec gestion des chambres et des clients
- ✅ **Panneau d'administration** pour la gestion des réservations et utilisateurs
- ✅ **Authentification sécurisée** avec sessions et validation des données
- ✅ **Design moderne** utilisant Bootstrap 5 et CSS personnalisé

Le projet est prêt à:
- ✅ Être utilisé comme base pour un vrai projet hôtelier

Vous avez maintenant un **système de réservation d'hôtel complet et fonctionnel** construit avec CodeIgniter 4.

Le projet est prêt à:
- ✅ Être utilisé comme base pour un vrai projet
- ✅ Être étendu avec de nouvelles fonctionnalités
- ✅ Être déployé en production
- ✅ Servir d'exemple pour apprendre CodeIgniter 4

**Happy coding! 🚀**
