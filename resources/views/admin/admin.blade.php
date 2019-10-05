@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Админ панель</h3></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Аватар</th>
                            <th>Имя</th>
                            <th>Дата</th>
                            <th>Комментарий</th>
                            <th>Действия</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        @if($comment->user->image == NULL)
                                            <img src="img/no-user.jpg" class="img-fluid" alt="" width="64" height="64">
                                        @else
                                            <img src="{{$comment->user->image}}" class="mr-3" alt="" width="64" height="64">
                                        @endif
                                    </td>
                                    <td>{{$comment->user->name}}</td>
                                    <td>{{date('d/m/Y', strtotime($comment->created_at))}}</td>
                                    <td>{{$comment->text}}</td>
                                    <td>
                                        <?php if($comment->published == 0):?>
                                        <form action="" method="POST">
                                            <button type="submit" class="btn btn-success" >Разрешить</button>
                                            <input type="hidden" name="id" value="{{$comment->id}}">
                                            <input type="hidden" name="published" value="1">
                                            {{csrf_field()}}
                                        </form>
                                        <?php else:?>
                                        <form action="" method="POST">
                                            <button type="submit" class="btn btn-warning" >Запретить</button>
                                            <input type="hidden" name="id" value="{{$comment->id}}">
                                            <input type="hidden" name="published" value="0">
                                            {{csrf_field()}}
                                        </form>
                                        <?php endif;?>
                                        <form action="" method="POST">
                                            <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-danger" >Удалить</button>
                                            <input type="hidden" name="id" value="{{$comment->id}}">
                                            <input type="hidden" name="remove" value="{{$comment->id}}">
                                            {{csrf_field()}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="pagination_area">
                {{$comments->links()}}
            </div>
        </div>
    </div>
</div>

@endsection