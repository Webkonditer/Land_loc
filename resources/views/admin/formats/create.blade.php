<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Новый курс</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Создание нового курса</h2>
                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.formats.store')}}" method="POST">

                  {{--Ошибки--}}
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">

                    <div class="form-group">
                        <label for="title">Положение в списке</label>
                        <input type="text"
                               name="position"
                               class="form-control"
                               value="{{old('position')}}"
                               placeholder="Положение в списке цифрой"
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Загрузите изображение с компьютера</label>
                        <input type="file" name="image" id="exampleInputFile">
                    </div>

                    <div class="form-group">
                        <label for="title">Укажите название курса</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{old('name')}}"
                               placeholder="Название курса"
                        />
                    </div>

                    <div class="form-group">
                        <label for="title">Стоимость курса</label>
                        <input type="text"
                               name="summ"
                               class="form-control"
                               id="summ"
                               value="{{old('summ')}}"
                               placeholder="Сумма цифрами"
                        />
                    </div>

                    @for ($i=1; $i < 16; $i++)

                        <div class="form-group">
                            <label for="title">Видео {{ $i }}</label>

                            <input type="text"
                                   name="video_{{ $i }}"
                                   class="form-control"
                                   id="video_{{ $i }}"
                                   value="@if(old('video_'.$i)){{old('video_'.$i)}} @endif"
                                   placeholder="Вставьте скрипт Vimeo"
                            />
                        </div>
                        <div class="form-group">
                            <label for="description">Текст для видео {{ $i }}</label>
                            <textarea id="text_{{ $i }}"
                                      name="text_{{ $i }}"
                                      rows="3"
                                      cols="80"
                                      class="js-editor-enabled">
                                      @if(old('text_'.$i)){{old('text_'.$i)}} @endif
                           </textarea>
                    @endfor

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="1" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
