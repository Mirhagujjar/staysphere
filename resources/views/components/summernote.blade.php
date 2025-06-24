<script src="{{asset('plugins/jquery/jquery.slim.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{asset('summernote/summernote-lite.css')}}" rel="stylesheet">
    <script src="{{asset('summernote/summernote-lite.js')}}"></script>

      <script>
    $(document).ready(function () {
        $('#summernote').summernote({
            placeholder: 'Enter description...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
 

</script>