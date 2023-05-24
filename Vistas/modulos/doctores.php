<?php 

    /* Valida que solo entre a esta vista los que tienen rol Secretaria */
    if ($_SESSION["rol"] != "Secretaria") {

        echo '<script>
            window.location = "inicio";
        </script>';

        return;

    }

?>

<div class="content-wrapper">

    <section class="content-header">

        <h1>Gestor de Doctores</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">

                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CrearDoctor">Crear Doctor</button>

                


            </div>

            <div class="box-body">

                <table class="table table-bordered table-hover table-striped DT">

                    <thead>

                        <tr>

                            <th>N°</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Foto</th>
                            <th>Consultorio</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Editar / Borrar</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php 
                        
                            $columna = null;
                            $valor = null;

                            $resultado = DoctoresC::VerDoctoresC($columna, $valor);

                            foreach ($resultado as $key => $value) {

                                echo '<tr>

                                        <td>' . ($key+1) . '</td>
                                        <td>' . $value["apellido"] . '</td>
                                        <td>' . $value["nombre"] . '</td>';

                                        if ($value["foto"] == "") {
                                            echo '<td><img src="Vistas/img/defecto.png" width="40px"></td>';
                                        } else {
                                            echo '<td><img src="' . $value["foto"] . '" width="40px"></td>';
                                        }

                                        $columna = "id";
                                        $valor = $value["id_consultorio"];

                                        $consultorio = ConsultoriosC::VerConsultoriosC($columna, $valor);

                                        echo '<td>' . $consultorio["nombre"] . '</td>
                                        
                                        <td>' . $value["usuario"] . '</td>

                                        <td>' . $value["clave"] . '</td>
                                    
                                        <td>
            
                                            <div class="btn-group">
                                    
                                                <button class="btn btn-success EditarDoctor" Did="' . $value["id"] . '" data-toggle="modal" data-target="#EditarDoctor"><i class="fa fa-pencil"></i> Editar</button>
                                                
                                                <a href="http://localhost/clinica/consultorios/' . $value["id"] . '">
                                                    <button class="btn btn-danger"><i class="fa fa-times"></i> Borrar</button>
                                                </a>
                                                
            
                                            </div>
            
                                        </td>
                                        
                                    </tr>';

                            }
                        ?>

                        

                    </tbody>


                </table>

            </div>

        </div>

    </section>

</div>

<!-- Modal para crear un Doctor -->
<div class="modal fade" rol="dialog" id="CrearDoctor">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" role="form">
                <div class="modal-body">
                    <div class="box-body">
                        
                        <!-- Apellido del Doctor-->
                        <div class="form-group">
                            <h3>Apellido: </h3>
                            <input type="text" class="form-control" name="apellido" required>
                            <!-- Rol del Doctor -->
                            <input type="hidden" name="rolD" value="Doctor">
                        </div>  
                        
                        <!-- Nombre del Doctor -->
                        <div class="form-group">
                            <h3>Nombre: </h3>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        
                        <!-- Sexo del Doctor -->
                        <div class="form-group">
                            <h3>Sexo:</h3>
                            <select class="form-control" name="sexo">
                                <option>Seleccionar...</option>

                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                        
                        <!-- Consultorio del Doctor -->
                        <div class="form-group">
                            <h3>Consultorio:</h3>
                            <select class="form-control" name="consultorio">
                                <option>Seleccionar...</option>

                                <?php 
                                    $columna = null;
                                    $valor = null;
                                    $resultado = ConsultoriosC::VerConsultoriosC($columna, $valor);

                                    foreach ($resultado as $key => $value) {

                                        echo '<option value="' .  $value["id"] . '">' . $value["nombre"] . '</option>';
                                    }
                                
                                ?>
                            </select>
                        </div>

                        <!-- Usuario del Doctor -->
                        <div class="form-group">
                            <h3>Usuario: </h3>
                            <input type="text" class="form-control" name="usuario" required>
                        </div> 

                        <!-- Contraseña del Doctor -->
                        <div class="form-group">
                            <h3>Contraseña: </h3>
                            <input type="text" class="form-control" name="clave" required>
                        </div>        

                    </div><!-- /.box-body -->
                </div><!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

                <?php 

                    /* Permite Crear un Doctor con los datos del formulario definido en el Modal para
                    crear un doctor. */
                    $crear = new DoctoresC();
                    $crear->CrearDoctorC();
                
                ?>
            </form>

        </div>
    </div>
</div>

<!-- Modal para editar un Doctor -->
<div class="modal fade" rol="dialog" id="EditarDoctor">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" role="form">
                <div class="modal-body">
                    <div class="box-body">
                        
                        <!-- Apellido del Doctor-->
                        <div class="form-group">
                            <h3>Apellido: </h3>
                            <input type="text" class="form-control" id="apellidoE" name="apellidoE" required>

                            <!-- ID del Doctor -->
                            <input type="hidden" name="Did">
                        </div>  
                        
                        <!-- Nombre del Doctor -->
                        <div class="form-group">
                            <h3>Nombre: </h3>
                            <input type="text" class="form-control" id="nombreE" name="nombreE" required>
                        </div>
                        
                        <!-- Sexo del Doctor -->
                        <div class="form-group">
                            <h3>Sexo:</h3>
                            <select class="form-control" name="sexoE" required>
                                <option id="sexoE"></option>

                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                        
                        <!-- Consultorio del Doctor -->
                        <div class="form-group">
                            <h3>Consultorio:</h3>
                            <select class="form-control" name="consultorioE" required>
                                <option>Seleccionar...</option>

                                <?php 
                                    $columna = null;
                                    $valor = null;
                                    $resultado = ConsultoriosC::VerConsultoriosC($columna, $valor);

                                    foreach ($resultado as $key => $value) {

                                        echo '<option value="' .  $value["id"] . '">' . $value["nombre"] . '</option>';
                                    }
                                
                                ?>
                            </select>
                        </div>

                        <!-- Usuario del Doctor -->
                        <div class="form-group">
                            <h3>Usuario: </h3>
                            <input type="text" class="form-control" id="usuarioE" name="usuarioE" required>
                        </div> 

                        <!-- Contraseña del Doctor -->
                        <div class="form-group">
                            <h3>Contraseña: </h3>
                            <input type="text" class="form-control" id="claveE" name="claveE" required>
                        </div>        

                    </div><!-- /.box-body -->
                </div><!-- /.modal-body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

                <?php 

                    /* Permite Crear un Doctor con los datos del formulario definido en el Modal para
                    crear un doctor. */
                    /* $crear = new DoctoresC();
                    $crear->CrearDoctorC(); */
                
                ?>
            </form>

        </div>
    </div>
</div>

<?php 

    /* $borrarC = new ConsultoriosC();
    $borrarC->BorrarConsultorioC(); */

?>
