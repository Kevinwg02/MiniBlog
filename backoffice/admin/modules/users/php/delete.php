<?php
include '../../connect.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$users) {
        exit('utilisateur doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM utilisateurs WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted this user!';
            
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: ./show.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=module_header('Delete')?>

<div class="content delete">
	<h2>Delete Contact #<?=$users['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete this user #<?=$users['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$users['id']?>&confirm=yes">Yes</a>
        <a href="show.php?id=<?=$users['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=module_footer()?>