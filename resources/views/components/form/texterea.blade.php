<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <textarea
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $id }}"
        rows="3"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}">{{ $value }}</textarea>

    @error($name)
        <div id="{{ $errorId }}" class="invalid-feedback">{{ $message }}</div>
    @endif
</div>
