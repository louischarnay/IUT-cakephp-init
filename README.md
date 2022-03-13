#Application CakePHP
Ceci est une application de dépôt d'images.
Vous pouvez toutes les visionner sur la page 'index' ou n'en voir qu'une seule grâce à la page 'select'.
Il est aussi possible d'accéder à leurs données au format JSON sur la page 'view'
Un utilisateur connecté pourra aussi ajouter un commentaire visible par tous sous une image et déposer les siennes via la page 'add'

#Récupérer l'application sur un serveur

Ouvrir un terminal et rentrez les commandes suivantes :
```
git clone https://forge.univ-lyon1.fr/p2018172/projet-cakephp.git
composer install --no-dev
cd bin
cake migrations migrate
```

Créer une base de données locale et renseignez le nom / login / password dans fichier app_local.php

