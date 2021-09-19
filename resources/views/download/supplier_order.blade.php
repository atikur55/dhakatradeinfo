
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    html{
      width: 80%;
      margin: 0 auto;
    }
    #invoice {
      border: 7px solid #9999999c;
      padding: 0px 20px 20px 20px;
      height: auto;
    }
    #invoice .invoice-body {
      padding: 100px 50px 10px 50px;
      height: auto;
    }
    #invoice p{
      font-size: 14px;
      color: #555555;
    }
    #invoice h6{
      font-size: 14px;
      color: #222222;
      font-weight: 600;
      margin: 0;
    }
    #invoice .top{
      /* display: flex;
      justify-content: space-between; */
      width: 100%;
    }
    #invoice .top .left{
      float: left;
    }
    #invoice .top .right{
      float: right;
    }
    #invoice .logo {
      height: 250px;
      /* background-image: linear-gradient(#023059, #ffffff); */
      background-color: #023059;
      padding-top: 50px;
    }
    #invoice .logo img{
      width: 100%;
      height: auto;
    }
    #invoice .body-top {
      /* display: flex;
      justify-content: space-between; */
      width: 100%;
      margin-top: 30px;
    }
    #invoice .body-top .left
    {
        float: left;
    }
    #invoice .body-top .right
    {
        float: right;
    }
    #invoice .body-top .bottom {
      margin-top: 50px;
    }
    #invoice .data-table{
      margin-top: 30px;
    }
    #invoice .data-table h6{
      line-height: 80px;
    }
    #invoice table{
      width: 100%;
    }
    #invoice table {
      width: 100%;
      border-bottom: 3px solid #023059;
    }
    #invoice table tr{
      line-height: 60px;
      border-bottom: 3px solid #023059;
    }
    #invoice table thead tr th{
      border-bottom: 1px solid #9999995c;
    }
    #invoice table tbody tr td{
      text-align: center;
      border-bottom: 1px solid #9999995c;
    }
    #invoice .total {
      width: 30%;
      float: right;
      display: flex;
      justify-content: space-between;
    }
    #invoice .signature {
      width: 150px;
      text-align: center;
      margin-top: 80px;
    }
  </style>
</head>
<body>
  <section id="invoice">
    <div class="top">
        <div class="left">
            <p>{{ $issueDate }}</p>
        </div>
        <div class="right">
            <p>Print Invoice</p>
        </div>
    </div>
    <div class="invoice-body">
      <div class="logo">
        <img src="{{ public_path('assets/img/logo1.png') }}" alt="Logo">
      </div>
      <div class="body-top">
        <div class="left">
          <h6>Billed To:</h6>
          <div class="bottom">
            <h6>{{ $order->name??'' }}</h6> 
            <p>{{ $order->address??'' }}</p>
          </div> 
        </div>
        <div class="right">
          <h6>Issue Date:</h6>
          <p>15-09-2021</p>
          <div class="bottom">
            <h6>Invoice:</h6>
            <p>{{ $order->track_no??'' }}</p>
          </div>
        </div>
      </div>
      <div class="data-table">
          <h6>Order Summery</h6>
          <table>
            <thead>
              <tr>
                <th>SL</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>{{ $order->product_name??'' }}</td>
                <td>{{ $productInfo->price_dollar??'' }}</td>
                <td>{{ $order->final_quantity??'' }}</td>
                <td>{{ $order->confirm_total_price??'' }}</td>
              </tr>
            </tbody>
          </table>
          <div class="total">
            <h6>Total: </h6>
            <h6>Tk {{ $order->confirm_total_price??'' }}</h6>
          </div>
      </div>
      <div class="signature">
        <p>------------------------------</p>
        <p>Signature</p>
      </div>
    </div>
  </section>
</body>
</html>