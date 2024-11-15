<?php
    require_once '../config/conexion.php';

    class Productos extends Conexion {
        
        public function obtener_datos() {
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_producto");
            $consulta->execute();
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->cerrar_conexion();
            echo json_encode($datos);
        }

        public function insertar_datos() {
            if (empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['unidades'])) {
                echo json_encode([0, "Todos los campos son obligatorios."]);
                return;
            }

            if (!is_numeric($_POST['precio']) || !is_numeric($_POST['unidades'])) {
                echo json_encode([0, "El precio y las unidades deben ser números."]);
                return;
            }

            $producto = $_POST['producto'];
            $precio = $_POST['precio'];
            $unidades = $_POST['unidades'];

            $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_producto(producto, precio, unidades) VALUES(:producto, :precio, :unidades)");
            $insercion->bindParam(':producto', $producto);
            $insercion->bindParam(':precio', $precio);
            $insercion->bindParam(':unidades', $unidades);
            $insercion->execute();

            if ($insercion) {
                echo json_encode([1, "Inserción correcta"]);
            } else {
                echo json_encode([0, "Inserción no realizada"]);
            }
        }

        public function actualizar_datos() {
            if (empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['unidades'])) {
                echo json_encode([0, "Todos los campos son obligatorios."]);
                return;
            }

            if (!is_numeric($_POST['precio']) || !is_numeric($_POST['unidades'])) {
                echo json_encode([0, "El precio y las unidades deben ser números."]);
                return;
            }

            $producto = $_POST['producto'];
            $precio = $_POST['precio'];
            $unidades = $_POST['unidades'];
            $id_producto = $_POST['id_producto'];

            $actualizacion = $this->obtener_conexion()->prepare("UPDATE t_producto SET producto = :producto, precio = :precio, unidades = :unidades WHERE id_producto = :id_producto");
            $actualizacion->bindParam(':producto', $producto);
            $actualizacion->bindParam(':precio', $precio);
            $actualizacion->bindParam(':unidades', $unidades);
            $actualizacion->bindParam(':id_producto', $id_producto);

            if ($actualizacion->execute()) {
                echo json_encode([1, "Actualización correcta", $id_producto]);
            } else {
                echo json_encode([0, "Actualización no realizada"]);
            }
        }

        public function eliminar_datos() {
            $eliminar = $this->obtener_conexion()->prepare("DELETE FROM t_producto WHERE id_producto = :id_producto");
            $id_producto = $_POST['id_producto'];
            $eliminar->bindParam(':id_producto', $id_producto);
            $eliminar->execute();

            if ($eliminar) {
                echo json_encode([1, "Eliminación correcta"]);
            } else {
                echo json_encode([0, "Eliminación no realizada"]);
            }
        }

        public function precargar_datos() {
            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_producto WHERE id_producto = :id_producto");
            $id_producto = $_POST['id_producto'];
            $consulta->bindParam("id_producto", $id_producto);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            echo json_encode($datos);
        }
    }

    $consulta = new Productos();
    $metodo = $_POST['metodo'];
    $consulta->$metodo();

?>
