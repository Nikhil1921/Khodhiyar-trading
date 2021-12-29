<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('api');
        $this->load->model('api/api_model', 'api');
        $this->load->model('main_model', 'main');
        // mobile();
    }

    protected $table = 'login';

	public function login()
	{
		get();
		verifyRequiredParams(['mobile', 'password']);

        $data = [
                    'mobile'   => $this->input->get('mobile'),
                    'password' => my_crypt($this->input->get('password')),
                    'is_deleted' => 0
                ];

        if($row = $this->api->get($this->table, 'id, name, mobile, is_admin', $data))
        {
            if (! $row['is_admin']) {
                $row['permissions']['rates'] = array_map(function($arr){
                    return $arr['permission'];
                }, $this->main->getall("permissions", 'permission', ['module' => 'rates']));
                $row['permissions']['items'] = array_map(function($arr){
                    return $arr['permission'];
                }, $this->main->getall("permissions", 'permission', ['module' => 'items']));
                $row['permissions']['suppliers'] = array_map(function($arr){
                    return $arr['permission'];
                }, $this->main->getall("permissions", 'permission', ['module' => 'suppliers']));
            }
        	$response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Login successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Login not successful.";
            echoRespnse(400, $response);
        }
	}

	/* public function addGroup()
	{
		post();
		$api = authenticate($this->table);

		verifyRequiredParams(['group_name']);

        $data = [ 'group_name' => strtoupper($this->input->post('group_name')) ];

        if($row = $this->api->add($data, 'item_group'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Group add successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Group add not successful.";
            echoRespnse(400, $response);
        }
	}

    public function updateGroup()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id', 'group_name']);

        $data = [ 'group_name' => strtoupper($this->input->post('group_name')) ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'item_group'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Group update successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Group update not successful.";
            echoRespnse(400, $response);
        }
    }

    public function deleteGroup()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id']);

        $data = [ 'is_deleted' => 1 ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'item_group'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Group delete successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Group delete not successful.";
            echoRespnse(400, $response);
        }
    }

	public function listGroup()
	{
		get();
		$api = authenticate($this->table);

        $data = [ 'is_deleted' => 0 ];

        if($row = $this->api->getall('item_group', 'id, group_name', $data, 'group_name ASC'))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Group list successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Group list not successful.";
            echoRespnse(400, $response);
        }
	} */

	public function addProduct()
	{
		post();
		$api = authenticate($this->table);

		verifyRequiredParams(['item_name']);
        
        $post = [ 
                    'item_name'  => strtoupper($this->input->post('item_name')),
                    'is_deleted' => 0
                ];

        if ($this->api->get('products', 'id', $post))
        {
            $response['error'] = FALSE;
            $response['message'] ="Product already exists.";
            echoRespnse(200, $response);
        }
        
        $data = [ 
                    'item_name' => strtoupper($this->input->post('item_name'))
                ];

        if($row = $this->api->add($data, 'products'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Product add successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Product add not successful.";
            echoRespnse(400, $response);
        }
	}

	public function updateProduct()
	{
		post();
		$api = authenticate($this->table);

		verifyRequiredParams(['id', 'item_name']);

        $post = [ 
                    'id != '     => $this->input->post('id'),
                    'item_name'  => strtoupper($this->input->post('item_name')),
                    'is_deleted' => 0
                ];

        if ($this->api->get('products', 'id', $post))
        {
            $response['error'] = FALSE;
            $response['message'] ="Product already exists.";
            echoRespnse(200, $response);
        }

        $data = [ 
                    'item_name'     => strtoupper($this->input->post('item_name'))
                ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'products'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Product update successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Product update not successful.";
            echoRespnse(400, $response);
        }
	}

    public function deleteProduct()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id']);

        $data = [ 'is_deleted' => 1 ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'products'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Product delete successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Product delete not successful.";
            echoRespnse(400, $response);
        }
    }

	public function listProduct()
	{
		get();
		$api = authenticate($this->table);

        if($row = $this->api->listProduct())
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Product list successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Product list not successful.";
            echoRespnse(400, $response);
        }
	}

    public function addItem()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['item_id', 'rate', 'purchase_date', 'purchase_from']);

        $data = [ 
                    'item_id'       => $this->input->post('item_id'),
                    'weight'        => $this->input->post('weight'),
                    'quantity'      => $this->input->post('quantity') ? $this->input->post('quantity') : 0,
                    'rate'          => $this->input->post('rate'),
                    'purchase_date' => date('Y-m-d', strtotime($this->input->post('purchase_date'))),
                    'purchase_from' => $this->input->post('purchase_from')
                ];

        if($row = $this->api->add($data, 'items'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Item add successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Item add not successful.";
            echoRespnse(400, $response);
        }
    }

    public function updateItem()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id', 'item_id', 'rate', 'purchase_date', 'purchase_from']);

        $data = [ 
                    'item_id'       => $this->input->post('item_id'),
                    'weight'        => $this->input->post('weight'),
                    'quantity'      => $this->input->post('quantity') ? $this->input->post('quantity') : 0,
                    'rate'          => $this->input->post('rate'),
                    'purchase_date' => date('Y-m-d', strtotime($this->input->post('purchase_date'))),
                    'purchase_from' => $this->input->post('purchase_from')
                ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'items'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Item update successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Item update not successful.";
            echoRespnse(400, $response);
        }
    }

    public function deleteItem()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id']);

        $data = [ 'is_deleted' => 1 ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'items'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Item delete successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Item delete not successful.";
            echoRespnse(400, $response);
        }
    }

    public function listItem()
    {
        get();
        $api = authenticate($this->table);

        if($row = $this->api->listItem())
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Item list successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Item list not successful.";
            echoRespnse(400, $response);
        }
    }

    public function addVendor()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['name']);

        $data = [ 
                    'name'        => strtoupper($this->input->post('name')),
                    'mobile'      => $this->input->post('mobile') ? $this->input->post('mobile') : '9999999999',
                    'city'        => $this->input->post('city') ? $this->input->post('city') : 'NA',
                    'create_date' => date('Y-m-d')
                ];

        if($row = $this->api->add($data, 'vendors'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Vendor add successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Vendor add not successful.";
            echoRespnse(400, $response);
        }
    }

    public function updateVendor()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id', 'name']);

        $data = [ 
                    'name'        => strtoupper($this->input->post('name')),
                    'mobile'      => $this->input->post('mobile') ? $this->input->post('mobile') : '9999999999',
                    'city'        => $this->input->post('city') ? $this->input->post('city') : 'NA'
                ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'vendors'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Vendor update successful.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Vendor update not successful.";
            echoRespnse(400, $response);
        }
    }

    public function deleteVendor()
    {
        post();
        $api = authenticate($this->table);

        verifyRequiredParams(['id']);

        $data = [ 'is_deleted' => 1 ];

        if($row = $this->api->update(['id' => $this->input->post('id')], $data, 'vendors'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Vendor delete successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Vendor delete not successful.";
            echoRespnse(400, $response);
        }
    }

    public function listVendor()
    {
        get();
        $api = authenticate($this->table);

        if (!$this->api->get('vendors', 'id, name', ['is_robo' => 'YES', 'is_deleted' => 0])) {
            $none = [
                'name'        => 'NONE',
                'mobile'      => 1111111111,
                'city'        => 'NONE',
                'create_date' => date('Y-m-d'),
                'is_robo'     => 'YES'
            ];

            $this->api->add($none, 'vendors');
        }

        if($row = $this->api->listVendor())
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Vendor list successful.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Vendor list not successful.";
            echoRespnse(400, $response);
        }
    }
}