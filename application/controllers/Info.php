<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
		$this->load->model('adminModel');
	}
    
public function index()
    {
        if($this->session->userdata('userId')) {
            
            $con['conditions'] = array(

                'userid' => $this->session->userdata('userId')
    
            );
    
            $data['orders'] = $this->adminModel->getRows($con, 'orders');        
            $this->load->view('header');
            $this->load->view('history', $data);
            $this->load->view('footer');
        }
	}
	public function orderDetail()
    {
		if($_POST) {
			$orderId = $this->input->post('orderId');

			$data['orders'] = $this->adminModel->getOrderDetail2($orderId);
	
			$result = $this->load->view('admin/orderDetail', $data, TRUE);
	
			echo $result;
		}
        
    }
}