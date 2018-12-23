<?php

if($staff){

  if($staff->TYPE==1){
    $type="Admin";
  }
  else{
    $type="Non-admin";
  }
    echo'
    <form method="post" id="updateStaffForm">
    <input type="hidden" name="staff_id" value="'.$staff->STAFF_ID.'">
        <form method="post" id="addstafform">
                                                           <div class="form-group">
                                                               <input type="text" name="name" class="form-control" placeholder="Staff Name" required="" value="'.$staff->NAME.'">
                                                           </div>

                                                            

                                                           <div class="form-group">
                                                               <input type="text" name="staff_code" class="form-control" placeholder="Staff Code" required="" value="'.$staff->STAFF_CODE.'">
                                                           </div>

                                                            <div class="form-group">
                                                               <select name="type" required class="form-control">
                                                             
                                                               <option value="'.$staff->TYPE.'" selected>'.$type.'</option>
                                                                 <option value="">Role</option>
                                                                 <option value="1">Admin</option>
                                                                 <option value="2">Non-admin</option>
                                                               </select>
                                                           </div>

                                                            <div class="form-group">
                                                               <input type="text" name="username" class="form-control" placeholder="Username" value="'.$staff->USERNAME.'" required="">
                                                           </div>

                                                            <div class="form-group">
                                                               <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                                           </div>

                                                           <div class="form-group">
                                                               <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required="">
                                                           </div>

                                                           
                                                           

                                                           <button class="btn btn-danger">Update</button>
                                                       </form>                                                    

                                                            
    ';
}



?>