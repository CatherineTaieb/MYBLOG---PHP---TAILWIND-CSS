<?php 
require_once "config.php";
require_once "functions.php";
require_once "header.php";

session_start();

$id = $_GET["id"];
$article = getArticle($pdo,$id);

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
    header ("Location:login.php");
    exit;
    }
    else{
    session_regenerate_id();
}

?>

<?php include "header.php"; ?>

<main>

    <section class = "update">
        <h1>Modification d'un article</h1>
        <p>Vous pouvez modifier l'article ci dessous !</p>
    </section>

    <section class="update">
        <form method="POST">
            <label for="title">Titre de l'article </label>
            <input type="text" name="title" id="title" value="<?php echo $article["title"]; ?>">
            <label for="content">Contenu de l'article</label>
            <textarea name="content" id="content"><?php echo $article["content"]; ?></textarea>
            <button type = "submit" name = "update" aria-label="modifier">Confirmer</button>
            <button type="submit" name="cancel" aria-label="annuler">Annuler</button>
            <?php 
                if ($_SERVER["REQUEST_METHOD"] === "POST"&& isset($_POST["update"])) {
                $title=$_POST["title"];
                $content=$_POST["content"];
                updateArticle( $pdo,  $id,$title, $content ); 
                header("Location:admin.php");
                exit;
                }
                if ($_SERVER["REQUEST_METHOD"] === "POST"&& isset($_POST["cancel"])) {
                header("Location:admin.php");
                exit;
                } 
            ?>
        </form>
    </section>

</main>

<?php require_once "footer.php"; ?>

