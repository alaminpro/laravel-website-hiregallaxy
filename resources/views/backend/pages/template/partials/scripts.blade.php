<style>
    label {
        font-weight: bold;
    }

    .form-group {
        margin-top: -14px;
    }

    .mce-branding-powered-by {
        display: none;
    }

    .mce-statusbar .mce-container-body {
        display: none;
    }

    .mce-panel {
        border: 0 solid #9e9e9e30;
        border-bottom: 0px !important;
    }

    .mce-container,
    .mce-container *,
    .mce-widget,
    .mce-widget *,
    .mce-reset {
        border-right: 1px solid transparent;
    }
</style>
<script>
    //  plugins: 'codesample code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern',
    //  toolbar: 'bold italic hr forecolor backcolor | codesample code autolink  | link  image | alignleft aligncenter alignright | numlist bullist | preview',
  
    tinymce.init({
        selector:'.template' ,
        plugins: 'codesample autoresize code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern',
        autoresize_bottom_margin: 0,
        contextmenu: 'copy paste',
        toolbar: 'bold italic hr forecolor backcolor |  autolink  link  alignleft aligncenter alignright numlist bullist code preview',
        image_advtab: true,
        menubar:false,
        setup: function(editor){
          editor.on('keyup', function(e){
            vm.model = editor.getContent();
          })
        }
      });
</script>