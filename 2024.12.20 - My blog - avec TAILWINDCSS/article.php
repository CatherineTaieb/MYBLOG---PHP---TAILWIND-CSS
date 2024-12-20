<?php
require_once "config.php";
require_once "functions.php";

$id = $_GET["id"];
$article = getArticle($pdo, $id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $author = empty($_POST["author"]) ? "Anonyme" : $_POST["author"];
    $commentContent = $_POST["commentContent"];
    addComment($pdo, $id, $author, $commentContent);
    header("Location: article.php?id=" . $id);
    exit;
}
?>

<?php include "header.php"; ?>

<main>

    <section class="article">
        <h1 class="text-4xl font-bold"><?= $article["title"]; ?></h1>
        <span class="text-gray-600"><?= $article["created_at"]; ?></span>
        <p><?= nl2br($article["content"]); ?></p>
    </section>

    <form method="POST" class="w-3/5 pb-3 flex flex-col items-center rounded-lg border-4 border-amber-500 border-ridge mt-10">
        <label for="author" class="mt-3">Écrivez votre nom ici</label>
        <input type="text" name="author" id="author" class="rounded-lg border border-amber-600 m-2 pl-1 focus:border-amber-500 focus:outline-none sm:w-4/5">
        <label for="commentContent" class="mt-3">Écrivez votre commentaire ici</label>
        <textarea required name="commentContent" id="commentContent" class="rounded-lg border border-amber-600 m-2 p-1 h-16 w-4/5 focus:border-amber-500 focus:outline-none sm:w-4/5"></textarea>
        <button type="submit">Poster</button>
    </form>

    <section class="comments mt-8">
        <h2 class="text-2xl">Les avis des lecteurs</h2>
        <p class="mb-4">Découvrez ci-dessous les retours des lecteurs sur cet article. N'hésitez pas à partager également votre avis en laissant un commentaire !</p>
        <?php
        $comments = getComment($pdo, $article["id"]);
        if ($comments):
        ?>
            <ul class="list-none m-0 p-0">
                <?php foreach ($comments as $comment) : ?>
                    <li class="border-t border-gray-300 mt-2 pt-2">
                        <h3 class="font-bold"><?= $comment["author"]; ?></h3>
                        <p class="break-words"><?= $comment["content"]; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucun commentaire pour le moment !</p>
        <?php endif; ?>
    </section>

</main>

<?php require_once "footer.php"; ?>
