<table>
    <tr>
        <th>Branch</th>
        <td colspan="12">{{ $branch->name }}</td>
    </tr>
    <tr>
        <th>Date</th>
        <td colspan="12">{{ $dateFrom .' - '.$dateTo }}</td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="border:1px solid black">DATE</th>
            <th style="border:1px solid black">CV#</th>
            <th style="border:1px solid black">CHEQUE NUMBER</th>
            <th style="border:1px solid black">TIN NUMBER</th>
            <th style="border:1px solid black">SUPPLIERS</th>
            <th style="border:1px solid black">OTHERS</th>
            <th style="border:1px solid black">GROSS AMOUNT</th>
            <th style="border:1px solid black">NET OF VAT</th>
            <th style="border:1px solid black">INPUT VAT</th>
            <th style="border:1px solid black">EWT</th>
            <th style="border:1px solid black">AMOUNT DUE</th>
            <th style="border:1px solid black">PARTICULAR</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($data as $item)
       <tr>
            <th style="border:1px solid black">{{ date("m/d/Y",strtotime($item->cvdate)) }}</th>
            <th style="border:1px solid black">{{ $item->cvno }}</th>
            <th style="border:1px solid black">{{ $item->checkno }}</th>
            <th style="border:1px solid black">{{ $item->bp_master_data->tin }}</th>
            <th style="border:1px solid black">{{ $item->bp_master_data->name ?? ''}}</th>
            <th style="border:1px solid black">{{ $item->payment_others }}</th>
            <th style="border:1px solid black">{{ number_format($item->amount,2) }}</th>
            <th style="border:1px solid black">{{ number_format($item->cashvoucher_detail[0]->amount,2) ?? '' }}</th>
            <th style="border:1px solid black">{{ number_format($item->cashvoucher_detail[0]->inputVat,2) ?? '' }}</th>
            <th style="border:1px solid black">{{ number_format($item->cashvoucher_detail[0]->ewTax,2) ?? '' }}</th>
            <th style="border:1px solid black">{{ number_format($item->amount,2) }}</th>
            <th style="border:1px solid black">{{ $item->particulars }}</th>
        </tr>
       @if (count($item->cashvoucher_detail)!=1)
        @foreach ($item->cashvoucher_detail as $key => $val)
        <tr>
            <th style="border:1px solid black">{{ date("m/d/Y",strtotime($item->cvdate)) }}</th>
            <th style="border:1px solid black"></th>
            <th style="border:1px solid black"></th>
            <th style="border:1px solid black">{{ $item->bp_master_data->tin }}</th>
            <th style="border:1px solid black">{{ $item->bp_master_data->name ?? ''}}</th>
            <th style="border:1px solid black">{{ $item->payment_others }}</th>
            <th style="border:1px solid black">{{ number_format($val->amount,2) }}</th>
            <th style="border:1px solid black">{{ number_format($val->cashvoucher_detail[++$key]->amount,2) ?? '' }}</th>
            <th style="border:1px solid black">{{ number_format($val->cashvoucher_detail[++$key]->inputVat,2) ?? '' }}</th>
            <th style="border:1px solid black">{{ number_format($val->cashvoucher_detail[++$key]->ewTax,2) ?? '' }}</th>
            <th style="border:1px solid black">{{ number_format($val->amount,2) }}</th>
            <th style="border:1px solid black">{{ $item->particulars }}</th>
        </tr>
        @endforeach
       @endif
       @endforeach
    </tbody>
</table>