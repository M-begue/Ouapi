# Système de Sauvegarde OUAPI - Documentation d'Intégration

## Vue d'ensemble

Un système complet de sauvegarde a été implémenté pour OUAPI. Il permet aux administrateurs de créer des sauvegardes complètes (fichiers + base de données) et de les gérer facilement.

## Fichiers créés

### 1. **adm_backup.php**
Fichier PHP principal de gestion des sauvegardes. Il contient:
- Création de sauvegardes complètes (fichiers + base de données)
- Affichage de la liste des sauvegardes existantes
- Suppression de sauvegardes

**Fonctionnalités:**
- Sauvegarde tous les fichiers du projet (sauf temp et backups)
- Exporte la base de données complète en SQL
- Crée des archives ZIP automatiquement
- Stocke les sauvegardes dans le dossier `/backups`
- Formate automatiquement les noms de fichiers avec timestamp

### 2. **process_backup.php**
Fichier de traitement pour les actions de sauvegarde:
- Gère le téléchargement des fichiers de sauvegarde
- Gère la suppression des fichiers de sauvegarde

### 3. **templates/default/adm_backup.tpl**
Template affichant l'interface de sauvegarde avec:
- Formulaire pour créer une nouvelle sauvegarde
- Liste des sauvegardes existantes avec:
  - Date de création
  - Taille du fichier
  - Boutons de téléchargement et suppression

### 4. Traductions (lang_FR.php et lang_EN.php)
Ajout des traductions pour:
- FR: "Sauvegardes", "Créer une sauvegarde", etc.
- EN: "Backups", "Create a new backup", etc.

## Structure des sauvegardes

```
/backups/
├── OUAPI_backup_2024-12-15_14-30-45.zip
├── OUAPI_backup_2024-12-14_10-15-20.zip
└── OUAPI_backup_2024-12-13_09-45-30.zip
```

Chaque archive ZIP contient:
```
OUAPI_backup_2024-12-15_14-30-45/
├── files/                    # Tous les fichiers du projet
│   ├── accueil.php
│   ├── adm_*.php
│   ├── includes/
│   ├── templates/
│   └── ...
├── database_backup.sql       # Export de la base de données
└── backup_info.txt          # Informations sur la sauvegarde
```

## Intégration dans le menu Admin

Pour que le système de sauvegarde soit accessible depuis le menu d'administration, vous devez:

### 1. Ajouter un lien dans le menu d'administration

Dans le template d'administration (template HTML), ajoutez un lien vers la page de sauvegarde:

```html
<a href="index.php?page=adm_backup.php">Sauvegardes</a>
```

Ou si vous avez une page d'administration globale (adm_display.php ou similaire):

```html
<a href="index.php?page=adm_backup.php&rubrique=admin">Sauvegardes</a>
```

### 2. Assurer la permission d'accès

Vérifiez que les utilisateurs autorisés à accéder au module d'administration ont les droits nécessaires pour accéder à `adm_backup.php`.

## Utilisation

### Créer une sauvegarde

1. Allez à la section "Sauvegardes" du menu d'administration
2. Cliquez sur le bouton "Créer la sauvegarde"
3. Une nouvelle sauvegarde est automatiquement créée avec:
   - Tous les fichiers du projet
   - La base de données complète
   - Les informations de sauvegarde

### Télécharger une sauvegarde

1. Dans la liste des sauvegardes, cliquez sur "Télécharger"
2. Le fichier ZIP est téléchargé sur votre ordinateur

### Supprimer une sauvegarde

1. Dans la liste des sauvegardes, cliquez sur "Supprimer"
2. Confirmez la suppression

## Restauration depuis une sauvegarde

### Restaurer les fichiers

1. Décompressez le fichier ZIP de la sauvegarde
2. Copiez le contenu du dossier `files/` vers votre installation OUAPI
3. Remplacez les fichiers existants

### Restaurer la base de données

1. Décompressez le fichier ZIP de la sauvegarde
2. Ouvrez phpMyAdmin ou un autre outil de gestion SQL
3. Sélectionnez votre base de données OUAPI
4. Allez à l'onglet "Import"
5. Sélectionnez le fichier `database_backup.sql`
6. Cliquez sur "Exécuter"

## Considérations techniques

### Utilisation d'espace disque
Chaque sauvegarde crée une archive ZIP contenant tous les fichiers et la base de données. L'espace requis dépend de:
- Taille totale des fichiers du projet
- Taille de la base de données
- Compression ZIP (généralement 30-50% de réduction)

### Performances
La création d'une sauvegarde peut prendre du temps selon:
- Taille du projet
- Performance du serveur
- Charge système actuelle

### Automatisation future
Pour des sauvegardes automatiques, vous pouvez:
- Ajouter une tâche CRON pour exécuter `process_backup.php?action=create_backup`
- Implémenter un planificateur de sauvegarde

## Dépannage

### Erreur "Impossible de créer le répertoire"
- Vérifiez les permissions du dossier racine d'OUAPI
- Assurez-vous que le serveur a les droits d'écriture sur le dossier

### Erreur "Erreur lors de la création de l'archive ZIP"
- Vérifiez que l'extension ZIP de PHP est activée
- Vérifiez l'espace disque disponible
- Vérifiez les permissions du dossier `/backups`

### Fichier de sauvegarde très volumineux
- Vous pouvez réduire la taille en excluant certains dossiers (données temporaires, cache, etc.)
- Modifiez la ligne dans `adm_backup.php`: `$CopieRecursive->copie('./', $temp_backup_dir . '/files', '', 1, '', 1, array('temp', 'backups', 'dossier_à_exclure'));`

## Modifications possibles

### Exclure d'autres dossiers
Modifiez la ligne:
```php
$CopieRecursive->copie('./', $temp_backup_dir . '/files', '', 1, '', 1, array('temp', 'backups', 'dossier_a_exclure', 'autre_dossier'));
```

### Limiter le nombre de sauvegardes
Ajoutez un code pour supprimer automatiquement les anciennes sauvegardes après création:
```php
// Après la création de la sauvegarde
$max_backups = 10;
// Code pour supprimer les X plus anciennes...
```

### Chiffrer les sauvegardes
Implémentez le chiffrement des archives ZIP pour la sécurité.

## Support et questions

Pour toute question concernant le système de sauvegarde, consultez:
- Le code commenté dans `adm_backup.php`
- Les messages d'erreur affichés dans l'interface
- Les logs du serveur PHP
