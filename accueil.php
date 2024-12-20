<?php
require_once "config.php";
require_once "functions.php";
$articles = getArticles($pdo);
?>


<?php include "header.php"; ?>

<main>
    <section class="intro">
        <h1>Bienvenue sur mon blog !</h1>
        <p>Explorez une variété d'articles captivants sur les sujets qui vous passionnent. De la technologie aux voyages, notre blog est une ressource dédiée à tous les curieux et passionnés.</p>
        <p>Participez à la conversation en laissant vos commentaires sur nos articles. Nous sommes impatients de lire vos retours et d'échanger avec vous sur nos sujets préférés!</p>

        <?php if (count($articles) < 1): ?>

            <p>Aucun article pour le moment ! Revenez plus tard ! </p>

        <?php else: ?>
            <p>Vous trouverez ci-dessous la liste complète de nos articles, triés par ordre alphabétique, avec un total de <?= count($articles) ?> articles : </p>
    </section>

    <section class="articles">
        <ul class="article__list">
            <?php foreach ($articles as $article): ?>
                <li class="article__item">
                    <h2><?= $article["title"]; ?></h2>
                    <time datetime="<?= $article["created_at"]; ?>"><?= (new DateTime($article["created_at"]))->format("d/m/Y - H\hi"); ?></time>
                    <p><?= $article["preview"] ?></p>
                    <p>(<a href="article.php?id=<?= $article["id"] ?>">Lire la suite</a>)</p>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    </section>

</main>

<?php require_once "footer.php"; ?>