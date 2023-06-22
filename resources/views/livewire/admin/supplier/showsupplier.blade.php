<div class="card-body">

    <div class="visitor-form-container" style="top:{{$isShowCreate}}">

        <form action="">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Supplier Name</label>
                <div class="col-sm-10">
                    <input wire:model="newSupplierName" type="text" class="form-control" id="inputText" required>
                    @error('newSupplierName') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Supplier Phone</label>
                <div class="col-sm-10">
                    <input wire:model="newSupplierPhone" type="tel" class="form-control" id="inputText" required>
                    @error('newSupplierPhone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Supplier Email</label>
                <div class="col-sm-10">
                    <input wire:model="newSupplierEmail" type="email" class="form-control" id="inputText" required>
                    @error('newSupplierEmail') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New Supplier Address</label>
                <div class="col-sm-10">
                    <input wire:model="newSupplierAddress" type="text" class="form-control" id="inputText" required>
                    @error('newSupplierAddress') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="text-center">
                <button wire:click="createNew" type="submit" class="btn btn-primary">Create</button>
                <button wire:click="cancelNew" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>
    <div class="visitor-form-container" style="top:{{$isShowEdit}}">

        <form action="">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Edit Supplier Name</label>
                <div class="col-sm-10">
                    <input wire:model="editSupplierName" type="text" class="form-control" id="inputText" placeholder="{{$name}}" >
                    @error('editSupplierName') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Edit Supplier Phone</label>
                <div class="col-sm-10">
                    <input wire:model="editSupplierPhone" type="tel" class="form-control" id="inputText" placeholder="{{$phone}}" >
                    @error('editSupplierPhone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Edit Supplier Email</label>
                <div class="col-sm-10">
                    <input wire:model="editSupplierEmail" type="email" class="form-control" id="inputText" placeholder="{{$email}}" >
                    @error('editSupplierEmail') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Edit Supplier Address</label>
                <div class="col-sm-10">
                    <input wire:model="editSupplierAddress" type="text" class="form-control" id="inputText" placeholder="{{$address}}" >
                    @error('editSupplierAddress') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="text-center">
                <button wire:click="editSupplier" type="button" class="btn btn-primary">Edit</button>
                <button wire:click="cancelEdit" type="button" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of supplier ({{$total}})</h5>
        </div>
        <div class="col-6">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="create" class="btn btn-primary">Add new supplier</button>
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($supplier as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->name}}</td>
                <td>{{$p->phone}}</td>
                <td>{{$p->email}}</td>
                <td>{{$p->address}}</td>
                <td>
                    <a href="#" wire:click="edit('{{$p->id}}')" id="delete" title="Edit supplier"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
