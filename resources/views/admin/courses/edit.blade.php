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
                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.courses.update', $course)}}" method="POST">

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
                                 value="@if(old('position')){{old('position')}} @else{{$course->position}} @endif"
                                 placeholder="Положение в списке цифрой"
                          />
                      </div>

                      <div class="form-group">
                          <label for="exampleInputFile">Загрузите новое изображение</label>
                          <input type="file" name="image" id="exampleInputFile">
                      </div>

                      <div class="form-group">
                          <label for="title">Измените название курса</label>
                          <input type="text"
                                 name="name"
                                 class="form-control"
                                 value="@if(old('name')){{old('name')}} @else{{$course->name}} @endif"
                                 placeholder="Название опции"
                          />
                      </div>

                      <div class="form-group">
                          <label for="nic">Измените псевдоним курса</label>
                          <input type="text"
                                 name="nic"
                                 class="form-control"
                                 value="@if(old('nic')){{old('nic')}} @else{{$course->nic}} @endif"
                                 placeholder="Псевдоним курса"
                          />
                      </div>

                      <div class="form-group">
                          <label for="description">Описание курса</label>
                          <textarea id="description"
                                    name="description"
                                    rows="5"
                                    cols="80"
                                    class="js-editor-enabled">
                                    @if(old('description')){{old('description')}} @else{{$course->description}} @endif
                         </textarea>
                      </div>

                     <div class="form-group">
                         <label for="module">Модули (каждый на новой строке)</label>
                         <textarea id="module"
                                   name="module"
                                   rows="7"
                                   cols="80"
                                   class="form-control rounded-1">
                                   @if(old('module')){{old('module')}} @else{{$course->module}} @endif
                        </textarea>

                     </div>

                     <div class="form-group">
                         <label for="mail_text">Текст письма</label>
                         <textarea id="mail_text"
                                   name="mail_text"
                                   rows="5"
                                   cols="80"
                                   class="js-editor-enabled">
                                   @if(old('mail_text')){{old('mail_text')}} @else{{$course->mail_text}} @endif
                        </textarea>
                     </div>

                     <div class="form-group">
                         <label for="result_text">Текст страницы результатов</label>
                         <textarea id="result_text"
                                   name="result_text"
                                   rows="5"
                                   cols="80"
                                   class="js-editor-enabled">
                                   @if(old('result_text')){{old('result_text')}} @else{{$course->result_text}} @endif
                        </textarea>

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
