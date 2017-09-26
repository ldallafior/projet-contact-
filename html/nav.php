
<nav align="center" class="navbar navbar-inverse">

    <h1 style="color: white">PHP contact</h1>



    <form  method="post" class="navbar-form navbar-right inline-form">
        <div class="form-group">
            <form method="POST" action="index.php">
                <input type="search" name="recherche" class="input-sm form-control" placeholder="Recherche" value="<?=$_POST['recherche']?>">
                <input type="submit" value="Ok">
            </form>
        </div>
    </form>
    <div class="bouton">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            +Ajouter un nouveau contact
        </button>


        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <form method="POST" action="php/insert.php" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Ajouter un contact</h4>
                        </div>
                        <div class="modal-body">

                            <fieldset>
                                <input type="file" name="photo" /><br />
                                <label>Civilité</label>
                                <input type="radio" name="civilite" value="Mr" id="Mr" checked="checked"/>
                                <label for="Mr">Mr</label>
                                <input type="radio" name="civilite" value="Mme" id="Mme"/>
                                <label for="Mme">Mme</label>
                                <input type="radio" name="civilite" value="Mlle" id="Mlle"/>
                                <label for="Mlle">Mlle</label>
                                <br>
                                <label> nom :</label>
                                <input type="text" name="nom" placeholder="nom"/> <br>
                                <label>prenom :</label>
                                <input type="text" name="prenom" placeholder="prenom" </input>
                                <br>


                                <label>e-mail:</label>
                                <input type="email" name="email" placeholder="email"  </input>
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
                                <label>société :</label>
                                <input type="text" name="societe" placeholder="socete" id="societe" value=""/>
                                <br>
                                <label>telephone</label>
                                <input type="text" name="telephone" placeholder="telephone" id="telephone" value="" />
                                <br>
                                <label>mobile</label>
                                <input type="text" name="mobile" placeholder="mobile" id="mobile" value="" />
                                <br>
                                <label>ville</label>
                                <input type="text" name="ville" placeholder="ville" id="ville" value="" />
                                <br>
                              
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <input type="submit" class="btn btn-primary" value="Ajouter">
                        </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</nav>
