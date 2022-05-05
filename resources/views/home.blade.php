@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div id="app">
        <div class="container">
         <h1 class="p-40 text-4xl font-bold text-center">Welcome to the hiring platform</h1>
            <div class="flex items-center justify-center">
            @if (request()->get('id') == NULL)
              <a href="/candidates-list" class="btn btn-info disabled" data-toggle="tooltip">Go to candidates list</a>
            @else  
              <a href="/candidates-list?id={{request()->get('id')}}" class="btn btn-info" data-toggle="tooltip">Go to candidates list</a>
            @endif  
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection
