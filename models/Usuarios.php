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
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
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

    /* public function crear($data)
    {
        if (empty($data['ci_empleado']) || !is_numeric($data['ci_empleado'])) {
            throw new InvalidArgumentException("El campo 'ci_empleado' es obligatorio y debe ser numérico.");
        }
        if (empty($data['id_departamento']) || !is_numeric($data['id_departamento'])) {
            throw new InvalidArgumentException("El campo 'id_departamento' es obligatorio y debe ser numérico.");
        }
        $stmt = $this->db->prepare("INSERT INTO empleado (ci_empleado, nombre, apellido, telefono, direccion, correo, id_departamento) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['ci_empleado'],
            $data['nombre'],
            $data['apellido'],
            $data['telefono'],
            $data['direccion'],
            $data['correo'],
            $data['id_departamento']
        ]);
    }
    //metodo para consultar todos los empleados
    public function obtenerTodos()
    {
        return $this->db->query("SELECT e.ci_empleado, e.nombre, e.apellido, e.correo, e.direccion, e.telefono, d.nombre as departamento_nombre, d.area FROM empleado e INNER JOIN departamento d on e.id_departamento = d.id_departamento;")->fetchAll(PDO::FETCH_ASSOC);
    }

    // metodo para obtener todos los departamentos por id
    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE ci_empleado = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //metodo para actualizar un empleado
    public function actualizar($data)
    {
        $stmt = $this->db->prepare("UPDATE empleado SET ci_empleado = ?, nombre = ?, apellido = ?, telefono = ?, direccion = ?, correo = ?, id_departamento = ? WHERE ci_empleado = ?");
        return $stmt->execute([$data['ci_empleado'], $data['nombre'], $data['apellido'], $data['telefono'], $data['direccion'], $data['correo'], $data['id_departamento'], $data['ci_empleado']]);
    }
    //metodo para eliminar un empleado
    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM empleado WHERE ci_empleado = ?");
        return $stmt->execute([$id]);
    } */
}
