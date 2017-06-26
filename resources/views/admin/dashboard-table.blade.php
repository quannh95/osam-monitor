<table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>STT</th>
                <th>Username</th>
                <th>Level</th>
                <th>Edit/ Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 0; ?>
            @foreach($data as $item)
            <?php $stt = $stt + 1; ?>
            <tr>
            <td id="serial"><strong>{{ $stt }}</strong></td>
            <td>{{ $item->name }}</td>
            @if($item->id == 1)
                <td>Super Admin</td>
            @elseif($item->id != 1 && $item->role == 1)
                <td>Admin</td>
            @elseif($item->id != 1 &&  $item->role == 2)
                <td>Member</td>
            @endif
            <td id="permission">
                <a href="{{ route('admin.edit',$item->id) }}"><button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i></button></a>&nbsp;&nbsp;
                <a href="{{ route('admin.delete',$item->id) }}"><button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button></a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row" style="text-align: center;">{{ $data->links() }}</div>