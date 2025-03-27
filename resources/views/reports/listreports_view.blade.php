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
                        <li class="breadcrumb-item"><a href="{{ route('reportRead') }}">Reports</a></li>
                        @if($reportformtitle && $reportformtitle->isNotEmpty())
                            <li class="breadcrumb-item active">{{ $reportformtitle->first()->title }}</li>
                        @else
                            <li class="breadcrumb-item active">Default Title</li> <!-- or handle accordingly -->
                        @endif
                    </ol>
                </div>
             </div>
         </div>
     </div>
    <!-- /.content-header -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-dark text-bold" id="custom-tabs-four-one-tab" data-toggle="pill" href="#custom-tabs-four-one" role="tab" aria-controls="custom-tabs-four-one" aria-selected="true">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark text-bold" id="custom-tabs-four-two-tab" data-toggle="pill" href="#custom-tabs-four-two" role="tab" aria-controls="custom-tabs-four-two" aria-selected="false">Result</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-one" role="tabpanel" aria-labelledby="custom-tabs-four-one-tab">
                                    <div class="table-responsive">
                                        <table id="example1"class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Training/Workshop Title</th>
                                                    <th>Name</th>
                                                    <th>Office</th>
                                                    <th>Contact_Information</th>
                                                    <th>Feedback</th>
                                                    <th>Feedback2</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no=1; @endphp
                                                @foreach($reportformtitle as $datareportformtitle)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $datareportformtitle->title }}</td>
                                                        <td>{{ $datareportformtitle->name }}</td>
                                                        <td>{{ $datareportformtitle->office }}</td>
                                                        <td>{{ $datareportformtitle->contact_information }}</td>
                                                        <td>{{ $datareportformtitle->feedback }}</td>
                                                        <td>{{ $datareportformtitle->feedback2 }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success btn-sm view-pdf" 
                                                                data-url="{{ route('PDFSurveyRatedTemplate', ['id' => $datareportformtitle->id]) }}" 
                                                                data-title="{{ $datareportformtitle->title }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                   </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-two" role="tabpanel" aria-labelledby="custom-tabs-four-two-tab">
                                @foreach ($getTitleID as $title)
                                    @php
                                        $titleID = $title->title_id;
                                    @endphp
                                    @break
                                @endforeach

                                    <iframe src="{{ route('PDFreportViewSurveyresult', ['id' => $titleID]) }}" width="100%" height="500"></iframe>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
     </div>
</div>

<!-- Modal for PDF Viewer -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" src="" frameborder="0" width="100%" height="600px"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.view-pdf').on('click', function() {
            var pdfUrl = $(this).data('url');
            var title = $(this).data('title');
            
            $('#pdfModalLabel').text(pdfUrl);
            $('#pdfFrame').attr('src', pdfUrl);
            $('#pdfModal').modal('show');
        });
    });

</script>

 @endsection