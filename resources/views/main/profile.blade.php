@extends("layouts.main")

@section('content')

<div class="container mt-5 p-5">
    {{-- the alert message --}}
    <div class="col-lg-8 col-md-6 mx-auto my-5">
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
    <div class="row mb-5">
        <div class="col-lg-8 col-sm-10 mt-5 mx-auto">

           <div class="card shadow">
                <div class="card-body">
                    <div class="position-relative mb-5">
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <div class="d-flex justify-content-center">
                                @if($user->picture !=null)
                                    <img src="{{ asset("storage/UserPhoto/$user->picture") }}" alt="" class="img-fluid rounded-circle w-sm-75 w-50 ">
                                @else
                                    <img src="{{ asset("blog/img/blog/blog-1.jpg") }}" alt="" class="img-fluid rounded-circle w-sm-75 w-50 ">
                                @endif

                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class="row mt-5">
                        <div class="col-lg-5 mx-auto">
                            <p class="text-center">
                                <span class="fs-4">{{ $user->name }}</span>
                            </p>
                            <p class="text-center">
                                <span class="fs-5">
                                    @if ($user->role_id == 1)
                                        Super Admin
                                    @elseif ($user->role_id == 2)
                                        Admin
                                    @else
                                        User
                                    @endif

                                </span>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="icon px-5 text-center ">
                        {{-- Social media Icons --}}
                        @if($dataProfile->facebook !=null)
                            <a href="{{ $dataProfile->facebook }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook text-primary fs-5 px-5"></i></a>
                        @else
                            <a rel="noopener noreferrer"><i class="bi bi-facebook text-secondary fs-5 px-3"></i></a>
                        @endif

                        @if($dataProfile->youtube !=null)
                            <a href="{{ $dataProfile->youtube }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube text-danger fs-5 px-5"></i></a>
                        @else
                            <a  rel="noopener noreferrer"><i class="bi bi-youtube text-secondary fs-5 px-3"></i></a>
                        @endif

                        @if($dataProfile->instagram !=null)
                            <a href="{{ $dataProfile->instagram }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram text-danger fs-5 px-5"></i></a>
                        @else
                            <a  rel="noopener noreferrer"><i class="bi bi-instagram text-secondary fs-5 px-3"></i></a>
                        @endif

                    </div>
                </div>

            </div>
        </div>{{--  first col --}}

        <div class="col-lg-8  col-sm-10 mt-5 card shadow mx-auto p-3">

            <ul class="nav nav-tabs mx-auto px-2" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active fs-4" id="myData-tab" data-bs-toggle="tab" data-bs-target="#myData" type="button" role="tab" aria-controls="home" aria-selected="true">بياناتي </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fs-4" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="false">الكورسات</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link fs-4" id="contact-tab" data-bs-toggle="tab" data-bs-target="#editData" type="button" role="tab" aria-controls="editData" aria-selected="false">تعديل البيانات</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">

                {{-- My Data --}}
                <div class="tab-pane fade show active" id="myData" role="tabpanel" aria-labelledby="myData-tab">
                    <div class="row mx-auto">
                        <div class="col-lg-8  mt-3 mx-auto">
                            <div class="card border-0">
                                <div class="card-body">
                                    <p class="fs-5"><strong> اسم الكامل</strong>: {{ $user->name }}</p>
                                    <p class="fs-5"><strong> البريد الالكتزوني</strong>: {{ $user->email }}</p>
                                    <p class="fs-5"><strong> الجنس </strong>: {{ $user->gender == "m"?"ذكر" :"انثى" }}</p>
                                    <p class="fs-5"><strong> التخصص </strong>: {{$specialty}}</p>
                                    <hr>
                                    <p class="fs-5"><strong> نبذة التعريفية </strong>: {{ $dataProfile->bio }} </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{--End My Data --}}

                {{-- My courses --}}
                <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                   <div class="row my-3">
                    @foreach($courses as $course)
                        <div class="col-lg-4 mx-auto p-3">
                            <div class="card shadow text-center">
                                <div class="card-title mt-3">{{ $course->name }}</div>
                                <div class="card-body">
                                    <a href="{{ route("showDetails",["id"=> $course->id ]) }}" class="btn btn-primary fs-5">مشاهدة</a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                   </div>
                </div>
                {{--End My courses --}}

                {{-- Edit My Data --}}
                <div class="tab-pane fade" id="editData" role="tabpanel" aria-labelledby="editData">

                        <h3>بياناتي العامة</h3>
                        <hr>
                        <form class="p-3" action="{{ route("updateUser",["id"=>auth()->id()]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label fs-5">الاسم الكامل</label>
                              <div class="col-md-8 col-lg-9">
                                <input type="text" name="name" value="{{ auth()->user()->name }}"  class="form-control @error('name') is-invalid  @enderror " id="yourName" >

                                @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="company" class="col-md-4 col-lg-3 col-form-label fs-5">الايميل</label>
                              <div class="col-md-8 col-lg-9">
                                <input type="email" name="email" value="{{ auth()->user()->email }}"  class="form-control @error('email') is-invalid  @enderror" id="yourEmail" required>

                                @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Job" class="col-md-4 col-lg-3 col-form-label fs-5">الصورة الشخصية</label>
                              <div class="col-md-8 col-lg-9">
                                <input type="file" name="picture" class="form-control @error('picture') is-invalid  @enderror"  >
                                @error('picture')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Country" class="col-md-4 col-lg-3 col-form-label fs-5">الجنس</label>
                              <div class="col-md-8 col-lg-9">
                                <select class="form-select fs-5 @error('gender') is-invalid  @enderror" name="gender" aria-label="Default select example">
                                    @if(auth()->user()->gender == 'm')
                                        <option class=" fs-5" value="m">ذكر</option>
                                        <option class=" fs-5" value="f">انثى</option>
                                    @else
                                        <option class=" fs-5" value="f">انثى</option>
                                        <option class=" fs-5" value="m">ذكر</option>

                                    @endif
                                </select>

                                    @error('gender')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                              </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Country" class="col-md-4 col-lg-3 col-form-label fs-5">هل تريد عرض رسالة النتبيه</label>
                                <div class="col-md-8 col-lg-9">
                                  <select class="form-select fs-5 @error('message_show') is-invalid  @enderror" name="message_show" aria-label="Default select example">
                                      @if(auth()->user()->message_show == 'on')
                                          <option class=" fs-5" value="on">نعم</option>
                                          <option class=" fs-5" value="off">لا</option>
                                      @else
                                        <option class=" fs-5" value="off">لا</option>
                                        <option class=" fs-5" value="on">نعم</option>
                                      @endif
                                  </select>

                                      @error('message_show')
                                      <small class="text-danger">
                                          {{ $message }}
                                      </small>
                                      @enderror
                                </div>
                              </div>

                            <div class="row mb-3">
                                <label for="Country" class="col-md-4 col-lg-3 col-form-label fs-5">التخصص</label>
                                <div class="col-md-8 col-lg-9">
                                  <select class="form-select fs-5 @error('specialty_id') is-invalid  @enderror" name="specialty_id" aria-label="Default select example">
                                        @if (auth()->user()->specialty== "")
                                            <option class=" fs-5" value="">اختر التخصص</option>
                                        @endif

                                        @foreach ($specialties as $item)
                                            @if(auth()->user()->specialty == $item->id)
                                                <option class=" fs-5" value="{{ $item->id }}">{{ $item->name }}</option>
                                                <option class=" fs-5" value="">ازالة التخصص</option>
                                            @else
                                                <option class=" fs-5" value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                       @endforeach
                                  </select>
                                      @error('specialty_id')
                                      <small class="text-danger">
                                          {{ $message }}
                                      </small>
                                      @enderror
                                </div>
                              </div>

                            <div class="text-center">
                              <button type="submit" class="btn btn-primary my-3" >حفظ</button>
                            </div>
                          </form><!-- End User Edit Form -->

                          <hr/>
                          <h3 class=" my-3">تعديل بيانات ملف الشخصي</h3>
                        <!-- Profile Edit Form -->
                        <form class="p-3" action="{{ route("updateProfileData",["id"=>$dataProfile->id]) }}" method="POST">

                          @csrf
                          @method('put')
                            <div class="row mb-3">
                                <label for="about" class="col-md-4 col-lg-3 col-form-label fs-5">نبذة التعريفية</label>
                                <div class="col-md-8 col-lg-9">
                                    <textarea name="bio" class="form-control @error('bio') is-invalid  @enderror" id="about" style="height: 100px">{{ $dataProfile->bio }}</textarea>
                                    @error('bio')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="Facebook" class="col-md-4 col-lg-3 col-form-label fs-5">رابط صفحة الفيس بوك</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="face_link" type="text"  class="form-control @error('face_link') is-invalid  @enderror" id="Facebook" value="{{ $dataProfile->facebook }}">
                                    @error('face_link')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Instagram" class="col-md-4 col-lg-3 col-form-label fs-5">رابط صفحة الانستاكرام</label>
                                <div class="col-md-8 col-lg-9">
                                <input name="insta_link" type="text" class="form-control @error('insta_link') is-invalid  @enderror" id="Instagram" value="{{ $dataProfile->instagram }}">
                                @error('insta_link')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label fs-5">رابط قناة اليوتيوب</label>
                                <div class="col-md-8 col-lg-9">
                                <input name="youtube_link" type="text" class="form-control @error('youtube_link') is-invalid  @enderror" id="youtube" value="{{ $dataProfile->youtube }}">
                                @error('youtube_link')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-3">حفظ</button>
                            </div>
                            </form><!-- End Profile Edit Form -->

                </div>{{--End Edit My Data --}}

              </div>

        </div>


    </div>

</div>
@endsection
