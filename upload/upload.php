<!-- =========
    Dev d'un formulaire qui permet a l'utilisateur d'upload des fichiers et le met dans le dossier upload/fichiers
    - Valide le MIME du fichier et rend unique le nom du fichier
=========== -->

<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
</head>
<body>
    <h1>Upload</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Envoyer">
    </form>
    <?php
        if(isset($_FILES['file'])){
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $allowed = array('txt', 'jpg', 'png', 'pdf', 'php', 'html', 'css', 'js');
            if(in_array($file_ext, $allowed)){
                if($file_error === 0){
                    if($file_size <= 2097152){
                        $file_name_new = uniqid('', true).'.'.$file_ext;
                        $file_destination = 'fichiers/'.$file_name_new;
                        if(move_uploaded_file($file_tmp, $file_destination)){
                            echo "Fichier uploadé avec succès";
                        }
                    }
                }
            }
        }
    ?>
</body>
</html>