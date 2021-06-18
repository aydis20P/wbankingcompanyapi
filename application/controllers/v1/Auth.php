<?php
use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;

class Auth extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('cuentas_model');
	}

	/**
	 * @api {post} /auth Solicitar autorización para consumir la API
	 * @apiVersion 0.1.0
	 * @apiName PostAuth
	 * @apiGroup Autorización
	 *
	 * @apiParam {Number} numerocuenta Numero de ceunta del cuentahabiente.
	 * @apiParam {Number} nip Nip del cuentahabiente.
     * @apiParam {String} cliente Llave única del cliente que consumirá la API.
	 *
	 * @apiParamExample {json} Request-Example:
	 *     {
	 *       "numerocuenta": 1234567812345678,
	 *       "nip": 1234,
	 *       "client": "client_example"
	 *     }
	 *
	 * @apiSuccess {JSON} jwt jwt en formato JSON.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "jwt": "XXXX.YYYYYY.ZZZZZZZ"
	 *     }
	 *
	 * @apiError NoAutorizado Acceso denegado.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 400 Bad Request
	 *     {
	 *       "error": "NoAutorizado"
	 *     }
	 */
    public function index_post(){
        if(!empty(file_get_contents('php://input'))){
            //obtener el contenido pasado en el body
            $jsonObj = file_get_contents('php://input');
            $obj = json_decode($jsonObj);

            //consultar datos de la cuenta en la DB
    		$queryCuentas = $this->cuentas_model->getCuenta($obj->numerocuenta);
            $nip = $queryCuentas['nip'];

            //verificar que se pasó la keyword de sitio y que las credenciales del usuario son corractas
            $aSites = getenv('ALLOWED_SITES');
            $arrSites = json_decode($aSites);
            if(in_array($obj->client, $arrSites)
               && $obj->nip == $nip){
                //generar jwt
                $time = time();
                $key = getenv('KEY');

                $token = array(
                    'iat' => $time, // Tiempo que inició el token
                    'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
                    'data' => [ // información del cliente
                        'access' => 'All',
                        'name' => 'wbcatm'
                    ]
                );

                $jwt = JWT::encode($token, $key);
                $this->response(array('jwt' => $jwt), 200);
            }
            else{
                $this->response('No Autorizado', 400);
            }
        }
        else{
            $this->response('No Autorizado', 400);
        }
    }
}
