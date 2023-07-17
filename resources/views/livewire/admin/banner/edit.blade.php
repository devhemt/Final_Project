<div class="row addpd">
    <div class="col-lg-6">
        <form accept-charset="utf-8" action="{{ url("admin/banner/edit") }}" role="form" method="POST" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf
            <div class="form-group">
                <label>Banner's Url</label>
                <input name="url" class="form-control" >
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
                <select name="banner" class="form-control">
                    <option value="1">-- baner 1 --</option>
                    <option value="2">-- baner 2 --</option>
                    <option value="3">-- baner 3 --</option>
                    <option value="4">-- baner 4 --</option>
                    <option value="5">-- baner 5 --</option>
                    <option value="6">-- baner 6 --</option>
                    <option value="7">-- baner 7 --</option>
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
            </div>
        </div>


        <button name="sbm" type="submit" class="btn btn-success">Add new</button>
        <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label>Content</label>
            <textarea style="height: 300px"  wire:model="content" placeholder="{{ $content }}" name="content" class="form-control" rows="3"></textarea>
            @if ($errors->has('content'))
                <p class="text-danger">
                    @foreach ($errors->get('content') as $e)
                        {{ $e }}
                    @endforeach
                </p>
            @endif
        </div>
    </div>
</div>
