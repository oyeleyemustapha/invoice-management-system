<!DOCTYPE html>
<html>
<head>


    <?php

        echo'
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <title>Invoice || Login</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <link href="'.base_url().'assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/css/icons.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/css/style.css" rel="stylesheet" type="text/css" />
        ';




    ?>
        
    </head>


    <body>

         

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">
                     <?php

                    

                        if ($this->session->flashdata('error')) {
                            echo'<div class="alert alert-info"><p class="text-center"><i class="fa fa-exclamation-triangle fa-2x"></i><br>'.$this->session->flashdata('error').'</p> </div>';
                        }                     
                    ?>

                    
                    
    

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="index.html" class="logo logo-admin"><img src="assets/images/avatar.png" height="120" alt="logo"></a>
                    </h3>

                    
                  

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" action="<?php echo base_url(); ?>login" method="post">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="text" required="" name="username" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" required="" name="password" placeholder="Password">
                                </div>
                            </div>

                           

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block" type="submit">Log In</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <?php

            echo'

                <script src="'.base_url().'assets/js/jquery.min.js"></script>
                <script src="'.base_url().'assets/js/popper.min.js"></script>
                <script src="'.base_url().'assets/js/bootstrap.min.js"></script>
                <script src="'.base_url().'assets/js/app.js"></script>


            ';


        ?>
        
    </body>
</html>