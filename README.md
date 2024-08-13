# Blog Interactif

## Description

Ce projet est une plateforme de blog interactive développée en PHP suivant le modèle MVC (Modèle-Vue-Contrôleur). Les utilisateurs peuvent créer un compte, se connecter, publier des articles, ajouter des photos, commenter les publications, et gérer leur contenu. Le système inclut également une validation par e-mail, une réinitialisation de mot de passe, un captcha pour éviter le spam, et une gestion des rôles utilisateur (user, modérateur, admin).

## Fonctionnalités

- **Inscription et Connexion** : Les utilisateurs peuvent créer un compte, se connecter et gérer leur profil.
- **Validation du compte** : Les utilisateurs doivent valider leur compte via un lien envoyé par e-mail.
- **Réinitialisation du mot de passe** : Les utilisateurs peuvent réinitialiser leur mot de passe en recevant un lien par e-mail.
- **Captcha anti-spam** : Un système de captcha est intégré lors de l'inscription et de la connexion pour éviter le spam.
- **Publication d'articles** : Les utilisateurs peuvent rédiger et publier des articles, ajouter des photos et les organiser.
- **Commentaires** : Les utilisateurs peuvent commenter les publications des autres.
- **Gestion du contenu** : Les utilisateurs peuvent modifier ou supprimer leurs articles et commentaires.
- **Gestion des rôles** : Trois rôles sont disponibles :
  - **Utilisateur** : Peut publier des articles et commenter.
  - **Modérateur** : Peut gérer les commentaires et bannir les utilisateurs.
  - **Administrateur** : A tous les droits, y compris la gestion des utilisateurs et des rôles.
- **Modération** : Les modérateurs peuvent bannir les utilisateurs indésirables.

## Technologies utilisées

- **PHP (MVC)** : Pour la gestion de la logique métier et la structure du site.
- **MySQL** : Pour la base de données, gérant les utilisateurs, les articles, les commentaires, et les rôles.
- **HTML5** : Pour la structure des pages.
- **CSS3** : Pour le style et la mise en page.
- **JavaScript** : Pour les interactions dynamiques et les opérations C.R.U.D.
- **Fonction `mail()` de PHP** : Pour l'envoi des e-mails de validation et de réinitialisation de mot de passe.
- **reCAPTCHA** : Pour l'intégration du captcha anti-spam.

## Voir le projet

-> [ici](https://world-of-sapologie.com/)
