<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Library extends REST_Controller
{
	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->model('LibraryModel', 'data');
	}

	public function get_get()
	{
		$key = $this->input->get_request_header("api-key");
		if ($key === null) {
			$this->response([
				'status' => false,
				'message' => 'Provide a Key!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($key === "GmDskVEC2NVS5r8HwynqdfSYWwGq") {
			$this->response([
				'status' => false,
				'message' => 'You can\'t get the data with guest API!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$data = $this->data->getData($key);

			$this->response([
				'status' => true,
				'data' => $data
			], REST_Controller::HTTP_OK);
		}
	}

	public function add_post()
	{
		$key = $this->input->get_request_header("api-key");
		$id_manga = $this->post('id_manga');
		if ($key === null || $id_manga === null) {
			$this->response([
				'status' => false,
				'message' => 'Provide a Key and id_manga!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($key === "GmDskVEC2NVS5r8HwynqdfSYWwGq") {
			$this->response([
				'status' => false,
				'message' => 'You can\'t add the data with guest API!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ($this->data->addData($key, $id_manga)) {
				$this->response([
					'status' => true,
					'message' => 'Add data success.'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'Add data failed!'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function delete_post()
	{
		$key = $this->input->get_request_header("api-key");
		$id_manga = $this->post('id_manga');
		if ($key === null || $id_manga === null) {
			$this->response([
				'status' => false,
				'message' => 'Provide a Key and id_manga!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else if ($key === "GmDskVEC2NVS5r8HwynqdfSYWwGq") {
			$this->response([
				'status' => false,
				'message' => 'You can\'t delete this data with guest API!'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ($this->data->deleteData($key, $id_manga)) {
				$this->response([
					'status' => true,
					'message' => 'Delete data success.'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'Delete data failed!'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}
}
