/*=============================================
Cambiar estado del laboratorio
=============================================*/
function changeState(event, idArticle) {
    if (event.target.checked) {
        var state = "1";
    } else {
        var state = "0";
    }

    var data = new FormData();
    data.append("state", state);
    data.append("idArticle", idArticle);
    data.append("token", localStorage.getItem("token_user"));

    $.ajax({
        url: "ajax/articles/ajax-articles.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response == 200) {
                fncNotie(1, "the record was updated");
            } else {
                fncNotie(3, "Error updating registry");
            }
        },
    });
}

//*Ver el perfil del articulo
$(document).on("click", ".articuloPerfil", function () {
    var id_article = $(this).attr("idItem");

    var data = new FormData();
    data.append("data", id_article);
    data.append("select", "*");
    data.append("table", "articles");
    data.append("suffix", "id_article");

    $.ajax({
        url: "ajax/ajax-select.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            var articles = JSON.parse(response);
            document.getElementById("name_article").innerHTML =
                articles.results[0]["code_article"] +
                " - " +
                articles.results[0]["name_article"];

            //*Inicio Laboratory
            var dataLaboratory = new FormData();
            dataLaboratory.append(
                "data",
                articles.results[0]["id_laboratory_article"]
            );
            dataLaboratory.append("select", "*");
            dataLaboratory.append("table", "laboratories");
            dataLaboratory.append("suffix", "id_laboratory");

            $.ajax({
                url: "ajax/ajax-select.php",
                method: "POST",
                data: dataLaboratory,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var laboratories = JSON.parse(response);
                    document.getElementById("name_laboratory").innerHTML =
                        laboratories.results[0]["code_laboratory"] +
                        " - " +
                        laboratories.results[0]["name_laboratory"];
                },
            });
            //*fin Laboratory

            //*Inicio Artcom
            var dataArtCom = new FormData();
            dataArtCom.append("rel", "artscoms,companies");
            dataArtCom.append("type", "artcom,company");
            dataArtCom.append(
                "select",
                "id_artcom,id_article_artcom,id_company_artcom,frac_price_artcom,frac_stock_artcom,full_price_artcom,full_stock_artcom"
            );
            dataArtCom.append("linkTo", "id_article_artcom,id_company_artcom");
            dataArtCom.append(
                "equalTo",
                id_article + "," + localStorage.getItem("company")
            );

            $.ajax({
                url: "ajax/ajax-select.php",
                method: "POST",
                data: dataArtCom,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var artscoms = JSON.parse(response);

                    var full_stock_artcom =
                        artscoms.results[0]["full_stock_artcom"];
                    document.getElementById("full_stock_artcom").innerHTML =
                        full_stock_artcom;

                    var full_price_artcom =
                        artscoms.results[0]["full_price_artcom"];
                    document.getElementById("full_price_artcom").innerHTML =
                        new Intl.NumberFormat("es-PE", {
                            style: "currency",
                            currency: "PEN",
                        }).format(full_price_artcom);

                    var frac_stock_artcom =
                        artscoms.results[0]["frac_stock_artcom"];
                    document.getElementById("frac_stock_artcom").innerHTML =
                        frac_stock_artcom;

                    var frac_price_artcom =
                        artscoms.results[0]["frac_price_artcom"];
                    document.getElementById("frac_price_artcom").innerHTML =
                        new Intl.NumberFormat("es-PE", {
                            style: "currency",
                            currency: "PEN",
                        }).format(frac_price_artcom);
                },
            });
            //*Fin Artcom

            //*Inicio Therapy
            var dataTherapy = new FormData();
            dataTherapy.append(
                "data",
                articles.results[0]["id_therapy_article"]
            );
            dataTherapy.append("select", "*");
            dataTherapy.append("table", "therapies");
            dataTherapy.append("suffix", "id_therapy");

            $.ajax({
                url: "ajax/ajax-select.php",
                method: "POST",
                data: dataTherapy,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var therapies = JSON.parse(response);
                    document.getElementById("name_therapy").innerHTML =
                        therapies.results[0]["name_therapy"];
                },
            });
            //*fin Therapy

            //*Inicio Substance
            var dataSubstance = new FormData();
            dataSubstance.append(
                "data",
                articles.results[0]["id_substance_article"]
            );
            dataSubstance.append("select", "*");
            dataSubstance.append("table", "substances");
            dataSubstance.append("suffix", "id_substance");

            $.ajax({
                url: "ajax/ajax-select.php",
                method: "POST",
                data: dataSubstance,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var substances = JSON.parse(response);
                    document.getElementById("name_substance").innerHTML =
                        substances.results[0]["name_substance"];
                },
            });
            //*fin Substance
        },
    });
});
