@extends("layouts.main")

@section('content')
<section id="features" class="features">

    <div class="container mt-5" data-aos="fade-up">

      <header class="section-header">
        <p class="pb-4">خارطة البرمجة</p>
        <h3>اختر التخصص الذي يناسبك وبعدها ادخل الى قسم الكورسات وشترك بالكورس الذي يناسب التخصص الذي اخترته</h3>
      </header>



      <!-- Feature Tabs -->
      <div class="row feture-tabs" data-aos="fade-up">
        <div class="col-lg-12">


          <!-- Tabs -->
            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills mb-3 ">
                    @foreach ($specialties as $specialty)
                        <li>
                            <a class="nav-link " data-bs-toggle="pill" href="#idOfSpecialty{{ $specialty->id }}">{{ $specialty->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
          <!-- End Tabs -->

          <!-- Tab Content -->
          <div class="tab-content">
            @foreach ($specialties as $specialty)
                <div class="tab-pane fade show " id="idOfSpecialty{{ $specialty->id }}">
                    <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-check2"></i>
                    <h4 class="fs-4 fw-bold">{{ $specialty->name }}</h4>
                    </div>
                    <p class="fs-5 mt-0 mb-5">
                        @if($specialty->descriptions)
                            {{ $specialty->descriptions }}
                        @else
                          لأ يوجد وصف حتى الان
                        @endif
                    </p>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-check2"></i>
                        <h4 class="fs-4 fw-bold">فروع التخصص</h4>
                    </div>
                    @php
                        $specialtyBranch = DB::table("branches")->where("sp_id",$specialty->id)->get();
                    @endphp
                        {{-- Fetch All Branches Of This Specialty --}}
                        @if($specialtyBranch)
                            @foreach ($specialtyBranch as $branch)
                            <div class="my-4">
                                <p class="fs-5 fw-bold mb-1 text-primary">
                                    {{ $branch->name }}
                                </p>
                                @if($branch->descriptions)
                                    {{ $branch->descriptions }}
                                @else
                                <p class="fs-5">
                                     لأ يوجد وصف حتى الان
                                </p>

                                @endif
                            </div>
                            @endforeach
                        @else
                        <p class="fs-5">
                             لأ يوجد فروع حتى الان
                        </p>
                        @endif

                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-check2"></i>
                        <h4 class="fs-4 fw-bold">اشهر اللغات المستخدمة في فروع  هذا التخصص</h4>
                    </div>
                    @if($specialtyBranch)
                        @foreach ($specialtyBranch as $branch)
                            <p class="fs-5 fw-bold text-primary">
                                {{ $branch->name }}
                            </p>

                            @php
                                //get the Languages Joined with This branch
                                $language_to_branches = DB::table("language_to_branches")->where("branch_id",$branch->id)->get();
                                $languages =[];
                                foreach ($language_to_branches as $l_to_b ){//Fetch the Language of This Branch
                                    $languages[] = DB::table("languages")->where("id",$l_to_b->language_id)->first();
                                }
                            @endphp

                        <p class="mt-1 mb-4 fs-5 fw-bold">
                            (
                            {{--this branch have the languages --}}
                            @if($languages)
                                @foreach ($languages as $language )
                                    <span dir="ltr" class="">{{ $language->name }},</span>
                                @endforeach

                            {{--this branch have not the languages --}}
                            @else
                            <span class=""> لأ يوجد لغات حتى الان </span>
                            @endif

                            )
                        </p>
                        @endforeach
                    @endif
                </div>
            @endforeach

          </div><!-- End Tab Content -->

        </div>

      </div><!-- End Feature Tabs -->

    </div>

  </section><!-- End Features Section -->

  @endsection
