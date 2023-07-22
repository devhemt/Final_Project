<div class="row addpd">
    <div class="col-lg-6">
        <form accept-charset="utf-8" action="{{ url("admin/banner/edit") }}" role="form" method="POST" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf
            <div class="form-group">
                <label>Banner's Url</label>
                <input name="url" class="form-control" placeholder="{{$banner->url}}">
                @if ($errors->has('url'))
                    <p class="text-danger">
                        @foreach ($errors->get('url') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Banner</label>
                <select wire:model="banner_id" name="banner" class="form-control">
                    <option value="1">-- banner 1 --</option>
                    <option value="2">-- banner 2 --</option>
                    <option value="3">-- banner 3 --</option>
                    <option value="4">-- banner 4 --</option>
                    <option value="5">-- banner 5 --</option>
                    <option value="6">-- banner 6 --</option>
                    <option value="7">-- banner 7 --</option>
                </select>
                @if ($errors->has('banner'))
                    <p class="text-danger">
                        @foreach ($errors->get('banner') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label>Banner's image</label>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <input name="image" onchange="preview();" class="form-control" type="file" id="formFile">
                </div>
            </div>
            @if ($errors->has('image'))
                <p class="text-danger">
                    @foreach ($errors->get('image') as $e)
                        {{ $e }}
                    @endforeach
                </p>
            @endif
            <div id="view-image">
                <img src="{{asset('images/'.$banner->image)}}" alt="Thumb" style="height: 200px; width: 400px; object-fit: cover">
            </div>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea wire:model="content" name="content" class="form-control" rows="3"></textarea>
            @if ($errors->has('content'))
                <p class="text-danger">
                    @foreach ($errors->get('content') as $e)
                        {{ $e }}
                    @endforeach
                </p>
            @endif
        </div>

        <button name="sbm" type="submit" class="btn btn-success">Add new</button>
        <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>
</div>
