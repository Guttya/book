<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}"
           class="form-control @error($name) is-invalid @enderror"
           id="{{ $id }}"
           placeholder="{{ $placeholder }}"
           name="{{ $name }}"
           value="{{ $value }}"
           autocomplete="new-password"
    >
    @error($name)
        <div id="{{ $errorId }}" class="invalid-feedback">{{ $message }}</div>
    @endif
</div>
