<?php
require_once "config.php";
require_once "functions.php";

$id = $_GET["id"];
$article = getArticle($pdo, $id);
?>

<?php include "header.php"; ?>

<main>

    <section class="article">
        <h1> <?= $article["title"]; ?></h1>
        <span><?= $article["created_at"]; ?></span>
        <p><?= nl2br($article["content"]); ?></p>
    </section>

    <form method="POST" class="postcomment">
        <label for="author">Écrivez votre nom ici </label>
        <input type="text" name="author" id="author">
        <label for="commentContent">Écrivez votre commentaire ici </label>
        <textarea name="commentContent" id="commentContent"></textarea>
        <button type="submit">Poster</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") :
        $author = empty($_POST["author"]) ? "Anonyme" : $_POST["author"];
        $commentContent = $_POST["commentContent"];
        addComment($pdo, $id,    $author, $commentContent);
        header("Location:article.php?id=" . $id);
        exit;
    endif;
    ?>


    <section class="comments">
        <h2 class="comments__title">Les avis des lecteurs</h2>
        <p class="comments__intro">Découvrez ci-dessous les retours des lecteurs sur cet article. N'hésitez pas à partager également votre avis en laissant un commentaire ! </p>
        <?php
        $comments = getComment($pdo, $article["id"]);
        if ($comments):
        ?>
            <ul class="comments__list">
                <?php
                foreach ($comments as $comment) :
                ?>
                    <li class="comments__item">
                        <h3 class="comment__author"><?= $comment["author"]; ?></h3>
                        <p class="comments__content"><?= $comment["content"]; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php else : ?>
            <p>Aucun commentaire pour le moment !</p>
        <?php endif; ?>
    </section>

</main>

<?php require_once "footer.php"; ?>