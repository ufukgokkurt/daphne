@extends('backend.layouts.app')
@section('title')
    Kullanıcılar
    @endsection
@section('content')


        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <a href="{{ route('user.create') }}" class="btn btn-primary">Kullanıcı Ekle</a>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kullanıcı Listesi</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        @include('backend.layouts.message')



                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Tümünü Seç <input name="select_all" value="1" id="example-select-all" type="checkbox" /></th>
                                <th>ID</th>
                                <th>Ad Soyad</th>
                                <th>E-posta</th>
                                <th>Rol</th>
                                <th>Oluşturma Tarihi</th>
                                <th>Güncelleme Tarihi</th>
                                <th>İşlem</th>

                            </tr>
                            </thead>


                            <tbody>
                            @foreach($users as $user)

                            <tr>
                                <td>{{ Form::checkbox('sel', $user->id, null, ['class' => ''])}}</td>
                                <td>{{$user->id}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{empty($user->roles()->first())?"":$user->roles()->first()->name}}</td>
                                <td>{{ ($user->created_at)?\Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i'):''}}</td>
                                <td>{{ ($user->updated_at)?\Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i'):''}}</td>
                                <td>

                                    @if(!Activation::completed($user))

                                        <a href="{{route('user.activate', $user->id)}}" class="btn btn-warning btn-xs">Aktif Et</a>

                                    @else

                                        <a href="{{route('user.deactivate', $user->id)}}" class="btn btn-success btn-xs">Pasif Et</a>

                                    @endif
                                    <a href="{{route('user.edit',["id"=>$user->id])}}" class="btn btn-info btn-xs"> Düzenle </a>  {!! Form::open(['route' => ['user.destroy',$user->id],'method' => 'delete','class'=>'sil form-horizontal','style' => 'display:inline']) !!}   {!! Form::submit('Sil', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}{!! Form::close() !!}

                                </td>

                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <button id="delete_all" class='btn btn-danger btn-xs'>Seçilenleri Sil</button>
                        <button id="activate_all" class='btn btn-success btn-xs'>Seçilenleri Aktif Et</button>
                        <button id="deactivate_all" class='btn btn-warning btn-xs'>Seçilenleri Pasif Et</button>
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

           var table=$('#datatable').DataTable({
                "destroy":true,
                "language": {
                    "url": "{{asset('backend/vendors/datatables.net/i18n/tr.json') }}"
                    }
                });

            $(".sil").click(function() {
              return confirm('Silmek istediğinize emin misiniz?');

            });

            $('#example-select-all').on('click', function(){
                // Check/uncheck all checkboxes in the table
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            var token = $("meta[name='csrf-token']").attr('content');

            $("#deactivate_all").click(function(event){
                event.preventDefault();
                if (confirm("Seçilenler pasif edilecek, emin misiniz ?")) {
                    var value=get_Selected_id();
                    if (value!='') {

                        $.ajax({

                            type: "POST",
                            cache: false,
                            url : "{{route('user.ajax')}}",
                            data: {all_id:value,_token:token,action:'deactivate'},
                            success: function(data) {
                                location.reload()
                            }
                        })
                    }else{return confirm("Önce seçim yapmalısınız");}
                }
                return false;
            });

            $("#activate_all").click(function(event){
                event.preventDefault();
                if (confirm("Seçilenler aktif edilecek, emin misiniz ?")) {
                    var value=get_Selected_id();
                    if (value!='') {
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url : "{{route('user.ajax')}}",
                            data: {all_id:value,_token:token,action:'activate'},
                            success: function(data) {
                                location.reload()
                            }
                        })
                    }else{return confirm("Önce seçim yapmalısınız");}
                }
                return false;
            });

            $("#delete_all").click(function(event){
                event.preventDefault();
                if (confirm("Seçilenler silinecek, emin misiniz?")) {
                    var value=get_Selected_id();
                    if (value!='') {
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url : "{{route('user.ajax')}}",
                            data: {all_id:value,_token:token,action:'delete'},
                            success: function(data) {
                                location.reload()
                            }
                        })
                    }else{return confirm("Önce seçim yapmalısınız");}
                }
                return false;
            });





            function get_Selected_id() {
                var searchIDs = $("input[name=sel]:checked").map(function(){
                    return $(this).val();
                }).get();
                return searchIDs;
            }








             });

    </script>
    @endsection