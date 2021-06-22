<?php
include '../../connect.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Verifie si ID exist
if (isset($_GET['id'])) {
    // Selection de qui vas être supprimer
    $stmt = $pdo->prepare('SELECT * FROM modulepresse WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('utilisateur doesn\'t exist with that ID!');
    }
    // confirmation de l'utilisateur
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            //  clique sur oui pour confirmer puis affiche le message de succes
            $stmt = $pdo->prepare('DELETE FROM modulepresse WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted this Article!';
        } else {
            // clique sur non et retourne sur la page Affichage Presse
            header('Location: ../show.php');
            exit;
        }
    }
    }else {
// si probleme d'id cette erreur
 
    exit('No ID specified!');
}
?>
<?=module_header('Delete')?>

<div class="content delete">
	<h2>Delete Article #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete this user #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>
        <a href="show.php?id=<?=$contact['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=module_footer()?>
