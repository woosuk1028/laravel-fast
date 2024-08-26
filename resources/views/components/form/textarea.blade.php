<div class="col-md-{{$width}}">
    <div class="form-group">
        <label for="{{ $name }}">{{ $placeholder }}</label>
        <textarea id="{{ $name }}" rows="{{ $rows }}" class="form-control" name="{{ $name }}" placeholder="{{ $placeholder }}" {{$attributes}} {{$disabled}}>{{ old($name, $value) }}</textarea>
        @error($name)
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>