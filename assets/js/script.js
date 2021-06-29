$(document).ready(function(){
    $('.block').click(function(){
        var id = $(this).attr('data-id');
        var code_facult = $(this).attr('data-code_facult');
        var code_depart = $(this).attr('data-code_depart');
        var code_niv = $(this).attr('data-code_niv');

        var form =  $ ('#contactForm');
        $(form).append("<input type ='hidden' class='check_id' name ='id'  value ='"+id+"'>");
        $(form).append("<input type ='hidden' class='check_facult' name ='facult'  value ='"+code_facult+"'>");
        $(form).append("<input type ='hidden' class='check_depart' name ='depart'  value ='"+code_depart+"'>");
        $(form).append("<input type ='hidden' class='check_niv' name ='niv'  value ='"+code_niv+"'>");


    });
    $('.close').click(function(){
      $('.check_facult').remove();
      $('.check_depart').remove();
      $('.check_niv').remove();
      $('.check_id').remove();
      $('.modal-footer').html("");

    });
    
    
    $('#submit').click(function(){
  
      var fd = new FormData();
      var files = $('#file')[0].files[0];
      var id = $('.check_id').val();
      var facult = $('.check_facult').val();
      var depart = $('.check_depart').val();
      var niv = $('.check_niv').val();

      fd.append('file',files);
      fd.append('id',id);
      fd.append('facult',facult);
      fd.append('depart',depart);
      fd.append('niv',niv);

  
      // AJAX request
      $.ajax({
        url: 'pop-up.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response == 1){
            $('.modal-footer').html('<div class="alert alert-success" role="alert">Fichier enregistré</div>');
            $('.check_facult').remove();
            $('.check_depart').remove();
            $('.check_niv').remove();
            $('.check_id').remove();
          }else if(response == 2 ){
            $('.modal-footer').html('<div class="alert alert-danger" role="alert">Format invalide</div>');
          }
          else{
            $('.modal-footer').html('<div class="alert alert-danger" role="alert">Erreur! Veillez réesayer</div>');
          }
        }
      });
      
    });

    $(".publie").on('click',function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
          url:"publie.php",
          type:'post',
          data:{id:id},
          success:function(html)
          {
            $("#"+id).html(html);
          
            
          }
      });
    });

    $(".supprimer").on('click',function()
    {
      var id = $(this).attr('data-id');
      $.ajax({
          url:"delete.php",
          type:'post',
          data:{id:id},
          success:function(html)
          {
          }
      });
    });

    
    
  });
