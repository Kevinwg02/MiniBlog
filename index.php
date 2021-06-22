<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- librairie de la police -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- feuille de style -->
    <link rel="stylesheet" type="text/css" href="frontoffice/css/style.css">
    <link href="frontoffice/ModulePresse/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <title>AFSF Blog</title>
</head>

<body>
    <!-- section: php -->
    <section>
        <!-- Connexion PHP BDD -->
        <?php
        include 'backoffice/admin/modules/connect.php';
        // Connection a la base MySQL
        $pdo = pdo_connect_mysql();
        // pagination
        // prends la page par la requette GET, si l'url ne change le par default est 1
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        // Nombre d'éléments a afficher
        $records_per_page = 3;

        // Requete SQL avec limite de resultat donnée
        $stmt = $pdo->prepare('SELECT * FROM modulepresse  ORDER BY id LIMIT :current_page, :record_per_page');
        // page actuel definis a 1
        $stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        // aller chercher les resultats
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //
        // aller chercher le nombre d'articles pour determiner si il devrait y avoir un bouton suivant/precedent ou pas
        $num_articles = $pdo->query('SELECT COUNT(*) FROM modulepresse')->fetchColumn();
        ?>
    </section>

    <!-- section: darkmode/logo/menu/bar/ -->
    <section class="top">
        <div class="darkmodeicon">
            <input type="checkbox" class="checkbox" onclick="showDiv();" id="checkbox">
            <label for="checkbox" id="label">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun"></i>
                <div class="ball"></div>
            </label>
        </div>
        <!-- logo -->
        <div class="logo">
            <a href="login.php"> <img src="frontoffice/img/afsflogo.png" class="afsflogo" alt="afsf" width="1800px" height="100px"></a>
        </div>

        <!-- menu -->
        <div class=" nav">

            <label for="toggle">&#9776</label>
            <input type="checkbox" id="toggle">
            <div class="menu">
                <div class="darkmodeiconmini">
                    <input type="checkbox" class="checkbox" onclick="showDiv();" id="checkbox">
                    <label for="checkbox" id="label">
                        <i class="fas fa-moon"></i>
                        <i class="fas fa-sun"></i>
                        <div class="ball"></div>
                    </label>
                </div>
                <a class="menu-btn" href="#"><span style="color: #e00000;">Main</span></a>
                <a class="menu-btn" href="#"><span style="color: #e00000;">Cultural Center</span></a>
                <a class="menu-btn" href="#"><span style="color: #e00000;">Cooking</span></a>
                <a class="menu-btn" href="#"><span style="color: #e00000;">French Tips</span></a>
                <a class="menu-btn" href="#"><span style="color: #e00000;">Podcasts</span></a>
                <a class="menu-btn" href="#"><span style="color: #e00000;">Community</span></a>

            </div>
        </div> <br> <br>
        <!-- bar noir -->
        <div class="bar" id="blackbar"></div>

        <script src="frontoffice/js/darkmode.js" type="text/javascript"></script>
        <!-- <script src="frontoffice/js/show.js" type="text/javascript"> </script> -->

    </section>

    <!-- section: presse: title/date/text/img -->
    <section class="container">
    <h1 class="project-title"> MINI BLOG</h1>
        <!-- tableau affichage -->
        <?php foreach ($articles as $articles) : ?>
            <!-- on bloque tout dans une boite -->
            <div class="FluxMain">
                <!-- tout les articles que l'on affiche sont dans une boite -->
            
                <div class="article_entier">
                    <!-- l'image  -->
                    <div class="img_article">
                        <img style="width: 350px; height: 250px;" src=<?= $articles['img'] ?>>
                    </div>
                    <!-- tout la partie ecrite -->
                    <div class="article_text">
                        <!-- le titre -->
                        <h2> <?= $articles['title'] ?></h3>
                            <!-- la date -->
                            <p class="date">
                                <?= $articles['created'] ?>
                            </p>
                            <!-- le texte -->
                            <p class="para_article">
                                <?= $articles['texte'] ?>
                            </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- section: next/previous arrows -->
    <section class="pagination">
        <!-- les fleches du systeme de pagination -->
        <div>
            <?php if ($page > 1) : ?>
                <a href="index.php?page=<?= $page - 1 ?>"> <i class="fas fa-arrow-left fa-1x"></i></a></span>
            <?php endif; ?>
            <?php if ($page * $records_per_page < $num_articles) : ?>
                <a href="index.php?page=<?= $page + 1 ?>"><i class="fas fa-arrow-right fa-1x"></i></a>
            <?php endif; ?>
        </div>
    </section>

</body>

</html>