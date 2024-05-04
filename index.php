<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    
    <link rel="stylesheet" type="text/css" href="alertify/css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="alertify/css/alertify.default.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <title>Liste de tâches interactive</title>
  </head>
  <body>
    <br><br>

    <div class="container" >
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="alert alert-success" role="alert">
             <h4>LISTE DE TÂCHES INTERACTIVE</h4>
             <p class="text-info text-justify">Une application web permettant aux utilisateurs d'ajouter, de modifier, de supprimer et de marquer des tâches comme complétées en utilisant JavaScript pour l'interactivité, CSS pour le style et PHP pour la gestion des donnés côté serveur.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="input-group">
            <input type="text" class="form-control" id="txtNewItem" placeholder="Description de la tâche">
            <span class="input-group-btn">
              <button class="btn btn-primary" id="addButton" onclick="return validateForm();" type="button">Ajouter</button>
            </span>
          </div><!-- /input-group -->
        </div>
      </div>
      <div class="row">
        <div id="list" class="col-md-8 col-md-offset-2">
          <h2>MES TÂCHES</h2>  
          <?php include 'list.php' ?>
        </div>
      </div>
    </div>

    

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/core.js"></script> -->
    <script src="alertify/js/alertify.min.js"></script>

    <script>

      function validateForm(){
        var val=document.getElementById("txtNewItem").value;
        /*if (val.length<20) {
          alertify.error("Item description must contains at least 20 characters");
          return false;
        }else{*/
          InsertItemInDatabase();

        //}
      }


      /*function validateEdit(desc){
        var desc=document.getElementById("txtNewItem").value;
        if (desc.length<20) {
          alertify.error("Item description must contains at least 20 characters");
          return false;
        }else{
          return true;

        }
      }*/

    </script>

    <script>
    //Insert task from database
    function InsertItemInDatabase() {
      //Spinner
        var buttonString= "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate' id='spinner'></span> "+$('#addButton').html();
        $('#addButton').html(buttonString);
      
      var new_desc=document.getElementById("txtNewItem").value;
      document.getElementById("txtNewItem").value="";
      $.ajax({
        url:'process.php?insert_description=' + new_desc,
        complete: function (response) {
          var status = JSON.parse(response.responseText);
               // console.log(response);
               if(status.status =="success"){
                alertify.success("Le nouvel élément a été ajouté avec succès");
              }else if(status.status =="error"){
                alertify.error("Erreur lors de l'ajout de l'article");
              }
                  $( "#list" ).load( "list.php");// to reload the todo list from database
                  $( "#spinner" ).remove();//remove spinner as task is completed
                },
                error: function () {
                  $('#output').html('Dommage : il y a eu une erreur !');
                  alertify.error("Erreur lors de l'ajout de la tâche");
                },
              });
    }

    //Complete a task
    function completeItem(id){
        
        $.ajax({
            url:'process.php?checked_id=' + id,
            complete: function (response) {
              var status = JSON.parse(response.responseText);
                   // console.log(response);
                   if(status.checked_status =="success"){
                    alertify.success("Tâche achevée");
                  }else if(status.checked_status =="error"){
                    alertify.error("Erreur lors de l'achèvement de la tâche");
                  }
                      $( "#list" ).load( "list.php");// to reload the todo list from database
                    },
                    error: function () {
                      $('#output').html('Dommage : il y a eu une erreur !');
                      alertify.error("Erreur lors de l'achèvement de la tâche");
                    },
                  });      
          
    }

    //edit task
    function EditItem(id) {
      $.ajax({
        url:'process.php?edit_id=' + id,
        complete: function (response) {
              var status = JSON.parse(response.responseText);//parsing status from response received from php
              if(status.edit_status =="success"){
                alertify.success("Tâche bien modifiée");
                    $( "#list" ).load( "list.php" );// to reload the todo list from database
                  }else if(status.edit_status =="error"){
                    alertify.error("Erreur lors de la modification de l'élément");
                  }
                },
                error: function () {
                  $('#output').html('Dommage : il y a eu une erreur !');
                },
              });
    }

    //Delete task from database
    function DeleteItem(id) {
      alertify.confirm("Êtes-vous sûr de vouloir supprimer cette tâche ?", function (e) {
        if (e) {
          //for spinner
          var buttonString= "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate' id='spinner'></span> "+$('#delete_'+id).html();
          $('#delete_'+id).html(buttonString);

          $.ajax({
            url:'process.php?delete_id=' + id,
            complete: function (response) {
                   var status = JSON.parse(response.responseText);//parsing status from response received from php
                   if(status.delete_status =="success"){
                    alertify.success("L'élément a été supprimé");
                         $( "#list" ).load( "list.php" );// to reload the todo list from database
                       }else if(status.delete_status =="error"){
                        alertify.error("Erreur dans la suppression de l'élément");
                      }
                    },
                    error: function () {
                      $('#output').html('Dommage : il y a eu une erreur !');
                    },
                  });
        }
      });
    }

    function checks(id,desc){
          //var id= $(this).attr('id');
          alertify.prompt("Modification de la tâche, ID="+id, function (e, str) {
          if (e) {
              if (str) {
                /*change on database if edited text is valid*/
            //for spinner
              var buttonString= "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate' id='spinner'></span> "+$('#edit_'+id).html();
              $('#edit_'+id).html(buttonString);
              
                $.ajax({
                  url:'process.php',
                  data : {edit_id:id, new_desc:str},
                  complete: function (response) {
                  var status = JSON.parse(response.responseText);//parsing status from response received from php
                  if(status.edit_status =="success"){
                    alertify.success("Tâche bien modifiée");
                        $( "#list" ).load( "list.php" );// to reload the todo list from database
                        $( "#spinner" ).remove(); //remove spinner as task is completed
                      }else if(status.edit_status =="error"){
                        alertify.error("Erreur lors de la modification de la tâche");
                      }
                    },
                    error: function () {
                      $('#output').html('Dommage : il y a eu une erreur !');
                    },
                  });
                
                //alertify.success("Valid");
                /*--if valid ends*/
               }else{
                //alertify.error("Aucune modification n'a été apportée");
               }
          } else {
              //alertify.error("Appuyer sur cancel");
          }
        }, desc);
    }
    </script>
  </body>
</html>





