@extends("layouts.main")

@section('content')

<main id="main ">
    <!-- ======= Blog Single Section ======= -->
    <section id="blog " class="blog my-5">
        <div class="container" data-aos="fade-up">

            {{-- the alert message --}}
            <div class="col-lg-8 col-md-6 mx-auto mt-5">
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
          <div class="row">

            <div class="col-lg-8 entries mx-auto">

              <article class="entry entry-single">

                <div class="entry-img">
                    @if($courseData->image != null)
                        <img src="{{ asset("storage/CoursePhoto/$courseData->image") }}" alt="" class="img-fluid">
                    @else
                        <img src="{{ asset("blog/img/blog/blog-1.jpg") }}" alt="" class="img-fluid">
                    @endif
                </div>

                <h2 class="entry-title">
                  <a>{{ $courseData->name }}</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a>
                        {{ DB::table("users")->where("id",$courseData->user_id)->first()->name }}
                    </a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a ><time datetime="2020-01-01">
                        {{ $courseData->created_at }}
                    </time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a>
                        {{ $comments->count() }} Comments
                    </a></li>
                  </ul>
                </div>



              </article><!-- End blog entry -->



              <div class="blog-comments">

                <h4 class="comments-count"> {{ $comments->count() }} Comments</h4>
                @if ($comments->count() == 0)
                    <h3 class="text-center m-5">لايوجد تعليقات</h3>
                @else

                @endif
                @foreach ($comments as $item)
                    <div id="comment-1" class="comment"><!-- Comment  -->
                        <div class="d-flex">
                            <!--Comment of user Auth -->
                           @if( $item->comment(Auth()->id(),$item->user_id))
                           <!--Delete Comment  -->
                           <form action="{{ route("DelComment",["id" =>$item->id ,"course_id" => $courseData->id]) }}" method="post">
                                @csrf
                                @method("post")
                                <button type="submit" class="btn">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </form>
                           @else

                           @endif

                        <div class="comment-img">
                            @php
                                $userImage = DB::table('users')->find($item->user_id)->picture;//Get Image Of User
                            @endphp
                            @if ($userImage !=null)
                                <img class="img-profile rounded-circle" src="{{ asset("storage/UserPhoto/".$userImage) }}" alt="">
                            @else
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            @endif

                        </div>

                        <div>
                            <time >{{ $item->created_at }}</time>
                            <p class="m-3">
                            {{ $item->comment }}
                            </p>
                        </div>
                        </div>
                    </div><!-- End comment  -->
                @endforeach


                @auth
                    <div class="reply-form">
                    <h4>اضافة تعليق</h4>
                    <form action="{{ route("AddComment",["course_id"=>$courseData->id]) }}" method="POST" >
                        @method("post")
                        @csrf
                        <div class="row">
                        <div class="col form-group">
                            <textarea name="comment" class="form-control @error('comment') is-invalid  @enderror" placeholder="تعليقك">{{ old('comment') }}</textarea>
                            @error('comment')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary fs-5">اضافة</button>

                    </form>
                    </div>
                @endauth


              </div><!-- End blog comments -->

            </div><!-- End blog entries list -->


          </div>

        </div>
      </section><!-- End Blog Single Section -->

    </main><!-- End #main -->

@endsection
