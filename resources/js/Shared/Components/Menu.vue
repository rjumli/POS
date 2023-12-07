<template>
    <div>
        <div class="app-menu navbar-menu" style="background-color: #11101d;">
            <div class="navbar-brand-box" style="background-color: #11101d;">
                <Link href='/' class="logo logo-dark">
                    <span class="logo-sm">
                        <!-- <img src="/images/logo.png" alt="" height="30" /> -->
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="/images/logo-dark.png" alt="" height="17" /> -->
                    </span>
                </Link>
                <Link href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <!-- <img src="/images/logo.png" alt="" height="30" /> -->
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="/images/logo-light.png" alt="" height="17" /> -->
                    </span>
                </Link>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover" @click="initActiveMenu">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

             <ul class="navbar-nav" id="navbar-nav" >
                <!-- <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Home') }" href="/home">
                        <i class='ri ri-apps-line '></i>
                        <span data-key="t-dashboards">Home</span>
                    </Link>
                </li> -->
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Sales') }" href="/sales">
                        <i class='ri ri-hand-coin-fill'></i>
                        <span data-key="t-dashboards">Sales</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Orders') }" href="/orders">
                        <i class='ri ri-shopping-cart-fill'></i>
                        <span data-key="t-dashboards">Purchased Order</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Products') }" href="/products">
                        <i class='ri ri-folder-zip-fill'></i>
                        <span data-key="t-dashboards">Product Management</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Packages') }" href="/packages">
                        <i class='ri ri-shopping-basket-line'></i>
                        <span data-key="t-dashboards">Package Management</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Discounts') }" href="/discounts">
                        <i class='ri ri-price-tag-3-fill'></i>
                        <span data-key="t-dashboards">Discount Management</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Customers') }" href="/customers">
                        <i class='ri ri-team-fill'></i>
                        <span data-key="t-dashboards">Customer Management</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Suppliers') }" href="/suppliers">
                        <i class='ri ri-store-fill'></i>
                        <span data-key="t-dashboards">Supplier Management</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Settings') }" href="/settings">
                        <i class='ri ri-settings-4-fill'></i>
                        <span data-key="t-dashboards">Settings</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link menu-link" :class="{'active': $page.component.startsWith('Modules/Users') }" href="/users">
                        <i class='ri ri-shield-user-line'></i>
                        <span data-key="t-dashboards">User Management</span>
                    </Link>
                </li>
            </ul>

            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay" id="overlay"></div>
    </div>
</template>