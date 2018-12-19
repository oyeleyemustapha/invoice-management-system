<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Invoice_model extends CI_Model{


 	//FETCH CAFETERIA SETTING
 	function fetch_cafeteria(){
 		$this->db->select('*');
 		$this->db->from('setting');
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//LOG STAFF LOG IN
 	function log_staff($log){
 		if($this->db->insert('logs', $log)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}


 	//PROCESS LOGIN
 	function process_login($username, $password){
 		$this->db->select('*');
 		$this->db->from('staff');
 		$this->db->where('USERNAME', $username);
 		$this->db->where('PASSWORD', $password);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//VERIFY USER
 	function verify_user($username, $password){
 		$this->db->select('*');
 		$this->db->from('staff');
 		$this->db->where('USERNAME', $username);
 		$this->db->where('PASSWORD', $password);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//=========================
 	//==========================
 	//CLIENTS
 	//=========================
 	//=========================
 

 	//ADD CLIENT
 	function add_client($client){
 		if($this->db->insert('customer', $client)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH CLIENT LIST
 	function fetch_client_list(){
 		$this->db->select('*');
 		$this->db->from('customer');
 		$this->db->order_by('NAME', 'ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}


 	//FETCH CLIENT INFO
 	function fetch_client_info($client){
 		$this->db->select('*');
 		$this->db->from('customer');
 		$this->db->where('CUSTOMER_ID', $client);
 		$query=$this->db->get();
 		if($query->num_rows()==1){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//UPDATE CLIENT INFO
 	function update_client($client){
 		$this->db->where('CUSTOMER_ID', $client['CUSTOMER_ID']);
		if($this->db->update('customer', $client)){
			return true;
		}
		else{
			return false;
		}
 	}


 	//UPDATE PROFILE
 	function update_profile($profile){
 		
		if($this->db->update('staff', $profile)){
			return true;
		}
		else{
			return false;
		}
 	}


 	//FETCH COMPANY INFO
 	function fetch_company_info(){
 		$this->db->select('*');
 		$this->db->from('company');
 		$this->db->where('ID', 1);
 		$query=$this->db->get();
 		if($query->num_rows()==1){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}



 	//UPDATE COMPANY INFOMATION
 	function update_company_info($info){
		if($this->db->update('company', $info)){
			return true;
		}
		else{
			return false;
		}
 	}



 	//FETCH PRODUCT LIST TO BE USED IN SELECT2 PLUGIN
 	function fetch_client_list_select($search){
 		$this->db->select('CUSTOMER_ID, NAME');
 		$this->db->from('customer');
 		$this->db->where('NAME REGEXP', $search);
 		$query=$this->db->get();
 		return $query->result_array();
 	}



 	//=========================
 	//==========================
 	//INVOICE
 	//=========================
 	//=========================
 

 	//ADD INVOICE
 	function create_invoice($invoice){
 		if($this->db->insert('invoice_order', $invoice)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}


 	//UPDATE INVOICE
 	function update_invoice($invoice){

 		$this->db->where('INVOICE_ID', $invoice['INVOICE_ID']);
		if($this->db->update('invoice_order', $invoice)){
			return true;
		}
		else{
			return false;
		}
 	}


 	//UPDATE INVOICE META INFO
 	function update_invoice_meta($invoice){

 		$this->db->where('REF_NO', $invoice['REF_NO']);
		if($this->db->update('invoice_order', $invoice)){
			return true;
		}
		else{
			return false;
		}
 	}


 	//FETCH LIST OF CREATED INVOICES
 	function fetch_invoice_list(){
 		$this->db->select('invoice_order.INVOICE_ID, invoice_order.REF_NO, invoice_order.SERVICE, invoice_order.DATE_CREATED, invoice_order.STATUS, customer.NAME');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->order_by('invoice_order.REF_NO', 'DESC');
 		$query=$this->db->get();
 		return $query->result();
 	}


 	//FETCH INVOICE INFO BY REF NO
 	function invoice_info($ref_no){
 		$this->db->select('invoice_order.INVOICE_ID, invoice_order.REF_NO, invoice_order.SERVICE, invoice_order.DATE_CREATED, invoice_order.STATUS, customer.NAME, invoice_order.AMOUNT, invoice_order.DESCRIPTION, invoice_order.CUSTOMER_ID, invoice_order.DUE_DATE');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('invoice_order.REF_NO', $ref_no);
 		$query=$this->db->get();
 		return $query->result();
 	}


 	//GENERATE INVOICE 
 	function generate_invoice($ref_no){
 		$this->db->select('invoice_order.REF_NO, invoice_order.SERVICE, invoice_order.DATE_CREATED, customer.NAME, invoice_order.AMOUNT, invoice_order.DESCRIPTION, invoice_order.DUE_DATE, customer.PHONE, customer.EMAIL, invoice_order.STATUS, invoice_order.TYPE');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('invoice_order.REF_NO', $ref_no);
 		$query=$this->db->get();
 		return $query->result();
 	}


 	//DELETE SERVICE ITEM FRM INVOICE
 	function delete_invoice_item($invoice_id){
 		$this->db->where('INVOICE_ID', $invoice_id);
 		if($this->db->delete('invoice_order')){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}




 	//FETCH PROFILE INFO OF THE USER
 	function fetch_profile(){
 		$this->db->select('*');
 		$this->db->from('staff');
 		$query=$this->db->get();
 		return $query->row();
 	}



 	//MONTHLY REPORT
 	function report_month($month){
 		$this->db->select('invoice_order.REF_NO, invoice_order.SERVICE, customer.NAME, invoice_order.AMOUNT, invoice_order.DATE_CREATED');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('MONTH(invoice_order.DATE_CREATED)', $month['MONTH']);
 		$this->db->where('YEAR(invoice_order.DATE_CREATED)', $month['YEAR']);
 		$this->db->where('invoice_order.TYPE', 'Tax');
 		$this->db->order_by('invoice_order.DATE_CREATED', 'ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}


 	//FETCH ANNUAL REPORTS FOR A PARTICULAR YEAR
 	function annual_report($year){
 		$this->db->select('invoice_order.REF_NO, invoice_order.SERVICE, customer.NAME, invoice_order.AMOUNT, invoice_order.DATE_CREATED');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('YEAR(invoice_order.DATE_CREATED)', $year);
 		$this->db->where('invoice_order.TYPE', 'Tax');
 		$this->db->order_by('invoice_order.DATE_CREATED', 'ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	
 	


 	






}


?>