<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'invoice';
$route['404_override'] = 'error404';
$route['translate_uri_dashes'] = FALSE;
$route['login']='invoice/login';
$route['logout']='invoice/logout';




//ADMINISTRATOR
$route['dashboard']="invoice/dashboard";



//CLIENTS
$route['clients']="invoice/clients";
$route['fetch-client-list']="invoice/fetch_customer_list";
$route['add-client']="invoice/add_client";
$route['fetch-customer-info']="invoice/fetch_customer_info";
$route['update-client-record']="invoice/update_client_record";



//SETTINGS
$route['settings']="invoice/settings";
$route['update-company-info']="invoice/update_company_info";
$route['fetch-company-info']="invoice/fetch_company_info";
$route['backup-records']="invoice/export_records";

//INVOICE
$route['invoice']="invoice/invoice";
$route['create_invoice']="invoice/add_invoice";
$route['fetch_invoices']="invoice/fetch_list_created_invoice";
$route['delete_invoice_item']="invoice/delete_invoice_item";
$route['invoiceInfo']="invoice/get_invoice_info";
$route['edit_invoice']="invoice/get_invoice_info_edit";
$route['generateInvoice/(:num)']="invoice/generate_invoice/$1";
$route['update_invoice']="invoice/update_invoice";
$route['updateInvoiceMeta']="invoice/update_invoice_meta";
$route['generateInvoicePdf/(:num)']="invoice/generate_invoice_pdf/$1";

$route['clientSelect']="invoice/get_client_list_plugin";



//PROFILE
$route['profile']="invoice/profile";
$route['update_profile']="invoice/update_profile";



//REPORTS
$route['reports']="invoice/reports";
$route['month-report']="invoice/month_report";
$route['annual-report']="invoice/annual_report";
$route['range-report']="invoice/report_date_range";


//STAFF
$route['staff']="invoice/staff";
$route['staff-list']="invoice/fetch_staff_list";
$route['addStaff']="invoice/add_staff";
$route['deleteStaff']="invoice/delete_staff";
$route['fetch_staff_info']="invoice/fetch_staff_info";
$route['update_staff']="invoice/update_staff_info";

//RECEIPT
$route['receipts']="invoice/receipts";
$route['get-invoice-no']="invoice/get_invoice_list_plugin";
$route['create-receipt']="invoice/create_receipt";
$route['receipt/(:any)/(:num)']="invoice/generate_receipt/$1/$2";
$route['receiptList']="invoice/receipt_list";
$route['deleteReceipt']="invoice/delete_receipt";
$route['fetch_services']="invoice/fetch_service_items";

//CREDIT NOTE
$route['credit-notes']="invoice/credit_notes";
$route['fetch_reciept_items']="invoice/fetch_receipt_items";
$route['create-credit_note']="invoice/create_credit_note";
$route['credit-note/(:any)/(:any)']="invoice/generate_credit_note/$1/$2";
$route['credit-notes-list']="invoice/fetch_credit_note_list";
