# 📚 EXEMPLES D'UTILISATION - Système de Réservation

## 1️⃣ AUTHENTIFICATION

### Créer un compte client

**URL**: `POST /auth/register`

**Données du formulaire**:
```html
<form method="POST" action="/auth/register">
    <input name="email" type="email" value="client@example.com">
    <input name="mot_de_passe" type="password" value="password123">
    <input name="mot_de_passe_confirm" type="password" value="password123">
    <input name="nom" type="text" value="Dupont">
    <input name="prenom" type="text" value="Jean">
    <input name="telephone" type="tel" value="06 12 34 56 78">
</form>
```

**Réponse**: Redirection vers `/login` avec succès

---

### Se connecter

**URL**: `POST /auth/login`

**Données du formulaire**:
```html
<form method="POST" action="/auth/login">
    <input name="email" type="email" value="client@example.com">
    <input name="mot_de_passe" type="password" value="password123">
</form>
```

**Session créée**:
```php
session()->set([
    'id_user' => 2,
    'email' => 'client@example.com',
    'role' => 'client',
    'id_client' => 1,
    'isLoggedIn' => true
]);
```

**Redirection**: Vers `/dashboard` (qui redirige vers `/client/dashboard`)

---

## 2️⃣ CHAMBRES

### Afficher toutes les chambres

**URL**: `GET /chambres`

**Contrôleur**:
```php
public function index()
{
    $data = [
        'chambres' => $this->chambreModel->findAll()
    ];
    return view('chambres/list', $data);
}
```

**Données retournées**:
```php
[
    [
        'id_chambre' => 1,
        'nom' => 'Chambre Standard',
        'capacite' => 2,
        'description' => '...',
        'prix_par_nuit' => 79.99,
        'created_at' => '2024-12-05 10:30:00',
        'updated_at' => '2024-12-05 10:30:00'
    ],
    // ...autres chambres
]
```

---

### Rechercher des chambres disponibles

**URL**: `GET /chambres/search?date_debut=2024-12-15&date_fin=2024-12-18`

**Contrôleur**:
```php
public function search()
{
    $date_debut = $this->request->getGet('date_debut'); // 2024-12-15
    $date_fin = $this->request->getGet('date_fin');     // 2024-12-18

    $chambres = $this->chambreModel->getAvailableRooms($date_debut, $date_fin);

    return view('chambres/search_results', [
        'chambres' => $chambres,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin
    ]);
}
```

**SQL généré**:
```sql
SELECT chambres.*
FROM chambres
WHERE id_chambre NOT IN (
    SELECT id_chambre
    FROM reservations
    WHERE statut != 'annulee'
    AND date_fin > '2024-12-15'
    AND date_debut < '2024-12-18'
)
```

---

### Obtenir les détails d'une chambre

**URL**: `GET /chambre/detail/1`

**Contrôleur**:
```php
public function detail($id_chambre = null)
{
    $room = $this->chambreModel->getRoomWithReservations($id_chambre);
    
    return view('chambres/detail', ['chambre' => $room]);
}
```

**Données retournées**:
```php
[
    'id_chambre' => 1,
    'nom' => 'Chambre Standard',
    'capacite' => 2,
    'description' => 'Chambre confortable pour 2 personnes...',
    'prix_par_nuit' => 79.99,
    'reservations' => [
        [
            'id_reservation' => 1,
            'date_debut' => '2024-12-15',
            'date_fin' => '2024-12-18',
            'statut' => 'confirmee'
        ]
    ]
]
```

---

### Créer une chambre (Admin)

**URL**: `POST /chambre/create`

**Données du formulaire**:
```html
<form method="POST" action="/chambre/create">
    <input name="nom" value="Suite Luxe">
    <input name="capacite" type="number" value="4">
    <textarea name="description">Suite avec chambre séparée...</textarea>
    <input name="prix_par_nuit" type="number" step="0.01" value="249.99">
</form>
```

**Contrôleur**:
```php
public function create()
{
    $data = [
        'nom' => $this->request->getPost('nom'),
        'capacite' => $this->request->getPost('capacite'),
        'description' => $this->request->getPost('description'),
        'prix_par_nuit' => $this->request->getPost('prix_par_nuit')
    ];

    // Validation automatique via le modèle
    if (!$this->chambreModel->insert($data)) {
        return redirect()->back()->with('errors', $this->chambreModel->errors());
    }

    return redirect()->to(base_url('chambres'))->with('success', 'Chambre créée!');
}
```

**SQL généré**:
```sql
INSERT INTO chambres (nom, capacite, description, prix_par_nuit, created_at, updated_at)
VALUES ('Suite Luxe', 4, 'Suite avec chambre séparée...', 249.99, NOW(), NOW())
```

---

## 3️⃣ RÉSERVATIONS

### Afficher le formulaire de réservation

**URL**: `GET /reservation/booking/1?date_debut=2024-12-15&date_fin=2024-12-18`

**Contrôleur**:
```php
public function bookingForm($id_chambre)
{
    if (!$this->session->get('isLoggedIn') || 
        $this->session->get('role') !== 'client') {
        return redirect()->to(base_url('login'));
    }

    $chambre = $this->chambreModel->find($id_chambre);

    return view('reservations/form', [
        'chambre' => $chambre,
        'date_debut' => $this->request->getGet('date_debut'),
        'date_fin' => $this->request->getGet('date_fin')
    ]);
}
```

---

### Créer une réservation

**URL**: `POST /reservation/create`

**Données du formulaire**:
```html
<form method="POST" action="/reservation/create">
    <input type="hidden" name="id_chambre" value="1">
    <input type="date" name="date_debut" value="2024-12-15">
    <input type="date" name="date_fin" value="2024-12-18">
    <input type="number" name="nb_personnes" value="2">
</form>
```

**Contrôleur**:
```php
public function create()
{
    $id_client = $this->session->get('id_client');
    
    $data = [
        'id_client' => $id_client,
        'id_chambre' => $this->request->getPost('id_chambre'),
        'date_debut' => $this->request->getPost('date_debut'),
        'date_fin' => $this->request->getPost('date_fin'),
        'nb_personnes' => $this->request->getPost('nb_personnes'),
        'statut' => 'en_attente'
    ];

    // Vérifier la disponibilité
    if (!$this->reservationModel->isRoomAvailable(
        $data['id_chambre'],
        $data['date_debut'],
        $data['date_fin']
    )) {
        return redirect()->back()->with('error', 'Chambre non disponible');
    }

    // Vérifier la capacité
    $chambre = $this->chambreModel->find($data['id_chambre']);
    if ($data['nb_personnes'] > $chambre['capacite']) {
        return redirect()->back()->with('error', 'Dépasse la capacité');
    }

    $this->reservationModel->insert($data);

    return redirect()->to(base_url('client/reservations'))
                    ->with('success', 'Réservation créée!');
}
```

**SQL généré**:
```sql
INSERT INTO reservations 
(id_client, id_chambre, date_debut, date_fin, statut, nb_personnes, created_at, updated_at)
VALUES (1, 1, '2024-12-15', '2024-12-18', 'en_attente', 2, NOW(), NOW())
```

---

### Voir les réservations du client

**URL**: `GET /client/reservations`

**Contrôleur**:
```php
public function viewReservations()
{
    $id_client = $this->session->get('id_client');
    
    $data = [
        'reservations' => $this->reservationModel->getClientReservations($id_client)
    ];

    return view('clients/reservations', $data);
}
```

**Données retournées**:
```php
[
    [
        'id_reservation' => 1,
        'id_client' => 1,
        'date_debut' => '2024-12-15',
        'date_fin' => '2024-12-18',
        'statut' => 'en_attente',
        'nb_personnes' => 2,
        'chambre_nom' => 'Chambre Standard',
        'prix_par_nuit' => 79.99
    ]
]
```

---

### Annuler une réservation

**URL**: `GET /reservation/cancel/1`

**Contrôleur**:
```php
public function cancel($id_reservation)
{
    $reservation = $this->reservationModel->find($id_reservation);

    // Vérifier que c'est le client qui fait la demande
    if ($this->session->get('role') === 'client' && 
        $reservation['id_client'] !== $this->session->get('id_client')) {
        throw new PageNotFoundException('Accès refusé');
    }

    $this->reservationModel->update($id_reservation, ['statut' => 'annulee']);

    return redirect()->to(base_url('client/reservations'))
                    ->with('success', 'Réservation annulée');
}
```

**SQL généré**:
```sql
UPDATE reservations SET statut = 'annulee' WHERE id_reservation = 1
```

---

## 4️⃣ ADMINISTRATION

### Tableau de bord admin

**URL**: `GET /admin/dashboard`

**Contrôleur**:
```php
public function dashboard()
{
    $data = [
        'total_users' => $this->userModel->countAllResults(),
        'total_clients' => $this->clientModel->countAllResults(),
        'total_chambres' => $this->chambreModel->countAllResults(),
        'total_reservations' => $this->reservationModel->countAllResults(),
        'reservations_en_attente' => 
            $this->reservationModel->where('statut', 'en_attente')->countAllResults(),
        'reservations_confirmees' => 
            $this->reservationModel->where('statut', 'confirmee')->countAllResults(),
        'recent_reservations' => $this->reservationModel->getAllReservationsWithDetails()
    ];

    return view('admin/dashboard', $data);
}
```

**Données affichées**:
```
Total utilisateurs:        2
Total clients:             1
Total chambres:            4
Total réservations:        1
Réservations en attente:   1
Réservations confirmées:   0
```

---

### Gérer les réservations (Admin)

**URL**: `POST /admin/update-reservation-status/1`

**Données du formulaire**:
```html
<form method="POST" action="/admin/update-reservation-status/1">
    <select name="statut" onchange="this.form.submit()">
        <option value="en_attente">En attente</option>
        <option value="confirmee" selected>Confirmée</option>
        <option value="annulee">Annulée</option>
    </select>
</form>
```

**Contrôleur**:
```php
public function updateReservationStatus($id_reservation)
{
    $statut = $this->request->getPost('statut');

    if (!in_array($statut, ['en_attente', 'confirmee', 'annulee'])) {
        return redirect()->back()->with('error', 'Statut invalide');
    }

    $this->reservationModel->update($id_reservation, ['statut' => $statut]);

    return redirect()->back()->with('success', 'Statut mis à jour');
}
```

---

## 5️⃣ TESTS

### Tester la connexion à la base de données

**URL**: `GET /test/database`

**Réponse (JSON)**:
```json
{
    "status": "success",
    "message": "Connexion à la base de données réussie!",
    "database": "hotel_reservation",
    "driver": "MySQLi"
}
```

---

### Vérifier les tables

**URL**: `GET /test/tables`

**Réponse (JSON)**:
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

## 📊 STATISTIQUES CALCULÉES

### Calcul du prix total d'une réservation

```php
$date_debut = new DateTime($reservation['date_debut']);
$date_fin = new DateTime($reservation['date_fin']);
$days = $date_fin->diff($date_debut)->days;
$total = $days * $reservation['prix_par_nuit'];

// Exemple: 3 nuits × 79.99€ = 239.97€
```

---

## 🔄 FLUX UTILISATEUR COMPLET

### Pour un nouveau client

```
1. Accéder à /register
   ↓
2. Remplir: email, mot_de_passe, nom, prenom, telephone
   ↓
3. Créé: users + clients
   ↓
4. Redirection vers /login
   ↓
5. Se connecter
   ↓
6. Session créée avec id_user, id_client, role
   ↓
7. Accéder à /chambres
   ↓
8. Utiliser /chambres/search avec dates
   ↓
9. Cliquer "Réserver" sur une chambre
   ↓
10. Remplir /reservation/form (dates, nb_personnes)
    ↓
11. POST /reservation/create
    ↓
12. Vérification: disponibilité + capacité
    ↓
13. Créé: reservation (en_attente)
    ↓
14. Voir dans /client/reservations
```

---

## 🛡️ VALIDATIONS

### UserModel - Inscription

```php
'email'         => 'required|valid_email|is_unique[users.email]'
'mot_de_passe'  => 'required|min_length[6]|matches[mot_de_passe_confirm]'
'role'          => 'required|in_list[admin,client]'
```

### ChambreModel - Création

```php
'nom'            => 'required|min_length[3]|max_length[100]'
'capacite'       => 'required|numeric|greater_than[0]|less_than_equal_to[10]'
'prix_par_nuit'  => 'required|numeric|greater_than[0]'
```

### ReservationModel - Création

```php
'id_client'      => 'required|numeric'
'id_chambre'     => 'required|numeric'
'date_debut'     => 'required|valid_date[Y-m-d]'
'date_fin'       => 'required|valid_date[Y-m-d]'
'statut'         => 'required|in_list[en_attente,confirmee,annulee]'
'nb_personnes'   => 'required|numeric|greater_than[0]'
```

---

**Fin des exemples d'utilisation** ✅
