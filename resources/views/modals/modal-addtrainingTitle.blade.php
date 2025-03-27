<div class="modal fade" id="modal-addtrainingtitle">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Training</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('formCreate') }}" method="post" id="addTitleForm">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-12">
                                <label>Training Title:</label>
                                <input type="text" name="title" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-12">
                                <label>Speaker/Trainers:</label>
                                <input type="text" name="speaker" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-4">
                                <label>Select Month:</label>
                                <select name="training_month" class="form-control form-control-sm">
                                    <option disabled selected> -- Select Month --</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Day:</label>
                                <select name="training_day[]" class="form-control form-control-sm select2" multiple="multiple">
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Select Year:</label>
                                <select name="training_year" class="form-control form-control-sm">
                                    <option disabled selected> -- Select Year --</option>
                                    @php
                                        $currentYear = date('Y');
                                    @endphp
                                    <option value="{{ $currentYear }}">{{ $currentYear }}</option>
                                    <option value="{{ $currentYear + 1 }}">{{ $currentYear + 1 }}</option>
                                    <option value="{{ $currentYear + 2 }}">{{ $currentYear + 2 }}</option>
                                    <option value="{{ $currentYear + 3 }}">{{ $currentYear + 3 }}</option>
                                    <option value="{{ $currentYear + 4 }}">{{ $currentYear + 4 }}</option>
                                    <option value="{{ $currentYear + 5 }}">{{ $currentYear + 5 }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-12">
                                <label>Venue:</label>
                                <input type="text" name="training_venue" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>     
    </div>   
</div>