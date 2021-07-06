

@extends('layouts.landing-app')
@section('content')


    <section class="faq-area mt-30" style="margin-top: 200px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <h2 style="text-align: center;">CONTACT US</h2>

                </div>
            </div> <!-- row -->
            <p style="margin-top: 40px">
                Feel free to email our technical support with feedback and questions. We will try to respond within 24 hours. If you are missing an email from us please check your junk folder before emailing again.
                <br>
                If you would like your products to be featured on our Diskode website, please provide us with the influencers name/company name, product name, promocode, and a website or link to their social media or channel.
<div class="trustedsite-trustmark" data-type="211" data-width="120"  data-height="50"></div>
            </p>
            <form method="post" action="{{url("/sendmessage")}}" onsubmit="return validateForm()">
                {{csrf_field()}}
                <div class="container">
                    <div class="row" style="padding-top: 50px">
                        <div class="col-lg-6">
                            <div>
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
                                    {{-- <h6 class="title" style="font-size: 30px!important;margin-top: 10px">CONTACT <span>US</span>
                                    </h6> --}}
                            </div>
                            <div class="login-form">
                                <div class="input-box">
                                    <input type="text" placeholder="Name*" name="name" required>
                                </div>
                                <div class="input-box mt-30">
                                    <input type="email" placeholder="Email*" name="email" required>
                                </div>
                                <div class="input-box mt-30">
                                    <input type="text" placeholder="Subject*" name="subject" required>
                                </div>
                                <div class="input-box mt-30">
                                    <textarea type="text" class="form-control" placeholder="Message*" name="message" required></textarea>
                                </div>


                                <div style="margin-top: 20px">
                                    <button type="submit" class="btn btn-primary" style>
                                        SUBMIT
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div style="margin-top: 100px;margin-left: 50px">
                                {{-- <div style="padding: 5px;">
                                    Phone : <a href="tel:{{env('APP_PHONE')}}">{{env('APP_PHONE')}}</a>
                                </div> --}}
                                <div style="padding: 5px;">
                                    EMAIL : <a href="mailto:diskode.help@gmail.com">diskode.help@gmail.com</a>
                                </div>
                                <div style="padding: 5px;">
                                    Instagram : _Diskode <br>
                                </div>
                                <div style="padding: 5px;">
                                    Support : <a href="https://www.patreon.com/_Diskode" target="_blank">patreon.com/_Diskode</a> <br>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>

    <script>
        function validateForm()
        {
            var v = grecaptcha.getResponse();
            if(v.length === 0)
            {
                document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
                return false;
            }
            else
            {
                document.getElementById('captcha').innerHTML="Captcha completed";
                return true;
            }
        }
    </script>


@endsection
