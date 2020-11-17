@extends ('layouts.app')

@section('content')

    <div class="studentClasses">
        @foreach ($collection as $item)
            <div class="studentClass">
                {{ $item -> name}} 
                {{ $item -> teacher -> name }}
            </div>
        @endforeach
    </div>
    <div class="studentTests">
        @foreach ($collection as $item)
            <div class="studentTest">
                {{ $item -> name }}
                {{ $item -> deadline}}    
            </div>    
        @endforeach
    </div>

@endsection