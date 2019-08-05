@extends('admin.layout')

@section('crumbs')<li  class="active">Оплата курсов</li>
@endsection

@section('content')
<h2>Оплата курсов:</h2>

<div class="row">
    <div class="col-sm-12">
      Поиск по Email:
    </div>
          <div class="col-sm-12">
            <form role="form" name="edit" enctype="multipart/form-data" action="" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="text"
                     name="email"
                     class="col-sm-4"
                     value="{{old('email')}}"
                     placeholder="Введите нужный Email"
              />
              <button type="submit" name="submit" value="1" >Найти</button>
            </form>
          </div>

          <div class="col-sm-12">
            Поиск по номеру группы:
          </div>
                <div class="col-sm-12">
                  <form role="form" name="edit" enctype="multipart/form-data" action="" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="text"
                           name="group"
                           class="col-sm-4"
                           value="{{old('group')}}"
                           placeholder="Введите номер группы цифрой"
                    />
                    <button type="submit" name="submit" value="1" >Найти</button>
                  </form>

                  <a href="{{route('admin.courses.payments')}}">
                      <button style="color: #333339; margin-top: 15px;">Сбросить фильтр</button>
                  </a>



                </div>

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
          </div>

    <div class="col-sm-12"><p></p></div>

</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        N чека
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Дата
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Имя
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Email
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Группа
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Курс
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Модуль
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Сумма
                    </th>
                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments  as $payment)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $payment->id+1000000 }}</td>
                    <td style="vertical-align:middle">{{ $payment->created_at }}</td>
                    <td style="vertical-align:middle">{{ $payment->name }}</td>
                    <td style="vertical-align:middle">{{ $payment->email }}</td>
                    <td style="vertical-align:middle">{{ $payment->group_id }}</td>
                    <td style="vertical-align:middle">{{ $payment->course_name }}</td>
                    <td style="vertical-align:middle">{{ $payment->module }}</td>
                    <td style="vertical-align:middle">{{ $payment->summ }}</td>
                    <td style="vertical-align:middle">{{--<a href="{{-- route('admin.payments.id', ['id' => $payment->id]) }}"><i class="fa fa-eye fa-2" aria-hidden="true"></i></a>--}}</td>
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить информацию о платеже из базы?')" href="{{ route('admin.courses.payments.delete', ['id' => $payment->id, 'filter' => $filter]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
                </tr>
                @empty
                <tr>
                    <td><p style="color:green">Платежи отсутствуют.</p>
                    </td>
                </tr>

                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <li class="pagination pull-right">
                            {{$payments->links()}}
                        </li>
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
