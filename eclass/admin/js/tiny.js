 tinymce.init({
     
	 selector: '#content',
     plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: "../css/style.css",
     toolbar: ['undo redo | styleselect | bold italic | link image','alignleft aligncenter alignright' ],
     
     });