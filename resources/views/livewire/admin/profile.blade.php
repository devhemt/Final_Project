<div class="row">
    <div class="col-xl-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <img src="{{asset('imagesadmin/images/'.$profile->image)}}" alt="Profile" class="rounded-circle">
                <h2>{{$profile->name}}</h2>
                <h3>{{$job}}</h3>
            </div>
        </div>

    </div>

    <div class="col-xl-8">

        <div class="card" wire:ignore.self>
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button wire:ignore class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button wire:ignore class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>

                    <li class="nav-item">
                        <button wire:ignore class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div wire:ignore.self class="tab-pane fade show active profile-overview" id="profile-overview">

                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8">{{$profile->name}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Job</div>
                            <div class="col-lg-9 col-md-8">{{$job}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8">{{$profile->phone}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{$profile->email}}</div>
                        </div>

                    </div>

                    <div wire:ignore.self class="tab-pane fade profile-edit pt-3" id="profile-edit">
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                <div class="col-md-8 col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <input wire:model="photo" name="prd_image" onchange="preview();" class="form-control" type="file" id="formFile">
                                        </div>
                                    </div>
                                    <div id="view-image" wire:ignore>
                                    <img src="{{asset('imagesadmin/images/'.$profile->image)}}" alt="Profile">
                                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="pt-2">
                                        <a wire:click="delProImage" class="btn btn-danger btn-sm" onchange="nopreview();" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <div class="col-md-8 col-lg-9">
                                    <input wire:model="fullname" type="text" class="form-control" id="fullName" placeholder="{{$profile->name}}">
                                    @error('fullname') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                <div class="col-md-8 col-lg-9">
                                    <input wire:model="phone" type="text" class="form-control" id="Phone" placeholder="{{$profile->phone}}">
                                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input wire:model="email" type="email" class="form-control" id="Email" placeholder="{{$profile->email}}">
                                    @error('email') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button wire:click="profileChange" class="btn btn-primary">Save Changes</button>
                            </div>
                    </div>

                    <div wire:ignore.self class="tab-pane fade pt-3" id="profile-change-password">
                            <div class="row mb-3">
                                @error('success') <span class="text-success">{{ $message }}</span> @enderror
                                <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input required wire:model="current_password" name="current_password" type="password" class="form-control" id="current_password">
                                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                                    @error('psmatchs') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input required wire:model="new_password" name="new_password" type="password" class="form-control" id="new_password">
                                    @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                                    @error('cpsamenp') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_password_confirmation" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input required wire:model="new_password_confirmation" name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation">
                                    @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                    @error('confirm') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button wire:click="changePasswordSave" type="button" class="btn btn-primary">Change Password</button>
                            </div>
                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
    <script language="JavaScript" type="text/javascript">
        function preview() {
            var cell=document.getElementById('view-image');
            while (cell.hasChildNodes()) {
                cell.removeChild(cell.firstChild);
            }

            for (var i = 0; i < event.target.files.length;i++){
                var div=document.createElement('img');
                // div.setAttribute('width','130px');
                // div.setAttribute('height','200px');
                div.setAttribute('src',URL.createObjectURL(event.target.files[i]));
                cell.appendChild(div);
                flagimage = true;
            }

        }
        function nopreview() {
            var cell=document.getElementById('view-image');
            while (cell.hasChildNodes()) {
                cell.removeChild(cell.firstChild);
            }
        }
    </script>
</div>
