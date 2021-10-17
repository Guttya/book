<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <div class="custom-file">
        <input type="{{ $type }}"
               class="custom-file-input @error($name) is-invalid @enderror"
               id="{{ $id }}"
               name="{{ $name }}">
        @error($name)
            <div id="{{ $errorId }}" class="invalid-feedback">{{ $message }}</div>
        @endif
      <label class="custom-file-label" for="{{ $id }}">{{ $label2 }}</label>
    </div>
</div>


