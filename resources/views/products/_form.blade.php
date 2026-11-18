<div class="row g-3">

    <div class="col-md-6">
        <label>Kode Produk</label>

        <input
            type="text"
            name="product_code"
            class="form-control"
            value="{{ old('product_code', $product->product_code ?? '') }}"
        >

        @error('product_code')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-md-6">
        <label>Nama Produk</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $product->name ?? '') }}"
        >

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-md-6">
        <label>Kategori</label>

        <select name="category_id" class="form-select">
            <option value="">Pilih Kategori</option>

            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id', $product->category_id ?? '') == $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach

        </select>

        @error('category_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-md-6">
        <label>Merek</label>

        <input
            type="text"
            name="brand"
            class="form-control"
            value="{{ old('brand', $product->brand ?? '') }}"
        >

        @error('brand')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-md-6">
        <label>Harga</label>

        <input
            type="text"
            id="price_display"
            class="form-control"
            value="{{ old('price', $product->price ?? '') }}"
            placeholder="masukkan harga"
            autocomplete="off"
        >

        <input
            type="hidden"
            name="price"
            id="price"
            value="{{ old('price', $product->price ?? '') }}"
        >

        @error('price')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-md-6">
        <label>Stok</label>

        <input
            type="number"
            name="stock"
            class="form-control"
            min="0"
            value="{{ old('stock', $product->stock ?? 0) }}"
        >

        @error('stock')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-12">
        <label>Deskripsi</label>

        <textarea
            name="description"
            class="form-control"
            rows="4"
        >{{ old('description', $product->description ?? '') }}</textarea>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

</div>


<script>

    const priceDisplay = document.getElementById('price_display');
    const priceInput = document.getElementById('price');


    function formatHarga(value) {

        let angka = value.replace(/\D/g, '');

        if (angka === '') {
            return '';
        }

        return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }


    priceDisplay.addEventListener('input', function () {

        let angka = this.value.replace(/\D/g, '');

        this.value = formatHarga(angka);

        priceInput.value = angka;

    });


    // Format harga saat halaman pertama kali dibuka
    if (priceInput.value !== '') {

        let angka = priceInput.value.replace(/\D/g, '');

        priceDisplay.value = formatHarga(angka);

    }

</script>