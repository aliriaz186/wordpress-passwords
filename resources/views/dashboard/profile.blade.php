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
        <h3 style="letter-spacing: 3px" class="mt-4 mb-3">CHANGE PASSWORD</h3>


        <form method="post" action="{{url("/change-password")}}" >
            {{csrf_field()}}


            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Old Password*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="password" class="form-control" placeholder="Enter Old Password" name="oldpassword" id="oldpassword" required>
                </div>
            </div>
            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">New Password*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="password" class="form-control" placeholder="Enter New Password" name="newpassword" id="oldpassword" required>
                </div>
            </div>
            <div class="form-group row" style="width: 600px;margin-top: 30px;margin-bottom: 30px">
                <div class="col-lg-4">
                    <label for="email">Confirm New Password*:</label>
                </div>
                <div class="col-lg-8">
                    <input type="password" class="form-control" placeholder="Confirm New Password" name="confirmnewpassword" id="oldpassword" required>
                </div>
            </div>



            <div class="form-group">
                <button type="submit" id="btnFetch" class="btn btn-primary">
                    Change Password
                </button>
            </div>
        </form>
    </div>

@endsection
