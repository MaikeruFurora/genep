<form id="VoucherForm"  action="{{ route('authenticated.home.store') }}" method="POST" autocomplete="off">@csrf
    <div class="modal fade" id="modalVoucher" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-1">
                    <p class="modal-title">Update Details</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
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
                    <table class="table text-center table-bordered mb-1">
                        <tr>
                            <td width="50%">PARTICULARS</td>
                            <td>AMOUNT</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px">
                                <textarea name="particulars"  style="margin: 0px" class="form-control " id="" cols="10" rows="5"></textarea>
                            </td>
                            <td style="padding: 0px">
                                <textarea readonly name="amount"  style="margin: 0px" class="form-control amount-format" id="displayAmount" cols="10" rows="5"></textarea>
                            </td>
                        </tr>
                    </table>
                    
            </div>
            <div class="modal-footer p-0">
                <button type="button" style="font-size: 11px" class="btn btn-sm py-1 btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" style="font-size: 11px" class="btn btn-sm py-1 btn-primary" >Submit</button>
            </div>
          </div>
        </div>
    </div>
  </form>