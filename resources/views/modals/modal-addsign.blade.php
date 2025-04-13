<div class="modal fade" id="modal-addsign">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Signatories</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action= "{{ route('signCreate') }}" method="post" id="addsign">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-4">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                            </div>
                           <div class="col-md-4">
                                <label>Middle Name</label>
                                <input type="text" name="mname" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                            </div>
                            <div class="col-md-4">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-12">
                                <label>Role</label>
                                <select class="form-control form-control-sm" name="role">
                                    <option disabled selected>--Select--</option>
                                    <option value="Dean">Dean</option>
                                    <option value="Director, Extension and Community Services">Director, Extension and Community Services</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-4">
                                <label>Offices</label>
                                <select class="form-control form-control-sm" name="deptName" id="office-select" onchange="updateOfficeId()">
                                    @if(Auth::user()->role == 'Administrator')
                                        <option disabled selected> --Select-- </option>
                                        @foreach ($office as $dataoffice)
                                            <option value="{{ $dataoffice->id }}" data-name="{{ $dataoffice->office_name }}">{{ $dataoffice->office_name }}</option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
                                <input type="hidden" id="office-name" name="dept">
                                <input type="hidden" id="office-id" name="deptID" class="form-control form-control-sm" readonly>
                            </div>

                            <script>
                                function updateOfficeId() {
                                    const select = document.getElementById('office-select');
                                    const officeIdInput = document.getElementById('office-id');
                                    const officeNameInput = document.getElementById('office-name');
                                    const selectedOption = select.options[select.selectedIndex];
                                    
                                    officeIdInput.value = select.value;
                                    officeNameInput.value = selectedOption.getAttribute('data-name');
                                }
                            </script>
                            <div class="col-md-4">
                                <label for="rank">Rank</label>
                                <input type="text" class="form-control form-control-sm" name="rank">
                            </div>
                            <div class="col-md-4">
                                <label>Campus</label>
                                <select class="form-control form-control-sm" name="campus">
                                    @if(Auth::user()->role == 'Administrator')
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
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        
    </div>
    
</div>