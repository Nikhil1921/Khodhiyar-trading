<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Inventory_model extends Admin_model
{
	public $table = "items i";
	public $select_column = ['i.id', 'p.item_name', 'i.rate', 'i.quantity', 'i.weight', 'i.purchase_date', 'v.name vendor'];
	public $search_column = ['p.item_name', 'i.rate', 'i.quantity', 'i.weight', 'i.purchase_date', 'v.name'];
    public $order_column = [null, 'p.item_name', 'i.rate', 'i.quantity', 'i.weight', 'i.purchase_date', 'v.name', null];
	public $order = ['i.id' => 'DESC'];

	public function make_query()  
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['i.is_deleted' => 0, 'v.is_deleted' => 0, 'p.is_deleted' => 0])
            	 ->join('vendors v', 'v.id = i.purchase_from')
            	 ->join('products p', 'p.id = i.item_id');

        if ($this->input->post('date')):
            $this->db->where('i.create_date', date('Y-m-d', strtotime($this->input->post('date'))));
        endif;

        $i = 0;
        
        foreach ($this->search_column as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->search_column) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}

	public function count()
	{
		$this->db->select('i.id')
		     	 ->from($this->table)
		         ->where(['i.is_deleted' => 0, 'v.is_deleted' => 0, 'p.is_deleted' => 0]);

		return $this->db->join('vendors v', 'v.id = i.purchase_from')
		            	->join('products p', 'p.id = i.item_id')
		            	->get()
						->num_rows();
	}
}