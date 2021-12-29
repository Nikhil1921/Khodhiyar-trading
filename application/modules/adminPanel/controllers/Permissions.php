<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends Admin_controller {

	protected $redirect = 'permissions';
	protected $table = 'permissions';
	protected $name = 'permissions';
	protected $title = 'permissions';

	public function index()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $id = $this->main->addPermissions($this->table);
            return flashMsg($id, "Permissions updated.", "Permissions not updated.", $this->redirect);
        } else{
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['operation'] = "add";
            $data['rates'] = array_map(function($arr){
                return $arr['permission'];
            }, $this->main->getall($this->table, 'permission', ['module' => 'rates']));
            $data['items'] = array_map(function($arr){
                return $arr['permission'];
            }, $this->main->getall($this->table, 'permission', ['module' => 'items']));
            $data['suppliers'] = array_map(function($arr){
                return $arr['permission'];
            }, $this->main->getall($this->table, 'permission', ['module' => 'suppliers']));
            
            return $this->template->load('template', $this->name.'/home', $data);
        }
	}
}