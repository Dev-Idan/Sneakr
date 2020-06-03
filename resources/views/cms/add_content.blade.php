@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Content</h1>
  </div>

  <div class="row">
    <div class="col-6">
      <form action="{{ url('cms/content') }}" method="POST" novalidate autocomplete="off">
        @csrf

        <div class="form-group">
          <label for="menu-id" class="text-dark"><span class="text-danger">*</span> Menu Link</label>
          <select name="menu_id" id="menu-id" class="form-control select-fix">
            <option value="">Choose Menu Link..</option>
            @foreach ($menus as $item)
              <option @if (old('menu_id') == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['link'] }}</option>
            @endforeach
          </select>
          <small class="text-muted">Choose which menu this content belongs to</small><br>
          <span class="text-danger">{{ $errors->first('menu_id') }}</span>
        </div>

        <div class="form-group">
          <label for="ctitle" class="text-dark"><span class="text-danger">*</span> Title</label>
          <input type="text" name="ctitle" id="ctitle" class="form-control field-input-cms mb-1" value="{{ old('ctitle') }}">
          <small class="text-muted">Content Title, min 2 chars max 255 chars</small><br>
          <span class="text-danger">{{ $errors->first('ctitle') }}</span>
        </div>

        <div class="form-group">
          <label for="carticle" class="text-dark"><span class="text-danger">*</span> Article</label>
          <textarea name="carticle" id="carticle" class="form-control">{{ old('carticle') }}</textarea>
          <small class="text-muted">Content Article, min 2 chars</small><br>
          <span class="text-danger">{{ $errors->first('carticle') }}</span>
        </div>

        <input type="submit" value="Save Content" name="submit" class="btn btn-lg btn-primary">
        <a href="{{ url('cms/content') }}" class="btn btn-lg btn-block btn-secondary mt-2">Cancel</a>

      </form>
    </div>
  </div>

@endsection

@section('extraJS')
  <script>

  $('#carticle').summernote({
    height:250
  });

  $('input.note-image-input').addClass('form-control');

  </script>
@endsection
