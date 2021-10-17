<div class="form-group">
    <label class="form-label">{{ $label }}</label>

    <select id="{{ $id }}" class="custom-select @error($name) is-invalid @enderror" name="{{ $name }}">
        <option></option>
        @if(!isset($attribut))
            @foreach ($options as $city)
                <option value="{{ $city->id }}" @if(old('city_id') == $city->id) selected @endif>{{ $city->name }}</option>
            @endforeach
        @else
            @foreach ($options as $city)
                <option value="{{ $city->id }}" @if($attribut->userInfo && $city->id == $attribut->userInfo->city->id) selected @endif>{{ $city->name }}</option>
            @endforeach
        @endif
    </select>
    @error($name)
        <div id="{{ $errorId }}" class="invalid-feedback">{{ $message }}</div>
    @endif
</div>

