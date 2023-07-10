@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Purchase</li>
                    <li class="breadcrumb-item active">Add old product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row addpd">
                <div class="col-lg-12">

                    <form accept-charset="utf-8" action="{{ url("admin/purchase/addold") }}" role="form" method="POST" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        @csrf
                        <div class="form-group">
                            <input hidden name="prd_id" class="form-control" value="{{$prd_id}}">
                            <input hidden name="purchase_id" class="form-control" value="{{$purchase_id}}">
                        </div>
                        <div class="form-group">
                            @foreach($product as $p)
                                <p>{{$p->id}}</p>
                                <p>{{$p->name}}</p>
                                <p>{{$p->price}}</p>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Unit price</label>
                            <input required name="unit_price" type="number" min="0" class="form-control">
                            @if ($errors->has('unit_price'))
                                <p class="text-danger">
                                    @foreach ($errors->get('unit_price') as $e)
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
                                    <td><select name="prd_size[]" class="form-control">
                                            <option value="XXS">XXS</option>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td><input type="color" name="prd_color[]" class="form-control form-control-color1" value="#4154f1" title="Choose your color"></td>
                                </tr>
                                <tr>
                                    <th>Color Name</th>
                                    <td><input required type="text" name="prd_color_name[]" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td><input required min="0" name="prd_amount[]" type="number" class="form-control"></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="form-group">
                            <table class="table" id="my-table-1">
                                <tbody>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <table class="table" id="my-table-2">
                                <tbody>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <table class="table" id="my-table-3">
                                <tbody>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group" style="flex-direction: row;float: right;margin-top: -30px;">
                            <button type="button" value="Add column" onclick="javascript:appendColumn()" class="btn1">Append Column</button>
                            <button type="button" value="Delete columns" onclick="javascript:deleteColumns()" class="btn1">Delete Columns</button>
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Add new batch</button>
                    </form>
                </div>

{{--                <div class="col-lg-6">--}}

{{--                </div>--}}
            </div>
        </section>
        <script language="JavaScript" type="text/javascript">
            var flagname = 1;

            function appendColumn(){
                var tbl=document.getElementById('my-table');
                var tbl1=document.getElementById('my-table-1');
                var tbl2=document.getElementById('my-table-2');
                var tbl3=document.getElementById('my-table-3');
                if (flagname < 4) {
                    for(var i=0;i<tbl.rows.length;i++){

                        if (i==0) {
                            createSelect(tbl.rows[i].insertCell(tbl.rows[i].cells.length),'prd_size[]','form-control','text');
                        }
                        if (i==1) {
                            createCellColor(tbl.rows[i].insertCell(tbl.rows[i].cells.length),'prd_color[]','form-control','text');
                        }
                        if (i==2) {
                            createCell(tbl.rows[i].insertCell(tbl.rows[i].cells.length),'prd_color_name[]','form-control','text');
                        }
                        if (i==3) {
                            createCell(tbl.rows[i].insertCell(tbl.rows[i].cells.length),'prd_amount[]','form-control','number');
                        }
                    }
                }
                if(flagname >= 4 && flagname <=8) {
                    for(var i=0;i<tbl1.rows.length;i++){

                        if (i==0) {
                            createSelect(tbl1.rows[i].insertCell(tbl1.rows[i].cells.length),'prd_size[]','form-control','text');
                        }
                        if (i==1) {
                            createCellColor(tbl1.rows[i].insertCell(tbl1.rows[i].cells.length),'prd_color[]','form-control','text');
                        }
                        if (i==2) {
                            createCell(tbl1.rows[i].insertCell(tbl1.rows[i].cells.length),'prd_color_name[]','form-control','text');
                        }
                        if (i==3) {
                            createCell(tbl1.rows[i].insertCell(tbl1.rows[i].cells.length),'prd_amount[]','form-control','number');
                        }
                    }
                }
                if(flagname >= 9 && flagname <=13) {
                    for(var i=0;i<tbl2.rows.length;i++){

                        if (i==0) {
                            createSelect(tbl2.rows[i].insertCell(tbl2.rows[i].cells.length),'prd_size[]','form-control','text');
                        }
                        if (i==1) {
                            createCellColor(tbl2.rows[i].insertCell(tbl2.rows[i].cells.length),'prd_color[]','form-control','text');
                        }
                        if (i==2) {
                            createCell(tbl2.rows[i].insertCell(tbl2.rows[i].cells.length),'prd_color_name[]','form-control','text');
                        }
                        if (i==3) {
                            createCell(tbl2.rows[i].insertCell(tbl2.rows[i].cells.length),'prd_amount[]','form-control','number');
                        }
                    }
                }
                if(flagname >= 14 && flagname <=18) {
                    for(var i=0;i<tbl3.rows.length;i++){

                        if (i==0) {
                            createSelect(tbl3.rows[i].insertCell(tbl3.rows[i].cells.length),'prd_size[]','form-control','text');
                        }
                        if (i==1) {
                            createCellColor(tbl3.rows[i].insertCell(tbl3.rows[i].cells.length),'prd_color[]','form-control','text');
                        }
                        if (i==2) {
                            createCell(tbl3.rows[i].insertCell(tbl3.rows[i].cells.length),'prd_color_name[]','form-control','text');
                        }
                        if (i==3) {
                            createCell(tbl3.rows[i].insertCell(tbl3.rows[i].cells.length),'prd_amount[]','form-control','number');
                        }
                    }
                }

                flagname++;

            }

            function createCell(cell,name,style,type){
                var div=document.createElement('input');
                div.setAttribute('required','');
                div.setAttribute('name',name);
                div.setAttribute('type',type);
                div.setAttribute('class',style);
                div.setAttribute('min',0);
                div.setAttribute('className',style);
                cell.appendChild(div);
            }
            function createCellColor(cell,name,style,type){
                var div=document.createElement('input');
                div.setAttribute('name',name);
                div.setAttribute('type','color');
                div.setAttribute('value','#4154f1')
                div.setAttribute('title','Choose your color')
                div.setAttribute('class','form-control form-control-color1');
                div.setAttribute('className','form-control form-control-color1');
                cell.appendChild(div);
            }
            function createSelect(cell,name,style,type){
                var div=document.createElement('select');
                div.setAttribute('name',name);
                div.setAttribute('class',style);
                div.setAttribute('className',style);
                cell.appendChild(div);

                var op1 =document.createElement('option');
                op1.setAttribute('value','XXS');
                op1.innerHTML = 'XXS';
                div.appendChild(op1);
                var op2 =document.createElement('option');
                op2.setAttribute('value','XS');
                op2.innerHTML = 'XS';
                div.appendChild(op2);
                var op3 =document.createElement('option');
                op3.setAttribute('value','S');
                op3.innerHTML = 'S';
                div.appendChild(op3);
                var op4 =document.createElement('option');
                op4.setAttribute('value','M');
                op4.innerHTML = 'M';
                div.appendChild(op4);
                var op5 =document.createElement('option');
                op5.setAttribute('value','L');
                op5.innerHTML = 'L';
                div.appendChild(op5);
                var op6 =document.createElement('option');
                op6.setAttribute('value','XL');
                op6.innerHTML = 'XL';
                div.appendChild(op6);
                var op7 =document.createElement('option');
                op7.setAttribute('value','XXL');
                op7.innerHTML = 'XXL';
                div.appendChild(op7);
            }

            // delete table columns with index greater then 0
            function deleteColumns() {
                var tbl = document.getElementById('my-table'), // table reference
                    lastCol = tbl.rows[0].cells.length - 1,    // set the last column index
                    i, j;
                var tbl1 = document.getElementById('my-table-1'), // table reference
                    lastCol1 = tbl1.rows[0].cells.length - 1,    // set the last column index
                    a, b;
                var tbl2 = document.getElementById('my-table-2'), // table reference
                    lastCol2 = tbl2.rows[0].cells.length - 1,    // set the last column index
                    c, d;
                var tbl3 = document.getElementById('my-table-3'), // table reference
                    lastCol3 = tbl3.rows[0].cells.length - 1,    // set the last column index
                    e, f;
                // delete cells with index greater then 0 (for each row)
                for (i = 0; i < tbl.rows.length; i++) {
                    for (j = lastCol; j > 1; j--) {
                        tbl.rows[i].deleteCell(j);
                    }
                }
                for (a = 0; a < tbl1.rows.length; a++) {
                    for (b = lastCol1; b >= 0; b--) {
                        tbl1.rows[a].deleteCell(b);
                    }
                }
                for (c = 0; c < tbl2.rows.length; c++) {
                    for (d = lastCol2; d >= 0; d--) {
                        tbl2.rows[c].deleteCell(d);
                    }
                }
                for (e = 0; e < tbl3.rows.length; e++) {
                    for (f = lastCol3; f >= 0; f--) {
                        tbl3.rows[e].deleteCell(f);
                    }
                }
                flagname = 1;
            }
        </script>

    </main>
@endsection
