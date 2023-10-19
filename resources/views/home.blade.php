@extends('../layout/app')
@section('content')

<div class="card">
    <div class="card-header p-1 pl-2">
        <small>Request Voucher</small>
        <div class="float-right">
            <a href="{{ route('authenticated.voucher') }}" class="btn btn-sm btn-outline-secondary py-1" style="font-size: 11px"><i class="far fa-list-alt"></i> Voucher List</a>
        </div>
    </div>
    <div class="card-body border" style="font-size: 13px">
        <div class="row">
           
            <div class="col-12">
                <small>Petty cash is a small amount of discretionary funds in the form of cash used for expenditures where it is not sensible to make any disbursement by cheque, because of the inconvenience and costs of writing, signing, and then cashing the cheque</small>
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('action') ?? 'success' }} mt-3" role="alert"
                        data-voucher="{{ route("authenticated.voucher.print",":cv") }}"
                        data-cheque="{{ route("authenticated.cheque.print",":cv") }}"
                        >
                        <i class="fas fa-check-circle"></i> {{ session()->get('msg') }}
                    </div>
                @endif
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
                                <textarea name="particulars"  style="margin: 0px" class="form-control " id="" cols="10" rows="3"></textarea>
                            </td>
                            <td style="padding: 0px">
                                <textarea readonly name="amount"  style="margin: 0px" class="form-control amount-format" id="displayAmount" cols="10" rows="3"></textarea>
                            </td>
                        </tr>
                    </table>
                    <table class="table mt-2 table-bordered mb-0">
                            <tr>
                                <td>Account Title</td>
                                <td>NET AMOUNT</td>
                                <td>GROSS AMOUNT</td>
                                <td>TAX CODE</td>
                                <td>INPUT VAT</td>
                                <td>EWT</td>
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
                                        <input type="text" class="form-control amount-format" name="netAmount" placeholder="" value="0">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control amount-format" name="grossAmount" placeholder="" value="0">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <select name="tax" id="" class="form-control form-contrl-sm">
                                            <option value="E">EXEMPT</option>
                                            <option value="V">VATABLE</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control amount-format" name="inputVat" placeholder="" readonly value="0">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <select name="ewTaxPercent" id="" class="custom-select">
                                            <option value="0.00">Not Applicable</option>
                                            <option value="0.50">0.50</option>
                                            <option value="1.00">1.00</option>
                                            <option value="2.00">2.00</option>
                                            <option value="5.00">5.00</option>
                                            <option value="10.00">10.00</option>
                                            <option value="15.00">15.00</option>
                                        </select>    
                                        <input type="text" name="ewTax" placeholder="With Holding Tax" class="form-control amount-format" value="0">
                                      </div>
                                </td>
                                <td>
                                    <button class="btn btn-secondary px-3" type="button" id="btnAdd"><i class="fas fa-plus-circle"></i></button>
                                </td>
                            </tr>
                    </table>
                    <table class="table mt-2 table-bordered mb-0" id="datatbl">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>ACCOUNT</th>
                                <th>DEBIT</th>
                                <th>CREDIT</th>
                                <th width="2%">@</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">No data available in table</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group mt-3 mb-0">
                        <button type="submit" class="btn btn-secondary btn-sm" disabled>Submit</button>
                        <button type="reset" class="btn btn-warning btn-sm" onClick="window.location.href=window.location.href">Cancel</button>
                    </div>
               </form>
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
        $('.amount-format').number( true, 2 );
        let printValue      = "{{ session()->get('id') ?? '' }}"
        let checkno         = "{{ session()->get('checkno') ?? '' }}"
        let chartofAccount  = $('select[name=chartofAccount]')
        let grossAmount     = $('input[name=grossAmount]')
        let netAmount       = $('input[name=netAmount]')
        let inputVat        = $('input[name=inputVat]')
        let tax             = $('select[name=tax]')
        let ewTaxPercent    = $('select[name=ewTaxPercent]')
        let ewTax           = $('input[name=ewTax]')
                                $('.datepicker').datepicker({
                                    language: "es",
                                    autoclose: true,
                                    format: "mm/dd/yyyy"
                                });
        let datatbl         = $("#datatbl")
      const array           = []
        
        window.onload = () =>{

            if (printValue!="") {
                if (checkno) {
                    window.open(Config.printCheque.replace(":cv",printValue), '_blank');
                }
                window.open(Config.prinVoucher.replace(":cv",printValue), '_blank');
            }

        }

        $('.select2').select2({
            // closeOnSelect: false
            allowClear: true,
            placeholder: "Select data",
        }).trigger('change'); 

        grossAmount.on('input',function(){
           if (tax.val()=="E") {
                netAmount.val($(this).val())
           }else{
               netAmount.val($(this).val()/1.12)
               inputVat.val(grossAmount.val()/1.12*0.12)
           }
        })
        netAmount.on('input',function(){
            (tax.val()=="E") ? grossAmount.val($(this).val()) : grossAmount.val($(this).val()*1.12)
        })

        tax.on('change',function(){
            if($(this).val()=="E") {
                grossAmount.val()
                netAmount.val(grossAmount.val())
                inputVat.val(null)
            }else{
                grossAmount.val(netAmount.val()*1.12)
                inputVat.val(netAmount.val()*0.12)
            } 
        })
        ewTaxPercent.on('change',function(){
            ewTax.val(netAmount.val()*($(this).val()/100))
        })

        $("#btnAdd").on('click',function(){
            
            console.log(chartofAccount.val());
            // console.log(array.find((val) => val.id === JSON.parse(chartofAccount.val()).id));
            // if (!array.find((val) => val.id == JSON.parse(chartofAccount.val()).id)) {}
                array.push({
                    'id'          : JSON.parse(chartofAccount.val()).id,
                    'account'     : JSON.parse(chartofAccount.val()).name,
                    'grossAmount' : grossAmount.val(),
                    'netAmount'   : netAmount.val(),
                    'inputVat'    : inputVat.val(),
                    'ewTaxPercent': ewTaxPercent.val(),
                    'ewTax'       : ewTax.val()
                })
            // }
            //pass value data

            $('button[type="submit"]').attr("disabled",(!array.length>0))
            console.log(array);

            tblData(array)
            chartofAccount.val(null).trigger("change");
            netAmount.val(null)
            grossAmount.val(null)
            inputVat.val(null)
            ewTax.val(null)
            tax.prop("selectedIndex", 0);
            ewTaxPercent.prop("selectedIndex", 0);
        })

        const tblData = (array) =>{
            let hold=''
            if (array.length>0) {
                // let totalAmnt =  array.reduce((total,val)=>total+=parseFloat(val.amount),0)
                array.forEach((element,i) => {
                hold+=`<tr>
                        <td>${element.account}</td>
                        <td class="debit">
                            ${$.number(element.netAmount,2)}
                            <input type="hidden" name="chartAccount[]" value="${element.id}">
                            <input type="hidden" name="netAmount[]" value="${element.netAmount}">
                            <input type="hidden" name="inputVat[]" value="${element.inputVat}">
                            <input type="hidden" name="ewTax[]" value="${element.ewTax}">
                            <input type="hidden" name="ewTaxPercent[]" value="${element.ewTaxPercent}">
                        </td>
                        <td class="credit"></td>
                        <td>
                            <i id="${i}" class="fas fa-times-circle text-danger" style="font-size:15px"></i>
                        </td>
                    </tr>`
                    if (element.inputVat!="" && element.inputVat!=0) {
                        hold+=`<tr>
                                    <td>Input Vat</td>
                                    <td class="debit">${$.number(element.inputVat,2)}</td>
                                    <td class="credit"></td>
                                </tr>`;
                    }
                    if (element.ewTax!="" && element.ewTax!=0) {
                        hold+=`<tr>
                                <td>EwTAX</td>
                                <td class="debit"></td>
                                <td class="credit">${$.number(element.ewTax,2)}</td>
                            </tr>`;
                    }
                });


                // let totalGross  = array.reduce(function(total,val){
                //     return total+=parseFloat(val.grossAmount)
                // },0)

                let totalNetAndInput  = array.reduce(function(total,val){
                    return total+=parseFloat(val.netAmount)
                },0) + array.reduce(function(total,val){
                    return total+=parseFloat(val.inputVat)
                },0)

                let totalEwTax  = array.reduce(function(total,val){
                    return total+=parseFloat(val.ewTax)
                },0)

                let  ttal =  totalNetAndInput-totalEwTax


                console.log(totalNetAndInput);
                console.log(totalEwTax);

                hold+=`<tr>
                            <td></td>
                            <td></td>
                            <td>${$.number((ttal),2)}</td>
                        </tr>`
                $("#displayAmount").val($.number((ttal),2))
            }else{
                hold=` <tr><td colspan="5" class="text-center">No data available in table</td></tr>`
            }
            datatbl.find("tbody").html(hold)
        }

        $(document).on('click','.fa-times-circle',function(){
            alertify.confirm('Are you sure you want to remove this row?', function(){
                array.splice($(this).attr("id"),1)
                if (array.length==0) { 
                    $("#displayAmount").val('') 
                    $('button[type="submit"]').attr("disabled",true)
                }
                tblData(array)
            },function(){
                alertify.error('Cancelled');
            })
        })

        
        

    </script>
@endsection