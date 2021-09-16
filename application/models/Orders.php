<?php
class AdminModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getOrderDetail($orderId)
    {
        // Inserting Data
        if ($this->db->insert($tbl, $data)) {
            return true;
        } else {
            return false;
        }
    }
}
