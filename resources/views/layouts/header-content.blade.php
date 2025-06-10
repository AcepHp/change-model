<!-- Mobile Media Block -->
<div class="me-auto pc-mob-drp">
    <ul class="list-unstyled">
        <!-- Sidebar Collapse -->
        <li class="pc-h-item pc-sidebar-collapse">
            <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                <i class="ti ti-menu-2"></i>
            </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
            <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                <i class="ti ti-menu-2"></i>
            </a>
        </li>

    </ul>
</div>

<div class="ms-auto">
    <ul class="list-unstyled">


        <!-- User Profile Dropdown -->
        <li class="dropdown pc-h-item header-user-profile">
            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                <div class="dropdown-header">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </h6>
                            <span>PT. Astra Visteon</span>
                        </div>

                        <a href="{{ route('logout') }}" class="pc-head-link bg-transparent"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="ti ti-power text-danger"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </div>
                </div>

                <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="drp-t1" data-bs-toggle="tab" data-bs-target="#drp-tab-1"
                            type="button" role="tab" aria-controls="drp-tab-1" aria-selected="true">
                            <i class="ti ti-user"></i> Profile
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="mysrpTabContent">
                    <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1"
                        tabindex="0">
                        <a href="{{ route('edit.profile') }}" class="dropdown-item">
                            <i class="ti ti-edit-circle"></i> Edit Profile
                        </a>

                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="ti ti-power"></i> Logout
                        </a>
                    </div>

                </div>
            </div>
        </li>

    </ul>

</div>
<script>
var sidebar_hide = document.querySelector('#sidebar-hide');
if (sidebar_hide) {
    sidebar_hide.addEventListener('click', function() {
        if (document.querySelector('.pc-sidebar').classList.contains('pc-sidebar-hide')) {
            document.querySelector('.pc-sidebar').classList.remove('pc-sidebar-hide');
        } else {
            document.querySelector('.pc-sidebar').classList.add('pc-sidebar-hide');
        }
    });
}

// Menu collapse click start
var mobile_collapse_over = document.querySelector('#mobile-collapse');
if (mobile_collapse_over) {
    mobile_collapse_over.addEventListener('click', function() {
        var temp_sidebar = document.querySelector('.pc-sidebar');
        if (temp_sidebar) {
            if (document.querySelector('.pc-sidebar').classList.contains('mob-sidebar-active')) {
                rm_menu();
            } else {
                document.querySelector('.pc-sidebar').classList.add('mob-sidebar-active');
                document.querySelector('.pc-sidebar').insertAdjacentHTML('beforeend',
                    '<div class="pc-menu-overlay"></div>');
                document.querySelector('.pc-menu-overlay').addEventListener('click', function() {
                    rm_menu();
                });
            }
        }
    });
}
// Menu collapse click end

// Menu collapse click start
var mobile_collapse = document.querySelector('.pc-horizontal #mobile-collapse');
if (mobile_collapse) {
    mobile_collapse.addEventListener('click', function() {
        if (document.querySelector('.topbar').classList.contains('mob-sidebar-active')) {
            rm_menu();
        } else {
            document.querySelector('.topbar').classList.add('mob-sidebar-active');
            document.querySelector('.topbar').insertAdjacentHTML('beforeend',
                '<div class="pc-menu-overlay"></div>');
            document.querySelector('.pc-menu-overlay').addEventListener('click', function() {
                rm_menu();
            });
        }
    });
}
</script>