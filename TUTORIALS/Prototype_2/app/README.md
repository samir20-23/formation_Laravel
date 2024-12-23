# Installation Laravel

## Installation de PHP

PHP 8.2.11 (cli) (construit le 1er octobre 2021 à 15h00) ou une version plus récente est requise.

## Guide de Démarrage pour Prototype

1. Ouvrez votre terminal.
2. Accédez au répertoire app

```bash
cd app
```
3. Installer les dépendances Composer :

```bash
composer install
npm install
```


4. Créer un fichier .env en copiant .env.example :
   
```bash
cp .env.example .env
```

5. Configuration de la Base de Données pour un Projet Laravel
   
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=password
```
6. Générer une clé d'application avec artisan :

```bash
php artisan key:generate
```
7. Migrer la base de données :

```bash
php artisan migrate

# ou 
php artisan migrate:fresh
```
8. Exécuter les seeders pour peupler la base de données :
   
```bash
php artisan db:seed
```

9. Installer les dépendances npm :

```bash
php artisan serve
```

- Compiler les assets avec npm : après la modification des scripts 


```bash
npm run build
```

## Loin and password 

- admin
  - login :admin@gmail.com
  - mot de passe: admin
- membre
  - login : membre@gmail.com
  - mot de passe : membre


## autoload

Il permet de autoload les class.

````bash
composer dump-autoload
````

Voici une version reformulée et plus claire de la section :



## Instructions pour créer un prototype à partir d'un projet Laravel vierge

<!-- TODO : Rédiger un tutoriel détaillé pour expliquer la création d’un prototype depuis un projet Laravel vierge -->

### Étapes à suivre :

1. **Créer un projet Laravel vierge :**  
2. **Initialiser le contrôle de version :**  
   Exécutez les commandes suivantes pour ajouter le projet au contrôle de version :  
   ```bash
   git init
   git add .
   git commit -m "Initialisation du projet Laravel vierge"
   ```

3. **Copier les fichiers du prototype :**  
   Importez les fichiers du prototype dans le répertoire du projet Laravel vierge.

4. **Vérifier les modifications :**  
   Identifiez les fichiers modifiés ou ajoutés par rapport au projet vierge en utilisant :  
   ```bash
   git status
   ```

5. **Documenter les modifications :**  
   Commentez chaque fichier ou modification pour expliquer leur rôle et leur impact dans le prototype.

6. **Créer un tutoriel complet :**  
   Rédigez un tutoriel qui explique pas à pas comment ajouter et modifier ces fichiers dans un projet Laravel vierge.
