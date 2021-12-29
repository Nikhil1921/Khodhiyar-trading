<?php 
/**
 * 
 */
class Api_model extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function add($post, $table)
	{
		if ($this->db->insert($table, $post)) {
			$id = $this->db->insert_id();
			return ($id) ? $id : true;
		}else
			return false;
	}

	public function get($table, $select, $where)
	{
		return $this->db->select($select)
						->from($table)
						->where($where)
						->get()
						->row_array();
	}

	public function getall($table, $select, $where, $order_by = '', $limit = '')
	{
		$this->db->select($select)
				 ->from($table)
				 ->where($where);

		if ($order_by != '') 
			$this->db->order_by($order_by);
		
		if ($limit != '') 
			$this->db->limit($limit);
		
		return  $this->db->get()
						 ->result_array();
	}

	public function listProduct()
	{
		$this->db->select('p.id, p.item_name')
				 ->from('products p')
				 ->where(['p.is_deleted' => 0])
				 ->order_by('p.item_name ASC');
		
		return $this->db->get()
				     	->result_array();
	}

	public function listItem()
	{
		$this->db->select('i.id, i.item_id, p.item_name, i.rate, DATE_FORMAT(i.purchase_date, "%d-%m-%Y") purchase_date, i.quantity, v.name purchase_from, p.item_name, i.weight, i.purchase_from vendor_id')
				 ->from('items i')
				 ->where(['i.is_deleted' => 0, 'p.is_deleted' => 0, 'v.is_deleted' => 0]);
		
		if ($item_id = $this->input->get('item_id'))
		 	$this->db->where(['i.item_id' => $item_id]);
		if ($purchase_from = $this->input->get('purchase_from'))
		 	$this->db->where(['i.purchase_from' => $purchase_from]);
		if ($purchase_date = $this->input->get('purchase_date'))
		 	$this->db->where(['i.purchase_date' => $purchase_date]);
		
		$this->db->join('products p', 'p.id = i.item_id')
				 ->join('vendors v', 'v.id = i.purchase_from', 'left')
				 ->order_by('i.purchase_date DESC');
		
		return  $this->db->get()
						 ->result_array();
	}

	public function listVendor()
	{
		$this->db->select('id, name, mobile, city, DATE_FORMAT(create_date, "%d-%m-%Y") create_date, is_robo')
				 ->from('vendors')
				 ->where(['is_deleted' => 0])
				 ->order_by('is_robo ASC')
				 ->order_by('name ASC');
		
		return  $this->db->get()
						 ->result_array();
	}

	public function check($table, $where, $select)
	{
		if ($return = $this->db->select($select)->from($table)->where($where)->get()->row_array())
			return $return[$select];
		else
			return false;
	}

	public function update($where, $post, $table)
	{
		return $this->db->where($where)->update($table, $post);
	}

	public function delete($table, $where)
	{
		return $this->db->delete($table, $where);
	}
}