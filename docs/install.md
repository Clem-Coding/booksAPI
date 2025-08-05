# 🛠️ Commandes d'installation des dépendances Symfony API REST

## Pré-requis

-   [Symfony CLI](https://symfony.com/download)
-   [Composer](https://getcomposer.org/)

### Commandes d'installation

### Installer le projet

```bash
symfony new nom-du-projet
```

### Installer le maker-bundle

```bash
composer require symfony/maker-bundle --dev
```

### Ajouter Doctrine

```bash
composer require orm
```

### Installer le bundle de fixtures

```bash
composer require orm-fixtures --dev
```

### Installer le Serializer

```bash
composer require symfony/serializer-pack
```

### Instaler le ParamConverter

Le ParamConverter sert, comme son nom l’indique, à “convertir des paramètres”. C'est-à-dire qu’il va tenter, à partir de l’id fourni, de trouver seul de quel livre il s’agit. De fait, il ne sera plus nécessaire de passer l’id et le repository, car le ParamConverter est capable, seul, de fournir directement le livre correspondant.

```bash
composer require sensio/framework-extra-bundle
```

### Installer le validateur

```bash
composer require symfony/validator doctrine/annotations
```

### Installer le compsoant Security

```bash
composer require security
```

### Installer le bundle LexitJWT

Si erreur d’extension manquante lors de l’installation avec Composer,
il faut décommenter cette ligne dans le fichier php.ini pour activer sodium : ;extension=sodium

```bash
composer require lexik/jwt-authentication-bundle
```

## Commandes d'exécution

### Mettre à jour la base de données

```bash
symfony console doctrine:schema:update --force
```

### Exécuter les fixtures

```bash
php bin/console doctrine:fixtures:load
```
