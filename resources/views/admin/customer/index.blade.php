@extends('layouts.app')
@section('title', trans('common.news.title'))

@section('breadcrumb')
    <div class="page-title">
        <h3>{{trans('common.news.title')}}</h3>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="row" style="margin-top: 25px">
                    <div class="col-md-4">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="email" class="form-control search-box" id="Filter_search" aria-describedby="emailHelp"
                            placeholder="Search by title" name="search" >
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route ('home.create') }}" class="btn btn-primary float-right">{{trans('common.news.add_new')}}
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive hide-search-datatable custom-table">
                            <table id="new" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="font-weight: bold; width:5px;">{{trans('common.news.table.no')}}</th>
                                        <th style="font-weight: bold; width:5px;">{{trans('common.news.table.title')}}</th>
                                        <th style="font-weight: bold; width:5px;">{{trans('common.news.table.created_date')}}</th>
                                        <th style="font-weight: bold; width:5px;">{{trans('common.news.table.action')}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>
    $(document).ready(function () {
        var table = $('#new').DataTable({
            "dom": '<"top">rt<"bottom mt-3"<"row justify-content-between m-0"<"col-6"li><"col-6 row justify-content-end"p>>><"clear">',
            processing: true,
            deferRender: true,
            serverSide: true,
            ajax: {
                url: "{{ route('home.getData') }}",
                data: function (d) {
                    d.title = $('#Filter_search').val();
                }

            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', className:'text-center align-middle'},
                {data: 'name', name: 'name', className: 'text-center align-middle mw-300',width: '30%', orderable: false},
                {data: 'created_at', name: 'created_at', className: 'text-center align-middle mw-300',width: '30%', orderable: false},
                {data: 'action', name: 'action', className: 'text-center align-middle minw-table', orderable: false, searchable: false, width: '10%'},
            ],
            "pageLength": 10,
        });
        
        $('body').on('keyup', '#Filter_search', function() {
            table.draw();
        })
        
    })    

    $('body').on('click', '.btn-delete', function() {
        let url = $(this).data('url');
        console.log(url);
        let datatable = $('#new');
        confirmDelete(url, datatable, "News");
    })
</script>
    
@endsection

