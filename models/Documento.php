<?php
require_once __DIR__ . '/../config/database.php';

class Documento
{
    //variable que instancie la conexion
    private $db;
    //constructor
    public function __construct()
    {
        $this->db = Database::connect();
    }


    //metodo para crear
    function crearDocumento($data,$archivoFullPath) {
        $archivo = 'uploads/'.basename($archivoFullPath);
        $sql = "INSERT INTO documento 
        (mes, 
        descripcion, 
        archivo, 
        ci_empleado) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data['mes'],$data['descripcion'], $archivo, $data['ci_empleado']);
    }

     
    //metodo para consultar todos documentos
    public function obtenerTodos()
    {
        return $this->db->query("SELECT * from documento")->fetchAll(PDO::FETCH_ASSOC);
    }
    /*
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
    } */
}
