<?php
include '../../connect.php';
//  Connexion PHP BDD
$pdo = pdo_connect_mysql();
// trouve l'url avec la methode GET si aucune autre page existe, la page par default est 1 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// le nombre de valeurs a afficher (pagination)
$records_per_page = 3;

// Prepare la requette SQL et récupere les valeurs de la table module presse avec la limite definie
$stmt = $pdo->prepare('SELECT * FROM modulepresse ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// récupere les valeurs de la table
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//suite02
// trouve combien de valeurs il y a au total, pour savoir si il y aura le systeme de pagination ou non
$num_articles = $pdo->query('SELECT COUNT(*) FROM modulepresse')->fetchColumn();
?>


<!-- fonction de l'html du module presse (backoffice) -->
<?= module_header('Presse') ?>

<div class="content read">
    <!-- titre est lien sur la page Create (article) -->
    <h2>Article</h2>
    <a href="create.php" class="create-contact">Create Article</a>
    <!-- Tableau  -->
    <table>
        <thead>
            <!-- nom des colonnes -->
            <tr>
                <td>#</td>
                <td>img</td>
                <td>titre</td>
                <td>texte</td>
                <td>created</td>
                <td>actions</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <!-- affichage des resultat de la base de donnée celon la colonne -->
            <?php foreach ($articles as $articles) : ?>
                <tr>
                    <td><?= $articles['id'] ?></td>
                    <td><?= $articles['img'] ?></td>
                    <td><?= $articles['title'] ?></td>
                    <td><?= $articles['texte'] ?></td>
                    <td><?= $articles['created'] ?></td>
                    <!-- bouton update et delete sur chaque resultat (chaque ligne) -->
                    <td class="actions">
                        <a href="update.php?id=<?= $articles['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?id=<?= $articles['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<!-- system de pagination -->
<div class="pagination" style="font-size: 15px;">
    <?php if ($page > 1) : ?>
        <span style="font-size:15px; color: Tomato;"> <a href="show.php?page=<?= $page - 1 ?>"><i class="fas fa-arrow-left fa-3x"></i></a></span>
    <?php endif; ?>
    <?php if ($page * $records_per_page < $num_articles) : ?>
        <span style="font-size: 15px; color: Tomato;"> <a href="show.php?page=<?= $page + 1 ?>"><i class="fas fa-arrow-right fa-3x"></i></a></span>
    <?php endif; ?>
</div>
<!-- fonction de l'html du module presse (backoffice) -->
<?= module_footer() ?>