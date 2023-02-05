<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sr extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Sr_model');	
		
		if($this->session->userdata('authenticated') == false){
			redirect('Auth/login');
	    }
	}

	public function index(){		
		// Core Parameter
		$data['navi_side_act'] 		= "5.1";
		$data['navi_head'] 			= BASE_URL('sr');
		$data['navi_head_root'] 	= "Sales & Report";
		$data['navi_head_act'] 		= "Daily Sales";
		// Core Parameter

   		$this->load->view('core/core_main');
		$this->load->view('core/core_navbar');

		$data['d_list'] 			= $this->Sr_model->read();
		$this->load->view('sr/page_sales_list', $data);
	}

	public function date_get(){		
		$primary 					= $this->input->post('primary');
		$result 					= $this->Sr_model->date_get($primary);

		echo json_encode($result);
	}		

	public function date_add(){
	    $data['date_sale'] 				= $this->input->post('date_sale');
	    $data['created_by'] 			= $this->session->username;

	    $check 							= $this->Sr_model->check_exist($data['date_sale']);
	    if($check == true){
	    	$this->session->set_flashdata('msg_action', '	<span class="label label-block label-danger" style="width:180px; float: right; vertical-align: middle;"> 
																Date already exist
															</span> '); 

		   	redirect('Sr');
	    }else{
	    	$result 					= $this->Sr_model->date_register($data);

	    	if($result){
		        $this->session->set_flashdata('msg_action', '	<span class="label label-block label-success" style="width:180px; float: right; vertical-align: middle;"> 
																	Date Succesfully Added
																</span> '); 

		        redirect('Sr');
		    }else{
		        $this->session->set_flashdata('msg_action', '	<span class="label label-block label-danger" style="width:180px; float: right; vertical-align: middle;"> 
																	Date Failed To Add
																</span> '); 

		        redirect('Sr');
		    }
	    }	    	    
	}

	public function date_update(){	    	   
	    $primary 						= $this->input->post('date_primary');
	    $data['date_sale'] 				= $this->input->post('date_edit');
	    $data['modified_by'] 			= $this->session->username;

	    $result 						= $this->Sr_model->date_update($primary, $data);	    	

    	if($result){    		    		
	        $this->session->set_flashdata('msg_action', '	<span class="label label-block label-success" style="width:180px; float: right; vertical-align: middle;"> 
																Date Succesfully Updated
															</span> '); 

	        redirect('Sr');
	    }else{
	        $this->session->set_flashdata('msg_action', '	<span class="label label-block label-danger" style="width:180px; float: right; vertical-align: middle;"> 
																Date Failed To Update
															</span> '); 

	        redirect('Sr');
	    }    	   
	}

	public function date_detail($date_primary, $date_sale){		
		// Core Parameter
		$data['navi_side_act'] 		= "5.1";
		$data['navi_head'] 			= BASE_URL('sr');
		$data['navi_head_root'] 	= "Sales & Report";
		$data['navi_head_act'] 		= "Daily Sales Detail";
		// Core Parameter

   		$this->load->view('core/core_main');
		$this->load->view('core/core_navbar');

		$data['date_primary']		= urldecode($date_primary);
		$data['date_sale']			= urldecode($date_sale);

		$data['ps_list'] 			= $this->Sr_model->sales_personel_list();
		$data['i_list'] 			= $this->Sr_model->sales_item_list();

		$data['sd_list'] 			= $this->Sr_model->read_detail($date_primary);
		$this->load->view('sr/page_sales_detail', $data);
	}	

	public function date_delete($primary){
		$this->Sr_model->date_delete($primary);

		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('msg_action', '	<span class="label label-block label-success" style="width:180px; float: right; vertical-align: middle;"> 
																Date Succesfully Deleted
															</span> '); 
		}else{
			$this->session->set_flashdata('msg_action', ' 	<span class="label label-block label-danger" style="width:180px; float: right; vertical-align: middle;"> 
																Date Failed To Delete
															</span>'); 
		}

		redirect('Sr');
	}

	public function sale_add(){
		$primary 						= $this->input->post('sale_primary');
		$data['parent'] 				= $this->input->post('parent');
	    $data['personel'] 				= $this->input->post('personel');
	    $data['item'] 					= $this->input->post('item');
	    $data['item_satuan'] 			= $this->input->post('item_satuan');
	    $data['item_price'] 			= $this->input->post('item_price');
	    $data['item_qty'] 				= $this->input->post('item_qty');
	    $data['item_price_total'] 		= $this->input->post('item_price_total');  

	    $check 							= $this->Sr_model->sale_check($primary);
	    if($check == true){
	    	$data['modified_by'] 		= $this->session->username;
	    	$result 					= $this->Sr_model->sale_update($primary, $data);	    	

		   	return $result;
	    }else{ 
	    	$data['created_by'] 		= $this->session->username;	    	
	    	$result 					= $this->Sr_model->sale_register($data);

	    	return $result;
	    }	    	    
	}	

	public function sale_get(){		
		$primary 					= $this->input->post('primary');
		$result 					= $this->Sr_model->sale_get($primary);

		echo json_encode($result);
	}		

	public function sale_delete($primary, $parent){
		$this->Sr_model->sale_delete($primary);

		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('msg_action', '	<span class="label label-block label-success" style="width:180px; float: right; vertical-align: middle;"> 
																Sale Succesfully Deleted
															</span> '); 
		}else{
			$this->session->set_flashdata('msg_action', ' 	<span class="label label-block label-danger" style="width:180px; float: right; vertical-align: middle;"> 
																Sale Failed To Delete
															</span>'); 
		}

		redirect('Sr/date_detail/'.$parent);
	}

	public function report_bg(){		
		// Core Parameter
		$data['navi_side_act'] 		= "5.2";
		$data['navi_head'] 			= BASE_URL('sr');
		$data['navi_head_root'] 	= "Sales & Report";
		$data['navi_head_act'] 		= "Report Barang Masuk";
		// Core Parameter

   		$this->load->view('core/core_main');
		$this->load->view('core/core_navbar');

		$data['d_list'] 			= $this->Sr_model->read();
		$data['i_list'] 			= $this->Sr_model->item_list();
		$this->load->view('sr/page_report_bg', $data);
	}

	public function report_bg_search(){		
		// Core Parameter
		$data['navi_side_act'] 		= "5.2";
		$data['navi_head'] 			= BASE_URL('sr');
		$data['navi_head_root'] 	= "Sales & Report";
		$data['navi_head_act'] 		= "Report Barang Masuk";
		// Core Parameter

   		$this->load->view('core/core_main');
		$this->load->view('core/core_navbar');

		$date_1 					= $this->input->post('date_1');
		$date_2 					= $this->input->post('date_2');
		$stock_item 				= $this->input->post('stock_item');
		$data['periode'] 			= "";

		if($date_1 != $date_2){
			$data['periode'] 		= $date_1." s/d ".$date_2;
		}else{
			$data['periode'] 		= $date_1;
		}

		// Read Datatable 
			$this->db->select('	a.`primary`,
								 a.distributor,								 								 								 
								 a.date_arv,
								 DATE_FORMAT(a.date_arv, "%d-%m-%y") as f_date_arv,								 
								 a.invoice,								 
								 a.stock_item,								 
								 a.cs_id AS stock_id,
								 a.cs_price AS stock_price,
								 a.cs_qty_rcv AS stock_qty_rcv,
								 a.ext_non_promo,
								 a.ext_non_promo_price,
								 a.ext_promo,
								 a.ext_promo_price,
								 a.ext_net, 
								 a.ext_net_price, 
								 b.item as nm_item ');

	        $this->db->from(' mst_stocks as a 
	        				  LEFT JOIN ( SELECT `primary`, item 
	        				  			  FROM mst_items 
	        				  			  GROUP BY `primary` ) as b
	        				  			  on a.stock_item = b.primary   ');        	        	        

	        if($date_1 != ''){
	        	$this->db->where('a.date_arv BETWEEN "'. $date_1. '" and "'. $date_2.'"');
	        }
	        
	        if($stock_item != ''){
	        	$this->db->where('a.stock_item', $stock_item);
	        }

	        $query1 = $this->db->get_compiled_select();

	        $this->db->select(' a.`primary`,
								 a.distributor,								 								 								 
								 a.date_arv,
								 DATE_FORMAT(a.date_arv, "%d-%m-%y") as f_date_arv,								 
								 a.invoice,								 
								 a.stock_item,								 
								 a.dz_id AS stock_id,
								 a.dz_price AS stock_price,
								 a.dz_qty_rcv AS stock_qty_rcv, 
								 a.ext_non_promo,
								 a.ext_non_promo_price,
								 a.ext_promo,
								 a.ext_promo_price,
								 a.ext_net, 
								 a.ext_net_price, 
								 b.item as nm_item ');

	        $this->db->from(' mst_stocks as a 
	        				  LEFT JOIN ( SELECT `primary`, item 
	        				  			  FROM mst_items 
	        				  			  GROUP BY `primary` ) as b
	        				  			  on a.stock_item = b.primary   ');        	             

	        if($date_1 != ''){
		        $this->db->where('a.date_arv BETWEEN "'. $date_1. '" and "'. $date_2.'"');
		    }
	        
	        if($stock_item != ''){
	        	$this->db->where('a.stock_item', $stock_item);
	        }

	        $query2 = $this->db->get_compiled_select();

	        $this->db->select(' a.`primary`,
								 a.distributor,								 								 								 
								 a.date_arv,
								 DATE_FORMAT(a.date_arv, "%d-%m-%y") as f_date_arv,								 
								 a.invoice,								 
								 a.stock_item,								 
								 a.pc_id AS stock_id,
								 a.pc_price AS stock_price,
								 a.pc_qty_rcv AS stock_qty_rcv, 
								 a.ext_non_promo,
								 a.ext_non_promo_price,
								 a.ext_promo,
								 a.ext_promo_price,
								 a.ext_net, 
								 a.ext_net_price, 
								 b.item as nm_item ');

	        $this->db->from(' mst_stocks as a 
	        				  LEFT JOIN ( SELECT `primary`, item 
	        				  			  FROM mst_items 
	        				  			  GROUP BY `primary` ) as b
	        				  			  on a.stock_item = b.primary   ');        	             

	        if($date_1 != ''){
	        	$this->db->where('a.date_arv BETWEEN "'. $date_1. '" and "'. $date_2.'"');
	        }
	        
	        if($stock_item != ''){
	        	$this->db->where('a.stock_item', $stock_item);
	        }

	        $this->db->order_by('date_arv', 'ASC');
	        $this->db->order_by('stock_item', 'ASC');	    
	        $this->db->order_by('invoice', 'ASC');
	        $this->db->order_by('distributor', 'ASC');
	        $this->db->order_by('stock_id', 'ASC');
	        $query3 = $this->db->get_compiled_select();

	        $data['bg_list'] 		= $this->db->query($query1 . ' UNION ' . $query2 . ' UNION ' . $query3)->result();	        
	  	// Read Datatable 

	   	$data['i_list'] 			= $this->Sr_model->item_list();
		$this->load->view('sr/page_report_bg_details', $data);
	}	

	public function report_trades(){		
		// Core Parameter
		$data['navi_side_act'] 		= "5.3";
		$data['navi_head'] 			= BASE_URL('sr');
		$data['navi_head_root'] 	= "Sales & Report";
		$data['navi_head_act'] 		= "Report Pembelian & Penjulan";
		// Core Parameter

   		$this->load->view('core/core_main');
		$this->load->view('core/core_navbar');

		$data['d_list'] 			= $this->Sr_model->read();
		$data['i_list'] 			= $this->Sr_model->item_list();
		$this->load->view('sr/page_report_trades', $data);
	}

	public function report_trades_search(){		
		// Core Parameter
		$data['navi_side_act'] 		= "5.3";
		$data['navi_head'] 			= BASE_URL('sr');
		$data['navi_head_root'] 	= "Sales & Report";
		$data['navi_head_act'] 		= "Report Pembelian & Penjulan";
		// Core Parameter

   		$this->load->view('core/core_main');
		$this->load->view('core/core_navbar');

		$date_1 					= $this->input->post('date_1');
		$date_2 					= $this->input->post('date_2');
		$stock_item 				= $this->input->post('stock_item');
		$data['periode'] 			= "";

		if($date_1 != $date_2){
			$data['periode'] 		= $date_1." s/d ".$date_2;
		}else{
			$data['periode'] 		= $date_1;
		}

		// Read Datatable 
			$this->db->select('	a.`primary`,
								 a.distributor,								 								 								 
								 a.date_arv,
								 DATE_FORMAT(a.date_arv, "%d-%m-%y") as f_date_arv,								 
								 a.invoice,								 
								 a.stock_item,								 
								 a.cs_id AS stock_id,
								 a.cs_price AS stock_price,
								 a.cs_qty_rcv AS stock_qty_rcv,
								 b.item as nm_item, 
								 d.item_qty,
								 d.item_price,
								 d.item_price_total ');

	        $this->db->from(' mst_stocks as a 
	        				  LEFT JOIN ( SELECT `primary`, item 
	        				  			  FROM mst_items 
	        				  			  GROUP BY `primary` ) as b
	        				  			  on a.stock_item = b.primary
	        				  LEFT JOIN ( SELECT `primary`, date_sale 
	        				  			  FROM tbl_daily_sales 
	        				  			  WHERE date_sale BETWEEN "'. $date_1. '" and "'. $date_2.'"
	        				  			  GROUP BY `date_sale` ) as c
	        				  			  on a.date_arv = c.date_sale 
	        				  LEFT JOIN ( SELECT `primary`, parent, item, 
	        				  			  SUM(item_qty) as item_qty, item_price, item_satuan, item_price_total 
	        				  			  FROM tbl_daily_sales_details 
	        				  			  WHERE item_satuan = "Cs"
	        				  			  GROUP BY `item` ) as d
	        				  			  on c.primary = d.parent
	        				  			  AND a.stock_item = d.item   ');

	        if($date_1 != ''){
	        	$this->db->where('a.date_arv BETWEEN "'. $date_1. '" and "'. $date_2.'"');
	        }
	        
	        if($stock_item != ''){
	        	$this->db->where('a.stock_item', $stock_item);
	        }

	        $query1 = $this->db->get_compiled_select();

	        $this->db->select(' a.`primary`,
								 a.distributor,								 								 								 
								 a.date_arv,
								 DATE_FORMAT(a.date_arv, "%d-%m-%y") as f_date_arv,								 
								 a.invoice,								 
								 a.stock_item,								 
								 a.dz_id AS stock_id,
								 a.dz_price AS stock_price,
								 a.dz_qty_rcv AS stock_qty_rcv, 
								 b.item as nm_item, 
								 d.item_qty,
								 d.item_price,
								 d.item_price_total ');

	        $this->db->from(' mst_stocks as a 
	        				  LEFT JOIN ( SELECT `primary`, item 
	        				  			  FROM mst_items 
	        				  			  GROUP BY `primary` ) as b
	        				  			  on a.stock_item = b.primary
	        				  LEFT JOIN ( SELECT `primary`, date_sale 
	        				  			  FROM tbl_daily_sales 
	        				  			  WHERE date_sale BETWEEN "'. $date_1. '" and "'. $date_2.'"
	        				  			  GROUP BY `date_sale` ) as c
	        				  			  on a.date_arv = c.date_sale 
	        				  LEFT JOIN ( SELECT `primary`, parent, item, 
	        				  			  SUM(item_qty) as item_qty, item_price, item_satuan, item_price_total 
	        				  			  FROM tbl_daily_sales_details 
	        				  			  WHERE item_satuan = "Dz"
	        				  			  GROUP BY `item` ) as d
	        				  			  on c.primary = d.parent
	        				  			  AND a.stock_item = d.item   ');

	        if($date_1 != ''){
		        $this->db->where('a.date_arv BETWEEN "'. $date_1. '" and "'. $date_2.'"');
		    }
	        
	        if($stock_item != ''){
	        	$this->db->where('a.stock_item', $stock_item);
	        }

	        $query2 = $this->db->get_compiled_select();

	        $this->db->select(' a.`primary`,
								 a.distributor,								 								 								 
								 a.date_arv,
								 DATE_FORMAT(a.date_arv, "%d-%m-%y") as f_date_arv,								 
								 a.invoice,								 
								 a.stock_item,								 
								 a.pc_id AS stock_id,
								 a.pc_price AS stock_price,
								 a.pc_qty_rcv AS stock_qty_rcv, 
								 b.item as nm_item, 
								 d.item_qty,
								 d.item_price,
								 d.item_price_total ');

	        $this->db->from(' mst_stocks as a 
	        				  LEFT JOIN ( SELECT `primary`, item 
	        				  			  FROM mst_items 
	        				  			  GROUP BY `primary` ) as b
	        				  			  on a.stock_item = b.primary
	        				  LEFT JOIN ( SELECT `primary`, date_sale 
	        				  			  FROM tbl_daily_sales 
	        				  			  WHERE date_sale BETWEEN "'. $date_1. '" and "'. $date_2.'"
	        				  			  GROUP BY `date_sale` ) as c
	        				  			  on a.date_arv = c.date_sale 
	        				  LEFT JOIN ( SELECT `primary`, parent, item, 
	        				  			  SUM(item_qty) as item_qty, item_price, item_satuan, item_price_total 
	        				  			  FROM tbl_daily_sales_details 
	        				  			  WHERE item_satuan = "Pc"
	        				  			  GROUP BY `item` ) as d
	        				  			  on c.primary = d.parent
	        				  			  AND a.stock_item = d.item   ');

	        if($date_1 != ''){
	        	$this->db->where('a.date_arv BETWEEN "'. $date_1. '" and "'. $date_2.'"');
	        }
	        
	        if($stock_item != ''){
	        	$this->db->where('a.stock_item', $stock_item);
	        }

	        $this->db->order_by('date_arv', 'ASC');
	        $this->db->order_by('stock_item', 'ASC');	        
	        $this->db->order_by('invoice', 'ASC');
	        $this->db->order_by('distributor', 'ASC');
	        $this->db->order_by('stock_id', 'ASC');
	        $query3 = $this->db->get_compiled_select();

	        $data['bg_list'] 		= $this->db->query($query1 . ' UNION ' . $query2 . ' UNION ' . $query3)->result();	        
	  	// Read Datatable 

	   	$data['i_list'] 			= $this->Sr_model->item_list();
		$this->load->view('sr/page_report_trades_details', $data);
	}	
}