<div class="card-body">

    <div class="visitor-form-container" style="top:{{$isShowCreate}}">

        <form action="">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Purchase code</label>
                <div class="col-sm-10">
                    <input wire:model="purchaseCode" type="text" class="form-control" id="inputText" required>
                    @error('purchaseCode') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
{{--            <div class="row mb-3">--}}
{{--                <label for="inputEmail3" class="col-sm-2 col-form-label">Total pay ($)</label>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <input wire:model="totalPay" type="text" class="form-control" id="inputText" required>--}}
{{--                    @error('totalPay') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select wire:model="supplier" id="inputState" class="form-select">
                    <option selected>Choose supplier</option>
                    @foreach($suppliers as $p)
                    <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
                @error('supplier') <span class="text-danger">{{ $message }}</span> @enderror
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
                <label for="inputEmail3" class="col-sm-2 col-form-label">Purchase code</label>
                <div class="col-sm-10">
                    <input wire:model="editPurchaseCode" type="text" class="form-control" id="inputText" placeholder="{{$edittingPC}}">
                    @error('editPurchaseCode') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
{{--            <div class="row mb-3">--}}
{{--                <label for="inputEmail3" class="col-sm-2 col-form-label">Total pay ($)</label>--}}
{{--                <div class="col-sm-10">--}}
{{--                    <input wire:model="editTotalPay" type="text" class="form-control" id="inputText" placeholder="{{$edittingTP}}">--}}
{{--                    @error('editTotalPay') <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-4">
                <label for="inputState" class="form-label">Supplier</label>
                <select wire:model="editSupplier" id="inputState" class="form-select">
                    <option selected>Choose supplier</option>
                    @foreach($suppliers as $p)
                        <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
                @error('editSupplier') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="text-center">
                <button wire:click="editPurchase" type="button" class="btn btn-primary">Edit</button>
                <button wire:click="cancelEdit" type="button" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of purchase ({{$total}})</h5>
        </div>
        <div class="col-6">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="create" class="btn btn-primary">Add new purchase</button>
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Purchase Code</th>
            <th scope="col">Supplier</th>
            <th scope="col">Total Pay</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($purchase as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->purchase_code}}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->total_pay}} $</td>
                <td>{{$p->created_at}}</td>
                <td>
                    <a href="#" wire:click="edit('{{$p->id}}')" id="delete" title="Edit supplier"><i class="fas fa-edit"></i></a>
                    <a href="{{url('admin/purchase/'.$p->id)}}" title="Detail of product"><i class="fas fa-eye "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $purchase->links() }}
</div>
