<?php 

    class DoctoresC {

        public function CrearDoctorC() {

            if (isset($_POST["rolD"])) {

                $tablaBD = "doctores";

                $datosC = array("rol"=>$_POST["rolD"], "apellido"=>$_POST["apellido"], "nombre"=>$_POST["nombre"], "sexo"=>$_POST["sexo"], "id_consultorio"=>$_POST["consultorio"], "usuario"=>$_POST["usuario"], "clave"=>$_POST["clave"]);

                $resultado = DoctoresM::CrearDoctorM($tablaBD, $datosC);

                if ($resultado == true) {

                    echo '<script>
                        window.location = "doctores";    
                    </script>'; 

                }

            }

        }

        static public function VerDoctoresC($columna, $valor) {

            $tablaBD = "doctores";

            $resultado = DoctoresM::VerDoctoresM($tablaBD, $columna, $valor);

            return $resultado;

        }

        /* Editar Doctor */
        static public function DoctorC($columna, $valor) {

            $tablaBD = "doctores";

            $resultado = DoctoresM::DoctorM($tablaBD, $columna, $valor);

            return $resultado;

        }


    }

?>