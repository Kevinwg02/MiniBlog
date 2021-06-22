<?php
include '../../connect.php';
$pdo = pdo_connect_mysql();
$msg = '';
// verifier les champs
if (!empty($_POST)) {
    // Poster les champs
    // objet POST existe il?
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // récuper les données inscris et les gardes dans une variable respectives
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $text = isset($_POST['text']) ? $_POST['text'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    $img = isset($_POST['img']) ?  $_POST['img'] : '';
    // Inserer dans la table modulepresse
    $stmt = $pdo->prepare('INSERT INTO modulepresse VALUES (?, ?, ?, ?, ?)');

    // message de sortie
    $msg = 'Created Successfully!';
// insertion du chemin dans une variable puis concatenation de la variable avec l'image en question (le titre)
    $imgpath = 'backoffice/admin/modules/presse/img/' . $img;
    // execute toute cette partie insertion
    $stmt->execute([$id, $title, $text, $created, $imgpath]);
}
?>
<?= module_header('Create') ?>

<style>

</style>

<div class="content update">
    <h2>Create Contact</h2>
    <!-- formulaire de recuperation des informations a inscrire dans la BDD -->
    <!-- Page utiliser + la methode -->
    <form action="create.php" method="post">

        <!-- label affiche du texte et input une case a remplir -->
        <!-- chaque ajout ce mets a la suite du precedent -->
        <label for="id">ID</label>
        <label for="title">Title</label>

        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="title" id="title">

        <!-- L'image est selection grace au type "file" ce qui utilise le systeme de explorer de windows pour la simpliciter -->
        <label for="img">Img</label>
        <div class="imgcontent">
            <!-- l'image arrive ici -->
            <img id="output" src="" width="150" height="100">
            <!-- et nous affichons un apperçus ici -->
            <input class="pick" type="file" name="img" id="img" accept="" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
        </div>

        <label for="text">date</label>
        <label for="text">texte</label>
<!-- un calendrier est afficher pour selectioner la date -->
        <input type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="dat" id="created"><br>
        <input type="text" name="text" id="text" class="Inputpara">

<!-- bouton pour envoyer tout le formulaire () -->
        <input type="submit" value="Create">
    </form>
    <!-- la où afficher le message de succes -->
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= module_footer() ?>

