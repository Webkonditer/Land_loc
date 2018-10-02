<?php
/**
 * @var \App\Pages\Page $page
 */
?>
@extends('admin.layout')

@section('crumbs')<li class="active">Управление админами</li>@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">

                <h2>Управление админами</h2>

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
                                        Имя
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                        Email
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                                        Пароль
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                                        Редактировать
                                    </th>
                                    <th class="action" style="width:40px !important;"></th>
                                    <th class="action" style="width:40px !important;"></th>

                                </tr>
                            </thead>
                            <tbody>
                              <?php $a = 1 ?>
                                @forelse($settings  as $setting)

                                  <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.administrator.update', $setting->id)}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <tr role="row" >
                                    <td >
                                        <input type="text"
                                               name="name"
                                               class="form{{ $a }} form-control"
                                               value="{{$setting->name}}"
                                               disabled
                                        />
                                    </td>
                                    <td >
                                      <input type="text"
                                             name="email"
                                             class="form{{ $a }} form-control"
                                             value="{{$setting->email}}"
                                             disabled
                                      />
                                    </td>
                                    <td >
                                      <input type="text"
                                             name="password"
                                             class="form{{ $a }} form-control"
                                             placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"
                                             disabled
                                      />
                                    </td>
                                    <td style="vertical-align:middle; text-align: center;">
                                      <input id="form{{ $a }}" type="checkbox">
                                    </td>
                                    <td >
                                      <button
                                          type="submit"
                                          name="submit"
                                          class="form{{ $a }} btn btn-primary"
                                          value="1"
                                          disabled>
                                          Изменить
                                        </button>
                                    </td>
                                </form>
                                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.administrator.delete', $setting->id)}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <td >
                                    <button
                                        type="submit"
                                        name="submit"
                                        class="form{{ $a }} btn btn-primary"
                                        value="1"
                                        disabled>
                                        Удалить
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
                                    <td><h2>Администраторы отсутствуют</h2>
                                    </td>
                                </tr>

                                @endforelse


                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                                    Создание нового админа:
                                </th>

                                <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.administrator.create') }}" method="POST">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <tr role="row" >
                                  <td >
                                      <input type="text"
                                             name="name"
                                             class="form{{ $a }} form-control"
                                             placeholder="Имя"
                                      />
                                  </td>
                                  <td >
                                    <input type="text"
                                           name="email"
                                           class="form{{ $a }} form-control"
                                           placeholder="Email"
                                    />
                                  </td>
                                  <td >
                                    <input type="text"
                                           name="password"
                                           class="form{{ $a }} form-control"
                                           placeholder="Пароль (не менее 8 символов)"
                                    />
                                  </td>

                                  <td style="vertical-align:middle; text-align: center;">
                                    <button
                                        type="submit"
                                        name="submit"
                                        class="btn btn-primary"
                                        value="1">
                                        Создать
                                      </button>
                                  </td>

                                </form>

                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <li class="pagination pull-right">

                                        </li>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
