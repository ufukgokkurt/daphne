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
            @if (Sentinel::getUser()->hasAccess('admin.page'))
                <li><a href="{{route('page.index')}}"><i class="fa  fa-clone"></i>Sayfalar</a></li>
            @endif

            @if (Sentinel::getUser()->hasAccess('admin.banner'))
                <li><a href="{{route('banner.index')}}"><i class="fa   fa-bullhorn"></i>Banner</a></li>
            @endif
            @if (Sentinel::getUser()->hasAccess('product.*'))
                <li><a><i class="fa    fa-gift "></i> Ürünler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if (Sentinel::getUser()->hasAccess('product.product'))
                        <li><a href="{{route('product.index')}}">Ürün Listesi</a></li>
                         <li><a href="{{route('product.xml')}}">XML'den Ürün Yükle</a></li>
                        @endif



                        @if (Sentinel::getUser()->hasAccess('product.category'))
                        <li><a href="{{route('category.index')}}">Kategoriler</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (Sentinel::getUser()->hasAccess('admin.news'))
                <li><a href="{{route('news.index')}}"><i class="fa   fa-newspaper-o"></i>Haber & Duyuru</a></li>
            @endif
            @if (Sentinel::getUser()->hasAccess('admin.service'))
                <li><a href="{{route('service.index')}}"><i class="fa    fa-recycle"></i>Hizmetler</a></li>
            @endif
            @if (Sentinel::getUser()->hasAccess('admin.reference'))
                <li><a><i class="fa   fa-users"></i> Referanslar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                            <li><a href="{{route('reference.index')}}">Referans Listesi</a></li>
                            <li><a href="{{route('reference_cat.index')}}">Kategoriler</a></li>

                    </ul>
                </li>
            @endif
            @if (Sentinel::getUser()->hasAccess('admin.teklif'))
                <li><a href="{{route('teklif.index')}}"><i class="fa    fa-certificate"></i>Teklif Formları</a></li>
            @endif
            @if (Sentinel::getUser()->hasAccess('admin.newsletter'))
                <li><a href="{{route('newsletter.index')}}"><i class="fa    fa-paper-plane-o"></i>E-mail Listesi</a></li>
            @endif
        </ul>
    </div>
    <div class="menu_section">
        <h3>Ayarlar</h3>
        <ul class="nav side-menu">
            @if (Sentinel::getUser()->hasAnyAccess(['admin.user','admin.role']))
            <li><a><i class="fa fa-user"></i> Kullanıcı Yönetimi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @if (Sentinel::getUser()->hasAccess('admin.user'))
                    <li><a href="{{route('user.index')}}">Kullanıcılar</a></li>
                    @endif
                    @if (Sentinel::getUser()->hasAccess('admin.role'))
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