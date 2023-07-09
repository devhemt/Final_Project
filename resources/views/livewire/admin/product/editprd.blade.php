<div class="row addpd">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Select batch:</label>
        <div class="col-sm-2">
            <select wire:model="type" class="form-select" aria-label="Default select example">
                @foreach ($options as $op)
                        <option value="{{ $op->batch }}">Batch {{ $op->batch }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <form accept-charset="utf-8" action="{{ url("admin/product/edit") }}" role="form" method="POST" enctype="multipart/form-data">
            {{ method_field('POST') }}
            @csrf
            <div class="form-group">
                <input hidden name="prd_id" class="form-control" value="{{$idprd}}">
                <input hidden name="prd_batch" class="form-control" value="{{$batch}}">
            </div>
            <div class="form-group">
                <label>Product's Name</label>
                <input name="prd_name" class="form-control" placeholder="{{$product[0]->name}}">
                @if ($errors->has('prd_name'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_name') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Unit price</label>
                <input name="prd_cost" type="number" min="0" class="form-control" placeholder="{{$cost}}">
                @if ($errors->has('prd_cost'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_cost') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Price</label>
                <input name="prd_price" type="number" min="0" class="form-control" placeholder="{{$product[0]->price}}">
                @if ($errors->has('prd_price'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_price') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <select name="prd_category" class="form-control">
                    <option value="0">-- {{$product[0]->category_name}} --</option>
                    @foreach($categories as $c)
                        <option value="{{$c->id}}">-- {{$c->category_name}} --</option>
                    @endforeach
                </select>
                @if ($errors->has('prd_category'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_category') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Tag</label>
                <input name="prd_tag" type="text" class="form-control" placeholder="{{$product[0]->tag}}">
                @if ($errors->has('prd_tag'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_tag') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Nature:</label>
                @if ($errors->has('prd_size'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_size') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
                @if ($errors->has('prd_color'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_color') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
                @if ($errors->has('prd_amount'))
                    <p class="text-danger">
                        @foreach ($errors->get('prd_amount') as $e)
                            {{ $e }}
                        @endforeach
                    </p>
                @endif
                <table class="table" id="my-table">
                    <tbody>
                    <tr>
                        <th>Size</th>
                        @for ($i = 0; $i < $count; $i++)
                            <td><select name="prd_size[]" class="form-control">
                                    <option value="{{$p1[$i]->size}}">{{$p1[$i]->size}}</option>
                                    <option value="XXS">XXS</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </td>
                            @if($i==4)
                                @break
                            @endif
                        @endfor
                    </tr>
                    <tr>
                        <th>Color</th>
                        @for ($i = 0; $i < $count; $i++)
                            <td><input type="color" name="prd_color[]" class="form-control form-control-color1" value="{{$p1[$i]->color}}" title="Choose your color"></td>
                            @if($i==4)
                                @break
                            @endif
                        @endfor
                    </tr>
                    <tr>
                        <th>Amount</th>
                        @for ($i = 0; $i < $count; $i++)
                            <td><input required name="prd_amount[]" min="0" value="{{$p1[$i]->amount}}" type="number" class="form-control"></td>
                            @if($i==4)
                                @break
                            @endif
                        @endfor
                    </tr>
                    </tbody>
                </table>

            </div>

            <div class="form-group">
                <table class="table" id="my-table-1">
                    <tbody>
                    <tr>
                        @if($count >= 4)
                            @for ($i = 4; $i < $count; $i++)
                                <td><select name="prd_size[]" class="form-control">
                                        <option value="{{$p1[$i]->size}}">{{$p1[$i]->size}}</option>
                                        <option value="XXS">XXS</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </td>
                                @if($i==9)
                                    @break
                                @endif
                            @endfor
                        @endif
                    </tr>
                    <tr>
                        @if($count >= 4)
                            @for ($i = 4; $i < $count; $i++)
                                <td><input type="color" name="prd_color[]" class="form-control form-control-color1" value="{{$p1[$i]->color}}" title="Choose your color"></td>
                                @if($i==9)
                                    @break
                                @endif
                            @endfor
                        @endif
                    </tr>
                    <tr>
                        @if($count >= 4)
                            @for ($i = 4; $i < $count; $i++)
                                <td><input required name="prd_amount[]" min="0" value="{{$p1[$i]->amount}}" type="number" class="form-control"></td>
                                @if($i==9)
                                    @break
                                @endif
                            @endfor
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <table class="table" id="my-table-2">
                    <tbody>
                    <tr>
                        @if($count > 8 )
                            @for ($i = 9; $i < $count; $i++)
                                <td><select name="prd_size[]" class="form-control">
                                        <option value="{{$p1[$i]->size}}">{{$p1[$i]->size}}</option>
                                        <option value="XXS">XXS</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </td>
                                @if($i==14)
                                    @break
                                @endif
                            @endfor
                        @endif
                    </tr>
                    <tr>
                        @if($count > 8 )
                            @for ($i = 9; $i < $count; $i++)
                                <td><input type="color" name="prd_color[]" class="form-control form-control-color1" value="{{$p1[$i]->color}}" title="Choose your color"></td>
                                @if($i==14)
                                    @break
                                @endif
                            @endfor
                        @endif
                    </tr>
                    <tr>
                        @if($count > 8 )
                            @for ($i = 9; $i < $count; $i++)
                                <td><input required name="prd_amount[]" min="0" value="{{$p1[$i]->amount}}" type="number" class="form-control"></td>
                                @if($i==14)
                                    @break
                                @endif
                            @endfor
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <table class="table" id="my-table-3">
                    <tbody>
                    <tr>
                        @if($count > 13 )
                            @for ($i = 14; $i < $count; $i++)
                                <td><select name="prd_size[]" class="form-control">
                                        <option value="{{$p1[$i]->size}}">{{$p1[$i]->size}}</option>
                                        <option value="XXS">XXS</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </td>
                            @endfor
                        @endif
                    </tr>
                    <tr>
                        @if($count > 13 )
                            @for ($i = 14; $i < $count; $i++)
                                <td><input type="color" name="prd_color[]" class="form-control form-control-color1" value="{{$p1[$i]->color}}" title="Choose your color"></td>
                            @endfor
                        @endif
                    </tr>
                    <tr>
                        @if($count > 13 )
                            @for ($i = 14; $i < $count; $i++)
                                <td><input required name="prd_amount[]" min="0" value="{{$p1[$i]->amount}}" type="number" class="form-control"></td>
                            @endfor
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>



            <div class="form-group" style="flex-direction: row;margin-left: 120px;margin-top: -30px;">
                <button type="button" value="Add column" onclick="javascript:appendColumn()" class="btn btn-default">Append Column</button>
                <button type="button" value="Delete columns" onclick="javascript:deleteColumns()" class="btn btn-default">Delete Columns</button>
            </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group" style="margin-top: 22px;">
            <label>Product main image</label>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <input name="prd_image" onchange="preview();" class="form-control" type="file" id="formFile">
                </div>
            </div>
            @if ($errors->has('prd_image'))
                <p class="text-danger">
                    @foreach ($errors->get('prd_image') as $e)
                        {{ $e }}
                    @endforeach
                </p>
            @endif
            <div id="view-image">
                <img src="{{asset('images/'.$product[0]->demo_image)}}" alt="Thumb" style="height: 200px; width: 130px">
            </div>
        </div>
        <div class="form-group">
            <label>Product's images</label>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <input name="prd_images[]" onchange="previews();" class="form-control" type="file" id="formFile" multiple>
                </div>
            </div>
            <div id="view-images">
                @foreach($images as $i)
                    <img src="{{asset('images/'.$i->url)}}" alt="Thumb" style="height: 200px; width: 130px">
                @endforeach
            </div>
        </div>
        <div class="form-group">
            @if ($errors->has('prd_images'))
                <p class="text-danger">
                    @foreach ($errors->get('prd_images') as $e)
                        {{ $e }}
                    @endforeach
                </p>
            @endif
        </div>


        <div class="form-group">
            <label>Description</label>
            <textarea wire:ignore id="des" name="prd_description" class="form-control" rows="3" placeholder="{{$product[0]->description}}"></textarea>
            @if ($errors->has('prd_description'))
                <p class="text-danger">
                    @foreach ($errors->get('prd_description') as $e)
                        {{ $e }}
                    @endforeach
                </p>
            @endif
        </div>
        <button name="sbm" type="submit" class="btn btn-success">Edit</button>
        <button type="reset" class="btn btn-default">Fresh</button>
        </form>

    </div>
</div>
