@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Котировки') }} за {{ $date }}  </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('home') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Дата</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <input class="form-control" type="submit" value="Узнать!">
                        </form>

                    </div>


                </div>
                <br>
                <br>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Код</th>
                                <th scope="col">Названия</th>
                                <th scope="col">Цена</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($quotes as $valute)
                                <tr>
                                    <th scope="row">{{ $valute->valuteID }}</th>
                                    <td>{{ $valute->numCode }}</td>
                                    <td>{{ $valute->сharCode }}</td>
                                    <td>{{ $valute->name }}</td>
                                    <td>{{ $valute->value }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
