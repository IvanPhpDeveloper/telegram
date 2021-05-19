@extends('welcome')
@section('content')
<div class="row p-5 d-flex flex-column h-auto w-100 align-items-center">
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
        @foreach($records as $record)
            <tr>
                <th scope="row">{{$record->id}}</th>
                <td>{{$record->getTelegramUser()->first()->user_name}}</td>
                <td>{{$record->getTelegramUser()->first()->first_name}} {{$record->getTelegramUser()->first()->last_name}}</td>
                <td class="text-center">{{$record->active}} </td>
                <td class="text-center"><a href="{{ route('deleteMilk') }}"
                                           onclick="event.preventDefault();
                                               document.getElementById(
                                               'delete-form-{{$record->id}}').submit();">
                        Удалить
                    </a></td>
                <form id="delete-form-{{$record->id}}"
                      + action="{{route('destroyMilk', $record->id)}}"
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

    <div class="d-flex w-75 justify-content-start">

        <form action="{{route('milkuser.add')}}" method="post">
            @csrf


        <select name="user" class="w-25">
            @foreach($tgUsers as $user)
                <option value="{{$user->id}}">{{$user->first_name}}</option>
            @endforeach
        </select>
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success w-auto ml-2">Add user</button>

        </form>

    </div>

</div>
@endsection


