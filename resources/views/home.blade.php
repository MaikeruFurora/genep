@extends('../layout/app')
@section('content')

<div class="card">
    <div class="card-header p-1 pl-2">
        <small>Request Voucher</small>
        <div class="float-right">
            <button class="btn btn-sm btn-secondary py-1" style="font-size: 11px"><i class="fas fa-calendar-alt pr-1"></i> Date Range (Filter)</button>
            <a target="_blank" href="{{ route("authenticated.home.download.summary") }}" class="btn btn-sm btn-secondary py-1" style="font-size: 11px"><i class="fas fa-download pr-1"></i> Download Summary</a>
        </div>
    </div>
    <div class="card-body border" style="font-size: 13px">
        <div class="row">
            {{-- <div class="col-4">
                <small><i class="fas fa-flag h-6"></i> A cash voucher is a standard form used to document a petty cash payment. When someone wants to withdraw cash from the petty cash fund, that person fills out the cash voucher to indicate the reason for the withdrawal, and receives cash from the petty cash custodian in exchange.</small>
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                    </div>
                @endif
                <form id="form" class="mt-3" action="{{ route('authenticated.home.store') }}" method="POST" autocomplete="off">@csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="exampleInputPassword1"><sup class="text-danger">*</sup> Journal Memo</label>
                        <textarea name="journal_memo" class="form-control" id="" cols="30" rows="2" style="font-size: 13px"></textarea>
                        @error('address')
                          <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><sup class="text-danger">*</sup> Business Partner</label>
                      <select name="bp_master_data" id="" class="custom-select custom-select-sm select2">
                            <option></option>
                            @foreach ($bpMasterList as $item)
                                <option value="{{ $item }}">{{ $item->name }}</option>
                            @endforeach
                      </select>
                      @error('name')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><sup class="text-danger">*</sup>Company</label>
                        <select name="company" id="" class="custom-select custom-select-sm select2">
                            <option></option>
                            @foreach ($companyList as $item)
                                <option value="{{ $item }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('company')
                          <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                      </div>
                    <div class="card">
                        <div class="card-header  p-1 pl-2">
                            <sup class="text-danger">*</sup> Particulars
                        </div>
                        <div class="card-body p-3">
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <select name="chartofAccount" id="" class="custom-select custom-select-sm select2">
                                        <option></option>
                                        @foreach ($chartofAccountList as $item)
                                            <option value="{{ $item }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col mb-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="amount" placeholder="Amount">
                                        <div class="input-group-append">
                                          <button class="btn btn-secondary px-3" type="button" id="btnAdd"><i class="fas fa-share-square"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table mt-2 table-bordered adjust mb-0" id="datatbl">
                               <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">No data available in table</td>
                                    </tr>
                               </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                    <div class="form-group mt-3 mb-0">
                            <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                            <button type="reset" class="btn btn-warning btn-sm" onClick="window.location.href=window.location.href">Cancel</button>
                    </div>
                </form>
            </div> --}}
            <div class="col-5">
                <small>Petty cash is a small amount of discretionary funds in the form of cash used for expenditures where it is not sensible to make any disbursement by cheque, because of the inconvenience and costs of writing, signing, and then cashing the cheque</small>
                <form id="form" class="mt-3" action="{{ route('authenticated.home.store') }}" method="POST" autocomplete="off">@csrf
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-lg-4 col-sm-12 col-form-label">Payment to: </label>
                                <div class="col-lg-8 col-sm-12">
                                    <select name="bp_master_data" id="" class="custom-select custom-select-sm select2">
                                        <option></option>
                                        @foreach ($bpMasterList as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bp_master_data')
                                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-sm-12 col-form-label"></label>
                                <div class="col-lg-8 col-sm-12">
                                <input type="text" class="form-control"  name="payment_others" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-sm-12 col-form-label">Bank</label>
                                <div class="col-lg-8 col-sm-12">
                                <input type="text" class="form-control"  name="bank">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-sm-12 col-form-label">Check No.</label>
                                <div class="col-lg-8 col-sm-12">
                                <input type="text" class="form-control"  name="checkno">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-sm-12 col-form-label">CV No.</label>
                                <div class="col-lg-8 col-sm-12">
                                <input type="number" class="form-control" required name="cvno">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-sm-12 col-form-label">CV Date:</label>
                                <div class="col-lg-8 col-sm-12">
                                <input type="search" class="form-control datepicker" required name="cvdate">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-sm-12 col-form-label">Store:</label>
                                <div class="col-lg-8 col-sm-12">
                                <select name="branch" id="" class="custom-select custom-select-sm select2" required>
                                    <option></option>
                                    @foreach ($branchList as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table text-center table-bordered">
                        <tr>
                            <td width="50%">PARTICULARS</td>
                            <td>AMOUNT</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px">
                                <textarea name="particulars"  style="margin: 0px" class="form-control " id="" cols="10" rows="4"></textarea>
                            </td>
                            <td style="padding: 0px">
                                <textarea readonly name="amount"  style="margin: 0px" class="form-control amount-format" id="displayAmount" cols="10" rows="4"></textarea>
                            </td>
                        </tr>
                    </table>
                    <table class="table mt-2 table-bordered mb-0" id="datatbl">
                    <thead>
                            <tr>
                                <td>Account Title</td>
                                <td>Debit</td>
                                <td>Credit</td>
                                <td width="5%"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                    <select name="chartofAccount" id="" class="custom-select custom-select-sm select2">
                                        <option></option>
                                        @foreach ($chartofAccountList as $item)
                                            <option value="{{ $item }}" id="{{ $item->cnt }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control amount-format" name="_debit" placeholder="">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control amount-format" name="_credit" placeholder="">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-secondary px-3" type="button" id="btnAdd"><i class="fas fa-plus-circle"></i></button>
                                </td>
                            </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">No data available in table</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group mt-3 mb-0">
                        <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                        <button type="reset" class="btn btn-warning btn-sm" onClick="window.location.href=window.location.href">Cancel</button>
                    </div>
               </form>
            </div>
            <div class="col-7">
                <table 
                id="datatable" 
                class="table table-bordered st-table dt-responsive nowrap adjust"
                style="width: 100%;font-size:10px"
                data-print="{{ route("authenticated.home.print",":cv") }}">
                    <thead>
                        <tr>
                            <td rowspan="2" width="5%">#</td>
                            <td rowspan="2">Print</td>
                            <td class="border">Store</td> 
                            <td class="border" rowspan="2">CVNO</td>
                            <td rowspan="2">CV Date</td>
                            <td rowspan="2" width="20%">Particulars</td>
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
    </div>
</div>
@endsection
@section('moreJS')
    <!-- Datepicker -->
    <script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-number/jquery.number.js') }}"></script>
    <script>
        $('.amount-format').number( true, 4 );
        let chartofAccount    = $('select[name=chartofAccount]')
        let debit             = $('input[name=_debit]').on('focus',function(){
                                    credit.prop('disabled', true);
                                }).on("focusout",function(){
                                    credit.prop('disabled', false);

                                })
        let credit            = $('input[name=_credit]').on('focus',function(){
                                    debit.prop('disabled', true);
                                }).on("focusout",function(){
                                    debit.prop('disabled', false);
                                })
                                $('.datepicker').datepicker({
                                    language: "es",
                                    autoclose: true,
                                    format: "mm/dd/yyyy"
                                });

        const cashVoucherList = @json($cashVoucherList);
        const datatbl         = $("#datatbl")
        const array           = []
        Config.tbl.DataTable({
            ordering: false,
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
                { data:'branch.name' },
                { data:'cvno'},
                { 
                    orderable: false,
                    data:null,
                    render:function(data){
                        return moment(data.cvdate).format('MM/DD/YYYY');
                    }
                },
                { data:'particulars',
                    // render: function (data, type, full, meta) {
                    //     return "<div class='text-wrap width-500' style='font-size:12px'>" + data.particulars + "</div>";
                    // },
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
        
        $('.select2').select2({
            // closeOnSelect: false
            allowClear: true,
            placeholder: "Select data",
        }).trigger('change'); 

        $("#btnAdd").on('click',function(){
            //add data value to array
            console.log(array.find((val) => val.id === JSON.parse(chartofAccount.val()).id));
            // if (!array.find((val) => val.id == JSON.parse(chartofAccount.val()).id)) {
                array.push({
                    'id'      : JSON.parse(chartofAccount.val()).id,
                    'account' : JSON.parse(chartofAccount.val()),
                    'cnt'     : JSON.parse(chartofAccount.val()).cnt,
                    // 'amount'  : (debit.val()=="")?credit.val():debit.val(),
                    'debit'   : debit.val(),
                    'credit'  : credit.val()
                })
                 //pass value data
                tblData(array)

            // }else{
            //     alertify.alert("Already exists")
            // }
           
            //clear value
            chartofAccount.val(null).trigger("change");
            debit.val('').prop('disabled',false)
            credit.val('').prop('disabled',false)
        })

        const tblData = (array) =>{
            let hold=''
            if (array.length>0) {
                // let totalAmnt =  array.reduce((total,val)=>total+=parseFloat(val.amount),0)
                array.forEach((element,i) => {
                hold+=`<tr>
                        <td>
                            ${element.account.name}
                        </td>
                        <td>
                            ${element.debit!=""?$.number(element.debit,4):""}
                            <input type="hidden" name="debit[]" value="${identify(element.cnt,element.debit)+element.debit}">
                        </td>
                        <td>
                            ${element.credit!=""?$.number(element.credit,4):""}
                            <input type="hidden" name="credit[]" value="${identify(element.cnt,element.credit)+element.credit}">
                        </td>
                        <td>
                                <input type="hidden" name="account[]" value="${element.account.id}">
                            <i id="${i}" class="fas fa-times-circle text-danger" style="font-size:15px"></i>
                        </td>
                    </tr>`
                });


                    console.log(array);
                const amount = array.find(val=>{
                    return val.cnt==1;
                })

                if (amount) {
                    console.log(amount.credit);
                    $("#displayAmount").val(amount.credit).number(true,4)
                }

                // hold+=`
                // <tr>
                //     <td>Total</td>
                //     <td></td>
                //     <td>&#8369 ${totalAmnt}</td>
                // </tr>
                // `
                // $("#displayAmount").val(totalAmnt)
            }else{
                hold=` <tr><td colspan="5" class="text-center">No data available in table</td></tr>`
            }
            datatbl.find("tbody").html(hold)
        }

        $(document).on('click','.fa-times-circle',function(){
            alertify.confirm('Are you sure you want to remove this row?', function(){
                array.splice($(this).attr("id"),1)
                tblData(array)
            },function(){
                alertify.error('Cancelled');
            })

           
        })

        const identify=(bol,amount)=>{
           return (bol=="0")?(amount!=""?"-":""):""
        }

        $(document).on("click",".btn-default",function(){
            Config.loadToPrint(Config.tbl.attr("data-print").replace(":cv",$(this).val()))
        })
        

    </script>
@endsection