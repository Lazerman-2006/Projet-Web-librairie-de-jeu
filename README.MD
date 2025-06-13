
# Projet API STEAM

---

## 🚀 Membres du projet

| Nom                  | Identifiant  |
|----------------------|--------------|
| FAGOT--NAUDE Amélien | fago0014     |
| PIERRON Matteo       | pier0270     |

---

## ⚙️ Initialisation du projet

Ce projet nécessite **Composer** pour gérer les dépendances.

1. Assurez-vous que Composer est installé et configuré (source ~/.profile pour Linux/macOS).
2. Installez les dépendances :

```bash
composer install
```

3. Générez l'autoloader à jour :

```bash
composer dump-autoload
```

---

## ▶️ Lancement du serveur web

- **Windows**

```bash
composer start:windows
```

- **Linux**

```bash
composer start
# ou
composer start:linux
```

---

## 📁 Contenu du projet

Le projet s’appuie sur un extrait de l’API Steam pour afficher des informations sur les jeux vidéo.

### Pages principales

- **index.php**  
  Affiche la liste des **genres** et des **catégories** présents dans l’extrait Steam.

- **genre.php / categorie.php**  
  Liste les jeux appartenant à un genre ou une catégorie spécifique.  
  Pour chaque jeu, vous verrez :
  - Poster
  - Nom
  - Année
  - Description
  - Boutons pour trier par titre ou par année
  - Bouton retour à l'accueil (index.php)

- **game.php**  
  Affiche les détails d’un jeu sélectionné :
  - Prix
  - Poster
  - Année
  - Développeur
  - Note
  - Description
  - Plateformes disponibles
  - Catégories et genres associés
  - Bouton **Supprimer** pour retirer ce jeu de la base de données
  - Bouton retour à l'accueil

---

## 📌 Fonctionnalités clés

- Navigation fluide entre genres, catégories et détails des jeux
- Tri dynamique des listes de jeux par titre ou par année
- Gestion simplifiée via suppression directe d’un jeu depuis sa fiche

---

## 📌 Formulaire

## 1. Formulaire de modification (game_modif.php)

Le formulaire affiche les données actuelles d’un jeu (nom, année, description, prix, plateformes, metacritic, développeur, affiche, catégories, genres)  
L’utilisateur modifie ces données, puis soumet le formulaire en POST vers game_modif_post.php.

---

## 2. Traitement du formulaire (game_modif_post.php)

- Récupération des données POST avec conversion stricte (int, float).
- Validation simple des champs obligatoires.
- Chargement de l’entité Game existante via GameCollection::findById($id).
- Mise à jour des propriétés de l’objet Game avec les setters.
- Conversion du prix en centimes (int).
- Conversion des plateformes (checkboxes) en 0/1.
- Gestion du score Metacritic (par défaut 0 si vide).
- Gestion des associations catégories et genres :
  - Suppression des anciennes via deleteByGameId($id)
  - Insertion des nouvelles via insert($id, $categoryId) ou insert($id, $genreId)
- Appel à la méthode save() de l’objet Game pour mise à jour en base.
- Redirection vers la page de modification avec l’ID en paramètre.

---

## 3. Méthodes clés

### GameCollection

- findById(int $id): ?Game — récupère un jeu par son ID.

### GameCategoryCollection

- deleteByGameId(int $gameId): void — supprime toutes les catégories liées.
- insert(int $gameId, int $categoryId): void — ajoute une association catégorie.

### GameGenreCollection

- deleteByGameId(int $gameId): void — supprime toutes les associations genres.
- insert(int $gameId, int $genreId): void — ajoute une association genre.

### Game (entité)

- Setters : setName(), setReleaseYear(), setShortDescription(), setPrice(), setWindows(), setLinux(), setMac(), setMetacritic(), setDeveloperId(), setPosterId().
- save(): void — met à jour les données du jeu dans la base.

---

## 4. Bonnes pratiques

- Valider et typer strictement les données du formulaire.
- Ne jamais modifier la clé primaire lors d’une modification.
- Supprimer les anciennes associations avant insertion des nouvelles pour éviter les doublons.
- Convertir les booléens en entiers avant stockage.
- Utiliser des transactions PDO pour garantir la cohérence (recommandé en production).

---

## 5. Workflow résumé

1. Affichage du formulaire avec données existantes.
2. Soumission du formulaire modifié.
3. Validation et mise à jour de l’objet Game.
4. Suppression et réinsertion des catégories et genres.
5. Sauvegarde finale en base.
6. Redirection vers la page de modification.

---

## 📌 Arboescence du projet

/bin  
run-server.bat          # Script Windows pour démarrer le serveur  
run-server.sh           # Script Linux/macOS pour démarrer le serveur

/public  
/css  
style.css           # Feuille de styles CSS globale du projet  
/Form  
game_add.php        # Formulaire d'ajout d'un jeu  
game_create_post.php # Traitement POST de création d'un jeu  
game_delete.php     # Suppression d'un jeu  
game_modif.php      # Formulaire de modification d'un jeu  
game_modif_post.php # Traitement POST de modification d'un jeu  
game_select.php     # Liste ou sélection de jeux  
/svg  
apple.svg           # Icône Apple/macOS  
linux.svg           # Icône Linux  
windows.svg         # Icône Windows  
categorie.php           # Gestion des catégories  
game.php                # Fichier principal lié aux jeux (logique métier ?)  
genre.php               # Gestion des genres  
index.php               # Page d'accueil ou route principale

/src  
/Database  
MyPdo.php           # Classe singleton PDO pour la connexion à la base de données

/Entity  
/Collection  
CategorieCollection.php       # Gestion des collections de catégories (CRUD)  
GameCategoryCollection.php   # Gestion des relations jeu-catégorie  
GameCollection.php           # Gestion des jeux (CRUD)  
GameGenreCollection.php      # Gestion des relations jeu-genre  
GenderCollection.php         # Gestion des genres (CRUD)  
/Exception  
AppWebPage.php               # Gestion des exceptions personnalisées  
Categorie.php                # Entité catégorie  
Developer.php                # Entité développeur  
Game.php                     # Entité jeu, contient la logique métier et les setters/getters  
Gender.php                   # Entité genre  
Poster.php                   # Entité poster (image ou affiches ?)  
/Html  
StringEscaper.php               # Classe utilitaire pour échapper les chaînes HTML  
WebPage.php                    # Classe pour générer les pages web dynamiques
