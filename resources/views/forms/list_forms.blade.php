@extends('layout.master_layout')


@section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Forms</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Forms</li>
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
                                <button type="button" class="btn btn-default text-light" data-toggle="modal" data-target="#modal-addtrainingtitle" style="background-color: #04401f !important">
                                  Add New Title
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1"class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Training/Workshop Title</th>
                                            <th>Office</th>
                                            <th>Speaker</th>
                                            <th>Month</th>
                                            <th>Day</th>
                                            <th>Year</th>
                                            <th>Venue</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1; @endphp
                                        @foreach($form as $dataform)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $dataform->title }}</td>
                                                <td>{{ $dataform->office }}</td>
                                                <td>{{ $dataform->speaker }}</td>
                                                <td>{{ $dataform->training_month }}</td>
                                                <td>{{ $dataform->training_day }}</td>
                                                <td>{{ $dataform->training_year }}</td>
                                                <td>{{ $dataform->training_venue }}</td>
                                                <td>
                                                    <a href="{{ route('formQuestion', encrypt($dataform->id )) }}" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-pen"></i>
                                                    </a>

                                                    <button id="copyButton-{{ $dataform->id }}" class="btn btn-outline-info btn-sm" onclick="copyToClipboard('{{ $dataform->surveylink }}')">
                                                        <i class="fas fa-copy"></i>
                                                    </button>

                                                    <a href="{{ $dataform->surveylink }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                                                        <i class="fas fa-link"></i>
                                                    </a>

                                                    <a href="#" onclick="document.getElementById('delete-form-{{ $dataform->id }}').submit();" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $dataform->id }}" action="{{ route('formDelete', ['id' => $dataform->id]) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
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

@include('modals.modal-addtrainingTitle')

<script>
    function copyToClipboard(surveyLink) {
        var tempInput = document.createElement("input");
        tempInput.value = surveyLink;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        console.log('Survey link copied to clipboard!');
        Swal.fire({
            icon: 'success',
            title: 'Copied!',
            text: 'Survey link copied to clipboard!'
        });
    }
</script>

@endsection