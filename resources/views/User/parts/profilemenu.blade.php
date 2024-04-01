<style>
    .pmenu {
        padding: 0;
        list-style-type: none;
        margin: 0;
    }

    .pmenu li {
        display: block;
        border: 1px solid #f5f5f5;
    }

    .pmenu li a {
        padding: 10px 20px;
        color: #333;
        display: block;
    }

    .pmenu li a:hover, .pmenu .active a {
        background-color: #f6f6f6;
    }
</style>
<div class="card">
    <div class="card-body px-0 pb-0 text-center">
        <img class="border rounded"
            src="data:image/png;base64,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"
            width="60px" />
        <h5 class="mb-0 mt-2">{{ Auth::user()->name }}</h5>
        <p>({{ Auth::user()->email }})</p>
        @if (Auth::user()->Mobile != '')
            <p>({{ Auth::user()->Mobile }})</p>
        @endif
        <ul class="pmenu">
            <li class="{{ Request::path()=='profile'?'active':'' }}">
                <a href="{{ route('user.profile') }}">My Profile </a>
            </li>
            <li class="{{ Request::path()=='profile/orders'?'active':'' }}">
                <a href="{{ route('user.profile.orders') }}">My Orders</a>
            </li>
            {{--<li class="">
                <a href="javascript:void(0)" onclick="cartmenu(1)">My Wishlist</a>
            </li>--}}
            <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </li>
        </ul>
    </div>
</div>
