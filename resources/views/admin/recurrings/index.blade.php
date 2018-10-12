@extends('admin.layout')

@section('crumbs')<li  class="active">Ежемесячные платежи</li>
@endsection

@section('content')
<h2>Ежемесячные платежи:</h2>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{-- route('admin.payments.sort', ['sort' => 'id']) --}}">Id</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{-- route('admin.payments.sort', ['sort' => 'id']) --}}">Номер первого чека</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{-- route('admin.payments.sort', ['sort' => 'donator_id']) --}}">Id жертвователя</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{-- route('admin.payments.sort', ['sort' => 'format_id']) --}}">Id опции</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{-- route('admin.payments.sort', ['sort' => 'summ']) --}}">Сумма пожертвования</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{-- route('admin.payments.sort', ['sort' => 'created_at']) --}}">Зарегистрирован</a>
                    </th>

                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recurrings  as $recurring)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $recurring->id }}</td>
                    <td style="vertical-align:middle">{{ $recurring->payment_id }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.payments.id', ['id' => $recurring->donator_id]) }}">{{ $recurring->donator_id }}</a></td>
                    <td style="vertical-align:middle">{{ $recurring->format_id }}</td>
                    <td style="vertical-align:middle">{{ $recurring->summ }}</td>
                    <td style="vertical-align:middle">{{ $recurring->created_at }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.donator.edit', ['id' => $recurring->id]) }}">{{--<i class="icon glyphicon glyphicon-pencil"></i>--}}</a></td>
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить эту ежемесячную подписку?')" href="{{ route('admin.recurring.delete', ['id' => $recurring->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
                </tr>
                @empty
                <tr>
                    <td>
                      <h2>Ежемесячные платежи отсутствуют.</h2>
                    </td>
                </tr>

                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <li class="pagination pull-right">
                            {{$recurrings->links()}}
                        </li> .
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
