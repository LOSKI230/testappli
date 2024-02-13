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