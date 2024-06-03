<div  class="container">
    <h3 class="text-primary m-5">Languages  Table</h3>
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
    @if ($lTable)
        {{-- card Table --}}
        <div class="card shadow">
            <div class="card-body ">
                <!-- Topbar Search -->
                <div class="m-3 d-flex ">

                    @if(!empty($languages))
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

                @if(!empty($languages))
                    <div class="table-responsive">
                        <table class="table table-hover border ">
                            <thead class="table-primary">
                                <tr >
                                    <th scope="row">#</th>
                                    <td>Language Name</td>
                                    <td>Actions</td>
                                    </tr>
                            </thead>
                            <tbody class>
                                @php
                                    $num = 1;//counter to table
                                @endphp

                                @foreach ($languages as $language)
                                <tr>
                                    <th scope="row">{{ $num++ }}</th>
                                    <td>{{ $language->name }}</td>
                                    <td>
                                        <p class="d-inline ml-3 btn " wire:click='showUpdateForm({{ $language->id  }})'><i class="fas fa-pen text-warning"></i></p>
                                        <p class="d-inline ml-3 btn " wire:click='showDeleteMessage({{ $language->id  }})'><i class="fas fa-trash text-danger"></i></p>
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
                <div class="my-3 ">{{ $languages->links() }}</div>
            </div>
        </div>
        {{-- end card Table --}}

    @endif


    @if($addForm)
        {{--  card Add Language --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Add Language</h3>
                        <form action="" wire:submit.prevent='addLanguage'>
                            <div class="m-3">
                                <label  class="form-label fs-5">Language Name</label>
                                <input class="form-control @error('name') is-invalid  @enderror" type="text" name="name" wire:model='name' placeholder="Language Name">
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

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">الفروع</label>
                                <select multiple="multiple" class="form-select fs-5 @error('branches') is-invalid  @enderror" name="branches_id[]" wire:model="branches_id" aria-label="Default select example">
                                    @foreach ($branches as $branch)
                                        <option class=" fs-5" value="{{ $branch->id }}">{{ $branch->name }}</option></option>
                                    @endforeach
                                </select>

                                    @error('branches')
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
        {{-- end card Add Language --}}
    @endif



    @if($updateForm)
        {{--  card Update Language --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Update Language</h3>
                        <form action="" wire:submit.prevent='updateLanguage'>
                            <div class="m-3">
                                <label  class="form-label fs-5">Language Name</label>
                                <input class="form-control @error('name') is-invalid  @enderror" value="{{ $name }}" type="text" name="name" wire:model='name' placeholder="Role Name">
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
        {{-- end card Update Language --}}
    @endif


    @if($deleteLanguage)
        {{--  card Delete Language --}}
        <div class="row">
            <div class="col-lg-7 mx-auto my-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary my-3">Delete Language</h3>
                        <p class="fs-4 text-danger text-center bold">do you want to delete this item</p>
                    </div>
                    <div dir="rtl" class="card-footer d-flex ">

                        <div>
                            <form action="" wire:submit.prevent='deleteLanguage'>
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
        {{-- end card Delete Language --}}
    @endif


</div>


