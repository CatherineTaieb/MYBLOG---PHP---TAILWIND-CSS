<?php

function getArticles($pdo)
{
    $sql = "SELECT *, SUBSTRING(content,1,60) AS 'preview' FROM articles";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}



function getArticle($pdo, $id)
{
    $sql = "SELECT * FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch();
}


function getComment($pdo, $article_id)
{
    $sql = "SELECT * FROM comments WHERE article_id=:article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":article_id" => $article_id]);
    return $stmt->fetchAll();
}



function addComment($pdo, $id, $author, $commentContent)
{
    $sql = "INSERT INTO comments (article_id,author,content) VALUES (:id,:author,:commentContent)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id, ":author" => $author, ":commentContent" => $commentContent]);
}



function loginUser($pdo, $username, $password)
{
    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["username" => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function addArticle($pdo, $title, $content)
{
    $sql = "INSERT INTO articles (title,content) VALUES (:title,:content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":title" => $title, ":content" => $content]);
}



function deleteArticle($pdo, $id)
{
    $sql = "DELETE FROM comments WHERE article_id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);

    $sql = "DELETE FROM articles WHERE id= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
}


function updateArticle($pdo, $id, $title, $content)
{
    $sql = "UPDATE articles SET title=:title, content=:content WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["title" => $title, "content" => $content, "id" => $id]);
}
