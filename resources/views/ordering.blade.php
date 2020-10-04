
@extends('layouts.clientlayout')
@section('title', 'Ordering')
@section('header','Ordering')
@section('content')

<div class="row caseta steps" style="margin-left: 10px;">
  <br>
  <div class="col-xs-3">

    <button class="" style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 1</button>
    <br> <br>
    <button class="NOR" type="button" name="button">
      <div class="center">
         <img src="/img/s1.png" alt="">
        <p>Estimation</p>
      </div>
     </button>
    <span class="glyphicon glyphicon-play"></span><!-- nurfvg -->
    <br> <br>
    <button class="NOR" type="button" name="button">
      <div class="center">
         <img src="/img/s2.png" alt="">
        <p>Estimation</p>
      </div>
     </button>
    <span class="glyphicon glyphicon-play"></span>
  </div>

  <div class="col-xs-3">

    <button class=""style="background-color:#003b99; color:white; border:none; width:80% !important; width:100px; border-radius:30px;" type="button" name="logout">STEP 2</button>
    <br> <br>
    <button class="NOR" type="button" name="button">
       <div class="center">
          <img src="/img/s3.png" alt="">
         <p>Request</p>
       </div>
     </button>
    <span class="glyphicon glyphicon-play"></span><!-- nurfvg -->
    <br> <br>
    <button class="NOR" type="button" name="button">
      <div class="center">
         <img src="/img/s4.png" alt="">
        <p>Data upload</p>
      </div>
     </button>
    <span class="glyphicon glyphicon-play"></span>
  </div>
  <div class="col-xs-3">

    <button class=""style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 3</button>
    <br><br>
      <button class="NOR" type="button" name="button" style="height: 92px;">
           <img src="/img/s5.png" alt="" style="float: none; width:100%;">
          <p>Payment</p>
      </button>
      <span  class="glyphicon glyphicon-play" style="margin-top: 40px;"></span><!-- nurfvg -->

  </div>
  <div class="col-xs-3">

    <button class=""style="background-color:#003b99; border:none; width:80% !important; color:white; width:100px; border-radius:30px;" type="button" name="logout">STEP 4</button>
      <br><br>
      <button class="NOR" type="button" name="button" style="height: 92px;">
           <img src="/img/s6.png" alt="" style="float: none; width:100%;">
          <p>Delivery</p>
      </button>
  </div>
</div>




  <div class="row caseta steps" style="margin-left:10px; padding:55px;">

    <div class="" style="margin-left:10px;">

    </div>
    <p>Recipt nr: 000000</p>
    <p>Name product: 0000000000000</p>
    <p>Product expiration date: 5 days (2018/00/00)</p>



    <table class="table">
          <tbody>
          <tr>
            <td>Content</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Subtotal</ttdh>
          </tr>


          <tr>
            <td>Standard</td>
            <td>15</td>
            <td>120</td>
            <td>1,800</td>
          </tr>
          <tr>
            <td>Tip A</td>
            <td>38</td>
            <td>500</td>
            <td>19,000</td>
          </tr>
          <tr>
            <td>Tip B</td>
            <td>0</td>
            <td>1,000</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Tip c</td>
            <td>0</td>
            <td>1,500</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td>53</td>
            <td>Subtotal</td>
            <td>20,800</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Taxes</td>
            <td>1,664</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Total</td>
            <td>22,464</td>
          </tr>
        </tbody>
      </table>
<div class="col-xs-2">
  Delivery:
</div>
<div class="col-xs-10">
  <input type="checkbox" name="format" value="">Format
  <input style="margin-left:15px;" type="radio" name="extension" value="">JPEG
  <input style="margin-left:10px;" type="radio" name="extension" value="">TIFF
  <input style="margin-left:10px;" type="radio" name="extension" value="">EPS
  <input style="margin-left:10px;" type="radio" name="extension" value="">PSD
  <br>
  <input type="checkbox" name="backgr" value="">Background
  <br>
  <input type="checkbox" name="eps" value="">Eps delivery onhly
  <br>
  <input type="checkbox" name="Resolution" value="">Resolution Change
  <br>
  <input type="checkbox" name="rbg" value="">RGB->CMYK
  <br> <br>
</div>
<p>Estimated date delivery: 2018/00/00</p>
<input type="checkbox" name="agree" value="agree"><b>Press the order button to go to card payment.</b> <br><br>
      <center>
          <button class="btn "style="background-color:#003b99; color:white; width:150px; border-radius:30px; margin-left:25px;" type="button" name="logout">Order</button>
          <button class="btn "style="background-color:#7d828a; color:white; width:150px; border-radius:30px; margin-left:25px;" type="button" name="logout">Cancel</button>
        </center>

  </div>

  @endsection
