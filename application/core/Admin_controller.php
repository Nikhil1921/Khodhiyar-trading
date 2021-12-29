<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->session->auth;
		if (!$this->auth) 
			return redirect(admin('login'));

		$this->load->model('main_model', 'main');
		$this->redirect = admin($this->redirect);
	}

	public function error_404()
	{
		$data['name'] = 'error 404';
		$data['title'] = 'error 404';
		$data['url'] = $this->redirect;
		return $this->template->load('template', 'error_404', $data);
	}
}