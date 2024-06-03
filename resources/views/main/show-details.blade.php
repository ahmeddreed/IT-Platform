@extends("layouts.main")

@section('content')
        <!-- ======= Portfolio Details Section ======= -->
        <section dir="ltr" id="portfolio-details" class="portfolio-details mt-5 pt-5">
            <div class="container">

            {{-- the alert message --}}
            <div class="col-lg-12 col-md-6 mx-auto mt-5">
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
            <div class="row gy-4">
                <div class="col-lg-7">
                  <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                      <div class="swiper-slide">
                        @if($course->image != null)
                            <img src="{{ asset("storage/CoursePhoto/$course->image") }}" alt="">
                        @else
                            <img src="{{ asset("blog/img/portfolio/portfolio-1.jpg") }}" alt="">
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div dir="rtl" class="col-lg-5">
                  <div  class="portfolio-info">
                    <h3>معلومات الكورس</h3>
                    <ul>
                      <li class="fs-5"><strong> اسم الكورس</strong>:<span> {{ $course->name }}</span></li>
                      <li class="fs-5"><strong> نوع الكورس</strong>: <span>{{ ($course->state == "FW"?"اطار عمل":"اساسيات") }}</span></li>
                      <li class="fs-5"><strong> التخصص</strong>: <span>{{ $specialty_name }}</span></li>
                      <li class="fs-5"><strong> الفرع</strong>: <span>{{ $branch_name }}</span></li>
                      <li class="fs-5"><strong> لغة المستخدمة</strong>: <span>{{ $language_name }}</span></li>
                    </ul>
                    <label class="rating-label fs-5"><strong> تقييم الكورس:</strong>
                        <input
                        name="number"
                        class="rating my-2"
                        max="5"
                        step="0.25"
                        style="--value:{{ $ratingAVG }}"
                        type="range"
                        value="">
                      </label>
                  </div>
                  <div class="portfolio-description my-5">
                    <h2>تفاصيل الكورس</h2>
                    <p class="fs-4">
                      {{ $course->description }}
                    </p>
                  </div>
                </div>
                <div dir="rtl" class="col-lg-12">
                    {{-- Register Of Course --}}
                    @auth
                        @if($register->check(auth()->id(),$course->id)){{-- Registered --}}

                        <div class="card shadow p-3">
                          <div class="row ">
                            <h2 class="text-center text-success m-3"> انت مشترك في هذا الكورس </h2>

                            <div class="col-lg-4 my-3">
                              <div class="card shadow">
                                <div class="card-body">
                                  <img src="{{ asset("course/b.jpg") }}" alt=""  class="card-img-top">
                                  <h4 class="p-3 text-primary bold">اساسيات  لغة ({{ $language_name }})</h4>
                                  <a target="_blanck"  href="https://www.youtube.com/results?search_query=اساسيات+{{ $language_name }}&sp=EgIQAw%253D%253D" class="btn btn-primary fs-5">مشاهدة</a>
                                </div>
                              </div>
                            </div>

                            @if($course->state == "FW")
                                <div class="col-lg-4 my-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                    <img src="{{ asset("course/fw.jpg") }}" alt=""  class="card-img-top">
                                    <h4 class="p-3 text-primary bold"> اساسيات اطار العمل ({{ $course->name }})</h4>
                                    <a target="_blanck"  href="https://www.youtube.com/results?search_query=اساسيات+{{ $language_name }}+{{ $course->name }}&sp=EgIQAw%253D%253D" class="btn btn-primary fs-5">مشاهدة</a>
                                    </div>
                                </div>
                                </div>
                            @endif

                            <div class="col-lg-4 my-3">
                              <div class="card shadow">
                                <div class="card-body">
                                  <img src="{{ asset("course/a.jpg") }}" alt=""  class="card-img-top">
                                  <h4 class="p-3 text-primary bold">مشروع بالغة العربية</h4>
                                  <a target="_blanck"  href="https://www.youtube.com/results?search_query=انشاء مشروع+{{ $language_name }}+{{ $course->name  }}&sp=EgIQAw%253D%253D" class="btn btn-primary fs-5">مشاهدة</a>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-4 my-3">
                              <div class="card shadow">
                                <div class="card-body">
                                  <img src="{{ asset("course/e.jpg") }}" alt=""  class="card-img-top">
                                  <h4 class="p-3 text-primary bold">مشروع بالغة الانكليزية</h4>
                                  <a target="_blanck" href="https://www.youtube.com/results?search_query=create+a+project+useing+{{ $language_name }}+{{ $course->name }}&sp=EgIQAw%253D%253D" class="btn btn-primary fs-5">مشاهدة</a>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12 d-flex my-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    هل تريد اضافة تقييم لهذا لاكورس
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    <button type="button" class="btn-close m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="modal-body">
                                            <h3 class="text-center text-primary my-3">اضافة تقييمك</h3>

                                            <div class="my-3 mx-auto d-flex justify-content-center">
                                                <label class="rating-label">
                                                    <form action="{{ route("addRating",["id"=>$course->id]) }}" method="post">
                                                        @csrf
                                                        @method("post")
                                                        <input
                                                        name="number"
                                                        class="rating"
                                                         max="5"
                                                         oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)"
                                                        step="0.5"
                                                        style="--value:{{ $rating->userRating(auth()->id(),$course->id) }}"
                                                        type="range"
                                                        value="">
                                                        <button type="submit" class="btn btn-primary mt-5  d-flex justify-content-end fs-5">اضافة </button>
                                                    </form>
                                                  </label>
                                            </div>
                                        </div>

                                    </div>
                                    </div>
                                </div>

                              <form class="" action="{{ route("unRegister",["cours_id"=> $course->id]) }}" method="post">
                                  @csrf
                                  @method('post')
                                  <button type="submit" class="btn btn-danger fs-5 mx-5"> الغاء اشتراك</button>
                              </form>
                            </div>

                        </div>
                      </div>


                        @else{{-- Not Registered --}}
                            <form action="{{ route("courseRegister",["cours_id"=> $course->id]) }}" method="post">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-primary fs-5">اشتراك</button>
                            </form>
                        @endif
                    @endauth

                    @guest
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            اشتراك
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                <p class="text-center text-primary fs-3 m-4"> الرجاء تسجيل دخول اولاّ </p>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fs-5" data-bs-dismiss="modal">اغللاق</button>
                                <a href="{{ route("login") }}" class="btn btn-primary fs-5">تسجيل الدخول</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    @endguest
                </div>

              </div>

            </div>
          </section><!-- End Portfolio Details Section -->
@endsection
