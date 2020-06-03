@extends('cms.layout')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Category</h1>
  </div>

  <div class="row">
    <div class="col-6">
      <form action="{{ url('cms/categories/' . $category_item['id']) }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="hidden" name="item_id" value="{{ $category_item['id'] }}">
        <input type="hidden" name="eval_pic" value="no">

        <div class="form-group">
          <label for="ctitle" class="text-dark"><span class="text-danger">*</span> Title</label>
          <input type="text" name="ctitle" id="ctitle" class="form-control field-input-cms mb-1 original-toPerm" value="{{ $category_item['ctitle'] }}">
          <small class="text-muted">Category Title, min 2 chars max 100 chars</small><br>
          <span class="text-danger">{{ $errors->first('ctitle') }}</span>
        </div>

        <div class="form-group">
          <label for="curl" class="text-dark"><span class="text-danger">*</span> Category Url</label>
          <input type="text" name="curl" id="curl" class="form-control field-input-cms mb-1 target-toPerm" value="{{ $category_item['curl'] }}">
          <small class="text-muted">The Category Url, small letters, - , and numbers ONLY!</small><br>
          <span class="text-danger">{{ $errors->first('curl') }}</span>
        </div>

        <div class="form-group">
          <label for="carticle" class="text-dark"><span class="text-danger">*</span> Description</label>
          <textarea name="carticle" id="carticle" class="form-control">{{ $category_item['carticle'] }}</textarea>
          <small class="text-muted">Category Description, min 2 chars</small><br>
          <span class="text-danger">{{ $errors->first('carticle') }}</span>
        </div>

        <div class="form-group">
          <h4>Current Image:</h4>
          <img src="{{ asset('imgs/categories/' . $category_item['cimage'] ) }}" width="200">
        </div>

        <div class="input-group mb-1 mt-4">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="cimage" name="cimage" aria-describedby="cimage">
            <label class="custom-file-label" for="cimage">Change Image</label>
          </div>
        </div>
        <div class="form-group mb-5">
          <small class="text-muted">Category Image, Allowed file extentions : jpg,jpeg,png,gif | Max file size: 5MB</small><br>
          <span class="text-danger">{{ $errors->first('cimage') }}</span>
        </div>

        <input type="submit" value="Update Category" name="submit" class="btn btn-lg btn-primary">
        <a href="{{ url('cms/categories') }}" class="btn btn-lg btn-block btn-secondary mt-2">Cancel</a>

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

  // let the user see what file he chose
  $('#cimage').on('change',function(){

      let fileName = $(this).val();
      $(this).next('.custom-file-label').text(fileName);
  });

  </script>
@endsection
