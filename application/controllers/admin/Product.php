<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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
                case 'selectChange':
                    $this->getProducts($_POST);
                    break;
                case 'saveProduct':
                    $this->saveProduct($_POST);
                    break;
                case 'update':
                    $this->updateProduct($_POST);
                    break;
                case 'delete':
                    $this->deleteProduct($_POST);
                    break;
            }
        } else {

            $con['conditions'] = array();
            $data['categories'] = $this->adminModel->getRows($con, 'categories');
            $firstCategoryId = $data['categories'][0]['id'];

            $con['conditions'] = array(

                'catid' => $firstCategoryId

            );

            $products = $this->adminModel->getRows($con, 'products');

            $data['products'] = $products;

            $this->load->view('admin/header');
            $this->load->view('admin/product', $data);
            $this->load->view('admin/footer');
        }
    }

    public function deleteProduct($post)
    {

        $id = $post['id'];

        //Transfering data to Model			
        if ($this->adminModel->deleteData('products', $id)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function saveProduct($post)
    {
        $catId = $post['catId'];

        $prodName = $post['prodName'];

        $prodPrice = $post['prodPrice'];

        $prodIngredients = $post['prodIngredients'];

        $data = array(

            'catid' => $catId,

            'name' => $prodName,

            'ingredients' => $prodIngredients,

            'price' => $prodPrice,

            'status' => 1

        );

        //Transfering data to Model			
        if ($this->adminModel->insertData('products', $data)) {

            $lastProduct = $this->adminModel->getLastRecord('products');

            echo json_encode($lastProduct);
        } else {
            echo false;
        }
    }

    public function updateProduct($post)
    {

        $prodName = $post['name'];

        $prodIngredients = $post['ingredients'];

        $prodPrice = $post['price'];

        $id = $post['id'];

        $data = array(
            'name' => $prodName,

            'ingredients' => $prodIngredients,

            'price' => $prodPrice
        );

        //Transfering data to Model			
        if ($this->adminModel->updateData('products', $id, $data)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function getProducts($post)
    {

        $catId = $post['catId'];

        $con['conditions'] = array(

            'catid' => $catId

        );

        $data['products'] = $this->adminModel->getRows($con, 'products');

        if ($data['products']) {

            echo $this->load->view('admin/productTable', $data, TRUE);
        } else {
            echo $this->load->view('admin/productTable', null, TRUE);
        }
    }
}
