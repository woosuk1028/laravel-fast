<div class="col-md-{{$width}}">
    <div class="form-group">
        <label for="{{ $name }}">{{ $label }}</label>
        <select id="{{ $name }}" name="{{ $name }}" class="form-control {{ $errors && $errors->has($name) ? 'is-invalid' : '' }}" {{$disabled}}>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>