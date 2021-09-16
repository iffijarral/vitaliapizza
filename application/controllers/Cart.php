<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
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
    private $myProductId;

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminModel');
        $this->myProductId = '';
    }

    public function index()
    {

        if ($_POST) {

            $action = $this->input->post('action');
            $cartCount = 0;

            if ($action === 'addToCart') {

                $this->addToCart($_POST);

                if ($this->session->userdata('cartCount')) {

                    $cartCount = (int) $this->session->userdata('cartCount');

                    $cartCount += 1;

                    $this->session->set_userdata('cartCount', $cartCount);
                } else {
                    $this->session->set_userdata('cartCount', 1);
                }
            } else if ($action === 'increment') {

                $this->increment($_POST);

                $cartCount = (int) $this->session->userdata('cartCount');

                $cartCount += 1;

                $this->session->set_userdata('cartCount', $cartCount);
            } else if ($action === 'decrement') {

                $this->decrement($_POST);

                $cartCount = (int) $this->session->userdata('cartCount');

                $cartCount -= 1;

                if($cartCount >= 0)
                    $this->session->set_userdata('cartCount', $cartCount);
            }

            //$this->updataCart();
            $data = $this->load->view('cart', null, TRUE);

            echo $data;
        } else
            echo 'no way';
    }
    public function addToCart($post)
    {

        $productId = $post['productId'];

        $productName = $post['productName'];

        $productPrice = $post['productPrice'];

        $productQty = $post['productQty'];

        $productData = array(
            'productId' => $productId,

            'productName' => $productName,

            'productPrice' => $productPrice,

            'productGrossPrice' => $productPrice,

            'productQty' => $productQty
        );

        $myarray = array();
        $lookup = array();
        $isSameProduct = 0;

        if ($this->session->userdata('product')) {

            $myarray = $this->session->userdata('product');

            $lookup = array_column($myarray, 'productId');

            for ($a = 0; $a < sizeof($lookup); $a++) {

                if ($lookup[$a] === $productId) {

                    $this->myProductId = $productId;

                    $isSameProduct = 1;
                }
            }

            if ($isSameProduct === 1) { // it means we are stoping same product being adding into cart. we'll instead increment its quantity by call increment method in case of same product

                $post = array(
                    'productId' => $productId
                );

                $this->increment($post);
            } else {

                $myarray[] = $productData;

                $this->session->set_userdata('product', $myarray);
            }
        } else {

            $myarray[] = $productData;

            $this->session->set_userdata('product', $myarray);
        }
    }

    public function increment($post)
    {
        $qty = 0;
        $price = 0;
        $productId = '';

        $productId = $post['productId'];

        foreach ($this->session->userdata('product') as $key => $product) {

            if ($product['productId'] === $productId) {

                $qty = $product['productQty'] + 1;

                $price = $qty * (int) $product['productPrice'];

                $_SESSION["product"][$key]['productQty'] = $qty;

                $_SESSION["product"][$key]['productGrossPrice'] = $price;
            }
        }


        $data = array(

            'productQty' => $qty,

            'productGrossPrice' => $price
        );

        //$this->updataCart();
        //echo json_encode($data);


    }

    public function decrement($post)
    {
        $qty = 0;
        $price = 0;
        $temp = 0;

        $productId = $post['productId'];

        $products = array();

        $products2 = array();

        if ($this->session->userdata('product')) {

            $products = $this->session->userdata('product');

            foreach ($products as $key => $product) {

                if ($product['productId'] === $productId) {

                    $qty = $product['productQty'] - 1;

                    if ($qty > 0) {

                        $price = $qty * (int) $product['productPrice'];

                        $products[$key]['productQty'] = $qty;

                        $products[$key]['productGrossPrice'] = $price;
                    } else {

                        unset($products[$key]);

                        $products2 = array_values($products);

                        $temp = 1;
                    }
                }
            }
        }
        $data = array(

            'productQty' => $qty,

            'productGrossPrice' => $price
        );

        if ($temp === 1)
            $this->session->set_userdata('product', $products2);
        else
            $this->session->set_userdata('product', $products);

        //$this->updataCart();    
        //echo json_encode($data);
    }

    public function setDeliveryMethod()
    {
        if ($_POST) {

            $deliveryMethod = $this->input->post('method');

            $this->session->set_userdata('deliverMethod', $deliveryMethod);

            echo true;
        } else
            echo false;
    }

    public function getDeliveryMethod()
    {
        $deliveryMethod = '';

        if ($this->session->userdata('deliverMethod')) {

            $deliveryMethod = $this->session->userdata('deliverMethod');
        }
        echo $deliveryMethod;
    }
    
    public function getCart()
    {
        $data = $this->load->view('cart', null, TRUE);

        echo $data;
    }
}
