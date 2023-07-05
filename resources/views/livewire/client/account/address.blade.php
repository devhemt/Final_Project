<div class="col-xl-9">
    <div class="product-des-tab">
        <ul wire:ignore.self class="nav nav-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ADDRESS INFORMATION</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">CHANGE PASSWORD</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div wire:ignore.self class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="prod-bottom-tab-sin">
                    <div class="row justify-content-center">
                        <div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
                            <div class="contact-form login-form">
                                @error('success_add') <span class="text-success">{{ $message }}</span> @enderror
                                <form wire:submit.prevent="save" wire:ignore>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <select required wire:model="city" class="form-select form-select-sm mb-3" name="city" id="city" aria-label=".form-select-sm">
                                                <option value="" selected>City</option>
                                            </select>
                                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                            <select required wire:model="district" class="form-select form-select-sm mb-3" name="district" id="district" aria-label=".form-select-sm">
                                                <option value="" selected>District</option>
                                            </select>
                                            @error('district') <span class="text-danger">{{ $message }}</span> @enderror
                                            <select required wire:model="ward" class="form-select form-select-sm mb-3" name="ward" id="ward" aria-label=".form-select-sm">
                                                <option value="" selected>Ward</option>
                                            </select>
                                            @error('ward') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-xl-12">
                                            <input wire:model="detailed_address" type="text" placeholder="Detailed address">
                                            @error('detailed_address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-xl-12">
                                            <input type="submit" value="CREATE NEW ADDRESS">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h5>Additional information</h5>
                    <div class="info-wrap">
                        @foreach($address as $a)
                        <div class="sin-aditional-info">
                            <div class="first">
                                <fieldset class="row mb-3">
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input wire:click="chose({{$a->id}})" class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" @if($a->active == 1) checked @endif>
                                            <label class="form-check-label" for="gridRadios2">
                                                Use this address
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="secound">
                                {{$addressArr[$a->id][2]}}, {{$addressArr[$a->id][1]}}, {{$addressArr[$a->id][0]}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div wire:ignore.self class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="prod-bottom-tab-sin">
                    <div class="product-review">
                        <div class="add-your-review">
                            <div class="raing-form">
                                <form action="#">
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-lg-12">
                                            @error('success') <span class="text-success">{{ $message }}</span> @enderror
                                        </div>

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
                                    <button style="background: #d19e66;border: 1px solid #d19e66;" wire:click="changePasswordSave" type="button" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
