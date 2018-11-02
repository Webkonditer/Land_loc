@extends('admin.layout')

@section('crumbs')<li  class="active">Жертвователи</li>
@endsection

@section('content')
<h2>Жертвователи:</h2>

<div class="row">
    <div class="col-sm-12">
      Поиск по Email:
    </div>
    <form role="form" name="edit" enctype="multipart/form-data" action="{{ route('admin.donators.search')}}" method="POST">



        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="col-sm-12">
              <input type="text"
                     name="email"
                     class="col-sm-4"
                     value="{{old('email')}}"
                     placeholder="Введите нужный Email"
              />
              <button type="submit" name="submit" value="1" >Найти</button>
          </div>
          <div class="col-sm-12">
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
          </div>
    <div class="col-sm-12">
      Выборки:
    </div>
    <div class="col-sm-12">
        <a href="{{ route('admin.donators.sort.monthly', ['sort' => 'id']) }}">- Только с ежемесячным платежом</a>
    </div>
    <div class="col-sm-12">
        <a href="{{ route('admin.donators.sort.one_time', ['sort' => 'id']) }}">- Только с разовым платежом</a>
    </div>
    <div class="col-sm-12">
        <a href="{{ route('admin.donators') }}">- Все</a>
    </div>
    <div class="col-sm-12"><p></p></div>
    <div class="col-sm-12">
      Выгрузить email:<br>
      @forelse ($urls as $url)
        <a href="{{ asset('storage/i/emails/'.$url) }}">{{ $url }} </a>&nbsp;&nbsp;

      @empty
        Адреса в базе отсутствуют.
      @endforelse
    </div>
    <div class="col-sm-12"><p></p></div>
    <div class="col-sm-12">
      Выгрузить Чайтаньи:<br>
        <a href="{{ asset('storage/i/Чайтаньи.csv') }}">Чайтаньи.csv</a>
    </div>
    <div class="col-sm-12"><p></p></div>

</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort', ['sort' => 'id']) }}">Id</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort', ['sort' => 'name']) }}">Имя</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort', ['sort' => 'email']) }}">Email</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort', ['sort' => 'city']) }}">Город</a>
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort', ['sort' => 'format_name']) }}">Опция</a>
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Код: активируйте, чтобы изменить сортировку">
                        <a href="{{ route('admin.donators.sort', ['sort' => 'monthly']) }}">Периодичность</a>
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
