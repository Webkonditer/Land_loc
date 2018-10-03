@extends('admin.layout')

@section('crumbs')<li  class="active">Жертвователи</li>
@endsection

@section('content')
<h2>Жертвователи:</h2>

<div class="row">
  <div class="col-sm-12">
      Выборки:
  </div>
    <div class="col-sm-12">
        <a href="{{ route('admin.donators.sort.monthly', ['sort' => 'id']) }}">- Только с ежемесячным платежом</a>
    </div>
    <div class="col-sm-12">
        <b>- Только с разовым платежом</b>
    </div>
    <div class="col-sm-12">
        <a href="{{ route('admin.donators') }}">- Все</a>
    </div>
    <div class="col-sm-12"><p></p></div>

</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'id']) }}">Id</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'name']) }}">Имя</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'email']) }}">Email</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'city']) }}">Город</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'format_name']) }}">Опция</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'summ']) }}">Сумма пожертвования</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'monthly']) }}">Периодичность</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'created_at']) }}">Зарегистрирован</a>
                    </th>
                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($donators  as $donator)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $donator->id }}</td>
                    <td style="vertical-align:middle">{{ $donator->name }}</td>
                    <td style="vertical-align:middle">{{ $donator->email }}</td>
                    <td style="vertical-align:middle">{{ $donator->city }}</td>
                    <td style="vertical-align:middle">{{ $donator->format_name }}</td>
                    <td style="vertical-align:middle">{{ $donator->summ }}</td>
                    <td style="vertical-align:middle">{{ $donator->monthly }}</td>
                    <td style="vertical-align:middle">{{ $donator->created_at }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.payments.id', ['id' => $donator->id]) }}"><i class="fa fa-eye fa-2" aria-hidden="true"></i></a></td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.donator.delete', ['id' => $donator->id]) }}">{{--<i class="icon glyphicon glyphicon-remove"></i>--}}</a></td>
                </tr>
                @empty
                <tr>
                    <td><h2>Опции отсутствуют</h2>
                    </td>
                </tr>

                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <li class="pagination pull-right">
                            {{$donators->links()}}
                        </li> .
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
