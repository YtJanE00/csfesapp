@extends('layout.master_layout')


@section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Signatories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Signatories</li>
                    </ol>
                </div>
             </div>
         </div>
     </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success" style="font-size: 12pt;">
                            <i class="fas fa-check"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" style="font-size: 12pt;">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" class="btn btn-default text-light" data-toggle="modal" data-target="#modal-addsign" style="background-color: #04401f !important">
                                  Add New Signatories
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="signatoryTable"class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Office</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @php $no =1; @endphp
                                        @foreach($signatories as $datasignatories)

                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $datasignatories->fname }} {{ $datasignatories->lname }}</td>
                                            <td>{{ $datasignatories->role }}</td>
                                            <td>{{ $datasignatories->dept }}</td>
                                            <td>
                                            <a href="" class="btn btn-outline-success btn-sm" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form action="{{ route('signatories.destroy', $datasignatories->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSignModal" tabindex="-1" role="dialog" aria-labelledby="editSignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSignModalLabel">Edit Signatory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSignForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editSignId">
                    <div class="form-group">
                        <label for="editSignLname">Last name</label>
                        <input type="text" class="form-control" id="editSignLname" name="lname">
                    </div>
                    <div class="form-group">
                        <label for="editSignFname">First name</label>
                        <input type="text" class="form-control" id="editSignFname" name="fname">
                    </div>
                    <div class="form-group">
                        <label for="editSignMname">Middle name</label>
                        <input type="text" class="form-control" id="editSignMname" name="mname">
                    </div>
                    <div class="form-group">
                        <label for="editSignRole">Role</label>
                        <select class="form-control form-control-sm" name="role" id="editSignRole">
                            <option disabled selected>--Select--</option>
                            <option value="Dean">Dean</option>
                            <option value="Director, Extension and Community Services">Director, Extension and Community Services</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editSignRank">Rank</label>
                        <input type="text" class="form-control" id="editSignRank" name="rank">
                    </div>
                    <div class="form-group">
                        <label for="editSignCampus">Campus</label>
                        <select class="form-control form-control-sm" name="campus" id="editSignCampus">
                            <option disabled selected> --Select-- </option>
                            <option value="MC">Main</option>
                            <option value="VC">Victorias</option>
                            <option value="SCC">San Carlos</option>
                            <option value="HC">Hinigaran</option>
                            <option value="MP">Moises Padilla</option>
                            <option value="IC">Ilog</option>
                            <option value="CA">Candoni</option>
                            <option value="CC">Cauayan</option>
                            <option value="SC">Sipalay</option>
                            <option value="HinC">Hinobaan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('modals.modal-addsign')

<script>
    var signatoryReadRoute = "{{ route('getsignatoryRead') }}";
    var signatoryCreateRoute = "{{ route('signCreate') }}";
    var signatureUpdateRoute = "{{ route('signatureUpdate', ['id' => ':id']) }}";
    var signatureDeleteRoute = "{{ route('signatureDelete', ['id' => ':id']) }}";
</script>

@endsection