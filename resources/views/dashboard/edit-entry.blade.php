@extends('layouts.dashboard')
@section('content')
    <style>
        .btnhoverchooseFile{
            background: white;letter-spacing: 4px;width: 187px;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;text-align: center;color: #6b9ce8;text-transform: uppercase;padding: 7px 0 7px;font-family: 'futura-normalregular';font-size: 15px;border: none;cursor: pointer;border: 2px solid #6b9ce8;
        }
        .btnhoverchooseFile:hover{
            background: #6b9ce8!important;
            color: white!important;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    {{--    <div>--}}
    <div class="container" style="max-width: 900px;margin-top: 30px;margin-bottom: 50px">
        @if($errors->any())
            <div class="alert alert-danger">
                <h4 style="color: black;font-size: 14px">{{$errors->first()}}</h4>
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('msg'))
            <div class="alert alert-success" style="margin-bottom: 0px!important;">
                <h4 style="color: black">{{\Illuminate\Support\Facades\Session::get("msg")}}</h4>
            </div>
        @endif
        <h3 style="letter-spacing: 3px" class="mt-4 mb-3">EDIT ENTRY</h3>


        <form method="post" action="{{url("/update-entry")}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" value="{{$entry->id}}" name="entry_id">
            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4" id="drop-area-1">
                    <input style="display: none" type="file" id="fileOne" name="fileOne[]" onchange="setName('fileOne','fileOneName')">
                    <button onclick="document.getElementById('fileOne').click()" type="button"
                           class="btnhoverchooseFile">
                        CHANGE LOGO
                    </button>
                </div>
                <div class="col-lg-8">
                    <input style="height: 42px!important;" type="text" class="form-control" placeholder="File Name"
                           name="fileOneName" id="fileOneName" value="{{$entry->logo}}" required>
                </div>
            </div>
            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Influencer Name*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" value="{{$entry->influencer}}" class="form-control" placeholder="Enter Influencer" name="influencer" id="influencer" required>
                </div>
            </div>

            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Product Name*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" value="{{$entry->product}}" class="form-control" placeholder="Enter Product (such as GUCCI)" name="productName" id="productName" required>
                </div>
            </div>

            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Product Type*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" value="{{$entry->product_type}}" class="form-control" placeholder="Enter Product Type (such as hair/clothing/ beauty/food etc)" name="productType" id="productType" required>
                </div>
            </div>
            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Promo Code*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" value="{{$entry->promo_code}}" class="form-control" placeholder="Enter Promo Code" name="promoCode" id="promoCode" required>
                </div>
            </div>
            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Info of Influencer:</label>
                </div>
                <div class="col-lg-8">
                    <input type="text" value="{{$entry->info}}" class="form-control" placeholder="Enter Youtube link or some other link here" name="info" id="info" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" id="btnFetch" class="btn btn-primary">
                    UPDATE
                </button>
            </div>
        </form>
    </div>
    <script>
        function setName(fileId, inputId) {
            var files = document.getElementById(fileId).files;
            if (files.length> 0 )
            {
                document.getElementById(inputId).value = files[0].name;
            }
        }
        let dropArea1 = document.getElementById('drop-area-1');

        ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea1.addEventListener(eventName, preventDefaults1, false)

        })

        function preventDefaults1 (e) {
            e.preventDefault()
            e.stopPropagation()
        }

        dropArea1.addEventListener('drop', handleDrop1, false);


        function handleDrop1(e) {
            let dt = e.dataTransfer
            let files = dt.files;
            document.getElementById('fileOne').files = files;
            setName('fileOne', 'fileOneName');
        }

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
// Prepare the preview for profile picture
            $("#photo").change(function () {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photopreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
