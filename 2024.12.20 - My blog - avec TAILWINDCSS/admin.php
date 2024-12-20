<?php
require_once "config.php";
require_once "functions.php";

session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true) {
    header("Location:login.php");
    exit;
} else {
    session_regenerate_id();
}
?>

<?php include "header.php"; ?>

<main>
    <section class="p-4 m-6 bg-gray-100 rounded-lg border-ridge border-4 border-amber-500">
        <h1>Bienvenue sur votre tableau de bord <?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, "UTF-8"); ?></h1>
        <p>En tant qu'administrateur, vous avez la possibilité de gérer les articles de notre blog en toute simplicité. Vous pouvez ajouter de nouveaux articles, supprimer ceux qui ne conviennent plus, et gérer le contenu à tout moment.</p>
    </section>

    <section class="w-full p-4 m-6 bg-gray-100 rounded-lg border-4 border-ridge border-amber-500">
        <h2 class="text-2xl mb-4">Vous pouvez ajouter ci-dessous un article !</h2>
        <form class="pb-3 flex flex-col items-center mt-6" method="POST">
            <label for="title" class="mt-3">Titre de l'article</label>
            <input type="text" name="title" id="title" class="rounded-lg border border-gray-300 m-2 p-2 w-full sm:w-4/5 focus:border-amber-500 focus:outline-none" required maxlength="80">
            <label for="content" class="mt-3">Contenu de l'article</label>
            <textarea name="content" id="content" class="rounded-lg border border-gray-300 m-2 p-2 h-32 w-full sm:w-4/5 focus:border-amber-500 focus:outline-none" required></textarea>
            <button type="submit" name="add" class="px-6 py-2 mt-3 bg-gray-800 text-white font-bold rounded-lg cursor-pointer transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90">Poster</button>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add"])) {
                $title = $_POST["title"];
                $content = $_POST["content"];
                addArticle($pdo, $title, $content);
                header("Location:admin.php");
                exit;
            }
            ?>
        </form>
    </section>

    <section class="w-full p-4 m-6 bg-gray-100 rounded-lg border-4 border-ridge border-amber-500">
        <h2 class="text-2xl mb-4">Vous pouvez modifier ou supprimer un article en cliquant ci-dessous!</h2>
        <?php $articles = getArticles($pdo);
        foreach ($articles as $article) : ?>
            <ul class="list-none flex flex-wrap justify-between items-center mb-4 p-2 bg-gray-100 rounded-lg border border-gray-300">
                <li><?= $article["title"]; ?></li>
                <div class="flex justify-around w-full sm:w-auto">
                    <li class="inline-block border-2 border-amber-500 rounded-lg p-2 m-4 transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90"><a href="delete.php?id=<?= $article["id"]; ?>">Supprimer</a></li>
                    <li class="inline-block border-2 border-amber-500 rounded-lg p-2 m-4 transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90"><a href="update.php?id=<?= $article["id"]; ?>">Modifier</a></li>
                </div>
            </ul>
        <?php endforeach; ?>
    </section>

    <section class="p-4 m-6 bg-gray-100 rounded-lg border-4 border-amber-500 border-ridge">
        <p>Pour votre sécurité, nous vous conseillons de vous déconnecter une fois que vous avez terminé. Cliquez ci-dessous pour quitter votre session.</p>
        <p><a href="logout.php" class="inline-block px-6 py-2 mt-3 bg-gray-800 text-white text-lg rounded-lg cursor-pointer transition-transform hover:text-amber-500 active:text-amber-500 active:scale-90 hover:scale-110">Déconnexion</a></p>
    </section>

</main>

<?php require_once "footer.php"; ?>
