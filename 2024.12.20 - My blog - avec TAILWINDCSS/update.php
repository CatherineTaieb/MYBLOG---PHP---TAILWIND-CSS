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

    <section class="p-4 mx-auto my-8 w-3/5 bg-gray-100 rounded-lg border border-ridge border-amber-500 flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold">Modification d'un article</h1>
        <p class="mt-4 mb-8">Vous pouvez modifier l'article ci-dessous !</p>
    </section>

    <section class="p-4 mx-auto my-8 w-3/5 bg-gray-100 rounded-lg border border-ridge border-amber-500 flex flex-col justify-center items-center">
        <form method="POST" class="flex flex-col items-center w-11/12">
            <label for="title" class="mt-3">Titre de l'article</label>
            <input type="text" name="title" id="title" value="<?php echo $article["title"]; ?>" class="rounded-lg border border-gray-300 m-2 p-2 w-full focus:border-amber-500 focus:outline-none">
            <label for="content" class="mt-3">Contenu de l'article</label>
            <textarea name="content" id="content" class="rounded-lg border border-gray-300 m-2 p-2 h-72 w-full focus:border-amber-500 focus:outline-none"><?php echo $article["content"]; ?></textarea>
            <div class="flex space-x-4 mt-4">
                <button type="submit" name="update" aria-label="modifier" class="px-6 py-2 bg-gray-800 text-white font-bold rounded-lg cursor-pointer transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90">Confirmer</button>
                <button type="submit" name="cancel" aria-label="annuler" class="px-6 py-2 bg-gray-800 text-white font-bold rounded-lg cursor-pointer transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90">Annuler</button>
            </div>
            <?php 
                if ($_SERVER["REQUEST_METHOD"] === "POST"&& isset($_POST["update"])) {
                    $title=$_POST["title"];
                    $content=$_POST["content"];
                    updateArticle($pdo, $id, $title, $content); 
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
