<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Редактирвание курса</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Редактирвание курса</h2>
                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.formats.update', $format)}}" method="POST">

                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach
                      </ul>

                    </div>

                  @endif

                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="box-body">

                      <div class="form-group">
                          <label for="title">Положение в списке</label>
                          <input type="text"
                                 name="position"
                                 class="form-control"
                                 value="@if(old('position')){{old('position')}} @else{{$format->position}} @endif"
                                 placeholder="Положение в списке цифрой"
                          />
                      </div>

                      <div class="form-group">
                          <label for="exampleInputFile">Загрузите новое изображение</label>
                          <input type="file" name="image" id="exampleInputFile">
                      </div>

                      <div class="form-group">
                          <label for="title">Укажите название курса</label>
                          <input type="text"
                                 name="name"
                                 class="form-control"
                                 value="@if(old('name')){{old('name')}} @else{{$format->name}} @endif"
                                 placeholder="Название опции"
                          />
                      </div>

                        <div class="form-group">
                            <label for="title">Стоимость курса</label>
                            <input type="text"
                                   name="summ"
                                   class="form-control"
                                   id="summ"
                                   value="@if(old('summ')){{old('summ')}} @else{{$format->summ}} @endif"
                                   placeholder="Сумма цифрами"
                            />
                        </div>

                        <div class="form-group">
                            <label for="title">Стоимость курса с сопровождением</label>
                            <input type="text"
                                   name="summ2"
                                   class="form-control"
                                   id="summ2"
                                   value="@if(old('summ2')){{old('summ2')}} @else{{$format->summ2}} @endif"
                                   placeholder="Сумма цифрами"
                            />
                        </div>

                    @for ($i=1; $i < 16; $i++)
                        <?php $j = $i; if(isset($text_1[$j])) $text1 = $text_1[$j]; else $text1 = '';  ?>
                        <?php if(isset($text_2[$j])) $text2 = $text_2[$j]; else $text2 = '';  ?>
                        <div class="form-group">
                            <label for="title">Видео {{ $i }}</label>

                            <input type="text"
                                   name="video_{{ $i }}"
                                   class="form-control"
                                   id="video_{{ $i }}"

                                   value="@if(old('video_'.$i)){{old('video_'.$i)}} @else<?php $video = "video_".$i; ?>{{ $format->$video }} @endif"
                                   placeholder="Видео 1"
                            />
                        </div>
                        <div class="form-group">
                            <label for="description">Рецепт для видео {{ $i }}</label>
                            <textarea id="text_{{ $i }}"
                                      name="text_{{ $i }}"
                                      rows="3"
                                      cols="80"
                                      class="js-editor-enabled">
                                      @if(old('text_'.$i)){{old('text_'.$i)}} @else{{ $text1 }}@endif
                           </textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Советы для видео {{ $i }}</label>
                            <textarea id="text2_{{ $i }}"
                                      name="text2_{{ $i }}"
                                      rows="3"
                                      cols="80"
                                      class="js-editor-enabled">
                                      @if(old('text2_'.$i)){{old('text2_'.$i)}} @else{{ $text2 }}@endif
                           </textarea>
                        </div>
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
