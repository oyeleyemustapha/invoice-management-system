$(document).ready(function(){

	 var base_url_admin=location.protocol+"//"+location.host+"/invoice/";

	 $('.date').datepicker({
	 	format:'MM dd, yyyy',
	 	autoclose: true
	 });

	 $('.month').datepicker({
	 	format:'MM yyyy',
	 	autoclose: true
	 });


    //UPDATE PROFILE
    $('#UpdateProfile').submit(function(){
            $.post( 
                base_url_admin+"update_profile", 
                $(this).serialize(), 
                function(data){
                    
                     $.notify({
                        message: data
                    },{
                        type: "success",
                        onClosed: function(){
                          location.reload();
                        }
                    });
                    

                }
            );
             $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
             $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
             return false;          
    });


	//=============================
  //=============================
  //CLIENTS
  //=============================
  //=============================
	var client_cb=function(){
		 $('.staffList').DataTable({
         "drawCallback": function( settings ) {
              //EDIT CLIENT RECORD
              $('.editClient').click(function(){
                    $.post( 
                        base_url_admin+"fetch-customer-info", 
                        {customer_id:$(this).attr('id')}, 
                        function(data){
                        	$('#staffInfoModal').modal('show');
                        	$('#staffInfoModal .modal-body').html(data);

                        	  
                        	  //UPDATE CLIENT RECORD
              							$('#updateClientForm').submit(function(){
              						            $.post( 
              						                base_url_admin+"update-client-record", 
              						                $(this).serialize(), 
              						                function(data){
              						                    $('#staffInfoModal').modal('hide');
              						                     $.notify({
              						                        message: data
              						                    },{
              						                        
              						                        type: "success",
              						                       
              						                    }); 

              						                     $('.clientListDiv').load(base_url_admin+'fetch-client-list', client_cb);
              						                }
              						            );
              						             $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
              						             $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
              						             return false;          
              						  });	
                        }
                    );
                $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
                $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});       
              });
         }
    });
	}
	$('.clientListDiv').load(base_url_admin+'fetch-client-list', client_cb);

	//ADD CLIENT
	$('#addclientform').submit(function(){
    $.post( 
      base_url_admin+"add-client", 
      $(this).serialize(), 
      function(data){
        $('#myModal').modal('hide');
          $.notify({
            message: data
        },{
            type: "success",
        }); 
        $('#addclientform')[0].reset();
        $('.clientListDiv').load(base_url_admin+'fetch-client-list', client_cb);
      }
    );
      $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
      $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
      return false;          
  });

  //FETCH CLIENT LIST TO BE USED FOR SELECT2 PLUGIN
    $("#clientSelect").select2({
        placeholder: "Type Client Name Here",
        allowClear: true, 
        theme: "classic",
        width: '100%',
        //FETCH SUBJECT FROM THE DATABASE
        ajax: {
                url: base_url_admin+"clientSelect",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
        },
        minimumInputLength: 3
    });


  //=============================
  //=============================
  //COMPANY INFO
  //=============================
  //=============================
	
    //UPDATE COMPANY'S INFORMATION
	  $('#updateCompanyinfo').submit(function(){
      $.post( 
        base_url_admin+"update-company-info", 
        $(this).serialize(), 
        function(data){
          companyInfo();
          $('#modal-id').modal('hide');
            $.notify({
              message: data
          },{
              type: "success",
          });  
        }
      );
        $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
        $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
        return false;          
    });

    function companyInfo(){
      $('.companyInfo').load(base_url_admin+"fetch-company-info");
    }

    companyInfo();

  //=============================
  //=============================
  //INVOICE
  //=============================
  //=============================

  //ADD SERVICE DYNAMICALLY
  $('.addItem').click(function(){
    var form='<div class="row"><div class="col-lg-4"><div class="form-group">';
    form+=' <input type="text" name="item[]" placeholder="Item" class="form-control-lg form-control" required=""></div></div>';
    form+='<div class="col-lg-5"><div class="form-group"><input type="text" name="description[]" placeholder="Description" class="form-control-lg form-control" required=""></div></div>';                             
    form+='<div class="col-lg-3"><div class="input-group"><input type="text" name="amount[]" placeholder="Amount" class="form-control-lg form-control" required="">';
    form+='<span class="input-group-btn"><button type="button" class="btn btn-lg btn-danger removeItem"><i class="fa fa-minus"></i></button></span></div></div>';
    $('.items').append(form);
    //REMOVE ITEM
    $('.removeItem').click(function(){
      $(this).closest('.row').remove();
    });
  });

  //CREATE INVOICE
  $('.createInvoice').click(function(){
    $('#create_Invoice, .addItem').toggle();
  });

  //FETCH INVOICE NUMBER LIST TO BE USED FOR SELECT2 PLUGIN
    $("#invoiceSelect").select2({
        placeholder: "Search with Invoice Number",
        allowClear: true, 
        theme: "classic",
        width: '100%',
        //FETCH SUBJECT FROM THE DATABASE
        ajax: {
                url: base_url_admin+"get-invoice-no",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
        },
        minimumInputLength: 3
    });

  //CREATE INVOICE
    $('#create_Invoice').submit(function(){
            $.post( 
                base_url_admin+"create_invoice", 
                $(this).serialize(), 
                function(data){
                    
                     $.notify({
                        message: data
                    },{
                        type: "success",
                    });
                    $('.items').html(''); 
                     $('#create_Invoice, .addItem').hide();
                   $('.invoice-List').load(base_url_admin+'fetch_invoices', invoice_cb);

                }
            );
             $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
             $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
             return false;          
    });

  var invoice_cb=function(){
     $('.invoiceList').DataTable({
         "drawCallback": function( settings ) {
            //DELETE INVOICE ITEM
            $('.deleteInvoiceItem').click(function(){
                 var invoice_id=$(this).attr('id');
                        swal({
                          title: 'Are you sure of this ?',
                          text: "You can't be reverted!",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#D62C1A',
                          cancelButtonColor: '#2C3E50',
                          confirmButtonText: 'Yes, delete it!'
                      }).then(function () {
                          $.post( 
                        base_url_admin+"delete_invoice_item", 
                        {invoice_id:invoice_id}, 
                        function(data){
                           $.notify({
                                message: data
                            },{
                                type: "success",
                            });
                          $('.invoice-List').load(base_url_admin+'fetch_invoices', invoice_cb);
                        }
                    );
                          });
            });

           


            //EDIT INVOICE INFO
            $('.editInvoice').click(function(){
                var invoice_number=$(this).attr('data-refNo');
                var invoice_type=$(this).attr('data-invoice-type');

             
                $.post( 
                        base_url_admin+"edit_invoice", 
                         {invoiceData:{
                          "invoice_no":invoice_number,
                          "invoice_type":invoice_type
                        }}, 
                        function(data){
                          $('#invoiceModal').modal('show');
                          $('#invoiceModal .modal-body').html(data);
                           $('.date').datepicker({
                            format:'MM dd, yyyy',
                            autoclose: true
                           });

                          //ADD MORE ITEMS TO INVOICE
                          $('.addItems').click(function(){
                            var form='<tr><td><input type="hidden" class="form-control" name="invoice_id[]" value=""><input type="text" name="item[]" placeholder="Item" class="form-control" required=""></td>';
                                form+='<td><input type="text" name="description[]" placeholder="Description" class="form-control-lg form-control" required=""></td>';                             
                                form+='<td><input type="text" name="amount[]" placeholder="Amount" class="form-control-lg form-control" required="">';
                                form+='<span class="input-group-btn"><button type="button" class="btn btn-lg btn-danger removeItem"><i class="fa fa-minus"></i></button></span></td></tr>';

                                $('.invoiceTable tbody').append(form);

                                //REMOVE ITEM
                                $('.removeItem').click(function(){
                                 
                                  $(this).closest('tr').remove();
                                });
                          });


                          //UPDATE INVOICE INFORMATION
                          $('#updateInvoiceform').submit(function(){
                              $.post( 
                                base_url_admin+"update_invoice", 
                                $(this).serialize(), 
                                function(data){
                                  $('#invoiceModal').modal('hide');
                                  $('.invoice-List').load(base_url_admin+'fetch_invoices', invoice_cb);
                                  $.notify({
                                      message: data
                                  },{
                                      type: "success",
                                  });
                                }
                              );
                              return false;
                              $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
                              $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
                          });

                          //UPDATE INVOICE INFORMATION
                          $('#invoicemetainfo').submit(function(){
                              $.post( 
                                base_url_admin+"updateInvoiceMeta", 
                                $(this).serialize(), 
                                function(data){
                                  $('#invoiceModal').modal('hide');
                                  $('.invoice-List').load(base_url_admin+'fetch_invoices', invoice_cb);
                                  $.notify({
                                      message: data
                                  },{
                                      type: "success",
                                  });
                                }
                              );
                              return false;
                              $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
                              $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
                          });

                         

                            
                        }
                    );
                $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
                $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
            });
         }
      });
    }
    $('.invoice-List').load(base_url_admin+'fetch_invoices', invoice_cb);
    
    $('#invoiceType').change(function(){
        if($(this).val()=="Tax"){
          var html='<div class="form-group"><div class="input-group">';
          html+='<div class="input-group-addon">Reference No</div><input type="text" class="form-control refNo" name="ref_no"></div></div>';
          $('.append').append(html);


        }
    });

  //=============================
  //=============================
  //STAFF
  //=============================
  //=============================

  var staff_cb=function(){
     $('.staff-list-table').DataTable({
        
         "drawCallback": function( settings ) {
            //DELETE STAFF
            $('.deleteStaff').click(function(){
                 var staff_id=$(this).attr('id');
                        swal({
                          title: 'Are you sure of this ?',
                          text: "You can't be reverted!",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#D62C1A',
                          cancelButtonColor: '#2C3E50',
                          confirmButtonText: 'Yes, delete it!'
                      }).then(function () {
                          $.post( 
                        base_url_admin+"deleteStaff", 
                        {staff_id:staff_id}, 
                        function(data){
                           $.notify({
                                message: data
                            },{
                                type: "success",
                            });

                            $('.staff-list').load(base_url_admin+'staff-list', staff_cb);
                          
                        }
                    );
                          });
            });


            //EDIT STAFF PROFILE

            $('.editstaff').click(function(){
                 $.post( 
                    base_url_admin+"fetch_staff_info", 
                    {staff_id:$(this).attr('id')}, 
                    function(data){

                      $('#staffModal').modal('show');
                       $('#staffModal .modal-body').html(data);


                         //UPDATE STAFF INFORMATION
                          $('#updateStaffForm').submit(function(){
                              $.post( 
                                base_url_admin+"update_staff", 
                                $(this).serialize(), 
                                function(data){
                                  $('#staffModal').modal('hide');
                                  $('.staff-list').load(base_url_admin+'staff-list', staff_cb);
                                  $.notify({
                                      message: data
                                  },{
                                      type: "success",
                                  });
                                }
                              );
                              return false;
                              $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
                              $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
                          });


                          
                    }
                  );
            });
         }

    });
  }
  $('.staff-list').load(base_url_admin+'staff-list', staff_cb);

   //ADD STAFF
    $('#addstafform').submit(function(){
            $.post( 
                base_url_admin+"addStaff", 
                $(this).serialize(), 
                function(data){
                  $('#myModal').modal('hide');
                  $('#addstafform')[0].reset();
                   $('.staff-list').load(base_url_admin+'staff-list', staff_cb);
                    
                     $.notify({
                        message: data
                    },{
                        type: "success"
                    });
                    

                }
            );
             $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
             $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
             return false;          
    });



   $('.createReceipt').click(function(){
      $('.recieptform').toggle();
   });

   $('.InvoiceNO').keyup(function(){
      if($(this).val().length>=6){
         $.post( 
                base_url_admin+"fetch_services", 
                {invoice_no: $(this).val()}, 
                function(data){
                    $('.services').html(data);

                }
            );
             $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
             $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
      }
   });

   $('.ReceiptNo').keyup(function(){
      if($(this).val().length>=6){
         $.post( 
                base_url_admin+"fetch_reciept_items", 
                {reciept_no: $(this).val()}, 
                function(data){
                    $('.creditnoteItem').html(data);

                }
            );
             $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
             $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});
      }
   });

  //=============================
  //=============================
  //RECIEPT
  //=============================
  //=============================
   
     var receipt_cb=function(){
        $('.receiptTable').DataTable({
         "drawCallback": function( settings ) {

            //DELETE RECEIPT
            $('.deleteReceipt').click(function(){
                 var receipt_no=$(this).attr('data-receipt-no');
                 var batch=$(this).attr('data-batch');
                        swal({
                          title: 'Are you sure of this ?',
                          text: "You can't be reverted!",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#D62C1A',
                          cancelButtonColor: '#2C3E50',
                          confirmButtonText: 'Yes, delete it!'
                      }).then(function () {
                          $.post( 
                        base_url_admin+"deleteReceipt", 
                        {receiptData:{
                          "receipt_no":receipt_no,
                          "batch":batch
                        }},

                      
                        function(data){
                           $.notify({
                                message: data
                            },{
                                type: "success",
                            });

                            $('.receiptList').load(base_url_admin+'receiptList', receipt_cb);
                          
                        }
                    );
                          });
            });
          }
        });
      }
    $('.receiptList').load(base_url_admin+'receiptList', receipt_cb);



    
         

$('.creditNotes-List').load(base_url_admin+'credit-notes-list', function(){
  $('.notesList').DataTable();
});

$('.createCrediteNote').click(function(){
  $('#creditNoteform').toggle();
});
    
        

 
   


});

