@extends('admin.layout')

@section('crumbs')<li  class="active">Учащиеся</li>
@endsection

@section('content')
<h2>Учащиеся:</h2>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegausers.sort', ['sort' => 'id']) }}">Id</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegausers.sort', ['sort' => 'name']) }}">Имя</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegausers.sort', ['sort' => 'email']) }}">Email</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegausers.sort', ['sort' => 'created_at']) }}">Зарегистрирован</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.vegausers.sort', ['sort' => 'last_payment']) }}">Последний платеж</a>
                    </th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($vegausers  as $vegauser)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $vegauser->id }}</td>
                    <td style="vertical-align:middle">{{ $vegauser->name }}</td>
                    <td style="vertical-align:middle">{{ $vegauser->email }}</td>
                    <td style="vertical-align:middle">{{ $vegauser->created_at }}</td>
                    <td style="vertical-align:middle">{{ $vegauser->last_payment }}</td>
                    {{--<td style="vertical-align:middle"><a href="{{ route('admin.payments.id', ['id' => $vegauser->id]) }}"><i class="fa fa-eye fa-2" aria-hidden="true"></i></a></td>--}}
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить учащегося и всю историю его платежей?')" href="{{ route('admin.vegausers.delete', ['id' => $vegauser->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
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
                            {{$vegausers->links()}}
                        </li> .
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
