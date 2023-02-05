<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sr_model extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->helper('string');
    }

    public function read(){
    	$this->db->select(' primary, 
    						date_sale, 
    						DATE_FORMAT(date_sale, "%d-%m-%Y") as f_date ');

        $this->db->from('tbl_daily_sales');
        $this->db->order_by('date_sale', 'DESC');

		$result = $this->db->get()->result();			
		return $result;
	}

	public function read_detail($date_primary){
    	$this->db->select(' a.primary,
    						a.parent, 
    						a.personel, 
    						a.item, 
    						a.item_satuan, 
    						a.item_qty, 
    						a.item_price, 
    						a.item_price_total,
    						b.fullname,
    						c.item as item_name ');

        $this->db->from('tbl_daily_sales_details as a');
        $this->db->join('mst_users as b', 'a.personel = b.primary', 'left');
        $this->db->join('mst_items as c', 'a.item = c.primary', 'left');
		$this->db->where('parent', $date_primary);
		$result = $this->db->get()->result();			
		return $result;
	}

	public function check_exist($date_sale){
		$this->db->where('date_sale', $date_sale);
	    $query = $this->db->get('tbl_daily_sales');
	    
	    if ($query->num_rows() > 0){
	        return true;
	    }else{
	        return false;
	    }
	}	

	public function date_register($data){
   		$result 	= $this->db->insert('tbl_daily_sales', $data);
   		return $result;
    }

    public function date_update($primary, $data){
   		$this->db->where('primary', $primary);
		$result = $this->db->update('tbl_daily_sales', $data);

   		return $result;
    }

    public function date_get($primary){
    	$this->db->select(' tbl_daily_sales.primary, 
							tbl_daily_sales.date_sale ');
    	$this->db->from('tbl_daily_sales');
    	$this->db->where('primary', $primary);

	    $result = $this->db->get()->row();	    
   		return $result;
    }

    public function date_delete($primary){
    	$this->db->where('parent', $primary);
		$this->db->delete('tbl_daily_sales_details');		
		
    	$this->db->where('primary', $primary);
		$this->db->delete('tbl_daily_sales');				
	}

    public function sale_check($primary){
		$this->db->where('primary', $primary);
	    $query = $this->db->get('tbl_daily_sales_details');
	    
	    if ($query->num_rows() > 0){
	        return true;
	    }else{
	        return false;
	    }
	}	

	public function sale_register($data){
   		$result 	= $this->db->insert('tbl_daily_sales_details', $data);
   		
   		return $result;
    }

    public function sale_update($primary, $data){
   		$this->db->where('primary', $primary);
		$result = $this->db->update('tbl_daily_sales_details', $data);

   		return $result;
    }

    public function sale_get($primary){
    	$this->db->select(' a.primary,
    						a.parent, 
    						a.personel, 
    						a.item, 
    						a.item_satuan, 
    						a.item_qty, 
    						a.item_price, 
    						a.item_price_total,
    						b.fullname,
    						c.item as item_name ');
    	$this->db->from('tbl_daily_sales_details as a');
        $this->db->join('mst_users as b', 'a.personel = b.primary', 'left');
        $this->db->join('mst_items as c', 'a.item = c.primary', 'left');
    	$this->db->where('a.primary', $primary);

	    $result = $this->db->get()->row();	    
   		return $result;
    }

    public function sale_delete($primary){
		$this->db->where('primary', $primary);
		$this->db->delete('tbl_daily_sales_details');		
	}

    // Look up data
	public function sales_personel_list(){
    	$this->db->select(' * ');
        $this->db->from('mst_users');
        $this->db->where('position = 4');
		$result = $this->db->get()->result();
		return $result;
	}

	public function sales_item_list(){
    	$this->db->select(' * ');
        $this->db->from('mst_items');
		$result = $this->db->get()->result();
		return $result;
	}

	public function item_list(){
    	$this->db->select(' * ');
        $this->db->from('mst_items');
		$result = $this->db->get()->result();
		return $result;
	}
	// Look up data
}