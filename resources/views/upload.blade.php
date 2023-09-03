<!DOCTYPE >
<html>
    <head>
        <!-- other html -->

        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    </head>
    <body>
        <!-- other html -->
    hello
    <input type="file" id="avatar" />
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="avatar"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
    server: 
    {
        url:'./upload',
        headers:
        {
            'X-CSRF-TOKEN':'{{csrf_token()}}'
        }
    }

});
</script>
      
    </body>
</html>