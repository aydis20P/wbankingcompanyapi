<?php
use chriskacerguis\RestServer\RestController;

class Transferencias extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('transferencias_model');
	    $this->load->helper('jwtcheck');
	}

    public function validateAccess(){
        try{
            jwtValidation();
        }
        catch(Exception $e){
            $this->response($e->getMessage(), 400);
            return;
        }
    }


	public function index_get()
	{
		echo "index_get (Transferencias)";
	}

	/**
	 * @api {post} /transferencias Registrar transferencia de una cuenta a otra
	 * @apiVersion 0.1.0
	 * @apiName PostTransferencias
	 * @apiGroup Transferencias
	 *
	 * @apiParam {Number} idcuentahabiente ID de la cuenta de quien realiza la transferencia.
	 * @apiParam {Number} idbeneficiario ID de la cuenta de quien recibe la transferencia.
	 * @apiParam {Number} monto Monto total que se tranfiere de una cuenta a otra.
	 *
	 * @apiParamExample {json} Request-Example:
	 *     {
	 *       "idcuentahabiente": 1,
	 *       "idbeneficiario": 2,
	 *       "monto": 15000
	 *     }
	 *
	 * @apiSuccess {JSON} tranferencia Información de la transferencia en formato JSON.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "idtransferencia": 2,
	 *       "idcuentahabiente": 1,
	 *       "idbeneficiario": 2,
	 *       "monto": 15000
     *       "fecha": "2021-05-29 11:06:41.851489-05"
	 *     }
	 *
	 * @apiError DatosIncorrectos Los datos proporcinados son incorrectos.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 400 Bad Request
	 *     {
	 *       "error": "DatosIncorrectos"
	 *     }
	 */
    public function index_post(){
        $this->validateAccess();

		if(!empty(file_get_contents('php://input'))){
            $json_obj = file_get_contents('php://input');
            $obj = json_decode($json_obj);

            $queryTranferencia = $this->transferencias_model->transferenciaPost($obj->idcuentahabiente, $obj->idbeneficiario, $obj->monto);
            if (!empty($queryTranferencia)) {
                $this->response($queryTranferencia, 201);
            }
            else {
                $this->response("DatosIncorrectos", 400);
            }
        }
        else{
            $this->response("DatosIncorrectos", 400);
        }
	}
}
