<?php
  include('header.php');
?>
    <div class="row">
      <div class="large-12 columns" style="text-align:justify;">
        <h3>Headline</h3>
        <p>These are the standouts. Every high school athlete is deserving of praise but these are the elite, the best of the best.</p>
         
        <p>Each season, Lohud.com selects All-Stars, student athletes who have shown the greatest skill, commitment, talent and will. These are the athletes who have, through tireless dedication to their sport, have risen above even that elite group.</p>

        <p>Below you’ll find the top high school All-Stars as selected by our sports staff, in softball, track and field, lacrosse, golf and baseball. Flip each card to see the stats for each player.</p>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns news">
        <script type="text/javascript">
          $.getJSON('entries.json', function(data){
                myItems = data;
                // console.log(data);
                var news = document.getElementsByClassName("news")[0];
                for(var s = 0; s < data.length; s++) {
                  var head = document.createElement("div");
                  head.innerHTML = "<div class='large-4 medium-4 small-12 columns pad' player='" + data[s]['playerid'] + "'><div class='flip-container' ontouchstart="+'+this.classList.toggle('+"'hover'"+");><div class='flipper'><div class='front cards'><div class='image'><img src='uploads/" + data[s]['url'] + "' class='profile'><h5 class='credit'>" + data[s]['credit'] + "</h5></div><div class='content' ><h4>" + data[s]['name'] + "</h4></div></div><div class='back cards'><div class='bcontent' ><h4>" + data[s]['name'] + "</h4><hr><p><b>School: </b>" + data[s]['school'] + "</p><p><b>Year: </b>" + data[s]['year'] + "</p><p><b>Sport: </b>" + data[s]['sport'] + "</p>"+ (data[s]['position'] == '' ? "" : "<p><b>Position: </b>" + data[s]['position'] + "</p>") + "<p><b>Behind the stats: </b>" + data[s]['chip'] + "</p></div></div></div></div></div>";
                  news.appendChild(head);
                };
            })
        </script>
      </div>
    </div>
<?php
  include('footer.php');
?>
