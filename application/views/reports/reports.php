


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Reports</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


          
                


                <div class="row">
                   

                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                              <div class="btn-group"> 
                                  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Monthly Report</button>
                                  <button class="btn btn-danger" data-toggle="modal" data-target="#myModal2">Annual Report</button>

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
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Monthly Report</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <form method="post" target="_blank" action="<?php echo base_url();?>month-report">
                                                           <div class="form-group">
                                                             <div class="input-group">
                                                               <div class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i>Month</div>
                                                               <select class="form-control" name="month" required=""><?php echo $month; ?></select>
                                                             </div>
                                                           </div>

                                                           <div class="form-group">
                                                             <div class="input-group">
                                                               <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i>Year</div>
                                                               <select class="form-control" name="year" required=""><?php echo $year; ?></select>
                                                             </div>
                                                           </div>

                                                           <button class="btn btn-primary btn-lg">Generate</button>
                                                       </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->




  <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Annual Report</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <form method="post" target="_blank" action="<?php echo base_url();?>annual-report">
                                                           

                                                           <div class="form-group">
                                                             <div class="input-group">
                                                               <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i>Year</div>
                                                               <select class="form-control" name="year" required=""><?php echo $year; ?></select>
                                                             </div>
                                                           </div>

                                                           <button class="btn btn-primary btn-lg">Generate</button>
                                                       </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->




