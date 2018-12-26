<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reciept : <?php  echo $receipt_no; ?></title>
    
    <style>
    .invoice-box {
        max-width: 100%;
        min-height: 400px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
       
        vertical-align: top;

    }
    
    

    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #fff;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #5E3023;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        text-transform: uppercase;
        color: #fff;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
 .invoicedetails{
    text-align: right;
 }
 .item td{
  padding: 1em;
    
 }

  .heading td{
    padding: 1em;
}
td.title p{
    color: #5E3023;
    font-size: 12px;
    line-height: 5px;
    font-weight: 600;
 
}

.pull-right{
    margin-top: 2.5em;
    float:right;

}

.clearfix{
    clear: both;
}
</style>

</head>

<body>
    <div class="invoice-box">


      <?php

    //var_dump($receipt);
        if($receipt){

         


          $address=explode('<br> ', $info->ADDRESS);
          $phone=explode(", ", $info->PHONE);


            echo'
               <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="'.base_url().'assets/images/fra.png">
                                <p>RC 1482554.</p>
                            </td>
                            
                            <td class="invoicedetails">
                                <strong>Receipt No : </strong> '.$receipt_no.'<br>
                                <strong>Tax Identification Number : </strong> 20866279-0001<br>
                                <strong>Created : </strong>'.date('F d, Y', strtotime($receipt_info->DATE_CREATED)).'<br>
                                <strong>Mode of Payment :</strong> '.$receipt_info->MODE_OF_PAYMENT.'<br>
                                <strong>Payment Term :</strong> '.$receipt[0]->PAYMENT_STATUS.' Payment

                                ';



                               echo'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                '.$address[0].'<br>
                                '.$address[1].'
                                <br>
                                '.$phone[0].'<br>
                                '.$phone[1].'<br>
                                '.$info->EMAIL.'
                            </td>
                            
                            <td class="invoicedetails">
                              <strong> '.$receipt[0]->NAME.'</strong><br>
                              <strong>'.$receipt[0]->ACCOUNT_NO.'</strong><br>
                                '.$receipt[0]->PHONE.'<br>
                                '.$receipt[0]->EMAIL.'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
          
            
            
           
            
            
            <tr class="heading">
                <td>
                ID
                </td>
                <td>
                    Item
                </td>

                <td>
                    Description
                </td>
                
                <td>
                    Price
                </td>
            </tr>';
            
            $total=0;
            $counter=1;
            $total_vat=0;
            foreach ($receipt as $receipt) {
            $VAT=(5/100)*$receipt->AMOUNT_PAID;

            $total_vat+=$VAT;
              $total+=$receipt->AMOUNT_PAID;



              echo"
                <tr class='item'>
                <td>
                    $counter
                </td>
                <td>
                    $receipt->SERVICE
                </td>
                <td>
                    $receipt->DESCRIPTION
                </td>
                
                <td>
                    &#8358; ".number_format($receipt->AMOUNT_PAID)."
                </td>
            </tr>

              ";

              $counter++;
            }
            
            
            
            
           if($receipt->RECIEPT_TYPE=="Tax"){
            $last_counter=($counter-1)+1;
            echo"<tr>
                    

                 <tr class='item'>
                 <td>
                    $last_counter
                    </td>
                <td>
                    VAT
                </td>
                <td>
                    Value Added Tax
                </td>
                
                <td>
                    &#8358; ".number_format($total_vat)."
                </td>





            </tr>";
           }


           if($receipt->RECIEPT_TYPE=="Tax"){
                $total=$total_vat+$total;
            }

            
            echo'



            <tr class="total">
                <td colspan="3"></td>
                <td>
                   Total: &#8358; '.number_format($total).'
                </td>
            </tr>
        </table>


        <div class="clearfix"></div>
        <div class="pull-right">
        <p><strong>FOR : FINITE RISK ADVISORS LIMITED</strong></p>

        <br><br>
       <strong> '.$_SESSION["name"].'</strong><br>
        '.$_SESSION["staff_code"].'
        </div>
            ';
        }






      ?>
       
    </div>
</body>
</html>
