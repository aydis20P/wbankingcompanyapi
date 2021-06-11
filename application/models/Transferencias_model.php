<?php
class Transferencias_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * Crea nuevo registro en transferencias dado el idcuentahabiente
     * idbeneficiario y monto
     */
    function transferenciaPost($idcuentahabiente, $idbeneficiario, $monto){
        if ($idcuentahabiente === NULL || $idbeneficiario === NULL || $monto === NULL){
            return array();
        }

        if (gettype($monto) == "string"){
            return array();
        }
        else{
            // Verificar que el monto sea >= 50
            if($monto >= 50){
                // Registrar la transferencia
                $queryStr = "INSERT INTO transferencias(cuentahabiente, beneficiario, monto)
                            VALUES ('" . $idcuentahabiente . "', '". $idbeneficiario . "', '" . $monto . "');";
                $this->db->query($queryStr);

                $money = "$".strval($monto);
                // Regresar la transferencia
                $query = $this->db->get_where('transferencias', array('cuentahabiente' => $idcuentahabiente,
                                                                      'beneficiario' => $idbeneficiario,
                                                                      'monto' => $money));
                return $query->result_array()[0];
            }
            else{
                return array();
            }
        }
    }
}
