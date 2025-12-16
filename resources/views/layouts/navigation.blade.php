<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/grades">
                        <span class="text-lg font-bold text-gray-800">
                            Grade Recording System
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="/grades"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                       {{ request()->is('grades*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Grades
                    </a>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <span class="text-sm text-gray-600 mr-4">
                    {{ auth()->user()->name }}
                </span>

                <!-- Logout -->
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                            class="text-sm text-red-600 hover:text-red-800">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
