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

    // obtener todos los roles
    public function obtenerTodoslosRoles()
    {
        $stat = $this->db->prepare("
        SELECT * FROM rol");
    }

    public function actualizarRol($data)
    {
        $stat = $this->db->prepare("UPDATE rol SET 
        mes = ?, 
        hora25 = ?,
        hora50 = ?,
        hora100 = ?,
        bonos = ?,
        sueldo = ?,
        totalIngreso = ?,
        iess = ?,
        multas = ?,
        atrasos = ?,
        alimentacion = ?,
        anticipos = ?,
        otros = ?,
        totalEgreso = ?,
        totalPagar = ?
        WHERE id_rol = ?");

        return $stat->execute([
            $data['mes'], // directo del formulario
            $data['hora25'],
            $data['hora50'],
            $data['hora100'],
            $data['bonos'], //directo del formulario
            $data['sueldo'], //directo del formulario
            $data['totalIngreso'],
            $data['iess'],
            $data['multas'], //directo del formulario
            $data['atrasos'], //directo del formulario
            $data['alimentacion'], //directo del formulario
            $data['anticipo'], //directo del formulario
            $data['otros'], //directo del formulario
            $data['totalEgreso'],
            $data['totalPagar'],
            $data['empleadoInfo'] //directo del formulario
        ]);
    }

    // funcion para insertar los datos en la base
    public function insertarRol($data)
    {
        $stat = $this->db->prepare("INSERT INTO rol ( 
        mes, 
        hora25,
        hora50,
        hora100,
        bonos,
        sueldo,
        totalIngreso,
        iess,
        multas,
        atrasos,
        alimentacion,
        anticipos,
        otros,
        totalEgreso,
        totalPagar,
        ci_empleado
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        return $stat->execute([
            $data['mes'], // directo del formulario
            $data['hora25'],
            $data['hora50'],
            $data['hora100'],
            $data['bonos'], //directo del formulario
            $data['sueldo'], //directo del formulario
            $data['totalIngreso'],
            $data['iess'],
            $data['multas'], //directo del formulario
            $data['atrasos'], //directo del formulario
            $data['alimentacion'], //directo del formulario
            $data['anticipo'], //directo del formulario
            $data['otros'], //directo del formulario
            $data['totalEgreso'],
            $data['totalPagar'],
            $data['empleadoInfo'] //directo del formulario
        ]);
    }

    public function consultaRolInnerJoin()
    {
        return $this->db->query("
        SELECT 
        e.ci_empleado, 
        e.nombre, e.apellido, 
        r.id_rol,
        r.mes,
        r.hora25, 
        r.hora50, 
        r.hora100, 
        r.bonos, 
        r.sueldo, 
        r.totalIngreso, 
        r.iess, 
        r.multas, 
        r.atrasos, 
        r.alimentacion, 
        r.anticipos, 
        r.otros, 
        r.totalEgreso, 
        r.totalPagar, 
        r.fecha_registro 
        FROM rol r INNER JOIN empleado e ON e.ci_empleado = r.ci_empleado;")->fetchAll(PDO::FETCH_ASSOC);
    }

    //metodo para eliminar un rol
    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM rol WHERE id_rol = ?");
        return $stmt->execute([$id]);
    }

    // metodo para obtener un rol por id
    public function obtenerRolPorId($id)
    {
        $stmt = $this->db->prepare("
        SELECT e.ci_empleado, 
        e.nombre, 
        e.apellido, 
        r.id_rol, 
        r.mes, 
        r.hora25, 
        r.hora50, 
        r.hora100, 
        r.bonos, 
        r.sueldo, 
        r.totalIngreso, 
        r.iess, 
        r.multas, 
        r.atrasos, 
        r.alimentacion, 
        r.anticipos, 
        r.otros, 
        r.totalEgreso, 
        r.totalPagar, 
        r.fecha_registro 
        FROM rol r INNER JOIN empleado e ON e.ci_empleado = r.ci_empleado WHERE r.id_rol = ?;");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
