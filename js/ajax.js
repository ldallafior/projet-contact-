// conformation du  formulaire
// conformation du  formulaire
$(function() { /// On attend que la page ait finis de se charger pour déclencher le javascript

    //>Modifier un contact

    $("#exampleModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

            console.log(id);

                        $.ajax({ // le lien de la page qui fais le javascritpt
            url: 'http://localhost:8888/phpcontact/html/ajax_select_modifier.php?id=' + id,
            method: 'GET'
        }).success(function (reponse) {

            console.log(reponse);

            var response = JSON.parse(reponse);
            // le html et  le javacdipt qui fais marche

            $(event.currentTarget).find('input[name="id"]').val(id);
            $(event.currentTarget).find('input[name="civilite"]').val(response.civilite);
            $(event.currentTarget).find('input[name="nom"]').val(response.nom);
            $(event.currentTarget).find('input[name="prenom"]').val(response.prenom);
            $(event.currentTarget).find('input[name="email"]').val(response.email);
            $(event.currentTarget).find('input[name="pays"]').val(response.pays);
            $(event.currentTarget).find('input[name="adresse"]').val(response.adresse);
            $(event.currentTarget).find('input[name="societe"]').val(response.societe);
            $(event.currentTarget).find('input[name="mobile"]').val(response.mobile);
            $(event.currentTarget).find('input[name="ville"]').val(response.ville);
            $(event.currentTarget).find('img').attr('src','http://localhost:8888/phpcontact' + response.photo);
        });

    });

    $("#displayModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        console.log(id);

        $.ajax({ // le lien de la page qui fais le javascritpt
            url: 'http://localhost:8888/phpcontact/html/ajax_select_modifier.php?id=' + id,
            method: 'GET'
        }).success(function (reponse) {

            console.log(reponse)

            var templateHeader = "{nom} {prenom}"; //afficher les contact
            var template = "<img src=''/> <br> {civilite}<br>{email} <br>{pays}<br> {adresse} <br> {societe} <br>{mobile} <br>{ville}";

            var response = JSON.parse(reponse);
            // le html et  le javacdipt qui fais marche

            templateHeader = templateHeader.replace("{nom}",response.nom);
            templateHeader = templateHeader.replace("{prenom}",response.prenom);

            template = template.replace("{civilite}",response.civilite);
            template = template.replace("{email}",response.email);
            template = template.replace("{pays}",response.pays);
            template = template.replace("{adresse}",response.adresse);
            template = template.replace("{societe}",response.societe);
            template = template.replace("{mobile}",response.mobile);
            template = template.replace("{ville}",response.ville);
            $(event.currentTarget).find('h4')[0].innerHTML = templateHeader;
            $(event.currentTarget).find('p')[0].innerHTML = template;
            $(event.currentTarget).find('img').attr('src','http://localhost:8888/phpcontact' + response.photo);
        });


    });

    // la modal de delete

    $("#deleteModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        $("a[href]")
            .each(function()
        {
            this.href = this.href.replace(/#id/, id);
        });



    });

   ;
});