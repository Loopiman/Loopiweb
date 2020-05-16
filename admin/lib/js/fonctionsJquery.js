$(document).ready(function () {
  $(".checkbox").change(function () {
    var parametre;
    var state = 0;
    if ($(this).is(":checked")) state = 1;
    parametre = "&id=" + $(this).attr("id") + "&new=" + state;
    console.log($(this).attr("id"));
    var retour = $.ajax({
      type: "GET",
      data: parametre,
      url: "/admin/lib/php/ajax/ajaxUpdateEnabled.php",
      dataType: "text",
      success: function (data) {
        // console.log(parametre);
      },
    });
  });
});
