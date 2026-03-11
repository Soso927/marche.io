# 🛒 marche.io — Marketplace Multi-Vendeurs

> Projet réalisé dans le cadre du titre **DWWM (Développeur Web et Web Mobile)**
> Framework : Laravel 12 | Base de données : MySQL | Paiement : Stripe

---

## 📋 Présentation du projet

**marche.io** est une marketplace multi-vendeurs développée avec Laravel 12. La plateforme permet à des vendeurs d'ouvrir leur boutique en ligne, de gérer leur catalogue de produits et de recevoir des paiements — le tout supervisé par un administrateur.

### Fonctionnalités prévues

- Authentification complète (inscription, connexion, profil, 2FA)
- Gestion des rôles : **Admin**, **Vendeur**, **Acheteur**
- Gestion des boutiques et des produits (CRUD complet)
- Système de panier et de commandes
- Paiement en ligne via **Stripe**
- Génération de factures PDF
- Espace d'administration (validation boutiques, modération, statistiques)
- API REST sécurisée avec Laravel Sanctum
- Interface responsive Mobile-first avec Tailwind CSS

---

## 🛠️ Stack technique

| Technologie | Usage |
|---|---|
| **PHP 8.2+** | Langage principal |
| **Laravel 12** | Framework PHP |
| **MySQL** | Base de données relationnelle |
| **Jetstream + Livewire** | Authentification et composants dynamiques |
| **Spatie/Laravel-Permission** | Gestion des rôles et permissions |
| **Stripe** | Paiement en ligne et virements vendeurs |
| **Laravel DomPDF** | Génération de factures PDF |
| **Intervention Image** | Redimensionnement des images produits |
| **Laravel Telescope** | Debug et monitoring (développement) |
| **Tailwind CSS** | Framework CSS responsive |

---

## ⚙️ Prérequis

Avant d'installer le projet, assure-toi d'avoir :

- PHP >= 8.2
- Composer
- Node.js >= 18 et npm
- MySQL
- Laragon (Windows) ou équivalent

---

## 🚀 Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/TON_USERNAME/marche.io.git
cd marche.io
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
npm run dev
```

### 4. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

Édite le fichier `.env` avec tes informations :

```env
DB_DATABASE=marche_io
DB_USERNAME=root
DB_PASSWORD=ton_mot_de_passe

STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
```

### 5. Créer la base de données

```bash
mysql -u root -p
CREATE DATABASE marche_io CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### 6. Exécuter les migrations et les seeders

```bash
php artisan migrate
php artisan db:seed
```

### 7. Lancer le serveur

```bash
php artisan serve
```

L'application est accessible sur `http://127.0.0.1:8000`

---

## 👤 Comptes de test

| Rôle | Email | Mot de passe |
|---|---|---|
| **Admin** | admin@marche.io | password |
| **Vendeur** | seller@marche.io | password |
| **Acheteur** | buyer@marche.io | password |

---

## 🗄️ Structure de la base de données

### Tables créées

| Table | Description |
|---|---|
| `users` | Utilisateurs de la plateforme |
| `shops` | Boutiques des vendeurs |
| `categories` | Catégories de produits (avec auto-référence parent/enfant) |
| `products` | Produits mis en vente |
| `orders` | Commandes passées par les acheteurs |
| `order_items` | Lignes de commande |
| `reviews` | Avis produits avec modération |
| `payouts` | Virements vendeurs via Stripe |

### Relations principales

- Un `User` peut posséder une `Shop` (vendeur)
- Une `Shop` possède plusieurs `Products`
- Une `Category` peut avoir des sous-catégories (auto-référence)
- Un `Order` contient plusieurs `OrderItems`
- Un `OrderItem` conserve le prix unitaire au moment de la commande
- Un `Review` n'est visible que s'il est approuvé par l'admin
- Un `Payout` représente un virement Stripe vers un vendeur

---

## 🔐 Gestion des rôles

La gestion des rôles est assurée par le package **Spatie/Laravel-Permission**.

| Rôle | Accès |
|---|---|
| **admin** | Back-office complet, validation boutiques, modération |
| **seller** | Gestion de sa boutique et ses produits |
| **buyer** | Navigation, commandes, avis |

Les routes sont protégées par middleware :

```php
Route::middleware(['auth', 'role:seller'])->prefix('seller')-> ...
Route::middleware(['auth', 'role:admin'])->prefix('admin')-> ...
```

---

## 📁 Architecture du projet

```
marche.io/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Shop.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Review.php
│   │   └── Payout.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── RoleSeeder.php
│       └── UserSeeder.php
├── resources/
│   └── views/
│       ├── admin/
│       ├── seller/
│       └── buyer/
└── routes/
    ├── web.php
    └── api.php
```

---

## 📅 Planning de développement

| Semaine | Phase | Contenu |
|---|---|---|
| **1-2** | Phase 1 + 2 | ✅ Installation, BDD, modèles, seeders |
| **3-4** | Phase 3 + 4.1-4.3 | Auth, rôles, boutique, produits, panier |
| **5-6** | Phase 4.4-4.6 | Commandes, Stripe, back-office admin |
| **7** | Phase 5 | API REST avec Sanctum et Resources |
| **8-9** | Phase 6 | Frontend, Tailwind, Livewire, responsive |
| **10** | Phase 7 + 8 | Tests, sécurité, déploiement, README |

---

## 🔒 Sécurité

- Protection **CSRF** sur tous les formulaires
- **Form Requests** pour la validation des données
- **Policies Laravel** pour l'autorisation fine
- Variables sensibles dans `.env` (jamais dans le code)
- `.env` et `storage/` ajoutés au `.gitignore`
- Échappement des données dans les vues Blade `{{ $var }}`

---

## 📄 Licence

Projet réalisé à des fins pédagogiques dans le cadre du titre DWWM.