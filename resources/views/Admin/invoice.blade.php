<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
    * {
      font-family: Verdana, sans-serif;
    }
    table td {
      padding: 5px;
      vertical-align:top;
    }
    label {
      font-size: 14px;
      color: #5b5b5b;
      font-weight:700;
      margin-bottom: 0;
      line-height: 15px;
    }
    p {
      font-size: 12px;
      color: #5b5b5b;
      margin-bottom: 0;
    }
    tr {
      padding: 0;
    }
    .theadrow {
      background-color: #f5f5f5;
    }
    .borderbtm td {
      border-bottom: 1px solid #f5f5f5;
    }
    .px {
      padding: 1px 10px;
    }
    </style>
</head>

<body>
    <table width="100%" border="0">
        <tr>
            <td style="vertical-align: top" colspan="3"><h1 class="letter">INVOICE</h1></td>
            <td style="vertical-align: top; padding-top:20px;">
              <img src="{{asset('admin-assets/logo/logo.png')}}" width="60px" />
            </td>
        </tr>
        <tr>
          <td style="width:40%">
            <label>INVOICE No: <small>REYO{{ sprintf("%06d", $data->id) }}</small></label>
          </td>
          <td style="width:40%"> 
            <label>DATE OF ISSUE: <small>{{ date_format(date_create($data->created_at),"d-m-Y") }}</small></label>
          </td>
          <td colspan="2">
          </td>
        </tr>
        <tr>
          <td style="width:40%">
            <label>Naturacare INTERNATIONAL</label>
            <p class="h6font">401,3rd floor,manjari bulding<br>Annamalai Layout,Erode-638011,<br>TamilNadu,India<br>enquiry@reyo.in<br>(0424)-4020999</p>
          </td>
            <td colspan="2" style="width:60%">
              <label>DELIVERY ADDRESS</label>
              @php
                  $addr = json_decode($data->ship_address,true);
                  $optaddr = $addr['optional_name'] != '' && $addr['optional_name'] != null ? $addr['optional_name'].',' : '';
                  $prods = json_decode($data->product_order_list,true);
              @endphp
              <p class="h6font">{{ $addr['fname'] }} {{ $addr['lname'] }},<br>{{ $addr['address'] }},{!! $optaddr !!}<br>{{ $addr['city'] }}, {{ $addr['state'] }}, {{ $addr['country'] }} - {{ $addr['pin_code'] }} <br><b>Mobile no:</b> {{ $addr['mobile_num'] }}</p>
            </td>
            <tr>
            <td colspan="4" width="100%" style="padding:0">
              <table width="100%">
                <tr class="theadrow">
                  <td><label class="px">Product Name</label></td>
                  <td align="center"><label class="px">UNIT COST</label></td>
                  <td align="center"><label class="px">Qty</label></td>
                  <td align="right"><label class="px">Amount</label></td>
                </tr>
                @foreach ($prods as $key => $prod)
                <tr class="borderbtm">
                  <td><p>{{ $prod['name'] }}</p></td>
                  <td align="center"><p>Rs. {{ $prod['price'] }}</p></td>
                  <td align="center"><p>{{ $prod['qty'] }}</p></td>
                  <td align="right"><p>Rs. {{ $prod['paid_price'] }}</p></td>
                </tr>
                @endforeach
              </table>
            </td>
        </tr>
        <tr>
          <td width="40%"></td>
            <td colspan="3" width="60%">
              <table width="100%">
                <tr>
                  <td align="right" width="70%"><label>SUBTOTAL:</label></td>
                  <td align="right" width="30%"><label>Rs. {{ $data->sub_total_amount }}</label></td>
                </tr>
                <tr>
                  <td align="right" width="70%"><label>DELIVERY CHARGES:</label></td>
                  <td align="right" width="30%"><label>Rs. {{ $data->delivery_fees }}</label></td>
                </tr>
                <tr>
                  <td align="right" width="70%"><label>COUPON VALUE:</label></td>
                  <td align="right" width="30%"><label>Rs. {{ $data->coupon_price }}</label></td>
                </tr>
                <tr>
                  <td align="right" width="70%"><label>WALLET AMOUNT:</label></td>
                  <td align="right" width="30%"><label>Rs. {{ $data->wallet_taken }}</label></td>
                </tr>
                <tr>
                  <td align="right" width="70%" style="padding:15px 0;">
                      <label style="font-size:20px;">TOTAL:<label>
                  </td>
                  <td align="right" width="30%" style="padding:15px 0;"><label style="font-size:20px;">Rs. {{ $data->total_amount }}</label></td>
                </tr>
              </table>
            </td>
        </tr>
    </table>
</body>

</html>
