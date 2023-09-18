<!DOCTYPE html>
<html>

<head>
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <style>
     /* body
    {
        background-image:url('https://media.glassdoor.com/sqll/561082/arvin-international-marketing-squarelogo-1637307639526.png');
        background-repeat:repeat-y;
        background-position: center;
        background-attachment:fixed;
        background-size:100%;
    } */
    /* Styles go here */

    .page-header, .page-header-space {
      height: 40px;
    }

    .page-footer, .page-footer-space {
      height: 100px;
    }

    .page-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    /* border-top: 1px solid black; for demo */
    /* background: yellow; for demo */
    }

    .page-header {
    position: fixed;
    top: 0mm;
    width: 100%;
    /* border-bottom: 1px solid black;  */
    /* for demo */
    /* background: yellow; for demo */
    }

    /* .page {
    page-break-after: always;
    } */

    @page {
        margin: 10mm;
        size: 8.5in 13in;
        size: portrait;
    }

   

    @media print {
      thead {display: table-header-group;} 
      tfoot {display: table-footer-group;}
    
      button {display: none;}
      
      body {
          margin: 0;
          font-family: 'Century Gothic';
          font-size: 16px;
      }

      .adjust tr td, .adjust tr th{
        padding: 4px 6px !important;
        margin: 0 !important;
      }

      .adjust {
        border-collapse: collapse;
        border: .8px solid black;
      }
      .adjust td{
        border: .8px solid black;
      }
      .adjust th{
        border: .8px solid black;
      }

      .accnt_title tr td{
        padding: 1px 3px !important;
        margin: 0 !important;
      }

      .foramount tr td{
        vertical-align: middle;
        font-size: 40px
      }
    }

    p{
      font-size: 16px
    }

   

  </style>
</head>

<body onload="window.print()">

  <div class="page-header">
        <div class="text-center">
          <h5>C A S H  V O U C H E R</h5>
        </div>
  </div>
  <div class="page-footer">
    {{-- <div class="row justify-content-between">
        <div class="col-4">
            <h5>Prepared By:</h5>
            <p style="border-bottom:1px solid black;font-size:20px;margin-bottom:3px">{{ strtoupper(auth()->user()->name) }}</p>
            <p style="font-size:20px;">{{ date("m/d/Y") }}</p>
        </div>
        <div class="col-4">
            <h5>Checked By:</h5>
            <p style="border-bottom:1px solid black;font-size:20px;margin-bottom:1px">&nbsp;</p>
        </div>
    </div> --}}
  </div>

  <table style="width: 100%;" style="font-size: 11px">

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space">
            
          </div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
        <!--*** CONTENT GOES HERE ***-->
           <div class="row justify-content-between">
              <div class="col-8">
                <p class="mb-1">Payment to:&nbsp;&nbsp;{{ $cashVoucher->bp_master_data->name ?? $cashVoucher->payment_others }}</p>
              </div>
              <div class="col-3">
                <p class="mb-0">CV No.:&nbsp;&nbsp;{{ $cashVoucher->cvno }}</p>
              </div>
          </div>
          <div class="row justify-content-between">
            <div class="col-4">
              <p class="mb-0">Bank:&nbsp;&nbsp;{{ $cashVoucher->bank }}</p>
            </div>
            <div class="col-4">
              <p class="mb-1">Check No.:&nbsp;&nbsp;{{ $cashVoucher->checkno }}</p>
            </div>
            <div class="col-3">
              <p class="mb-0">CV Date:&nbsp;&nbsp;{{ date("m/d/Y",strtotime($cashVoucher->cvdate)) }}</p>
            </div>
        </div>
        <table class="table adjust mb-1 mt-0">
          <tr class="text-center">
            <td width="50%">PARTICULARS</td>
            <td width="50%" colspan="2">AMOUNT</td>
          </tr>
          <tr>
            <td>
              <p>{{ $cashVoucher->particulars }}</p>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right">
              <p class="font-size:40px"><h3>{{ number_format($cashVoucher->amount,2) }}</h3></p>
            </td>
          </tr>
          <tr>
            <th>Account Title</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
          </tr>
        </table>
        <table class="table table-borderless accnt_title">
          
          @foreach ($cashVoucher->cashvoucher_detail as $item)
            <tr>
              <td width="50%">{{ $item->chart_account->name }}</td>
              <td width="25%"class="text">{{ number_format($item->amount,2) }}</td>
              <td width="25%"></td>
            </tr>
            @if ($item->inputVat!=0)
            <tr>
              <td>INPUT VAT</td>
              <td>{{ number_format($item->inputVat,2) }}</td>
              <td></td>
            </tr>
            @endif
            @if ($item->ewTax!=0)
            <tr>
              <td>EWTAX {{ $item->ewTaxPercent }} %</td>
              <td></td>
              <td class="text-right">{{ number_format($item->ewTax,2) }}</td>
            </tr>
            @endif
            @endforeach
            <tr>
              <td>CASH IN BANK</td>
              <td></td>
              <td class="text-right">{{ number_format($cashVoucher->amount,2) }}</td>
            </tr>
       
        </table>
        <div class="row justify-content-between">
          <div class="col-6">
            <p>Received By:</p>
          </div>
          <div class="col-3">
            <p>Prepared By:</p>
          </div>
          <div class="col-3">
            <p>Certified By:</p>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-5">
            <p class="mb-0">{{ $cashVoucher->bp_master_data->name ?? $cashVoucher->payment_others  }}</p>
            <p>as full payment of the above account</p>
          </div>
          <div class="col-3 text-center">
            <p class="mt-3" style="border-top:0.7px solid black;font-size:15px;margin-bottom:3px">A. BRUSOLA</p>
          </div>
          <div class="col-3 text-center">
            <p class="mt-3" style="border-top:0.7px solid black;font-size:15px;margin-bottom:3px">ANGIE</p>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-6">
            <p>By:</p>
          </div>
          <div class="col-6">
            <p>Approved By:</p>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-6 text-center">
            <p class="mb-0 mt-3">(Print Name & Sign)</p>
          </div>
          <div class="col-4 text-center">
            <p class="mt-3" style="border-top:0.7px solid black;font-size:15px;margin-bottom:3px">ANNIKA LAO</p>
          </div>
          <div class="col-2 text-center"></div>
        </div>
        <!--*** CONTENT GOES HERE ***-->
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>

</body>

</html>