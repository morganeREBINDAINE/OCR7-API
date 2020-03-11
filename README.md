# OCR - projet n°7 : API BileMo

Ce projet contient le code d'une API REST Symfony 4, utilisant API Platform, dans le cadre du parcours de développeur Symfony d'OpenClassroom.

URL du site: http://morgane-ocr.website

URL du github: https://github.com/morganeREBINDAINE/OCR7-API

### Installation
1. Clonez le repository sur votre local
2. Déplacez-vous dans le dossier généré
3. Editez le fichier .env
4. Lancez la commande composer install
5. Lancez la commande php bin/console d:f:l
6. Lancez la commande symfony server:run

### Documentation
La doc swagger est accessible à l'url http://morgane-ocr.website/api .
##### Connexion à l'API
L'API utilise le JWT comme mode d'authentification. Une fois le compte partenaire ajouté, un utilisateur obtient son token via cette requête :
POST /api/login_check:

        {
          "email": "*votreEmail*",
            "password": "*votreMotDePasse*"
        }


##### Interactions avec l'API
**!! Il faudra désormais joindre manuellement à chaque requête le token, via un header Authorization: Bearer <token> !!**

1. Ajout de partenaire
Un partenaire est ajouté dans la base de données, suite à un contact par mail préalable, par un administrateur.

2. Liste des clients
Chaque partenaire a la possibilité de voir la liste de ses clients.
GET /api/clients

3. Détails d'un client
GET /api/clients/{id}

4.  Ajout de client
Une fois connecté, le partenaire a la possibilité d'ajouter un compte client.
POST /api/clients

        {
            "firstName": "*prenom*",
            "lastName": "*nom*",
            "birthday": "2000-10-10",
            "address": "*adresse*",
            "postalCode": *codePostal*
        }


5. Suppression de client
DELETE /api/clients/{id}

6. Liste des mobiles
GET /api/mobiles

7. Détails d'un mobile
GET /api/mobiles/{id}