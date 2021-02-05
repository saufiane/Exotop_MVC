<?php
require_once 'models/ArticlesClass.php';

function list_action($cont,$twig, $message){

$articles = $cont->get_all_articles();
$template = $twig->load('articles.twig.html');
$titre="Mes articles";
echo $template->render(array(
'titre' => $titre,
'articles' => $articles,
'message' => $message
));
}

function detail_action($cont,$twig, $id,$message=''){
$article = $cont->get_article_by_id($id);
$template = $twig->load('detail.twig.html');
$titre="Détails";
echo $template->render(array(
'titre' => $titre,
'articles' => $article,
'message' => $message
));
}

function suppr_action($cont, $id){
return ($cont->delete_article_by_id($id));
}

function patch_action($cont, $id, $titre, $contenu,$email){
return ($cont->update($id,$titre,$contenu,$email));
}


function add_action($cont, $contact){
return ($cont->add_article($contact));
}

?>