<?php

if($company){


    echo'

    <div class="row">
                                  <div class="col-lg-6 offset-lg-3">
                                    <ul class="list-group">
                                      <li class="list-group-item company">'.$company->NAME.'</li>
                                      <li class="list-group-item"><i class="fa fa-mobile fa-fw   fa-2x"></i>'.$company->PHONE.'</li>
                                      <li class="list-group-item"><i class="fa fa-envelope fa-fw   fa-2x"></i>'.$company->EMAIL.'</li>
                                      <li class="list-group-item"><i class="fa fa-map-marker fa-fw   fa-2x"></i>'.$company->ADDRESS.'</li>
                                    </ul>
                                  </div>
                                </div>




    ';
}


?>