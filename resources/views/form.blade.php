@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users list') }}</div>

                <div class="card-body">
                    <form>
                        @foreach ($form as $line)
                            <div class="form-group">
                                <label for="row{{$line['name']}}">{{$line['name']}}</label>

                                @if ($line['dom'] == 'input')
                                    <input type="{{$line['type']}}" class="form-control" id="row{{$line['name']}}" name="{{$line['name']}}" value="{{isset($data['id']) && $data['id'] != '' ?? $data[$line['name']]}}">
                                @endif
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
