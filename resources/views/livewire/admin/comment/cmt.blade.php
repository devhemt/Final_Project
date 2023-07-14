<div class="card-body">
    <h5 class="card-title">Table of order</h5>
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label">Select:</label>
        <div class="col-sm-3">
            <select wire:model="type" class="form-select" aria-label="Default select example">
                @for($i = 1; $i < 3; $i++)
                    <option value="{{ $i }}">{{ $options[$i] }}</option>
                @endfor
            </select>
        </div>
    </div>
    @php
        $stt = 1;
    @endphp
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Product Code</th>
            <th scope="col">Image</th>
            <th scope="col">Comment</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <th scope="row">{{$stt}}</th>
                <td>{{$comment->name}}</td>
                <td>{{$comment->phone}}</td>
                <td>{{$comment->email}}</td>
                <td>{{$comment->product_code}}</td>
                <td><img src="{{asset('images/'.$comment->demo_image)}}" alt=""></td>
                <td>{{$comment->comment}}</td>
                <td style="text-align: center;">
                    <a href="#"><i class="fa-solid fa-check"></i></a>
                </td>
            </tr>
            @php
                $stt++;
            @endphp
        @endforeach
        </tbody>
    </table>

{{--    {{ $order->links() }}--}}
</div>
