# Mozaic bundle

Mozaic bundle, a puzzle for symfony projects using vue.

This bundle can be used by [glynn-admin-symfony4](https://github.com/disjfa/glynn-admin-symfony4).
This has a basic symfony setup, and adds a frontend using [webpack encore](https://symfony.com/doc/current/frontend.html).
In this frond end i have a basic setup using vuejs to manage the clients side setup. This bundle also uses vuejs. 
It can be used standalone, but if you need inspiration to set up a frontend you can check it there.  

## Index
* [Instalation](#instalation)
* [Add bundle](#add-bundle)
* [Configuration](#configuration)
* [Load vue component in your javascript](#load-vue-component-in-your-javascript)
* [Build](#build)
* [Don't forget to have fun](#dont-forget-to-have-fun)
* [Legacy](#legacy)

## Instalation

(optional) Install [glynn-admin-symfony4](https://github.com/disjfa/glynn-admin-symfony4)

## Add bundle

This bundle uses a [recipe](https://github.com/disjfa/recipes-contrib#symfony-recipes-contrib).
To enable recipes for this bundle you may need to enable in your symfony 3.4 / 4. application using:
```
composer config extra.symfony.allow-contrib true
```
Next, install the bundle
```
composer req disjfa/mozaic-bundle
```

## Configuration

Setup the `UNSPLASH_APPLICATION_ID` and `UNSPLASH_APPLICATION_SECRET` in your .env file.
See the api [unsplash api](https://unsplash.com/developers) on details how to get these.

## Load vue component in your javascript.

As said, this bundle uses vue to render the puzzle. You can check out [glynn-admin-symfony4](https://github.com/disjfa/glynn-admin-symfony4)
for an example on how to set things up using webpack encore and vue. Or you can just add this component to your own build.
For details on vue, check out the [documentation](https://vuejs.org/) and [components](https://vuejs.org/v2/guide/components.html). 

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

## Legacy

If you have a legacy symfony project (< 3.4), you can still add the bundle. You can setup the bundle using these configurations. 

Add the following to your `config.yml`
```yaml
parameters:
  disjfa_mozaic.unsplash.application_id: ''
  disjfa_mozaic.unsplash.secret: ''
```
And add the routes to the routes.yml
```yaml
disjfa_mozaic:
    resource: '@DisjfaMozaicBundle/Controller/'
    type:     annotation
```