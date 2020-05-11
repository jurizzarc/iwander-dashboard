    <!---------- FIXED SIDEBAR ---------->
    <div class="sidenav d-none d-lg-block d-md-block">
            
        <div class="sidenav-logo">
            <img src="{{ asset('/images/iwander-logo-lg.png') }}" alt="iWander Logo" />
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                <img src="{{ asset('../images/default-image.png') }}">
            </div>
            
            <div class="user-name">
                <h4>
                    <?php
                        $fullName = Auth::user()->name;
                        $firstName = explode(' ',trim($fullName));
                        echo $firstName[0];
                    ?>
                </h4>
                <p class="role-text">Administrator</p>
            </div>
        </div>
        
        <div class="main-links">
            <div class="list-group">
                <a href="{{ route('admin.home') }}" class="list-group-item list-group-item-action">Dashboard</a>
                
                <a href="{{ route('admin.countries.index') }}" class="list-group-item list-group-item-action">Countries</a>
                
                <a href="{{ route('admin.districts.index') }}" class="list-group-item list-group-item-action">Districts</a>
                
                <a href="{{ route('admin.cities.index') }}" class="list-group-item list-group-item-action">Cities</a>
                
                <a href="{{ route('admin.attractions.index') }}" class="list-group-item list-group-item-action">Attractions</a>
                
                <a href="{{ route('admin.businessHours.index') }}" class="list-group-item list-group-item-action">Business Hours</a>
                
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>

    </div>