<nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'home' ? 'active' : '' ?>" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'class_list' ? 'active' : '' ?>" href="./?page=class_list">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'student_list' ? 'active' : '' ?>" href="./?page=student_list">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'attendance' ? 'active' : '' ?>" href="./?page=attendance">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'attendance_report' ? 'active' : '' ?>" href="./?page=attendance_report">Report</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>