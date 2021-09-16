<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
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
    private $cartId;

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminModel');
        $this->cartId = '';
    }

    public function index()
    {
        $customer = '';
        if ($this->session->userdata('product')) {

            if ($this->session->userdata('userId')) {
                $userId = $this->session->userdata('userId');

                $con['conditions'] = array(

                    'id' => $userId

                );

                $data['customer'] = $this->adminModel->getRows($con, 'users');

                $customer = $data['customer'][0];

                $data = $this->load->view('header');
                $data = $this->load->view('checkOut', array('customer' => $customer));
                $data = $this->load->view('footer');
            } else {
                $data = $this->load->view('header');
                $data = $this->load->view('checkOut');
                $data = $this->load->view('footer');
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }
    public function isStoreOpen()
    {
        $status = FALSE;
        $storeSchedule = [
            'Mon' => ['11:00 AM' => '09:00 PM'],
            'Tue' => ['11:00 AM' => '09:00 PM'],
            'Wed' => ['11:00 AM' => '09:00 PM'],
            'Thu' => ['11:00 AM' => '09:00 PM'],
            'Fri' => ['11:00 AM' => '09:00 PM'],
            'Sat' => ['02:00 PM' => '09:00 PM'],
            'Sun' => ['02:00 PM' => '09:00 PM'],
        ];

        //get current East Coast US time
        $timeObject = new DateTime('Europe/Copenhagen');
        $timestamp = $timeObject->getTimeStamp();
        $currentTime = $timeObject->setTimestamp($timestamp)->format('H:i A');

        // loop through time ranges for current day
        foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

            // create time objects from start/end times and format as string (24hr AM/PM)
            $startTime = DateTime::createFromFormat('h:i A', $startTime)->format('H:i A');
            $endTime = DateTime::createFromFormat('h:i A', $endTime)->format('H:i A');


            // check if current time is within the range
            if (($startTime < $currentTime) && ($currentTime < $endTime)) {
                $status = TRUE;
                break;
            }
        }
        echo $status;
        
        
    }

    public function processOrder()
    {
        if ($_POST) {

            if (!$this->session->userdata('userId')) {
                
                $fname = $this->input->post('fname');
                
                $lname = $this->input->post('lname');
                
                $mobile = $this->input->post('mobile');
                
                $email = $this->input->post('email');

                $user = array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'mobile' => $mobile,
                    'email' => $email,
                    'status' => false
                );

                $this->session->set_userdata('user', $user);
            }

            $comments = $this->input->post('comments');
            $this->session->set_userdata('comments', $comments);

            
            echo true;
            
        } else {
            redirect(base_url(), 'refresh');
        }
    }
   public function saveUser()
    {
        if ($this->session->userdata('user')) {
            $data =  $this->session->userdata('user');
            
            $userId = $this->adminModel->saveRecord('users', $data);

            if ($userId)
                return $userId;
            else
                return false;
        } else
            return false;
    }


    public function saveOrder($userId, $transactionId)
    {
        $returnValue = false;
        $comments = '';

        if ($this->session->userdata('comments')) {
            $comments = $this->session->userdata('comments');
        }

        if ($this->session->userdata('product')) {
            $products = array();
            $amount = $this->session->userdata('amount');
            $date = date('Y-m-d H:i:s');
            $products = $this->session->userdata('product');

            $data = array(
                'userid' => $userId,

                'orderdate' => $date,

                'amount' => $amount,

                'comments' => $comments,
                
                'transactionId' => $transactionId,

                'status' => 0,

                'view' => 0
            );

            $orderId = $this->adminModel->saveRecord('orders', $data);
            
            if($orderId) {
                
                $paymentData = array(
                        
                        'customerId' => $userId,
                    
                        'orderId' => $orderId,
                        
                        'paymentDate' => $date,
                        
                        'amount' => $amount
                        
                    );
                    
                $this->adminModel->insertData('payments', $paymentData);
                
            }

            if ($orderId) {

                foreach ($products as $product) {

                    $myData = array(

                        'productId' => $product['productId'],

                        'orderId' => $orderId,

                        'quantity' => $product['productQty']

                    );

                    if ($this->adminModel->insertData('orderedItems', $myData)) {

                        $this->session->unset_userdata('product');

                        $returnValue = true;
                    } else
                        $returnValue = false;
                }
            } else
                $returnValue = false;
        } else {
            $returnValue = false;
        }


        return $returnValue;
    }
    public function success()
    {
        if($_GET) {
            
            $data['response'] = $_GET;
            
            $this->myCallback($data['response']);
            
            $this->session->unset_userdata('product');
            if ($this->session->userdata('user')) {
                $this->session->unset_userdata('user');
            }
            
            $this->load->view('header');				
            $this->load->view('success', $data);
            $this->load->view('footer');
            
            
            
        } else {
            redirect(base_url(), 'refresh');
        }    
    }
    	
    public function v4requestresponse($data) {
        
        $url = "https://webservice.yourpay.dk/v4.3/".$data['function'];
        $fields_string = [];
        foreach($data as $key=>$value){
            $fields_string[$key] = urlencode($value);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields_string));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
    
        return json_encode($server_output);
    
    }
    public function getAmount()
    {
        $products = array();
        $amount = 0;
        $products = $this->session->userdata('product');

        foreach ($products as $product) {
            if ($product['productQty'] > 0) {
                $amount += (int) $product['productGrossPrice'];
            }
        }

        return $amount;
    }
    
    public function generateToken()
    {
        
        $amount = ($this->getAmount())*100;
       
        $request = array();
        $request['function'] = 'generate_token'; //This is the name of the function we would like to use
        $request['merchant_token']='8Q4MVKXvzZmTh2jOdoY4YQ3MPPzub'; //enter your merchant token from your Yourpay account
        $request['MerchantNumber'] = '600184345'; //replace the last merchantID accordint to your Yourpay account
        $request['ShopPlatform']='PHP'; //enter the name of the platform used
        $request['amount'] = $amount; //replace AMOUNT with the amount you want to get from the customer
        $request['currency']='DKK'; //enter the currency you would like to use
        $request['accepturl']='http://vitaliapizza.dk/checkout/success'; //enter the accepturl, the customer should be forwarded to
        $request['callbackurl']='http://vitaliapizza.dk/checkout/myCallback/'; //enter the callback url, where you would like to store the order
       
        $result = json_decode(json_decode($this->v4requestresponse($request)));
        
        header("Location: ".$result->content->full_url);
        
        
    }
    public function myCallback($response)
    {
        $userId = '';
            
        if ($this->session->userdata('userId')) {
            $userId = $this->session->userdata('userId');
        } else {
            $userId = $this->saveUser();
        }
        
        if ($userId) {
            $this->saveOrder($userId, $response['tid']);
        }
        
        /*$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://webservice.yourpay.dk/v4.3/callback_list?merchant_token=8Q4MVKXvzZmTh2jOdoY4YQ3MPPzub");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $json = json_decode($response, true);
        
        $transactionId = $json['content'][0]['transaction_id'];
        
        if($json['success']) {
            
            
        }*/

        /*$json = json_decode($response, true);
        
        $callbacks = $json['content'];
        
        $callbackId = '';
        
        $cartId = $this->session->userdata('cartId');
        
        foreach($callbacks as $callback) {
            $url = $callback['url'];
            //$url = filter_var_array($url, FILTER_SANITIZE_STRING);
            $parts = parse_url($url);
        
            parse_str($parts['query'], $query);
        
            if($query['cartid'] === $cartId) {
                $callbackId = $callback['id'];
                break;
            }
        }
        
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://webservice.yourpay.dk/v4.3/callback_data?merchant_token=8Q4MVKXvzZmTh2jOdoY4YQ3MPPzub&id=".$callbackId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $json = json_decode($response, true);
        
        if($json['success']) {
            
            
            
        }*/
    }
    public function random_strings($length_of_string)
    {

        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }
    
    
}
