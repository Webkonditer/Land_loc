@extends('admin.layout')

@section('crumbs')<li  class="active">Список курсов</li>
@endsection

@section('content')
<h2>Список курсов:</h2>

@isset($path)  <a href="{{ asset('/storage/' . $path) }}">Документ</a>
@endisset

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('admin.formats.create') }}" class="btn btn-primary">Добавить новый курс</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Позиция
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Миниатюра
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Название
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Стоимость курса
                    </th>
                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($formats  as $format)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $format->position }}</td>
                    <td><img height="40"  src="{{ asset('/storage/'.$format->image) }}" alt="..."></td>
                    <td style="vertical-align:middle">{{ $format->name }}</td>
                    <td style="vertical-align:middle">{{ $format->summ }}/{{ $format->summ2 }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.formats.edit', ['id' => $format->id]) }}"><i class="icon glyphicon glyphicon-pencil"></i></a></td>
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить опцию?')" href="{{ route('admin.formats.delete', ['id' => $format->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
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
                            {{$formats->links()}}
                        </li> .
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
