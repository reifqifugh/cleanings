<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($paymentMethod) ? $paymentMethod->name : '') }}" required>
</div>

<div class="form-group">
    <label for="details">Details</label>
    <textarea class="form-control" id="details" name="details">{{ old('details', isset($paymentMethod) ? $paymentMethod->details : '') }}</textarea>
</div>
