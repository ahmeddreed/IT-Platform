@extends("layouts.main")
@section("content")


<main id="main" class="my-5">

    <!-- ======= Courses Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">


        <header class="section-header">
          <p>كورسات</p>
        </header>


        <div class="row">

            @if (!empty($hesCourses[0]))
                @foreach ($hesCourses as $course)
                    <div class="col-lg-4  mt-3">
                        <div class="post-box">
                            <div class="post-img">
                                {{-- {{ dd($course->image) }} --}}
                                @if($course->image != null)
                                    <img src="{{ asset("storage/CoursePhoto/$course->image")  }}" class="img-fluid" alt="">
                                @else
                                    <img src="{{ asset("blog/img/blog/blog-1.jpg") }}" class="img-fluid" alt="">
                                @endif

                            </div>
                            <span class="post-date">{{ $course->created_at }}</span>
                            <div>
                                <a href="{{ route("showDetails",["id"=> $course->id ]) }}" class="readmore  mt-auto">
                                    <h4 class="post-title">{{ $course->name }}</h4>
                                </a>
                                <div class="fs-4 title">
                                    {{ $course->title }}
                                </div>
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
                {{-- <div class="mx-auto">
                    <div class="m-5">{{ $hesCourses->links() }}</div>
                </div> --}}
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
