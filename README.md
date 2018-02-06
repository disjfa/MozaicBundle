# Mozaic bundle

Mozaic bundle, a puzzle for symfony projects using vue.

# Instalation

(optional) Install [glynn-admin-symfony4](https://github.com/disjfa/glynn-admin-symfony4)

## Add bundle

```
composer req disjfa/mozaic-bundle
```

## Add a config

Add a config file, `config/packages/disjfa_mozaic.yaml` for symfony, of add the parameters. See the api [unsplash api](https://unsplash.com/developers).

```yaml
parameters:
  disjfa_mozaic.unsplash.application_id: ''
  disjfa_mozaic.unsplash.secret: ''
```

## Routes

Add a route file `config/routes/disjfa_mozaic.yaml`, of append your route file.

```yaml
disjfa_mozaic:
    resource: '@DisjfaMozaicBundle/Controller/'
    type:     annotation
```

## Load vue component in your javascript.

```javascript
import Mozaic from './../../../vendor/disjfa/mozaic-bundle/Resources/public/mozaic';

new Vue({
  el: '#base',

  components: {
    Mozaic,
  }
});
```

## Build

And next, build and checkout the puzzle.

```
sf server:start
```

And go to your url `http://localhost:8000/mozaic/daily`

## Don't forget to have fun

Did i mention you are a lovely person, now enjoy! Have fun, play and finish a puzzle! Also, don't forget to tell me if you enjoy the puzzle.