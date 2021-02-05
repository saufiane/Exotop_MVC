<?php

// require_once('model/blog.php');

// $blog= new Blog;

// echo $blog->$titre;

// $blog->titre="tout";

// echo $blog->$titre;


// *************************************************************************
// require_once 'models/ArticlesClass.php';
// $articles = new Articles();

// // inclusion de l'autoloader
// include 'vendor/autoload.php';

// // le dossier ou se trouve les vues (template)
// $loader = new Twig\Loader\FilesystemLoader('views');

// // initialise environnement Twig
// $twig = new Twig\Environment($loader);

// include 'controllers\ControllersClass.php';

// $action = $_GET['action'] ?? 'list';
// $message ='';

// switch ($action){

//     case"list":
//         list_action($articles, $twig, $message);
//     break;

//     case "add":
        
//     break;

//     case "suppr":

//     break;

//     case "update":

//     break;

//     default:

// ******************************************************************************************************************************



require_once './models/ArticlesClass.php';
$articles = new Articles;
include 'vendor/autoload.php';

// le dossier ou on trouve les templates
$loader = new Twig\Loader\FilesystemLoader('views');

// initialiser l'environement Twig
$twig = new Twig\Environment($loader);

include './controllers/ControllersClass.php';

// on lit une action en parametre
// par defaut, 'list'
$action = $_GET['action'] ?? 'list';

$message = "";
switch ($action) {
case "list":
list_action($articles,$twig,$message);
break;
case "detail":
detail_action($articles,$twig, $_GET['id']);
break;
case "suppr":
if (suppr_action($articles, $_GET['id']))
$message = "Article supprimée avec succès !";
else $message = "Pb de suppression !";
list_action($articles,$twig,$message);
break;
case "patch":
if (!empty($_GET['id']) and !empty($_GET['titre'])
and !empty($_GET['contenu']))
$res = patch_action($articles,$_GET['id'],$_GET['titre'],$_GET['contenu'],$_GET['email']);
if (!empty($res))
$message = "Article modifiée avec succès!";
else
$message = "Pb de modification";
// var_dump($res);
list_action($articles,$twig,$message);
break;
case "add":
if (add_action($articles, $_GET))
$message = "Article ".$_GET['titre']." ajoutée avec succès !";
else $message = "Pb d'ajout de l'article'!";
list_action($articles,$twig,$message);
break;
default:
list_action($articles,$twig,$message);
}

//header("refresh:4;url=index.php");







?>