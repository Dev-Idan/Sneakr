@extends('cms.layout')

@section('extraCSS')

  <style media="screen">
    .checkbox-fix{
      height: auto;
      width: auto;
    }

    input.select2-search__field{
      height: auto !important;
    }

    .cms-border-gallery{
      border-color: rgba(0,0,0,0.7);
    }

    .cms-cursor-pointer{
      cursor: pointer;
    }

  </style>

@endsection

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Product</h1>
  </div>

  <div class="row">
    <div class="col-6">
      <form action="{{ url('cms/products/' . $product_item['id']) }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="hidden" name="item_id" value="{{ $product_item['id'] }}">
        <input type="hidden" name="eval_pic" value="no">

        <div class="form-group">
          <label for="category-id" class="text-dark"><span class="text-danger">*</span> Product Category</label>
          <select name="category_id" id="category-id" class="form-control select-fix">
            @foreach ($categories as $item)
              <option @if ($product_item['categorie_id'] == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['ctitle'] }}</option>
            @endforeach
          </select>
          <small class="text-muted">Choose which category this product belongs to</small><br>
          <span class="text-danger">{{ $errors->first('category_id') }}</span>
        </div>

        <div class="form-group">
          <label for="ptitle" class="text-dark"><span class="text-danger">*</span> Title</label>
          <input type="text" name="ptitle" id="ptitle" class="form-control field-input-cms mb-1 original-toPerm" value="{{ $product_item['ptitle'] }}">
          <small class="text-muted">Product Title, min 2 chars max 255 chars</small><br>
          <span class="text-danger">{{ $errors->first('ptitle') }}</span>
        </div>

        <div class="form-group">
          <label for="purl" class="text-dark"><span class="text-danger">*</span> Product Url</label>
          <input type="text" name="purl" id="purl" class="form-control field-input-cms mb-1 target-toPerm" value="{{ $product_item['purl'] }}">
          <small class="text-muted">The Product Url, small letters, - , and numbers ONLY!</small><br>
          <span class="text-danger">{{ $errors->first('purl') }}</span>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="price" class="text-dark"><span class="text-danger">*</span> Price</label>
              <input type="text" name="price" id="price" class="form-control field-input-cms mb-1" value="{{ $product_item['price'] }}">
              <small class="text-muted">The Product Price, Numbers ONLY!</small><br>
              <span class="text-danger">{{ $errors->first('price') }}</span>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="brand" class="text-dark"><span class="text-danger">*</span> Product Brand</label>
              <input type="text" name="brand" list="brand" class="form-control field-input-cms mb-1" value="{{ $product_item['brand'] }}">
              <datalist id="brand">
              @foreach ($brands_arr as $brand)
                <option>{{ $brand }}</option>
              @endforeach
              </datalist>
              <small class="text-muted">The Product brand</small><br>
              <span class="text-danger">{{ $errors->first('brand') }}</span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="color" class="text-dark"><span class="text-danger">*</span> Product Colors (multiple choice)</label>
          <select name="color[]" id="color" class="form-control select-fix color-picker" multiple="multiple">
            @foreach ($colors_arr as $color)
              <option  {{ in_array($color, explode(',', $product_item['color'])) ? 'selected' : '' }}  value="{{ $color }}">
                {{ $color }}
              </option>
            @endforeach
          </select>
          <small class="text-muted">What colors does this product have?</small><br>
          <span class="text-danger">{{ $errors->first('color') }}</span>
        </div>


        <div class="form-group mb-4">
          <label for="article" class="text-dark"><span class="text-danger">*</span> Description</label>
          <textarea name="particle" id="article" class="form-control">{{ $product_item['particle'] }}</textarea>
          <small class="text-muted">Product Description, min 2 chars</small><br>
          <span class="text-danger">{{ $errors->first('particle') }}</span>
        </div>

        <div class="form-group">
          <h4>Current Main Image:</h4>
          <img src="{{ asset('imgs/products/' . $product_item['pimage'] ) }}" width="200">
        </div>

        {{-- Main Image --}}
        <h5 class="text-dark"><span class="text-danger">*</span> Main Product Image</h5>
        <div class="input-group mb-1 mt-3">
          <div class="custom-file">
            <input type="file" class="custom-file-input img-input-class" id="pimage" name="pimage" aria-describedby="pimage">
            <label class="custom-file-label" for="pimage">Change Image</label>
          </div>
        </div>
        <div class="form-group mb-4">
          <small class="text-muted">Product Main Image, Allowed file extentions : jpg,jpeg,png,gif | Max file size: 5MB</small><br>
          <span class="text-danger">{{ $errors->first('pimage') }}</span>
        </div>
        {{-- Main Image End --}}

        @if (!empty($product_item['pgallery']))
          <h4>Current Additional Images (uncheck to remove):</h4>
          <div class="row ml-1 mt-2 mb-4">
            @foreach (explode('|', $product_item['pgallery']) as $image)
              <div class="col-3 p-2 mr-2 mt-2 d-flex flex-column align-items-center border cms-border-gallery">
                <input id="{{ $image }}" type="checkbox" class="checkbox-fix" name="old_gallery[]" value="{{ $image }}" checked>
                <label for="{{ $image }}"><img class="mt-1 cms-cursor-pointer" src="{{ asset('imgs/products/' . $image ) }}" width="200"></label>
              </div>
            @endforeach
          </div>
        @endif

        {{-- Images Gallery --}}
        <h5 class="text-dark">Additional Images (Not Required):</h5>
        <div class="input-group mb-1 mt-3 increment">
          <div class="custom-file">
            <input type="file" class="custom-file-input img-input-class" id="pgallery" name="pgallery[]" aria-describedby="pgallery">
            <label class="custom-file-label" for="pgallery">Add Images</label>
          </div>
          <button class="btn btn-success add-image-btn" type="button"><i class="fas fa-plus-circle"></i> Add Another</button>
        </div>

        <div class="clone d-none">
          <div class="input-group control-group mb-1 mt-2">
            <div class="custom-file">
              <input type="file" class="custom-file-input img-input-class" name="pgallery[]" aria-describedby="pgallery">
              <label class="custom-file-label">Add Images</label>
            </div>
            <button class="btn btn-danger remove-image-btn" type="button"><i class="fas fa-minus-circle"></i> Remove</button>
          </div>
        </div>

        <div class="form-group mb-5">
          <small class="text-muted">Product Additional Images (Not Required), Allowed file extentions : jpg,jpeg,png,gif | Max file size: 5MB</small><br>
          <span class="text-danger">{{ $errors->first('pgallery.*') }}</span>
        </div>
        {{-- Images Gallery End --}}


        <input type="submit" value="Update Product" name="submit" class="btn btn-lg btn-primary">
        <a href="{{ url('cms/products') }}" class="btn btn-lg btn-block btn-secondary mt-2">Cancel</a>

      </form>
    </div>
  </div>

@endsection

@section('extraJS')
  <script>

  $('#article').summernote({
    height:250
  });

  $('.color-picker').select2({
    placeholder: 'Select Product Colors'
  });

  $('input.note-image-input').addClass('form-control');

  // let the user see what file he chose
  $("body").on("change",".img-input-class",function(){
    let fileName = $(this).val();
    $(this).next('.custom-file-label').text(fileName);
  });

  // multiple image functionality
  $(".add-image-btn").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });

  $("body").on("click",".remove-image-btn",function(){
      $(this).parents(".control-group").remove();
  });
  // multiple image functionality end

  </script>
@endsection
