# Vinyle4Life :musical_note: :cd:

Le projet : Vinyle4Life, un site pour les fans de vinyles crée par NAAMA Mohamed.

Le nom des classes est le suivant : Inventaire (pour l'inventaire), Objet (pour les vinyles), Galerie (pour les galeries) et Membre pour les utilisateurs (User pour les user).

Les noms d'utilisateurs sont :
L'admin : id : 'mohamed@localhost',
          mdp  'mohamed'

Les 2 autres users sont : id : 'imad@localhost' mdp :'imad', et id :chris@localhost'mdp : 'chris'

Le lien du gitlab : https://gitlab.com/naamamohamedcpge/vinyl4life

## Pour tester l'application localement, il faut  :

* Télécharger Docker 🐳

### Crée un docker-compose.yml et y coller ceci : 

```yaml
version: '3'

services:
###> doctrine/doctrine-bundle ###
  database:
    image: postgres:${POSTGRES_VERSION:-14}-alpine
    environment:
      POSTGRES_DB: ${POSTGRES_DB:-app}
      # You should definitely change the password in production
      POSTGRES_PASSWORD: ${POSTGRES_PASSWORD:-!ChangeMe!}
      POSTGRES_USER: ${POSTGRES_USER:-app}
    volumes:
      - db-data:/var/lib/postgresql/data:rw
      # You may use a bind-mounted host directory instead, so that it is harder to accidentally remove the volume and lose all your data!
      # - ./docker/db/data:/var/lib/postgresql/data:rw
###< doctrine/doctrine-bundle ###


  app:
    image: naama122/vinyle4life:tag1
    ports:
     -  "8080:80"

volumes:
###> doctrine/doctrine-bundle ###
  db-data:
###< doctrine/doctrine-bundle ###

    
```

### Executer le conteneur 

``` shell

docker-compose up -d

```

### Copiez ce lien sur votre navigateur et voilà !

* Go to http://localhost:8080

