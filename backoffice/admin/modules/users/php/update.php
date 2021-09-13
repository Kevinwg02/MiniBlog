<?php
include '../../connect.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;

        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $login = isset($_POST['login']) ? $_POST['login'] : '';
        $Status = isset($_POST['Status']) ? $_POST['Status'] : '';
        $Grade = isset($_POST['Grade']) ? $_POST['Grade'] : '';
        $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE utilisateurs SET id = ?, nom = ?, prenom = ?, login = ?, Grade = ?, pass = ? WHERE id = ?');
        $stmt->execute([$id, $nom, $prenom, $login, $Grade,  md5($pass), $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('utilisateurs doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?= module_header('Read') ?>

<div class="content update">
    <h2>Update Contact #<?= $contact['id'] ?></h2>
   <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nom">Nom</label>

        <input type="text" name="id" placeholder="1" value="<?= $contact['id'] ?>" id="id">
        <input type="text" name="nom" placeholder="John Doe" value="<?= $contact['nom'] ?>" id="nom">

        <label for="prenom">Prenom</label>
        <label for="login">Login</label>

        <input type="text" name="prenom" value="<?= $contact['prenom'] ?>" id="prenom">
        <input type="text" name="login" value="<?= $contact['login'] ?>" id="login">

        <label for="pass">pass</label>
         <label for="Grade">Grade</label>

         <input type="text" name="pass" value="<?= $contact['pass'] ?>" id="pass">

         <input type="text" name="Grade" value="<?= $contact['Grade'] ?>" id="Grade">

        <input type="submit" value="Update">
       

    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= module_footer() ?>