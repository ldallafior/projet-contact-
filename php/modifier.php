<?php
include ('connection.php');

try {

    if(strlen($_FILES ['photo']['name']) > 0) {
        $photo = pathinfo ($_FILES ['photo'] ['name']) ;
        if ($_FILES ['photo'] ['size'] <= 100000) {


            $extension_upload = $photo ['extension'];
            $extension_autosees = array('jpg', 'jpeg', 'gif', 'png');

            if (in_array($extension_upload, $extension_autosees)) {
                move_uploaded_file($_FILES ['photo'] ['tmp_name'], dirname(__FILE__) . '/../upload/' . basename($_FILES ['photo'] ['name']));
                    $path = '/upload/' . basename($_FILES ['photo'] ['name']);
                    $sql = "UPDATE utilisateurs SET photo=:photo WHERE id = :id";
                    $stmt = $spdo->prepare($sql);
                    $stmt->bindParam(':photo', $path, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
                    $stmt->execute();


                echo " l' envoi  a bien ete effecture ";
            } else {
                echo 'mauvaise extension';
            }


        } else {
            echo 'photo trop lourde';
        }
    }



    $sql = "UPDATE utilisateurs SET 
            civilite=:civilite, 
            nom=:nom,  
            prenom=:prenom,  
            email=:email, 
            pays=:pays,
            adresse=:adresse,
            telephone=:telephone,
            mobile=:mobile,
            ville=:ville,
            societe=:societe
            
          WHERE id = :id";
    $stmt = $spdo->prepare($sql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
    $stmt->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(':pays', $_POST['pays'], PDO::PARAM_STR);
    $stmt->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
    $stmt->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
    $stmt->bindParam(':mobile', $_POST['mobile'], PDO::PARAM_STR);
    $stmt->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR);
    $stmt->bindParam(':societe', $_POST['societe'], PDO::PARAM_STR);
    $stmt->execute();

    header('location: http://localhost:8888/phpcontact/index.php');


}
catch (Exception $e)
{
    throw new Exception($e->getMessage());
}