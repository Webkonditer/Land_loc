<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Пароли для модулей</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Установка паролей для модулей</h2>

                <div class="row">
                    <div class="col-sm-12">

                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                              @endforeach
                            </ul>
                          </div>
                        @endif

                        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                        Курс
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                        Модуль
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                        Пароль
                                    </th>

                                    <th class="action" style="width:40px !important;"></th>
                                    <th class="action" style="width:40px !important;"></th>

                                </tr>
                            </thead>
                            <tbody>
                              <?php $a = 1 ?>
                                @forelse($passwords  as $password)

                                  <form role="form" name="edit" enctype="multipart/form-data" action="" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <tr role="row" >
                                    <td >
                                      {{ $password['course'] }}
                                        <input type="hidden"
                                               name="course"
                                               class="form-control"
                                               value="{{ $password['course'] }}"
                                               
                                        />
                                    </td>
                                    <td >
                                      {{$password['module']}}
                                      <input type="hidden"
                                             name="module"
                                             class="form-control"
                                             value="{{$password['module']}}"

                                      />
                                    </td>
                                    <td >
                                      {{$password['password']}}
                                      <input type="hidden"
                                             name="password"
                                             class="form-control"
                                             value="{{$password['password']}}"

                                      />
                                    </td>

                                    <td >
                                      <button
                                          type="submit"
                                          name="submit"
                                          class="btn btn-primary"
                                          value="1"
                                          onclick="return confirm ('Создать/изменить пароль?')"
                                          >
                                          Создать/Изменить
                                        </button>
                                    </td>
                                </form>


                                </tr>


                                <script>

                                $('#form{{ $a }}').click(function(){
                                          var val = '.'+$(this).attr('id');
                                            if ($(this).is(':checked')){
                                                $(val).prop('disabled',false);
                                            } else {
                                                $(val).prop('disabled',true);
                                            }
                                        });


                                </script>
                                <?php $a++ ?>
                                @empty
                                <tr>
                                    <td><p>Пароли отсутствуют</p>
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
