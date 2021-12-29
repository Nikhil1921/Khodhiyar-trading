<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends Admin_controller {

	protected $redirect = 'inventory';
	protected $name = 'inventory';
	protected $title = 'rate(s)';
	protected $table = 'items';

	public function index()
	{
		$data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['dataTable'] = true;

		return $this->template->load('template', $this->redirect.'/home', $data);
	}

    public function get()
    {
        $this->load->model('inventory_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->item_name;
            $sub_array[] = $row->rate;
            $sub_array[] = $row->quantity;
            $sub_array[] = $row->weight;
            $sub_array[] = date('d-m-Y', strtotime($row->purchase_date));
            $sub_array[] = $row->vendor;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        echo json_encode($output);
    }
}
