@extends('admin.layout')

@section('crumbs')<li  class="active">Результаты поиска</li>
@endsection

@section('content')
<h2>Результаты поиска:</h2>

<div class="row">

    <div class="col-sm-12"><p></p></div>

</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="">Id</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="">Имя</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="">Email</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="">Город</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="">Опция</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="">Периодичность</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="">Согласие на ежемесячный платеж</a>
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
                    <td style="vertical-align:middle">{{ $donator->monthly }}</td>
                    <td style="vertical-align:middle">{{ $donator->recurring }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.payments.id', ['id' => $donator->id]) }}"><i class="fa fa-eye fa-2" aria-hidden="true"></i></a></td>
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить жертвователя, его подписки и всю историю его платежей?')" href="{{ route('admin.donator.delete', ['id' => $donator->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
                </tr>
                @empty
                <tr>
                    <td><h2>Опции отсутствуют</h2>
                    </td>
                </tr>

                @endforelse
            </tbody>
            <tfoot>
              
            </tfoot>

        </table>
    </div>
</div>
@endsection
