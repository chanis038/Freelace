(function(){
	
        Dropzone.options.mydropzone= {
          url: urlPostLoad,
          paramName: "file",           
          method: 'post',
          acceptedFiles: '.jpg,.pdf',
          uploadMultiple: true,
          addRemoveLinks: true,
          timeout: 360000,
          dictRemoveFile:'Eliminar Archivo' ,
          dictInvalidFileType: 'Tipo de Archivo no permitido, solo se permiten extensiones JPG y PDF',
          
          init: function(){


            var mydrop = this , sendrequest= document.getElementById('sentrequest');

            var archivos =loadArchivos;
             for(var i=0;i<archivos.length;i++)
            {
             var file ={
                name: archivos[i].nombre+archivos[i].tipo,
                size: 1100,
                slug: archivos[i].slug
              }
              mydrop.options.addedfile.call(mydrop, file);
             //thisDropzone.options.thumbnail.call(thisDropzone, archivos, archivos.path);
             //mydrop.options.thumbnail.call(mydrop,  archivos[i]);
    
              }


           this.on('sending', function(file, xhr, formData){
            formData.append('_token', $('[name="_token"]').val());
             formData.append('slug', $('[name="slug"]').val());
             });

            this.on('success', function(file, xhr, formData){
                sentrequest.disabled = false; 
             });
       
          },


          removedfile: function(file) {
              sentrequest.disabled = false;
               
               var url= urlPostDelete,
                xdata= {
                  name: file.name, 
                  _token: $('[name="_token"]').val(), 
                  slug: $('[name="slug"]').val(),
                  slugFile: file.slug
                 };

             $.post(url, xdata).done(function( result ) { 
              console.log(result);
              if(result.indexOf("NOT OK")==-1){
                /**/
                }

              });

             var _ref;
              if (file.previewElement) {
                if ((_ref = file.previewElement) != null) {
                  _ref.parentNode.removeChild(file.previewElement);
                }
              }
              return this._updateMaxFilesReachedClass();

          }
        }
})();