<!-- php -->
<section class="php">
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
        // Inserer dans la table modulepresse
        $stmt = $pdo->prepare('INSERT INTO modulepresse VALUES (?, ?, ?, ?, ?)');
        // deplacement des imgs
        if (isset($_FILES['img'])) {
            // definis le nom temporaire, le nom de l'img, la taille, et l'erreur
            $tmpName = $_FILES['img']['tmp_name'];
            $name = $_FILES['img']['name'];
            $size = $_FILES['img']['size'];
            $error = $_FILES['img']['error'];

            $tabExtension = explode('.', $name);
            // l'extension est écrit en minuscule
            $extension = strtolower(end($tabExtension));
            // choisis qu'elle type d'image accepter
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            // definis la taille max de l'image
            $maxSize = 5000000;

            if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                $file = $name . "." . $extension;
                // dossier ou l'image ce retrouve
                move_uploaded_file($tmpName, '../../../../../backoffice/admin/modules/presse/img/' . $name);
                // echo "Image enregistrée";
            } else {
                echo "Une erreur est survenue";
            }
        }
        // end moving files
        // message de sortie
        $msg = 'Created Successfully!';
        // insertion du chemin dans une variable puis concatenation de la variable avec l'image en question (le titre)
        $imgpath = 'backoffice/admin/modules/presse/img/' . $name;
        // execute toute cette partie insertion
        $stmt->execute([$id, $title, $text, $created, $imgpath]);
    }
    ?>
</section>

<?= module_header('Create') ?>

<div class="content update">
    <h2>Create Article</h2>
    <!-- formulaire de recuperation des informations a inscrire dans la BDD -->
    <!-- la methode -->
    <form action="create.php" method="post" enctype="multipart/form-data">
        <!--  -->
        <!-- label affiche du texte et input une case a remplir -->
        <!-- chaque ajout ce mets a la suite du precedent -->
        <label for="id">ID</label>
        <label for="title">Title</label>

        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="title" id="title">

        <!-- L'image est selection grace au type "file" ce qui utilise le systeme de explorer de windows pour la simpliciter -->
        <label for="img">Img</label>
        <div class="imgcontent">
            <!-- et nous affichons un apperçus ici -->
            <img id="output" src="" width="auto" height="350">
            <input class="pick" type="file" name="img" id="img" accept="" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
        </div>

        <label for="text">date</label>
        <label for="text">texte</label>

        <!-- un calendrier est afficher pour selectioner automatiquement la date actuel -->
        <input type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="dat" id="created"><br>

        <textarea type="text" name="text" id="text" class="Inputpara"></textarea>
  
        <!-- bouton pour envoyer tout le formulaire () -->
        <input type="submit" name="submit" value="Create"> 
    </form>
    <!-- la où afficher le message de succes -->
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= module_footer() ?>