<?php
use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;

class Auth extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('cuentas_model');
	}

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
