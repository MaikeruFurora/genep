<!-- Modal -->
<form action="{{ route('authenticated.voucher.download.summary') }}" id="modalForm" method="GET" target="_blank" autocomplete="off">
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header py-1">
              <p class="modal-title" id="staticBackdropLabel">Filter</p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="one">Branch</label>
                    <select name="branch" id="" class="custom-select" required>
                        <option value="">Select Option</option>
                        @foreach ($branchList as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dateFrom">Date From</label>
                    <input type="text" class="form-control datepicker" name="from" id="dateFrom" required>
                </div>
                <div class="form-group">
                    <label for="dateTo">Date To</label>
                    <input type="text" class="form-control datepicker" name="to" id="dateTo" required>
                </div>
            </div>
            <div class="modal-footer py-0">
              <button type="button" style="font-size: 11px" class="btn btn-sm py-1 btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" style="font-size: 11px" class="btn btn-sm py-1 btn-primary" >Submit</button>
            </div>
          </div>
        </div>
    </div>
</form>