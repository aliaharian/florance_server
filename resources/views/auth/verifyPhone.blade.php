<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name=”robots” content=”noindex,nofollow”>

    <title>تایید شماره همراه</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


    <!-- Main css -->
    <link rel="stylesheet" href="/css/login.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <style>
        #signin2 {
            text-decoration: none;
            color: white;
        }

        #signin2:hover {
            background-color: #d72521;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>

<div class="main">


    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="/images/loginBanner.jpeg" alt="تایید شماره همراه  "></figure>
                    {{--                    <a href="{{route('index')}}" class="signup-image-link">بازگشت به صفحه اصلی</a>--}}
                    <a class="signup-image-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        تغییر شماره همراه
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="signin-form" style="    margin-top: 16px;">
                    <h2 class="form-title text-md-center">تایید شماره همراه </h2>
                    <form method="POST" action="{{ route('user.verifyCode') }}" class="register-form" id="login-form">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <div>
                                <p>{{\Illuminate\Support\Facades\Auth::user()->phone}}</p>
                            </div>
                            <div>
                                <div onclick="sendCode()" class="btn btn-info">ارسال کد</div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="code"><i class="fa fa-code"></i></label>
                            <input type="tel" value="" name="code" id="code" required
                                   placeholder="کد دریافتی را وارد کنید"/>
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="fa fa-lock"></i></label>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit"
                                   value="تایید شماره همراه"/>
                            {{--                            <a href="/auth/google" style="background-color: #fd2c27;" id="signin2" class="form-submit"> تایید شماره همراه با گوگل <i class="fa fa-google"> </i></a>--}}
                        </div>
                    </form>
                    {{--<div class="social-login">--}}
                    {{--<span class="social-label">یا از این طریق وارد شوید: </span>--}}
                    {{--<ul class="socials">--}}
                    {{--<li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>--}}
                    {{--<li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>--}}
                    {{--<li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>

</div>

<!-- JS -->
<script src="https://arastowel.com/panel-admin/jquery/dist/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const sendCode = () => {
        $.ajax({
            url: "{{route('user.sendCode')}}",
            type: 'POST',
            data: {
                "phone": "{{\Illuminate\Support\Facades\Auth::user()->phone}}"
            },
            dataType: 'json',
            success: function (data2) {
                console.log(data2)
                if (data2.success === true) {
                    Swal.fire(
                        'تبریک',
                        'کد ارسال شد',
                        'success'
                    )
                }else{
                    Swal.fire(
                        'کد ارسال نشد',
                        data2.text,
                        'error'
                    )
                }
            },
            error: function (request, error) {
                console.log(request.responseJSON)
                console.log(error)
                Swal.fire(
                    'کد ارسال نشد',
                    `برای ارسال کد ${request.responseJSON.diff} ثانیه دیگر مجدد تلاش کنید`,
                    'error'
                )
            }
        });
    }
</script>
</body>
</html>
