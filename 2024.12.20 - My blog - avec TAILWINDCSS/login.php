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
    <h1 class="text-4xl font-bold">Connexion</h1>
    <p class="mt-4 mb-8">Bonjour et bienvenue ! Connectez-vous pour accéder à votre espace et profiter de toutes nos fonctionnalités.</p>

    <form method="POST" class="flex flex-col justify-center items-center rounded-lg border-4 border-ridge border-amber-500 p-4">
        <label for="username" class="mt-3">Nom d'utilisateur</label>
        <input type="text" name="username" id="username" class="rounded-lg border border-gray-300 m-2 p-2 focus:border-amber-500 focus:outline-none" required/>
        <label for="password" class="mt-3">Mot de passe</label>
        <input type="password" name="password" id="password" class="rounded-lg border border-gray-300 m-2 p-2 focus:border-amber-500 focus:outline-none" required>
        <button type="submit" class="px-6 py-2 mt-4 bg-gray-800 text-white font-bold rounded-lg cursor-pointer transition-transform duration-300 hover:text-amber-500 hover:scale-110 active:scale-90">Connexion</button>
        <p class="text-red-600 font-semibold mt-4"><?php echo $message; ?> </p>
    </form>
</main>

<?php require_once "footer.php"; ?>
