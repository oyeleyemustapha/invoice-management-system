<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice : <?php  echo $ref_no; ?></title>
    
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

 </style>


</head>

<body>
    <div class="invoice-box">


      <?php
        if($invoice){

         


          $address=explode('<br> ', $info->ADDRESS);
          $phone=explode(", ", $info->PHONE);


            echo'
               <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="'.base_url().'assets/images/fra.png">
                            </td>
                            
                            <td class="invoicedetails">
                                <strong>Reference No : </strong> '.$ref_no.'<br>
                                <strong>Created: </strong>'.date('F d, Y', strtotime($invoice[0]->DATE_CREATED)).'<br>';



                                if($invoice[0]->STATUS=="Not Paid"){
                                    echo'<strong>Due:</strong>'. date("F d, Y", strtotime($invoice[0]->DUE_DATE));
                                }
                               echo'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                '.word_wrap($address[0]).'
                                <br>
                                '.$phone[0].'<br>
                                '.$phone[1].'<br>
                                '.$info->EMAIL.'
                            </td>
                            
                            <td class="invoicedetails">
                               '.$invoice[0]->NAME.'<br>
                                '.$invoice[0]->PHONE.'<br>
                                '.$invoice[0]->EMAIL.'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
           
            
            
            <tr class="heading">
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
            foreach ($invoice as $invoice) {
              $total+=$invoice->AMOUNT;
              echo"
                <tr class='item'>
                <td>
                    $invoice->SERVICE
                </td>
                <td>
                    $invoice->DESCRIPTION
                </td>
                
                <td>
                    &#8358; ".number_format($invoice->AMOUNT)."
                </td>
            </tr>

              ";
            }
            
            
            
            
           
            
            echo'<tr class="total">
                <td colspan="2"></td>
                <td>
                   Total: &#8358; '.number_format($total).'
                </td>
            </tr>
        </table>



            ';
        }






      ?>
       
    </div>
</body>
</html>
