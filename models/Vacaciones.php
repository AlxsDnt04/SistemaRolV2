<?php
require_once __DIR__ . '/../config/database.php';



class Vacaciones
{
    //variable que instancie la conexion
    private $db;
    //constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function tieneSolicitud($ci_empleado) {
    $sql = "SELECT COUNT(*) FROM vacaciones WHERE ci_empleado = ?"; 
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$ci_empleado]);
    return $stmt->fetchColumn() > 0;
}

public function nuevaSolicitud($data) {
    $sql = "INSERT INTO vacaciones (ci_empleado, fecha_inicio, fecha_fin, dias, aprobado, observaciones) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        $data['ci_empleado'],
        $data['fecha_inicio'],
        $data['fecha_fin'],
        $data['dias'],
        $data['aprobado'],
        $data['observaciones']
    ]);
}
}