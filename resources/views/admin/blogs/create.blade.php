@extends('layouts.app')

@section('pagejs-head')
<script src="https://cdn.tiny.cloud/1/mt7crpx0n8a6cz3y8z15k6sdpwjc3cghzfdrj5p4lju4gi5g/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
@endsection
@section('content')

<div class="container">
    <form method="POST" action="/admin/blogs/create" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <textarea name="excerpt" class="form-control" rows="3">{!! old('excerpt') !!}</textarea>
        </div>

        <div class="form-group">
            <textarea name="content" class="form-control my-editor" rows="20">{!! old('content') !!}</textarea>
        </div>
        <div class="form-group form-check form-check-inline">
                @foreach($categories as $category)
                  <input type="checkbox" value="{{ $category->id }}" name="category_id[]" class="form-check-input" 
                  @if(is_array(old('category_id')) && in_array($category->id, old('category_id'))) checked @endif>
                  <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
                @endforeach
               </div>
               <div class="form-group">
                  <label class="btn btn-default">
                   <span class="btn btn-outline btn-sm btn-info">Featured Image</span>
                   <input type="file" name="featured_image" class="form-control" hidden>
                 </label>
               </div>

        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>





@endsection

@section('pagejs-end')
<script>
var editor_config = {
    path_absolute: "/",
    selector: 'textarea.my-editor',
    relative_urls: false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback: function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
            'body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName(
            'body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
};

tinymce.init(editor_config);
</script>

@endsection