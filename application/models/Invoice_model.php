<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Invoice_model extends CI_Model{


 	//===============================
 	//===============================
 	//AUTHENTICATION AND AUTORIZATION
 	//===============================
 	//===============================

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


 	//===========================
 	//===========================
 	//STAFF
 	//==========================
 	//==========================
 

 	//ADD STAFF
 	function add_staff($staff){
 		if($this->db->insert('staff', $staff)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH STAFF LIST
 	function fetch_staff_list(){
 		$this->db->select('*');
 		$this->db->from('staff');
 		$this->db->order_by('STAFF_CODE', 'ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//DELETE STAFF
 	function delete_staff($staff_id){
 		$this->db->where('STAFF_ID', $staff_id);
 		if($this->db->delete('staff')){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//UPDATE STAFF INFO
 	function update_staff($staff){
 		$this->db->where('STAFF_ID', $staff['STAFF_ID']);
		if($this->db->update('staff', $staff)){
			return true;
		}
		else{
			return false;
		}
 	}

 	//FETCH STAFF INFO
 	function fetch_staff_info($staff_id){
 		$this->db->select('*');
 		$this->db->from('staff');
 		$this->db->where('STAFF_ID', $staff_id);
 		$query=$this->db->get();
 		if($query->num_rows()==1){
 			return $query->row();
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


 	//=========================
 	//==========================
 	//COMPANY INFO
 	//=========================
 	//=========================

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
 		$this->db->select('invoice_order.INVOICE_ID, invoice_order.REF_NO, invoice_order.SERVICE, invoice_order.DATE_CREATED, invoice_order.STATUS, customer.NAME, invoice_order.TYPE');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->order_by('invoice_order.INVOICE_ID', 'DESC');
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
 	function generate_invoice($invoice_data){
 		$this->db->select('invoice_order.REF_NO, invoice_order.SERVICE, invoice_order.DATE_CREATED, customer.NAME, invoice_order.AMOUNT, invoice_order.DESCRIPTION, invoice_order.DUE_DATE, customer.PHONE, customer.EMAIL, invoice_order.STATUS, invoice_order.TYPE, customer.ACCOUNT_NO');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('invoice_order.REF_NO', $invoice_data['REF_NO']);
 		$this->db->where('invoice_order.TYPE', $invoice_data['TYPE']);
 		$query=$this->db->get();
 		return $query->result();
 	}

 	// FETCH INVOICE INFO SUCH AS TYPE AND REF_NO
 	function fetch_invoice_type($invoice_id){
 		$this->db->select('TYPE, REF_NO');
 		$this->db->from('invoice_order');
 		$this->db->where('INVOICE_ID', $invoice_id);
 		$query=$this->db->get();
 		if($query->num_rows()==1){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
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

 	//=========================
 	//==========================
 	//PROFILE
 	//=========================
 	//=========================

 	//FETCH PROFILE INFO OF THE USER
 	function fetch_profile(){
 		$this->db->select('*');
 		$this->db->from('staff');
 		$query=$this->db->get();
 		return $query->row();
 	}



 	//=========================
 	//==========================
 	//REPORT
 	//=========================
 	//========================= 

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

 	function range_report($range){
 		$start=$range['START'];
 		$end=$range['END'];
 		$this->db->select('invoice_order.REF_NO, invoice_order.SERVICE, customer.NAME, invoice_order.AMOUNT, invoice_order.DATE_CREATED');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where("invoice_order.DATE_CREATED BETWEEN '$start' AND '$end'");
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


 	//FETCH THE LAST ACCOUNT NO FROM THE CLIENT TABLE
 	function check_account_no($account_no){
 		$this->db->select('ACCOUNT_NO');
 		$this->db->from('customer');
 		$this->db->where('ACCOUNT_NO', $account_no);
 		$query=$this->db->get();
 		if($query->num_rows()==1){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}
 	

 	//FETCH INVOICE NUMBER TO BE USED IN SELECT2 PLUGIN
 	function fetch_invoice_no_list($search){
 		$this->db->select('REF_NO');
 		$this->db->from('invoice_order');
 		$this->db->where('REF_NO', $search);
 		$this->db->limit('1');
 		$query=$this->db->get();
 		return $query->result_array();
 	}


 	function fetch_customer_account_no($ref_no){
 		$this->db->select('customer.ACCOUNT_NO');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('invoice_order.REF_NO', $ref_no);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row()->ACCOUNT_NO;
 		}
 		else{
 			return false;
 		}
 	}

 	//=========================
 	//==========================
 	//RECEIPTS
 	//=========================
 	//========================= 

	//CREATE RECEIPTS
 	function create_receipt($receipt){
 		$this->db->select('*');
 		$this->db->from('reciepts');
 		$this->db->where('RECIEPT_NUMBER', $receipt['RECIEPT_NUMBER']);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return "Receipt has been created before";
 		}
 		else{
 			if($this->db->insert('reciepts', $receipt)){
	 			return 'Receipt has been created successfully';
	 		}
	 		else{
	 			return false;
	 		}
 		}
 	}

 	//GENERATE RECEIPT 
 	function generate_receipt($receipt_no){

 		$receipt_no=str_replace('R', '', $receipt_no);
 		$this->db->select('invoice_order.REF_NO, invoice_order.SERVICE, invoice_order.DATE_CREATED, customer.NAME, invoice_order.AMOUNT, invoice_order.DESCRIPTION, customer.PHONE, customer.EMAIL, invoice_order.TYPE, customer.ACCOUNT_NO');
 		$this->db->from('invoice_order');
 		$this->db->join('customer', 'invoice_order.CUSTOMER_ID=customer.CUSTOMER_ID', 'left');
 		$this->db->where('invoice_order.REF_NO', $receipt_no);
 		$query=$this->db->get();
 		return $query->result();
 	}

 	//FETCH RECEIPT INFO
 	function fetch_receipt_info($receipt_no){
 		$this->db->select('*');
 		$this->db->from('reciepts');
 		$this->db->where('RECIEPT_NUMBER', $receipt_no);
 		$query=$this->db->get();
 		return $query->row();
 	}

 	//FETCH LIST OF RECIEPTS
 	function fetch_receipt_list(){
 		$this->db->select('customer.NAME, customer.ACCOUNT_NO, reciepts.DATE_CREATED, reciepts.RECIEPT_NUMBER');
 		$this->db->from('reciepts');
 		$this->db->join('customer', 'reciepts.ACCOUNT_NUMBER=customer.ACCOUNT_NO', 'left');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}


 	//DELETE RECEIPT
 	function delete_receipt($receipt_no){
 		$this->db->where('RECIEPT_NUMBER', $receipt_no);
 		if($this->db->delete('reciepts')){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

}

?>