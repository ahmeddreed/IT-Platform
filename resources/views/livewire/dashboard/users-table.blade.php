<div class="container">
    <h3 class="text-primary m-5">Users Table</h3>
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

    @if($uTable)
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
                    <button class="btn btn-primary" wire:click='showAddUser'><i class="fas fa-fw fa-plus"></i></button>
                </div>
            </div>

            @if(!empty($users))

            <div class="table-responsive">
                <table class="table table-hover border ">
                    <thead class="table-primary">
                        <tr >
                            <th scope="row">#</th>
                            <td>Picture</td>
                            <td>Full Name</td>
                            <td>Email</td>
                            <td>Role</td>
                            <td>Specialty</td>
                            <td>Gender</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody class>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $num++ }}</th>
                                <td>
                                    @if($user->picture != null)
                                      <img style="max-height:50px;min-height:49px;max-width:50px;min-width:49px;" class=" rounded-circle"src="storage/UserPhoto/{{ $user->picture }}">
                                    @else
                                      <img style="max-height:50px;min-height:49px;max-width:50px;min-width:49px;" class=" rounded-circle"src="dashboard/img/undraw_profile.svg">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ DB::table("roles")->where("id",$user->role_id)->first()->name }}
                                </td>
                                @if($user->specialty == null || $user->specialty =="")
                                    <td>
                                        Null
                                    </td>
                                @else
                                    <td>
                                        @if(DB::table("specialties")->where("id",$user->specialty)->first())
                                            {{ DB::table("specialties")->where("id",$user->specialty)->first()->name }}
                                        @else
                                            Null
                                        @endif
                                    </td>
                                @endif
                                <td>{{ $user->gender }}</td>
                                <td>
                                    <p class="d-inline ml-3 btn" wire:click='showUpdateUser({{ $user->id }})'><i class="fas fa-pen text-warning"></i></p>
                                    <p class="d-inline ml-3 btn" wire:click='showDeleteUser({{ $user->id }})'><i class="fas fa-trash text-danger"></i></p>
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
            <div class="my-3 ">{{ $users->links() }}</div>
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
                            <h1 class="h4 text-gray-900 mb-4 text-primary">Add a New User</h1>
                        </div>
                        <form class="user" wire:submit.prevent='createUser'  enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
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
                                <input type="email" name="email" wire:model='email' class="form-control @error('email') is-invalid  @enderror"
                                    placeholder="Email"
                                    value="{{ old('email') }}">
                                    @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" wire:model='password' class="form-control @error('password') is-invalid  @enderror"
                                    value="{{ old('password') }}">
                                    @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                            <div  class="form-group">
                                <select name="specialty_id" wire:model='specialty_id' class="form-select form-control  @error('specialty') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Specialty</option>
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                                @error('specialty_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="gender" wire:model='gender' class="form-select form-control  @error('gender') is-invalid  @enderror" >
                                    <option selected>Gender </option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="role_id" wire:model='role_id' class="form-select form-control  @error('role') is-invalid  @enderror" >
                                    <option selected>Role </option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" name="picture" wire:model='picture' class="form-control mt-2 @error('picture') is-invalid  @enderror">
                                @error('picture')
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
                            <h1 class="h4 text-gray-900 mb-4 text-primary">Update the Data of User</h1>
                        </div>
                        <form class="user" wire:submit.prevent='updateUser'  enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
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
                                <input type="email" name="email" wire:model='email' class="form-control @error('email') is-invalid  @enderror"
                                    placeholder="Email"
                                    value="{{ $email }}">
                                    @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                            <div  class="form-group">
                                <select name="specialty_id" wire:model='specialty_id' class="form-select form-control  @error('specialty') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Specialty</option>
                                    @foreach ($specialties as $specialty)
                                        @if($specialty->id == $specialty_id)
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @else
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option
                                        @endif
                                        >
                                    @endforeach

                                </select>
                                @error('specialty_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="gender" wire:model='gender' class="form-select form-control  @error('gender') is-invalid  @enderror" >
                                    <option selected>Gender </option>
                                    @if ($gender == "m")
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    @elseif($gender == "f")
                                        <option value="f">Female</option>
                                        <option value="m">Male</option>
                                    @endif

                                </select>
                                @error('gender')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="role_id" wire:model='role_id' class="form-select form-control  @error('role') is-invalid  @enderror" >
                                    <option selected>Role </option>
                                    @foreach ($roles as $role)
                                        @if($role->id == $role_id)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif

                                    @endforeach
                                </select>
                                @error('role_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" name="picture" wire:model='picture' class="form-control mt-2 @error('picture') is-invalid  @enderror">
                                @error('picture')
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


    @if($deleteUser)
     {{-- Delete User --}}
     <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4 text-primary">Delete the User</h1>
                        </div>
                        <form class="user" wire:submit.prevent='deleteUser'  enctype="multipart/form-data">
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
    {{-- end Delete User --}}
    @endif

</div>
