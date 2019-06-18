<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Редактирвание опции</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Редактирвание опции</h2>
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
                        <div class="checkbox">
                            <label for="monthly">
                                <input id="on_home" name="on_home" type="checkbox" @if($format->on_home == "Да")checked="checked"@endif> На главной
                            </label>
                        </div>
                      </div>

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
                          <label for="title">Укажите название опции</label>
                          <input type="text"
                                 name="name"
                                 class="form-control"
                                 value="@if(old('name')){{old('name')}} @else{{$format->name}} @endif"
                                 placeholder="Название опции"
                          />
                      </div>

                        <div class="form-group">
                            <label for="title">Сумма пожертвования</label>
                            <input type="text"
                                   name="summ"
                                   class="form-control"
                                   id="summ"
                                   value="@if(old('summ')){{old('summ')}} @else{{$format->summ}} @endif"
                                   placeholder="Сумма цифрами"
                            />
                        </div>

                        <div class="form-group">
                          <div class="checkbox">
                              <label for="monthly">
                                  <input id="monthly" name="monthly" @if($format->monthly == "Ежемесячно")checked="checked"@endif type="checkbox"> Ежемесячное пожертвование
                              </label>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Бонус 1</label>
                            <input type="text"
                                   name="bonus_1"
                                   class="form-control"
                                   id="bonus_1"
                                   value="@if(old('bonus_1')){{old('bonus_1')}} @else{{$format->bonus_1}} @endif"
                                   placeholder="Бонус 1"
                            />
                        </div>

                        <div class="form-group">
                            <label for="title">Бонус 2</label>
                            <input type="text"
                                   name="bonus_2"
                                   class="form-control"
                                   id="bonus_2"
                                   value="@if(old('bonus_2')){{old('bonus_2')}} @else{{$format->bonus_2}} @endif"
                                   placeholder="Бонус 2"
                            />
                        </div>

                        <div class="form-group">
                            <label for="title">Чайтаньи</label>
                            <input type="text"
                                   name="ctn"
                                   class="form-control"
                                   id="ctn"
                                   value="@if(old('ctn')){{old('ctn')}} @else{{$format->ctn}} @endif"
                                   placeholder="Количество Чайтаний цифрой"
                            />
                        </div>

                        <div class="form-group">
                            <label for="description">Текст страницы результатов</label>
                            <textarea id="description"
                                      name="success"
                                      rows="5"
                                      cols="80"
                                      class="js-editor-enabled">
                                      @if(old('success')){{old('success')}} @else{{$format->success}} @endif
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
