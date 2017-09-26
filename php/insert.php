<?php

include('connection.php');

$civilite = $_POST["civilite"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$pays = $_POST["pays"];
$adresse = $_POST["adresse"];
$telephone = $_POST["telephone"];
$mobile = $_POST["mobile"];
$ville = $_POST["ville"];
$societe = $_POST["societe"];
$photo= $_POST[""];




if (isset($civilite) && isset($nom) && isset($prenom) && isset($email) && isset($pays)) {

    if ($civilite != "" && $nom != "" && $prenom != "" && $email != "" && $pays != "") {

            try {
               if  ( $_FILES ['photo'] [ 'size'] <= 100000) {

                   $photo = pathinfo ($_FILES ['photo'] ['name']) ;
                   $extension_upload = $photo [ 'extension'] ;
                   $extension_autosees = array('jpg', 'jpeg', 'gif', 'png');

                   if  ( in_array( $extension_upload ,  $extension_autosees))
                   {

                       move_uploaded_file ( $_FILES ['photo'] ['tmp_name'] ,dirname(__FILE__) .'/../upload/' .basename ($_FILES ['photo'] ['name'])) ;
                       echo  " l' envoi  a bien ete effecture ";

                       $query = $spdo->prepare('INSERT INTO utilisateurs (id, civilite,nom,prenom,email,pays,adresse,telephone,mobile,ville,societe,photo) 
                                                  VALUES (\'\', :civilite,:nom,:prenom,:email,:pays,:adresse,:telephone,:mobile,:ville,:societe,:photo)');
                       $query->bindValue(':civilite', $civilite, PDO::PARAM_STR);
                       $query->bindValue(':nom', $nom, PDO::PARAM_STR);
                       $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                       $query->bindValue(':email', $email, PDO::PARAM_STR);
                       $query->bindValue(':pays', $pays, PDO::PARAM_STR);
                       $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
                       $query->bindValue(':telephone', $telephone, PDO::PARAM_STR);
                       $query->bindValue(':mobile', $mobile, PDO::PARAM_STR);
                       $query->bindValue(':ville', $ville, PDO::PARAM_STR);
                       $query->bindValue(':societe', $societe, PDO::PARAM_STR);
                       $query->bindValue(':photo', '/upload/' .basename ($_FILES ['photo'] ['name']), PDO::PARAM_STR);

                       $res = $query->execute();
                       


                       if ($res) {
                           echo "Vos contact sont bien enregistre";


                       } else {
                           echo "ko";
                       }
                   }else
                   {
                       echo 'mauvaise extension';
                   }

                }else {
                   echo 'photo trop lourde';
               }
            }
            catch (PDOException $e)
            {
                throw new PDOException($e->getMessage());
            }
    }
    else {
        echo "Il faut remplir tous les champs";

    }
}
else {
    echo "Une erreur s'est produite";

}






?>


