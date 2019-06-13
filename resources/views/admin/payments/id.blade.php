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
              <tr role="row" >
                  <td style="vertical-align:middle">Чайтаньи</td>
                  <td style="vertical-align:middle">@if ($donator->bonus_points > 0) {{ $donator->bonus_points }} @else 0 @endif</td>
              </tr>

          </tbody>
      </table>

      <h3>Подписка:</h3>



      <div class="row">
          <div class="col-sm-12">
            @if (isset($recurring->id))
              <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                      <tr role="row">
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                              Id
                          </th>
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                              Номер первого чека
                          </th>
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                              Опция
                          </th>
                          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                              Id опции
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                              Сумма пожертвования
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                              Зарегистрирована
                          </th>

                          <th class="action" style="width:30px !important;"></th>
                          <th class="action" style="width:30px !important;"></th>
                      </tr>
                  </thead>
                  <tbody>

                      <tr role="row" >
                          <td style="vertical-align:middle">{{ $recurring->id }}</td>
                          <td style="vertical-align:middle">{{ $recurring->payment_id }}</td>
                          <td style="vertical-align:middle">{{ $format->name }}</td>
                          <td style="vertical-align:middle">{{ $recurring->format_id }}</td>
                          <td style="vertical-align:middle">{{ $recurring->summ }}</td>
                          <td style="vertical-align:middle">{{ $recurring->created_at }}</td>
                          <td style="vertical-align:middle"><a href="{{ route('admin.donator.edit', ['id' => $recurring->id]) }}">{{--<i class="icon glyphicon glyphicon-pencil"></i>--}}</a></td>
                          <td style="vertical-align:middle"><a onclick="return confirm ('Удалить эту ежемесячную подписку?')" href="{{ route('admin.recurring.delete', ['id' => $recurring->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
                      </tr>
                  </tbody>
              </table>
            @else
                      <p style="color:green">Подписки отсутствуют.</p>
            @endif
          </div>
      </div>

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
                      <p style="color:green">Платежи не найдены</p>
                    </td>
                </tr>

                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
