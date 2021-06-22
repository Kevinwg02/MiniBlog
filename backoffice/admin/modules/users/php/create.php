<?php
include '../../connect.php';
$pdo = pdo_connect_mysql();
$msg = '';
// verifier les champs
if (!empty($_POST)) {
    // Poster les champs
    // objet POST existe il?
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    // $Status = isset($_POST['Status']) ? $_POST['Status'] : '';
    $Grade = isset($_POST['Grade']) ? $_POST['Grade'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    // Insert new record into the utilisateurs table
    $stmt = $pdo->prepare('INSERT INTO utilisateurs VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nom, $prenom, $login, $Grade, $pass]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?= module_header('Create') ?>

<div class="content update">
    <h2>Create utilisateurs</h2>
    <form action="CreateUtilisateurs.php" method="post">
        <label for="id">ID</label>
        <label for="nom">Nom</label>

        <input type="text" name="id" placeholder="1" value="auto" id="id">
        <input type="text" name="nom" placeholder="John Doe" id="nom">

        <label for="prenom">Prenom</label>
        <label for="login">Login</label>

        <input type="text" name="prenom" id="prenom">
        <input type="text" name="login" id="login">


        <label for="Grade">Grade</label>
        <label for="pass">pass</label>

        <input type="text" name="Grade" id="Grade"></label>
        <input type="text" name="pass" id="pass">

        <input type="submit" value="Create">


    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= module_footer() ?>