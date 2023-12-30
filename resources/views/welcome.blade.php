<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Function</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">


  </head>
  <body>

    @php
        $product = DB::table('products')->get();
    @endphp


    <div class="container mt-5">

     
        <div class="row mt-5 mb-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            
                  <form method="post" action="{{ route('product.search')}}" class="d-flex" role="search">
                    @csrf 
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search_product">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
            
            </div>
            <div class="col-md-4"></div>
        </div>
    
    
      

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Sl</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($product as $key=>$row)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <th>
                    <img src="{{ url($row->image)}}" alt="" style="height: 30px;">
                  </th>
                  <td>{{$row->name}}</td>
                  <td>{{$row->price}}</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                    
                @endforeach
             
            </tbody>
          </table>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   
    <script>
      $(function() {
          var availableTags = [];

          $.ajax({
              method: "GET",
              url: "/product-list",
              dataType: "json", // Specify the expected data type as JSON
              success: function(response) {
                  if (Array.isArray(response)) {
                      console.log(response);
                      availableTags = response;
                      startAutoComplete(availableTags);
                  }
              },
              error: function() {
                  console.log("Error fetching product list");
              }
          });

          function startAutoComplete(availableTags) {
              $("#search_product").autocomplete({
                  source: availableTags,
                  select: function(event, ui) {
                      // When an item is selected, you can access the selected item's data
                      var selectedProduct = ui.item;
                      console.log(selectedProduct); // Log the selected item data

                      // You can also display the selected image and product name on the page
                      $("#selected-product-image").attr("src", selectedProduct.image);
                      $("#selected-product-name").text(selectedProduct.value);
                  },
                  focus: function(event, ui) {
                      // Prevent the default behavior to avoid updating the input field with the item value
                      event.preventDefault();
                  },
                  // Customize the display of items (product names and images)
                  open: function(event, ui) {
                      $(".ui-menu").css("z-index", 1001);
                  }
              }).data("ui-autocomplete")._renderItem = function(ul, item) {
                  return $("<li>")
                      // .append("<div style='height: 40px; width: 200px;'><img src='" + item.image + "' style='height: 100%; width: 30%; margin-right: 10px;'><span>" + item.value + "</span></div>")
                      .append("<div ><img src='" + item.image +
                          "' style='height: 40px; width: 40px; margin-right: 10px;'><span>" + item.value +
                          "</span></div>")
                      .appendTo(ul);
              };
          }
      });
  </script>

  </body>
</html>