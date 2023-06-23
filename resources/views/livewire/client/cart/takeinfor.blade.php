<div class="visitor-form-container" style="top:{{$top}};">

    <i wire:click="close" class="fas fa-times" id="form-close"></i>

    <form action="">
        <h3>Your information</h3>
        <input required wire:model="name" name="name" type="text" class="box" placeholder="enter your name">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        <input required wire:model="email" name="email" type="email" class="box" placeholder="enter your email">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        <input required wire:model="phone" name="phone" type="tel" class="box" placeholder="enter your phone">
        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        <div>
            <select class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm">
                <option value="" selected>Chọn tỉnh thành</option>
            </select>

            <select class="form-select form-select-sm mb-3" id="district" aria-label=".form-select-sm">
                <option value="" selected>Chọn quận huyện</option>
            </select>

            <select class="form-select form-select-sm" id="ward" aria-label=".form-select-sm">
                <option value="" selected>Chọn phường xã</option>
            </select>
        </div>
        <input wire:click="confirm" type="button" value="confirm" class="btn">
        <p for="remember">Because you don't have an account, we need you to provide your personal information in order to confirm the order.</p>
    </form>

</div>
