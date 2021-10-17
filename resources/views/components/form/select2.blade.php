<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <select id="{{ $id }}"
            class="form-control js-select2 @error($name) is-invalid @enderror"
            name="{{ $name }}"
            data-placeholder="{{ $placeholder }}"
            {{ $isMultiply ? 'multiple' : ''}}
    >

        @foreach ($options as $option)
            <option value="{{ $option['id'] }}" {{ $isSelected($option['id']) ? 'selected="selected"' : '' }}>{{ $option['name'] }}</option>
        @endforeach
    </select>
    @error($name)
        <div id="{{ $errorId }}" class="invalid-feedback">{{ $message }}</div>
    @endif
</div>
