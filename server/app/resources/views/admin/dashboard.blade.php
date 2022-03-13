<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <li>
        adddddmin
    </li>

    <li>
                        <form class="dropdown-item" method="POST" action="{{ route('admin.logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                        </form>         
    </li>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>

            <div class="h3">
                <a href="{{ route('admin.companyEntry') }}">
                    企業追加
                </a>
            </div>

            <div class="h3">
                <a href="{{ route('register') }}">
                    ユーザー追加
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
