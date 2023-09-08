@extends('../layout/app')
@section('content')
<div class="card">
    <div class="card-header p-1 pl-2">
        <small>Business Partner Master Data</small>
    </div>
    <div class="card-body" style="font-size: 13px">
        <div class="row">
            <div class="col-4">
                <small><i class="fas fa-flag h-6"></i>A business partner is a commercial entity with which another commercial entity has some form of alliance. This relationship may be a contractual,</small>
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                    </div>
                @endif
                <form id="form" class="mt-3" action="{{ route('authenticated.bp_master.store') }}" method="POST" autocomplete="off">@csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                      <label for="exampleInputEmail1">BP Code</label>
                      <input type="text" class="form-control form-control-sm" name="code" max="15" readonly value="{{ $code }}">
                      <small id="emailHelp" class="form-text text-muted">Unique account code</small>
                      @error('code')
                      <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                   <div class="form-row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="exampleInputPassword1" maxlength="100">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">TIN</label>
                            <input type="text" class="form-control form-control-sm" name="tin" id="exampleInputPassword1" maxlength="20">
                            @error('tin')
                            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                   </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Address</label>
                        <textarea name="address" class="form-control" id="" cols="30" rows="2" style="font-size: 13px"></textarea>
                        @error('address')
                          <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
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
                            <th>Name</th>
                            <th>TIN</th>
                            <th>Address</th>
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
    const list      = @json($bplist);
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
            { data:'tin' },
            { data:'address' },
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
            form.find('textarea[name='+val+']').val(data[val])
        });
        form.find('input[name=isActive]').prop('checked',!data.isActive)
    })
</script>
@endsection