<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h3 class="modal-title" id="exampleModalLabel">REGISTROS</h3>
                <button type="button" class="btn " data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Tarjeta de identidad</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>

                            </div>
                        </div>
                    </div>




                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Archivo (PDF)</label>
                        <input type="file" name="archivo" id="archivo" class="form-control" required>

                    </div>

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success    " id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>