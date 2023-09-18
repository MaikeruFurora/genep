@extends('../layout/app')
@section('content')

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
@include('modal.modal-report-filter',['branchList'=>$branchList])
@endsection
@section('moreJS')
    <!-- Datepicker -->
    <script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-number/jquery.number.js') }}"></script>
    <script>
        $('.amount-format').number( true, 4 );
        
          let modalForm       = $("#modalForm")
          let datatbl         = $("#datatbl")
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
        Config.tbl.DataTable({
            // ordering: false,
            data:cashVoucherList,
            // fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //     if (aData.isActive != 1) {
            //         $('td', nRow).css('background-color', '#ffbaba','color','white');
            //     }
            // },
            initComplete: function () {
                this.api()
                    .columns([2])
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
                { data:'checkno'},
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
            Config.loadToPrint(Config.tbl.attr("data-print").replace(":cv",$(this).val()))
        })

        modalForm.on('submit',function(){
            setTimeout(() => {
                $(this)[0].reset()
            }, 2000);
        })
    </script>
@endsection