@extends('../layout/app')
@section('content')
<div class="row">
    <div class="col-md-4 offset-md-4">
        @if (session()->has('msg'))
            <div class="alert alert-{{ session()->get('action') ?? 'success' }} mt-3" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header p-1">
                Branch
            </div>
            <div class="card-body">
               <form action="{{ route("authenticated.branch.store") }}" method="POST" autocomplete="off">@csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control form-control-sm" name="name">
                        <input type="hidden" name="company" value="{{ $company->id }}">
                    </div>
                    <button class="btn btn-sm btn-secondary">Submit</button>
                    <a href="{{ route("authenticated.company") }}" class="btn btn-sm btn-warning">Cancel</a>
               </form>
            </div>
        </div>
    </div>
  </div>
@endsection
 