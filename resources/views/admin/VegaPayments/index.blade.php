@extends('admin.layout')

@section('crumbs')<li  class="active">Платежи</li>
@endsection

@section('content')
<h2>Платежи:</h2>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegapayments.sort', ['sort' => 'id']) }}">Номер чека</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegapayments.sort', ['sort' => 'user_id']) }}">Id Учащегося</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegapayments.sort', ['sort' => 'course_id']) }}">Id курса</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegapayments.sort', ['sort' => 'summ']) }}">Сумма платежа</a>
                    </th>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegapayments.sort', ['sort' => 'created_at']) }}">Дата</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegapayments.sort', ['sort' => 'confirmation']) }}">Платеж подтвержден</a>
                    </th>
                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments  as $payment)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $payment->id }}</td>
                    {{--<td style="vertical-align:middle"><a href="{{ route('admin.vegapayments.id', ['id' => $payment->donator_id]) }}">{{ $payment->user_id }}</a></td>--}}
                    <td style="vertical-align:middle">{{ $payment->user_id }}</td>
                    <td style="vertical-align:middle">{{ $payment->course_id }}</td>
                    <td style="vertical-align:middle">{{ $payment->summ }}</td>
                    <td style="vertical-align:middle">{{ $payment->created_at }}</td>
                    <td style="vertical-align:middle">{{ $payment->confirmation }}</td>
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить информацию о платеже из истории?')" href="{{ route('admin.vegapayments.delete', ['id' => $payment->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
                </tr>
                @empty
                <tr>
                    <td>
                      <h2>Платежи отсутствуют</h2>
                    </td>
                </tr>

                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <li class="pagination pull-right">
                            {{$payments->links()}}
                        </li> .
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
