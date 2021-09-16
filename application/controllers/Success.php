<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Success extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('adminModel');
	}
     
	public function index()
	{				
		
		if($_GET) {
            $data['response'] = $_GET;
            $this->load->view('header');				
            $this->load->view('success', $data);
            $this->load->view('footer');				
        } else {
            redirect(base_url(), 'refresh');
        }					
    }
    public function myCallback()
    {
        $this->session->set_userdata('temp', 'iffi');
    }
    
}
