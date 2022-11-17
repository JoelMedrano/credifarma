<?php


if (isset($_GET["start"]) && isset($_GET["end"])) {

    $between1 = $_GET["start"];
    $between2 = $_GET["end"];
} else {

    $between1 = date("Y-m-d", strtotime("-100000 day", strtotime(date("Y-m-d"))));
    $between2 = date("Y-m-d");
}

?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">

<div class="card">
    <div class="card-header">

        <div class="card-tools">

            <div class="d-flex">

                <div class="d-flex mr-2">
                    <span class="mr-2">Reportes</span>
                    <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-size="mini" data-handle-width="70" onchange="reportActive(event)">
                </div>

            </div>

        </div>

    </div>

    <div class="form-group row">

        <div class="col-lg-12">

            <div class="card-body">
                <table id="adminsTable" class="table table-bordered table-striped tableDbArticles">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Laboratorio</th>
                            <th>Prescripción</th>
                            <th>Importar</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

</div>
</div>

<script src="views/assets/custom/datatable/datatable.js"></script>
<script src="views/pages/articles/articles.js"></script>

<script>
    window.document.title = "Artículos Importar"
</script>