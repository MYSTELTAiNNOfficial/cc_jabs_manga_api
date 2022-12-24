<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->model('UserModel', 'user');
	}

	public function login_post()
	{
		$email = $this->post('email');
		$uid = $this->post('uid');
		if ($email === null || $uid === null) {
			$this->response([
				'status' => false,
				'message' => 'Provide an email and uid!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($email === "guest@test.com" || $uid === "GmDskVEC2NVS5r8HwynqdfSYWwGq") {
			$this->response([
				'status' => false,
				'message' => 'You can\'t login with guest account!!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ($this->user->login($email, $uid)) {
				//ok
				$this->response([
					'status' => true,
					'message' => 'Login success.'
				], REST_Controller::HTTP_OK);
			} else {
				//id not found
				if ($this->user->register($email, $uid)) {
					$this->response([
						'status' => true,
						'message' => 'Login success.'
					], REST_Controller::HTTP_OK);
				} else {
					$this->response([
						'status' => false,
						'message' => 'Login failed!'
					], REST_Controller::HTTP_BAD_REQUEST);
				}
			}
		}
	}
}
