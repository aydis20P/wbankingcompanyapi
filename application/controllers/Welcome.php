<?php
use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends RestController {

	public function index_get()
	{
		$this->load->view('welcome_message');
	}
}
