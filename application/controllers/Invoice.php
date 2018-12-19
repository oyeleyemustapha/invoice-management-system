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
					$session_data=array(
						'username' => $username, 
						'password' => $password, 
						'staff_id'=>$staff_id, 
						'name'=>$name,
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

	//GENERATE ANNUAL SALES REPORT
	public function sales_reports_annual(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('year', 'Sales Year', 'required');
		if($this->form_validation->run()){
			$data['cafeteria']=$this->cafeteria_model->fetch_cafeteria()->NAME;
			$data['date']=$this->input->post('year');
			$data['report']=$this->cafeteria_model->sales_report_annual($this->input->post('year'));
			$this->load->view('administrator/reports/generalYearsales',$data);
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
		
	//ADD STAFF
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
				'ADDRESS'=>trim($this->input->post('address'))
			);
			if($this->invoice_model->add_client($client)){
				echo "Client Profile has been created";
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
				'ADDRESS'=>trim($this->input->post('address'))
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
		$database_tables=['company', 'customer', 'invoice_order', 'staff'];
		foreach ($database_tables as $tables) {
			$query = $this->db->query("SELECT * FROM ".$tables);
			$data=$this->dbutil->csv_from_result($query);
			write_file('backup/'.$tables.'-'.date("F-d-Y").'.csv', $data);
		}
		$this->zip->read_dir('backup', TRUE);
		delete_files('backup/');
		$this->zip->download('Record-'.date("F-d-Y").'.zip');
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
			$ref_no=random_string('numeric', 6);
			for ($i=0; $i < count($_POST['item']) ; $i++) { 
				
				$invoice=array(
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


	//GET INVOICE INFO BY REF NO FOR EDITING
	public function get_invoice_info_edit(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ref_no', 'Reference No', 'required|numeric');
		if($this->form_validation->run()){
			$data['invoice']=$this->invoice_model->invoice_info($this->input->post('ref_no'));
			$this->load->view('invoice/invoiceEdit', $data);
		}
		else{
			if(form_error('ref_no')){
				echo form_error('ref_no');
			}
		}
	}


	//GENERATE INVOICE 
	public function generate_invoice($ref_no){
		$this->load->helper('text');
			$data['invoice']=$this->invoice_model->generate_invoice($ref_no);
			$data['ref_no']=$ref_no;
			$data['info']=$this->invoice_model->fetch_company_info();
			$this->load->view('invoice/invoiceslip', $data);
	}

	public function generate_invoice_pdf($ref_no){
		$this->load->helper('text');
		$this->load->library('pdfgenerator');
			$data['invoice']=$this->invoice_model->generate_invoice($ref_no);
			$data['ref_no']=$ref_no;
			$data['info']=$this->invoice_model->fetch_company_info();
			$invoice=$this->load->view('invoice/invoiceslip', $data, true);
     		$this->pdfgenerator->generate($invoice, $ref_no);
	}

	//UPDATE INVOICE
	public function update_invoice(){
		$this->verify();
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('invoice_id[]', 'Invoice ID', 'required|numeric');
		$this->form_validation->set_rules('item[]', 'Service Item', 'required');
		$this->form_validation->set_rules('description[]', 'Description', 'required');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required');
		if($this->form_validation->run()){
			
			for ($i=0; $i < count($_POST['item']) ; $i++) { 

				if($_POST['invoice_id'][$i]!=""){
					$invoice=array(
						'INVOICE_ID'=>$_POST['invoice_id'][$i],
						'SERVICE'=>trim($_POST['item'][$i]),
						'DESCRIPTION'=>trim($_POST['description'][$i]),
						'AMOUNT'=>trim($_POST['amount'][$i])
					);
					$this->invoice_model->update_invoice($invoice);
				}
				else{
					$new_invoice=array(
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








	
	


}
