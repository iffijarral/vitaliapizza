<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
        if ($_POST) {
            switch ($this->input->post('action')) {
                case 'updateOrderStatus':
                    $this->orderStatusUpdate($_POST);
                    break;
                case 'viewOrder':
                    $this->orderDetail($_POST);
                    break;
                case 'findOrder':
                    $this->findOrder($_POST);
                    break;
            }
        } else {
            $con['conditions'] = array(

                'status' => 0                

            );

            $data['orders'] = $this->adminModel->getRows($con, 'orders');
            
            foreach ($data['orders'] as $order) {
                $data2 = array(
                    'view' => true
                );
                $this->adminModel->updateData('orders', $order['id'], $data2);
            }

            $this->load->view('admin/header');
            $this->load->view('admin/orders', $data);
            $this->load->view('admin/footer');
        }
    }

    public function orderDetail($post)
    {
        $orderId = $post['orderId'];

        $data['orders'] = $this->adminModel->getOrderDetail2($post['orderId']);

        $result = $this->load->view('admin/orderDetail', $data, TRUE);

        echo $result;
    }

    public function orderStatusUpdate($post)
    {
        $orderId = $post['orderId'];

        $data = array(
            'status' => 1
        );

        //Transfering data to Model			
        if ($this->adminModel->updateData('orders', $orderId, $data)) {
            echo 'orderUpdated';
        } else {
            echo false;
        }
    }

    public function getOrders()
    {
        $con['conditions'] = array(

            'status' => 0,

            'view' => false

        );

        $orders = $this->adminModel->getRows($con, 'orders');
        if ($orders) {
            foreach ($orders as $order) {
                $data = array(
                    'view' => true
                );
                $this->adminModel->updateData('orders', $order['id'], $data);
            }
            echo json_encode($orders);
        } else
            echo false;
    }

    public function getOrderInfo()
    {
        if ($_POST) {

            $orderId = $this->input->post('orderId');

            $products = $this->adminModel->getOrderDetail($orderId);

            if($products) {
                echo json_encode($products);
            } else
                echo false;
            
        } else
            echo false;
    }
    public function findOrder($post)
    {
    
        $data['orders'] = $this->adminModel->getTransaction($post['transactionId']);        

        if($data['orders']) {
            $result = $this->load->view('admin/orderDetail', $data, TRUE);

            echo $result;        
        } else {
            echo false;
        }
       
            
    }
}
