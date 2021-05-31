<?php
use chriskacerguis\RestServer\RestController;

class Cuentas extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('cuentas_model');
	}

    /**
	 * @api {get} /cuentas/:numerocuenta Solicitar la información de una cuenta
	 * @apiVersion 0.1.0
	 * @apiName GetCuenta
	 * @apiGroup Cuentas
	 *
	 * @apiParam {String} numerocuenta Número de cuenta de la cuenta solicitada.
	 *
	 * @apiSuccess {JSON} cuenta Información de la cuenta en formato JSON.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "idcuenta": 1,
	 *       "numerocuenta": "1234567812345678",
     *       "nip": 1234,
     *       "idcuentahabiente": 1,
     *       "nombre": William
	 *     }
	 *
	 * @apiError CuentaNoEncontrada La cuenta solicitada no fue encontrada.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 404 Not Found
	 *     {
	 *       "error": "CuentaNoEncontrada"
	 *     }
	 */
	public function index_get($numerocuenta = NULL)
	{
		$query_cuentas = $this->cuentas_model->getCuenta($numerocuenta);
        if (!empty($query_cuentas)) {
            $this->response($query_cuentas, 200);   
        }
        else {
            $this->response("CuentaNoEncontrada", 404);
        }
	}

	/**
	 * @api {get} /cuentas/:id/saldo Solicitar el saldo de una cuenta
	 * @apiVersion 0.1.0
	 * @apiName GetCuentaSaldo
	 * @apiGroup Cuentas
	 *
	 * @apiParam {Number} id ID de la cuenta solicitada.
	 *
	 * @apiSuccess {JSON} saldo Información del saldo de la cuenta en formato JSON.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "idhsaldo": 5,
	 *       "total": 35000,
     *       "idcuenta": 2,
     *       "fecha": "2021-05-29 11:06:41.851489-05"
	 *     }
	 *
	 * @apiError SaldoNoEncontrado El saldo de la cuenta solicitado no fue encontrado.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 404 Not Found
	 *     {
	 *       "error": "SaldoNoEncontrado"
	 *     }
	 */
    public function cuentaSaldo_get($idcuenta = NULL){
		$query_saldo = $this->cuentas_model->getCuentaSaldo($idcuenta);
        if (!empty($query_saldo)) {
            $this->response($query_saldo, 200);   
        }
        else {
            $this->response("SaldoNoEncontrado", 404);
        }
    }

	/**
	 * @api {post} /cuentas/deposito Realizar deposito a una cuenta
	 * @apiVersion 0.1.0
	 * @apiName PostCuentaDeposito
	 * @apiGroup Cuentas
	 *
	 * @apiParam {Number} id ID de la cuenta.
	 * @apiParam {Number} total-depositado Total del monto que se depositará a la cuenta.
	 * 
	 * @apiParamExample {json} Request-Example:
	 *     {
	 *       "idcuenta": 2,
	 *       "total-depositado": 5000
	 *     }
	 *
	 * @apiSuccess {JSON} saldo Información del saldo actualizado de la cuenta en formato JSON.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "idhsaldo": 8,
	 *       "total": 40000,
     *       "idcuenta": 2,
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
    public function deposito_post(){
		echo "deposito_post";
    }

	/**
	 * @api {post} /cuentas/retiro Realizar retiro de una cuenta
	 * @apiVersion 0.1.0
	 * @apiName PostCuentaRetiro
	 * @apiGroup Cuentas
	 *
	 * @apiParam {Number} id ID de la cuenta.
	 * @apiParam {Number} total-retirado Total del monto que se retirará de la cuenta.
	 * 
	 * @apiParamExample {json} Request-Example:
	 *     {
	 *       "idcuenta": 2,
	 *       "total-retirado": 5000
	 *     }
	 *
	 * @apiSuccess {JSON} saldo Información del saldo actualizado de la cuenta en formato JSON.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     {
	 *       "idhsaldo": 9,
	 *       "total": 35000,
     *       "idcuenta": 2,
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
	 * 
	 * @apiError FondosInsuficientes No hay fondos suficientes para realizar la transacción.
	 * 
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 500 Fondos insuficientes
	 *     {
	 *       "error": "FondosInsuficientes"
	 *     }
	 */
    public function retiro_post(){
		echo "retiro_post";
    }
}