<?php
	if (isset ($_GET['playerid'])) {
	    $playerid = $_GET['playerid'];
	}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Star</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/fileinput.min.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <style type="text/css">
	    .profile {
	    	width:80%;
	    	height: 80%;
	    	margin-top:15px;
	    }

	    .credit {
	    	padding-left:37px;
	    }

	    .flip-container, .front, .back {
	    	min-height: 556px;
	    }

	    .bcontent p {
	    	margin-bottom:.7em;
	    }

	    h4 {
	    	font-size:2em;
	    }


    </style>
  </head>
  <body>	
  	<div class="news">
		<script>
		    playerid = <?php echo $playerid; ?>;
		    // console.log(playerid);

	          $.getJSON('entries.json', function(data){
	                myItems = data;
	                // console.log(data);
	                var news = document.getElementsByClassName("news")[0];
	                for(var s = 0; s < data.length; s++) {
	                	if (playerid == data[s]['playerid']) {
	                		var head = document.createElement("div");
	                		head.innerHTML = "<div class='large-3 medium-4 small-12 columns pad' player='" + data[s]['playerid'] + "'><div class='flip-container' ontouchstart='+this.classList.toggle('hover')'><div class='flipper'><div class='front cards'><div class='image'><img src='uploads/" + data[s]['url'] + "' class='profile'><h5 class='credit'>" + data[s]['credit'] + "</h5></div><div class='content' ><h4>" + data[s]['name'] + "</h4></div></div><div class='back cards'><div class='bcontent' ><h4>" + data[s]['name'] + "</h4><hr style='margin:5px 0px 5px;'><p><b>School: </b>" + data[s]['school'] + "</p><p><b>Year: </b>" + data[s]['year'] + "</p><p><b>Sport: </b>" + data[s]['sport'] + "</p><p><b>Position: </b>" + data[s]['position'] + "</p><p><b>Behind the stats: </b>" + data[s]['chip'] + "</p></div></div></div></div></div>";
	                		news.appendChild(head);
	                	}
	                };
	            })
		</script>
  	</div>
    <script src="js/foundation.min.js"></script>
    <script src="js/jquery.tabletojson.js"></script>
    <script>

    /***************
    ***** MAIN *****
    ***************/


    //Init Foundation
    $(document).foundation();


    /*************************
    ***** EVENT HANDLERS *****
    *************************/


    //Handle click me click
    $('#convert-table').click( function() {
        //Convert table 
        var table = $('#markers').tableToJSON();
        var json = JSON.stringify(table);

        $.post('save.php', {'data': json}, function(response){
            //If there is a response from the server, do something here
        });
    });


    //Capture and bind keypresses
    $('body').keypress(function(event){
        var esc = event.which == 27,
            nl = event.which == 13,
            el = event.target,
            input = el.nodeName != 'INPUT' && el.nodeName != 'TEXTAREA',
            data = {};

            if (input) {
                if (esc) {
                  // restore state
                  document.execCommand('undo');
                  el.blur();
            } else if (nl) {
              // save
              data[el.getAttribute('contenteditable')] = el.innerHTML;

              el.blur();
              event.preventDefault();
            }
          }

    })
    </script>
  </body>
</html>