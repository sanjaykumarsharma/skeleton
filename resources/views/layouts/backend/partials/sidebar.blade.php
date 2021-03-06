<aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image) }}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="{{ Auth::user()->role->id ==1 ? route('admin.settings.index') : route('user.settings.index') }}"><i class="material-icons">settings</i>Settings</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li role="separator" class="divider"></li>
                        <li>

                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i>Sign Out</a>
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                   style="display: none;">
                                 {{ csrf_field() }}
                             </form>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>

                @if(Request::is('admin*'))
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"> 
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                        <a href="{{ route('admin.tag.index') }}">
                            <i class="material-icons">label</i>
                            <span>Tag</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">
                            <i class="material-icons">label</i>
                            <span>Category</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                        <a href="{{ route('admin.post.index') }}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/post/pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.post.pending') }}">
                            <i class="material-icons">library_books</i>
                            <span>Pending Posts</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                        <a href="{{ route('admin.subscriber.index') }}">
                            <i class="material-icons">subscriptions</i>
                            <span>Subscribers</span>
                        </a>
                    </li>

                    <div class="header">System</div>

                    <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.index') }}">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>


                @endif

                @if(Request::is('user*'))

                    <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('user.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('user/post*') ? 'active' : '' }}">
                        <a href="{{ route('user.post.index') }}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>

                    <div class="header">System</div>

                    <li class="{{ Request::is('user/settings') ? 'active' : '' }}">
                        <a href="{{ route('user.settings.index') }}">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>

                @endif



            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>