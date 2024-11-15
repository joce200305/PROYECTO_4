<?php
    
    require_once '../config/conexion.php';
    session_start();

    class Login extends Conexion{
        private function crear_sesion($datos){
            $_SESSION['usuario'] = $datos;            
        }
        public function cerrar_sesion(){
            session_unset();
            session_destroy();
            echo json_encode([1, "Sesión finalizada!"]);
        }
        public function iniciar_sesion(){
            if (empty($_POST['usuario']) || empty($_POST['password'])) {
                echo json_encode([0, "Todos los campos son obligatorios."]);
                return;
            }

            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuario WHERE usuario = :usuario");
            $consulta->bindParam(":usuario", $usuario);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($datos) {
                if (password_verify($password, $datos['password'])) {
                    $this->crear_sesion($datos);
                    echo json_encode([1, "Sesión iniciada!"]);
                } else {
                    echo json_encode([0, "Error en credenciales de acceso!"]);
                }
            } else {
                echo json_encode([0, "Error al buscar información!"]);
            }
        }
    }

    $consulta = new Login();
    $metodo = $_POST['metodo'];
    $consulta->$metodo();

?>
