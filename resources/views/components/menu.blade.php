<section>
    <nav>
        <ul>
            <li>
                <a href="{{ route('dashboard.index') }}" @if (URL::full() == route('dashboard.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-dashboard"></i></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('company.index') }}" @if (URL::full() == route('company.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-company"></i></span>
                    <span>Company</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employee.index') }}" @if (URL::full() == route('employee.index')) class="active" @endif>
                    <span class="icon"><i class="tes te-employee"></i></span>
                    <span>Employee</span>
                </a>
            </li>
        </ul>
    </nav>
</section>
