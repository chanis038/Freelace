 (function(){
        var  comment =  document.getElementById('comment'),
         savecomment =  document.getElementById('save');
      

           savecomment.addEventListener('click',function(){
           var comentario= comment.value; 
           console.log("comentario"+comentario);
            if(!(comentario === null || comentario ==='')) {

               var url= "/addComment",
                xdata= {
                  comment: comentario,  
                  slug: slugval ,
                  _token: $('[name="_token"]').val()};

             $.post(url, xdata).done(function( result ) { 
              console.log(result);
              if(result.indexOf("NOT OK")==-1){
                /**/
                }

              });

            }

            } );
       

      })();
