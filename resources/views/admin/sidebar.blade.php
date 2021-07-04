<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="" class="brand-link">
            <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Artist</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <?php $route = Route::currentRouteName() ?>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.slider_image.index') }}" class="nav-link <?php echo ($route == 'admin.slider_image.index' ? "active" : "")?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Ảnh Trang Chủ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.collection.index') }}" class="nav-link <?php echo ($route == 'admin.collection.index' ? "active" : "")?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Bộ sưu tập
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.studio.index') }}" class="nav-link <?php echo ($route == 'admin.studio.index' ? "active" : "")?>">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Studio
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link <?php echo ($route == 'admin.contact.index' ? "active" : "")?>">
                            <i class="nav-icon far fas fa-th"></i>
                            <p>
                                Liên hệ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.new_about_me.index') }}" class="nav-link <?php echo ($route == 'admin.new_about_me.index' ? "active" : "")?>">
                            <i class="nav-icon far fas fa-th"></i>
                            <p>
                                Giới thiệu
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.information.index') }}" class="nav-link <?php echo ($route == 'admin.information.index' ? "active" : "")?>">
                            <i class="nav-icon far fas fa-th"></i>
                            <p>
                                Thông tin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.new.index') }}" class="nav-link <?php echo ($route == 'admin.new.index' ? "active" : "")?>">
                            <i class="nav-icon far fas fa-th"></i>
                            <p>
                                Tin Tức
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contact_image.get_contact_image') }}" class="nav-link <?php echo ($route == 'admin.contact_image.get_contact_image' ? "active" : "")?>">
                            <i class="nav-icon far fas fa-th"></i>
                            <p>
                                Ảnh Liên Hệ
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
