<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
     .page-header {
      position: fixed;
      top: 0mm;
      width: 100%;
      }

      body{
        font-size: 12px;
        font-family:arial, verdana, sans-serif;
        font-weight: normal;
      }

     @page { margin: 10px 30px; }
    /* body { margin: 0px; } */
    .adjust {
        border-collapse: collapse;
        border: .3px solid black;
    }
    .adjust td{
        border: .3px solid black;
    }
    .adjust th{
        border: .3px solid black;
    }

    .accnt_title tr td{
          padding: 1px 3px !important;
          margin: 0 !important;
        }
</style>
</head>

<body>
    <div class="page-header">
        <div style="text-align:center">
          <h4>C A S H  V O U C H E R</h4>
        </div>
  </div>
    {{-- <table class="adjust" width="100%" style="margin-top:20px;text-align:center" width="100%">
        <tr>
            <td>C A S H V O U C H E R</td>
        </tr>
    </table> --}}
  <table class="adjust_top" width="100%" style="margin-top:30px">
    <tr>
        <td width="12%">Payment to:</td>
        <td width="61%">{{ $cashVoucher->bp_master_data->name ?? $cashVoucher->payment_others }}</td>
        <td width="13%">CV No.:</td>
        <td>{{ $cashVoucher->cvno }}</td>
    </tr>
  </table>
  <table class="adjust_top" width="100%" >
    <tr>
        <td width="12%">Bank</td>
        <td width="30%">{{ $cashVoucher->bank }}</td>
        <td>Check No.:</td>
        <td width="20%">{{ $cashVoucher->checkno }}</td>
        <td width="13%">CV Date:</td>
        <td>{{ date("m/d/Y",strtotime($cashVoucher->cvdate)) }}</td>
    </tr>
  </table>
    {{--  --}}
    <table class="adjust" style="width: 100%">
        <tr style="text-align:center">
            <td width="50%">PARTICULARS</td>
            <td width="50%" colspan="2">AMOUNT</td>
        </tr>
        <tr>
            <td>
                {{ $cashVoucher->particulars }}
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right">
                <p style="font-size:25px">{{ number_format($cashVoucher->amount,2) }}</p>
            </td>
        </tr>
        <tr>
            <td>Account Title</td>
            <td style="text-align:center">Debit</td>
            <td style="text-align:center">Credit</td>
        </tr>
    </table>
    {{--  --}}
    <table class="accnt_title" width="100%">
        @foreach ($cashVoucher->cashvoucher_detail as $item)
          <tr>
            <td width="50%">{{ $item->chart_account->name }}</td>
            <td width="32%" style="text-align:right">{{ number_format($item->amount,2) }}</td>
            <td width="28%"></td>
          </tr>
          @if ($item->inputVat!=0)
          <tr>
            <td>INPUT VAT</td>
            <td style="text-align:right">{{ number_format($item->inputVat,2) }}</td>
            <td></td>
          </tr>
          @endif
          @if ($item->ewTax!=0)
          <tr>
            <td style="text-align:right">EWTAX {{ $item->ewTaxPercent }} %</td>
            <td></td>
            <td style="text-align:right">{{ number_format($item->ewTax,2) }}</td>
          </tr>
          @endif
        @endforeach
        <tr>
            <td>CASH IN BANK</td>
            <td></td>
            <td style="text-align:right">{{ number_format($cashVoucher->amount,2) }}</td>
        </tr>
      </table>
      {{--  --}}
      <table class="accnt_title" width="100%">
          <tr>
            <td width="50%">Received By</td>
            <td width="40%" style="text-align:center">Prepared By</td>
            <td width="40%" style="text-align:center">Certified By</td>
          </tr>
      </table>
      {{--  --}}
      <table class="accnt_title" width="100%">
        <tr>
          <td width="50%">{{ $cashVoucher->bp_master_data->name ?? $cashVoucher->payment_others  }}</td>
          <td></td>
          <td></td>
          <td width="30%" style="text-align:center;"></td>
          <td></td>
          <td></td>
          <td width="30%" style="text-align:center;"></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
            <td width="50%">as full payment of the above account</td>
            <td></td>
            <td></td>
            <td width="30%" style="text-align:center;border-top:.3px solid black;">A.BRUSOLA</td>
            <td></td>
            <td></td>
            <td width="30%" style="text-align:center;border-top:.3px solid black;">ANGIE</td>
            <td></td>
            <td></td>
          </tr>
    </table>
    {{--  --}}
    <table class="accnt_title" width="100%" style="margin-top: 15px">
        <tr>
          <td width="50%">By</td>

          <td width="12%">Approved By</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
            <td width="50%" style="text-align:center;">(Print Name & Sign)</td>
            <td></td>
            <td width="30%" style="text-align:center;border-top:.3px solid black;">ANNIKA LAO</td>
        </tr>
    </table>
</body>

</html>