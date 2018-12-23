<?php

if($clients){
    echo'

        <table class="table table-bordered table-condensed table-hover staffList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>ACCOUNT NO</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>ADDRESS</th> 
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    $counter=1;
                                    foreach ($clients as $client) {
                                        echo"
                                            <tr>
                                                <td>$counter</td>
                                                <td>$client->NAME</td>
                                                <td>$client->ACCOUNT_NO</td>
                                                <td>$client->EMAIL</td>
                                                <td>$client->PHONE</td>
                                                <td>$client->ADDRESS</td>
                                                <td>
                                                    <button class='btn btn-primary btn-block btn-sm editClient' id='$client->CUSTOMER_ID'>Edit</button>
                                                    

                                                </td>
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