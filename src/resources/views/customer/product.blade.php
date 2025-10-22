@extends('customer.layout')

@section('title', 'Sản phẩm')

@section('content')
    <!-- Top Navigation Bar -->
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <!-- Filter FORM (server-side) -->
            <form id="filterForm" method="GET" class="hidden">
                <input type="hidden" name="search" id="q_input" value="{{ request('search') }}">
                <input type="hidden" name="category" id="cat_input" value="{{ request('category','all') }}">
                <input type="hidden" name="sort_by" id="sort_by_input" value="{{ request('sort_by', $sortBy ?? 'name') }}">
                <input type="hidden" name="sort_direction" id="sort_dir_input" value="{{ request('sort_direction', $sortDirection ?? 'asc') }}">
            </form>

            <!-- Categories -->
            <div class="mb-6">
                <nav class="flex flex-wrap justify-center gap-3">
                    @php $currentCat = request('category','all'); @endphp
                    <button type="button" onclick="filterByCategory('all')"
                        class="px-6 py-3 rounded-lg font-medium border-2
                        {{ $currentCat==='all' ? 'bg-blue-50 text-blue-600 border-blue-600' : 'text-gray-600 border-gray-300 hover:bg-gray-50 hover:text-blue-600' }}">
                        📋 Tất cả sản phẩm
                    </button>
                    @foreach($categories as $c)
                        <button type="button" onclick="filterByCategory('{{ $c->category_id }}')"
                            class="px-6 py-3 rounded-lg font-medium border-2
                            {{ $currentCat===$c->category_id ? 'bg-blue-50 text-blue-600 border-blue-600' : 'text-gray-600 border-gray-300 hover:bg-gray-50 hover:text-blue-600' }}">
                            {{ $c->icon ?? '📦' }} {{ $c->name ?? $c->category_id }}
                        </button>
                    @endforeach
                </nav>
            </div>

            <!-- Search Bar -->
            <div class="relative">
                <input type="text" id="search-input" placeholder="Tìm kiếm sản phẩm..."
                    value="{{ request('search') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300"
                    onkeyup="searchProducts(event)">
                <button onclick="performSearch()"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600 text-lg">
                    🔍
                </button>
            </div>

            <!-- Client-side Filters (giá/brand) -->
            <form method="GET" action="{{ route('customer.product') }}" id="clientFilterForm" class="mt-6">
                <div class="flex flex-wrap justify-center gap-10 md:gap-20 items-end">
                    {{-- Lọc theo giá --}}
                    <div class="flex flex-col items-center">
                        <h3 class="font-bold text-gray-800 mb-3 text-center">Lọc theo giá</h3>
                        <select name="price_range"
                            class="filter-select w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent text-sm">
                            <option value="">Tất cả mức giá</option>
                            <option value="0-20" {{ request('price_range') == '0-20' ? 'selected' : '' }}>Dưới 20 triệu</option>
                            <option value="20-40" {{ request('price_range') == '20-40' ? 'selected' : '' }}>20 - 40 triệu</option>
                            <option value="40+" {{ request('price_range') == '40+' ? 'selected' : '' }}>Trên 40 triệu</option>
                        </select>
                    </div>

                    {{-- Lọc theo thương hiệu --}}
                    <div class="flex flex-col items-center">
                        <h3 class="font-bold text-gray-800 mb-3 text-center">Thương hiệu</h3>
                        <select name="brand"
                            class="filter-select w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent text-sm">
                            <option value="">Tất cả thương hiệu</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ ucfirst($brand) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- 🔁 Nút tải lại --}}
                    <div class="flex flex-col items-center">
                        <h3 class="font-bold text-gray-800 mb-3 text-center invisible">Reload</h3>
                        <a href="{{ route('customer.product') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition text-sm">
                            
                            Tất cả
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </header>

    <!-- Main Layout -->
    <div class="flex min-h-screen bg-gray-50">
        <main class="flex-1 p-8">
            <!-- Product List View -->
            <div id="product-list" class="fade-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Sản phẩm nổi bật</h2>
                    <div class="flex items-center space-x-4">
                        <select onchange="sortProducts(this.value)"
                                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <option value="server">Sắp xếp</option>
                            <option value="price-low">Giá thấp đến cao</option>
                            <option value="price-high">Giá cao đến thấp</option>
                            <option value="newest">Mới nhất </option>
                        </select>
                        <!-- Server-side sort controls (ẩn) -->
                        <select id="server_sort_by" class="hidden">
                            <option value="name" {{ (request('sort_by',$sortBy??'name')==='name')?'selected':'' }}>name</option>
                            <option value="price" {{ (request('sort_by',$sortBy??'name')==='price')?'selected':'' }}>price</option>
                            <option value="brand" {{ (request('sort_by',$sortBy??'name')==='brand')?'selected':'' }}>brand</option>
                            <option value="created_at" {{ (request('sort_by',$sortBy??'name')==='created_at')?'selected':'' }}>created_at</option>
                        </select>
                        <select id="server_sort_dir" class="hidden">
                            <option value="asc" {{ (request('sort_direction',$sortDirection??'asc')==='asc')?'selected':'' }}>asc</option>
                            <option value="desc" {{ (request('sort_direction',$sortDirection??'asc')==='desc')?'selected':'' }}>desc</option>
                        </select>
                    </div>
                </div>

                <div id="product-grid"
                     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $p)
                        @php
                            $brandSlug = strtolower(preg_replace('/\s+/', '', $p->brand ?? ''));
                            $price = (int)($p->price ?? 0);
                        @endphp
                        <div class="product-card bg-white rounded-xl shadow-md overflow-hidden"
                             data-product-id="{{ $p->product_id }}"
                             data-category="{{ $p->category_id }}"
                             data-brand="{{ $brandSlug }}"
                             data-price="{{ $price }}"
                             data-created="{{ optional($p->created_at)->timestamp ?? 0 }}">
                            <div class="relative">
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <span class="text-6xl">📦</span>
                                </div>
                                @if(!empty($p->old_price) && $p->old_price > $p->price)
                                    <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                        -{{ max(1, round((($p->old_price - $p->price)/$p->old_price)*100)) }}%
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2 text-gray-800 line-clamp-2">{{ $p->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $p->brand }}</p>
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <span class="text-2xl font-bold text-blue-600">{{ number_format($p->price,0,',','.') }}₫</span>
                                        @if(!empty($p->old_price) && $p->old_price > $p->price)
                                            <span class="text-sm text-gray-500 line-through ml-2">{{ number_format($p->old_price,0,',','.') }}₫</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400">⭐⭐⭐⭐⭐</div>
                                    <span class="text-sm text-gray-600 ml-2">(— đánh giá)</span>
                                </div>
                                <button type="button"
                                        onclick="showProductDetail('{{ $p->product_id }}')"
                                        class="view-detail-btn w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition-colors">
                                    Xem chi tiết
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex flex-col items-center mt-4 bg-white px-4 py-2 rounded-b-xl">
                    <div>
                        {{ $products->withQueryString()->links('pagination::simple-tailwind') }}
                    </div>
                    <div class="text-sm text-gray-500 mt-1">
                        Trang {{ $products->currentPage() }} / {{ $products->lastPage() }}
                    </div>
                </div>
            </div>

            <!-- Product Detail View (ẩn, sẽ bind bằng AJAX) -->
            <div id="product-detail" class="hidden fade-in">
                <div class="mb-4">
                    <button onclick="showProductList()" class="text-blue-600 hover:text-blue-800 font-medium">
                        ← Quay lại danh sách sản phẩm
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                        <!-- Images -->
                        <div>
                            <div class="mb-4">
                                <div id="main-image" class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-8xl">🖼️</span>
                                </div>
                            </div>
                            <div id="thumbs" class="flex space-x-2"></div>
                        </div>

                        <!-- Info -->
                        <div>
                            <h1 id="detail-title" class="text-3xl font-bold text-gray-800 mb-4">—</h1>
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">⭐⭐⭐⭐⭐</div>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center space-x-4 mb-2">
                                    <span id="detail-price" class="text-4xl font-bold text-blue-600">—</span>
                                    <span id="detail-old-price" class="text-xl text-gray-500 line-through hidden">—</span>
                                    <span id="detail-sale-badge" class="hidden bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold"></span>
                                </div>
                                <p id="detail-stock" class="text-green-600 font-medium">—</p>
                                <div class="mt-2 text-sm text-gray-600">
                                    <span class="mr-3"><b>Mã:</b> <span id="detail-id">—</span></span>
                                    <span class="mr-3"><b>Thương hiệu:</b> <span id="detail-brand">—</span></span>
                                    <span class="mr-3"><b>Danh mục:</b> <span id="detail-category">—</span></span>
                                </div>
                            </div>

                            <!-- Màu sắc -->
                            <div class="mb-6">
                                <h3 class="font-bold text-lg mb-3">Màu sắc:</h3>
                                <div class="flex space-x-3" id="color-options">
                                    <button type="button" class="option-color w-12 h-12 rounded-full bg-gray-800 border-2 border-gray-300" data-color="Đen"></button>
                                    <button type="button" class="option-color w-12 h-12 rounded-full bg-blue-600 border-2 border-gray-300" data-color="Xanh"></button>
                                    <button type="button" class="option-color w-12 h-12 rounded-full bg-purple-600 border-2 border-gray-300" data-color="Tím"></button>
                                    <button type="button" class="option-color w-12 h-12 rounded-full bg-yellow-400 border-2 border-gray-300" data-color="Vàng"></button>
                                </div>
                            </div>

                            <!-- Dung lượng -->
                            <div class="mb-6">
                                <h3 class="font-bold text-lg mb-3">Dung lượng:</h3>
                                <div class="flex space-x-3" id="storage-options">
                                    <button type="button" class="option-storage px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500" data-storage="256GB">256GB</button>
                                    <button type="button" class="option-storage px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500" data-storage="512GB">512GB</button>
                                    <button type="button" class="option-storage px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg font-medium hover:border-blue-500" data-storage="1TB">1TB</button>
                                </div>
                            </div>

                            <!-- Số lượng -->
                            <div class="mb-6">
                                <h3 class="font-bold text-lg mb-3">Số lượng:</h3>
                                <div class="flex items-center space-x-3">
                                    <button onclick="decreaseQuantity()" class="quantity-btn w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center font-bold">-</button>
                                    <span id="quantity" class="text-xl font-bold px-4">1</span>
                                    <button onclick="increaseQuantity()" class="quantity-btn w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center font-bold">+</button>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6">
                                <button
                                    onclick="addToCart(document.getElementById('detail-title').textContent, parsePrice(document.getElementById('detail-price').textContent))"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-bold text-lg transition-colors">
                                    Thêm vào giỏ hàng
                                </button>
                            </div>

                            <div class="border-t pt-6">
                                <h3 class="font-bold text-lg mb-3">Thông tin sản phẩm:</h3>
                                <p id="detail-description" class="text-gray-700 leading-relaxed">—</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="border-b">
                        <div class="flex">
                            <button onclick="showTab('description')" id="tab-description" class="px-6 py-4 font-medium border-b-2 border-blue-600 text-blue-600">
                                Mô tả sản phẩm
                            </button>
                            <button onclick="showTab('specs')" id="tab-specs" class="px-6 py-4 font-medium text-gray-600 hover:text-blue-600">
                                Thông số kỹ thuật
                            </button>
                            <button onclick="showTab('reviews')" id="tab-reviews" class="px-6 py-4 font-medium text-gray-600 hover:text-blue-600">
                                Đánh giá (—)
                            </button>
                        </div>
                    </div>

                    <div class="p-6">
                        <div id="tab-content-description">
                            <h3 class="text-xl font-bold mb-4" id="desc-title">—</h3>
                            <p class="text-gray-700 leading-relaxed mb-4" id="desc-body">—</p>
                        </div>

                        <div id="tab-content-specs" class="hidden">
                            <div class="text-gray-700">—</div>
                        </div>

                        <div id="tab-content-reviews" class="hidden">
                            <div class="text-gray-700">—</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    
    <script>
        // ==== STATE ====
        let currentQuantity = 1;
        let currentPriceFilters = [];
        let currentBrandFilters = [];
        let selectedColor = null;
        let selectedStorage = null;
        let basePriceForDetail = 0;

        const storagePriceDelta = { '256GB': 0, '512GB': 3000000, '1TB': 6000000 };

        // ==== HELPERS ====
        function parsePrice(text){ const num = (text||'').replace(/[^\d]/g,''); return Number(num||0); }
        function formatVND(n){ try{ return Number(n||0).toLocaleString('vi-VN')+'₫'; }catch(e){ return (n||0)+'₫'; } }

        function showToast(msg, ok=true){
            const el = document.createElement('div');
            el.className = `fixed top-4 right-4 ${ok?'bg-green-600':'bg-red-600'} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
            el.textContent = msg;
            document.body.appendChild(el);
            setTimeout(()=>el.remove(), 2000);
        }

        // ==== SERVER FILTERS ====
        function performSearch(){
            document.getElementById('q_input').value = document.getElementById('search-input').value || '';
            document.getElementById('filterForm').submit();
        }
        function searchProducts(e){ if(e.key==='Enter'){ performSearch(); } }
        function filterByCategory(cat){
            document.getElementById('cat_input').value = cat || 'all';
            document.getElementById('filterForm').submit();
        }

        // ==== CLIENT FILTERS (Price/Brand) ====
        function filterByPrice(pr){
            const i = currentPriceFilters.indexOf(pr);
            if(i>-1) currentPriceFilters.splice(i,1); else currentPriceFilters.push(pr);
            filterProducts();
        }
        function filterByBrand(brand){
            const i = currentBrandFilters.indexOf(brand);
            if(i>-1) currentBrandFilters.splice(i,1); else currentBrandFilters.push(brand);
            filterProducts();
        }
        function filterProducts(){
            document.querySelectorAll('.product-card').forEach(card=>{
                const priceRange = card.getAttribute('data-price-range');
                const brand = card.getAttribute('data-brand');
                let show = true;
                if(currentPriceFilters.length && !currentPriceFilters.includes(priceRange)) show=false;
                if(currentBrandFilters.length && !currentBrandFilters.includes(brand)) show=false;
                card.style.display = show ? 'block':'none';
            });
        }

        // ==== SORT ====
        function sortProducts(type){
            if(type==='server'){
                // Ví dụ: đổi sort server-side (thay đổi input ẩn rồi submit)
                const currentBy = document.getElementById('server_sort_by').value;
                const currentDir = document.getElementById('server_sort_dir').value;
                document.getElementById('sort_by_input').value = currentBy;
                document.getElementById('sort_dir_input').value = currentDir;
                document.getElementById('filterForm').submit();
                return;
            }

            const grid = document.getElementById('product-grid');
            const cards = Array.from(grid.children);
            const arr = cards.map(el=>({
                el,
                price: Number(el.getAttribute('data-price')||0),
                created: Number(el.getAttribute('data-created')||0)
            }));

            if(type==='price-low') arr.sort((a,b)=>a.price-b.price);
            else if(type==='price-high') arr.sort((a,b)=>b.price-a.price);
            else if(type==='newest') arr.sort((a,b)=>b.created-a.created);

            grid.innerHTML='';
            arr.forEach(x=>grid.appendChild(x.el));
        }

        // ==== DETAIL ====
        function showProductList(){
            document.getElementById('product-list').classList.remove('hidden');
            document.getElementById('product-detail').classList.add('hidden');
        }

        async function showProductDetail(productId){
            try{
                const res = await fetch(`/products/_show/${encodeURIComponent(productId)}.json`);
                if(!res.ok) throw new Error('Không tải được dữ liệu sản phẩm');
                const { product } = await res.json();

                // Bind
                document.getElementById('detail-title').textContent = product.name || '—';
                document.getElementById('detail-id').textContent = product.product_id || '—';
                document.getElementById('detail-brand').textContent = product.brand || '—';
                document.getElementById('detail-category').textContent = product.category?.name || product.category_id || '—';
                document.getElementById('detail-description').textContent = product.description || '—';

                basePriceForDetail = Number(product.price || 0);
                document.getElementById('detail-price').textContent = formatVND(basePriceForDetail);

                const oldEl = document.getElementById('detail-old-price');
                const saleEl = document.getElementById('detail-sale-badge');
                if(product.old_price && product.old_price > product.price){
                    oldEl.textContent = formatVND(product.old_price);
                    oldEl.classList.remove('hidden');
                    const pct = Math.max(1, Math.round(((product.old_price - product.price)/product.old_price)*100));
                    saleEl.textContent = `-${pct}%`;
                    saleEl.classList.remove('hidden');
                }else{
                    oldEl.classList.add('hidden');
                    saleEl.classList.add('hidden');
                }

                const stockEl = document.getElementById('detail-stock');
                const status = product.status || (product.quantity==0 ? 'Hết hàng' : (product.quantity<10 ? 'Sắp hết hàng' : 'Còn hàng'));
                stockEl.textContent = (status==='Còn hàng' ? '✓ Còn hàng - Giao hàng miễn phí' : status);
                stockEl.className = status==='Còn hàng' ? 'text-green-600 font-medium' :
                    (status==='Sắp hết hàng' ? 'text-yellow-600 font-medium' : 'text-red-600 font-medium');

                // Thumbs (nếu có image_url_list)
                const thumbs = document.getElementById('thumbs');
                thumbs.innerHTML = '';
                const images = (product.images && product.images.length) ? product.images : [];
                if(images.length){
                    images.slice(0,4).forEach((url,i)=>{
                        const d = document.createElement('div');
                        d.className = 'w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center cursor-pointer border';
                        d.innerHTML = `<img src="${url}" class="object-cover w-full h-full rounded-lg">`;
                        d.onclick = ()=>{ document.getElementById('main-image').innerHTML = `<img src="${url}" class="object-cover w-full h-full rounded-lg">`; };
                        thumbs.appendChild(d);
                        if(i===0) document.getElementById('main-image').innerHTML = `<img src="${url}" class="object-cover w-full h-full rounded-lg">`;
                    });
                }else{
                    document.getElementById('main-image').innerHTML = `<span class="text-8xl">🖼️</span>`;
                }

                // Reset số lượng & options
                currentQuantity = 1; document.getElementById('quantity').textContent = '1';
                resetOptionsUI();

                // Show detail
                document.getElementById('product-list').classList.add('hidden');
                document.getElementById('product-detail').classList.remove('hidden');
            }catch(e){
                showToast(e.message || 'Lỗi không xác định', false);
            }
        }

        function increaseQuantity(){ if(currentQuantity<10){ currentQuantity++; document.getElementById('quantity').textContent=currentQuantity; } }
        function decreaseQuantity(){ if(currentQuantity>1){ currentQuantity--; document.getElementById('quantity').textContent=currentQuantity; } }

        // ==== OPTIONS (color/storage) ====
        document.getElementById('color-options')?.addEventListener('click', (e)=>{
            const btn = e.target.closest('.option-color'); if(!btn) return;
            document.querySelectorAll('.option-color').forEach(b=>{
                b.classList.remove('ring-4','ring-blue-500','border-blue-500');
                b.classList.add('border-gray-300'); b.setAttribute('aria-pressed','false');
            });
            btn.classList.add('ring-4','ring-blue-500','border-blue-500');
            btn.classList.remove('border-gray-300'); btn.setAttribute('aria-pressed','true');
            selectedColor = btn.getAttribute('data-color');
        });

        document.getElementById('storage-options')?.addEventListener('click',(e)=>{
            const btn = e.target.closest('.option-storage'); if(!btn) return;
            document.querySelectorAll('.option-storage').forEach(b=>{
                b.classList.remove('border-blue-500','bg-blue-50','text-blue-600');
                b.classList.add('border-gray-300','text-gray-600'); b.setAttribute('aria-pressed','false');
            });
            btn.classList.add('border-blue-500','bg-blue-50','text-blue-600');
            btn.classList.remove('border-gray-300','text-gray-600'); btn.setAttribute('aria-pressed','true');
            selectedStorage = btn.getAttribute('data-storage');

            const newPrice = basePriceForDetail + (storagePriceDelta[selectedStorage] || 0);
            document.getElementById('detail-price').textContent = formatVND(newPrice);
        });

        function resetOptionsUI(){
            selectedColor = null; selectedStorage = null;
            document.querySelectorAll('.option-color').forEach(b=>{
                b.classList.remove('ring-4','ring-blue-500','border-blue-500');
                b.classList.add('border-gray-300'); b.setAttribute('aria-pressed','false');
            });
            document.querySelectorAll('.option-storage').forEach(b=>{
                b.classList.remove('border-blue-500','bg-blue-50','text-blue-600');
                b.classList.add('border-gray-300','text-gray-600'); b.setAttribute('aria-pressed','false');
            });
            document.getElementById('detail-price').textContent = formatVND(basePriceForDetail);
        }

        // ==== CART (giữ nguyên kiểu bạn đang dùng) ====
        async function addToCart(productName, price) {
        if (!selectedColor || !selectedStorage) {
            showToast('Vui lòng chọn Màu sắc và Dung lượng trước khi thêm vào giỏ!', false);
            return;
        }

        const productId = document.getElementById('detail-id').textContent.trim();
        const qty = parseInt(document.getElementById('quantity').textContent, 10) || 1;

        try {
            const res = await fetch("{{ route('customer.cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: qty
                })
            });

            const data = await res.json();
            if (data.success) {
                showToast(data.message, true);
            } else {
                showToast(data.message || 'Không thể thêm sản phẩm', false);
            }
        } catch (err) {
            showToast('Lỗi kết nối máy chủ!', false);
        }
    }


        // ==== TABS ====
        function showTab(tabName){
            ['description','specs','reviews'].forEach(n=>{
                document.getElementById('tab-content-'+n).classList.add('hidden');
                document.getElementById('tab-'+n).classList.remove('border-blue-600','text-blue-600');
                document.getElementById('tab-'+n).classList.add('text-gray-600');
            });
            document.getElementById('tab-content-'+tabName).classList.remove('hidden');
            document.getElementById('tab-'+tabName).classList.add('border-blue-600','text-blue-600');
            document.getElementById('tab-'+tabName).classList.remove('text-gray-600');
        }
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', () => {
                document.getElementById('clientFilterForm').submit();
            });
        });

    </script>
@endsection
