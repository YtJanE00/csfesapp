<div class="modal fade" id="modal-adduser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action= "{{ route('userCreate') }}" method="post">
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
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label>Role</label>
                                <select class="form-control form-control-sm" name="role">
                                    <option disabled selected>--Select--</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='form-row'>
                            <div class="col-md-8">
                                <label>Offices</label>
                                <select class="form-control form-control-sm" name="dept">
                                    @if(Auth::user()->role == 'Administrator')
                                        <option disabled selected> --Select-- </option>
                                        @foreach ($office as $dataoffice)
                                            <option value="{{ $dataoffice->office_abbr }}">{{ $dataoffice->office_name }}</option>
                                        @endforeach
                                    @else
                                    @endif
                                </select>
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