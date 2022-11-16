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
    $("p").remove(".similarBorrar");
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

            document.getElementById("picture_category").src =
                "views/img/categories/" +
                articles.results[0]["id_category_article"] +
                "/" +
                articles.results[0]["id_category_article"] +
                ".png";

            document.getElementById("name_article").innerHTML =
                articles.results[0]["code_article"] +
                " - " +
                articles.results[0]["name_article"];

            if (articles.results[0]["prescription_article"] == "SI") {
                document
                    .getElementById("prescription_article")
                    .classList.remove("text-success");
                document
                    .getElementById("prescription_article")
                    .classList.add("text-danger");

                document.getElementById("prescription_article").innerHTML =
                    articles.results[0]["prescription_article"];
            } else {
                document
                    .getElementById("prescription_article")
                    .classList.remove("text-danger");
                document
                    .getElementById("prescription_article")
                    .classList.add("text-success");

                document.getElementById("prescription_article").innerHTML =
                    articles.results[0]["prescription_article"];
            }

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
            dataArtCom.append("orderBy", "id_artcom");
            dataArtCom.append("orderMode", "asc");
            dataArtCom.append("startAt", "0");
            dataArtCom.append("endAt", "1");

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

                    if (therapies.status == 404) {
                        document.getElementById("name_therapy").innerHTML = "";
                    } else {
                        document.getElementById("name_therapy").innerHTML =
                            therapies.results[0]["code_therapy"] +
                            " - " +
                            therapies.results[0]["name_therapy"];
                    }
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

                    if (substances.status == 404) {
                        document.getElementById("name_substance").innerHTML =
                            "";
                    } else {
                        document.getElementById("name_substance").innerHTML =
                            substances.results[0]["code_substance"] +
                            " - " +
                            substances.results[0]["name_substance"];
                    }
                },
            });
            //*fin Substance

            //*Inicio Similar
            var dataSimilar = new FormData();
            dataSimilar.append("rel", "articles,therapies");
            dataSimilar.append("type", "article,therapy");
            dataSimilar.append(
                "select",
                "id_article,code_article,name_article,id_therapy_article"
            );
            dataSimilar.append("linkTo", "id_therapy_article");
            dataSimilar.append(
                "equalTo",
                articles.results[0]["id_therapy_article"]
            );
            dataSimilar.append("orderBy", "frac_stock_article");
            dataSimilar.append("orderMode", "desc");
            dataSimilar.append("startAt", "0");
            dataSimilar.append("endAt", "10");

            $.ajax({
                url: "ajax/ajax-select.php",
                method: "POST",
                data: dataSimilar,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    var substances = JSON.parse(response);

                    if (substances.status == 404) {
                        ('<p class="p-0 m-0 similarBorrar" id="similarBorrar"></p>');
                    } else {
                        for (let i = 0; i < substances.results.length; i++) {
                            $(".similares").append(
                                '<p class="p-0 m-0 similarBorrar" id="similarBorrar">' +
                                    substances.results[i]["code_article"] +
                                    " - " +
                                    substances.results[i]["name_article"] +
                                    "</p>"
                            );
                        }
                    }
                },
            });
            //*Fin Similar
        },
    });
});

/*=============================================
Importar articulos a la lista de disponibles
=============================================*/
function importArticle(event, idDbArticle) {
    if (event.target.checked) {
        var state = "2";
    } else {
        var state = "1";
    }

    var data = new FormData();
    data.append("dbstate", state);
    data.append("idDbArticle", idDbArticle);
    data.append("dbtoken", localStorage.getItem("token_user"));

    $.ajax({
        url: "ajax/articles/ajax-articles.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            fncSweetAlert(
                "success",
                "Your records were created successfully",
                "/articles/import"
            );
        },
    });
}
