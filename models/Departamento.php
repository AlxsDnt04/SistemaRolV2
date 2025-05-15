<?php
require_once __DIR__ . '/../config/database.php';

class Departamento
{
    //variable que instancie la conexion
    private $db;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function crear($data)
    {
        $stmt = $this->db->prepare("INSERT INTO departamento(nombre, ubicacion, area) VALUES (?,?,?)");
        return $stmt->execute([$data['nombre'], $data['ubicacion'], $data['area']]);
    }
    public function obtenerTodos()
    {
        return $this->db->query("SELECT * from departamento")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM departamento WHERE id_departamento = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
