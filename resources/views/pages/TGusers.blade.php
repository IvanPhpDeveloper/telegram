@extends('welcome')
@section('content')

<div class="row p-5 h-auto w-100 justify-content-center">
    <table class="table table-dark table-striped w-75">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@Username</th>
            <th scope="col" class="text-center">Chat Id</th>
            <th scope="col" class="text-center">First Name</th>
            <th scope="col" class="text-center">Last Name</th>
            <th scope="col" class="text-center">isMilkUser?</th>
            <th scope="col" class="text-center">isStickUser?</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($records->count() > 0)
            @foreach($records as $record)
                <tr>
                    <th scope="row" >{{$record->id}}</th>
                    <td>{{$record->user_name}}</td>
                    <td class="text-center">{{$record->chat_id}}</td>
                    <td class="text-center">{{$record->first_name}} </td>
                    <td class="text-center">{{$record->last_name}}</td>
                    <td class="text-center">@if(!is_null(($record->getMilk()->first()))) Y @else N @endif</td>
                    <td class="text-center">@if(!is_null(($record->getSticks()->first()))) Y @else N @endif</td>
                    <td class="text-center">Удалить</td>
                </tr>
            @endforeach
        @else
            <th colspan="5" class="text-center">Нет данных для вывода.</th>
        @endif
        </tbody>
    </table>
{{--    <form action="" method="post">--}}
{{--        @csrf--}}



{{--        <div class="input-group " style="max-width: 50%;">--}}
{{--            <input type="text" class="form-control" placeholder="add new user">--}}
{{--            <button class="btn btn-outline-secondary" type="button">Add new User</button>--}}
{{--        </div>--}}



{{--    </form>--}}
</div>

@endsection

