<?php
class AdminModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function insertData($tbl, $data)
    {
        // Inserting Data
        if ($this->db->insert($tbl, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function saveRecord($tbl, $data)
    {
        $this->db->insert($tbl, $data);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }
    function getData($tbl)
    {
        $query = $this->db->get($tbl);
        return $query->result_array();
    }

    function getLastRecord($tbl)
    {
        $last = $this->db->order_by('id', "desc")
            ->limit(1)
            ->get($tbl)
            ->row();

        return $last;
    }
    function updateData($tbl, $id, $data)
    {
        $this->db->where('id', $id);

        $status = $this->db->update($tbl, $data);

        if ($status) {

            return true;
        } else {

            return false;
        }
    }
    function editData($params = array(), $tbl, $data)
    {
        if (array_key_exists("conditions", $params)) {

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key, $value);
            }
        }

        $status = $this->db->update($tbl, $data);

        if ($status) {

            return true;
        } else {

            return false;
        }
    }
    function deleteData($tbl, $id)
    {
        $this->db->where('id', $id);

        $status = $this->db->delete($tbl);

        if ($status) {

            return true;
        } else {

            return false;
        }
    }
    function deleteData2($params = array(), $tbl)
    {
        if (array_key_exists("conditions", $params)) {

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key, $value);
            }
        }

        $status = $this->db->delete($tbl);

        if ($status) {

            return true;
        } else {

            return false;
        }
    }

    function getUserAddress($id)
    {
        $this->db->select('*')
            ->from('users u')
            ->join('address a', 'a.userid = u.id', 'left');
        $this->db->where('u.id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }
    function getAllUserAddress()
    {
        $this->db->select('*')
            ->from('address a')
            ->join('users u', 'a.userid = u.id', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }
    function getOrderDetail($id)
    {
        $sql = 'select P.name, P.price, O.orderdate, I.quantity from orders O, orderedItems I, products P where I.productId = P.id AND I.orderId = O.id AND O.id =' . $id;

        $query = $this->db->query($sql);

        return $query->result_array();
    }
    function getOrderDetail2($orderId)
    {
        $sql = 'select P.name as productName, P.price, O.comments, O.orderdate, I.quantity, concat(U.fname," ",ifnull(U.lname," "))  as userName, U.mobile, U.email from orders O, orderedItems I, products P, users U where I.productId = P.id AND I.orderId = O.id AND O.userid = U.id AND O.id =' . $orderId;

        $query = $this->db->query($sql);

        return $query->result_array();
    }
    function getTransaction($transId)
    {
        $sql = 'select P.name as productName, P.price, O.comments, O.orderdate, I.quantity, concat(U.fname," ",ifnull(U.lname," "))  as userName, U.mobile, U.email from orders O, orderedItems I, products P, users U where I.productId = P.id AND I.orderId = O.id AND O.userid = U.id AND O.transactionId ="' . $transId.'"';

        $query = $this->db->query($sql);

        return $query->result_array();
    }
    function getMyData()
    {
        $data = array();
        $this->db->select('id,name');
        $this->db->where('parentid !=', 0);
        $Q = $this->db->get('categories');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[$row['id']] = $row['name'];
            }
        }
        $Q->free_result();
        return $data;
    }
    function getRows($params = array(), $tbl)
    {

        $this->db->select('*');

        //$this->db->order_by('created', 'DESC');

        $this->db->from($tbl);

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {

            foreach ($params['conditions'] as $key => $value) {

                $this->db->where($key, $value);
            }
        } else {
            return $params;
        }

        if (array_key_exists("id", $params)) {

            $this->db->where('id', $params['id']);

            $query = $this->db->get();

            $result = $query->row_array();
        } else {
            //sext start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $query->num_rows();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $result = ($query->num_rows() > 0) ? $query->row_array() : FALSE;
            } else {
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }

        //return fetched data
        return $result;
    }
    
    function getCatProducts()
    {
        $this->db->select('c.id as catId, c.name as catName, p.id as prodId, p.name as prodName, p.price, p.ingredients, p.productNo')
            ->from('products p')
            ->join('categories c', 'p.catid = c.id', 'inner');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    function getFavorities($userid) {
        $this->db->select('p.id, p.catid, p.name, p.price, p.ingredients')
            ->from('products p')
            ->join('favorite f', 'p.id = f.productid', 'left')
            ->where('f.userid', $userid);
        $result = $this->db->get();
        return $result->result_array();
    }
}
