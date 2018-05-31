@extends("layouts.master")

@section("title","Todo edit")


@section("content")

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::model($todo,["method"=>"PATCH","route"=>["todos.update",$todo->id]]) !!}

                <div class="form-group">
                    {!! Form::label("name","Name :") !!}
                    {!! Form::text("name",null,["class"=>"form-control " . getValClass($errors,"name")]) !!}
                    {!! valMsg($errors, "name") !!}
                </div>

                <div class="form-group">
                    {!! Form::button("Update <i class='fa fa-save'></i>",["class"=>"btn btn-success","type"=>"submit"]) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>


@endsection