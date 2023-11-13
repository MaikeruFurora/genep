@extends('../layout/app')
@section('content')
<style>
    .select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
@if (session()->has('msg'))
<div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert"
    data-voucher="{{ route("authenticated.voucher.print",":cv") }}"
    data-cheque="{{ route("authenticated.cheque.print",[":cv",":type"]) }}"
    >
    <i class="fas fa-check-circle"></i> {{ session()->get('msg') }}
</div>
@endif
<div class="card">
    <div class="card-header p-1 pl-2">
        <small>Voucher List</small>
        <div class="float-right">
            <button 
             data-toggle="modal" data-target="#staticBackdrop"
             {{-- href="{{ route("authenticated.home.download.summary") }}" --}}
             class="btn btn-sm btn-outline-secondary py-1"
             name="btnDateRange"
             style="font-size: 11px"><i class="fas fa-download pr-1"></i> Date Range Report</button>
        </div>
    </div>
    <div class="card-body border pb-2" style="font-size: 13px">
        <table 
            id="datatable" 
            class="table table-bordered st-table dt-responsive nowrap adjust mb-0"
            style="width: 100%;font-size:10px"
            data-print="{{ route("authenticated.voucher.print",":cv") }}">
            <thead>
                <tr>
                    <td rowspan="2" width="1%">@</td>
                    <td rowspan="2" width="5%">#</td>
                    <td rowspan="2">Print</td>
                    <td class="border">Store</td> 
                    <td class="border" rowspan="2">CVNO</td>
                    <td rowspan="2">CV Date</td>
                    <td rowspan="2">Particulars</td>
                    <td rowspan="2">Amount</td>
                    <td rowspan="2">Payment to</td>
                    <td rowspan="2">Bank</td>
                    <td rowspan="2">Check No.</td>
                    <td rowspan="2">Account Title </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('modal.modal-voucher',['bpMasterList'=>$bpMasterList,'branchList'=>$branchList])
@include('modal.modal-cheque')
@include('modal.modal-report-filter',['branchList'=>$branchList])
@endsection
@section('moreJS')
    <!-- Datepicker -->
    <script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-number/jquery.number.js') }}"></script>
    <script>
        $('.amount-format').number( true, 4 );
        let VoucherForm       = $("#VoucherForm")
        let modalForm         = $("#modalForm")
        let datatbl           = $("#datatbl")
        const cashVoucherList = @json($cashVoucherList);
        const array           = []
        $('.datepicker').datepicker({
            language: "en",
            autoclose: true,
            format: "mm/dd/yyyy"
        });
        $("button[name=btnDateRange]").on('click',function(){
            modalForm[0].reset()
        })
        let voucherList = Config.tbl.DataTable({
            ordering: false,
            data:cashVoucherList,
            // fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //     if (aData.isActive != 1) {
            //         $('td', nRow).css('background-color', '#ffbaba','color','white');
            //     }
            // },
            initComplete: function () {
                this.api()
                    .columns([3])
                    .every(function () {
                        var column = this;
                        var select = $('<select class="custom-select custom-select-sm m-0" style="font-size:10px"><option value="">All</option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
            columns:[
                { 
                    data:null,
                    render: function (data, type, row, meta) {
                        return `<i class="fas fa-pen-square text-secondary" style="font-size:13px"></i>`;
                    }

                },
                { 
                    
                    data:'id',
                    render: function (data, type, row, meta) {
                        return (meta.row + meta.settings._iDisplayStart + 1);
                    }
                },
                { 
                    data:null,
                    render: function (data, type, row, meta) {
                        return `<button class="btn btn-sm btn-default text-center" value="${data.id}"><i class="fas fa-print"></i></button>`
                    }
                },
                { 
                    orderable: true,
                    data:'branch.name' 
                },
                { data:'cvno'},
                { 
                    orderable: false,
                    data:null,
                    render:function(data){
                        return moment(data.cvdate).format('MM/DD/YYYY');
                    }
                },
                { data:'particulars',
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-50' style='font-size:10px'>" + data + "</div>";
                    },
                },
                { data:null,
                    render:function(data){
                        return $.number(data.amount,4)
                    }
                },
                { 
                    data:null,
                    render:function(data){
                        return data.payment_others ?? data.bp_master_data.name
                    }
                },
                { data:'bank'},
                { 
                    data:null,
                    render:function(data){
                        return data.checkno!=null?`<button data-toggle="modal" data-target="#modalCheque" class="btn btn-link" style="font-size:11px" name="checkNo" value="${data.id}">${data.checkno}</button>`:''
                    }
                },
                { 
                    data:null,
                    render:function(data){
                    let hold=`<table class="table adjust border table-hover" width="100%">`
                        // <tr>
                        //     <td>#</td>
                        //     <td>Particular</td>
                        //     <td>Amount</td>
                        // </tr>
                        data.cashvoucher_detail.forEach((item,i)=>{
                            hold+=` <tr>
                                        <td>${++i}</td>
                                        <td>${item.chart_account.name}</td>
                                        <td>${$.number(Math.abs(item.amount),4)}</td>
                                    </tr>`
                        })
                        hold+=`</table>`
                        return hold
                    }
                },
             
            ]
        })
        
        $(document).on("click",".btn-default",function(){
            window.open(Config.prinVoucher.replace(":cv",$(this).val()),'_blank')
        })

        modalForm.on('submit',function(){
            setTimeout(() => {
                $(this)[0].reset()
            }, 2000);
        })
        
        $("button[name=checkNo]").on('click',function(){
            $("#ChequeForm").find("input[name=id]").val($(this).val())
        })
        $("#ChequeForm").find("button[type=submit]").on('click',function(e){
            e.preventDefault()
            window.open(Config.printCheque.replace(":cv",$("#ChequeForm").find("input[name=id]").val()).replace(":type",$("#ChequeForm").find("select[name=type]").val()), '_blank');
        })

        $(document).on('click','.fa-pen-square',function(){
            let data = voucherList.row($(this).closest('tr')).data()
            if ( $('.select2').find("option[value='" + data.bp_master_data.id+ "']").length) {
                $('.select2').val(data.bp_master_data.id).trigger('change');
            } 
            Object.keys(data).forEach(val => {
                VoucherForm.find('input[name='+val+']').val(data[val])
                VoucherForm.find('textarea[name='+val+']').val(data[val])
                if (VoucherForm.find('select[name='+val+']').find("option[value='" + data.bp_master_data.id+ "']").length) {
                    VoucherForm.find('select[name='+val+']').val(data.bp_master_data.id).trigger('change');
                } 
                if (VoucherForm.find('select[name='+val+']').find("option[value='" + data.branch.id+ "']").length) {
                    VoucherForm.find('select[name='+val+']').val(data.branch.id).trigger('change');
                } 
            });
            $("#modalVoucher").modal("show")
        })

        $('.select2').select2({
            // closeOnSelect: false
            allowClear: true,
            placeholder: "Select data",
        }).trigger('change'); 
    </script>
@endsection