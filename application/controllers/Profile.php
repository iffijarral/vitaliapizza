<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        if ($this->session->userdata('userEmail') && $this->session->userdata('userId')) {

            $data['user'] = $this->adminModel->getUserAddress($this->session->userdata('userId'));

            $this->load->view('header');
            $this->load->view('profile', $data);
            $this->load->view('footer');
        } else {
            redirect('home', 'refresh');
        }
    }
    public function changepassword()
    {
        if ($this->session->userdata('userEmail') && $this->session->userdata('userId')) {
            $this->load->view('header');
            $this->load->view('changePassword');
            $this->load->view('footer');
        } else {
            redirect('home', 'refresh');
        }
    }
    public function editPassword()
    {
        if ($_POST) {

            if ($this->session->userdata('userId')) {
                
                $userId = $this->session->userdata('userId');
                
                $con['conditions'] = array(
                    'id' => $userId,
                    'password' => $this->input->post('oldPassword')
                );

                $user = $this->adminModel->getRows($con, 'users');

                if($user) {

                    $data = array(
                        'password' => $this->input->post('password')
                    );
            
                    //Transfering data to Model			
                    if ($this->adminModel->updateData('users', $userId, $data)) {
                        echo 'Adgangskode er skiftet';
                    } else {
                        echo false;
                    }

                } else {
                    echo 'Forkert gamlekode';
                }
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
    public function editProfile()
    {
        if ($_POST) {

            $data = array(
                'fname' => $this->input->post('fname'),

                'lname' => $this->input->post('lname'),

                'mobile' => $this->input->post('mobile'),

                'email' => $this->input->post('email')
            );

            $userId = $this->session->userdata('userId');

            if ($this->adminModel->updateData('users', $userId, $data)) {
                
                echo true;                
            }
        } else
            echo false;
    }
}
