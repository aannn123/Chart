<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function getData()
    {
        $query = $this->db->query("SELECT b.brand_name, a.area_name, CEIL((SUM(r.compliance)/COUNT(r.compliance))*100) as compliance
        FROM report_product r
            INNER JOIN product p ON r.product_id = p.product_id
            INNER JOIN product_brand b ON p.brand_id  = b.brand_id 
            INNER JOIN store s ON r.store_id = s.store_id
            INNER JOIN store_area a ON s.area_id = a.area_id
            GROUP BY b.brand_name,a.area_name");
        return $query->result_array();
    }

    public function getDataWhere($area, $dateFrom, $dateTo)
    {
        if ($area && $dateFrom && $dateTo) {
            $query = $this->db->query("SELECT b.brand_name, a.area_name, CEIL((SUM(r.compliance)/COUNT(r.compliance))*100) as compliance
            FROM report_product r
                INNER JOIN product p ON r.product_id = p.product_id
                INNER JOIN product_brand b ON p.brand_id  = b.brand_id 
                INNER JOIN store s ON r.store_id = s.store_id
                INNER JOIN store_area a ON s.area_id = a.area_id
                WHERE s.area_id IN ($area) AND r.tanggal BETWEEN '$dateFrom' AND '$dateTo'
                GROUP BY b.brand_name,a.area_name");
        } elseif ($dateFrom && $dateTo) {
            $query = $this->db->query("SELECT b.brand_name, a.area_name, CEIL((SUM(r.compliance)/COUNT(r.compliance))*100) as compliance
            FROM report_product r
                INNER JOIN product p ON r.product_id = p.product_id
                INNER JOIN product_brand b ON p.brand_id  = b.brand_id 
                INNER JOIN store s ON r.store_id = s.store_id
                INNER JOIN store_area a ON s.area_id = a.area_id
                WHERE r.tanggal BETWEEN '$dateFrom' AND '$dateTo'
                GROUP BY b.brand_name,a.area_name");
        } else {
            $query = $this->db->query("SELECT b.brand_name, a.area_name, CEIL((SUM(r.compliance)/COUNT(r.compliance))*100) as compliance
            FROM report_product r
                INNER JOIN product p ON r.product_id = p.product_id
                INNER JOIN product_brand b ON p.brand_id  = b.brand_id 
                INNER JOIN store s ON r.store_id = s.store_id
                INNER JOIN store_area a ON s.area_id = a.area_id
                WHERE s.area_id IN ($area)
                GROUP BY b.brand_name,a.area_name");
        }
        return $query->result_array();
    }

    public function getCalculation()
    {
        $query = $this->db->query("SELECT a.area_name, ROUND((SUM(r.compliance)/COUNT(r.compliance))*100, 1) as compliance FROM report_product r INNER JOIN product p ON r.product_id = p.product_id INNER JOIN product_brand b ON p.brand_id = b.brand_id INNER JOIN store s ON r.store_id = s.store_id INNER JOIN store_area a ON s.area_id = a.area_id GROUP BY a.area_name");

        return $query->result_array();
    }

    public function getCalculationWhere($area, $dateFrom, $dateTo)
    {
        if ($area && $dateFrom && $dateTo) {
            $query = $this->db->query("SELECT a.area_name, ROUND((SUM(r.compliance)/COUNT(r.compliance))*100, 1) as compliance FROM report_product r INNER JOIN product p ON r.product_id = p.product_id INNER JOIN product_brand b ON p.brand_id = b.brand_id INNER JOIN store s ON r.store_id = s.store_id INNER JOIN store_area a ON s.area_id = a.area_id WHERE s.area_id IN ($area) AND r.tanggal BETWEEN '$dateFrom' AND '$dateTo' GROUP BY a.area_name");
        } elseif ($dateFrom && $dateTo) {
            $query = $this->db->query("SELECT a.area_name, ROUND((SUM(r.compliance)/COUNT(r.compliance))*100, 1) as compliance FROM report_product r INNER JOIN product p ON r.product_id = p.product_id INNER JOIN product_brand b ON p.brand_id = b.brand_id INNER JOIN store s ON r.store_id = s.store_id INNER JOIN store_area a ON s.area_id = a.area_id WHERE r.tanggal BETWEEN '$dateFrom' AND '$dateTo' GROUP BY a.area_name");
        } else {
            $query = $this->db->query("SELECT a.area_name, ROUND((SUM(r.compliance)/COUNT(r.compliance))*100, 1) as compliance FROM report_product r INNER JOIN product p ON r.product_id = p.product_id INNER JOIN product_brand b ON p.brand_id = b.brand_id INNER JOIN store s ON r.store_id = s.store_id INNER JOIN store_area a ON s.area_id = a.area_id WHERE a.area_id IN ($area) GROUP BY a.area_name");
        }

        return $query->result_array();
    }
}
