Bonjour,
​
Le site "e-stoires" a été créé dans le but de donner la possibilité aux écrivains amateurs d'écrire des histoires collaboratives.
Et de donner envie de lire ces histoires originales au plus grand nombre.
​
Voici les instructions nécessaires au fonctionnement du site.
​
Il est hébergé sur Github : https://github.com/WildCodeSchool/2023-02-php-paris-p2-story
​
Après avoir cloné le projet, lancer un composer install et de créer votre branche pour travavailler en local.
Très important : dans le dossier public, créer un dossier uploads (avec un s), qui permettra la gestion de la création d'images de couverture.
Celui-ci est dans le .gitignore pour information, et n'est donc pas clonable.
​
Voici comment les différentes pages du site sont organisées.
​
Les différentes redirections sont gérées par le fichiers src>routes.php et src>routing.php (ce dernier gérant entre autres les exceptions et erreurs de frappe de l'utilisateur dans la barre d'url).
 - homepage : 
 Elle affiche le manifeste qui présente le site et son objectif sur fonds d'image.
 En dessous se trouve la présentation des 3 fonctionnalités du site.
 La charte d'utilisateur du site est accessible en dessous.
 Les trois dernières publications sont affichées en bas de page.
 Les fichiers src>Controller>HommeController et src>View>Home>index.html.twig gèrent la homepage.
​
 - compte : 
 Nous avons créé une gestion d'utilisateur.
 En effet, il est obligatoire de se connecter avant de pouvoir créer du contenu sur le site. 
 Les fichiers src>Controller>UserController et src>Model>UserManager gèrent les données relatives aux utilisateurs (sécurisation et enregistrement).
 Cette page /login et accessible via la navbar, et on y est automatiquement redirigé si on souhaite créer du contenu sans être connecté.
​
 - création d'histoires : 
 Les éléments obligatoires sont le titre, le nom de plume (=pseudo), le nombre de chapitres total que l'histoire contiendra, le public visé (12-18 ans ou 18+), le genre.
 Les éléments facultatifs sont l'image de couverture (nous en fournissons une par défaut) et la description de l'histoire - celle-ci doit avoir une longueur minimale de 400 caractères.
Le formulaire de création d'histoires est géré par src>View>Story>_form.html.twig, et l'affichage du formulaire par src>View>Story>add.html.twig.
 Toutes ces données sont traitées et sécurisées par les fichiers src>Controller>AbstractController.php, src>Controller>StoryController.php et src>Model>StoryManager.
 La validation de l'acceptation des conditions d'utilisation du site est obligatoire avant de pouvoir créer une histoire.
​
 - création de chapitres : 
Les éléments obligatoires sont le titre, le nom de plume (=pseudo) qui est indispensable du fait de l'aspect collaboratif (un créateur de chapitre peut être différent du créateur de l'histoire), et le contenu du chapitre.
Les éléments relatifs à l'histoire sont résumés sur cette page.
​
Le formulaire de création d'histoires est géré par src>View>Chapter>_form.html.twig, et l'affichage du formulaire par rc>View>Chapter>add.html.twig.
Toutes ces données sont traitées et sécurisées par les fichiers src>Controller>AbstractController.php, src>Controller>ChapterController et src>Model>ChapterManager.php.
La validation de l'acceptation des conditions d'utilisation du site est également obligatoire pour créer un chapitre.
​​
 - contribution à une histoire : 
Les histoires non terminées (=dont il reste encore à écrire des chapitres) sont accessibles via la page /cooperate.
Contribuer équivaut à écrire un nouveau chapitre (cf. plus haut).
​
 - lister les histoires terminées pour les lire :
 Cette partie est accessible sans la nécessité de se logger.
 C'est un index accessible via /read qui regroupe uniquement les histoires terminées.
 La gestion des histoires terminées ou non se fait dans le fichier src>View>Story>read.html.twig.
​
  - lire une histoire :
  A partir de la liste d'histoires terminées, cliquer sur le bouton lire sou une histoire affiche l'histoire en question avec la liste des chapitres les uns à la suite des autres. La page d'une histoire donnée est accessible via /show?id= et l'id de l'histoire.
​
  Le site est responsive avec un breakpoint à 655px.
  Les fichiers CSS (3 au total, un global, un mobile et un desktop) sont dans le dossier public/assets/css.
​
  La base de données utilise un fichier nommé e_stoires qui contient trois tables : 'user', 'story', 'chapter'.