@extends('admin.layout')

@section('crumbs')<li  class="active">Заявки на подарки</li>
@endsection

@section('content')
<h2>Заявки на подарки:</h2>

@isset($path)  <a href="{{ asset('/storage/' . $path) }}">Документ</a>
@endisset

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        ID
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Имя
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Email
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Телефон
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Подарок
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Статус
                    </th>

                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($new_applications  as $new_application)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $new_application->id }}</td>
                    <td style="vertical-align:middle">{{ $new_application->name }}</td>
                    <td style="vertical-align:middle">{{ $new_application->email }}</td>
                    <td style="vertical-align:middle">{{ $new_application->phone }}</td>
                    <td style="vertical-align:middle">{{ $new_application->bonus }}</td>
                    <td style="vertical-align:middle">{{ $new_application->status }}</td>

                    <td>
                      <form role="form" name="edit" enctype="multipart/form-data" action="{{route('admin.bonuses.process')}}" method="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                          <input type="hidden" name="app_id" value="{{ $new_application->id }}" />
                          <input type="submit" onclick="return confirm ('Сменить статус на `В процессе`?')" class="btn btn-primary"  value="В процессе" />
                      </form>
                    </td>
                    <td>
                      <form role="form" name="edit" enctype="multipart/form-data" action="{{route('admin.bonuses.processed')}}" method="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                          <input type="hidden" name="app_id" value="{{ $new_application->id }}" />
                          <input type="hidden" name="donator" value="{{ $new_application->donator_id }}" />
                          <input type="hidden" name="summ" value="{{ $new_application->summ }}" />
                          <input type="submit" onclick="return confirm ('Сменить статус на `Обработана`?')" class="btn btn-primary"  value="Обработана" />
                      </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td><p>Новые заявки отсутствуют</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <br>
        <h3>Обработанные заявки</h3>
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        ID
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Имя
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        Email
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Телефон
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Подарок
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        Статус
                    </th>

                    <th class="action" style="width:30px !important;"></th>
                    <th class="action" style="width:30px !important;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($old_applications  as $old_application)
                <tr role="row" >
                    <td style="vertical-align:middle">{{ $old_application->id }}</td>
                    <td style="vertical-align:middle">{{ $old_application->name }}</td>
                    <td style="vertical-align:middle">{{ $old_application->email }}</td>
                    <td style="vertical-align:middle">{{ $old_application->phone }}</td>
                    <td style="vertical-align:middle">{{ $old_application->bonus }}</td>
                    <td style="vertical-align:middle">{{ $old_application->status }}</td>

                    <td>
                      @if ($old_application->status == 'Обработана')
                        <form role="form" name="edit" enctype="multipart/form-data" action="{{route('admin.bonuses.return')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="donator" value="{{ $old_application->donator_id }}" />
                            <input type="hidden" name="app_id" value="{{ $old_application->id }}" />
                            <input type="hidden" name="summ" value="{{ $old_application->summ }}" />
                            <input type="submit" onclick="return confirm ('Отменить списание и вернуть баллы на счет жертвователя?')" class="btn btn-primary"  value="Отмена списания" />
                        </form>
                      @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td><p>Заявки отсутствуют</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
