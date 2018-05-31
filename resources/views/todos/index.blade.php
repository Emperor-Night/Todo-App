@extends("layouts.master")

@section("title","Todo index")


@section("content")

    <div class="row">
        <div class="col-md-6 offset-md-3">

            <form action="{{ route("todos.store") }}" method="POST" id="createForm">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Create todo...">
                </div>
            </form>

        </div>
    </div>

    @if(count($todos))

        <ul class="list-group mt-3">

            @foreach($todos as $todo)

                <li class="list-group-item mt-3">

                    <h3 class="float-left" data-id="{{ $todo->id }}">{{ $todo->name }}</h3>

                    <form action="{{ route("todos.destroy",$todo->id) }}" method="POST" class="deleteForm float-right">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal">
                            Delete <i class='far fa-trash-alt'></i>
                        </button>
                    </form>

                    @if($todo->status)
                        <form action="{{ route("todo.markUncompleted",$todo->id) }}" method="POST"
                              class="statusForm float-right mx-4">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button class="btn btn-success">Completed <i class="far fa-thumbs-up"></i></button>
                        </form>
                    @else
                        <form action="{{ route("todo.markCompleted",$todo->id) }}" method="POST"
                              class="statusForm float-right mx-4">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <button class="btn btn-warning">Uncompleted <i class="far fa-thumbs-down"></i></button>
                        </form>
                    @endif

                    <a href="{{ route("todos.edit",$todo->id) }}" class="editButton btn btn-info float-right"
                       data-toggle="modal" data-target="#myModal">
                        Edit <i class='far fa-edit'></i>
                    </a>

                </li>

            @endforeach

        </ul>

    @else
        <h3 class="text-center message">No todos found</h3>
    @endif


    @include("inc.editModal")
    @include("inc.deleteModal")


@endsection


{{-- IF browser doesn't supprot AJAX disable both modals and modal attributes on editButton and deleteButton --}}