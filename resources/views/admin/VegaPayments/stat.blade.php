@extends('admin.layout')

@section('crumbs')<li  class="active">Статистика</li>@endsection


@section('content')


<div class="row">
    <h3>Статистика:</h3>
    <div class="col-sm-12">


        <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">

                    </th>
                    @foreach($course_names  as $course_name)
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Название: активируйте, чтобы изменить сортировку">
                          {{ $course_name }}
                      </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($year_results  as $year_result)
                  <tr role="row" >
                    @foreach($year_result  as $key => $manth_result)
                      @if ($key == 0)
                        <td style="vertical-align:middle"><strong>{{ $manth_result }}</strong></td>
                      @else
                        <td style="vertical-align:middle">{{ $manth_result }}</td>
                      @endif

                    @endforeach
                  </tr>
                @endforeach
            </tbody>

        </table>
      </div>
    </div>
@endsection
