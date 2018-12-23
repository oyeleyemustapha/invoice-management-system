


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Receipts</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


          
                <div class="row">
                   

                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"><button class="btn btn-success btn-sm createReceipt"><i class="fa fa-plus fa-fw"></i>Generate Reciept</button>
                                  

                                </h4>
                                <div class="col-lg-8 offset-lg-2 recieptform">
                                  
                                  <form method="post" action="<?php echo base_url(); ?>create-receipt" target="_blank">
                                   
                                  <div class="form-group clientname">
                                    <select class="form-control form-control-lg" id="invoiceSelect" name="invoice_no">
                                    <option></option>
                                  </select>

                                  

                                  </div>

                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-addon">Payment Type</div>
                                       <select class="form-control" name="payment_type" required="">
                                        <option value="">Select Payment Type</option>
                                          <option value="Cash">Cash</option>
                                           <option value="Cheque">Cheque</option>
                                           <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                  </div>
                                  


                               
                                  <button class="btn btn-primary">Generate</button>
                                </form>
                                </div>


                                

                               
                                
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                   

                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                               <div class="receiptList table-responsive">
                                 

                               </div>
                                
                               
                                

                               
                                
                            </div>
                        </div>
                    </div>
                </div>

              

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


<!-- sample modal content -->
                                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Create Client Profile</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <form method="post" id="addclientform">
                                                           <div class="form-group">
                                                               <input type="text" name="name" class="form-control" placeholder="Client Name" required="">
                                                           </div>

                                                            

                                                           <div class="form-group">
                                                               <input type="text" name="phone" class="form-control" placeholder="Phone Number" required="">
                                                           </div>

                                                            <div class="form-group">
                                                               <input type="text" name="email" class="form-control" placeholder="Email Adress" required="">
                                                           </div>

                                                           <div class="form-group">
                                                               <textarea class="form-control" name="address">Client Address</textarea>
                                                           </div>
                                                           

                                                           <button class="btn btn-danger">Add</button>
                                                       </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->



<div id="invoiceModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Invoice</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                      
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

