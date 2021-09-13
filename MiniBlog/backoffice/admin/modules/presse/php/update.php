<?php
include '../../connect.php';
$pdo = pdo_connect_mysql();
$msg = '';
// verifie si l'article existe par exemple si update.php?id=1 aura l'id 1 sinon il aura le id 2
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Cette partie est partiquement la même que le créer sauf que nous mettons a jours a la place de créer
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;

        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $texte = isset($_POST['texte']) ? $_POST['texte'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        $img = isset($_POST['img']) ? $_POST['img'] : '';
        $imgpath = 'backoffice/admin/modules/presse/img/'.$img;  
        // mise a jours base
        $stmt = $pdo->prepare('UPDATE modulepresse SET id = ?, title = ?, texte = ?, created = ?, img = ? WHERE id = ?');
        $stmt->execute([$id, $title, $texte, $created, $imgpath, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // récupere l'article de la table
    $stmt = $pdo->prepare('SELECT * FROM modulepresse WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $articles = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$articles) {
        exit('articles doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?= module_header('Read') ?>

<div class="content update">
    <h2>Update Article #<?= $articles['id'] ?></h2>
     <form action="update.php?id=<?=$articles['id']?>" method="post">
        <label for="id">ID</label>
        <label for="title">Title</label>

        <input type="text" name="id" placeholder="26" value="<?= $articles['id'] ?>" id="id">
        <input type="text" name="title" id="title" value="<?= $articles['title'] ?>">

        <label for="img">Img</label>
        <label for="date">Date</label>

        <div>
            <img id="output" src="" width="100" height="100">
            <input type="file" name="img" id="img" accept="image/png, image/jpg, image/jpeg" accept="/frontoffice/ModulePresse/img/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"/>
        </div>
        <input type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="created">

        <input type="text" name="texte" id="texte" class="Inputpara" value="<?= $articles['texte'] ?>">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= module_footer() ?>