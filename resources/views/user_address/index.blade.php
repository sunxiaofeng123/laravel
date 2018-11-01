@extends('layouts.app')
@section('title', '收货地址')
@section('content')
    <div class = 'row'>
        <div class = 'col-lg-10 col-lg-offset-1'>
            <div class = 'panel panel-default'>
                <div class = 'panel-heading'>收货地址列表
                    <a href = '{{ route('user_addresses.create') }}' class="pull-right">新增收获地址</a>
                </div>
                <div class = 'panel-body'>
                    <table class = 'table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th>收货人</th>
                                <th>地址</th>
                                <th>邮编</th>
                                <th>电话</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td>{{ $address->contact_name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>{{ $address->zip }}</td>
                                    <td>{{ $address->contact_phone }}</td>
                                    <td>
                                        <a class = 'btn btn-primary' href = "{{ route('user_addresses.edit', ['user_address' => $address->id]) }}">修改</a>
                                        <!-- 把之前删除按钮的表单替换成这个按钮，data-id 属性保存了这个地址的 id，在 js 里会用到 -->
                                        <button class="btn btn-danger btn-del-address" type="button" data-id="{{ $address->id }}">删除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsAfterJs')
    <script>
        $(document).ready(function(){
            $('.btn-del-address').click(function(){
                var id = $(this).data('id');

                swal({
                    title:'确认要删除该地址',
                    icon:'warning',
                    buttons:['取消', '确定'],
                    dangerMode:true,
                })

                    .then(function(willDelete){
                        if (!willDelete) {
                            return;
                        }

                        axios.delete('/user_addresses/'+id)
                            .then(function(){
                                location.reload();
                            })
                    });
            });
        });
    </script>
@endsection