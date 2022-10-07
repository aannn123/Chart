<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Area_model extends CI_Model
{
    public function getArea($area)
    {
        $query = $this->db->query("SELECT * from store_area");
        return $query->result_array();
    }

    public function getAreaWhere($area)
    {
        if ($area) {
            $query = $this->db->query("SELECT * from store_area WHERE area_id IN ($area)");
        } else {
            $query = $this->db->query("SELECT * from store_area");
        }
        return $query->result_array();
    }
}
