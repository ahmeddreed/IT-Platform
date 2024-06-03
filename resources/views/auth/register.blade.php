<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IT platform</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset("dashboard/vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset("dashboard/css/sb-admin-2.min.css") }}" rel="stylesheet">

</head>

<body dir="rtl" class="bg-gradient-primary">

    <div class="container">


        {{-- the alert message --}}
        <div class="col-lg-4 col-md-6 mx-auto mt-5">
            @if(Session::has("msg_s"))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ Session::get("msg_s") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @elseif(Session::has("msg_e"))
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                {{ Session::get("msg_e") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">انشاء حساب جديد</h1>
                                    </div>
                                    <form class="user" action="{{ route("createUser") }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid  @enderror"
                                                placeholder=" الاسم الكامل"
                                                value="{{ old('name') }}">
                                                @error('name')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid  @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="البريد الالكتروني"
                                                value="{{ old('email') }}">
                                                @error('email')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control rounded-pill @error('password') is-invalid  @enderror"
                                                id="exampleInputPassword" placeholder="الرمز لاسري"
                                                value="{{ old('password') }}">
                                                @error('password')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                        </div>
                                        <div  class="form-group">
                                            <select name="specialty"  class="form-select form-control  @error('specialty') is-invalid  @enderror" aria-label="Default select example">
                                                <option selected>Specialty</option>
                                                @foreach ($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('specialty')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select name="gender" class="form-select form-control  rounded-pill @error('gender') is-invalid  @enderror" >
                                                <option selected>الجنس </option>
                                                <option value="m">ذكر</option>
                                                <option value="f">انثى</option>
                                              </select>
                                              @error('gender')
                                              <small class="text-danger">
                                                  {{ $message }}
                                              </small>
                                              @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="photo" class="form-control rounded-pill mt-2 @error('photo') is-invalid  @enderror">
                                            @error('photo')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            تسجيل
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route("login") }}">انا امتلك حساب</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset("dashboard/vendor/jquery/jquery.min.js") }}"></script>
    <script src="{{ asset("dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset("dashboard/vendor/jquery-easing/jquery.easing.min.js") }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset("dashboard/js/sb-admin-2.min.js") }}"></script>


</body>

</html>
