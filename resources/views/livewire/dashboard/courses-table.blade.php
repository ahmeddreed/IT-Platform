<div class="container">
    <h3 class="text-primary m-5">Courses Table</h3>
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

    @if($cTable)
    {{-- the Table  --}}
    <div class="card shadow">
        <div class="card-body ">
            <!-- Topbar Search -->
            <div class="m-3 d-flex ">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-3 my-md-0 mw-100 navbar-search ">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search"  aria-describedby="basic-addon2"
                            wire:model='search'
                            >
                        <div class="input-group-append">
                        </div>
                    </div>
                </form>

                <div  class="">
                    <button class="btn btn-primary" wire:click='showAddForm'><i class="fas fa-fw fa-plus"></i></button>
                </div>
            </div>

            @if(!empty($courses))

            <div class="table-responsive">
                <table class="table table-hover border ">
                    <thead class="table-primary">
                        <tr >
                            <th scope="row">#</th>
                            <td>Course Name</td>
                            <td>Course Title</td>
                            <td>Branch</td>
                            <td>Language</td>
                            <td>State</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody class>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($courses as $course)
                            <tr>
                                <th scope="row">{{ $num++ }}</th>

                                <td>{{ $course->name }}</td>
                                <td>{{ $course->title }}</td>
                                <td>
                                    {{ DB::table("branches")->where("id",$course->br_id)->first()->name }}
                                </td>
                                <td>
                                    {{ DB::table("languages")->where("id",$course->lg_id)->first()->name }}
                                </td>
                                <td>{{ $course->state }}</td>
                                <td>
                                    <p class="d-inline ml-3 btn" wire:click='showUpdateForm({{ $course->id }})'><i class="fas fa-pen text-warning"></i></p>
                                    <p class="d-inline ml-3 btn" wire:click='showDeleteMessage({{ $course->id }})'><i class="fas fa-trash text-danger"></i></p>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                </table>
            </div>
            @else
                <h3 class="text-primary m-5 text-center">لا يوجد بيانات</h3>
            @endif


        </div>
        <div class="mx-auto">
            <div class="my-3 ">{{ $courses->links() }}</div>
        </div>
    </div>
    {{-- end the Table --}}
    @endif


    @if($addForm)
    {{-- Add Form --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4 text-primary">Add a New Course</h1>
                        </div>
                        <form class="user" wire:submit.prevent='createCourse'  enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label  class="form-label">Name</label>
                                <input type="text" name="name" wire:model='name' class="form-control @error('name') is-invalid  @enderror"
                                    placeholder=" Name"
                                    value="{{ old('name') }}">
                                    @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label  class="form-label">Title</label>
                                <input type="text" name="title" wire:model='title' class="form-control @error('title') is-invalid  @enderror"
                                    placeholder=" Title"
                                    value="{{ old('title') }}">
                                    @error('title')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                    <textarea wire:model='description' class="form-control @error('description') is-invalid  @enderror" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                                    @error('description')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>

                            <div  class="form-group">
                                <label  class="form-label">Branch</label>
                                <select name="br_id" wire:model='br_id' class="form-select form-control  @error('br_id') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach

                                </select>
                                @error('br_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="form-label">Language</label>
                                <select name="lg_id" wire:model='lg_id' class="form-select form-control  @error('lg_id') is-invalid  @enderror" >
                                    <option selected>Language </option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                </select>
                                @error('lg_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="form-label">State</label>
                                <select name="state" wire:model='state' class="form-select form-control  @error('state') is-invalid  @enderror" >
                                    <option selected>State </option>
                                    <option value="normal">Normal</option>
                                    <option value="FW">FW</option>
                                    <option value="book">Book</option>
                                </select>
                                @error('state')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="form-label">Image</label>
                                <input type="file" name="image" wire:model='image' class="form-control mt-2 @error('image') is-invalid  @enderror">
                                @error('image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                                <a wire:click='canncel' class="btn btn-secondary">
                                    Canncel
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end Add form --}}
    @endif


    @if($updateForm)
    {{-- Update Form --}}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 text-primary">Update the Data of Course</h1>
                            </div>
                            <form class="user" wire:submit.prevent='updateCourse'  enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label  class="form-label">Name</label>
                                    <input type="text" name="name" wire:model='name' class="form-control @error('name') is-invalid  @enderror"
                                        placeholder=" Name"
                                        value="{{ $name }}">
                                        @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label  class="form-label">Title</label>
                                    <input type="text" name="title" wire:model='title' class="form-control @error('title') is-invalid  @enderror"
                                        placeholder=" Title"
                                        value="{{ $title }}">
                                        @error('title')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                        <textarea wire:model='description' class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $description }}</textarea>
                                    </div>
                                        @error('description')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                </div>

                                <div  class="form-group">
                                    <label  class="form-label">Branch</label>
                                    <select name="br_id" wire:model='br_id' class="form-select form-control  @error('br_id') is-invalid  @enderror" aria-label="Default select example">
                                        @foreach ($branches as $branch)
                                            @if($branch->id == $br_id)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @else
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('br_id')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label  class="form-label">Language</label>
                                    <select name="lg_id" wire:model='lg_id' class="form-select form-control  @error('lg_id') is-invalid  @enderror" >
                                        @foreach ($languages as $language)
                                            @if($language->id == $lg_id)
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @else
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('lg_id')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label  class="form-label">State</label>
                                    <select name="state" wire:model='state' class="form-select form-control  @error('state') is-invalid  @enderror" >
                                        @if($state == "normal")
                                            <option value="normal">Normal</option>
                                            <option value="FW">FW</option>
                                        @elseif($state == "FW")
                                            <option value="FW">FW</option>
                                            <option value="normal">Normal</option>
                                        @endif
                                    </select>
                                    @error('state')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="form-label">Image</label>
                                    <input type="file" name="image" wire:model='image' class="form-control mt-2 @error('image') is-invalid  @enderror">
                                    @error('image')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a wire:click='canncel' class="btn btn-secondary">
                                        Canncel
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- end Update form --}}
    @endif


    @if($deleteCourse)
     {{-- Delete Course --}}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 text-primary">Delete the Course</h1>
                            </div>
                            <form class="user" wire:submit.prevent='deleteCourse'>
                                <h3 class="text-danger m-5 text-center">
                                    Do you want a Delete this itme
                                </h3>
                                <div class="">
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                    <a wire:click='canncel' class="btn btn-secondary">
                                        Canncel
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Delete Course --}}
    @endif

</div>

