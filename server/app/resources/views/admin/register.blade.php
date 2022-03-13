<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div>
                admin_register
            </div>

            <form method="POST" action="{{ route('admin.companyRegister') }}">
                @csrf

                <div>
                    <label for="name" class="h4">企業名</label>
                    <input type="text" id="" name="name" >
                </div>

                <div>
                    <label for="name" class="h4">住所</label>
                    <input type="text" id="" name="address" >
                </div>                

                <button type="submit" class="btn">
                        保存する
                </button>
            </form>



    </x-auth-card>
</x-app-layout>
