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
            <th>DATE</th>
            <th>CV#</th>
            <th>CHEQUE NUMBER</th>
            <th>TIN NUMBER</th>
            <th>SUPPLIERS</th>
            <th>OTHERS</th>
            <th>GROSS AMOUNT</th>
            <th>NET OF VAT</th>
            <th>INPUT VAT</th>
            <th>EWT</th>
            <th>AMOUNT DUE</th>
            <th>PARTICULAR</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($data as $item)
       <tr>
            <th>{{ date("m/d/Y",strtotime($item->cvdate)) }}</th>
            <th>{{ $item->cvno }}</th>
            <th>{{ $item->checkno }}</th>
            <th>{{ $item->bp_master_data->tin }}</th>
            <th>{{ $item->bp_master_data->name ?? ''}}</th>
            <th>{{ $item->payment_others }}</th>
            <th>{{ number_format($item->amount,2) }}</th>
            <th>{{ $item->cashvoucher_detail[0]->amount ?? '' }}</th>
            <th>{{ $item->cashvoucher_detail[0]->inputVat ?? '' }}</th>
            <th>{{ $item->cashvoucher_detail[0]->ewTax ?? '' }}</th>
            <th>{{ number_format($item->amount,2) }}</th>
            <th>{{ $item->particulars }}</th>
        </tr>
       @if (count($item->cashvoucher_detail)!=1)
        @foreach ($item->cashvoucher_detail as $key => $val)
        <tr>
            <th>{{ date("m/d/Y",strtotime($item->cvdate)) }}</th>
            <th></th>
            <th></th>
            <th>{{ $item->bp_master_data->tin }}</th>
            <th>{{ $item->bp_master_data->name ?? ''}}</th>
            <th>{{ $item->payment_others }}</th>
            <th>{{ number_format($val->amount,2) }}</th>
            <th>{{ $val->cashvoucher_detail[++$key]->amount ?? '' }}</th>
            <th>{{ $val->cashvoucher_detail[++$key]->inputVat ?? '' }}</th>
            <th>{{ $val->cashvoucher_detail[++$key]->ewTax ?? '' }}</th>
            <th>{{ number_format($val->amount,2) }}</th>
            <th>{{ $item->particulars }}</th>
        </tr>
        @endforeach
       @endif
       @endforeach
    </tbody>
</table>