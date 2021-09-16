
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
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
		if (!isset($_SESSION) && !headers_sent()
            ) {
                session_start();
            }
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