<?php
require_once __DIR__ . '/../config/database.php';


if (!isset($_SESSION[$_SESSION['usuario']])) {
    $user = $_SESSION['usuario'];
}

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
    function crearDocumento($data, $archivoFullPath)
    {
        $archivo = 'uploads/' . basename($archivoFullPath);
        $sql = "INSERT INTO documento 
        (mes, 
        descripcion, 
        archivo, 
        ci_empleado) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['mes'],
            $data['descripcion'],
            $archivo,
            $data['ci_empleado']
        ]);
    }


    //metodo para consultar todos documentos
    public function obtenerTodos()
    {
        return $this->db->query("SELECT * from documento")->fetchAll(PDO::FETCH_ASSOC);
    }

    // metodo para consultar documentos por ci_empleado con inner join
    public function obtenerDocumentosInnerJ()
    {
        $sql = "SELECT d.id, e.ci_empleado, e.nombre, e.apellido, d.descripcion, d.mes, d.fecha_carga, d.archivo, r.id_rol, r.mes AS mes_rol_generado FROM empleado e INNER JOIN documento d ON e.ci_empleado = d.ci_empleado INNER JOIN rol r on r.ci_empleado = d.ci_empleado;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM documento WHERE id = ?");
        return $stmt->execute([$id]);
    }

    //metodo para actualizar un departamento
    public function actualizar($data, $archivoFullPath = null)
    {
        if ($archivoFullPath) {
            $archivo = 'uploads/' . basename($archivoFullPath);
            $sql = "UPDATE documento 
            SET mes = ?, 
            descripcion = ?, 
            archivo = ?, 
            ci_empleado = ? 
            WHERE id = ?";
            $params = [$data['mes'], $data['descripcion'], $archivo, $data['ci_empleado'], $data['id']];
        } else {
            $sql = "UPDATE documento 
            SET mes = ?,
            descripcion = ?,
            ci_empleado = ? 
            WHERE id = ?";
            $params = [$data['mes'], $data['descripcion'], $data['ci_empleado'], $data['id']];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // metodo para obtener todos por id
    public function obtenerPorIddocumento($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM documento WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ObtenerPorUsuario()
    {
        if (!isset($_SESSION['usuario'])) {
            return [];
        }
        $ci_empleado = $_SESSION['usuario'];
        $stmt = $this->db->prepare("SELECT d.id, e.ci_empleado, e.nombre, e.apellido, d.descripcion, d.mes, d.archivo, d.fecha_carga, r.id_rol, r.mes AS mes_rol_generado from empleado e inner join documento d on e.ci_empleado = d.ci_empleado inner join rol r on r.ci_empleado = d.ci_empleado where e.ci_empleado = ?");
        $stmt->execute([$ci_empleado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
