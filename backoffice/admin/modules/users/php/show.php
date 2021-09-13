<?php
include '../../connect.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
//suite 01
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM utilisateurs ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$userss = $stmt->fetchAll(PDO::FETCH_ASSOC);
//suite02
// Get the total number of utilisateurs, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM utilisateurs')->fetchColumn();
?>


<!-- fonction de l'html du module presse (backoffice) -->

<?= module_header('Users') ?>

<div class="content read">
    <h2>Users</h2>
    <a href="create.php" class="create-contact">Create users</a>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Login</td>
                <td>Grade</td>
                <td>Password</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userss as $users) : ?>
                <tr>
                    <td><?= $users['id'] ?></td>
                    <td><?= $users['nom'] ?></td>
                    <td><?= $users['prenom'] ?></td>
                    <td><?= $users['login'] ?></td>
                    <td><?= $users['Grade'] ?></td>
                    <td><?= $users['pass'] ?></td>
                    <td class="actions">
                        <a href="./update.php?id=<?= $users['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="./delete.php?id=<?= $users['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="../Affichage/AffichageUtilisateurs.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_contacts) : ?>
            <a href="../Affichage/AffichageUtilisateurs.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?= module_footer() ?>