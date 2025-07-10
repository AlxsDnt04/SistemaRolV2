<?php
require_once __DIR__ . '/../config/database.php';

class Usuarios
{
    //variable que instancie la conexion
    private $db;
    //constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }
    // método para crear un nuevo usuario
    public function crearUsuario($usuario, $clave, $rol, $ci_empleado)
    {
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (usuario, clave, rol, ci_empleado) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$usuario, $hash, $rol, $ci_empleado]);
    }
    // método para obtener todos los usuarios
    public function obtenerTodosUsuarios()
    {
        $stmt = $this->db->query("SELECT u.id, u.usuario, u.clave, u.rol, e.ci_empleado, e.nombre, e.apellido, u.fecha_user FROM usuarios u INNER JOIN empleado e ON u.ci_empleado = e.ci_empleado;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //metodo para actualizar el usurio
    public function actualizarUsuario($data)
    {
        if (empty($data['id']) || !is_numeric($data['id'])) {
            throw new InvalidArgumentException("El campo 'id' es obligatorio y debe ser numérico.");
        }
        $stmt = $this->db->prepare("UPDATE usuarios SET usuario = ?, clave = ?, rol = ?, ci_empleado = ? WHERE id = ?");
        $hash = password_hash($data['clave'], PASSWORD_DEFAULT);
        return $stmt->execute([$data['usuario'], $hash, $data['rol'], $data['ci_empleado'], $data['id']]);
    }

    // consultar un usuario por id
    public function obtenerUsuarioPorId($id)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException("El campo 'id' es obligatorio y debe ser numérico.");
        }
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // método para eliminar un usuario
    public function eliminarUsuario($id)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new InvalidArgumentException("El campo 'id' es obligatorio y debe ser numérico.");
        }
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function autenticarUsuario($usuario, $clave)
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($clave, $user['clave'])) {
            return $user; // Retorna el usuario autenticado
        }
        return false; // Usuario o contraseña incorrectos
    }

    public function existeUsuario($usuario)
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuario]);
        return $stmt->fetchColumn() > 0;
    }

    //metodo para actualizar foto usuario
    public function actualizarFoto($id, $archivoFullPath = null)
{
    if (!is_numeric($id)) {
        throw new InvalidArgumentException("ID inválido o no definido.");
    }

    if ($archivoFullPath) {
        $archivo = 'uploads/profilePictures/' . basename($archivoFullPath);
        $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";
        $params = [$archivo, $id];
    } else {
        $sql = "UPDATE usuarios SET foto = NULL WHERE id = ?";
        $params = [$id];
    }

    $stmt = $this->db->prepare($sql);
    return $stmt->execute($params);
}

}
