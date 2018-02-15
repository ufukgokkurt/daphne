<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('admin.home')}}" class="site_title"><i class="fa fa-leaf"></i> <span>{{ env('APP_NAME') }}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">

            <div class="profile_info">
                <span>Hoşgeldin,</span>
                <h2>{{ Sentinel::getUser()->first_name }}</h2>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Genel</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Anasayfa </a></li>


        </ul>
    </div>
    <div class="menu_section">
        <h3>Ayarlar</h3>
        <ul class="nav side-menu">
            @if (Sentinel::getUser()->hasAnyAccess('user.*'))
            <li><a><i class="fa fa-user"></i> Kullanıcı Yönetimi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @if (Sentinel::getUser()->hasAccess('user.user'))
                    <li><a href="{{route('user.index')}}">Kullanıcılar</a></li>
                    @endif
                    @if (Sentinel::getUser()->hasAccess('user.role'))
                    <li><a href="{{route('role.index')}}">Roller</a></li>
                    @endif
                </ul>
            </li>
            @endif

            <li><a><i class="fa  fa-wrench"></i> Ayarlar <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @if (Sentinel::getUser()->hasAccess('setting.smtp'))
                    <li><a href="{{route('setting.smtp')}}">Mail Ayarları</a></li>
                    @endif
                     @if (Sentinel::getUser()->hasAccess('setting.general'))
                    <li><a href="{{route('setting.general')}}">Genel Ayarlar</a></li>
                    @endif
                </ul>
            </li>

        </ul>
    </div>

</div>
<!-- /sidebar menu -->
    </div>
</div>