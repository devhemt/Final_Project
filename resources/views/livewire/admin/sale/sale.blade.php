<div class="card-body">
    <div class="visitor-form-container" style="top:{{$isShowCreate}}">

        <form action="">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Sale's Name</label>
                <div class="col-sm-10">
                    <input wire:model="salename" type="text" class="form-control" id="inputText" >
                    @error('salename') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select wire:model="category" class="form-control">
                        <option value="0">-- All Product --</option>
                        @foreach($categories as $c)
                            <option value="{{$c->id}}">-- {{$c->category_name}} --</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @if($flag)
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Customer Type</label>
                <div class="col-sm-10">
                    <select wire:model="cus_type" class="form-control">
                        <option value="1">-- Loyal customers --</option>
                        <option value="2">-- New customers --</option>
                        <option value="3">-- Potential customers --</option>
                    </select>
                    @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Discount</label>
                <div class="col-sm-10">
                    <input wire:model="discount" type="text" class="form-control" id="inputText" >
                    @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Begin Time</label>
                <div class="col-sm-10">
                    <input wire:model="begin_date" type="date" class="form-control" id="inputText" required>
                    <input wire:model="begin_time" type="time" class="form-control" id="inputText" required>
                    @error('begin_date') <span class="text-danger">{{ $message }}</span> @enderror
                    @error('begin_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">End Time</label>
                <div class="col-sm-10">
                    <input wire:model="end_date" type="date" class="form-control" id="inputText" required>
                    <input wire:model="end_time" type="time" class="form-control" id="inputText" required>
                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    @error('end_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="text-center">
                <button wire:click="createNew" type="button" class="btn btn-primary">Create</button>
                <button wire:click="cancelNew" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

    <div class="visitor-form-container" style="top:{{$top}};">

        <form action="">
            <h3>Are you sure about delete this sale</h3>
            <input wire:click="yes" type="button" value="Yes" class="btn danger">
            <input wire:click="no" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of sale</h5>
        </div>
        <div class="col-6">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="create" class="btn btn-primary">Add new sale</button>
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Sale's name</th>
            <th scope="col">Type</th>
            <th scope="col">Discount</th>
            <th scope="col">Begin</th>
            <th scope="col">End</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $p)
            <tr>
                <th scope="row">{{$p->sale_name}}</th>
                <td>{{$type[$p->id]}}</td>
                <td>{{$p->discount}} $</td>
                <td>{{$p->begin}}</td>
                <td>{{$p->end}}</td>
                <td style="text-align: center;">
                    <a href="#" wire:click="delete('{{$p->id}}')" id="deleteprd" title="Delete order"><i class="fas fa-trash "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $sales->links() }}
</div>
