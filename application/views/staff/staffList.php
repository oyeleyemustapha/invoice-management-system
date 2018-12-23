<?php

if($staff){
    echo'

        <table class="table table-bordered table-condensed table-hover staff-list-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>STAFF CODE</th>
                                            <th>USERNAME</th>
                                            <th>ROLE</th> 
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    $counter=1;
                                    foreach ($staff as $staff) {
                                        if($staff->TYPE==1){
                                            $role="Admin";
                                        }
                                        else
                                            $role='Non-admin';
                                        echo"
                                            <tr>
                                                <td>$counter</td>
                                                <td>$staff->NAME</td>
                                                <td>$staff->STAFF_CODE</td>
                                                <td>$staff->USERNAME</td>
                                                <td>$role</td>
                                                
                                                    <td>";

                                                    if($_SESSION['staff_id']==$staff->STAFF_ID){
                                                        echo"<button class='btn btn-primary  btn-sm editstaff' id='$staff->STAFF_ID' disabled>Edit</button>

                                                    <button class='btn btn-danger  btn-sm deleteStaff' id='$staff->STAFF_ID' disabled>Delete</button>";
                                                    }
                                                    else{
                                                        echo"<button class='btn btn-primary btn-sm editstaff' id='$staff->STAFF_ID'>Edit</button>

                                                    <button class='btn btn-danger  btn-sm deleteStaff' id='$staff->STAFF_ID'>Delete</button>";
                                                    }

                                                    
                                                    

                                                echo"</td>
                                            </tr>
                                        ";
                                        $counter++;
                                    }

                                    
                                        
                                    echo'</tbody>
                                </table>



    ';
}
else{
    echo'
<div class="alert alert-info">
<h2 class="text-center">No Record Found</h2>
</div>


    ';
}



?>