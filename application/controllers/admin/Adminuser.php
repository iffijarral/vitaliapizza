<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminuser extends CI_Controller
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

        $con['conditions'] = array();

        $data['users'] = $this->adminModel->getRows($con, 'admin');
        $this->load->view('admin/header');
        $this->load->view('admin/adminuser', $data);
        $this->load->view('admin/footer');
    }
    public function createAdminUser()
    {
        if ($_POST) {
            
            $email = $this->input->post('email');

            $password = $this->input->post('password');

            $data = array(
                'email' => $email,

                'password' => md5($password)
            );

            //Transfering data to Model			
            if ($this->adminModel->insertData('admin', $data)) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
    public function deleteUser()
    {
        if ($_POST) {
            $id = $this->input->post('id');

            //Transfering data to Model			
            if ($this->adminModel->deleteData('admin', $id)) {
                echo true;
            } else {
                echo false;
            }
        }
    }
}
