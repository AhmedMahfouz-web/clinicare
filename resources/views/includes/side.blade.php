<div class="left_sidebar">
    <nav class="sidebar">
        <div class="user-info pb-3" style="margin-top:-50px">
            <div class="image"><a href="javascript:void(0);"><img src="{{ asset('images/user.png') }}" alt="User"></a>
            </div>
            <div class="detail mt-3">
                <h5 class="mb-0">{{ auth()->guard('admin')->user()->name }}</h5>
                <small>{{ auth()->guard('admin')->user()->role }}</small>
            </div>
        </div>
        <ul id="main-menu" class="metismenu mb-5">
            <li {{ Request::is('dashboard') ? 'class=active' : '' }}><a href="{{ route('dashboard') }}"><i
                        class="ti-home"></i><span>الرئيسية</span></a></li>

            <li {{ Request::is('meeting/*', 'meeting') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-desktop "></i><span>طلبات المقابلات</span>
                </a>
                <ul>
                    <li><a href="{{ route('show meetings') }}">عرض طلبات المقابلات</a></li>
                </ul>
            </li>

            <li {{ Request::is('report/*', 'report') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-clipboard "></i><span>طلبات التقارير</span>
                </a>
                <ul>
                    <li><a href="{{ route('show reports') }}">عرض طلبات التقارير</a></li>
                    <li><a href="{{ route('show answered reports') }}">عرض التقارير </a></li>
                </ul>
            </li>
            <li {{ Request::is('reservation/*', 'reservation') ? 'class=active' : '' }}>
                <a href="{{ route('show reservations') }}" class="has-arrow"><i class="ti-blackboard"></i><span>حجوزات
                        الاشعة
                        و التحاليل</span>
                </a>
                {{-- <ul>
                    <li><a href="{{ route('show reports') }}">عرض حجوزات الاشعة و
                            التحاليل</a></li>
                </ul> --}}
            </li>
            <li {{ Request::is('hospital/*', 'hospital') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-truck"></i><span>المستشفيات و
                        المعامل</span>
                </a>
                <ul>
                    <li><a href="{{ route('show hospitals') }}">عرض المستشفيات و المعامل</a></li>
                    <li><a href="{{ route('create hospital') }}">اضافة مستشفي او معمل</a></li>
                </ul>
            </li>
            <li {{ Request::is('users/*', 'users') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-id-badge "></i><span>المستخدمين</span>
                </a>
                <ul>
                    <li><a href="{{ route('show users') }}">عرض المستخدمين</a></li>
                </ul>
            </li>
            <li {{ Request::is('doctors/*', 'doctors') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-id-badge "></i><span>الاطباء</span>
                </a>
                <ul>
                    <li><a href="{{ route('show doctors') }}">عرض الاطباء</a></li>
                </ul>
            </li>
            <li {{ Request::is('test/*', 'test') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-blackboard"></i><span>الاشاعات و
                        التحاليل</span>
                </a>
                <ul>
                    <li><a href="{{ route('show tests') }}">عرض الاشاعات و التحاليل</a></li>
                    <li><a href="{{ route('create test') }}">اضافة اشعة او تحليل</a></li>
                </ul>
            </li>
            <li {{ Request::is('profession/*', 'profession') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-view-list-alt"></i><span>التخصصات</span>
                </a>
                <ul>
                    <li><a href="{{ route('show professions') }}">عرض التخصصات</a></li>
                    <li><a href="{{ route('create profession') }}">اضافة تخصص</a></li>
                </ul>
            </li>
            <li {{ Request::is('contact/*', 'contact') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-comment-alt"></i><span>الرسائل</span>
                </a>
                <ul>
                    <li><a href="{{ route('show contact') }}">عرض الرسائل</a></li>
                </ul>
            </li>
            <li {{ Request::is('reviews/*', 'reviews') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-star"></i><span>التقيينات</span>
                </a>
                <ul>
                    <li><a href="{{ route('show reviews') }}">عرض التقييمات</a></li>
                </ul>
            </li>
            <li {{ Request::is('partner/*', 'partner') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-layout-grid3"></i><span>الشركاء</span>
                </a>
                <ul>
                    <li><a href="{{ route('show partners') }}">عرض الشركاء</a></li>
                    <li><a href="{{ route('create partner') }}">اضافة شريك</a></li>
                </ul>
            </li>
            <li {{ Request::is('blogs/*', 'blogs') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-pencil-alt"></i><span>المدونات</span>
                </a>
                <ul>
                    <li><a href="{{ route('show blogs') }}">عرض المدونات</a></li>
                    <li><a href="{{ route('create blog') }}">اضافة المدونات</a></li>
                </ul>
            </li>
            <li {{ Request::is('pay_numbers/*', 'pay_numbers') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-bag"></i><span>حسابات التحويل</span>
                </a>
                <ul>
                    <li><a href="{{ route('show numbers') }}">عرض الحسابات</a></li>
                    <li><a href="{{ route('create numbers') }}">اضافة حساب</a></li>
                </ul>
            </li>
            <li {{ Request::is('pricing/*', 'pricing') ? 'class=active' : '' }}>
                <a href="javascript:void(0)" class="has-arrow"><i class="ti-money"></i><span>التسعير</span>
                </a>
                <ul>
                    <li><a href="{{ route('show prices') }}">عرض الاسعار</a></li>
                </ul>
            </li>
            @if (auth()->guard('admin')->user()->role == 'صاحب منشأة')
                <li {{ Request::is('admin/*', 'admin') ? 'class=active' : '' }}>
                    <a href="javascript:void(0)" class="has-arrow"><i class="ti-user "></i><span>الاداريون</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('show admins') }}">عرض الاداريين</a></li>
                        <li><a href="{{ route('create admin') }}">اضافة اداري</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</div>
