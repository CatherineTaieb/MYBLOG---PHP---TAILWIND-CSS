<?php
require_once "config.php";
require_once "functions.php";

session_start();

$id = $_GET["id"];
$article = getArticle($pdo, $id);

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    header("Location:login.php");
    exit;
} else {
    session_regenerate_id();
}
?>

<?php include "header.php"; ?>

<main>

    <section class="deletearticle">
        <h1>Suppression d'un article</h1>
        <p>Vous vous apprêtez à supprimer l'article ci-dessous. Confirmez vous ?</p>
        <form method="POST">
            <button type="submit" name="delete" aria-label="supprimer">Oui</button>
            <button type="submit" name="cancel" aria-label="annuler">Non</button>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
                deleteArticle($pdo, $id);
                header("Location:admin.php");
                exit;
            }
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cancel"])) {
                header("Location:admin.php");
                exit;
            }
            ?>
        </form>
    </section>

    <section class="article">
        <h1> <?= $article["title"]; ?></h1>
        <span><?= $article["created_at"]; ?></span>
        <p><?= nl2br($article["content"]); ?></p>
    </section>

</main>

<?php require_once "footer.php"; ?>