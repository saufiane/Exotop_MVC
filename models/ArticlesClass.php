<?php
require("connect.php");

/** Classe de gestion des Articles servant de modèle
* à notre application avec des méthodes de type CRUD
*/
class Articles {
/** Objet contenant la connexion pdo à la BD */
private static $connexion;

/** Constructeur établissant la connexion */
function __construct()
{
$dsn="mysql:dbname=".BASE.";host=".SERVER;
try{
self::$connexion=new PDO($dsn,USER,PASSWD);
}
catch(PDOException $e){
printf("Échec de la connexion : %s\n", $e->getMessage());
$this->connexion = NULL;
}
}

/** Récupére la liste des Articles sous forme d'un tableau */
function get_all_articles()
{
$sql="SELECT * from Articles";
$data = self::$connexion->query($sql);
// var_dump($data);
return $data;
}

/** Ajoute un Article à la table Articles */
function add_article($data)
{
$sql = "INSERT INTO Articles(titre,contenu,email) values (?,?,?)";
$stmt = self::$connexion->prepare($sql);
return $stmt->execute(array($data['titre'],
$data['contenu'], $data['email']));
}

/** Récupére un Article à partir de son ID */
function get_article_by_id($id)
{
$sql="SELECT * from Articles where id=:id";
$stmt=self::$connexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetch(PDO::FETCH_OBJ);
}

/** Efface un article à partir de son ID */
function delete_article_by_id($id)
{
$sql="Delete from Articles where id=:id";
$stmt=self::$connexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
return $stmt->execute();
}

/** Met à jour d'un article'*/
function update($id, $titre, $contenu, $email)
{
$sql = "UPDATE Articles SET titre = :titre, contenu = :contenu, email = :email WHERE id = :id ";
$stmt = self::$connexion->prepare($sql);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':contenu', $contenu);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':id', $id);
// var_dump($id);
return $stmt->execute();
}
}


?>
