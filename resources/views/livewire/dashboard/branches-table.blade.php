<div  class="container">
    <h3 class="text-primary m-5">Branches Table</h3>
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
    @if ($bTable)
        {{-- card Table --}}
        <div class="card shadow">
            <div class="card-body ">
                <!-- Topbar Search -->
                <div class="m-3 d-flex ">

                    @if(!empty($branches))
                        <form dir="rtl" class="d-flex flex-row bd-highlight mb-3  d-sm-inline-block form-inline mr-auto ml-md-3 my-3 my-md-0 mw-100 navbar-search ">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" wire:model='search' placeholder="Search for..."
                                        aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">

                                </div>
                            </div>
                        </form>
                    @endif

                    <button  class="btn btn-primary" wire:click='showAddForm'><i class="fas fa-fw fa-plus"></i></button>
                </div>

                @if(!empty($branches))
                    <div class="table-responsive">
                        <table class="table table-hover border ">
                            <thead class="table-primary">
                                <tr >
                                    <th scope="row">#</th>
                                    <td>branch Name</td>
                                    <td>Specialty Name</td>
                                    <td>Actions</td>
                                    </tr>
                            </thead>
                            <tbody class>
                                @php
                                    $num = 1;//counter to table
                                @endphp

                                @foreach ($branches as $branch)
                                <tr>
                                    <th scope="row">{{ $num++ }}</th>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ DB::table("specialties")->where("id",$branch->sp_id)->first()->name }}</td>
                                    <td>
                                        <p class="d-inline ml-3 btn " wire:click='showUpdateForm({{ $branch->id  }})'><i class="fas fa-pen text-warning"></i></p>
                                        <p class="d-inline ml-3 btn " wire:click='showDeleteMessage({{ $branch->id  }})'><i class="fas fa-trash text-danger"></i></p>
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
                <div class="my-3 ">{{ $branches->links() }}</div>
            </div>
        </div>
        {{-- end card Table --}}

    @endif


    @if($addForm)
        {{--  card Add Branch --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Add Branch</h3>
                        <form action="" wire:submit.prevent='addBranch'>
                            <div class="m-3">
                                <label  class="form-label fs-5">Branch Name</label>
                                <input class="form-control @error('name') is-invalid  @enderror" type="text" name="name" wire:model='name' placeholder="Branch Name">
                                @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea wire:model='description' class="form-control @error('description') is-invalid  @enderror" id="editor2"></textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                            <div  class="m-3">
                                <select name="specialty_id" wire:model='specialty_id' class=" form-control  @error('specialty') is-invalid  @enderror" aria-label="Default select example">
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
                            <div class="m-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-light text-primary" wire:click='canncel'>Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end card Add Specialty --}}
    @endif



    @if($updateForm)
        {{--  card Update Branch --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Update Branch</h3>
                        <form action="" wire:submit.prevent='updateBranch'>
                            <div class="m-3">
                                <label  class="form-label fs-5">Branch Name</label>
                                <input class="form-control @error('name') is-invalid  @enderror" value="{{ $name }}" type="text" name="name" wire:model='name' placeholder="Branch Name">
                                @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea wire:model='description' class="form-control @error('description') is-invalid  @enderror" id="editor2"></textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                            <div  class="m-3">
                                <select name="specialty_id" wire:model='specialty_id' class=" form-control  @error('specialty') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Specialty</option>
                                    @foreach ($specialties as $specialty)
                                        @if($specialty->id == $specialty_id)
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @else
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @endif
                                    @endforeach


                                </select>
                                @error('specialty_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="m-3">
                                <button  type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-light text-primary" wire:click='canncel'>Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end card Update Branch --}}
    @endif


    @if($deleteBranch)
        {{--  card Delete Branch --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Delete Branch</h3>
                        <p class="fs-4 text-danger text-center bold">do you want to delete this item</p>
                    </div>
                    <div dir="rtl" class="card-footer d-flex ">

                        <div>
                            <form action="" wire:submit.prevent='deleteBranch'>
                                <div class="m-3">
                                </div>
                                <div class="m-3">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>

                        </div>
                        <button class="btn btn-light text-primary" wire:click='canncel'>Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end card Delete Branch --}}
    @endif


</div>

