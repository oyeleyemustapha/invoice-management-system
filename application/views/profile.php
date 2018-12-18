


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">My Profile</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


          
                <div class="row">
                   

                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                               
                                <div class="col-lg-8 offset-lg-2">


                                  
                                  <form method="post" id="UpdateProfile">

                                     <?php

                                        if($profile){


                                          echo'
                                            <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon">Name</div>
                                        <input type="text" class="form-control" name="name" value="'.$profile->NAME.'" required>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon">Username</div>
                                        <input type="text" class="form-control" name="username" value="'.$profile->USERNAME.'" required>
                                      </div>
                                    </div>


                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon">Password</div>
                                        <input type="password" class="form-control" name="password" value="">
                                      </div>
                                    </div>


                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon">Confirm Password</div>
                                        <input type="password" class="form-control" name="cpassword" value="" required>
                                      </div>
                                    </div>

                                    <button class="btn btn-primary btn-lg">Update</button>





                                          ';
                                        }

                                  ?>
                                    
                                   
                                      

                                


                               
                                </form>
                                </div>


                                

                               
                                
                            </div>
                        </div>
                    </div>
                </div>


               
              

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


