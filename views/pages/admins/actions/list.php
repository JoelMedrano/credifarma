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

        <h3 class="card-title">
            <a class="btn bg-dark btn-sm" href="/admins/new">New Admin</a>
        </h3>

        <div class="card-tools">

            <div class="d-flex">

                <div class="d-flex mr-2">
                    <span class="mr-2">Reports</span>
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
    <!-- /.card-header -->
    <div class="card-body">
        <table id="adminsTable" class="table table-bordered table-striped tableAdmins">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Ruc</th>
                    <th>Sucursal</th>
                    <th>Ciudad</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

        </table>
    </div>
    <!-- /.card-body -->
</div>


<script src="views/assets/custom/datatable/datatable.js"></script>
<script src="views/pages/admins/admins.js"></script>