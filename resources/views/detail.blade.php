@extends('template')
@section('css_address','/css/detail.css')
@section('right_contents')
  <div class="right_contents_title">
    {{$work->discriptions()->first()->txt}}
  </div>
  <div class="imagewrapper">
    @foreach ($work->images as $image)
      <img src="{{asset('/images/' . $image->filename)}}" class="work_imgs"/> 

      @auth
        <form action="/works/{{$work->id}}/edit" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" class="form-controll" name="image"><br>
          <input type="hidden" name="number" value={{$image->number}}>
          <input type="submit" class="form-btn" value="update this image">
        </form>

        <form action="/works/{{$work->id}}/deletepost" method="post">
          @csrf
          <input type="hidden" name="number" value={{$image->number}}>
          <input type="hidden" name="img_or_txt" value="img">
          <input type="submit" class="form-btn" value="delete this image">
        </form>
      @endauth

    @endforeach
  </div>
  <div class="textwrapper">
    @foreach ($work->discriptions as $discription)
      @switch ($discription->type)
        @case (0)
          @auth
            <div>
              {{$discription->txt}} 
            </div>
          @endauth
          @break
          
        @case (1)
          <div class="work_texts-heading">
            {{$discription->txt}} 
          </div>
          @break
          
        @case (2)
          <div class="work_texts-passage">
            {{$discription->txt}} 
          </div>
          @break

      @endswitch

      @auth
        <form action="/works/{{$work->id}}/edit" method="POST">
          @csrf
          <br><br>
          <input type="hidden" name="number" value={{$discription->number}}>
          <input type="text" class="form-text" name="text" value={{$discription->txt}}>
          <select name="type">
            <option value="0">0</option><!--title-->
            <option value="1" >1</option><!--heading-->
            <option value="2" selected>2</option><!--passage-->
          </select>
          <input type="submit" class="form-btn" value="edit this discription">
        </form>

        <form action="/works/{{$work->id}}/deletepost" method="post">
          @csrf
          <input type="hidden" name="number" value={{$image->number}}>
          <input type="hidden" name="img_or_txt" value="txt">
          <input type="submit" class="form-btn" value="delete this text">
        </form>
      @endauth


    @endforeach
  </div>

  @auth
    <br>
    <form action="/works/{{$work->id}}/add" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" class="form-controll" name="image">
      <input type="text" class="form-text" name="text">
      <select name="type">
        <option value="0">0</option><!--title-->
        <option value="1" >1</option><!--heading-->
        <option value="2" selected>2</option><!--passage-->
      </select>
      <input type="submit" class="form-btn" value="add new post">
    </form>
  @endauth

@endsection