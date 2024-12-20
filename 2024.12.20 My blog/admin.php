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
    <section class="welcome">
        <h1>Bienvenue sur votre tableau de bord <?= htmlspecialchars($_SESSION["username"], ENT_QUOTES, "UTF-8"); ?></h1>
        <p>En tant qu'administrateur, vous avez la possibilité de gérer les articles de notre blog en toute simplicité. Vous pouvez ajouter de nouveaux articles, supprimer ceux qui ne conviennent plus, et gérer le contenu à tout moment.</p>
    </section>

    <section class="addarticle">
        <h2>Vous pouvez ajouter ci dessous un article ! </h2>
        <form class="addarticle__form" method="POST">
            <label class="addarticle__label" for="title">Titre de l'article </label>
            <input class="addarticle__input" type="text" name="title" id="title">
            <label class="addarticle__label" for="content">Contenu de l'article</label>
            <textarea class="addarticle__textarea" name="content" id="content"></textarea>
            <button type="submit" name="add">Poster</button>

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

    <section class="article-management">
        <h2>Vous pouvez modifier ou supprimer un article en cliquant ci-dessous!</h2>
        <?php $articles = getArticles($pdo);
        foreach ($articles as $article) : ?>
            <ul class="article-management__list">
                <li><?= $article["title"]; ?></li>
                <div class="article-management__actions">
                    <li class="article-management__item-link"><a href="delete.php?id=<?= $article["id"]; ?>">Supprimer</a></li>
                    <li class="article-management__item-link"><a href="update.php?id=<?= $article["id"]; ?>">Modifier</a></li>
                </div>
            </ul>
        <?php endforeach; ?>
    </section>

    <section class="logout">
        <p>Pour votre sécurité, nous vous conseillons de vous déconnecter une fois que vous avez terminé. Cliquez ci-dessous pour quitter votre session.</p>
        <p> <a href="logout.php" class="logout__link">Déconnexion</a></p>
    </section>

</main>

<?php require_once "footer.php"; ?>