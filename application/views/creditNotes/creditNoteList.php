<?php

if($credit_notes){
    echo'

        <table class="table table-bordered table-condensed table-hover notesList">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CREDIT NOTE NO</th>
                                            <th>CLIENT</th>
                                            <th>ACCOUNT NUMBER</th>
                                            <th>DATE CREATED</th> 
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    $counter=1;
                                    foreach ($credit_notes as $credit_note) {


                                        echo"
                                            <tr>
                                                <td>$counter</td>
                                                <td>$credit_note->CREDIT_NOTE_NUMBER</td>
                                                <td>$credit_note->NAME</td>
                                                <td>$credit_note->ACCOUNT_NO</td>
                                                <td>".date('M d, Y', strtotime($credit_note->DATE_CREATED))."</td>
                                                <td><a class='btn btn-primary' target='_blank' href='".base_url()."credit-note/$credit_note->CREDIT_NOTE_NUMBER/$credit_note->TYPE'>Generate Credit Note</a></td>
                                                
                                               
                                            </tr>
                                        ";
                                        $counter++;
                                    }

                                    
                                        
                                    echo'</tbody>
                                </table>



    ';
}
else{
    echo "<div class='alert alert-info'><h2 class='text-center'>No Record found</h2></div>";
}



?>