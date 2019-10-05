@extends('layouts.app')

@section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Комментарии</h3></div>

                        <div class="card-body">
                            @foreach($comments as $comment)
                                    <div class="media">
                                        @if($comment->user->image === NULL)
                                            <img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">
                                        @else
                                            <img src="{{$comment->user->image}}" class="mr-3" alt="..." width="64" height="64">
                                        @endif
                                        <div class="media-body">
                                            <h5 class="mt-0">{{$comment->user->name}}</h5>
                                            <span><small>{{date('d/m/Y', strtotime($comment->created_at))}}</small></span>
                                            <p>
                                                {{$comment->text}}
                                            </p>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="pagination_area">
                        {{$comments->links()}}
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Оставить комментарий</h3></div>
                        <div class="card-body">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <form action="" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        {{--<label for="exampleFormControlTextarea1">Имя</label>--}}
                                        <input type="hidden" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlTextarea1" value="{{\Illuminate\Support\Facades\Auth::user()->name}}"/>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Сообщение</label>
                                        <textarea name="text" class="form-control @error('text') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Отправить</button>
                                </form>
                            @else
                                <span>Чтобы оcтавить комментарий, необходимо <a href="{{route('login')}}">авторизоваться</a></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection