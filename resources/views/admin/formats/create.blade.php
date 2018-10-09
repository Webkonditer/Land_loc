<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Новая опция</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Создание новой опции</h2>
                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.formats.store')}}" method="POST">

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
                          <label for="title">Укажите название опции</label>
                          <input type="text"
                                 name="name"
                                 class="form-control"
                                 value="{{old('name')}}"
                                 placeholder="Название опции"
                          />
                      </div>

                        <div class="form-group">
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
                        </div>

                        <div class="form-group">
                            <label for="title">Бонус 1</label>
                            <input type="text"
                                   name="bonus_1"
                                   class="form-control"
                                   id="bonus_1"
                                   value="{{old('bonus_1')}}"
                                   placeholder="Бонус 1"
                            />
                        </div>

                        <div class="form-group">
                            <label for="title">Бонус 2</label>
                            <input type="text"
                                   name="bonus_2"
                                   class="form-control"
                                   id="bonus_2"
                                   value="{{old('bonus_2')}}"
                                   placeholder="Бонус 2"
                            />
                        </div>

                        <div class="form-group">
                            <label for="description">Текст страницы результатов</label>
                            <textarea id="description"
                                      name="success"
                                      rows="5"
                                      cols="80"
                                      class="js-editor-enabled">
                                      {{old('success')}} 
                           </textarea>

                        </div>




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
