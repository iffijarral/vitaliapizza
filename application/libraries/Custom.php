<?php

class Custom {
    
    private $CI;
    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('adminModel');
        $this->CI->load->config('email');
        $this->CI->load->library('email');
    }
    
    public function checkEmail($email)
    {

        $con['conditions'] = array(
            'email' => $email
        );

        $status = $this->CI->adminModel->getRows($con, 'users');

        if ($status)
            return false;
        else
            return true;
    }
    
    public function processEmail($email)
    {
        $expFormat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $expDate = date("Y-m-d H:i:s", $expFormat);

        $key = md5(2418 * 2 . $email);

        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);

        $key = $key . $addKey;

        $data = array(
            'email' => $email,

            'keytocheck' => $key,

            'expDate' => $expDate
        );

        if ($this->CI->adminModel->insertData('password_reset_temp', $data)) {

            return $this->sendEmail($email, $key, $expDate);
                
        } else {

            echo 'Der kom en fejl, prøv venligst senere';
        }
    }

    public function sendEmail($email, $key, $expDate)
    {
        $output = '<p>Kære kunde,</p>';
        $output .= '<p>Klik på følgende link for at nulstille din adgangskode.</p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p><a href="http://vitaliapizza.dk/user/resetPassword?key='.$key.'&email='.$email.'&action=reset" target="_blank"> http://vitaliapizzabar.dk/user/resetPassword?key='.$key.'&email='.$email. '&action=reset</a></p>';
        $output .= '<p>-------------------------------------------------------------</p>';
        $output .= '<p>Sørg for at kopiere hele linket til din browser. Linket udløber efter 1 dag af sikkerhedsmæssige årsager.</p>';
        $output .= '<p>Hvis du ikke anmodede om denne e-mail med glemt adgangskode, behøver du ikke gøre noget, din adgangskode nulstilles ikke. Det kan dog være nødvendigt, at du logger ind på din konto og ændrer din sikkerhedsadgangskode, som nogen måske har gættet det.</p>';
        $output .= '<p>Tak,</p>';
        $output .= '<p>Vitalia Pizza</p>';
        $body = $output;
        $subject = "Password Recovery - vitaliapizza.dk";

        //$this->load->config('email');
        //$this->load->library('email');

        $from_email = $from = $this->CI->config->item('smtp_user');

        $to_email = $email;

        $this->CI->email->from($from_email, 'Vitaliapizza');
        $this->CI->email->to($to_email);
        $this->CI->email->subject($subject);
        $this->CI->email->message($output);
        
        if($this->CI->email->send()) {
            return true;
        } else 
            return false;
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
    
    public function generateToken()
    {
        
        $amount = 100;
       
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

}