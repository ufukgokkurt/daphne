@extends('backend.layouts.app')
@section('title')
    Roller
    @endsection
@section('content')


        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <a href="{{ route('role.create') }}" class="btn btn-primary">Rol Ekle</a>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Rol Listesi</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        @include('backend.layouts.message')

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th>Oluşturma Tarihi</th>
                                <th>Güncelleme Tarihi</th>
                                <th>İşlem</th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{ ($role->created_at)?\Carbon\Carbon::parse($role->created_at)->format('d/m/Y H:i'):''}}</td>
                                <td>{{ ($role->updated_at)?\Carbon\Carbon::parse($role->updated_at)->format('d/m/Y H:i'):''}}</td>
                                <td>
                                    @if(($role->id!=1) && ($role->id!=2))
                                    <a href="{{route('role.edit',["id"=>$role->id])}}" class="btn btn-info btn-xs"> Düzenle </a>  {!! Form::open(['route' => ['role.destroy',$role->id],'method' => 'delete','class'=>'sil form-horizontal','style' => 'display:inline']) !!}   {!! Form::submit('Sil', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}{!! Form::close() !!}
                                @endif


                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="{{ asset('backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    @endsection
@section('js')

    <script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{asset('backend/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{asset('backend/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{asset('backend/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{asset('backend/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script>
        $(document).ready( function() {
            $('#datatable').dataTable({
                "destroy":true,
                "language": {
                    "url": "{{asset('backend/vendors/datatables.net/i18n/tr.json') }}"
                    }
                });

            $(".sil").click(function() {
               return confirm('Silmek istediğinize emin misiniz?');

            });
             });

    </script>
    @endsection