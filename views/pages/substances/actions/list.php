<?php

if (isset($_GET["start"]) && isset($_GET["end"])) {

    $between1 = $_GET["start"];
    $between2 = $_GET["end"];
} else {

    $between1 = date("Y-m-d", strtotime("-29 day", strtotime(date("Y-m-d"))));
    $between2 = date("Y-m-d");
}

?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">

<div class="card">
    <div class="card-header">

        <?php if ($_SESSION["admin"]->rol_user == "administrador") : ?>

            <h3 class="card-title">
                <a class="btn bg-dark btn-sm" href="/substances/new">Nueva Sustancia Activa</a>
            </h3>

        <?php endif ?>

        <div class="card-tools">

            <div class="d-flex">

                <div class="d-flex mr-2">
                    <span class="mr-2">Reportes</span>
                    <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-size="mini" data-handle-width="70" onchange="reportActive(event)">
                </div>

                <div class="input-group">
                    <button type="button" class="btn float-right" id="daterange-btn">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <?php echo $between1 ?> - <?php echo $between2 ?>
                        <i class="fas fa-caret-down ml-2"></i>
                    </button>
                </div>

            </div>

        </div>

    </div>

    <div class="form-group row">

        <div class="col-lg-9">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="adminsTable" class="table table-bordered table-striped tableSubstances">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>

        <div class="col-lg-3">

            <hr>
            <!-- About Me Box -->
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Disponible</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Alternativas</strong>

                    <div class="form-group similares" id="similares">

                    </div>
                    <hr>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>


<script src="views/assets/custom/datatable/datatable.js"></script>
<script src="views/pages/substances/substances.js"></script>

<script>
    window.document.title = "Sustancias"
</script>