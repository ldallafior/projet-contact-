<table   class="table table-bordered">
    <tr class="text-error"  >
        <th class="mail"  id="1"><p class="text-error">id</p></th>
        <th  id="1"><p class="text-error">civilite</p></th>
        <th  id="1"><p class="text-error">nom</p></th>
        <th   id="1"><p class="text-error">Prénom</p></th>
        <th  id="1"><p class="text-error">email</p></th>
        <th  id="1"><p class="text-error">pays</p></th>
        <th  class="taille" id="1"><p class="text-error">Modifier</p></th>
        <th  class="taille"  id="1"><p class="text-error">Supprimer</p></th>
        <th  class="taille" id="1"><p class="text-error">Afficher</p></th>

    </tr>
    <?php


    include(dirname(__FILE__) . '/../php/connection.php');


        $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : ''; // on recupère la recherche

        if(strlen($recherche) > 2) // si la recherche fait plus de 2 charactères, alors j'active la requete de recherche.
        {
            $where_recherche = " WHERE nom LIKE '%" .$recherche."%' OR prenom LIKE '%" .$recherche."%'";
        }
        else {
            $where_recherche = '';
        }

        // on injecte la recherche si celle-ci existe.

            $nombreContact = 10; // 10 ligne par pages

            $sql1 = "SELECT id FROM utilisateurs ".$where_recherche;

            //echo $sql1;

            $req = $spdo->query($sql1);  //  fais la require
            $count = $req->rowcount();


            $totalPages = ceil($count / $nombreContact); // je  détermine le nombre des pages


        // ça sert  afficher  les messages et je récupere  le numéro

                if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPages) {
                    $_GET['page'] = intval($_GET['page']);
                    $pageCourante = $_GET['page'];
                    // si ça marche je afficher la premier page

                } else {
                    $pageCourante = 1;
                }

                $depart = ($pageCourante - 1) * $nombreContact;





    try {

        $sql = "SELECT id, civilite,nom,prenom,email,pays FROM utilisateurs".$where_recherche." LIMIT $depart,$nombreContact";
        //echo $sql;

        $reponse = $spdo->query($sql);


        if ($reponse) {


            while ($donnees = $reponse->fetch()) {


                echo "</tr>";
                echo "<td>" . $donnees['id'] . "</td>";
                echo "<td>" . $donnees['civilite'] . "</td>";
                echo "<td>" . $donnees['nom'] . "</td>";
                echo "<td>" . $donnees['prenom'] . "</td>";
                echo "<td>" . $donnees['email'] . "</td>";
                echo "<td>" . $donnees['pays'] . "</td>";
                echo "<td><a  class=\"btn btn-primary btn-lg\" data-id=\"" . $donnees['id'] . "\" data-toggle=\"modal\" data-target=\"#exampleModal\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a></td>";
                echo "<td><a  class=\"btn btn-primary btn-lg\" data-id=\"" . $donnees['id'] . "\" data-toggle=\"modal\" data-target=\"#deleteModal\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a></td>";
                echo "<td><a  class=\"btn btn-primary btn-lg\" data-id=\"" . $donnees['id'] . "\" data-toggle=\"modal\" data-target=\"#displayModal\"><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span></a></td>";
                echo "</tr>";
            }


            $reponse->closeCursor();
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());


    }


    ?>

</table>

<?php
for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $pageCourante) {
        echo $i . ' ';
    } else {
        echo '<a  href="index.php?page=' . $i . '">' . $i . '</a> ';
    }
}

?>

<div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <form method="POST" action="php/modifier.php" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Modifier un contact</h4>
                </div>


                <div class="modal-body">
                    <fieldset>
                        <img src=""/>
                        <input type="file" name="photo"/><br/>
                        <label>Civilité</label>
                        <input type="radio" name="civilite" value="Mr" id="Mr" checked="checked"/>
                        <label for="Mr">Mr</label>
                        <input type="radio" name="civilite" value="Mme" id="Mme"/>
                        <label for="Mme">Mme</label>
                        <input type="radio" name="civilite" value="Mlle" id="Mlle"/>
                        <label for="Mlle">Mlle</label>
                        <br>
                        <label> nom :</label>
                        <input type="text" name="nom" placeholder="nom" id="nom" value=""/> <br>
                        <label>prenom :</label>
                        <input type="text" name="prenom" placeholder="prenom" id="prenom" value=""/>
                        <br>
                        <label>e-mail:</label>
                        <input type="email" name="email" placeholder="email" id="email" value=""/>
                        <br>
                        <label>pays</label>
                        <select type="text" name="pays" placeholder="pays"  class="form-control">
                            <option>france</option>
                            <option>italie</option>
                            <option>chili</option>
                            <option>espagne</option>
                            <option>USA</option>
                        </select>
                        <br>
                        <label> adresse :</label>
                        <input type="text" name="adresse" placeholder="adresse" id="adresse" value=""/> <br>
                        <label>spciété :</label>
                        <input type="text" name="societe" placeholder="societe" id="societe" value=""/>
                        <br>
                        <label>telephone</label>
                        <input type="text" name="telephone" placeholder="telephone" id="telephone" value=""/>
                        <br>
                        <label>mobile</label>
                        <input type="text" name="mobile" placeholder="mobile" id="mobile" value=""/>
                        <br>
                        <label>ville</label>
                        <input type="text" name="ville" placeholder="ville" id="ville" value=""/>
                        <br>
                        <input type="hidden" name="id" id="id" value=""/>
                        <span class="fa-stack fa-lg">
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-primary" value="Modifier">
                </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="displayModal">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header"



            <button  class="close" data-dismiss="modal" aria-label="Close"class="fa fa-address-card-o" aria-hidden="true">  </button>
            <h4 class="modal-title" id="displayModal"> {nom}  {prenom}</h4>
            </div>
            <div class="modal-body">
                <p> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">fermer
                </button>
            </div>
        </div>
    </div>
</div>



<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <form method="POST" action="php/modifier.php">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >

                    </button>
                    <h4 class="modal-title" id="deleteModalLabel">Supprimer un contact</h4>
                </div>
                <div class="modal-body">
                    <p>Voulez vous vraiment supprimer ce contact ?</p>
                    <a class="btn btn-primary btn-lg" href="php/delete.php?id=#id">supprimer</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->















