<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
		$this->load->model('adminModel');
	}

	public function index()
	{
        
        $data['users'] = $this->adminModel->getAllUserAddress();        
		$this->load->view('admin/header');
		$this->load->view('admin/user', $data);
		$this->load->view('admin/footer');
	}
	
    public function viewOrders($customerId = null)
    {

        $con['conditions'] = array(

            'userid' => $customerId

		);

		$data['orders'] = $this->adminModel->getRows($con, 'orders');        
		$this->load->view('admin/header');
		$this->load->view('admin/orders', $data);
		$this->load->view('admin/footer');
	}
	
	public function orderDetail()
    {        		
		if($_POST) {
			
			$orderId = $this->input->post('orderId');
			
			$items = $this->adminModel->getOrderDetail($orderId);        
			
			echo json_encode($items);
			
		} else
			echo false;
		
    }
}
