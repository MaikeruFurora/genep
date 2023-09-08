@extends('../layout/app')
@section('content')
<div class="card">
    <div class="card-header p-1 pl-2">
        <small>Chart of Accounts</small>
    </div>
    <div class="card-body" style="font-size: 13px">
        <div class="row">
            <div class="col-4">
                <small><i class="fas fa-flag h-6"></i> A chart of accounts is a list of financial accounts set up, usually by an accountant, for an organization, and available for use by the bookkeeper for recording transactions in the organization's general ledger.</small>
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('action') ?? 'success' }} mt-3" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                    </div>
                @endif
                <form id="form" class="mt-3" action="{{ route('authenticated.chartAccount.store') }}" method="POST" autocomplete="off">@csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Account Code</label>
                      <input type="text" class="form-control form-control-sm" name="code" max="15" readonly value="{{ $code }}">
                      <small id="emailHelp" class="form-text text-muted">Unique account code</small>
                      @error('code')
                      <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Account Title</label>
                      <input type="text" class="form-control form-control-sm" name="name" id="exampleInputPassword1" maxlength="20">
                      @error('name')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="isActive">
                      <label class="form-check-label" for="exampleCheck1">Disable Account</label>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                    <button type="button" class="btn btn-warning btn-sm">Cancel</button>
                </form>
            </div>
            <div class="col-8">
                <table id="datatable" class="table table-bordered st-table table-hover dt-responsive nowrap adjust"  style="width: 100%">
                    <thead>
                        <tr>
                            <th width="3%"></th>
                            <th width="3%">@</th>
                            <th>Code</th>
                            <th>Account title</th>
                            <th>Status</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('moreJS')
    <script>
        const list      = @json($accounts);
        const form      = $("#form")
        let btnCancel   = $(".btn-warning").on('click',function(){
            window.location.reload();
        })
        const tableList = Config.tbl.DataTable({
            data:list,
            fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData.isActive != 1) {
                    $('td', nRow).css('background-color', '#ffbaba','color','white');
                }
            },
            columns:[
                { 
                    data:null,
                    render: function (data, type, row, meta) {
                        return `<span class=""> ${(meta.row + meta.settings._iDisplayStart + 1)}</span>`;
                    }
                },
                { 
                    data:null,
                    "orderable": false,
                    render: function (data, type, row, meta) {
                        return `<i class="fas fa-pencil-alt text-secondary"></i>`;
                    }
                },
                { data:'code' },
                { data:'name' },
                {
                    data:null,
                    render:function(data){
                        return data.isActive?'Active':'Disabled'
                    }
                },
                {
                    data:'isActive',
                    render:function(data){
                        return moment(data.created_at).format('MM/DD/YYYY');
                    }
                },
            ]
        })

        $(document).on('click','.fa-pencil-alt',function(){
            let data = tableList.row($(this).closest('tr')).data();
            Object.keys(data).forEach(val => {
                form.find('input[name='+val+']').val(data[val])
            });
            form.find('input[name=isActive]').prop('checked',!data.isActive)
            
        })
    </script>
@endsection