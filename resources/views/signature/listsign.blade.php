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
                                <table id="example1"class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Office</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no =1; @endphp
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

                                            <form action="" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                        </tr>
                                        @endforeach
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

@include('modals.modal-addsign')
@endsection