<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Настройки магазина</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Настройки магазина</h2>
                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.setting.update', $settings)}}" method="POST">

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
                          <label for="title">Идентификатор магазина</label>
                          <input type="text"
                                 name="mrh_login"
                                 class="form-control"
                                 value="{{$settings->mrh_login}}"
                          />
                      </div>
                      <p></p>
                      <div class="form-group">
                          <label for="title">Пароль 1</label>
                          <input type="text"
                                 name="mrh_pass1"
                                 class="form-control"

                                 placeholder="Пароль 1 @if($settings->mrh_pass1 == '')не @endif установлен"
                          />
                      </div>
                      <div class="form-group">
                          <label for="title">Пароль 2</label>
                          <input type="text"
                                 name="mrh_pass2"
                                 class="form-control"

                                 placeholder="Пароль 2 @if($settings->mrh_pass2 == '')не @endif установлен"
                          />
                      </div>
                      <p></p>
                        <div class="form-group">
                            <label for="title">Описание товара</label>
                            <input type="text"
                                   name="inv_desc"
                                   class="form-control"
                                   id="summ"
                                   value="{{$settings->inv_desc}}"
                            />
                        </div>
                        <p></p>
                        <div class="form-group">
                          <div class="checkbox">
                              <label for="monthly">
                                  <input id="test_mode" name="test_mode" @if($settings->test_mode == 1)checked="checked"@endif type="checkbox"> Тестовый режим
                              </label>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Тестовый пароль 1</label>
                            <input type="text"
                                   name="test_pass1"
                                   class="form-control"
                                   value="{{$settings->test_pass1}}"
                                   placeholder="Тестовый пароль 1 @if($settings->test_pass1 == 0)не @endif установлен"
                            />
                        </div>
                        <div class="form-group">
                            <label for="title">Тестовый пароль 2</label>
                            <input type="text"
                                   name="test_pass2"
                                   class="form-control"
                                   value="{{$settings->test_pass2}}"
                                   placeholder="Тестовый пароль 2 @if($settings->test_pass2 == 0)не @endif установлен"
                            />
                        </div>




                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" value="1" class="btn btn-primary">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
