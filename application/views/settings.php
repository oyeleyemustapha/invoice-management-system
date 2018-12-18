


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Settings</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


          
                <div class="row">
                   

                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">

                                    <button class="btn btn-primary btn-sm" data-toggle="modal" href='#modal-id'><i class="fa fa-edit fa-fw"></i>Update Company's Profile</button>

                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>backup-records" target="_blank"><i class="fa fa-download fa-fw"></i>Back Up</a>

                                    
                                </h4>
                                <div class="companyInfo"></div>
                                
                                
                               
                               

                                
                            </div>
                        </div>
                    </div>
                </div>

              

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->



        <div id="modal-id" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Company Profile</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <form method="post" id="updateCompanyinfo">
                                                        <div class="form-group">
                                                          <input type="text" class='form-control' name="name" required="" placeholder="Company's Name" value="<?php echo $company->NAME; ?>">
                                                        </div>



                                                        <div class="form-group">
                                                          <input type="text" class='form-control' name="phone" required="" placeholder="Company's Phone" value="<?php echo $company->PHONE; ?>">
                                                        </div>

                                                         <div class="form-group">
                                                          <input type="text" class='form-control' name="email" required="" placeholder="Company's Email" value="<?php echo $company->EMAIL; ?>">
                                                        </div>


                                                        <div class="form-group">
                                                          <input type="text" class='form-control' name="address" required="" placeholder="address" value="<?php echo $company->ADDRESS; ?>">
                                                        </div>

                                                        <button class="btn btn-primary">Update</button>
                                                      </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

