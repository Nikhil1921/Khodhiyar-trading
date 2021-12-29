<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Main_model extends Admin_model
{
	public function addPermissions($table)
    {
        $this->db->trans_start();
        $this->db->empty_table($table);
        if ($this->input->post('permissions')) {
            $data = [];
            foreach ($this->input->post('permissions') as $k => $v)
                foreach ($v as $p) 
                    $data[] = ['module' => $k,'permission' => $p];
            $this->db->insert_batch($table, $data);
        }
        $this->db->trans_complete();

		return $this->db->trans_status();
    }
}