<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Selection using buttons -->
        <div class="mt-4">
            <x-input-label :value="__('I am a')" class="mb-2" />
            <div class="flex gap-4">
                <button type="button" id="teacherBtn" class="flex-1 py-2 bg-gray-200 rounded hover:bg-gray-300" onclick="selectRole('teacher')">
                    Teacher
                </button>
                <button type="button" id="studentBtn" class="flex-1 py-2 bg-gray-200 rounded hover:bg-gray-300" onclick="selectRole('student')">
                    Student
                </button>
            </div>
            <input type="hidden" name="role" id="roleInput" value="{{ old('role') }}">
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="submit" class="ms-4">{{ __('Register') }}</x-primary-button>
        </div>
    </form>

    <script>
        function selectRole(role) {
            document.getElementById('roleInput').value = role;

            // 更新按钮样式
            if (role === 'teacher') {
                document.getElementById('teacherBtn').classList.add('bg-black', 'text-white');
                document.getElementById('teacherBtn').classList.remove('bg-gray-200');
                document.getElementById('studentBtn').classList.add('bg-gray-200');
                document.getElementById('studentBtn').classList.remove('bg-black', 'text-white');
            } else {
                document.getElementById('studentBtn').classList.add('bg-black', 'text-white');
                document.getElementById('studentBtn').classList.remove('bg-gray-200');
                document.getElementById('teacherBtn').classList.add('bg-gray-200');
                document.getElementById('teacherBtn').classList.remove('bg-black', 'text-white');
            }
        }

        // 页面加载时，如果有旧值，自动高亮对应按钮
        window.addEventListener('DOMContentLoaded', () => {
            const oldRole = document.getElementById('roleInput').value;
            if (oldRole) selectRole(oldRole);
        });
    </script>
</x-guest-layout>
