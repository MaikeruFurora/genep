@extends('../layout/app')
@section('content')
<div class="card">
    <div class="card-header p-1 pl-2">
        <small>Company</small>
    </div>
    <div class="card-body" style="font-size: 13px">
        <div class="row">
            <div class="col-4">
                <small><i class="fas fa-flag h-6"></i> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam cupiditate, consequatur, reprehenderit similique nam saepe aspernatur impedit unde dolor quam odit doloribus soluta! Animi, vel? Saepe suscipit nostrum illo dolores..</small>
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('action') ?? 'success' }} mt-3" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                    </div>
                @endif
                <form id="form" class="mt-3" action="{{ route('authenticated.company.store') }}" method="POST" autocomplete="off">@csrf
                    <input type="hidden" name="id">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Company Code</label>
                      <input type="text" class="form-control form-control-sm" name="code" max="15" readonly value="{{ $code }}">
                      <small id="emailHelp" class="form-text text-muted">Unique account code</small>
                      @error('code')
                      <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Acronym</label>
                      <input type="text" class="form-control form-control-sm" name="acronym" id="exampleInputPassword1" maxlength="20">
                      @error('name')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Company Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" id="exampleInputPassword1" maxlength="20">
                        @error('name')
                          <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Start of CV Number</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">CV</span>
                            </div>
                            <input type="number" class="form-control" name="cvnumber_start">
                        </div>
                        @error('cvnumber_start')
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
                            <th width="3%">@</th>
                            <th>Code</th>
                            <th>Acronym</th>
                            <th>Company Name</th>
                            <th>CV</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Branch</th>
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
    const list      = @json($companies);
    const form      = $("#form")
    let   branch    = '{{ route("authenticated.branch",":company") }}';
    let btnCancel   = $(".btn-warning").on('click',function(){
        window.location.reload();
    })
    const tableList = Config.tbl.DataTable({
        orderable:false,
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
                render: function (data, type, row, meta) {
                    return `<a href="${branch.replace(":company",data.id)}">Branch</a>`
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
            { data:'acronym' },
            { data:'name' },
            { data:'cvnumber_start' },
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
            { 
                    data:null,
                    render:function(data){
                    let hold=`<table class="table adjust border table-hover" width="100%">`
                        // <tr>
                        //     <td>#</td>
                        //     <td>Particular</td>
                        //     <td>Amount</td>
                        // </tr>
                        data.branch.forEach((item,i)=>{
                            hold+=` <tr>
                                        <td>${++i}</td>
                                        <td>${item.name}</td>
                                    </tr>`
                        })
                        hold+=`</table>`
                        return hold
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