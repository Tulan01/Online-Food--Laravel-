 

    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <script>
      $(".container1").isotope({
        itemSelector: ".card",
        layoutMode: "fitRows",
      });

      $(".menu ul li a").click(function () {
        $(".menu ul li a").removeClass("active");
        $(this).addClass("active");

        var selector = $(this).attr("data-filter");
        $(".container1").isotope({
          filter: selector,
        });
        return false;
      });

      function off() {
        if (document.getElementById("menu-off").style.display == "block") {
          document.getElementById("menu-off").style.display = "none";
        } else {
          document.getElementById("menu-off").style.display = "block";
        }
      }

      function mouseover() {
        document.getElementById("drop-cart").style.display = "block";
      }
      function mouseout() {
        document.getElementById("drop-cart").style.display = "none";
      }

      var dropCartItem = document.getElementsByClassName("sec-dlt");
      for (var i = 0; i < dropCartItem.length; i++) {
        var button = dropCartItem[i];
        button.addEventListener("click", removeDropCartItem);
      }

      function removeDropCartItem(event) {
        var buttonClicked = event.target;
        buttonClicked.parentElement.parentElement.remove();
        updateDropCartTotal();
      }

      function updateDropCartTotal() {
        var cartItemContainer = document.getElementsByClassName("dropdown-content")[0];
        var cartRows = cartItemContainer.getElementsByClassName("dropdown-content-list-1");

        var total = 0;

        for (i = 0; i < cartRows.length; i++) {
          var cartRow = cartRows[i];
          var priceElement = cartRow.getElementsByClassName("dunit")[0];
          var quantityElement = cartRow.getElementsByClassName(
            "dquantity"
          )[0];
          
          var price = parseFloat(priceElement.innerText.replace("BDT", ""));
         
          var quantity = parseFloat(quantityElement.innerText);
        
        

          document.getElementsByClassName("damount")[i].innerText =
            price * quantity;
          total = total + price * quantity;
        }
        document.getElementsByClassName("drop-total")[0].innerText = total;
      
      }
    </script>

   

   
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.video.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="frontend/js/extensions/revolution.extension.carousel.min.js"></script>


    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   
    <script src="frontend/myJs/datedropper.pro.min.js"></script>
   
    <script src="frontend/js/wow.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    
