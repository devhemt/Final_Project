<div class="card-body">
    <div class="visitor-form-container" style="top:{{$top}};">

        <form action="">
            <h3>Are you sure about delete this account</h3>
            <input wire:click="yes" type="button" value="Yes" class="btn danger">
            <input wire:click="no" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>
    <h5 class="card-title">Table with stripped rows</h5>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">User Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            @if($flag)
            <th scope="col">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($accountss as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->name}}</td>
                <td>{{$p->phone}}</td>
                <td>{{$p->email}}</td>
                <td>
                    <img style="max-height: 200px;max-width: 100px;object-fit: cover;" src="{{asset('imagesadmin/images/'.$p->image)}}" alt="Profile">
                </td>
                @if($flag)
                <td style="text-align: center;">
                    <a href="#" wire:click="block('{{$p->id}}')" id="deleteprd"><i class="fas fa-trash "></i></a>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $accountss->links() }}
</div>
