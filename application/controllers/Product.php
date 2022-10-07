<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function index()
	{
		$this->load->model('Store/Area_model');
		$this->load->model('Product/Product_model');
		$this->load->model('Product/Brand_model');

		$area = $this->input->get('area') ? implode(',', $this->input->get('area')) : $this->input->get('area');
		$dateFrom = $this->input->get('dateFrom');
		$dateTo = $this->input->get('dateTo');
		// var_dump(implode(',', $area));die();
		$data['areaFilter'] =  $this->Area_model->getArea($area);

		if ($area || $dateFrom || $dateTo) {
			$data['product'] =  $this->Product_model->getDataWhere($area, $dateFrom, $dateTo);
			$calculation = $this->Product_model->getCalculationWhere($area, $dateFrom, $dateTo);
		} else {
			$data['product'] =  $this->Product_model->getData();
			$calculation = $this->Product_model->getCalculation();
		}

		$data['area'] =  $this->Area_model->getArea($area);

		$data['brand'] =  $this->Brand_model->getBrand();

		if (count($calculation) > 0) {
			foreach ($calculation as $row) {
				$areaData[] = $row['area_name'];
			}
		} else {
			$areaData = [];
		}


		if (count($calculation) > 0) {
			foreach ($calculation as $row) {
				$calculationData[] = $row['compliance'];
			}
		} else {
			$calculationData = [];
		}
		
		$data['area_js'] = json_encode($areaData);
		$data['value_js'] = json_encode($calculationData);
		$data['areaId'] = $area;
		$data['dateFrom'] = $dateFrom;
		$data['dateTo'] = $dateTo;
		$this->load->view('product/index', $data);
	}
}
