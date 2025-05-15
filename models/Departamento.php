<?php
require_once __DIR__ . '/../config/database.php';

class Departamento
{
    //variable que instancie la conexion
    private $db;
    //constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }
    //metodo para crear un departamento
    public function crear($data)
    {
        $stmt = $this->db->prepare("INSERT INTO departamento(nombre, ubicacion, area) VALUES (?,?,?)");
        return $stmt->execute([$data['nombre'], $data['ubicacion'], $data['area']]);
    }
    //metodo para consultar todos los departamentos
    public function obtenerTodos()
    {
        return $this->db->query("SELECT * from departamento")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // metodo para obtener todos los departamentos por id
    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM departamento WHERE id_departamento = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //metodo para actualizar un departamento
    public function actualizar($data)
    {
        $stmt = $this->db->prepare("UPDATE departamento SET nombre = ?, ubicacion = ?, area = ? WHERE id_departamento = ?");
        return $stmt->execute([$data['nombre'], $data['ubicacion'], $data['area'], $data['id_departamento']]);
    }
    //metodo para eliminar un departamento
    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM departamento WHERE id_departamento = ?");
        return $stmt->execute([$id]);
    }
}
