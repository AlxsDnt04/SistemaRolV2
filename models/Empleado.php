<?php
require_once __DIR__ . '/../config/database.php';

class Empleado
{
    //variable que instancie la conexion
    private $db;
    //constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }
    //metodo para crear un empleado considerando el id_departamento
    public function crear($data)
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
        return $this->db->query("SELECT * from empleado")->fetchAll(PDO::FETCH_ASSOC);
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
    }
}
