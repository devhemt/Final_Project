<div class="card-body">
    <div class="visitor-form-container" style="top:{{$isShowDelete}};">

        <form action="">
            <h3>Are you sure about delete this category</h3>
            <input wire:click="yesDelete" type="button" value="Yes" class="btn danger">
            <input wire:click="noDelete" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>

    <div class="visitor-form-container" style="top:{{$isShowCreate}}">

        <form action="">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">New category</label>
                <div class="col-sm-10">
                    <input wire:model="newCategory" type="text" class="form-control" id="inputText" required>
                    @error('newCategory') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="text-center">
                <button wire:click="createNew" type="button" class="btn btn-primary">Create</button>
                <button wire:click="cancelNew" type="button" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of categories ({{$total}})</h5>
        </div>
        <div class="col-6">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="create" class="btn btn-primary">Add new category</button>
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Category Name</th>
            <th scope="col">Created at</th>
            <th scope="col">Update at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($category as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->category_name}}</td>
                <td>{{$p->created_at}}</td>
                <td>{{$p->updated_at}}</td>
                <td>
                    <a href="#" wire:click="block('{{$p->id}}')" id="delete" title="Delete category"><i class="fas fa-trash "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
