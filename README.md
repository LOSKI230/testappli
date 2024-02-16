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
• modification des fixtures pour donner à chaque leçon un unique professeur
mise à jour des migrations:
• symfony console make:migration
• symfony console doctrine:migrations:migrate
modification puis mise à jour des fixtures :
• symfony console doctrine:fixtures:load
• mise en place d'un bouton connexion temporaire au niveau de la barre de navigation pour tester les connexions
```
### question9
```
• mise en place de l'autorisation de creation d'une lecon que par un professeur connecté
via : {% if is_granted('IS_AUTHENTICATED_FULLY') and is_granted('ROLE_PROFESSEUR') %}
•recuperation de l'utilisateur connécté pour en faire l'auteur de la leçcon créée
```

### question10
```
Rajout des contraintes sur la  modification et la suppression uniquement accessible par un professeur
correction de la navbar avec les boutons qui s'affichent que quand il est bien authentifié
Si l'utilisateur non connecté, accéde à une page via une url (de modification / d'ajout par exemple), sera redirigé vers la page de connexion.  
```
### question11
```
embellissement général du site
```
### question12
```
• ajout des boutons inscription et desinscription
• mise à jour des entités lecon et user avec:
-liste des participants à une leçon 
- liste des leçons auxquelles l'utilisateur participe
- variable statut pour voir si l'utilisateur est deja inscrit
• mise à jour du controleur avec les routes app_lecon_inscription et app_lecon_desinscription
• A cette étape pas de distinction entre les professeurs et les éléves
```
### question13
```
• Ajout d'un bouton participants pour permettre au professeur de visualiser les éleves inscrits
• Ajout du bouton mes_leçons au niveau de  la navbar pour visualiser les leçons auxquelles l'utilisateur participe 
• Ajout d'un nouveau twig (show_mes_lecon.html.twig) pour afficher les leçons des utilisateurs
• Ajout d'un nouveau twig (participants.html.twig) pour afficher les participants à une leçon

```
### qyestion14
```
• embelissement general du site

```

### question 15
```
• Ajout des boutons gerer professeur et ajout professeur au niveau de la navbar avec:
- Ajout du controleur professeurController pour gerer les professeur
- Ajout des twigs (afficher.html.twig) (ajoutprof.html.twig)
- modification  des fixtures mise en place de utilisateurs admin,professeur et eleve

```
### question 16
```
• Ajout des contraintes principalement grâce à is_granted():

-un admin ne peut supprimer un professeur qu'aprés avoir supprimer les leçons de ce dernier
-suppression des boutons inscription et desinscription pour les professeurs et admins
-un prof ne peut supprimer ou modifier que ses leçons
-l'inscription est uniquement reservée aux élèves
-les statuts ne s'affichent que pour les élèves

```
### question 17
```
• embelissement general du site
```

### POUR LES TESTS
```
• un eleve : login : eleve , mot de passe : secret
• un professeur : login : professeur , mot de passe : secret
• un admin : login : admin , mot de passe : secret
```