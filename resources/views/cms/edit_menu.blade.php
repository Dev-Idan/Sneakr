@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Menu Link</h1>
  </div>

  <div class="row">
    <div class="col-6">
      <form action="{{ url('cms/menu/' . $menu_item['id']) }}" method="POST" novalidate autocomplete="off">
        @method('PUT')
        @csrf

        <input type="hidden" name="item_id" value="{{ $menu_item['id'] }}">
        
        <div class="form-group">
          <label for="link" class="text-dark"><span class="text-danger">*</span> Link</label>
          <input type="text" name="link" id="link" class="form-control field-input-cms mb-1 original-toPerm" value="{{ $menu_item['link'] }}">
          <small class="text-muted">The Menu Link, min 2 chars max 50 chars</small><br>
          <span class="text-danger">{{ $errors->first('link') }}</span>
        </div>

        <div class="form-group">
          <label for="url" class="text-dark"><span class="text-danger">*</span> Url</label>
          <input type="text" name="url" id="url" class="form-control field-input-cms mb-1 target-toPerm" value="{{ $menu_item['murl'] }}">
          <small class="text-muted">The Menu Url, small letters, - , and numbers ONLY!</small><br>
          <span class="text-danger">{{ $errors->first('url') }}</span>
        </div>

        <div class="form-group">
          <label for="title" class="text-dark"><span class="text-danger">*</span> Page Title</label>
          <input type="text" name="title" id="title" class="form-control field-input-cms mb-1" value="{{ $menu_item['mtitle'] }}">
          <small class="text-muted">The Page Title, min 2 chars max 100 chars</small><br>
          <span class="text-danger">{{ $errors->first('title') }}</span>
        </div>

        <input type="submit" value="Update Menu" name="submit" class="btn btn-lg btn-primary">
        <a href="{{ url('cms/menu') }}" class="btn btn-lg btn-block btn-secondary mt-2">Cancel</a>

      </form>
    </div>
  </div>

@endsection
