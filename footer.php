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

              // we could send an ajax request to update the field
              /*
              $.ajax({
                url: window.location.toString(),
                data: data,
                type: 'post'
              });
              */
              // log(JSON.stringify(data));

              el.blur();
              event.preventDefault();
            }
          }

    })
    </script>
  </body>
</html>