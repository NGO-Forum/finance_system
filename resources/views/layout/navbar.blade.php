<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <div class="max-w-screen-2xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            <!-- Left Section -->
            <div class="flex items-center gap-8">

                @if (in_array(auth()->user()->role?->name, ['Admin', 'Finance']))
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="group">

                        <img src="{{ asset('images/logo.png') }}" alt="NGOF Logo"
                            class="h-16 w-auto object-contain transition duration-300 group-hover:scale-105">

                    </a>

                    <!-- Desktop Navigation -->

                    <div class="hidden lg:flex items-center text-lg gap-6">
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2.5 rounded-xl transition
                            {{ request()->routeIs('dashboard') ? ' text-green-700 font-semibold' : 'text-gray-700 hover:text-green-700' }}">

                            Dashboard

                        </a>

                        <!-- User Management -->
                        <div class="relative">

                            <button onclick="toggleAdminMenu()"
                                class="flex items-center gap-2 px-4 py-2.5 rounded-xl transition

                            {{ request()->routeIs('users.*', 'departments.*', 'roles.*', 'donor-logos.*')
                                ? ' text-green-700 font-semibold'
                                : 'text-gray-700 hover:text-green-700' }}">

                                User Management

                                <svg id="adminArrow"
                                    class="w-4 h-4 transition-transform duration-300
                                {{ request()->routeIs('users.*', 'departments.*', 'roles.*') ? 'rotate-180' : '' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />

                                </svg>

                            </button>

                            <div id="adminMenu"
                                class="hidden absolute left-0 mt-3 w-[200px]
                                    bg-white rounded-2xl border text-base border-gray-100
                                    shadow-2xl overflow-hidden">

                                <a href="{{ route('users.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('users.*') ? 'text-green-700 font-semibold bg-green-50' : 'hover:text-green-700 text-gray-700' }}">
                                    Users

                                </a>

                                <a href="{{ route('departments.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('departments.*') ? 'text-green-700 font-semibold bg-green-50' : 'hover:text-green-700 text-gray-700' }}">

                                    Departments

                                </a>

                                <a href="{{ route('roles.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('roles.*') ? 'text-green-700 font-semibold bg-green-50' : 'hover:text-green-700 text-gray-700' }}">

                                    Roles

                                </a>

                                <a href="{{ route('donor-logos.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition
                                    {{ request()->routeIs('donor-logos.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">
                                    Donor Logos
                                </a>

                            </div>

                        </div>

                        <!-- Finance Management -->
                        <div class="relative">

                            <button onclick="toggleFinanceMenu()"
                                class="flex items-center gap-2 px-4 py-2.5 rounded-xl transition

                            {{ request()->routeIs(
                                'finance-forms.*',
                                'fund-requests.*',
                                'expenditure-summaries.*',
                                'purchase-requests.*',
                                'attendant-lists.*',
                                'allowance-forms.*',
                                'dsa-claims.*',
                                'payment-slips.*',
                                'verbal-quotes.*',
                                'quotation-analyses.*',
                                'purchase-orders.*',
                                'goods-received-notes.*',
                                'receipts.*',
                                'invoices.*',
                            )
                                ? 'text-green-700 font-semibold'
                                : 'text-gray-700 hover:text-green-700' }}">

                                Finance Management Form

                                <svg id="financeArrow"
                                    class="w-4 h-4 transition-transform duration-300
                                {{ request()->routeIs(
                                    'finance-forms.*',
                                    'fund-requests.*',
                                    'expenditure-summaries.*',
                                    'attendant-lists.*',
                                    'allowance-forms.*',
                                    'purchase-requests.*',
                                    'dsa-claims.*',
                                    'payment-slips.*',
                                    'verbal-quotes.*',
                                    'quotation-analyses.*',
                                    'purchase-orders.*',
                                    'goods-received-notes.*',
                                    'receipts.*',
                                    'invoices.*',
                                )
                                    ? 'rotate-180'
                                    : '' }}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />

                                </svg>

                            </button>

                            <div id="financeMenu"
                                class="hidden absolute left-0 mt-3 w-[290px]
                                bg-white rounded-2xl border border-gray-100
                                shadow-2xl text-base overflow-hidden z-50">

                                {{-- Finance Form --}}
                                <a href="{{ route('finance-forms.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('finance-forms.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                    Finance Form (FM02-01)

                                </a>

                                {{-- Fund Request --}}
                                <a href="{{ route('fund-requests.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('fund-requests.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                    Concept Note (FM02-02)

                                </a>

                                {{-- Expenditure Summary --}}
                                <a href="{{ route('expenditure-summaries.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('expenditure-summaries.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                    Expenditure Summary (FM02-03)

                                </a>

                                {{-- Purchase Request --}}
                                <a href="{{ route('purchase-requests.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('purchase-requests.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                    Purchase Request (FM02-04)

                                </a>

                                {{-- Attendant Lists --}}
                                <a href="{{ route('attendant-lists.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('attendant-lists.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                    Attendant Lists (FM02-05)

                                </a>

                                {{-- DSA Claim --}}
                                <a href="{{ route('dsa-claims.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('dsa-claims.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                    DSA Claim (FM02-06)

                                </a>

                                {{-- Allowance Forms --}}
                                <a href="{{ route('allowance-forms.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('allowance-forms.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                    Allowance Forms (FM02-07)

                                </a>


                                {{-- Payment Slip --}}
                                <a href="{{ route('payment-slips.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('payment-slips.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                    Payment Slip (FM02-08)

                                </a>

                                {{-- Verbal Quote --}}
                                <a href="{{ route('verbal-quotes.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('verbal-quotes.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                    Verbal Quote (FM02-09)

                                </a>

                                {{-- Quotation Analysis --}}
                                <a href="{{ route('quotation-analyses.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('quotation-analyses.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                    Quotation Analysis (FM02-10)

                                </a>

                                {{-- Purchase Order --}}
                                <a href="{{ route('purchase-orders.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('purchase-orders.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                    Purchase Order (FM02-11)

                                </a>


                                <a href="{{ route('goods-received-notes.index') }}"
                                    class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('goods-received-notes.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                    Service Received Note (FM02-12)

                                </a>

                                {{-- Receipt --}}
                                <a href="{{ route('receipts.index') }}"
                                    class="
                                        flex
                                        items-center
                                        gap-3
                                        px-5
                                        py-2
                                        transition

                                        {{ request()->routeIs('receipts.*')
                                            ? 'text-green-700 font-semibold bg-green-50'
                                            : 'hover:text-green-700 text-gray-700' }}
                                    ">

                                    Receipt (FM02-13)

                                </a>

                                {{-- Invoice --}}
                                <a href="{{ route('invoices.index') }}"
                                    class="
                                        flex
                                        items-center
                                        gap-3
                                        px-5
                                        py-2
                                        transition

                                        {{ request()->routeIs('invoices.*')
                                            ? 'text-green-700 font-semibold bg-green-50'
                                            : 'hover:text-green-700 text-gray-700' }}
                                    ">

                                    Invoice (FM02-14)

                                </a>

                            </div>

                        </div>

                    </div>
                @elseif (!in_array(auth()->user()->role?->name, ['Admin', 'Finance']))
                    <!-- Logo -->
                    <a href="{{ route('fund-requests.index') }}" class="group">

                        <img src="{{ asset('images/logo.png') }}" alt="NGOF Logo"
                            class="h-16 w-auto object-contain transition duration-300 group-hover:scale-105">

                    </a>

                    <!-- Finance Management -->
                    <div class="relative">

                        <button onclick="toggleFinanceMenu()"
                            class="flex items-center gap-2 px-4 text-lg py-2.5 rounded-xl transition

                            {{ request()->routeIs(
                                'finance-forms.*',
                                'fund-requests.*',
                                'expenditure-summaries.*',
                                'attendant-lists.*',
                                'purchase-requests.*',
                                'allowance-forms.*',
                                'payment-slips.*',
                                'verbal-quotes.*',
                                'quotation-analyses.*',
                                'purchase-orders.*',
                                'goods-received-notes.*',
                                'receipts.*',
                                'invoices.*',
                            )
                                ? 'text-green-700 font-semibold'
                                : 'text-gray-700 hover:text-green-700' }}">

                            Finance Management Form

                            <svg id="financeArrow"
                                class="w-4 h-4 transition-transform duration-300
                                {{ request()->routeIs(
                                    'finance-forms.*',
                                    'fund-requests.*',
                                    'expenditure-summaries.*',
                                    'attendant-lists.*',
                                    'allowance-forms.*',
                                    'purchase-requests.*',
                                    'payment-slips.*',
                                    'verbal-quotes.*',
                                    'quotation-analyses.*',
                                    'purchase-orders.*',
                                    'goods-received-notes.*',
                                    'receipts.*',
                                    'invoices.*',
                                )
                                    ? 'rotate-180'
                                    : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />

                            </svg>

                        </button>

                        <div id="financeMenu"
                            class="hidden absolute left-0 mt-3 w-[290px]
                                bg-white rounded-2xl border border-gray-100
                                shadow-2xl text-base overflow-hidden z-50">

                            {{-- Fund Request --}}
                            <a href="{{ route('fund-requests.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('fund-requests.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                Concept Note (FM02-02)

                            </a>

                            {{-- Expenditure Summary --}}
                            <a href="{{ route('expenditure-summaries.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('expenditure-summaries.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                Expenditure Summary (FM02-03)

                            </a>

                            {{-- Purchase Request --}}
                            <a href="{{ route('purchase-requests.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('purchase-requests.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                Purchase Request (FM02-04)

                            </a>

                            {{-- Attendant Lists --}}
                            <a href="{{ route('attendant-lists.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                {{ request()->routeIs('attendant-lists.*')
                                    ? 'text-green-700 font-semibold bg-green-50'
                                    : 'hover:text-green-700 text-gray-700' }}">

                                Attendant Lists (FM02-05)

                            </a>

                            {{-- Allowance Forms --}}
                            <a href="{{ route('allowance-forms.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('allowance-forms.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                Allowance Forms (FM02-07)

                            </a>

                            {{-- Payment Slip --}}
                            <a href="{{ route('payment-slips.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('payment-slips.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                Payment Slip (FM02-08)

                            </a>

                            {{-- Verbal Quote --}}
                            <a href="{{ route('verbal-quotes.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('verbal-quotes.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                Verbal Quote (FM02-09)

                            </a>

                            {{-- Quotation Analysis --}}
                            <a href="{{ route('quotation-analyses.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('quotation-analyses.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                Quotation Analysis (FM02-10)

                            </a>

                            {{-- Purchase Order --}}
                            <a href="{{ route('purchase-orders.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('purchase-orders.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                Purchase Order (FM02-11)

                            </a>

                            <a href="{{ route('goods-received-notes.index') }}"
                                class="flex items-center gap-3 px-5 py-2 transition

                                    {{ request()->routeIs('goods-received-notes.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}">

                                Service Received Note (FM02-12)

                            </a>

                            {{-- Receipt --}}
                            <a href="{{ route('receipts.index') }}"
                                class="
                                    flex
                                    items-center
                                    gap-3
                                    px-5
                                    py-2
                                    transition

                                    {{ request()->routeIs('receipts.*')
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-700 text-gray-700' }}
                                ">

                                Receipt (FM02-13)

                            </a>

                            {{-- Invoice --}}
                            <a href="{{ route('invoices.index') }}"
                                class="
                                        flex
                                        items-center
                                        gap-3
                                        px-5
                                        py-2
                                        transition

                                        {{ request()->routeIs('invoices.*')
                                            ? 'text-green-700 font-semibold bg-green-50'
                                            : 'hover:text-green-700 text-gray-700' }}
                                    ">

                                Invoice (FM02-14)

                            </a>

                        </div>

                    </div>
                @endif
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-4">

                <!-- Notifications -->
                <button
                    class="relative h-11 w-11 rounded-xl bg-gray-100 hover:bg-green-50 hover:text-green-700 transition flex items-center justify-center">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>

                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full animate-pulse">
                    </span>

                </button>

                <!-- User Profile -->
                <div class="relative">

                    <button onclick="toggleProfileMenu()"
                        class="flex items-center gap-3 bg-gray-50 hover:bg-green-50 px-3 py-2 rounded-2xl transition">

                        <div
                            class="h-11 w-11 rounded-full bg-gradient-to-r from-green-600 to-emerald-500 text-white flex items-center justify-center font-bold shadow">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>

                        <div class="hidden md:block text-left">

                            <h4 class="font-semibold text-gray-800">
                                {{ auth()->user()->name }}
                            </h4>

                            <p class="text-xs text-gray-500">
                                {{ auth()->user()->role->name ?? 'Administrator' }}
                            </p>

                        </div>

                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>

                    </button>

                    <div id="profileMenu"
                        class="hidden absolute right-0 mt-3 w-[220px] bg-white rounded-2xl border border-gray-100 shadow-2xl overflow-hidden">

                        <div class="flex items-center gap-3 px-3 py-2">
                            <div
                                class="h-11 w-11 rounded-full bg-gradient-to-r from-green-600 to-emerald-500 text-white flex items-center justify-center font-bold shadow">

                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                            </div>

                            <div class="hidden md:block text-left">

                                <h4 class="font-semibold text-gray-800">
                                    {{ auth()->user()->name }}
                                </h4>

                                <p class="text-xs text-gray-500">
                                    {{ auth()->user()->role->name ?? 'Administrator' }}
                                </p>

                            </div>

                        </div>

                        {{-- <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-blue-50 transition">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                            </svg>

                            My Profile

                        </a> --}}

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                class="w-full flex items-center gap-3 px-5 py-3 text-red-600 hover:bg-red-50 transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />

                                </svg>

                                Logout

                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</nav>

<script>
    function toggleAdminMenu() {
        document.getElementById('adminMenu').classList.toggle('hidden');
        document.getElementById('adminArrow').classList.toggle('rotate-180');
    }

    function toggleProfileMenu() {
        document.getElementById('profileMenu').classList.toggle('hidden');
    }

    function toggleFinanceMenu() {
        document.getElementById('financeMenu').classList.toggle('hidden');
        document.getElementById('financeArrow').classList.toggle('rotate-180');
    }

    document.addEventListener('click', function(e) {

        const adminBtn = e.target.closest('[onclick="toggleAdminMenu()"]');
        const profileBtn = e.target.closest('[onclick="toggleProfileMenu()"]');
        const financeBtn = e.target.closest('[onclick="toggleFinanceMenu()"]');

        if (!adminBtn && !e.target.closest('#adminMenu')) {
            document.getElementById('adminMenu').classList.add('hidden');

            if (!@json(request()->routeIs('users.*', 'departments.*', 'roles.*'))) {
                document.getElementById('adminArrow').classList.remove('rotate-180');
            }
        }

        if (!profileBtn && !e.target.closest('#profileMenu')) {
            document.getElementById('profileMenu').classList.add('hidden');
        }

        // Finance Menu
        if (!financeBtn && !e.target.closest('#financeMenu')) {

            document.getElementById('financeMenu').classList.add('hidden');

            if (!@json(request()->routeIs('finance-forms.*', 'fund-requests.*', 'expenditure-summaries.*'))) {
                document.getElementById('financeArrow').classList.remove('rotate-180');
            }
        }
    });
</script>
