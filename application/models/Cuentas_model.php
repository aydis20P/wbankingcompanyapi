<?php
class Cuentas_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Devuelve la información de una cuenta dado su numerocuenta
     */
    public function getCuenta($numerocuenta = NULL) {
        if ($numerocuenta === NULL){
            return array();
        }

        $queryStr = "SELECT
                        c.idcuenta,
                        c.numerocuenta,
                        c.nip,
                        ch.idcuentahabiente,
                        ch.nombre
                    FROM cuentas c
                    INNER JOIN cuentahabientes ch
                        ON c.idcuentahabiente = ch.idcuentahabiente
                    WHERE c.numerocuenta = '". $numerocuenta . "';";
        $query = $this->db->query($queryStr);
        return $query->row_array();
    }

    /**
     * Devuelve la información del saldo de la cuenta dado su idcuenta
     */
    function getCuentaSaldo($idcuenta = NULL){
        if ($idcuenta === NULL){
            return array();
        }

        $queryStr = "SELECT *
                    FROM historialsaldos
                    WHERE
                    idcuenta = ". $idcuenta ."
                    AND
                    fecha =
                    (SELECT MAX(fecha)
                    FROM historialsaldos
                    WHERE idcuenta = ". $idcuenta .");";
        $query = $this->db->query($queryStr);
        return $query->row_array();
    }

    /**
     * Crea nuevo registro en el historialsaldo asociado a la cuenta
     * con el saldo más reciente mas el total depositado
     */
    function depositoPost($idcuenta, $totalDepositado){
        if ($idcuenta === NULL || $totalDepositado === NULL){
            return array();
        }

        // Consultar el saldo actual
        $queryStr = "SELECT total
                    FROM historialsaldos
                    WHERE
                    idcuenta = ". $idcuenta ."
                    AND
                    fecha =
                    (SELECT MAX(fecha)
                    FROM historialsaldos
                    WHERE idcuenta = ". $idcuenta .");";
        $totalActual = $this->db->query($queryStr);

        // Parseamos el total actual a float
        $num = $totalActual->row()->total;
        $value = floatval(preg_replace('/[^\d\.]+/', '', $num));

        if (gettype($totalDepositado) == "string"){
            return array();
        }
        else{
            // Verificar que el total depositado sea >= 50
            if($totalDepositado >= 50){
                // Sumar el nuevo saldo al saldo actual
                $nuevoTotal = $value + $totalDepositado;
            }
            else{
                return array();
            }
        }

        // Registrar el movimiento en historialsaldo
        $queryStr = "INSERT INTO historialsaldos(total, idcuenta) VALUES (". $nuevoTotal .", ". $idcuenta .");";
        $this->db->query($queryStr);

        // Regresar nuevo saldo
        $queryStr = "SELECT *
                    FROM historialsaldos
                    WHERE
                    idcuenta = ". $idcuenta ."
                    AND
                    fecha =
                    (SELECT MAX(fecha)
                    FROM historialsaldos
                    WHERE idcuenta = ". $idcuenta .");";
        $query = $this->db->query($queryStr);
        return $query->row_array();
    }

    /**
     * Crea nuevo registro en el historialsaldo asociado a la cuenta
     * con el saldo más reciente menos el total retirado
     */
    function retiroPost($idcuenta, $totalRetirado){
        if ($idcuenta === NULL || $totalRetirado === NULL){
            return array();
        }

        // Consultar el saldo actual
        $queryStr = "SELECT total
                    FROM historialsaldos
                    WHERE
                    idcuenta = ". $idcuenta ."
                    AND
                    fecha =
                    (SELECT MAX(fecha)
                    FROM historialsaldos
                    WHERE idcuenta = ". $idcuenta .");";
        $totalActual = $this->db->query($queryStr);

        // Parseamos el total actual a float
        $num = $totalActual->row()->total;
        $value = floatval(preg_replace('/[^\d\.]+/', '', $num));

        if (gettype($totalRetirado) == "string"){
            return array();
        }
        else{
            if ($value >= $totalRetirado && $totalRetirado >= 50) {
                // Restar el total retirado al saldo actual
                $nuevoTotal = $value - $totalRetirado;
            }
            else{
                return 0;
            }
        }

        // Registrar el movimiento en historialsaldo
        $queryStr = "INSERT INTO historialsaldos(total, idcuenta) VALUES (". $nuevoTotal .", ". $idcuenta .");";
        $this->db->query($queryStr);

        // Regresar nuevo saldo
        $queryStr = "SELECT *
                    FROM historialsaldos
                    WHERE
                    idcuenta = ". $idcuenta ."
                    AND
                    fecha =
                    (SELECT MAX(fecha)
                    FROM historialsaldos
                    WHERE idcuenta = ". $idcuenta .");";
        $query = $this->db->query($queryStr);
        return $query->row_array();
    }
}
