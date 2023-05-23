<?php 

    require_once "ConexionBD.php";

    

    class SecretariasM extends ConexionBD {

        /* Ingreso Secretarias */
        static public function IngresarSecretariaM($tablaBD, $datosC) {

            $pdo = ConexionBD::cBD()->prepare("SELECT usuario, clave, nombre, apellido, foto, rol, id FROM $tablaBD WHERE usuario = :usuario");

            $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR); /* Parametro de tipo String */

            $pdo->execute();

            return $pdo->fetch();

            $pdo->close();

            $pdo = null;

        }

        /* Ver Perfil Secretaria */
        /* Obtiene un registro de la tabla Secretarias mediante el id obtenido de la sesión. */
        static public function VerPerfilSecretariaM($tablaBD, $id) {

            $pdo = ConexionBD::cBD()->prepare("SELECT usuario, clave, nombre, apellido, foto, rol, id FROM $tablaBD WHERE id = :id");

            $pdo->bindParam(":id", $id, PDO::PARAM_INT); /* Parametro de tipo entero */

            $pdo->execute();

            return $pdo->fetch();

            $pdo->close();

            $pdo = null;

        }

        /* Actualizar Perfil Secretaria */
        static public function ActualizarPerfilSecretariaM($tablaBD, $datosC) {

            $pdo = ConexionBD::cBD()->prepare("UPDATE $tablaBD SET usuario = :usuario, clave = :clave, nombre = :nombre, apellido = :apellido, foto = :foto WHERE id = :id");

            $pdo->bindParam(":id", $datosC["id"], PDO::PARAM_INT);
            $pdo->bindParam(":usuario", $datosC["usuario"], PDO::PARAM_STR);
            $pdo->bindParam(":clave", $datosC["clave"], PDO::PARAM_STR);
            $pdo->bindParam(":nombre", $datosC["nombre"], PDO::PARAM_STR);
            $pdo->bindParam(":apellido", $datosC["apellido"], PDO::PARAM_STR);
            $pdo->bindParam(":foto", $datosC["foto"], PDO::PARAM_STR);

            if ($pdo->execute()) {

                return true;

            } else {

                return false;
            }

            $pdo->close();
            $pdo = null;
        }

    }