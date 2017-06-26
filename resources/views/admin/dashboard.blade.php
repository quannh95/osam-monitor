@extends('master')
@section('title', 'Admin Dashboard')
@section('page-header', 'Admin Role')
@section('content')
            <!-- /.row -->
<div class="row">
    <div class="row">
    <div class="col-md-6" style="bottom: 10px;">
        <a href="{{ route('admin.add') }}">
            <button type="button" class="btn btn-secondary btn-lg">
            <i class="glyphicon glyphicon-plus" id="plus"></i>&nbsp;
            Add User</button>
        </a>
    </div>
    </div>
    <div id="dashboard-table">
    @include('admin.dashboard-table')
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="csrf_token"]').val()
            }
        });

        $('#search').on('keyup',function(){
            var key = $(this).val();
            $.ajax({
                type: 'POST',
                url:'admin/search',
                data:{
                    'search': key
                },
                success:function(data){
                    $('#dashboard-table').html(data);
                }
            })
        })
    </script>
</div>
@endsection
