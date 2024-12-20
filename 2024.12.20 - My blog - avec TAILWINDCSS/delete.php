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

    <section class="p-4 m-6 bg-gray-100 rounded-lg border border-ridge border-amber-500">
        <h1 class="text-4xl font-bold">Suppression d'un article</h1>
        <p class="mt-4 mb-8">Vous vous apprêtez à supprimer l'article ci-dessous. Confirmez-vous ?</p>
        <form method="POST" class="flex flex-col items-center space-y-4">
            <button type="submit" name="delete" aria-label="supprimer" class="px-6 py-2 bg-gray-800 text-white font-bold rounded-lg cursor-pointer transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90">Oui</button>
            <button type="submit" name="cancel" aria-label="annuler" class="px-6 py-2 bg-gray-800 text-white font-bold rounded-lg cursor-pointer transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90">Non</button>
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

    <section class="p-4 m-6 bg-gray-100 rounded-lg border border-ridge border-amber-500">
        <h1 class="text-4xl font-bold"><?= $article["title"]; ?></h1>
        <span class="text-gray-600"><?= $article["created_at"]; ?></span>
        <p class="mt-4"><?= nl2br($article["content"]); ?></p>
    </section>

</main>

<?php require_once "footer.php"; ?>
