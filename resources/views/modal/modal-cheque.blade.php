<form id="ChequeForm">
  <div class="modal fade" id="modalCheque" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header p-1">
            <p class="modal-title"></p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id">
           <select name="type" id="" class="custom-select custom-select-sm">
            <option value="bdo">BDO Check</option>
            <option value="ub">UB Check</option>
           </select>
          </div>
          <div class="modal-footer p-0">
            <button type="submit" class="btn btn-block btn-sm btn-primary">Print</button>
          </div>
        </div>
      </div>
  </div>
</form>