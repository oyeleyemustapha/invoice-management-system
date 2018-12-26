<?php

if($services){



                                      echo'

                                        <table class="table table-hover">
                                       <thead>
                                         <tr>
                                           <th>ID</th>
                                           <th>SERVICE</th>
                                           <th>DESCRIPTION</th>
                                           <th>AMOUNT</th>
                                           
                                         </tr>
                                       </thead>
                                       <tbody>';
                                       $counter=1;
                                       foreach ($services as $service) {
                                         echo"
                                          <tr>
                                     <td>$counter</td>
                                     <td>$service->SERVICE</td>
                                     <td>$service->DESCRIPTION</td>
                                     <td>

                                     <input type='hidden' class='form-control' name='service[]' value='$service->SERVICE' required>
                                     <input type='hidden' class='form-control' name='description[]' value='$service->DESCRIPTION' required>
                                     <input type='text' class='form-control' name='amount[]' required></td>
                                     

                                   </tr>



                                         ";
                                         $counter++;
                                       }
                                   
                                 echo'</tbody>
                               </table>';
}
else{
    echo "<div class='alert alert-info'><h2 class='text-center'>No Record found</h2></div>";
}



?>