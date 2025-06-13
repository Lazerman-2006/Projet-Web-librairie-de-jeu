
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

1. Assurez-vous que Composer est installé et configuré (`source ~/.profile` pour Linux/macOS).
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
    - Bouton retour à l'accueil (`index.php`)

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

Merci d’explorer ce projet !
