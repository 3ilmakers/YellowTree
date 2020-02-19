$(document).ready(function() {

    $(".item").click(function() {
      /*  var nbElements = $(".item").length;
       if (nbElements > 22) {
            while (nbElements >= 22) {
                $($(".item").eq(nbElements)).remove();
                nbElements--;
            }
        }*/

        $("#listItem").addClass("fixed-bottom");
        $("#listItem").addClass("listBottom");
        $(".item").removeClass("col-xl-2");
        $(".item").addClass("col-xl-1");
        $(".item").removeClass("col-md-3");
        $(".item").addClass("col-md-1");
        $(".item").removeClass("col-4");
        $(".item").addClass("col-2");

        $("#listItem").before("");


    });

});
