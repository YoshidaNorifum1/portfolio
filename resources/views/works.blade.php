@extends('template')
@section('css_address','css/works.css')
@section('right_contents')
  <div class="right_contents_title">
    Works
  </div>
  
  <div class="right_contents_works">
  @foreach ($works as $work)
    <div class="wrap">
      <a href="/works/{{$work->id}}">
        <img src="{{asset('images/' . $work->images->first()->filename)}}" class="right_contents_work-image"/>
      </a>

      <div class="right_contents_work-text">
        @if (isset($work->discriptions()->first()->txt))
          {{$work->discriptions()->first()->txt}}
        @endif
      </div>
        @auth
          <form action="/works/{{$work->id}}/update" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-controll" name="image">
            <input type="text" class="form-text" name="text" 
              value="{{$work->discriptions->where('number',0)->first()->txt}}">
            <input type="submit" value="update">
          </form>

          <form action="/works/{{$work->id}}/delete" method="post">
            @csrf
            <input type="submit" value="delete">
          </form>
        @endauth
    </div>
  @endforeach
</div>

@auth
  <form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" class="form-controll" name="image">
    <input type="text" class="form-text" name="text">
    <input type="submit" value="Add new work">
  </form>
  
  <form action="/logout" method="POST">
    @csrf
    <input type="submit" value="logout">
  </form>
@endauth

@endsection