<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_controller {

	protected $redirect = 'users';
	protected $name = 'user';
	protected $title = 'user';
	protected $table = 'login';

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
        $this->load->model('users_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            $action = '<div style="display: inline-flex;" class="icon-btn">';
            $action .= anchor("$this->redirect/update/".e_id($row->id), '<i class="fa fa-pencil" ></i>', ['class' => 'btn btn-primary btn-outline-primary btn-icon mr-2']);

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
            form_button([ 'content' => '<i class="fa fa-trash"></i>',
                'type'  => 'button',
                'class' => 'btn btn-danger btn-outline-danger btn-icon', 
                'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
            form_close();

            $action .= '</div>';
            $sub_array[] = $action;

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

	public function add()
	{
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['operation'] = "add";
            $data['url'] = $this->redirect;
            $data['data'] = [];
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        {
        	$post = [
                'name'     => $this->input->post('name'),
                'mobile'   => $this->input->post('mobile'),
                'email'    => $this->input->post('email'),
                'password' => my_crypt($this->input->post('password'))
            ];
            
        	$id = $this->main->add($post, $this->table);

        	flashMsg($id, ucwords($this->title)." Added Successfully.", ucwords($this->title)." Not Added. Try again.", $this->redirect);
        }
	}

    public function update($id)
	{
        $this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['id'] = $id;
			$data['title'] = $this->title;
			$data['operation'] = "update";
	        
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get($this->table, 'id, name, mobile, email', ['id' => d_id($id)]);
			
            return $this->template->load(admin('template'), $this->redirect.'/update', $data);
        }
        else
        {
        	$post = [
                'name'     => $this->input->post('name'),
                'mobile'   => $this->input->post('mobile'),
                'email'    => $this->input->post('email')
            ];

            if ($this->input->post('password')) $post['password'] = my_crypt($this->input->post('password'));

        	$id = $this->main->update(['id' => d_id($id)], $post, $this->table);

			flashMsg($id, ucwords($this->title)." Updated Successfully.", ucwords($this->title)." Not Updated. Try again.", $this->redirect);
        }
	}

    public function delete()
	{
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

		flashMsg($id, ucwords($this->title)." Deleted Successfully.", ucwords($this->title)." Not Deleted. Try again.", $this->redirect);
	}

    public function mobile_check($str)
    {   
        $id = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;
        
        if ($this->main->check($this->table, ['mobile' => $str, 'id != ' => $id, 'is_deleted' => 0], 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $id = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;
        
        if ($this->main->check($this->table, ['email' => $str, 'id != ' => $id, 'is_deleted' => 0], 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function password_check($str)
    {   
        if (! $str && ! $this->uri->segment(4))
        {
            $this->form_validation->set_message('password_check', 'The %s is Required');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|exact_length[10]|callback_mobile_check|numeric',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is Invalid",
                'exact_length' => "%s is Invalid",
            ]
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|callback_email_check',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'callback_password_check'
        ]
    ];
}