@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking</h1>
    <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="booking_code">Salin kode booking ini agar mempermudah pencarian :</label>
            <input type="text" id="booking_code" name="booking_code" class="form-control" value="{{ 'BOOK-' . strtoupper(Str::random(8)) }}" readonly>
        </div>
        <div class="form-group">
            <label for="category_id">Category :</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" data-price="{{ $category->price }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Harga :</label>
            <p id="categoryPrice">Rp 0</p>
        </div>
        <div class="form-group">
            <label for="room_size_id">Ruangan</label>
            <select name="room_size_id" id="room_size_id" class="form-control" required>
                <option value="">-- Select Room Size --</option>
                @foreach ($roomSizes as $roomSize)
                    <option value="{{ $roomSize->id }}" data-price="{{ $roomSize->price }}">
                        {{ $roomSize->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Harga Per Meter:</label>
            <p id="roomSizePrice">Rp 0</p>
        </div>
        <div class="form-group">
            <label for="size">Masukan Luas Ruangan</label>
            <input type="number" class="form-control" id="size" name="size" min="1" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="user_name">User Name</label>
            <input type="text" class="form-control" id="user_name" name="user_name" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="booking_date">Booking Date</label>
            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
        </div>
        <div class="form-group">
            <label>Total Price:</label>
            <p id="totalPrice">Rp 0</p>
        </div>
        <div class="form-group">
            <label for="payment_method_id">Payment Method</label>
            <select class="form-control" id="payment_method_id" name="payment_method_id" required>
                <option value="">Select Payment Method</option>
                @foreach($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}" data-details="{{ $paymentMethod->details }}">{{ $paymentMethod->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" id="paymentProofDiv" style="display: none;">
            <label for="payment_proof">Foto Bukti Pembayaran</label>
            <input type="file" class="form-control-file" id="payment_proof" name="payment_proof">
        </div>        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
    
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const roomSizeSelect = document.getElementById('room_size_id');
        const sizeInput = document.getElementById('size');
        const categoryPriceElement = document.getElementById('categoryPrice');
        const roomSizePriceElement = document.getElementById('roomSizePrice');
        const totalPriceElement = document.getElementById('totalPrice');
        const paymentMethodSelect = document.getElementById('payment_method_id');
        const paymentProofDiv = document.getElementById('paymentProofDiv');
        const paymentProofInput = document.getElementById('payment_proof');

        function formatRupiah(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }

        function updatePrices() {
            const selectedCategory = categorySelect.options[categorySelect.selectedIndex];
            const categoryPrice = selectedCategory ? parseFloat(selectedCategory.getAttribute('data-price')) : 0;
            categoryPriceElement.textContent = 'Rp ' + formatRupiah(Math.round(categoryPrice));

            const selectedRoomSize = roomSizeSelect.options[roomSizeSelect.selectedIndex];
            const roomSizePrice = selectedRoomSize ? parseFloat(selectedRoomSize.getAttribute('data-price')) : 0;
            roomSizePriceElement.textContent = 'Rp ' + formatRupiah(Math.round(roomSizePrice));

            const size = parseFloat(sizeInput.value) || 0;
            const totalPrice = categoryPrice + (roomSizePrice * size);
            totalPriceElement.textContent = 'Rp ' + formatRupiah(Math.round(totalPrice));
        }

        categorySelect.addEventListener('change', updatePrices);
        roomSizeSelect.addEventListener('change', updatePrices);
        sizeInput.addEventListener('input', updatePrices);

        paymentMethodSelect.addEventListener('change', function () {
            const selectedPaymentMethod = paymentMethodSelect.options[paymentMethodSelect.selectedIndex];
            const paymentMethodDetails = selectedPaymentMethod ? selectedPaymentMethod.getAttribute('data-details') : '';

            if (selectedPaymentMethod && selectedPaymentMethod.textContent === 'transfer') {
                Swal.fire({
                    title: 'Transfer Required',
                    text: 'Tolong transfer pada rekening ini : ' + paymentMethodDetails,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });

                paymentProofDiv.style.display = 'block';
                paymentProofInput.setAttribute('required', 'required'); // Make the file upload required
            } else {
                paymentProofDiv.style.display = 'none';
                paymentProofInput.removeAttribute('required'); // Remove the required attribute
            }
        });

        // Initial update of prices
        updatePrices();
    });
</script>



@endsection
