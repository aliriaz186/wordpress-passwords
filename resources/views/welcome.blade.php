<!DOCTYPE html>
<!-- COMMON TAGS -->
<meta charset="utf-8">



@extends('layouts.landing-app')
<!--====== BANNER PART START ======-->
@section('content')



    <style>
        .respmargintopbtn{
            margin-top: -360px!important;
        }
        .resppaddding1{
            padding: 50px;
        }
        .logomargin1{
            margin-top: 90px
        }
        .logomargin2{
            margin-left: 10px
        }
        .logosizeresp1{
            height: 80px;width: 100px;
        }
        .logosizeresp2{
            height: 80px;width: 80px;
        }
        .resppaddingiconsmain{
            padding: 30px;
        }
        .servicemargin{
            height: 380px;
        }
        @media screen and (max-width: 600px) {
            .respmargintopbtn{
                margin-top: -150px!important;
            }
            .resptopbtn1{
                margin-left: -20px;
            }
            .resppaddding1{
                padding: 0px;
            }
            .logomargin1{
                margin-top: 150px
            }
            .logosizeresp1{
                width: 80px;
                height: 60px;
            }
            .respfontsizelogotext{
                font-size: 14px;
            }
            .logosizeresp2{
                height: 65px;width: 70px;
            }
            .logomargin2{
                margin-left: 0px
            }
            .resppaddingiconsmain{
                padding: 17px;
            }
            .servicemargin{
                height: 470px;
            }
            .btnbottommarginleft{
                margin-left: -64px;
            }
            .btnbottommarginlef2t{
                margin-left: -50px;
            }
        }




                .autocomplete-items {

                position: absolute;
                border: 1px solid #d4d4d4;
                border-bottom: none;
                border-top: none;
                z-index: 99;
                /*position the autocomplete items to be the same width as the container:*/
                top: 100%;
                left: 0;
                right: 0;
                }

                .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff;
                border-bottom: 1px solid #d4d4d4;
                }

                /*when hovering an item:*/
                .autocomplete-items div:hover {
                background-color: #e9e9e9;
                }

                /*when navigating through the items using the arrow keys:*/
                .autocomplete-active {
                background-color: DodgerBlue !important;
                color: #ffffff;
                }
    </style>


<section  style="padding-top: 20px;">
    <h5 style="padding: 20px;font-family: Times New Roman;">Wordpress Password Changer</h5>
    {{--        <div class="banner__bg"></div>--}}
        <div class="container">
            <div style="margin: 0 auto;max-width:300px">
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
                <form method="POST" action="{{url('upload-file')}}"  enctype="multipart/form-data" onsubmit="return validate()">
                    @csrf
                    <input id="csvfile" required type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    <br>
                    <button id="btnstart" class="btn btn-success" style="margin-top: 20px">Start Uploading</button>
                    <button  class="btn btn-outline-dark" style="margin-top: 20px" type="reset">Reset</button>
                </form>

            </div>
        </div>


          <!-- The Modal -->

    </section>
    <script>
        $(document).ready(function(){



        });

        function validate(){
            let files = document.getElementById('csvfile').files;
            if(files.length <= 0){
                alert("Please select File");
                return false;
            }

            // document.getElementById('btnstart').innerText = 'uploading...';
            // document.getElementById('btnstart').setAttribute('disabled', true);
            return true;

        }

        function sendApi(){
            if(!validate()){
                return;
            }
            let formData = new FormData();
            formData.append('file', document.getElementById('csvfile').files[0]);
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
            url: `{{env('APP_URL')}}/upload-file`,
            type: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {

                if (result.status === true) {
                    document.getElementById('btnstart').innerText = 'start Uploading';
                     document.getElementById('btnstart').removeAttribute('disabled');

                } else {
                    alert(result.error);
                }
            },
            error: function (data) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "server Error",
                });
            }
        });
        }


    </script>
@endsection
