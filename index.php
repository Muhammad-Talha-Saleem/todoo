<?php
require_once "vendor/autoload.php";
error_reporting(0);
ORM::configure('mysql:host=localhost;dbname=test');
ORM::configure('username', 'root');
ORM::configure('password', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
    
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Document</title>
    <style>
    #main{
        position: absolute;
    }
    </style>
</head>
            <!-- BODY -->
<body>
<div id="page-wrap">
    <div id="header">
      <h1><a href="">PHP Sample Test App</a></h1>
    </div>
        <div id="main">
              <noscript>This site just doesn't work, period, without JavaScript</noscript>
                    <ul class="ui-sortable" id="list">
                        <?php
                            $name = ORM::for_table('listitems')->find_many();
                            
                                foreach ($name as $nam){ 
                                     
                         ?>
                                <li data-post-id="<?php echo $nam->id; ?>" color="1" class="colorBlue" rel="1">
                                  <div class="li-post-group">
                                  <span id='2listitem' title='Double-click to edit...'   contenteditable="true" onBlur="updateValue(this,'name','<?php echo $nam->id ?>')">
                                    <?php echo $nam->name ?>
                                  </span>
                                    <div id="post" class='draggertab tab'></div>
                                    <div class='colortab tab'></div>
                                    <?php echo "<a href='delete.php?id=$nam->id&name=$nam->name&detail=$nam->orderID'  class='delete'>";?>
                                    <div class='deletetab tab' style='width: 44px; display: block; right: -64px;'></div>
                                     <?php echo "</a>"; ?>
                                    <div class='donetab tab'></div>
                            
                                  </div>
                                </li>
                    
                          <?php } 
                           ?>
                  </ul>
      
	  <br />

      <form action="insert.php" id="add-new" method="post">
        <input type="text" id="new-list-item-text" name="name" required="" />
        <input type="submit" name="submit" id="add-new-submit" value="Add" class="button" />
      </form>

      <div class="clear"></div>
      
    </div>

  </div>


                    <!-- JQUERY -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>

<script type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}

    function updateValue(element,column,id){
            var value = element.innerText;
            $.ajax({
                url:"edit.php",
                method:"post",
                data:{
                    value: value,
                    column: column,
                    id:id
                },
                success:function(php_result){
                    console.log(php_result);
                }
            });
        };

            // SORTABLE

            $(document).ready(function(){
    $( "#post" ).sortable({
      placeholder : "ui-state-highlight",
      update  : function(event, ui)
      {
        var post_order_ids = new Array();
        $('#post div').each(function(){
          post_order_ids.push($(this).data("post-id"));
        });
        $.ajax({
          url:"ajax_upload.php",
          method:"POST",
          data:{post_order_ids:post_order_ids},
          success:function(data)
          {
           if(data){
            $(".alert-danger").hide();
            $(".alert-success ").show();
           }else{
            $(".alert-success").hide();
            $(".alert-danger").show();
           }
          }
        });
      }
    });
  });
</script>
</body>
</html>

