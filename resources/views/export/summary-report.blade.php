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
            <th>INPUT VAT</th>
            <th>EWT</th>
            <th>AMOUNT DUE</th>
            <th>PARTICULAR</th>
        </tr>
    </thead>
    <tbody>
       @foreach ($data as $item)
       <tr>
            <th>{{ $item->cvdate }}</th>
            <th>{{ $item->cvno }}</th>
            <th>{{ $item->checkno }}</th>
            <th>{{ $item->tin }}</th>
            <th>{{ $item->bp_master_data->name ?? ''}}</th>
            <th>{{ $item->payment_others }}</th>
            <th>{{ $item->amount }}</th>
            @foreach ($item->cashvoucher_detail as $val)
                @if ($val->chart_account->name=='Input Vat')
                    <th>{{ $val->amount }}</th>
                @else
                    <th></th>
                @endif
                
                @if ($val->chart_account->name=='EWT')
                    <th>{{ $val->amount }}</th>
                @else
                    <th></th>
                @endif
            @endforeach
            <th>{{ $item->amount }}</th>
            <th>{{ $item->particulars }}</th>
        </tr>
       @endforeach
    </tbody>
</table>