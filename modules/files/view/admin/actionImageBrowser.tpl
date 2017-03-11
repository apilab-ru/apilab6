<html>
    <head>
    {utils name=js}
    {utils name=js module=admin}
    {utils name=css}
    {utils name=css module=admin}
    </head>
    <body>
        {$html}
    </body>
    <script>
        window.selectImage = files.initSelectImage('{$act}',{$param|json_encode});
    </script>
</html>