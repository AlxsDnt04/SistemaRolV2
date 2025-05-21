<?php
require_once __DIR__ . '/../config/database.php';

class Rol
{
    private $db;
    //variable que instancie la conexion
    public function __construct()
    {
        $this->db = Database::connect();
    }

    //metodo para obtener datos de los empleados
    public function obtenerEmpleados()
    {
        return $this->db->query("SELECT * from empleado")->fetchAll(PDO::FETCH_ASSOC);
    }


}
