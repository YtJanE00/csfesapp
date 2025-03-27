@extends('layout.master_layout')

@section('body')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Evaluation Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
             </div>
         </div>
     </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            
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
                                    @foreach($reports as $datareport)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $datareport->title }}</td>
                                            <td>{{ $datareport->office }}</td>
                                            <td>{{ $datareport->speaker }}</td>
                                            <td>{{ $datareport->training_month }}</td>
                                            <td>{{ $datareport->training_day }}</td>
                                            <td>{{ $datareport->training_year }}</td>
                                            <td>{{ $datareport->training_venue }}</td>
                                            <td>
                                                <a href="{{ route('reportViewSurvey', ['id' => $datareport->id]) }}" class="btn btn-outline-success btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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
                        
 @endsection