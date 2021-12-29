<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Vendor_model extends Admin_model
{
	public $table = "vendors v";
	public $select_column = ['v.id', 'v.name', 'v.mobile', 'v.city', 'v.create_date'];
	public $search_column = ['v.name', 'v.mobile', 'v.city', 'v.create_date'];
    public $order_column = [null, 'v.name', 'v.mobile', 'v.city', 'v.create_date', null];
	public $order = ['v.id' => 'DESC'];

	public function make_query()  
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['v.is_deleted' => 0]);
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
		return $this->db->select('v.id')
		            	 ->from($this->table)
		            	 ->where(['v.is_deleted' => 0])
		            	 ->get()
						 ->num_rows();
	}
}