# sf_lp2018
![](https://symfony.com/images/v5/opengraph/symfony.png)

TP Symfony Licence MIM 2018

_moshi_
_moshi@moshi.fr_

   * [Introduction](#introduction)
      * [Présentation](#présentation)
      * [Prérequis](#prérequis)
      * [Objectif de ce cours](#objectif-de-ce-cours)
      * [Installation](#installation)
   * [Autour de Symfony](#autour-de-symfony)
      * [Composer](#composer)
      * [MVC](#mvc)
      * [Entité](#entité)
      * [ORM](#orm)
      * [Repository](#repository)
      * [YAML](#yaml)
      * [Annotation](#annotation)
      * [Route](#route)
      * [Bundle](#bundle)
      * [Environnement](#environnement)
      * [Profiler](#profiler)
      * [Arborescence](#arborescence)
      * [Lancement de l'application](#lancement-de-lapplication)
      * [Exo 1](#exo-1)
   * [Routes &amp; Controller](#routes--controller)
      * [Configs](#configs)
      * [Annotations](#annotations)
      * [Variables de routes](#variables-de-routes)
      * [Génération d'url](#génération-durl)
      * [Controller &amp; Action](#controller--action)
      * [Response](#response)
      * [Exo 2](#exo-2)
   * [Vues (TWIG)](#vues-twig)
      * [Affichage](#affichage)
      * [Logique](#logique)
      * [Héritage](#héritage)
      * [Exos 3](#exos-3)
   * [ORM - Entités - modèles](#orm---entités---modèles)
      * [Introduction](#introduction-1)
      * [Mise en application](#mise-en-application)
      * [Annotations](#annotations-1)
      * [Modifications de champs et lien base de données](#modifications-de-champs-et-lien-base-de-données)
      * [ORM](#orm-1)
      * [Recherche d'entité](#recherche-dentité)
      * [Exo 4](#exo-4)
      * [Relations](#relations)
      * [OneToMany (1..n) - ManyToOne (n..1)](#onetomany-1n---manytoone-n1)
      * [OneToOne  1..1](#onetoone--11)
      * [ManyToMany (n..n)](#manytomany-nn)
      * [Exo 5](#exo-5)
   * [FORM](#form)
      * [Introduction](#introduction-2)
      * [Création](#création)
      * [TWIG](#twig)
      * [Action / Request](#action--request)
      * [Validation](#validation)
      * [Exos 6](#exos-6)
      * [Génération de CRUD](#génération-de-crud)
      * [Exos 7](#exos-7)
      * [Exos 8](#exos-8)
   * [Security](#security)
      * [Authentification - Authorization](#authentification---authorization)
      * [Firewall](#firewall)
      * [Providers](#providers)
      * [Encoders](#encoders)
      * [Authorisation](#authorisation)
      * [Roles](#roles)
      * [Exo 9](#exo-9)
      * [Form_login](#form_login)
      * [Exo 10](#exo-10)
   * [TP](#tp)
      * [Présentation](#présentation-1)
      * [Notation](#notation)




Introduction
==========
Présentation
-----------------


**Nous allons parler essentiellement de Symfony 3.4 dans ce cours, version la plus stable et celle qui sera maintenue le plus longtemps avant la sortie de la version 4.4.**

Symfony est : 
* **Français !**
* un Framework PHP solide
* l'un des frameworks PHP les plus utilisés
* Grosse communauté active

![Frameworks PHP Connus](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/frameworks.jpeg?raw=true)

Symfony permet :
* un gain de temps (travail structuré)
* Open source
* Maintenabilité, flexibilité et interopérabilité
* travailler sur un framework mondialement reconnu

Symfony est malheureusement : 
* Lourd (structure et fichiers/répertoires)
* Long à prendre en main

Prérequis
-------------
* Serveur PHP 5.5.9 (version 3) ou PHP 7.1.3 (version 4)
* C'est tout.
* date.timezone doit être défini dans votre php.ini sinon risque d'erreur

Pour vérifier la compatibilité de votre serveur (une fois Symfony récupéré)
```bash
php bin/symfony_requirements 
```

Objectif de ce cours
---------------------------
L'objectif est de se familiariser avec le framework sans rentrer dans le développement poussé sur Symfony. Nous allons aborder le minimum pour une utilisation web basique (site vitrine, blog, recherche etc) via un cours suivi d'exos et d'un TP à rendre.

Installation
----------------

1. Installer composer : https://getcomposer.org/download/
2. Lancer projet : https://symfony.com/download 
```bash
composer create-project symfony/framework-standard-edition tp 3.4
```
3. Remplir les informations demandées (infos MySQL même si on peut s'en passer)
4. Tester les prérequis : 
```bash
cd tp
php bin/symfony_requirements 
 
```
5. Corriger les erreurs

Autour de Symfony
===============
Composer
--------------
Permet de gérer des dépendances PHP, on demande à composer de gérer que tel ou tel projet, via un fichier composer.json, a besoin d'un autre projet pour fonctionner, se charge de faire le maillage et de télécharger les librairies requises.

MVC
------
Modèle Vue Controller : Design pattern ou façon de structurer son développement.
Vous l'avez déjà utilisé dans pas mal de cours il est très répandu, dans le cas de Symfony :
* Le Modèle correspond aux Entités - Entity
* La vue correspond à la gestion de template TWIG par défaut 
* Controller correspond aux différents controllers qui vont vous permettre de faire le pont et les différents traitements complexes.

Entité 
-----
Une entité est une classe PHP faisant le lien avec une base de données, on y déclare les différentes propriétés accessibles ; Symfony utilise par défaut un outil de persistence de données : Doctrine.

ORM 
------
Système permettant de se libérer des requêtes pour la base de données. Il se charge de générer les requêtes à effectuer sur les Entités spécifiées.

Repository
--------------
Classe PHP qui fait le pont entre une entité et l'ORM, il permet notamment de structurer des requêtes complexes.

YAML
-------
Format de structuration de données très utilisé dans Symfony, mais on peut utiliser du JSON, XML ou des classes PHP, les fichiers de config par défaut sont en YAML.

Annotation
---------------
Commentaire PHP directement dans les classes utiles (controller, entité) interprété par Symfony pour générer des fichiers de config temporaires ; Nous utiliserons pour un soucis de simplification en majorité cette notation.

Route 
-------
Système permettant en gros de lier une URL à une méthode de controller ; Elle est gérée en priorité dans le fichier app/config/routing.yml, mais on le renseignera également en annotation dans les fichiers Controllers

Bundle 
-------
Sorte de modules Symfony qui peuvent contenir tout et n'importe quoi ; C'est la force de Symfony les modules peuvent fonctionner indépendemment et même sur d'autres structures PHP, autre framework etc.

Environnement 
------
Symfony propose par défaut 2 environnements : dev et prod qui permettent de donner des configs différentes en fonction de l'environnement de travail ; dev permet une utilisation sans cache avec des outils de dev comme le profiler ; prod lui permet d'utiliser le site sous cache et sans aucun message d'erreurs.
De plus on peut configurer les différentes environnements pour par exemple rediriger tous les mails vers toto@titi.com en dev et laisser le fonctionnement normal pour prod ; pratique pour les debugs.
Pour accéder à l'environnement dev : on passe par le point d'accès app_dev.php : 
http://localhost:8000/app_dev.php
http://localhost:8000/app.php est l'environnement prod.


Profiler
---------
Un outil très pratique pour debugger et voir la ligne de vie d'un appel.
Accessible qu'en environnement dev : 
http://localhost:8000/app_dev.php

![Profiler](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/profiler.jpeg?raw=true)
![Page Profiler](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/profiler2.jpeg?raw=true)

Il permet d'avoir toutes les informations propre à Symfony (requêtes BDD générées, routes, trace des méthodes utilisées, informations sur l'utilisateur courant ... et un historique des profilers), mais on peut également avoir des informations sur les mails envoyés, et on peut renvoyer des messages depuis le code PHP pour debuguer.

Arborescence
-----------------
![Arborescence](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/arborescence.jpeg?raw=true)
* /app : 
	* /config/ : Fichiers de configs principaux de l'application
	* /Resources/
		* /public/ : Fichiers js, css, images, fonts et autres fichiers accessibles en http
		* /views/ : Fichiers de template 
		 
* /src : Répertoire de développement et liste des bundles développé pour l'application
	* /AppBundle :  Bundle principal de l'application
	
* /web : Répertoire accessible en http (les autres ne sont pas visible via le navigateur)

Dans un Bundle on va retrouver 4 répertoires importants : 
* Controller : Controllers propres à ce bundle
* Entity : Modèles liés à ce bundle 
* Resources : Contient les vues et / ou d'autres fichiers accessibles en http propre à ce bundle (même arborescence que app/Resources)
* Form : Contient des classes permettant de gérer des formulaires.

Lancement de l'application 
-----
Soit vous disposez d'un serveur web et vous exposez le répertoire web :
http://localhost:8888/
Sinon Symfony embarque un serveur PHP via la commande : 
```bash
php bin/console server:run 
```
Et la console vous donnera l'url en local en général : http://localhost:8000

Exo 1
------
[Corrigé](https://github.com/moshifr/sf_lp2018/commit/e451f6c4e996ea7983b655dbafb407bcda5db3fd)

* Installer Symfony
* Check des requirements
* Vérifier que le site fonctionne
 ![Le site fonctionne](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/exo1.jpeg?raw=true)
* Tester les environnements dev et prod
* Changer le Hello World de Symfony par une page **"Bienvenue sur mon site"**
* Configurer symfony pour utiliser sqlite (https://symfony.com/doc/3.3/doctrine.html)

Routes & Controller
======
https://symfony.com/doc/3.4/routing.html

Une route permet de diriger une url (ou un pattern d'url) vers une méthode de controller appelée Action.

Par exemple l'url "/" renvoie vers :
_//app/src/AppBundle/Controller/DefautController.php :: indexAction_

Un fichier app/config/routing.yml permet de configurer les routings globales de l'appli et chaque bundle doit gérer ses routes indépendement.
Avec un autre fichier routing par exemple dans src/AppBundle/Resources/config/routing.yml.

Ou sous d'autres formats de fichiers : XML, JSON, Classe PHP et en annotation.

* Nous allons utiliser l'annotation dans notre cas, le plus simple à prendre en main.
![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/annotations_route.jpeg?raw=true)

Configs 
-----

* Une route peut être **constante** : /blog 

ou **dynamique** :  /blog/{slug}
Ici slug englobé de **{ }** devient une variable dynamique qui prend tous les caractères alphanumériques par exemple : 
/blog/42
/blog/lorem-ipsum
/blog/titi-32_tata
Ces 3 urls correspondent à la méthode ciblée par la route avec une variable slug différente.
Cette variable peut être récupérée par le controller.

![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/route2.jpeg?raw=true)

* Une route est au minimum un chemin (path) et un nom 
* Ces variables peut être mise par défaut grâce à "defaults"
* Ces variables peuvent être soumises à une validation de format via "requirements"

![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/route3.jpeg?raw=true)

* On peut également préfixer l'url avec le mot clé "prefix"
* Vous pouvez cumuler plusieurs routes pour une méthode Action


Annotations 
-------
http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html
Pour pouvoir utiliser une annotation il faut :
```
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
```
à ajouter après le namespace dans votre Controller, il devrait y être par défaut dans AppBundle:DefautController


Variables de routes
------
On définit une variable d'url via des accolades {ma_variable} : 
```
/**
* @Route("/page", defaults={"page": "nopage"}, name="blog_index")
* @Route("/page/{page}", name="blog_index")
*/
public function indexAction($page)
{
	echo $page;
} 
```
Ici on a deux routes pour la méthode indexAction avec une variable $page qui est à nopage si on accède à l'url /page.

On peut cumuler plusieurs variables :
```
/**
* @Route("/page/{page}/{subpage}", name="blog_index")
*/
public function indexAction($page, $subpage)
{
	echo $page.' '.$subpage;
} 
```

Génération d'url
-------
Pour générer une url en PHP on utilise : 
```
$this->generateurl('nom_de_la_route', $variables);
```

Ou sous TWIG on a deux fonctions : 
```
{{ path('nom_route', {'page': 'toto', 'vars2': 'titi'} ) }}

{{ url('nom_route', {'page': 'toto', 'vars2': 'titi'} ) }}
```

Controller & Action
-----
Les routes redirigent vers une méthode de Controller ; un controller Symfony se nomme de la sorte :
NomDuController où le suffix Controller est obligatoire et le nom du fichier et de la classe est en **CamelCase**.

Les différentes méthodes se nomment de la sorte : 

**nomDeLaMethodeAction** est lui en **miniCamelCase**


Response
------
Une Action renvoie toujours un type Response ; il existe plusieurs type de Response :
JsonResponse, RedirectResponse, HttpResponse, BinaryFileResponse etc ...

La plus utilisée est Response pour l'utiliser on va use : 
```
use Symfony\Component\HttpFoundation\Response; 
```

et dans la méthode action on : 
```
public function indexAction(){
	return new Response('Ma response');
}
```
Affiche à l'écran Ma response.

Une méthode render() permet aux Actions de récupérer une vue et d'afficher le contenu de la vue compilée avec les différentes variables envoyées.

![Annotations](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/route4.jpeg?raw=true)

Ici on va récupérer la template présente dans app/Resources/views/default/index.html.twig pour affecter la variable base_uri.

* Pour récupérer une template dans votre Bundle le chemin du fichier twig sera : 
http://symfony.com/doc/3.4/templating/namespaced_paths.html

Exo 2 
-------
[Corrigé](https://github.com/moshifr/sf_lp2018/commit/76853e53b85355ec276ef3efcb6d65a7057913e2)
* Créer 2 nouvelles pages :
	* http://localhost/time/now : afficher la date l'heure  minute et seconde
	* http://localhost/color/blue : affiche "blue" à l'écran dynamiquement
	* http://localhost/color/red : affiche "red" à l'écran dynamiquement
	* Ajouter un menu avec des liens vers les 2 pages créées.

Vues (TWIG)
=====
http://twig.sensiolabs.org/

Twig est un moteur de rendu de template comme Smarty, mais a des rapports très proches avec Symfony, Sensio a contribué énormément à son développement.
Un moteur de template permet de limiter les logiques complexes pour réaliser des templates simples à coder.
La syntaxe commence toujours avec {} des accolades

Affichage 
------
* ```{{ ma_variable }}``` Pour affiche du texte ou un contenu 
* ```{# commentaire #}```
* ```~ : concatenation ```
	* ```{{ 'toto' ~ 'titi' }}```

Logique 
--------
* ```{% %}``` permet d'utiliser des logiques tels que :
	* ```{% if %} {% else %} {%endif %} ``` : condition
	* ```{% for item in items %}{%endfor} ``` : foreach
	* ```{% set foo='foo' %}```  : set des variables
	
Héritage 
------
Twig permet l'héritage de template via un extends dans les templates enfants :
```
{% extends 'base.html.twig' %}
```

Dans les templates mère on définit des "block" que l'on vient surcharger dans les templates enfants :
```
{% block body %}
toto
{% endblock %}
```

On peut également reprendre le block parent via 
```
{{ parent() }}
```

On crée donc des templates mère assez flexibles pour pouvoir en hériter et surcharger les différents blocks

Exos 3 
------
[Corrigé](https://github.com/moshifr/sf_lp2018/commit/879713a4c63242b43d020d704f9f14bf9a036215)
* Utiliser l'héritage pour mettre le menu dans un seul fichier mais visible sur les 2 pages.
* Intégrer bootstrap (CDN)
* Pour la page /color  afficher le mot de la même couleur dynamiquement ("bleu" en bleu) (en CSS)
* Pour la couleur rouge afficher en plus le Message : "Attention risque de virus" en rouge
* Dans le menu rajouter un lien vers les pages couleurs : red, blue, yellow, pink, violet, salmon en utilisant un foreach
* Mettre en souligné l'url active

ORM - Entités - modèles
=====
Introduction
---------
Un ORM (Object Relation Mapper) permet de gérer manipuler et de récupérer des tables de données de la même façon qu'un objet quelconque, donc en gardant le langage PHP. Plus besoin de requête MySQL, PostgresSQL ou autre.

Symfony utilise Doctrine comme ORM dans son système par défaut. Nous allons utiliser Doctrine mais vous pouvez utiliser d'autres systèmes si vous le souhaitez. 
Doctrine peut-être géré de plusieurs façon : XML, JSON, YAML, PHP et en Annotation nous allons utiliser ce dernier format de données.

Une entité est une des classes PHP utilisées par l'ORM qui se défini via des propriétés PHP (ici en annotation) :
![Entité](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/entity1.jpeg?raw=true)

Un repository permet la génération de requêtes simples ou complexes et dont le développeur peut modifier à volonté.

Mise en application
----------
Pour créer une entité il faut saisir la commande dans le terminal : 
```
php bin/console generate:doctrine:entity
```	

La console vous demandera plusieurs informations comme le nom du bundle dans lequel créer l'entité, le nom de l'entité par exemple : 
MIMBundle:Post (pour le bundle MIMBundle et le nom d'entité Post )
Et ensuite les différents champs souhaités dans votre entité / table de façon répétitive.
Pour finir la saisie et pour réaliser la création du fichier saisissez la touche entrée une dernière fois quand on vous demande le nom du champs

![Entité](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/entity2.jpeg?raw=true)

Le fichier sera créé dans src/MIMBundle/Entity/Post.php
Un fichier Repository est également créé dans src/MIMBundle/Repository/PostRepository.php

Annotations
--------
Notez le use Doctrine\ORM\Mapping as ORM; tout en haut d'en classe entity qui permet l'utilisation des annotations.
Ces annotations commencent toujours par @ORM par exemple @ORM\Column(type ...) permet de définir le champs suivant et le type de ce dernier.
@ORM\OneToMany , ManyToOne, OneToOne et ManyToMany se rapportent à des relations entre entités nous y reviendrons.

Modifications de champs et lien base de données
-----

Pour rajouter des champs il faut créer la propriété avec son annotation et ensuite créer ou générer les getters setters : 
```
    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
private $link;
```	
```
php bin/console doctrine:generate:entities MIMBundle:Post
```

A ce moment la base de données physique n'existe pas ou n'est pas mise à jour nous avons seulement créé son image PHP, pour créer la table ou modifier le schéma de table il faut saisir cette commande : 
```	
php bin/console doctrine:schema:update --force # permet de mettre à jour la base de données
# ou
php bin/console doctrine:schema:update --dump-sql # permet d'afficher les requêtes qui vont être mises en place pour mettre à jour la base de données
```	

ORM
----
Une fois la base de données mise en place on va pouvoir insérer modifier supprimer et récupérer des informations de la base de données sans saisir de requêtes via des méthodes en initialisant l'entité fraichement créée : 

```	
// src/AppBundle/Controller/DefaultController.php

/**
 * @Route("/est", name="test")
 */
public function testAction()
{
	$post = new Post(); // initialise l'entité
	$post->setTitle('Mon titre'); // on set les différents champs
	$post->setEnable(true);
	$post->setDateCreated(new \Datetime);

	$em = $this->getDoctrine()->getManager(); // on récupère le gestionnaire d'entité
	$em->persist( $post ); // on déclare une modification de type persist et la génération des différents liens entre entité
	$em->flush(); // on effectue les différentes modifications sur la base de données 
	// réelle

	return new Response('Sauvegarde OK sur : ' . $post->getId() );
}

```	
Il existe à la place de $em->persist  $em->remove($post); qui permettra de faire une suppression.
 
Ce dernier code effectue une création dans la base de données; pour une modification il suffit de modifier l'instantiation de l'entité de la sorte : 
```	
// src/AppBundle/Controller/DefaultController.php

/**
 * @Route("/est", name="test")
 */
public function testAction()
{
	$post = $this->getDoctrine()->getRepository('MIMBundle:Post')->find( 1 ); // récupération du post avec id 1 
	$post->setTitle('Mon titre'); // on set les différents champs
	$post->setEnable(true);
	$post->setDateCreated(new \Datetime);

	$em = $this->getDoctrine()->getManager(); // on récupère le gestionnaire d'entité
	$em->persist( $post ); // on déclare une modification de type persist et la génération des différents liens entre entité
	$em->flush(); // on effectue les différentes modifications sur la base de données 
	// réelle

	return new Response('Sauvegarde OK sur : ' . $post->getId() );
}

```	
ici on récupère le repository de Post et on récupère l'id 1 ; tout le restant du code reste inchangé.

Recherche d'entité 
------
Pour une recherche d'entité on peut utiliser plusieurs méthodes de repository préfète :
- $->find( $id ); // on récupère qu'un seul élément de l'entité avec l'id $id;
- $->findAll();  // on récupère toutes les entrées de l'entité concernée
- $->findBy( $where, $order, $limit, $offset ); // on recherche avec le tableau $where on tri avec le tableau $order on récupère $limit éléments à partir de l'élément $offset.
- $->findOneBy($where,$order); // on récupère le premier élément respectant le tableau $where et trié avec le tableau $order;
- $->findByX($search) ; requêtes magiques où X correspond à n'importe quel champs défini dans votre entité 
- $->findOneByX($search) ;  requêtes magiques  où X correspond à n'importe quel champs défini dans votre entité 

Par exemple findBySlug( 'home' ); ou findByTitle('Bonjour);
génèrera des requêtes de recherche automatiquement.
Pour les requêtes avec plusieurs éléments il faudra faire une itération (foreach) ou lister les différents éléments.
```	
// Modifications multiples : 
// src/AppBundle/Controller/DefaultController.php
/**
 * @Route("/est", name="test")
 */
public function testAction()
{
	$posts = $this->getDoctrine()->getRepository('MIMBundle:Post')->findAll(); // récupération de tous les posts
	$em = $this->getDoctrine()->getManager(); // on récupère le gestionnaire d'entité
	
	foreach($posts as $post)
	{
		$post->setTitle('Mon titre' . $post->getId() ); // on set les différents champs
		$em->persist( $post ); // on déclare une modification de type persist et la
		// génération des différents liens entre entité 
	}

	$em->flush(); // on effectue les différentes modifications sur la base de données 
	// réelle

	return new Response('Sauvegarde OK ');
}
```

Vous pouvez également générer vos requêtes manuellement pour avoir une requête complexe et précise directement dans le controller mais idéalement il faudrait le placer dans le repository dédié.
```	
// src/AppBundle/Repository/Post.php

public function maRequete( $where )
{
	// avec querybuilder
    $queryBuilder = $this->createQueryBuilder("p");

    $queryBuilder->where(' p.title like :w');
    $queryBuilder->setParameter(':w', '%'.$where.'%');
    $query = $queryBuilder->getQuery(); // on récupère la requêtes 

   	return $query->getResult(); // on renvoie le résultat
}
 public function maRequeteSQL( $where )
    {
        // avec requête SQL
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT p from AppBundle:Post p 
    WHERE p.title like :w');

        $query->setParameter(':w', '%'.$where.'%');


        return $query->getResult(); // on renvoie le résultat
```	
```	
// src/AppBundle/Controller/DefautController
$this->getDoctrine()->getRepository('MIMBundle:Post')->maRequete('test');
```	

Exo 4
------

[Corrigé](https://github.com/moshifr/sf_lp2018/commit/02591baea321c8f2db66ff5cb9adba48a4142316)

Créer une entité "Post" avec :
- title string 255 
- dateCreated datetime
- content text
- enable boolean

Créer une entité "PostCategory" avec : 
- title string 255

Créer une page qui va sauvegarder une catégorie  avec le nom "Catégorie 1"
Créer une page qui va sauvegarder un post avec le nom Post 1 à la date courante avec comme contenu Lorem ipsum et en enable à true.
Créer une page qui va afficher le titre de la catégorie en id 1 et le post en id 1.

Créer un nouveau post identique au premier en changeant le titre.
Créer une page qui affiche la totalité des entités Post.
Créer une page qui récupère le Post avec le Titre "Post 1"

Relations
------
Plusieurs types de relation existent entre des entités ou tables : 
- OneToMany (et son inverse ManyToOne)
- ManyToMany 
- OneToMany

De plus on notera aussi deux notions : propriétaire et inverse ; Une relation entre deux entités a toujours un propriétaire et un inverse.

Propriétaire : L'entité dite propriétaire contient la référence à l'autre entité et est gérée par défaut par Doctrine ; Aucune recherche particulière n'est à faire pour récupérer la relation propriétaire. (Commentaire vers Article, commentaire contiendra la relation vers article avec un champs article_id par exemple et on pourra récupérer la relation de la sorte : $com->article_id->title )
L'inverse est la relation inverse il faudrait faire une recherche un peu plus complexe pour récupérer les relations (Article vers Commentaires avec un where par exemple).

Une relation peut être unidirectionnelle ou bidirectionnelle ; Nous utiliserons que la relation unidirectionnelle  dans ce cours. 
Les relations bidirectionnelles peuvent être gérées automatiquement par Symfony modifiant un peu les entités inverses avec inversedBy et mappedBy.

OneToMany (1..n) - ManyToOne (n..1)
-------

![OneToMany - ManyToOne](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/onetomany.png?raw=true)
La relation 1..n définit une dépendance multiple entre 2 entités de sorte que la première peut être liée à plusieurs entités :

- Equipe -> Joueur**s**
- Utilisateur -> Commande**s**
- Article -> Commentaire**s**

La notion de propriétaire est toujours du côté des Many. (Joueurs, Commandes, Commentaires)

![OneToMany - ManyToOne](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/onetomany_annotation.jpeg?raw=true)

La relation n..1 est majoritairement l'inverse de 1..n :
- Joueur**s** -> Equipe
- Commande**s** -> Utilisateur
- Commentaire**s** -> Article

La notion de propriétaire est toujours du côté des Many.

OneToOne  1..1
-----
La relation 1..1 est peu utilisée mais permet une flexibilité en terme relationnelle très importante. Elle définit une dépendance unique entre 2 entités : 
- Utilisateur -> Adresse
- Produit -> Image
- Commande -> Facture

![OneToOne](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/onetoone.png?raw=true)
La notion de propriétaire peut être choisit simplement.

```	

    /**
     * @ORM\OneToOne(targetEntity="Address")
     */
    private $address;
```

ManyToMany (n..n)
----
La relation ManyToMany définit une dépendance multiples entre 2 entités de sorte que plusieurs première entités peuvent être liée à plusieurs secondes entités : 
- Tag**s** -> Article**s**
- Role**s** -> Utilisateur**s**
- Projet**s** -> Employe**s**

La notion de propriétaire est toujours du côté des Many ; Il faudra donc choisir celle que l'on souhaite.

![ManyToMany](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/manytomany.jpeg?raw=true)

```	
    /**
     * 
     * @ORM\ManyToMany(targetEntity="User")
     */
    private $roles;
```	

Exo 5
------

[Corrigé](https://github.com/moshifr/sf_lp2018/commit/0041fcb9e993d81093f6623a4b625ff744ac1eae)

Créer la liaison entre Post et Catégorie.
Modifier la page de génération de Post pour créer un article "Post 3" avec la relation vers "Catégorie 1" ; 
==> La catégorie de Post 3 sera Catégorie 1.
Modifier la page avec tous les posts pour afficher la catégorie liée à l'article.
Créer une page qui supprime "Post 1"

En plus : Flash Messages [https://symfony.com/blog/new-in-symfony-3-3-improved-flash-messages ](https://symfony.com/doc/current/controller.html#flash-messages)
Essayer d'utiliser les flash messages
Modifier l'entité Post pour ajouter un champ : "excerpt" de type text 
Créer le getter et setter et mettez à jour la base de données.

FORM
=====
Introduction
-----
![Form](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/form1.jpeg?raw=true)
La gestion des formulaire se fait via plusieurs classes PHP qui permettent entre autre : 

- La structure et les propriétés du formulaire se gèrent via FormBuilder et peuvent être réutilisées;
- On peut créer des classes spécifiques pour chacun de nos formulaires
- Permet une gestion des validations simplifiée et une sécurité renforcée
- Permet d'hydrater une entité ou un objet rapidement
- Gestion de template simple

Création
-----

On peut créer un Form de 2 façons différentes  :
- Directement dans un controller 
- ![Form](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/form1.jpeg?raw=true)
- Ou via des classes dédiées de type FormType en général dans le répertoire Form du bundle
- ![Form](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/form2.jpeg?raw=true) 

On utilise la classe FormBuilder accessible avec la méthode 
```	
$entite = new Post;
// ou $entite = $this->getDoctrine()->getRepository('Post')->find(1);
$this->createFormBuilder( $entite ) 
```
dans un controller ; l'argument $entite est l'entité que vous souhaitez hydrater ; l'argument n'est pas obligatoire (pour un formulaire de recherche par exemple)

On peut mettre des champs de formulaire par défaut en modifiant l'entité avant de créer le formulaire et de lier le formulaire à l'entité :

Par exemple
```	
$entite = new Post;
// ou $entite = $this->getDoctrine()->getRepository('Post')->find(1);
$entite->setTitle('Mon titre forcé');
$this->createFormBuilder( $entite ) 
```
Préremplira le formulaire avec le titre forcé.

Ensuite nous aurons des suites de ->add('nom_du_champs', TypeDeChamps::class, $options);
Par défaut si vous ne mettez que le nom du champs Symfony se chargera de récupérer un type de champs en fonction du type de champs (string, text, boolean date)

Liste des champs possibles : https://symfony.com/doc/3.4/reference/forms/types.html

Dans une classe dédiée le createFormBuilder est déjà instantié il ne vous reste qu'à rajouter les différents add.

TWIG
----
Une fois le formulaire créé et initié il faut renvoyer le tout à TWIG via la méthode :
```	
$form->createView();
```	
Ensuite nous aurons plusieurs fonctions twig utiles :
- ```{{ form }}``` permet d'afficher tout le formulaire 
- ```{{ form_start  }}``` permet de générer la balise ```<form>``` avec les différents attributs
- ```{{ form_end }}``` permet de générer la fermeture de ```<form>``` avec les différents champs restants non affichés
- ```{{ form_errors }}``` affiche les erreurs éventuelles du formulaire
- ```{{ form_widget(mon formulaire.nomduchamps) }} ```affiche le type de champs 
- ```{{  form_label(mon formulaire.nomduchamps) }}``` affiche le label du champs
- ```{{ form_row(monformulaire.nomduchamps) }}``` affiche le form_widget et form_label
- ```{{ form_rest }}``` affiche les champs restants non récupéré précédemment (token de vérification par exemple)

Action / Request
--------
Une fois le formulaire créé et affiche via TWIG il faut rajouter un comportement qui va gérer la soumission du formulaire grâce à ces méthodes : 
- handleRequest($request) permet d'associer les valeurs input à la classe Form précédemment créé
- isSubmitted() permet de savoir si le formulaire a été envoyé 
- isValid()  permet de savoir si les données saisies sont valides 

Dans la majorité des cas on va tester si :
```
public function newAction(Request $request){
  //... génération ou récupération du formulaire
  $form->handleRequest($request); // hydratation du form 
  if($form->isSubmitted() && $form->isValid()){ // test si le formulaire a été soumis et s'il est valide
	$em = $this->getDoctrine()->getManager(); // on récupère la gestion des entités
	$em->persist($post); // on effectue les mise à jours internes
	$em->flush(); // on effectue la mise à jour vers la base de données
	return $this->redirectToRoute('show_post', ['id' => $post->getId()]); // on redirige vers la route show_post avec l'id du post créé ou modifié 
  }
}
```	

![Form](https://github.com/moshifr/sf_lp2018/blob/master/images_cours/form3.jpeg?raw=true) 


Validation
-----

Les validations permettent de gérer des contraintes au niveau du formulaire ; Par exemple pour pourra forcer en PHP que le champs email soit bien un email ou que tel champs ne peut pas dépasser tel nombre de caractères, vous trouverez la liste des contraintes basiques sur site site de symfony : 
http://symfony.com/doc/3.4/validation.html
Ces contraintes ou assert peuvent être gérée de plusieurs façon XML, JSON, YAML, PHP ou en annotation dans notre cas; il faudra utiliser cette ligne tout en haut du controller : 
```	
use Symfony\Component\Validator\Constraints as Assert;
```	
Pour ensuite pouvoir utiliser l'annotation : 
```	
class Author
{
    /**
     * @Assert\NotBlank()
     */
    public $name;
}
```	
Ici on vérifiera que le champs name doit être rempli.

Exos 6 
------

[Corrigé](https://github.com/moshifr/sf_lp2018/tree/7fca30f4a9f1b122b24c5c52176589049313c814)
- Créer un formulaire directement dans DefaultController qui gèrera la création des Post
- Créer un formulaire directement dans DefaultController qui gèrera la modification des Post
- Modifier la page de listing des postes pour rajouter un lien edition et suppression
- Mettre en place les différentes routes pour le backoffice de Post (ajout / modification / suppression / visualisation)
- Déporter le formulaire de gestion de Post vers une classe dédiée Form/PostType.php
- Modifier DefaultController pour utiliser PostType
- Ajouter une validation au formulaire sur le titre qui ne doit pas dépasser 255 caractères
- Rechercher pour mettre en place le template bootstrap pour les Form
- Afficher le message d'erreur en rouge.

Génération de CRUD
-----
Ce que nous venons de faire manuellement peut être généré en ligne de commande par Symfony **:')**
via la commande : 
```	
php bin/console doctrine:generate:crud 
```	
On vous demandera le nom de l'entité précédé du nom de bundle,  le chemin pour ce crud et si vous souhaitez avoir les fonction d'édition (ajout/ modification) mettez oui.

On peut également générer seulement les FormType : 
```	
php bin/console doctrine:generate:form 
```	
Attention si vous modifier une entité les FormType ne sont pas générés automatiquement il faudra rajouter manuellement le champs fraichement créé.

Exos 7 
-----
- Générer le CRUD de Post avec l'url /admin/post
- Générer le CRUD de PostCategory avec l'url /admin/postcategory
- Tester le fonctionnement 
- Mettre les liens dans le menu pour aller sur le listing post et listing postcategory ; mettre en actif si url courante
- Ajouter un champs image à Post ; ce champs sera un champs d'upload 
- [Corrigé](https://github.com/moshifr/sf_lp2018/commit/6d0e58c6fe0ae0782d3f12bbb815baf2c2811ee2)
- Mettre en place l'upload Tips : utiliser [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle) ou manuellement [FileUpload](https://symfony.com/doc/3.4/controller/upload_file.html)
- Tester [EasyAdminBundle](https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html)


Exos 8 
----
- On va créer une page de recherche 
- Modifier le repository de Post pour créer une method search( $word )
qui recherchera dans le titre et le contenu le mot $word 
Tips : https://symfony.com/doc/3.4/doctrine.html#querying-for-objects
- Créer une nouvelle page dans le Controller /search/{word}
- Créer le formulaire directement dans le controller sans le lier à une entité 
- A la soumission on va récupérer $form->getData() qui sera notre $_POST
- Pour récupérer la variable $word et utiliser la méthode du repository fraichement créée.
- Pour finalement afficher tout le contenu dans une page de listing.
[Corrigé](https://github.com/moshifr/sf_lp2018/commit/870a1d51b5305350b3401ebb348453c0c546d327)

Security 
========

Authentification - Authorization
-----
Deux notions majeures interviennent dans la conception de sécurité de Symfony : 
 - **Authentification** : Qui êtes vous ? ; vous pouvez vous authentifier de plusieurs manières (HTTP authentification, certificat, formulaire de login, API, OAuth etc)
 - **Authorization** : Avez vous accès à ? ; permet d'autoriser de faire telle ou telle action ou accéder à telle page sans forcément savoir qui vous êtes, utilisateur anonyme par exemple.

De nouvelles notions vont intervenir la première est :

Firewall
--------
Un firewall est la porte d'entrée pour le système d'authentification, on définit différents firewall (au minimum 1 seul) qui va permettre de mettre en place le bon système de connexion pour l'url spécifiée via un pattern.

///  app/config/security.yml
```
security:
    firewalls:
        # désactive l'authentification pour les assets et le profiler
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        # HTTP basic (prompt du navigateur)    : https://symfony.com/doc/current/security.html#a-configuring-how-your-users-will-authenticate 
        http_basic:
            pattern: ^/ # pour toutes les urls 
            anonymous: ~ # si le client n'est pas encore connecté
            http_basic: ~ # on utilise la connexion via HTTP  basic
        # autre méthode de login :  https://symfony.com/doc/current/security/form_login_setup.html    
        # formulaire_login:
        #    form_login:
        #      login_path: login #  route du formulaire 
        #      check_path: login # route du check si le client est connecté
        main:
            anonymous: ~
```

Providers
------
Un provider permet au firewall d'interroger une collection d'utilisateurs/mot de passe ; C'est une sorte de base de tous les utilisateurs avec les mots de passe.
Il existe deux type par défaut : 
- in memory : directement dans le fichier security.yml mais du coup les hash des mots de passes sont disponible dans un fichier accessible

```
security:
    # https://symfony.com/doc/current/security.html#b-configuring-how-users-are-loaded
    providers:
        in_memory:
            memory:
              users:
                toto: {password: toto, roles: 'ROLE_USER'}
                admin: {password: adminpass, roles: 'ROLE_ADMIN'}
```

- Entity : N'importe quelle entité qui implémente à minima Symfony\Component\Security\Core\User\UserInterface

Plusieurs providers peuvent fonctionner en même temps par exemple in_memory et entity voire plusieurs entités simultanément.
http://symfony.com/doc/current/security/entity_provider.html


Encoders
-------
Un encoder permet de générer des hashs/d'encoder des mots de passe ; le plus connu étant MD5 mais vous pouvez utiliser d'autres encoders tels que : sha1, bcrypt ou plaintext (qui n'encode rien c'est le mot de passe en clair)
http://symfony.com/doc/current/security/named_encoders.html

Authorisation 
------
L'autorisation peut être géré de plusieurs façons :
- Directement depuis les controllers
```
public function hello($name)
{
    // The second parameter is used to specify on what object the role is tested.
    $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

    // ...
}
```
via une condition : 
```
$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')
```
via des annotations : 
```
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
 public function hello($name)
```


- Depuis les templates 
```
{% if is_granted('ROLE_ADMIN') %} {% endif %}
```

- Depuis le fichier security.yml : les access controls permettent de sécuriser un pattern d'url 
```
security:
    # ...
    access_control:
        - { path: ^/admin, roles: ROLE_USER_IP, ip: 127.0.0.1 }
        - { path: ^/admin, roles: ROLE_USER_HOST, host: symfony\.com$ }
        - { path: ^/admin, roles: ROLE_USER_METHOD, methods: [POST, PUT] }
        - { path: ^/admin, roles: ROLE_ADMIN }
```

http://symfony.com/doc/current/security/access_control.html


Roles
-----
Les roles permettent à symfony  de tagger des utilisateurs sur ce qu'ils peuvent ou non accéder. Ces roles peuvent être hiérarchisés :
```
security:
    # ...

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: [ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH]
```
https://symfony.com/doc/current/security.html#roles


Exo 9 
------

[Corrigé](https://github.com/moshifr/sf_lp2018/commit/870a1d51b5305350b3401ebb348453c0c546d327)

Nous allons débuter par la partie authentification en créant un formulaire de login qui va permettre de se connecter 
et pour les identifiants nous allons utiliser in_memory.

Tester le bon fonctionnement de l'access_controls sur toutes les pages admin 
https://symfony.com/doc/3.4/security.html


Form_login
-----

Nous n'allons pas développer la partie form_login ici mais si vous voulez aller plus loin vous pouvez utiliser ces liens : 

- [Entity provider](https://symfony.com/doc/3.4/security/entity_provider.html)
- [Formulaire d'inscription](http://symfony.com/doc/3.4/doctrine/registration_form.html)
- [Login form](http://symfony.com/doc/3.4/doctrine/registration_form.html)

Comme vous le voyez il faut paramétrer un tas de choses pour que ce soit fonctionnel mais vous aurez la main sur tout le processus de security.

Exo 10
-----
Mais si vous voulez laisser un bundle tier s'occuper de tout ce processus il y a [FOSUserBundle](http://symfony.com/doc/current/bundles/FOSUserBundle/index.html) qui est le plus répandu.

Il est très complet mais forcément moins de flexibilité que si vous gérez tout le process de security.

Nous allons mettre en place un nouveau bundle : [FOSUserBundle](http://symfony.com/doc/current/bundles/FOSUserBundle/index.html).

Overridez également le formulaire de login qui n'est pas au mieux niveau design.

Vous voilà avec un beau backoffice sécurisé. [Corrigé](https://github.com/moshifr/sf_lp2018/tree/12fbea574af3cbde45c9a9c006684b92b302f1d6)

On va enfin pouvoir se mettre réellement au TP : 
 
 
TP
======

Présentation
-------
Nombre de TP : 5

Date de rendu maximum : Tout le Lundi 21/05  

Dépot par mail sur moshi@moshi.fr les répertoires app/ src/ et web/ si vous y avez touché (les zip passent pas sur mon gmail apparement, vous pouvez m'envoyer l'url du projet ou un wetransfer)

Critères de notations : Je noterais le code source (php et JS si besoin) seulement ; aucunement le design.

Vous devez réaliser un site vitrine pour le jeu "Tu préfères" : Deux choix s'offrent à vous cliquez pour choisir votre préféré.

Notation
-------

Ce site disposera de : 
- 5 pages 
    - Homepage avec :
        - **3** une section "Tu préfères" avec deux choix cliquables random (sans notion de catégories) au clic on comptabilise le vote et on renvoie vers la Homepage avec de nouveaux choix avec un message "Votre vote a bien été pris en compte"
        - **3** un panneau de login (si déjà loggé on affiche le pseudo et un bouton de déconnexion et ses 5 derniers votes)
        - **1** les 10 derniers votes de tout le monde
    - **1** Présentation : avec un texte lorem non dynamique
    - **3** Recherche : Recherche dans les news 
    - **3** News : page de news avec détails (avec slug dans l'url et non id) et bouton retour 
    - Tops par catégories
        - **3** Reprendre la liste des catégories et afficher le vainqueur de la catégorie.
        - **3** Au clic sur une catégorie on a accès (toujours avec un slug et non id) au top par catégorie : une section "Tu préfères" avec deux choix randoms mais de la catégorie sélectionnée.

Les urls devront être SEO friendly et sans GET parameters.

Le backoffice vous est fourni, vous pouvez utiliser tous les bundles que vous souhaitez tant que le site est fonctionnel.
 
Installation
---------

- Récupérer le zip ou le projet
- Se placer sur le répertoire TP
- composer.phar update 
- ou composer update

Pour mettre en place les assets : 
- bin/console asset:install --symlink

Pour lancer le serveur : 
- bin/console server:run 

- Accéder à locahost:8000/login
login : admin
Mot de passe : admin

   
 
 
