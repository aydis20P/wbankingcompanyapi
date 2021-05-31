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
}