<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('invoice_model');  
    }	

	//VERIFY USER FOR SECURITY PURPOSES
    public function verify(){
    	if(is_null($this->session->userdata('username')) && is_null($this->session->userdata('password'))){
			redirect(base_url());
		}
		else{
			if($this->invoice_model->verify_user($this->session->userdata('username'),$this->session->userdata('password'))==false){
				redirect(base_url());
			}
		}
    }

    //LOGIN PAGE
	public function index(){
		$this->load->view('login');
	}

	//PROCESS LOGIN
	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$username=strtoupper(trim($this->input->post('username')));
			$password=md5(strtolower(trim($this->input->post('password'))));
			if($this->invoice_model->process_login($username, $password)){
				$staff=$this->invoice_model->process_login($username, $password);
					$staff_id=$staff->STAFF_ID;
					$username=$staff->USERNAME;
					$password=$staff->PASSWORD;
					$name=$staff->NAME;
					$staff_code=$staff->STAFF_CODE;
					$staff_type=$staff->TYPE;
					$session_data=array(
						'username' => $username, 
						'password' => $password, 
						'staff_id'=>$staff_id, 
						'name'=>$name,
						'staff_code'=>$staff_code,
						'staff_type'=>$staff_type
					);
				$this->session->set_userdata($session_data);

				redirect(base_url()."invoice");
			}
			else{
				$this->session->set_flashdata('error', 'Invalid Username or password');
				redirect(base_url());
			}	
		}
		else{
			$this->index();
		}
	}

	//LOGOUT
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('staff_id');
		$this->session->unset_userdata('staff_code');
		$this->session->unset_userdata('staff_type');
		$this->session->unset_userdata('name');
		redirect(base_url());
	}


	//==============================
    //==============================
    //PROFILE
    //==============================
    //==============================

	public function profile(){
		$this->verify();
		$data['title']="My Profile";
		$data['profile']=$this->invoice_model->fetch_profile();
		$this->load->view('parts/head',$data);
		$this->load->view('profile',$data);
		$this->load->view('parts/bottom',$data);
	}

	//UPDATE PROFILE
	public function update_profile(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run()){
			$username=strtolower(trim($this->input->post('username')));
			$password=md5(strtolower(trim($this->input->post('password'))));
			$profile=array(
				'USERNAME'=>$username,
				'NAME'=>trim($this->input->post('name')),
				'PASSWORD'=>$password
			);
			if($this->invoice_model->update_profile($profile)){
				
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				echo "Your Profile  has been updated";
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name');
			}
			if(form_error('username')){
				$error.=form_error('username');
			}
			if(form_error('password')){
				$error.=form_error('password');
			}
			if(form_error('cpassword')){
				$error.=form_error('cpassword');
			}
			echo $error;
		}
	}

	//==============================
    //==============================
    //STAFF
    //==============================
    //==============================

	public function staff(){
		$this->verify();
		$data['title']="Staff";
		$data['profile']=$this->invoice_model->fetch_profile();
		$this->load->view('parts/head',$data);
		$this->load->view('staff/staff',$data);
		$this->load->view('parts/bottom',$data);
	}

	//FETCH STAFF LIST
	public function fetch_staff_list(){
		$data['staff']=$this->invoice_model->fetch_staff_list();
		$this->load->view('staff/staffList', $data);
	}

	//ADD STAFF
	public function add_staff(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Staff Name', 'required');
		$this->form_validation->set_rules('type', 'Staff Role', 'required');
		$this->form_validation->set_rules('username', 'Client Phone number', 'required|is_unique[staff.USERNAME]', array('is_unique' => 'This username has been taken'));
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('staff_code', 'Staff Code', 'required|is_unique[staff.STAFF_CODE]', array('is_unique' => 'This staff code has been taken'));
		if($this->form_validation->run()){
			$staff=array(
				'NAME'=>trim($this->input->post('name')),
				'USERNAME'=>strtoupper(trim($this->input->post('username'))),
				'PASSWORD'=>md5(strtolower(trim($this->input->post('password')))),
				'STAFF_CODE'=>trim($this->input->post('staff_code')),
				'TYPE'=>$this->input->post('type')
			);
			if($this->invoice_model-> add_staff($staff)){
				echo "Staff record has been created successfully";
			}
		}
		else{

			$error="";

			if(form_error('name')){
				$error.=form_error('name');
			}

			if(form_error('username')){
				$error.=form_error('username');
			}

			if(form_error('password')){
				$error.=form_error('password');
			}

			if(form_error('cpassowrd')){
				$error.=form_error('cpassowrd');
			}

			if(form_error('staff_code')){
				$error.=form_error('staff_code');
			}

			if(form_error('type')){
				$error.=form_error('type');
			}

			echo $error;
		}
	}

	//UPDATE STAFF RECORD
	public function update_staff_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('staff_id', 'Staff ID', 'required|numeric');
		$this->form_validation->set_rules('name', 'Staff Name', 'required');
		$this->form_validation->set_rules('type', 'Staff Role', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('staff_code', 'Staff Code', 'required');
		if($this->form_validation->run()){
			$staff=array(
				'STAFF_ID'=>$this->input->post('staff_id'),
				'NAME'=>trim($this->input->post('name')),
				'USERNAME'=>strtoupper(trim($this->input->post('username'))),
				'PASSWORD'=>md5(strtolower(trim($this->input->post('password')))),
				'STAFF_CODE'=>trim($this->input->post('staff_code')),
				'TYPE'=>$this->input->post('type')
			);
			if($this->invoice_model->update_staff($staff)){
				echo "Staff record has been updated";
			}
		}
		else{

			$error="";

			if(form_error('name')){
				$error.=form_error('name');
			}

			if(form_error('username')){
				$error.=form_error('username');
			}

			if(form_error('password')){
				$error.=form_error('password');
			}

			if(form_error('cpassowrd')){
				$error.=form_error('cpassowrd');
			}

			if(form_error('staff_code')){
				$error.=form_error('staff_code');
			}

			if(form_error('type')){
				$error.=form_error('type');
			}

			echo $error;
		}
	}

	//FETCH STAFF INFO
	public function fetch_staff_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('staff_id', 'Staff ID', 'required|numeric');
		if($this->form_validation->run()){
			$data['staff']= $this->invoice_model->fetch_staff_info($this->input->post('staff_id'));
			$this->load->view('staff/staffInfo', $data);
		}
	}

	//DELETE STAFF
	public function delete_staff(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('staff_id', 'Staff ID', 'required|numeric');
		if($this->form_validation->run()){
			
			if($this->invoice_model->delete_staff($this->input->post('staff_id'))){
				echo "Staff has been deleted";
			}
		}
	}


	//==============================
    //==============================
    //CREDIT NOTES
    //==============================
    //==============================

	public function credit_notes(){
		$this->verify();
		$data['title']="Credit Notes";
		$this->load->view('parts/head',$data);
		$this->load->view('creditNotes/creditnotes',$data);
		$this->load->view('parts/bottom',$data);
	}


	//FETCH CREDIT NOTE LIST
	public function fetch_credit_note_list(){
		$data['credit_notes']=$this->invoice_model->fetch_creditNotes_list();
		$this->load->view('creditNotes/creditNoteList', $data);
	}


	//FETCH SERVICES FROM RECIEPT TABLE TO BE DISPLAYED IN CREDIT NOTE GENERATION FORM
	public function fetch_receipt_items(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reciept_no', 'Reciept Number', 'required');
		if($this->form_validation->run()){
			$data['services']=$this->invoice_model->fetch_reciept_items($this->input->post('reciept_no'));

			$this->load->view('creditNotes/servicesList', $data);
			
		}
	}



	//CREATE CREDIT NOTE 
	public function create_credit_note(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Credit Note Type', 'required');
		$this->form_validation->set_rules('reciept_no', 'Reciept Number', 'required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'required');
		$this->form_validation->set_rules('service[]', 'Service Item', 'required');
		$this->form_validation->set_rules('description[]', 'Description', 'required');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required');
		if($this->form_validation->run()){
			$credit_note_no=str_replace('R', 'CN',  $this->input->post('reciept_no'));
			
			for ($i=0; $i < count($_POST['service']) ; $i++) { 
				$amount_paid=str_replace(',', '', $_POST['amount'][$i]);
				$credit_note=array(
					'TYPE'=>$this->input->post('type'),
					'ACCOUNT_NUMBER'=>$this->input->post('account_no'),
					'CREDIT_NOTE_NUMBER'=>$credit_note_no,
					'DATE_CREATED'=>date('Y-m-d'),
					'SERVICE'=>$_POST['service'][$i],
					'DESCRIPTION'=>$_POST['description'][$i],
					'AMOUNT_PAID'=>$amount_paid
				);
				$status=$this->invoice_model->create_notes($credit_note, $this->input->post('reciept_no'));
			
				if($i==count($_POST['service'])-1){
					if($status=="Credit Note has been created successfully"){
						redirect(base_url()."credit-note/".$credit_note_no.'/'.$credit_note["TYPE"]);
					}
					else{
						echo $status;
					}
				}	
			}
		}
		else{

			$error="";

			if(form_error('invoice_no')){
				$error.=form_error('invoice_no');
			}

			if(form_error('type')){
				$error.=form_error('type');
			}			
			

			if(form_error('amount[]')){
				$error.=form_error('amount[]');
			}

			if(form_error('service[]')){
				$error.=form_error('service[]');
			}

			if(form_error('description[]')){
				$error.=form_error('description[]');
			}

			
			echo $error;
		}
	}


	//GENERATE CREDIT NOTE
	public function generate_credit_note($credit_note_no, $type){
		$data['credit_note_no']=$credit_note_no;
		$data['info']=$this->invoice_model->fetch_company_info();
		$data['credit_info']=$this->invoice_model->fetch_credit_note_info($credit_note_no, $type);
		$data['creditNote']=$this->invoice_model->generate_credit_note($credit_note_no, $type);
		$this->load->view('creditNotes/creditnote', $data);
	}

	
	//==============================
    //==============================
    //REPORTS
    //==============================
    //==============================

	public function reports(){
		$this->verify();
		$data['title']="Invoice Reports";
		$data['year']=$this->list_year();
		$data['month']=$this->list_month();
		$this->load->view('parts/head',$data);
		$this->load->view('reports/reports',$data);
		$this->load->view('parts/bottom',$data);
	}

	//GENERATE MONTHLY REPORT
	public function month_report(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		if($this->form_validation->run()){
			$month_report=array(
				'MONTH'=>date('m',strtotime($this->input->post('month'))),
				'YEAR'=>$this->input->post('year')
			);

			$data['date']=$this->input->post('month')." ".$this->input->post('year');
			$data['report']=$this->invoice_model->report_month($month_report);
			$this->load->view('reports/monthReports',$data);
		}
	}

	//GENERATE ANNUAL REPORT
	public function annual_report(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('year', 'Year', 'required');
		if($this->form_validation->run()){
			$data['date']=$this->input->post('year');
			$data['report']=$this->invoice_model->annual_report($this->input->post('year'));
			$this->load->view('reports/annualReports',$data);
		}
	}

	//GENERATE REPORT BASED ON DATE RANGE
	public function report_date_range(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('start', 'Start Range', 'required');
		$this->form_validation->set_rules('end', 'End Range', 'required');
		if($this->form_validation->run()){
			$range=array(
				'START'=>date('Y-m-d', strtotime($this->input->post('start'))),
				'END'=>date('Y-m-d', strtotime($this->input->post('end')))
			);
			$data['date']=$this->input->post('start')."-".$this->input->post('end');
			$data['report']=$this->invoice_model->range_report($range);
			$this->load->view('reports/rangeReports',$data);
		}
	}

	public function list_year(){
		$year="";
		$date=date('Y');
	    $count=1;
	    while($count<=15){
	    	$year.="<option value='$date'>$date</option>\n";
	        $date++;
	        $count++;
	    }
	    return $year;
	}

	public function list_month(){
		$month_list="<option value='' selected>Select Month</option>";
		for ($m=1; $m<=12; $m++) {
	     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
	     $month_list.="<option value='$month'>$month</option>";
	    }
	    return $month_list;		
	}

	//==============================
    //==============================
    //RECIEPT
    //==============================
    //==============================

	public function receipts(){
		$this->verify();
		$data['title']="Receipts";
		//$data['receipts']=$this->invoice_model->fetch_receipt_list();
		$this->load->view('parts/head',$data);
		$this->load->view('receipts/receipts',$data);
		$this->load->view('parts/bottom',$data);
	}	

	//FETCH RECEIPT LIST
	public function receipt_list(){
		$data['receipts']=$this->invoice_model->fetch_receipt_list();
		$this->load->view('receipts/receiptList', $data);
	}

	//FETCH SERVICES FROM INVOICE TABLE TO BE DISPLAYED IN RECEIPT GENERATION FORM
	public function fetch_service_items(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('invoice_no', 'Invoice Number', 'required');
		if($this->form_validation->run()){
			$data['services']=$this->invoice_model->fetch_service_items($this->input->post('invoice_no'));

			$this->load->view('receipts/servicesList', $data);
			
		}
	}
	

	//CREATE RECEIPT 
	public function create_receipt(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('invoice_no', 'Invoice Number', 'required');
		$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
		$this->form_validation->set_rules('service[]', 'Service Item', 'required');
		$this->form_validation->set_rules('description[]', 'Description', 'required');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required');
		$this->form_validation->set_rules('receipt_type', 'Receipt Type', 'required');
		$this->form_validation->set_rules('payment_status', 'Payment Status', 'required');
		if($this->form_validation->run()){
			$receipt_no="R".trim($this->input->post('invoice_no'));
			$account_no=$this->invoice_model->fetch_customer_account_no($this->input->post('invoice_no'));
			$last_batch_no=$this->invoice_model->fetch_batch_no($receipt_no);
			if($last_batch_no){
				$new_batch=$last_batch_no+1;
			}
			else{
				$new_batch=1;
			}

			
			for ($i=0; $i < count($_POST['service']) ; $i++) { 
				
				$amount_paid=str_replace(',', '', $_POST['amount'][$i]);
				$reciept=array(
					'ACCOUNT_NUMBER'=>$account_no,
					'RECIEPT_NUMBER'=>$receipt_no,
					'DATE_CREATED'=>date('Y-m-d'),
					'MODE_OF_PAYMENT'=>$this->input->post('payment_type'),
					'SERVICE'=>$_POST['service'][$i],
					'DESCRIPTION'=>$_POST['description'][$i],
					'AMOUNT_PAID'=>$amount_paid,
					'PAYMENT_STATUS'=>$this->input->post('payment_status'),
					'RECIEPT_TYPE'=>$this->input->post('receipt_type'),
					'BATCH'=>$new_batch
				);
				$status=$this->invoice_model->create_receipt($reciept);
				
				
				if($i==count($_POST['service'])-1){
					if($status=="Receipt has been created successfully"){
						redirect(base_url()."receipt/".$receipt_no."/$new_batch");
					}
					else{
						echo $status;
					}
				}

				
			}

			
		}
		else{

			$error="";

			if(form_error('invoice_no')){
				$error.=form_error('invoice_no');
			}

			if(form_error('receipt_type')){
				$error.=form_error('receipt_type');
			}


			

			if(form_error('amount[]')){
				$error.=form_error('amount[]');
			}

			if(form_error('service[]')){
				$error.=form_error('service[]');
			}

			if(form_error('description[]')){
				$error.=form_error('description[]');
			}

			if(form_error('payment_type')){
				$error.=form_error('payment_type');
			}

			echo $error;
		}
	}

	//GENERATE RECEIPT
	public function generate_receipt($receipt_no, $batch){
		$data['receipt_no']=$receipt_no;
		$data['info']=$this->invoice_model->fetch_company_info();
		$data['receipt_info']=$this->invoice_model->fetch_receipt_info($receipt_no);
		$data['receipt']=$this->invoice_model->generate_receipt($receipt_no, $batch);
		$this->load->view('receipts/receipt', $data);
	}

	//DELETE RECEIPT
	public function delete_receipt(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('receiptData[]', 'Receipt Number', 'required');
		if($this->form_validation->run()){
			$reciept=array(
			'RECIEPT_NO'=>$_POST['receiptData']['receipt_no'],
			'BATCH'=>$_POST['receiptData']['batch']
			);
			if($this->invoice_model->delete_receipt($reciept)){
				echo "Receipt has been deleted";
			}
		}
	}

	


	//==============================
    //==============================
    //INVOICE
    //==============================
    //==============================

	public function invoice(){
		$this->verify();
		$data['title']="Invoice";
		$this->load->view('parts/head',$data);
		$this->load->view('invoice/invoice',$data);
		$this->load->view('parts/bottom',$data);
	}

	//FETCH THE LIST OF CREATED INVOICE
	public function fetch_list_created_invoice(){
		$data['invoices']=$this->invoice_model->fetch_invoice_list();
		$this->load->view('invoice/invoiceList', $data);
	}


	//ADD INVOICE
	public function add_invoice(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('client', 'Client Name', 'required|numeric');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('item[]', 'Service Item', 'required');
		$this->form_validation->set_rules('description[]', 'Description', 'required');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required');
		$this->form_validation->set_rules('type', 'Invoice Type', 'required');
		if($this->form_validation->run()){
			$this->load->helper('string');

			if($this->input->post('type')=='Tax' and $this->input->post('ref_no')!=""){
				$ref_no=$this->input->post('ref_no');
			}
			else{
				$ref_no=random_string('numeric', 6);
			}

			for ($i=0; $i < count($_POST['item']) ; $i++) { 
				$invoice=array(
					'STAFF_CODE'=>$_SESSION['staff_code'],
					'REF_NO'=>$ref_no,
					'SERVICE'=>trim($_POST['item'][$i]),
					'DESCRIPTION'=>trim($_POST['description'][$i]),
					'AMOUNT'=>trim($_POST['amount'][$i]),
					'CUSTOMER_ID'=>$this->input->post('client'),
					'DATE_CREATED'=> date('Y-m-d'),
					'TYPE'=>$this->input->post('type'),
					'DUE_DATE'=>date('Y-m-d', strtotime($this->input->post('due_date'))),
					'STATUS' => 'NOT PAID'
				);
				$this->invoice_model->create_invoice($invoice);

				if($i==count($_POST['item'])-1){
					echo 'Invoice has been created';
				}
			}
		}
		else{
			$error="";
			if(form_error('client')){
				$error.=form_error('client');
			}

			if(form_error('type')){
				$error.=form_error('type');
			} 

			if(form_error('item[]')){
				$error.=form_error('item[]');
			}

			if(form_error('description[]')){
				$error.=form_error('description[]');
			}

			if(form_error('amount[]')){
				$error.=form_error('amount[]');
			}

			echo $error;
		}
	}


	//DELETE INVOICE ITEM
	public function delete_invoice_item(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('invoice_id', 'Invoice ID', 'required|numeric');
		
		if($this->form_validation->run()){
			
			if($this->invoice_model->delete_invoice_item($this->input->post('invoice_id'))){
				echo "Service Item has been deleted";
			}
		}
		else{
			if(form_error('invoice_id')){
				echo form_error('invoice_id');
			}
		}
	}


	//GET INVOICE INFO BY REF NO
	public function get_invoice_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ref_no', 'Reference No', 'required|numeric');
		if($this->form_validation->run()){
			$data['invoice']=$this->invoice_model->invoice_info($this->input->post('ref_no'));
			$this->load->view('invoice/invoiceInfo', $data);
		}
		else{
			if(form_error('ref_no')){
				echo form_error('ref_no');
			}
		}
	}

	//UPDATE INVOICE
	public function update_invoice(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Invoice Type', 'required');
		$this->form_validation->set_rules('item[]', 'Service Item', 'required');
		$this->form_validation->set_rules('description[]', 'Description', 'required');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required');
		if($this->form_validation->run()){
			
			for ($i=0; $i < count($_POST['item']) ; $i++) { 

				if($_POST['invoice_id'][$i]!=""){
					$invoice=array(
						'TYPE'=>$this->input->post('type'),
						'INVOICE_ID'=>$_POST['invoice_id'][$i],
						'SERVICE'=>trim($_POST['item'][$i]),
						'DESCRIPTION'=>trim($_POST['description'][$i]),
						'AMOUNT'=>trim($_POST['amount'][$i])
					);
					$this->invoice_model->update_invoice($invoice);
				}
				else{
					$new_invoice=array(
						'TYPE'=>$this->input->post('type'),
						'REF_NO'=>$_POST['ref_no'],
						'SERVICE'=>trim($_POST['item'][$i]),
						'DESCRIPTION'=>trim($_POST['description'][$i]),
						'AMOUNT'=>trim($_POST['amount'][$i]),
						'CUSTOMER_ID'=>$this->input->post('customer_id'),
						'DATE_CREATED'=> $this->input->post('date_created'),
						'DUE_DATE'=> $this->input->post('due_date'),
						'STATUS' => 'NOT PAID'
					);
					$this->invoice_model->create_invoice($new_invoice);
				}
				

				if($i==count($_POST['item'])-1){
					echo 'Invoice has been updated';
				}
			}
			
			
		}
		else{

			$error="";

			if(form_error('item[]')){
				$error.=form_error('item[]');
			}

			if(form_error('description[]')){
				$error.=form_error('description[]');
			}

			if(form_error('amount[]')){
				$error.=form_error('amount[]');
			}

			echo $error;
		}
	}

	//UPDATE INVOICE META INFORMATION
	public function update_invoice_meta(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('status', 'Payment Status', 'required');
		$this->form_validation->set_rules('ref_no', 'Reference Number', 'required');
		$this->form_validation->set_rules('type', 'Invoice Type', 'required');
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		$this->form_validation->set_rules('date_created', 'Date Created', 'required');
		if($this->form_validation->run()){
		
					$invoice=array(
						'REF_NO'=>$this->input->post('ref_no'),
						'DATE_CREATED'=>date('Y-m-d', strtotime($this->input->post('date_created'))),
						'DUE_DATE'=>date('Y-m-d', strtotime($this->input->post('due_date'))),
						'STATUS'=>$this->input->post('status')
					);
					if($this->invoice_model->update_invoice_meta($invoice)){
						echo"Invoice has been updated";
					}
			
		}
		else{

			$error="";

			if(form_error('due_date')){
				$error.=form_error('due_date');
			}

			if(form_error('date_created')){
				$error.=form_error('date_created');
			}

			if(form_error('ref_no')){
				$error.=form_error('ref_no');
			}

			if(form_error('status')){
				$error.=form_error('status');
			}

			echo $error;
		}
	}



	//GET INVOICE INFO BY REF NO FOR EDITING
	public function get_invoice_info_edit(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('invoiceData[]', 'Invoice Data', 'required');
		if($this->form_validation->run()){
			$invoice_data=array(
				'REF_NO'=>$_POST['invoiceData']['invoice_no'],
				'TYPE'=>$_POST['invoiceData']['invoice_type']
			);
			$data['invoice']=$this->invoice_model->invoice_info($invoice_data);
			$this->load->view('invoice/invoiceEdit', $data);
		}
		else{
			if(form_error('invoiceData')){
				echo form_error('invoiceData');
			}
		}
	}


	//GENERATE INVOICE 
	public function generate_invoice($invoice_id){
			$this->load->helper('text');
			$invoice_status=$this->invoice_model->fetch_invoice_type($invoice_id);

			$invoice_data=array(
				'REF_NO'=>$invoice_status->REF_NO,
				'TYPE'=>$invoice_status->TYPE
			);
	
			$data['invoice']=$this->invoice_model->generate_invoice($invoice_data);
			$data['ref_no']=$invoice_data['REF_NO'];
			$data['info']=$this->invoice_model->fetch_company_info();
			$this->load->view('invoice/invoiceslip', $data);
	}




	//==============================
    //==============================
    //CLIENTS
    //==============================
    //==============================

	public function clients(){
		$this->verify();
		$data['title']="Clients";
		$this->load->view('parts/head',$data);
		$this->load->view('clients/clients',$data);
		$this->load->view('parts/bottom',$data);
	}


	public function fetch_customer_list(){
		$data['clients']=$this->invoice_model->fetch_client_list();
		$this->load->view('clients/clientList', $data);
	}


	//GENERATE ACCOUNT NUMBER FOR CLIENT
	public function generate_account_no(){
		$this->load->helper('string');
		$account_no='FRA-'.random_string('numeric', 4);
		if($this->invoice_model->check_account_no($account_no)){
			$account_no='FRA-'.random_string('numeric', 4);
		}
		 return $account_no;	
	}
		
	//ADD CLIENT
	public function add_client(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Client Name', 'required|is_unique[customer.NAME]', array('is_unique' => 'This Client has a profile already'));
		$this->form_validation->set_rules('phone', 'Client Phone number', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run()){
			$client=array(
				'NAME'=>trim($this->input->post('name')),
				'PHONE'=>trim($this->input->post('phone')),
				'EMAIL'=>strtolower(trim($this->input->post('email'))),
				'ADDRESS'=>trim($this->input->post('address')),
				'OCCUPATION'=>trim($this->input->post('occupation')),
				'RC_NUMBER'=>trim($this->input->post('rc_number')),
				'ACCOUNT_NO'=>$this->generate_account_no()
			);
			if($this->invoice_model->add_client($client)){
				echo "Client ".$client['ACCOUNT_NO']." has been created successfully";
			}
		}
		else{

			$error="";

			if(form_error('name')){
				$error.=form_error('name');
			}

			if(form_error('phone')){
				$error.=form_error('phone');
			}

			if(form_error('email')){
				$error.=form_error('email');
			}

			if(form_error('address')){
				$error.=form_error('address');
			}

			echo $error;
		}
	}

	//FETCH CLIENT LIST [TO BE USED IN SELECT2 PLUGIN]
	public function get_client_list_plugin(){
		$this->verify();
		$client=$this->invoice_model->fetch_client_list_select($_GET['search']);
		foreach ($client as $key => $value) {
			$data[] = array('id' => $value['CUSTOMER_ID'], 'text' => $value['NAME']);			 	
   		}
		echo json_encode($data);
	}

	//UPDATE CLIENT RECORD
	public function update_client_record(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Client Phone number', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run()){
			$client=array(
				'CUSTOMER_ID'=>$this->input->post('customer_id'),
				'NAME'=>trim($this->input->post('name')),
				'PHONE'=>trim($this->input->post('phone')),
				'EMAIL'=>strtolower(trim($this->input->post('email'))),
				'ADDRESS'=>trim($this->input->post('address')),
				'OCCUPATION'=>trim($this->input->post('occupation')),
				'RC_NUMBER'=>trim($this->input->post('rc_number'))
			);
			if($this->invoice_model->update_client($client)){
				
				echo "Client's Record has been updated";
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name');
			}
			if(form_error('phone')){
				$error.=form_error('phone');
			}
			if(form_error('email')){
				$error.=form_error('email');
			}
			if(form_error('address')){
				$error.=form_error('address');
			}
			echo $error;
		}
	}

	//FETCH CUSTOMER INFO
	public function fetch_customer_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('customer_id', 'Customer ID', 'required|numeric');
		if($this->form_validation->run()){
			$data['client']= $this->invoice_model->fetch_client_info($this->input->post('customer_id'));
			$this->load->view('clients/clientInfo', $data);
		}
	}
	

	//==============================
    //==============================
    //SETTINGS
    //==============================
    //==============================

	public function settings(){
		$this->verify();
		$data['title']="Settings";
		$data['company']=$this->invoice_model->fetch_company_info();
		$this->load->view('parts/head',$data);
		$this->load->view('settings',$data);
		$this->load->view('parts/bottom',$data);
	}

	//UPDATE COMPANY INFORMATION
	public function update_company_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Company Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'valid_email|required');
		if($this->form_validation->run()){
			$info=array(
				'NAME'=>trim($this->input->post('name')),
				'PHONE'=>trim($this->input->post('phone')),
				'ADDRESS'=>trim($this->input->post('address')),
				'EMAIL'=>trim($this->input->post('email'))
			);
			if($this->invoice_model->update_company_info($info)){
				echo "Company Information has been updated";
			}
		}
		else{

			$error="";
			if(form_error('name')){
				$error.=form_error('name');
			}
			if(form_error('phone')){
				$error.=form_error('phone');
			}
			if(form_error('address')){
				$error.=form_error('address');
			}
			if(form_error('email')){
				$error.=form_error('email');
			}
			echo $error;
		}
	}

	//FETCH COMPANY INFO
	public function fetch_company_info(){
		$data['company']=$this->invoice_model->fetch_company_info();
		$this->load->view('companyInfo', $data);
	}

	//BACKUP RECORDS IN CSV
	public function export_records(){
		$this->verify();
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
		$database_tables=['company', 'customer', 'invoice_order', 'staff', 'credit_notes', 'reciepts'];
		foreach ($database_tables as $tables) {
			$query = $this->db->query("SELECT * FROM ".$tables);
			$data=$this->dbutil->csv_from_result($query);
			write_file('backup/'.$tables.'-'.date("F-d-Y").'.csv', $data);
		}
		$this->zip->read_dir('backup', TRUE);
		delete_files('backup/');
		$this->zip->download('Record-'.date("F-d-Y").'.zip');
	}


	


	

	








	
	


}
