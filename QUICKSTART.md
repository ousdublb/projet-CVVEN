# 🚀 DÉMARRAGE RAPIDE - Système de Réservation d'Hôtel

## ⚡ 5 minutes pour démarrer

### **Étape 1: Créer la base de données**

```bash
mysql -u root -p << EOF
CREATE DATABASE hotel_reservation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
EOF
```

### **Étape 2: Configurer le fichier `.env`**

```bash
cd /opt/lampp/htdocs/projet-CVVEN
nano .env
```

Remplissez (ou vérifiez) ces lignes:
```env
database.default.hostname = localhost
database.default.database = hotel_reservation
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

Sauvegardez avec **Ctrl+X → Y → Entrée**

### **Étape 3: Exécuter les migrations**

```bash
# IMPORTANT: utilisez le PHP fourni par XAMPP pour éviter les différences d'extensions
# (ex. mysqli) entre le PHP système et celui de XAMPP.
 # Option 1 — Exécuter avec le binaire XAMPP (recommandé):
 /opt/lampp/bin/php spark migrate

 # Option 2 — Si vous préférez utiliser `php` global, assurez-vous que `mysqli` est activé
 # pour le CLI système (ou définissez un alias). Exemple d'alias à ajouter dans ~/.bashrc:
 # echo "alias php='/opt/lampp/bin/php'" >> ~/.bashrc && source ~/.bashrc
```

✅ Vous devriez voir: "Database migrated successfully"

### **Étape 4: Charger les données initiales**

```bash
# Utilisez le même binaire PHP que pour les migrations:
/opt/lampp/bin/php spark db:seed InitialDataSeeder
```

### **Étape 5: Tester la connexion**

Ouvrez dans votre navigateur:
- **Test connexion**: http://localhost/projet-CVVEN/test/database
- **Vérifier tables**: http://localhost/projet-CVVEN/test/tables

Les deux doivent afficher "success".

---

## 📱 Accès à l'application

### **Admin (Données de démo)**
```
URL: http://localhost/projet-CVVEN/login
Email: admin@hotel.com
Mot de passe: admin123
```

### **Client (Créer un nouveau)**
```
URL: http://localhost/projet-CVVEN/register
Remplissez le formulaire
```

---

## 🎯 Actions principales

### **1. En tant que CLIENT**

```
1. Aller sur: http://localhost/projet-CVVEN/login
2. Se connecter (ou créer un compte via /register)
3. Aller à /chambres
4. Utiliser "Rechercher une chambre" (remplir dates)
5. Cliquer "Réserver cette chambre"
6. Voir ses réservations dans le dashboard
```

### **2. En tant qu'ADMIN**

```
1. Se connecter avec admin@hotel.com / admin123
2. Aller à: http://localhost/projet-CVVEN/admin/dashboard
3. Gestion possibles:
   - /chambres → Créer/Modifier/Supprimer chambres
   - /admin/reservations → Confirmer/Annuler réservations
   - /admin/clients → Voir les clients
   - /admin/users → Gérer les utilisateurs
```

---

## 📊 Structure des données

### **USERS (Utilisateurs)**
```
id_user  | email                | role    
---------|----------------------|--------
1        | admin@hotel.com      | admin   
2        | client@example.com   | client  
```

### **CLIENTS (Profils clients)**
```
id_client | id_user | nom      | prenom  | telephone      
----------|---------|----------|---------|---------------
1         | 2       | Dupont   | Jean    | 06 12 34 56 78 
```

### **CHAMBRES (Chambres)**
```
id_chambre | nom             | capacite | prix_par_nuit 
-----------|-----------------|----------|---------------
1          | Chambre Standard | 2        | 79.99         
2          | Chambre Deluxe  | 3        | 129.99        
```

### **RESERVATIONS (Réservations)**
```
id | id_client | id_chambre | date_debut | date_fin   | statut     | nb_personnes
---|-----------|-----------|------------|------------|-----------|---------------
1  | 1         | 1         | 2024-12-15 | 2024-12-18 | en_attente | 2             
```

---

## 🔧 Commandes utiles

```bash
# Voir les routes
# Utiliser le binaire XAMPP pour les commandes CLI:
/opt/lampp/bin/php spark routes

# Voir les logs d'erreur
tail -f writable/logs/log-*.log

# Réinitialiser la BD (dangereux!)
 /opt/lampp/bin/php spark migrate:rollback --all

# Créer une migration
 /opt/lampp/bin/php spark make:migration MigrationName

# Créer un contrôleur
 /opt/lampp/bin/php spark make:controller ControllerName

# Créer un modèle
 /opt/lampp/bin/php spark make:model ModelName
```

---

## ✅ Checklist de vérification

- [ ] Base de données créée
- [ ] Fichier `.env` configuré
- [ ] Migrations exécutées (`php spark migrate`)
- [ ] Données initiales chargées
- [ ] Test connexion BD réussit
- [ ] Test tables réussit
- [ ] Connexion admin fonctionne
- [ ] Inscription client fonctionne
- [ ] Recherche de chambres fonctionne
- [ ] Création de réservation fonctionne

---

## 🐛 Troubleshooting

### **Erreur: "SQLSTATE[HY000]: General error: 1030"**
→ La base de données n'existe pas
```bash
mysql -u root -e "CREATE DATABASE hotel_reservation;"
```

### **Erreur: "Unknown column 'email' in users table"**
→ Les migrations n'ont pas été exécutées
```bash
php spark migrate
```

### **Erreur: "Access denied for user"**
→ Vérifiez username/password dans `.env`

### **Les vues ne s'affichent pas**
→ Assurez-vous que les fichiers existent:
```bash
ls -la app/Views/auth/
ls -la app/Views/clients/
```

### **Erreur 404 sur les routes**
→ Vérifiez que `Routes.php` est configuré
```bash
cat app/Config/Routes.php | head -20
```

---

## 🔐 Utilisateurs de test inclus

| Email | Mot de passe | Rôle |
|-------|---|---|
| admin@hotel.com | admin123 | Admin |

---

## 📁 Fichiers importants

```
/app/Config/Routes.php          → Routes de l'app
/app/Config/Database.php        → Config BD
/app/Models/*.php               → Modèles de données
/app/Controllers/*.php          → Logique métier
/app/Views/**/*.php             → Templates HTML
/app/Database/Migrations/       → Schéma BD
/app/Database/Seeds/            → Données initiales
```

---

## 🆘 Support rapide

1. **Vérifier les logs**
   ```bash
   tail -f writable/logs/*.log
   ```

2. **Tester la BD**
   ```
   http://localhost/projet-CVVEN/test/database
   ```

3. **Vérifier les tables**
   ```
   http://localhost/projet-CVVEN/test/tables
   ```

4. **Consulter la documentation**
   - `INSTALLATION_GUIDE.md` - Guide complet
   - `PROJECT_SUMMARY.md` - Résumé du projet

---

## 🎉 Succès!

Si tout est vert, vous êtes prêt à:
- ✅ Créer des comptes clients
- ✅ Chercher des chambres disponibles
- ✅ Effectuer des réservations
- ✅ Gérer l'hôtel en tant qu'admin

**Bon développement! 🚀**
