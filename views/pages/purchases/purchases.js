//*agregar materia primas
$(".tableArticlesPurchases tbody").on(
    "click",
    "button.agregarCompra",
    function () {
        var idArticle = $(this).attr("idArticle");
        var idCompany = document.getElementById("sucursal").value;

        var data = new FormData();
        data.append("rel", "articles,laboratories");
        data.append("type", "article,laboratory");
        data.append(
            "select",
            "id_article,name_article,frac_article,name_laboratory"
        );
        data.append("linkTo", "id_article");
        data.append("equalTo", idArticle);
        data.append("orderBy", "id_article");
        data.append("orderMode", "asc");
        data.append("startAt", "0");
        data.append("endAt", "1");

        $.ajax({
            url: "ajax/ajax-select.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                var articles = response.results;
                var id_article = articles[0]["id_article"];
                var name_article = articles[0]["name_article"];
                var frac_article = articles[0]["frac_article"];
                var name_laboratory = articles[0]["name_laboratory"];

                //*Inicio Artcom
                var dataArtCom = new FormData();
                dataArtCom.append("rel", "artscoms,companies");
                dataArtCom.append("type", "artcom,company");
                dataArtCom.append("select", "id_artcom,full_price_artcom");
                dataArtCom.append(
                    "linkTo",
                    "id_article_artcom,id_company_artcom"
                );
                dataArtCom.append("equalTo", idArticle + "," + idCompany);
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
                        var artcom = JSON.parse(response);
                        if (artcom.status == 200) {
                            /* $("#" + idArticle).removeClass(
                                "btn-primary agregarCompra"
                            );
                            $("#" + idArticle).addClass("btn-default"); */
                            $(".nuevoDetalleCompra").append(
                                '<div class="row mt-1">' +
                                    "<!-- Descripción del artículo -->" +
                                    '<div class="col-lg-3">' +
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-sm quitarArticulo" idArticle="' +
                                    id_article +
                                    '"><i class="fa fa-times"></i></button></span>' +
                                    '<textarea type="text" class="form-control form-control-sm nuevaDescripcionArticulo" style="font-size:12px" rows="2" idArticle="' +
                                    id_article +
                                    '" readonly>' +
                                    name_article +
                                    " - " +
                                    name_laboratory +
                                    " - PV S/ " +
                                    artcom.results[0]["full_price_artcom"] +
                                    "</textarea>" +
                                    "</div>" +
                                    "</div>" +
                                    "<!-- Cantidad -->" +
                                    '<div class="col-lg-1 ingresoCantidad" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevaCantidadArticulo" name="nuevaCantidadArticulo" min="0">' +
                                    "</div>" +
                                    "<!-- Faccion -->" +
                                    '<div class="col-lg-1 ingresoFraccion" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevaFraccionArticulo" name="nuevaFraccionArticulo" min="0" fracArticle="' +
                                    frac_article +
                                    '">' +
                                    "</div>" +
                                    "<!-- Precio sin igv -->" +
                                    '<div class="col-lg-1 ingresoPrecioSinIGV" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevoPrecioArticuloSinIGV" min="0" required>' +
                                    "</div>" +
                                    "<!-- Precio con igv -->" +
                                    '<div class="col-lg-1 ingresoPrecioConIGV" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevoPrecioArticuloConIGV" min="0" readonly>' +
                                    "</div>" +
                                    "<!-- Descuento -->" +
                                    '<div class="col-lg-1 ingresoDescuento" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevoDescuentoArticulo" min="0" value="0" max="100">' +
                                    "</div>" +
                                    "<!-- Total -->" +
                                    '<div class="col-lg-1 ingresoTotal" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevoTotalArticulo" min="0" total="0" readonly>' +
                                    "</div>" +
                                    "<!-- Utilidad -->" +
                                    '<div class="col-lg-1 ingresoUtilidad" style="padding-left:0px">' +
                                    '<input type="number" step="any" class="form-control form-control-sm nuevoUtilidadArticulo" pv="' +
                                    artcom.results[0]["full_price_artcom"] +
                                    '" readonly>' +
                                    "</div>" +
                                    "<!-- Fecha Vencimiento -->" +
                                    '<div class="col-lg-1 ingresoFV" style="padding-left:0px">' +
                                    '<input type="date" class="form-control form-control-sm nuevoFVArticulo" style="font-size:10px">' +
                                    "</div>" +
                                    "<!-- Lote -->" +
                                    '<div class="col-lg-1 ingresoLote" style="padding-left:0px">' +
                                    '<input type="text" class="form-control form-control-sm nuevoLoteArticulo">' +
                                    "</div>" +
                                    "</div>"
                            );
                            listarCompras();
                            sumarTotalPrecios();
                        } else {
                            fncNotie(
                                3,
                                "Debe seleccionar la sucursal para calcular el margen de  utilidad"
                            );
                        }
                    },
                });
                //*Fin Artcom
            },
        });
    }
);

//*quitar articulo
var idQuitarArticulo = [];
localStorage.removeItem("quitarArticulo");
$(".formularioCompras").on("click", "button.quitarArticulo", function () {
    $(this).parent().parent().parent().parent().remove();

    var idArticle = $(this).attr("idArticle");

    if (localStorage.getItem("quitarArticulo") == null) {
        idQuitarArticulo = [];
    } else {
        idQuitarArticulo.concat(localStorage.getItem("quitarArticulo"));
    }

    idQuitarArticulo.push({
        idArticle: idArticle,
    });

    localStorage.setItem("quitarArticulo", JSON.stringify(idQuitarArticulo));

    $("button.recuperarCompra[idArticle='" + idArticle + "']").removeClass(
        "btn-default"
    );

    $("button.recuperarCompra[idArticle='" + idArticle + "']").addClass(
        "btn-primary agregarCompra"
    );

    if ($(".nuevoDetalleCompra").children().length == 0) {
        $("#jsonDetalleCompra").val("");
    } else {
        listarCompras();
        sumarTotalPrecios();
    }
});

//*Cuando cargue la tabla cada vez que navegue en ella
$(".tableArticlesPurchases").on("draw.dt", function () {
    if (localStorage.getItem("quitarArticulo") != null) {
        var listaCodigoArticulo = JSON.parse(
            localStorage.getItem("quitarArticulo")
        );

        for (var i = 0; i < listaCodigoArticulo.length; i++) {
            $(
                "button.quitarArticulo[idArticle='" +
                    listaCodigoArticulo[i]["idArticle"] +
                    "']"
            ).removeClass("btn-default");

            $(
                "button.quitarArticulo[idArticle='" +
                    listaCodigoArticulo[i]["idArticle"] +
                    "']"
            ).addClass("btn-primary agregarCompra");
        }
    }
});

//*cuando se cambien las cantidad
$(".formularioCompras").on(
    "change",
    "input.nuevaCantidadArticulo,input.nuevoPrecioArticuloSinIGV,input.nuevoDescuentoArticulo,input.nuevoFVArticulo, input.nuevoLoteArticulo",
    function () {
        var undCant = $(this)
            .parent()
            .parent()
            .children(".ingresoCantidad")
            .children(".nuevaCantidadArticulo")
            .val();

        var fraccionDato = $(this)
            .parent()
            .parent()
            .children(".ingresoFraccion")
            .children(".nuevaFraccionArticulo");

        var undFrac = fraccionDato.val();

        var frac = fraccionDato.attr("fracarticle");

        var ps = $(this)
            .parent()
            .parent()
            .children(".ingresoPrecioSinIGV")
            .children(".nuevoPrecioArticuloSinIGV")
            .val();

        var descuento = $(this)
            .parent()
            .parent()
            .children(".ingresoDescuento")
            .children(".nuevoDescuentoArticulo")
            .val();

        var utilidad = $(this)
            .parent()
            .parent()
            .children(".ingresoUtilidad")
            .children(".nuevoUtilidadArticulo");
        var pv = utilidad.attr("pv");

        if (frac == 0) {
            fncNotie(3, "No esta definida la cantidad por fracción");
            var nuevoTotal =
                Number(ps) *
                Number(undCant) *
                ((100 - Number(descuento)) / 100) *
                1.18;
        } else {
            frac;
            var nuevoTotal =
                (Number(ps) * Number(undCant) +
                    (Number(ps) / Number(frac)) * Number(undFrac)) *
                ((100 - Number(descuento)) / 100) *
                1.18;
        }
        var total = $(this)
            .parent()
            .parent()
            .children(".ingresoTotal")
            .children(".nuevoTotalArticulo");

        total.val(nuevoTotal.toFixed(2));

        var precioCIGV = $(this)
            .parent()
            .parent()
            .children(".ingresoPrecioConIGV")
            .children(".nuevoPrecioArticuloConIGV");

        var pc = ps * 1.18;

        precioCIGV.val(pc.toFixed(2));

        var nuevaUtilidad = pv - pc;

        if (nuevaUtilidad > 0) {
            utilidad.addClass("is-valid");
            utilidad.removeClass("is-invalid");
        } else {
            utilidad.removeClass("is-valid");
            utilidad.addClass("is-invalid");
        }

        utilidad.val(nuevaUtilidad.toFixed(2));

        listarCompras();
        sumarTotalPrecios();
    }
);

//*json de compras
function listarCompras() {
    var listaCompra = [];

    var articulo = $(".nuevaDescripcionArticulo");
    var cantidad = $(".nuevaCantidadArticulo");
    var fraccion = $(".nuevaFraccionArticulo");
    var preciosigv = $(".nuevoPrecioArticuloSinIGV");
    var preciocigv = $(".nuevoPrecioArticuloConIGV");
    var descuento = $(".nuevoDescuentoArticulo");
    var total = $(".nuevoTotalArticulo");
    var utilidad = $(".nuevoUtilidadArticulo");
    var vencimiento = $(".nuevoFVArticulo");
    var lote = $(".nuevoLoteArticulo");

    for (var i = 0; i < articulo.length; i++) {
        listaCompra.push({
            id_article: $(articulo[i]).attr("idArticle"),
            cantidad: $(cantidad[i]).val(),
            fraccion: $(fraccion[i]).val(),
            preciosigv: $(preciosigv[i]).val(),
            preciocigv: $(preciocigv[i]).val(),
            descuento: $(descuento[i]).val(),
            total: $(total[i]).val(),
            utilidad: $(utilidad[i]).val(),
            vencimiento: $(vencimiento[i]).val(),
            lote: $(lote[i]).val(),
        });
    }

    /* console.log("jsonDetalleCompra", JSON.stringify(listaCompra)); */
    $("#jsonDetalleCompra").val(JSON.stringify(listaCompra));
}

//*SUMAR TODOS LOS PRECIOS
function sumarTotalPrecios() {
    var precioItem = $(".nuevoTotalArticulo");

    var arraySumaPrecioT = [];

    for (var i = 0; i < precioItem.length; i++) {
        arraySumaPrecioT.push(Number($(precioItem[i]).val()));
    }

    function sumaArrayPrecios(total, numero) {
        return total + numero;
    }

    var sumaTotalPrecio = arraySumaPrecioT.reduce(sumaArrayPrecios, 0);

    $("#total").val(sumaTotalPrecio.toFixed(2));
}
