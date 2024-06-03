@extends("layouts.main")
@section("content")
@php
    $webData = DB::table('general_settings')->find(1);
@endphp
  <!-- ======= Hero Section ======= -->
  <section dir="rtl" id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">{{ $webData->website_title }}</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">{{ $webData->website_descriptions }}</h2>
          <div data-aos="fade-up" data-aos-delay="600">

          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="blog/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main" class="my-5">

    <!-- ======= Courses Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">

        {{-- the alert message --}}
        <div class="col-lg-4 col-md-6 mx-auto mt-5">
            @if(Session::has("msg_s"))
                <div class="alert alert-success alert-dismissible fade show text-center fs-5" role="alert">
                    {{ Session::get("msg_s") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @elseif(Session::has("msg_e"))
            <div class="alert alert-warning alert-dismissible fade show text-center fs-5" role="alert">
                {{ Session::get("msg_e") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        @auth

            @if(auth()->user()->message_show == "on") {{-- the user active the message --}}
                @if (auth()->user()->specialty == null){{--select the specialty --}}
                    <div class="alert alert-light shadow alert-dismissible fade show text-center fs-5 my-5 p-5" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h3 class="text-warning">تنبيه </h3>
                        <div class="fs-4">
                            يمكننا عرض الكورسات الجيدة لك من خلال معرقة تخصصك , الرجاء تحديد تخصصك
                        </div>
                        <a href="{{ route("profile",["id"=>auth()->id()]) }}" class="btn btn-primary fs-5 mt-5">الذهاب الى الصفحة الشخصية</a>
                    </div>

                @else{{--select the specialty --}}
                    <div class="alert alert-light shadow alert-dismissible fade show text-center fs-5 my-5 p-5" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h3 class="text-warning">تنبيه </h3>
                        <div class="fs-4">
                            اذا تريد ان نعرض لك الكورسات الحسب تخصصك الضغط على زر الذهاب
                        </div>
                        <a href="{{ route("coursesBySpecialty",["id"=>auth()->user()->specialty]) }}" class="btn btn-primary fs-4 mt-5">الذهاب</a>
                    </div>
                @endif
            @endif

        @endauth

        <header class="section-header">
            <p>خارطة البرمجة</p>
          </header>

        <div dir="ltr" class="row mb-5">

            <div class="col-lg-6">
              <img src="{{ asset("blog/img/features.png") }}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
              <div class="row align-self-center gy-4">

                <div dir="rtl" class="col-md-12" data-aos="zoom-in" data-aos-delay="200">
                  <div class="feature-box d-flex align-items-end ">
                    <h3 class="p-3 ">
                        لتعلم البرمجة بشكل الافضل نقدم لكم خارطة او مسار لتعلم البرمجة من خلاله يمكنك تحديد المجال او التخصص الذي يناسبك
                    </h3>
                  </div>
                </div>

                <div class="col-md-10 mx-auto  d-flex justify-content-end" data-aos="zoom-in" data-aos-delay="200">
                    <a href="{{ route("proMap") }}" class="btn btn-primary fs-4">عرض</a>
                </div>

              </div>
            </div>

        </div> <!-- / row -->
        <div class="my-5">
            <br>
        </div>


        <header class="section-header mt-5">
          <p>كورسات</p>
        </header>


        @if (!empty($courses[0]))
            <div class="row">
                <div class="col-lg-4  mt-3 mb-5">
                    <form action="{{ route("search") }}" method="POST">
                        @csrf
                        @method("post")
                        <div class="input-group">
                            <input type="text" name="search" class="form-control bg-light border-0 small @error('search') is-invalid  @enderror" placeholder=" بحث...">
                            <div class="input-group-append">
                                <button class="btn btn-primary fs-5" type="submit">
                                    بحث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="row">

            @if (!empty($courses[0]))
                @foreach ($courses as $course)
                    <div class="col-lg-4  mt-3">
                        <div class="post-box">
                            <div class="post-img">
                                @if($course->image != null)
                                    <img src="storage/CoursePhoto/{{ $course->image }}" class="img-fluid" alt="">
                                @else
                                    <img src="blog/img/blog/blog-1.jpg" class="img-fluid" alt="">
                                @endif

                            </div>
                            <span class="post-date">{{ $course->created_at }}</span>
                            <div>
                                <a href="{{ route("showDetails",["id"=> $course->id ]) }}" class="readmore fs-3 mt-auto">
                                    <h3 class="post-title">{{ $course->name }}</h3>
                                </a>
                            </div>
                            <div class="fs-4 title">
                                {{ $course->title }}
                            </div>

                            <div class="post-footer ">
                                @auth
                                    @livewire("like", ["course_id"=>$course->id])
                                    {{-- <span class="text-primary btn"><i class="fs-3 bi bi-chat-fill"></i></span> --}}
                                    <span class="text-primary btn d-inline">
                                        <a href="{{ route("comment",["course_id"=> $course->id ]) }}" class="readmore d-inline mt-auto">
                                            <i class="fs-3 bi bi-chat d-inline"></i></i>
                                        </a>
                                    </span>
                                @endauth
                            </div>
                        </div>
                    </div>

                @endforeach
                <div class="mx-auto">
                    <div class="m-5">{{ $courses->links() }}</div>
                </div>
            @else
                <div class="text-center text-primary">
                    <h3 class="m-5">لا يوجد كورسات حاليا</h3>
                </div>
            @endif


        </div>

      </div>

    </section><!-- End Recent Blog Posts Section -->

  </main><!-- End #main -->


@endsection
