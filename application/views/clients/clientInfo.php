<?php

if($client){
    echo'
    <form method="post" id="updateClientForm">
    <input type="hidden" name="customer_id" value="'.$client->CUSTOMER_ID.'">
                                                           <div class="form-group">
                                                               <input type="text" name="name" class="form-control" placeholder="Client\'s Name" required="" value="'.$client->NAME.'">
                                                           </div>

                                                           <div class="form-group">
                                                               <input type="text" name="phone" class="form-control" placeholder="Phone Number" required="" value="'.$client->PHONE.'">
                                                           </div>

                                                            <div class="form-group">
                                                               <input type="text" name="email" class="form-control" placeholder="Email Adress" required="" value="'.$client->EMAIL.'">
                                                           </div>

                                                           <div class="form-group">
                                                               <textarea class="form-control" name="address">'.$client->ADDRESS.'</textarea>
                                                           </div>
                                                            

                                                           <button class="btn btn-danger">Update</button>
                                                       </form>
       
    ';
}



?>