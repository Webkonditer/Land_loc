@extends('admin.layout')

@section('crumbs')<li  class="active">Статистика</li>@endsection


@section('content')


<div class="row">
    <h3> Статистика по подаркам:</h3>
    <div class="col-sm-12">

        <h4>Потрачено на подарки:</h4>
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    </th>
                    @foreach($months  as $month)
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                          {{ $month['month'] }}.{{ $month['year'] }}
                      </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
              <tr role="row" >
                @foreach($month_summs  as $month_summ)
                        <td style="vertical-align:middle">{{ $month_summ }}</td>
                @endforeach
              </tr>
            </tbody>
        </table>
        <h4>Итоговая сумма потенциальных подарков - {{ $donator_summ }} рублей</h4>
      </div>
    </div>
@endsection
