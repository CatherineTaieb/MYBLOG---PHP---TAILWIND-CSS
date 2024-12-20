<?php
require_once "config.php";
require_once "functions.php";

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = loginUser($pdo, $username, $password);


    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $username;
        $_SESSION["isLoggedIn"] = true;
        header("Location:admin.php");
        exit;
    } else {
        $message = "La connexion a échouée. Merci de bien vouloir réessayer.";
    }
}
?>


<?php include "header.php"; ?>

<main>
    <section class="connexion">
        <h1>Connexion</h1>

        <p>Bonjour et bienvenue ! Connectez-vous pour accéder à votre espace et profiter de toutes nos fonctionnalités.</p>

        <form method="POST" class="log">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Connexion</button>
            <p class="erreur"><?php echo $message; ?> </p>
        </form>
        <p>Pas encore de compte ? <a href="inscription.php">Créez-en un ici</a>.</p>
    </section>
</main>

<?php require_once "footer.php"; ?>