<?php
require_once "config.php";
require_once "functions.php";
$articles = getArticles($pdo);
?>

<?php include "header.php"; ?>

<main>
    <section class="m-8">
        <h1>Bienvenue sur mon blog !</h1>
        <p>Explorez une variété d'articles captivants sur les sujets qui vous passionnent. De la technologie aux voyages, notre blog est une ressource dédiée à tous les curieux et passionnés.</p>
        <p>Participez à la conversation en laissant vos commentaires sur nos articles. Nous sommes impatients de lire vos retours et d'échanger avec vous sur nos sujets préférés!</p>

        <?php if (count($articles) < 1): ?>

            <p class="m-20">Aucun article pour le moment ! Revenez plus tard ! </p>

        <?php else: ?>
            <p>Vous trouverez ci-dessous la liste complète de nos articles, triés par ordre alphabétique, avec un total de <?= count($articles) ?> articles : </p>
    </section>

    <section class="articles">
        <ul class="flex flex-wrap justify-around items-center w-full list-none mb-8">
            <?php foreach ($articles as $article): ?>
                <li class="border-4 border-amber-500 border-ridge rounded-lg max-h-64 h-64 max-w-64 w-64 m-3 flex flex-col justify-center items-center transition-transform duration-300 shadow-md hover:translate-y-[-5px] hover:shadow-xl">
                    <h2 class="m-0 px-4 break-words"><?= $article["title"]; ?></h2>
                    <time datetime="<?= $article["created_at"]; ?>" class="text-xs text-gray-600 p-3"><?= (new DateTime($article["created_at"]))->format("d/m/Y - H\hi"); ?></time>
                    <p class="px-3"><?= $article["preview"] ?></p>
                    <p class="px-3"><a href="article.php?id=<?= $article["id"] ?>" class="font-bold underline hover:text-amber-500">Lire la suite</a></p>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

    </section>

</main>

<?php require_once "footer.php"; ?>
