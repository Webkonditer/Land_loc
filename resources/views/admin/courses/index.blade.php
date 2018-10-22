@extends('admin.layout')

@section('crumbs')<li  class="active">Курсы</li>
@endsection

@section('content')
<h2>Курсы:</h2>

@isset($path)  <a href="{{ asset('/storage/' . $path) }}">Документ</a>
@endisset

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Добавить курс</a>
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
                        Псевдоним
                    </th>

                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses  as $course)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $course->position }}</td>
                    <td><img height="40"  src="{{ asset('/storage/'.$course->image) }}" alt="..."></td>
                    <td style="vertical-align:middle">{{ $course->name }}</td>
                    <td style="vertical-align:middle">{{ $course->nic }}</td>
                    <td style="vertical-align:middle"><a href="{{ route('admin.courses.edit', ['id' => $course->id]) }}"><i class="icon glyphicon glyphicon-pencil"></i></a></td>
                    <td style="vertical-align:middle"><a onclick="return confirm ('Удалить настройки курса?')" href="{{ route('admin.courses.delete', ['id' => $course->id]) }}"><i class="icon glyphicon glyphicon-remove"></i></a></td>
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
                            {{$courses->links()}}
                        </li> 
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
@endsection
