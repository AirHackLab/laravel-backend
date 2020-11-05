@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __($listname . ' list') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th scope="col">
                                        {{$column['name']}}
                                    </th>
                                @endforeach
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
