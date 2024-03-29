@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __($listname . ' list') }}
                    <a href="/{{ $routename }}/create" class="btn btn-sm btn-primary">Add</a></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th scope="col">
                                        {{$column['name']}}
                                    </th>
                                @endforeach
                                <th>
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $line)
                                <tr>
                                    @foreach ($columns as $column)
                                    <td>
                                        {{$line[$column['name']]}}
                                    </td>
                                    @endforeach
                                    <td>
                                        <a href="{{ route($routename.'.view', ['id'=> $line['id']]) }}">{{ __('Edit') }}</a>
                                    </td>
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
