<?php
use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;

class Test extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('cuentas_model');
	}

	public function index_get()
	{
        $time = time();
        $key = getenv('KEY');

        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60), // Tiempo que expirará el token (+1 hora)
//            'exp' => $time -1,
            'data' => [ // información del usuario
                'id' => 1,
                'name' => 'Eduardo'
            ]
        );

        $jwt = JWT::encode($token, $key);
        //var_dump($jwt);

        try{
            $data = JWT::decode($jwt, $key, array('HS256'));

            var_dump($data);
        }
        catch(Firebase\JWT\ExpiredException | Firebase\JWT\SignatureInvalidException $e) {
            echo 'Message: ' .$e->getMessage();
        }
	}
}
