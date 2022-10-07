<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand_model extends CI_Model
{
    public function getBrand()
    {
        $query = $this->db->query("SELECT * from product_brand");
        return $query->result_array();
    }
}

