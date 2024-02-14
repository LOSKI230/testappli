## cc framework:

Membres du groupe:  
Chrayah Mohamed  
Himmid Brahim  
Lo Mouhamadou  
Fahmaoui Nada

Ce fichier détaille les commandes symfony réalisées pour chaque question.

### question1 :

```
• symfony new cc_framework --webapp
• symfony composer require symfony/webpack-encore-bundle
• npm install
• npm install bootstrap
• npm install bootstrap-icons
```
### question2:
```
• composer require symfony/orm-pack
• composer require --dev symfony/maker-bundle
• composer require doctrine/doctrine-migrations-bundle "^3.0"
• symfony console doctrine:database:create
• symfony console make:entity lecon
• symfony console make:migration
• symfony console doctrine:migrations:migrate
```

### question3
```
• symfony composer require fakerphp/faker
• symfony composer require orm-fixtures --dev
• symfony console make:fixture
• symfony console doctrine:fixtures:load
```
### question4
```
• symfony console make:crud Lecon
```

### question5:
```
• ajout de la barre de navigation avec la balise nav de bootstrap
• des ajustements ont été effectués, incluant l'ajout des boutons Supprimer, Afficher, Modifier, Retour, ainsi que quelques autres paramètres pour embellir l'application
```
### question6
```
• symfony composer require cebe/markdown
• ajout du service cebe\markdown\Markdown: ~ dans config/services.yaml
• symfony console make:twig-extension
• modification des fichiers MarkdownExtension.php, MarkdownExtensionRuntime.php
• modification des fixtures ainsi que  des templates
Nous en avons profité pour installer la fonctionnalité truncate ainsi que la pagination avec les commandes suivantes:
Pour le tuncate:
• composer require twig/string-extra
• composer require twig/extra-bundle
Pour la pagination:
• symfony composer require knplabs/knp-paginator-bundle
• modification du controleur et d'index.html.twig
```

### question7
```
Création de l’entité User avec:
• symfony console make:user
• symfony console m:mig
• symfony console d:m:m
• ajout des attributs prenom et nom
• modification de RegistrationFormType.php,Register.html.twig (Pour ajouter nom et prenom)
Création du module d’authentification
• symfony console make:auth
• Modifier public function onAuthenticationSuccess
Création du module d’authentification
• symfony console make:registration-form
• mise en place du role professeur par défaut
```
### question8
```
• creation d'une relation ManytoOne entre les entités leçon et user
• modification des fixtures pour donner à chaque leçcon un unique professeur
mise à jour des migrations:
• symfony console make:migration
• symfony console doctrine:migrations:migrate
modification puis mise à jour des fixtures :
• symfony console doctrine:fixtures:load
```
### question9
```
• mise en place de l'autorisation de creation d'une lecon que par un professeur connecté
via : {% if is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_PROFESSEUR') %}
•recuperation de l'utilisateur connécté pour en faire l'auteur de la leçcon crée






