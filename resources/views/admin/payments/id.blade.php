@extends('admin.layout')

@section('crumbs')<li  class="active">Платежи</li>
@endsection

@section('content')
<h3>Жертвователь:</h3>

<div class="row">
    <div class="col-sm-12">

      <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

          <tbody>

              <tr role="row" >
                  <td style="vertical-align:middle">ID</td>
                  <td style="vertical-align:middle">{{ $donator->id }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Имя</td>
                  <td style="vertical-align:middle">{{ $donator->name }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Email</td>
                  <td style="vertical-align:middle">{{ $donator->email }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Телефон</td>
                  <td style="vertical-align:middle">{{ $donator->phone }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Город</td>
                  <td style="vertical-align:middle">{{ $donator->city }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Опция</td>
                  <td style="vertical-align:middle">{{ $donator->format_name }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Сумма</td>
                  <td style="vertical-align:middle">{{ $donator->summ }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Периодичность</td>
                  <td style="vertical-align:middle">{{ $donator->monthly }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Зарегистрирован</td>
                  <td style="vertical-align:middle">{{ $donator->created_at }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Согласие на ежемесячный платеж</td>
                  <td style="vertical-align:middle">{{ $donator->recurring }}</td>
              </tr>
              <tr role="row" >
                  <td style="vertical-align:middle">Анонимный</td>
                  <td style="vertical-align:middle">{{ $donator->anonim }}</td>
              </tr>

          </tbody>
      </table>

      <h3>Платежи жертвователя:</h3>

        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Номер чека
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Id жертвователя
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Id опции
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Сумма пожертвования
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Периодичность
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Дата
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Платеж подтвержден
                    </th>
                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments  as $payment)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $payment->id }}</td>
                    <td style="vertical-align:middle">{{ $payment->donator_id }}</td>
                    <td style="vertical-align:middle">{{ $payment->format_id }}</td>
                    <td style="vertical-align:middle">{{ $payment->summ }}</td>
                    <td style="vertical-align:middle">{{ $payment->monthly }}</td>
                    <td style="vertical-align:middle">{{ $payment->created_at }}</td>
                    <td style="vertical-align:middle">{{ $payment->confirmation }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.donator.edit', ['id' => $payment->id]) }}">{{--<i class="icon glyphicon glyphicon-pencil"></i>--}}</a></td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.donator.delete', ['id' => $payment->id]) }}">{{--<i class="icon glyphicon glyphicon-remove"></i>--}}</a></td>
                </tr>
                @empty
                <tr>
                    <td>
                      <h3 style="color:green">Платежи не найдены</h3>
                    </td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
