<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopInAja @yield('title')</title>
    <link rel="icon" href="/images/fi-xnsuxl-shopify.svg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script defer src="https://friconix.com/cdn/friconix-0.2213.js"> </script>
    <style>
        a {
            text-decoration: none;
        }
    </style>
    <script>
        var rows=0;
        $(document).ready(function () {
            $("#AddRow").click(AddRow);
            $("#RemoveRow").click(RemoveRow);
        });
        function AddRow() {
            rows=rows+1;
            var table = document.getElementById("table");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(0);
            //cell1.innerHTML = rows+'<input type="hidden" name="id[]" value="'+rows+'">';
            cell1.innerHTML = '<input type="text" class= "input" name="values[]" required placeholder="Values '+rows+'">';
            cell2.innerHTML = '<input type="text" class= "input" name="keys[]" required placeholder="Keys '+rows+'">';
        }

        function RemoveRow(){
            if(rows!=0){
                rows=rows-1;
            }
            document.getElementById("table").deleteRow(-1);
        }
    </script>
</head> 
<body>
    <div class="container">
        <div class="columns">    
            <div class="column">
                <h1 class="is-size-1-desktop has-text-centered">
                    ShopInAja
                    <span class="icon has-text-danger">
                        <i class="fi-xnsuxm-shopify"></i>
                    </span>
                </h1>
            </div>
        </div>
        
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>ShopInAja</strong> | by Alex + Timothy + Jeddi + Fedly | Big Data | NoSQL
    </p>
  </div>
</footer>
</html>
