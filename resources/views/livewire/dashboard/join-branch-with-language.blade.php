<div  class="container">
    <h3 class="text-primary m-5">Joins Table</h3>
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
    @if ($jTable)
        {{-- card Table --}}
        <div class="card shadow">
            <div class="card-body ">
                <!-- Topbar Search -->
                <div class="m-3 d-flex ">

                    @if(!empty($joins[0]))
                        <form dir="rtl" class="d-flex flex-row bd-highlight mb-3  d-sm-inline-block form-inline mr-auto ml-md-3 my-3 my-md-0 mw-100 navbar-search ">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" wire:model='search' placeholder="Search for..."
                                        aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">

                                </div>
                            </div>
                        </form>
                    @else
                        <div class="mx-3">

                        </div>
                    @endif

                    <button  class="btn btn-primary" wire:click='showAddForm'><i class="fas fa-fw fa-plus"></i></button>
                </div>

                @if(!empty($joins[0]))
                    <div class="table-responsive">
                        <table class="table table-hover border ">
                            <thead class="table-primary">
                                <tr >
                                    <th scope="row">#</th>
                                    <td>Join Name</td>
                                    <td>Branch Name</td>
                                    <td>Language Name</td>
                                    <td>Actions</td>
                                    </tr>
                            </thead>
                            <tbody class>
                                @php
                                    $num = 1;//counter to table
                                @endphp

                                @foreach ($joins as $join)
                                <tr>
                                    <th scope="row">{{ $num++ }}</th>
                                    <td>{{ $join->name }}</td>
                                    <td>{{ DB::table("branches")->where("id",$join->branch_id)->first()->name }}</td>
                                    <td>{{ DB::table("languages")->where("id",$join->language_id)->first()->name }}</td>
                                    <td>
                                        <p class="d-inline ml-3 btn " wire:click='showUpdateForm({{ $join->id  }})'><i class="fas fa-pen text-warning"></i></p>
                                        <p class="d-inline ml-3 btn " wire:click='showDeleteMessage({{ $join->id  }})'><i class="fas fa-trash text-danger"></i></p>
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
                <div class="my-3 ">{{ $joins->links() }}</div>
            </div>
        </div>
        {{-- end card Table --}}

    @endif


    @if($addForm)
        {{--  card Add Join --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Add Join</h3>
                        <form action="" wire:submit.prevent='addJoin'>

                            <div  class="m-3">
                                <select name="branch_id" wire:model='branch_id' class=" form-control  @error('branch_id') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div  class="m-3">
                                <select name="language_id" wire:model='language_id' class=" form-control  @error('language_id') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                </select>
                                @error('language_id')
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
        {{-- end card Add Join --}}
    @endif



    @if($updateForm)
        {{--  card Update Join --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Update Join</h3>
                        <form action="" wire:submit.prevent='updateJoin'>

                            <div  class="m-3">
                                <select name="branch_id" wire:model='branch_id' class=" form-control  @error('branch_id') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Branch</option>
                                    @foreach ($branches as $branch)
                                        @if($branch->id == $branch_id)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @else
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div  class="m-3">
                                <select name="language_id" wire:model='language_id' class=" form-control  @error('language_id') is-invalid  @enderror" aria-label="Default select example">
                                    <option selected>Language</option>
                                    @foreach ($languages as $language)
                                        @if($language->id == $language_id)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @else
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endif

                                    @endforeach
                                </select>
                                @error('language_id')
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
        {{-- end card Update Join --}}
    @endif


    @if($deleteJoin)
        {{--  card Delete Join --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Delete Join</h3>
                        <p class="fs-4 text-danger text-center bold">do you want to delete this item</p>
                    </div>
                    <div dir="rtl" class="card-footer d-flex ">

                        <div>
                            <form action="" wire:submit.prevent='deleteJoin'>
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
        {{-- end card Delete Join --}}
    @endif


</div>


