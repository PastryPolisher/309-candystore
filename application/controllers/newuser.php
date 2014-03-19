<?php

session_start();
class Newuser extends CI_Controller {
	function __construct() {
		// call the controller constructor
		parent::__construct();
	}

	function index() {
		$this->load->view(); // TODO: fill in view()
	}

	function register() {
		$this->load->library('form_validation');
		if ($this->form_validation->run() == FALSE) {
			// TODO: show erros?
			$this->load->view(); // TODO: fill in view();
		} else {
			// insert user into database
			$this->load->model('customer_model');

			$customer = new Customer();
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
                        $customer->login = $this->input->get_post('login');
                        $customer->password = $this->input->get_post('password');
                        $customer->email = $this->input->get_post('email');

			$this->customer_model->insert($customer);

			$this->load->view(); // TODO: success page
		}
	}

	// must be of format XXX-XXX-XXXX
	public function phone_check($phone) {
		if (preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone) == 0) {
			$this->form_validation->set_message('phone_check', 'Invalid phone number. Must be of format XXX-XXX-XXXX.');
			return false;
		}
		return true;
	}
}
?>
