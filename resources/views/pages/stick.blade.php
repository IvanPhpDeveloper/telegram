@extends('welcome')
@section('content')

<div class="row p-5 h-auto w-100 justify-content-center">
    <table class="table table-dark table-striped w-75">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@Username</th>
            <th scope="col">Name</th>
            <th scope="col" class="text-center">Active</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($records->count() > 0)
            @foreach($records  as $record)
                <tr>
                    <th scope="row">{{$record->id}}</th>
                    <td>{{$record->getTelegramUser()->first()->user_name}}</td>
                    <td>{{$record->getTelegramUser()->first()->first_name}} {{$record->getTelegramUser()->first()->lst_name}}</td>
                    <td class="text-center">{{$record->active}}</td>
                    <td class="text-center"><a href="{{ route('delete') }}"
                                               onclick="event.preventDefault();
                                                   document.getElementById(
                                                   'delete-form-{{$record->id}}').submit();">
Удалить
                        </a></td>
                    <form id="delete-form-{{$record->id}}"
                          + action="{{route('destroy', $record->id)}}"
                          method="post">
                        @csrf @method('DELETE')
                    </form>
                </tr>
            @endforeach
        @else
            <th colspan="5" class="text-center">Нет данных для вывода.</th>
        @endif
        </tbody>
    </table>
</div>
    <form action="{{ route('addStickUser')}}" method="post">
        @csrf
        <select name="userStick" id="">
            @foreach($tgUsers as $user)
                <option value="{{$user->id}}">{{$user->first_name}}</option>
            @endforeach
        </select>

        <button class="btn btn-success">Add new user</button>




    </form>
@endsection
