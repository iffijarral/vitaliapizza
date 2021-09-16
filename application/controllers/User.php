<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    
    function __construct()
    {
        parent::__construct();

        $this->load->model('adminModel');
        
        $this->load->library('Custom');
    }

    public function index()
    {

        if ($_POST) {

            $action = $this->input->post('action');

            switch ($action) {
                case 'login':
                    $this->login($_POST);
                    break;
                case 'signup':
                    $this->signup($_POST);
                    break;
                case 'forgotPassword':
                    $this->forgotPassword($_POST);
                    break;
                case 'resetPassword':
                    $this->saveResetPassword($_POST);
                break;
            }
        } else {
            echo false;
        }
    }
    public function signup($post)
    {
        $data = array(
            'fname' => $post['fname'],

            'lname' => $post['lname'],

            'mobile' => $post['mobile'],

            'email' => $post['email'],

            'password' => md5($post['password']),

            'status' => true

        );

        // Here I check for unique email. 
        if ($this->custom->checkEmail($post['email'])) {

            if ($this->adminModel->insertData('users', $data)) {

                $con['conditions'] = array(
                    'email' => $post['email']
                );

                $user = $this->adminModel->getRows($con, 'users');
                if ($user) {
                    $this->session->set_userdata('userName', $user[0]['fname']);

                    $this->session->set_userdata('userEmail', $user[0]['email']);

                    $this->session->set_userdata('userId', $user[0]['id']);

                    echo '1';
                } else {
                    echo '0';
                }
            } else {
                echo '0';
            }
        } else {
            echo '2';
        }
        // echo json_encode($data);
    }

    public function login($post)
    {
        
        $con['conditions'] = array(
            'email' => $post['email'],

            'password' => md5($post['password'])
        );

        $user = $this->adminModel->getRows($con,'users');

        if ($user) {            

            $this->session->set_userdata('userEmail', $user[0]['email']);

            $this->session->set_userdata('userId', $user[0]['id']);

            if($post['isCheckout'] && $post['isCheckout'] !='')
                echo '2'; // it means redirect to checkout page from functions.js
            else 
                echo '1';
        } else {
            echo '0';
        }
    }

    public function logOut()
    {
        $this->session->unset_userdata('userName');

        $this->session->unset_userdata('userEmai');

        $this->session->unset_userdata('userId');

        if ($this->session->userdata('product'))
            $this->session->unset_userdata('product');

        $this->session->sess_destroy();

        echo '1';
    }

    public function getLoginStatus()
    {
        $status = '';

        if ($this->session->userdata('userId')) {
            $status = $this->session->userdata('userId');
        }

        echo $status;
    }

    public function forgotPassword($post)
    {
        $email = $post['email'];

        $con['conditions'] = array(
            'email' => $email
        );

        $status = $this->adminModel->getRows($con, 'users');

        if ($status) {
            if($this->custom->processEmail($email)) {
                echo 'En mail blev sendt til dig med instruktioner om reset adgangskode.';
            } else {
                echo 'Fejl ved afsendelse af e-mail. Prøv venligst igen senere';
            }
        } else {
            echo 'Ingen bruger er registreret med denne e-mail adresse';
        }
    }

    /*public function processEmail($email)
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

        if ($this->adminModel->insertData('password_reset_temp', $data)) {

            $this->sendEmail($email, $key, $expDate);
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

        $this->load->config('email');
        $this->load->library('email');

        $from_email = $from = $this->config->item('smtp_user');

        $to_email = $email;

        $this->email->from($from_email, 'Vitaliapizza');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($output);
        
        if($this->email->send()) {
            echo 'En mail blev sendt til dig med instruktioner om reset adgangskode.';
        } else 
            echo 'Fejl ved afsendelse af e-mail. Prøv venligst igen senere';        
    }*/

    public function resetPassword()
    {
        $error = '';
        
        if (
            isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
            && ($_GET["action"] == "reset") && !isset($_POST["action"])
        ) {
            
            $key = $_GET["key"];
            $email = $_GET["email"];
            $curDate = date("Y-m-d H:i:s");

            $con['conditions'] = array(
                'email' => $email,

                'keytocheck' => $key
            );
            
            $status = $this->adminModel->getRows($con, 'password_reset_temp');

            if ($status === "") {
                $error .= '<h2>Ugyldigt link</h2><p>Linket er ugyldigt / udløbet. Enten kopierede du ikke det korrekte linkfra e-mailen, eller du har allerede brugt key i hvilket tilfælde den er deaktiverede.</p>';
            } else {

                $expDate = $status[0]['expDate'];

                if ($expDate >= $curDate) {
                    $this->deleteKey($email, $key); // Delete record from password_reset_temp.
                    $this->setSession($email);
                } else {
                    $error .= "<h2>Link udløbet</h2><p>Linket er udløbet. Du prøver at bruge det link, der enten blev brugt eller over 24 timer gaml(1 dage efter anmodning).<br /><br /></p>";
                }
            }
            $data['error'] = $error;
            $this->load->view('header');
            $this->load->view('resetPassword', $data);
            $this->load->view('footer');
        } // isset email key validate end
    }

    public function saveResetPassword($post)
    {
        $userId = $this->session->userdata('userId');

        $data = array(
            'password' => md5($post['password'])
        );

        //Transfering data to Model			
        if ($this->adminModel->updateData('users', $userId, $data)) {
            echo 'Adgangskode blev gemt';
        } else {
            echo false;
        }
    }
    public function deleteKey($email, $key)
    {
        $con['conditions'] = array(
            'email' => $email,

            'keytocheck' => $key
        );
        if ($this->adminModel->deleteData2($con, 'password_reset_temp')) {
            return true;
        } else
            return false;
    }

    public function setSession($email)
    {
        $con['conditions'] = array(
            'email' => $email
        );

        $user = $this->adminModel->getRows($con, 'users');

        if ($user) {

            $this->session->set_userdata('userName', $user[0]['fname']);

            $this->session->set_userdata('userEmail', $user[0]['email']);

            $this->session->set_userdata('userId', $user[0]['id']);
          
        }
    }
}
