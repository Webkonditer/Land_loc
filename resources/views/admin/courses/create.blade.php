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
                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.courses.store')}}" method="POST">

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
                          <label for="title">Укажите псевдоним курса</label>
                          <input type="text"
                                 name="nic"
                                 class="form-control"
                                 value="{{old('nic')}}"
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
                                    {{old('description')}}
                         </textarea>

                      </div>

                      <div class="form-group">
                          <label for="module">Модули (каждый на новой строке)</label>
                          <textarea id="module"
                                    name="module"
                                    rows="7"
                                    cols="80"
                                    class="form-control rounded-1">
                                    {{old('module')}}
                         </textarea>

                      </div>

                      <div class="form-group">
                          <label for="mail_text">Текст письма</label>
                          <textarea id="mail_text"
                                    name="mail_text"
                                    rows="5"
                                    cols="80"
                                    class="js-editor-enabled">
                                    {{old('mail_text')}}
                         </textarea>
                      </div>

                      <div class="form-group">
                          <label for="result_text">Текст страницы результатов</label>
                          <textarea id="result_text"
                                    name="result_text"
                                    rows="5"
                                    cols="80"
                                    class="js-editor-enabled">
                                    {{old('result_text')}}
                         </textarea>

                      </div>
                        {{--<div class="form-group">
                            <label for="title">Сумма пожертвования</label>
                            <input type="text"
                                   name="summ"
                                   class="form-control"
                                   id="summ"
                                   value="{{old('summ')}}"
                                   placeholder="Сумма цифрами"
                            />
                        </div>

                        <div class="form-group">
                          <div class="checkbox">
                              <label for="monthly">
                                  <input id="monthly" name="monthly" type="checkbox"> Ежемесячное пожертвование
                              </label>
                          </div>
                        </div>--}}







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
