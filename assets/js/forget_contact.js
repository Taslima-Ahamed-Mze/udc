$(document).ready(function(){

    $('#send_forget').on('click',function(){
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();
        var tel = $("#telephone").val();
        var objet = $("#subject").val();
        var msg = $("#msg").val();
        $.ajax({
            url:"action_forget.php",
            type:'post',
            data:{nom:nom,prenom:prenom,email:email,tel:tel,objet:objet,msg:msg},
            success:function(html)
            {
                if(html == 1)
                {
                    $("#message").html('<div class="alert alert-success" role="alert">Email envoyé</div>');

                }else if(html == 0){
                    $("#message").html('<div class="alert alert-danger" role="alert">Erreur</div>');

                }else if(html == 2)
                {
                    $("#message").html('<div class="alert alert-danger" role="alert">Veuillez remplir tous les champs</div>');

                }
            
                
            }
        });
    });




});