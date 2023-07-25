@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Banner manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item">Banner</li>
                    <li class="breadcrumb-item active">Edit banner</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            @livewire('admin.banner.edit')
        </section>
        <script language="JavaScript" type="text/javascript">
            $('#des').summernote({
                placeholder: 'Please text something',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            var flagimage = false;
            function preview() {
                var cell=document.getElementById('view-image');
                while (cell.hasChildNodes()) {
                    cell.removeChild(cell.firstChild);
                }

                for (var i = 0; i < event.target.files.length;i++){
                    var div=document.createElement('img');
                    div.setAttribute('width','130px');
                    div.setAttribute('height','200px');
                    div.setAttribute('src',URL.createObjectURL(event.target.files[i]));
                    cell.appendChild(div);
                    flagimage = true;
                }
            }
        </script>

    </main>
@endsection
