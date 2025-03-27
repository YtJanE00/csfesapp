@php
    $curr_route = request()->route()->getName();

    $dashActive = in_array($curr_route, ['home']) ? 'active' : '';
    $questActive = in_array($curr_route, ['defquestionStore']) ? 'active' : '';
    $formActive = in_array($curr_route, ['formRead', 'formQuestion']) ? 'active' : '';
    $reportActive = in_array($curr_route, ['reportRead', 'reportViewSurvey']) ? 'active' : '';
    $userActive = in_array($curr_route, ['userRead']) ? 'active' : '';
@endphp
<aside class="main-sidebar sidebar-green-primary elevation-1">
    <a href="" class="brand-link text-center" style="background-color: #1f5036;">
        <span class="brand-text font-weight-bold text-light">Customer Satisfaction Feedback</span>
    </a>
    
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('style/img/cpsulogov4.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @auth('web')
                        @if(in_array(Auth::guard('web')->user()->role, ['Administrator', 'User']))
                            {{ Auth::guard('web')->user()->fname }} {{ Auth::guard('web')->user()->lname }}
                        @endif
                    @endauth
                </a>
                <span style="font-size: 10pt; color: #5e5e5e;">
                    <i class="fa fa-circle text-success" style="font-size: 8pt"></i>
                    @auth('web')
                        @if(in_array(Auth::guard('web')->user()->role, ['Administrator', 'User']))
                            {{ Auth::guard('web')->user()->dept }}
                        @endif
                    @endauth
                </span>
            </div>
        </div>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link  {{ $dashActive }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('formRead') }}" class="nav-link  {{ $formActive }}">
                    <i class="nav-icon fas fa-solid fa-bars-progress"></i>
                    <p>
                        Trainings
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('reportRead') }}" class="nav-link {{ $reportActive }}">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Evaluation Report
                    </p>
                </a>
            </li>

            @if(Auth::guard('web')->user()->role == 'Administrator')
                <li class="nav-item">
                    <a href="{{ route('userRead') }}" class="nav-link {{ $userActive }}">
                        <i class="nav-icon fas fa-user-gear"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            @endif
        </ul>
</aside>