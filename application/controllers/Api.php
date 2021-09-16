<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
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
        $this->load->library('Custom');
    }

    public function index()
    {

    }
    public function products()
    {   
        
        $categories = $this->adminModel->getCatProducts();
        $results = array();
        $index=0;
        $myProduct = array();
        
        
        foreach($categories as $category) {
            $isFound = false;
            $product = array(
                'prodId' => $category['prodId'],
                'prodName'=> $category['prodName'],
                'price'=> $category['price'],
                'ingredients' => $category['ingredients']
            );  
            $catId = isset($category['catId']) ? $category['catId'] : '';
            
            if($index > 0) {
                
                foreach($results as $key => $value) {
                    $myCatId = isset($value['catId']) ? $value['catId'] : '';
                    
                    if($catId == $myCatId) {
                        
                        $results[$key]['products'][] = $product;
                        $isFound = true;
                        break;
                    }
                }
                
                if(!$isFound) {
                    
                    $result = array();
                    $result['catId'] = $category['catId'];
                    $result['catName'] = $category['catName'];
                    $result['products'][] = $product;
                    
                    $results []= $result;
                }
              
              
            } else if($index == 0) {
                $result = array();
                $result['catId'] = $category['catId'];
                $result['catName'] = $category['catName'];
                $result['products'][] = $product;
                
                $results []= $result;
                
            }
            $index ++;
            
        }
       
        //header('content-type: application/json');
        echo json_encode($results);
    }
    public function categories()
    {
        $con['conditions'] = array();
		
        $data['categories'] = $this->adminModel->getRows($con, 'categories');
        
        header('content-type: application/json');

        echo json_encode($data['categories']);
    }
    public function favorities()
    {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        if($obj->action == 'get') {
            $data = $this->adminModel->getFavorities($obj->userid);   
        } else if($obj->action == 'add'){
            
            $data = array(
                
                'userid' => $obj->userid,
        
                'productid'=> $obj->productid
            );
            
            $data = $this->adminModel->saveRecord('favorite', $data);
            
        } else {
            $con['conditions'] = array(
                
                'userid' => $obj->userid,
        
                'productid'=> $obj->productid
            );
            $data = $this->adminModel->deleteData2($con, 'favorite');
            
        }
            
        header('content-type: application/json');
        
        echo json_encode($data);
    }
    public function login()
    {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        $con['conditions'] = array(
        
            'email'=> $obj->email,
            
            'password' => md5($obj->password)
        );
        
        $data = $this->adminModel->getRows($con, 'users');
        
        header('content-type: application/json');
        
        if($data) {
            echo json_encode($data);
        } else
            echo false;
    }
    public function personalInfo()
    {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        header('content-type: application/json');
        
        if($obj->action == 'get') {
            $con['conditions'] = array(
                'id' => $obj->userid
            );
            
            $data = $this->adminModel->getRows($con, 'users');
                
            if($data) {
                echo json_encode($data);
            } else
                echo false;
            
        } else if($obj->action == 'edit') {
            $con['conditions'] = array(
                'id' => $obj->userid
            );
            $data = array(
                
                'fname' => $obj->fname,
                
                'lname' => $obj->lname,
                
                'mobile' => $obj->phone,
                
                'email'=> $obj->email
            );
            
            $data = $this->adminModel->editData($con, 'users', $data); 
            
            if($data)
                echo 'updated';
            else
                echo 'failed';
        }
        
    }
    function changePassword() {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        header('content-type: application/json');
        
        if($obj->action == 'get') {
            $con['conditions'] = array(
                'id' => $obj->userid,
                'password' => md5($obj->password)
            );
            
            $data = $this->adminModel->getRows($con, 'users');
            
            if($data)
                echo 'matched';
            else 
                echo false;
        } else if($obj->action == 'edit') {
            $con['conditions'] = array(
                'id' => $obj->userid
            );
            $data = array(
                'password' => md5($obj->password)
            );
            
            $data = $this->adminModel->editData($con, 'users', $data); 
            
            if($data)
                echo 'updated';
            else
                echo 'failed';
        }
    }
    
    public function oerderHistory()
    {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        header('content-type: application/json');
        
        $con['conditions'] = array(
            'userid' => $obj->userid
        );
        
        $data = $this->adminModel->getRows($con, 'orders');
            
        if($data) {
            echo json_encode($data);
        } else
            echo false;
            
    } 
    public function orderDetail()
    {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        header('content-type: application/json');
        
        
        $data = $this->adminModel->getOrderDetail2($obj->orderid);
            
        if($data) {
            echo json_encode($data);
        } else
            echo false;
    }
    
    public function sendPasswordResetEmail()
    {
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        $email = $obj->email;
        
        header('content-type: application/json');
        
        if($this->custom->checkEmail($email)) { // Here not means email exists
            echo 'Given email does not exist';  
        } else {
            
            if($this->custom->processEmail($email)) { 
                echo 'An email having link to reset your password has been sent to you.';
            } else {
                echo 'An error occored, please try again later';
            }  
        }
        
    }
    public function registerUser()
    {
        $response = array(
            'status' => false,
            'message' => ''
        );
        
        $json = file_get_contents('php://input');
        
        $obj = json_decode($json);
        
        header('content-type: application/json');    
        
        $data = array(
            'fname' => $obj->fname,

            'lname' => $obj->lname,

            'mobile' => $obj->mobile,

            'email' => $obj->email,

            'password' => md5($obj->password),

            'status' => true

        );
        
        if ($this->custom->checkEmail($obj->email)) {
        
            if ($this->adminModel->insertData('users', $data)) {
                $response['status'] = true;
            
                $response['message'] = 'User created successfuly';
            } else {
                $response['status'] = false;
            
                $response['message'] = 'User couldn\'t created';
            }
        
        } else {
            $response['status'] = false;
            
            $response['message'] = 'Email already exists';
        }
        
        echo json_encode($response);
    }
    
    
    
}
