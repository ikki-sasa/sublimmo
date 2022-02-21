# SYMFONY 

##  NOUVEAU PROJET 

- ouvrir un nouveau terminal
- se rendre dans le dossier où l'on veut créer le projet (ex.: Wamp64/www):
```
cd chemin_vers_le_dossier
``` 
- créer le projet avec Symfony CLI (pas besoin de créer le dossier du projet):
``` 
symfony new --webapp nom_du_projet --version=5.4
```
2ème possibilités 
- créer le projet avec Composer (pas besoin de créer le dossier du projet) :
```
composer create-projetc symfony/website-skeleton nom_du_projet ^5.4
```
 ## GIT  
-- créer un dépôt Git sur gitHub 
-- avec le terminal, se rendre dans le dossier du projet (cd chemin du dossier ou vsc)
-- initialiser un dépôt local :
`` 
## Étape 1
git init
``` 
## Étape 2
-lier le dépôt au dépôt distant : 
``
## Étape 3
git remote add origin https://github.com/ikki-sasa/sublimmo.git cette adresse tu la récupère sur github baba 
```
- ajouter tous les fichiers : 
``
## Étape 4
git add *
```
- donner un nom au commit: 
``
## Étape 5
git commit -m "message_du_commit"
```
- récupérer les dernières modifications : 
``
## Étape 6
git pull origin main 
``` 
- envoyer les modifications : 
``` 
git push origin main (ou master) n'oublie pas de push pour l'envoyer sur le site github
```
- voir la liste des commits (flèches haut et vas pour navisuer das la liste, q pour quitter):
```
git log 
``
## récupérer un projet
 dépôt distant est dépôt local

 pour récupérer le code sur Github créér un dossier avec qui va être pris sur GitHub puis taper
.env: 
remplir le database url 

Avant de push man s'il te plaît NE PAS OUBLIER DE COPIER L'INTÉRIEUR DU FICHIER LE SUPPRIMER  LE PUSH AJOUTER /.env dans le fichier GITIGNORE RECREATION DU FICHIER .ENV EST COLLER LE TEXTE PUIS PUSH SUR GITHUB
git init

git remote add origin avec l'adresse code du git 


 besoins de récupérer c'est infos du .env pour le dossier qu'on récupére récréer un .env la racine est y mettre c'est info

 APP_ENV=dev
APP_SECRET=89fb4fb79b11a4e1984b00c62d33b97e
DATABASE_URL="postgresql://symfony:ChangeMe@127.0.0.1:5432/app?serverVersion=13&charset=utf8" peut etre = a null

ensuite pull 

git pull origin main

est récupérer les infos composer

composer install

va nous permettre de recréér le dossier var est vendor 

répéter la manip pour pull est pas besoins de reprendre le lien
git pull origin main 
puis taper
composer install 
 ## symfony serveur 

 - démarrer le serveur symfony :
 symfony server:start (ctrl + c pour quitter)

- démarrer le serveur en bckg
symfony server:start -d

 -arreter le serveur :
 symfony server:stop
``
## APACHE-PACK 

-- suite d'outils pour Apache (barre de débug en bas du nav/ routing / .htaccess)
-- dans le terminal: 
composer require symfony/apache-pack puis valider

va rajouter un fichier httc dans public 

autorise les interventions de la communauté


## effacer ou retirer symfony/webpack-encore-bundle

dans le terminal taper

remove composer symfony/webpack-encore-bundle

supprimer le dossier asset et les deux fichiers dockers qui ne sont pas utile 
``
## Controller 
dans la console taper cette commande
php bin/console make:controller Home
 elle crééer deux fichier dans src est dans templates

- générer un crud: 
php bin/console make:crud

## Base de données 

.env: 
remplir le database url 

NE PAS OUBLIER DE COPIER L'INTÉRIEUR DU FICHIER LE SUPPRIMER  LE PUSH AJOUTER /.env dans le fichier GITIGNORE RECREATION DU FICHIER .ENV EST COLLER LE TEXTE PUIS PUSH SUR GITHUB

crééer la base de données : 

php bin/console doctrine:database:create 

créer une entité (table): 

php bin/console make:entity nom de l'entité de la table la remplir


php bin/console make:migration

migration envoi des data vers la bdd

php bin/console make:migration genere le file ne pas utiliser constament ou copy le même fichier uniquement si on touche au entiy UNIQUEMENT création ou modif 

php bin/console doctrine:migration:migrate
php bin/console d:m:m

php bin/console cache:clear

pour effacer la bdd 
 php bin/console doctrine:datbase:drop --force 
 ou 
 php bin/console d:d:d --force 
``


## FIXTURES genére des données pour pouvoir travailler dessus par pour écrire dedans blog 

- installer le bundle : a installer que dans l'environement de dev
composer require --dev orm-fixtures

--conmpléter le fichier srv/dataFixtures/AppFixtures.php
persist()
flush()
--envoyer en bdd (en écrasant) : créer une bdd fictif si tu repush la commande il efface l'ancienne bdd 
php bin/console doctrine:fixtures:load
php bin/console d:f:l

--envoyer en bdd (en ajoutant à la suite) : ajoute sans écraser
php bin/console doctrine:fixtures:load --append

--bundle pour générer de fausses data : 
composer require fakerphp/faker
``

## Router

-voir toute les tourtes : 
```
php bin/console debug:router

- vérifier su une route existe (et obtenir )
```

## FORMULAIRE 
--créer le formulaire:

php bin/console make:form (nom à préciser ici)

générer Crud 
 php bin/console make:crud Comment


Mettre en place projet symfony est créer une entité
niveau graphique comme ont le souhaite
faire portfolio en onepage mise en place projet symfony 
section projet en bdd 
les compétences 
a propos 
le tout en bdd 3 table 
une projet a propos compétences 
user fixtures plus table 

reproduire son portfolio

pour créer entity User 
1er
php bin/console make:user 

certaine info sont nécessaire
yes 
valider par défault pas de connection avec deux email id identique 
hash le pswd yes par défault id email roles est password puis rajouter retaper la cmd
php bin/console make:user est ajouter les autres données

1er
user 

cat


relation manytoOne

## Register 

- créer l'entité User : 
```
php bin/console make:User 
- ajouter des champs à l'entité user

php bin/console make:entiy User

vérification par mail envoyer a l'user li bien les étape à faire rien de fou reste concentrer
composer require symfonycasts/verify-email-bundle


 Next:
 1) Install some missing packages:
      composer require symfonycasts/verify-email-bundle installer (désintaller si il y'a problemes puis rinstaller)
 2) In RegistrationController::verifyUserEmail():
    * Customize the last redirectToRoute() after a successful email verification.
    * Make sure you're rendering success flash messages or change the $this->addFlash() line.
 3) Review and customize the form, controller, and templates as needed.
 4) Run "php bin/console make:migration" to generate a migration for the newly added User::isVerified property.

 ## Email (SUPER IMPORTANT MATE REPLAY VERS 1215)

 -Installer le mailer :
composer require sumfony/mailer

- Installer le package tiers: 
 composer require symfony/google-mailer

 dans les param_tres du compt google 


à conserver est à récupérer dans le google compte->sécurité validation en deux étape a valider si pas fais puis mot de passe des applications récupérer ce code
aebuiwwzwddpqfzl 
le mettre dans le .env ex: MAILER_DSN=gmail://manga.samadjine@3wa.io:aebuiwwzwddpqfzl@default


installer Rollerworks:

composer require rollerworks/password-strength-bundle

dans le formulaire :

use Rollerworks\...\PasswordStrength

new PasswordStrength

- y' ajouter les constraites souhaitées
```
## Login

php bin/console make:auth
a rentrer dans le terminal à la suite des quatres questions 
1
LoginFormAuthenticator
SecurityController
yes
pour se déconnecter :
``` 
<a href="{{ path('app_logout')}}></a>
``` 

## Sécuirté droits acces hiérarchie

- dans config/packages/security.yaml, décommenter :ne pas oublier de changer le statut dans phpmyadmin en "ROLE_SUPER_ADMIN"
```
 - { path: ^/admin, roles: ROLE_ADMIN }
```
   role_hierarchy: 
        ROLE_SUPER_ADMIN: ROLE_USER
        ROLE_SUPER_ADMIN: ROLE_ADMIN
```
- afficher du code selon un rôle : a modifier dans le baseAdmin.twig.html pour l'afficher selon le rôle user 
```
{% if is_granted('ROLE_SUPER_ADMIN') %}
						<li class="py-2">
							<a href=" {{path('comment_admin_index')}} " title="Commentaire">
								<i class="fas fa-comment"></i>
							</a>
						</li>
						{% endif %}
```

password user :
QVGhtUr3FuZTDfn

## Formulaire de contact 
-creer le formulaire de contact
- crer le controller associé
- afficher le formulaire dans une vue (template)