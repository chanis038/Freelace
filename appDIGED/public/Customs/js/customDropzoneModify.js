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
            var verButton = Dropzone.createElement('<a class="dz-remove" target="_blank" href="'+path+'viewFile/'+archivos[i].slug+'/0">Ver Archivo</a>');
    
             var file ={
                name: archivos[i].nombre+archivos[i].tipo,
                size: 1100,
                accepted: true,
                slug: archivos[i].slug
              }
              mydrop.options.addedfile.call(mydrop, file);
              if(archivos[i].tipo=='.pdf'){
              mydrop.options.thumbnail.call(mydrop,file,path+"images/pdf.jpg"); 
              file.previewElement.appendChild(verButton);
              file.previewElement.classList.add('dz-success');
              file.previewElement.classList.add('dz-complete');
               }         
              else{
                mydrop.options.thumbnail.call(mydrop,file,path+'Solicitudes/'+archivos[i].ruta+archivos[i].nombre+archivos[i].tipo);
                file.previewElement.appendChild(verButton);
                 file.previewElement.classList.add('dz-success');
                file.previewElement.classList.add('dz-complete');
               }
              }


           this.on('sending', function(file, xhr, formData){
            formData.append('_token', $('[name="_token"]').val());
             formData.append('slug', $('[name="slug"]').val());
             });

            this.on('success', function(file, xhr, formData){
                sentrequest.disabled = false; 
                var verButton = Dropzone.createElement('<a class="dz-remove" target="_blank" href="'+path+'viewFile/'+user+"$$"+file.name+'/1">Ver Archivo</a>');
    
             if (!file.type.match(/image.*/)) {
                mydrop.options.thumbnail.call(mydrop,file,path+"images/pdf.jpg");
                 file.previewElement.appendChild(verButton);
              
           }else
           {
             file.previewElement.appendChild(verButton);
                 
           }
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