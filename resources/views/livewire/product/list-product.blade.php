<div>
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <header>
                <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
                    {{ $category ?? 'All Products' }}
                </h2>
            </header>

            <div class="mt-8 flex items-center justify-between">
                <div>
                    <div class="sm:hidden">
                        <label for="Tab" class="sr-only">Tab</label>

                        <select id="Tab" class="w-full rounded-md border-gray-200">
                            <option>All</option>
                            <option>T-shirt</option>
                            <option>Shirt</option>
                            <option>Sweather</option>
                            <option>Jacket</option>
                            <option>Pants</option>
                            <option>Accesories</option>
                        </select>
                    </div>

                    <div class="hidden sm:block">
                        <nav class="flex gap-6" aria-label="Tabs">
                            <a href="{{ route('guest.product.index') }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == null ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                All
                            </a>

                            <a href="{{ route('guest.product.index', ['category' => 'T-Shirt']) }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == 'T-Shirt' ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                T-shirt
                            </a>

                            <a href="{{ route('guest.product.index', ['category' => 'Shirt']) }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == 'Shirt' ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                Shirt
                            </a>

                            <a href="{{ route('guest.product.index', ['category' => 'Sweather']) }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == 'Sweather' ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                Sweather
                            </a>

                            <a href="{{ route('guest.product.index', ['category' => 'Jacket']) }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == 'Jacket' ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                Jacket
                            </a>

                            <a href="{{ route('guest.product.index', ['category' => 'Pants']) }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == 'Pants' ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                Pants
                            </a>

                            <a href="{{ route('guest.product.index', ['category' => 'Accesories']) }}"
                                class="shrink-0 rounded-lg p-2 text-sm font-medium {{ $category == 'Accesories' ? 'active' : '' }} hover:bg-gray-50 hover:text-gray-700">
                                Accesories
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="relative">
                    <label for="Search" class="sr-only"> Search </label>

                    <input type="text" id="Search" wire:model.live="search" placeholder="Search for..."
                        class="w-full rounded-md border-gray-200 py-2.5 px-5 pe-10 shadow-sm sm:text-sm" />

                    <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                        <button type="button" class="text-gray-600 hover:text-gray-700">
                            <span class="sr-only">Search</span>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </span>
                </div>
            </div>

            <div>
                <label for="SortBy" class="sr-only">SortBy</label>

                <select id="SortBy" class="h-10 rounded border-gray-300 text-sm" wire:model.live="sortBy">
                    <option value="nama, ASC">Sort By</option>
                    <option value="nama, DESC">nama, DESC</option>
                    <option value="nama, ASC">nama, ASC</option>
                    <option value="harga, DESC">harga, DESC</option>
                    <option value="harga, ASC">harga, ASC</option>
                </select>
            </div>

            <ul class="mt-4 grid gap-4 grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                    <li>
                        <x-card :product="$product" />
                    </li>
                @endforeach
            </ul>

            @if ($products->isEmpty())
                <p class="max-w-full mt-4 text-gray-500 text-center">
                    Nothing to show yet
                </p>
            @endif

            <div class="mt-8 text-center">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>
