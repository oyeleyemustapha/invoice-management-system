


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Credit Notes</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


          
                <div class="row">
                   

                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"><button class="btn btn-success btn-sm createCrediteNote"><i class="fa fa-file-text-o fa-fw"></i>Generate Credit Note</button>
                                 

                                </h4>
                                <div class="col-lg-12">
                                  
                                  <form method="post" action="<?php echo base_url(); ?>create-credit_note" target="_blank" id="creditNoteform">
                                    
                                  <div class="form-group">
                                   <input type="text" name="reciept_no" required="" class="form-control ReceiptNo" placeholder="Type Reciept Number">
                                  </div>

                                  <div class="form-group">
                                   <select class="form-control" required="" name="type">
                                     <option value="">Select Credit Note Type</option>
                                     <option value="Tax">Tax</option>
                                     <option value="Client">Client</option>
                                   </select>
                                  </div>

                                  <div class="creditnoteItem"></div>

                                  
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
                               <div class="creditNotes-List table-responsive"></div>
                                


                                

                               
                                
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

