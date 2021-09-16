<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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

        if ($_POST) {

            switch ($this->input->post('action')) {
                case 'delete':
                    $this->deleteCategory($_POST);
                    break;
                case 'save':
                    $this->createCategory($_POST);
                    break;
                default:
                    $this->updateCategory($_POST);
            }
        } else {

            $data['categories'] = $this->adminModel->getData('categories');
            $this->load->view('admin/header');
            $this->load->view('admin/category', $data);
            $this->load->view('admin/footer');
        }
    }

    public function updateCategory($post)
    {

        $catName = $post['catName'];

        $id = $post['id'];

        $data = array(
            'name' => $catName
        );

        //Transfering data to Model			
        if ($this->adminModel->updateData('categories', $id, $data)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function deleteCategory($post)
    {

        $id = $post['id'];

        $data = array(
            'id' => $id
        );

        //Transfering data to Model			
        if ($this->adminModel->deleteData('categories', $id)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function createCategory($post)
    {
        $catName = $post['catName'];

        $data = array(
            'name' => $catName
        );

        //Transfering data to Model			
        if ($this->adminModel->insertData('categories', $data)) {
            //call this function to get last saved record to populate category table
            $this->getLastRow();
        } else {
            echo false;
        }
    }

    public function getLastRow()
    {

        $data = $this->adminModel->getLastRecord('categories');

        if ($data) {
            echo json_encode($data);
        } else {
            echo false;
        }
    }
}
