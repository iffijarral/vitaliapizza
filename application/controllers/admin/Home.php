<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

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
		$this->load->helper('url');
		$this->load->model('adminModel');
	}

	public function index()
	{
		if ($this->session->userdata('adminUser')) {
			$data['categories'] = $this->adminModel->getData('categories');
			$this->load->view('admin/header');
			$this->load->view('admin/category', $data);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
		
	}
	public function product()
	{
		$con['conditions'] = array();
		$data['categories'] = $this->adminModel->getRows($con, 'categories');
		$firstCategoryId = $data['categories'][0]['id'];
		
		$con['conditions'] = array(

			'catid' => $firstCategoryId

		);

		$products = $this->adminModel->getRows($con, 'products');

		$data['products'] = $products;
		
		$this->load->view('admin/header');
		$this->load->view('admin/product', $data);
		$this->load->view('admin/footer');
	}
	public function user()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/user');
		$this->load->view('admin/footer');
	}
	public function login()
	{
		
		if($_POST) {

			$con['conditions'] = array(

				'email' => $this->input->post('email'),

				//'password' => md5($this->input->post('password'))
				'password' => $this->input->post('password')
	
			);

			$admin = $this->adminModel->getRows($con, 'admin');

			if($admin) {
				
				$this->session->set_userdata('adminUser', $this->input->post('email'));

				redirect('/admin/', 'refresh');

			} else {

				$this->session->set_flashdata('Error', 'Wrong email or password');

				$this->load->view('admin/login');
				
			}
		} else
			echo 'A problem occured';
		
	}

	public function logOut() 
	{
		$this->session->unset_userdata('adminUser');
		
		echo true;
	}
}
