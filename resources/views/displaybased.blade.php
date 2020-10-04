@extends('layouts.baselayout')
@section('title', '特定商取引法に基づく表記')
@section('header','特定商取引法に基づく表記')


@section ('dependencies')
@parent

<style media="screen">

  .table tbody tr td{
    padding: 10px !important;
  }

</style>

@endsection

@section('content')


<div class="row caseta" style="margin-left: 10px; margin-right: 10px;">
<div class="" style="margin: 15px;">
  <br><br>

  <table style="border-color:#ebecf0;"class="table disp">

  <tbody>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">販売業者</td>
      <td>株式会社フルブリッジ </td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">運営責任者</td>
      <td>代表取締役:鈴木岳志</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">所在地</td>
      <td>〒440-0861 愛知県豊橋市向山西町2番地5</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">電話番号</td>
      <td>0532-56-1313</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">注文方法</td>
      <td>1)マイページより切り抜き依頼したい画像をサーバーにアップしていただき、
          見積りと納期をご提示させていただきます。
          2)入金確認後、ご注文確認メールが届きますのでご確認ください。</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">商品等の引き渡し時期および発送方法</td>
      <td>ご注文代金の入金確認後、2営業日以内に発送いたします。
        納期については、事前にお知らせをしておりますが、混雑時等は、
        多少の前後がある場合が御座います。ご了承ください。</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">販売価格</td>
      <td>サービス料金表に記載</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">代金の支払時期および支払方法</td>
      <td>当店よりお送りした見積もりの有効期限は発行から5営業日となります。
          それまでにお支払いください。
          支払い方法はクレジットカード決済のみとなります。
          クレジットカードはVISA、MASTER、DINERS、AMEX、JCBがご利用いただけます。
          お支払回数は1回のみとさせていただいております。</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">商品代金以外に必要な費用 (送料、手数料、消費税等)</td>
      <td>商品代金以外に下記料金が別途かかります。
          1)消費税:8%</td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">返品の取扱条件( 返品期限、返品時の送料負担または解約や退会条件 )</td>
      <td>サービスの特性上、基本的にお受けしておりません。
          ユーザーの登録の抹消を希望する場合は、その旨をE-mailにて
          弊社問い合わせ窓口宛に届け出てください。 </td>
    </tr>
    <tr>
      <td style="width:30%;background-color:#b5b8bd;">不良品の取扱条件</td>
      <td>弊社の不備による修正、再作業は無料で対応させていただきますが、
          追加指示等には料金が発生いたします。</td>
    </tr>
  </tbody>
  </table>

</div>

</div>
@endsection
