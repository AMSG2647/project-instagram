const url = "http://localhost/proyecto-laravel/public/";

window.addEventListener("load", function(){

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //Boton de like

    function like(){
        $('.btn-like').unbind('click').click(function(){
            console.log('Like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'img/like-red-white.png');

            $.ajax({
                url: url + 'like/' + $(this).data('id'),
                type: 'GET',

                success: function(response){

                    if(response.like){
                        console.log('Has dado like');
                    }else{
                        console.log('Errrrrrrrorrrrrrrr');
                    }
                }
            });          
            dislike();
        });
    }

    
    //Boton dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            console.log('disLike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'img/like.png');

            $.ajax({
                url: url + 'dislike/' + $(this).data('id'),
                type: 'GET',

                success: function(response){

                    if(response.like){
                        console.log('Has dado dislike');
                    }else{
                        console.log('Errrrrrrrorrrrrrrr');
                    }
                }

                
            });

            like();
        });
    }

    like();
    dislike();

    //Buscador

    $('#buscador').submit(function(e){

        $(this).attr('action', url + 'user/index/' + $('#buscador #search').val());

    });
    
});