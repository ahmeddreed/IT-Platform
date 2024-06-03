@extends("layouts.dashboard")

@section("content")

<div class="container">
    <div class="row ">
        <div class="col-lg-8 col-md-8 mx-auto">
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
        <div class="col-lg-8 mx-auto">
            <div class="card shadow my-5">
                <div class="card-body mx-auto">
                    <form action="{{ route("settingsUpdate") }}" method="post">
                        @csrf
                        @method("put")
                        <div class="input-group my-3">
                            <h3 class="text-center text-primary">General Settings</h3>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id=""> Name</span>
                            <input type="text" class="form-control" name="name" value="{{ $dataOfSettings->wbesite_name }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                            <input type="text" class="form-control" name="title" value="{{ $dataOfSettings->wbesite_title }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default"> Descriptions</span>
                            <textarea type="text" class="form-control" name="descriptions"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">{{ $dataOfSettings->wbesite_descriptions }}</textarea>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default"> Copy Right</span>
                            <input type="text" class="form-control" name="copyRight" value="{{ $dataOfSettings->wbesite_copy_right }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                          </div>
                          <div class="input-group mb-3">

                            <button type="submit"class="btn btn-primary">Save</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
