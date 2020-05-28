$(document).ready(function () {
  //fonction qui permet que lorsqu'on appuie sur les flèches du haut et du bas, on puisse naviguer entre les liens
  //de la page accueil

  //variable qui correspondent à l'id
  var current = 1;
  $(".down").click(function () {
    if (current < 3) {
      current++;
      //navigation vers le lien
      window.location = "#" + current;
    }
  });
  $(".up").click(function () {
    if (current > 1) {
      current--;
      window.location = "#" + current;
    }
  });
  $(document).keydown(function (e) {
    switch (e.which) {
      //flèche du bas
      case 40:
        if (current < 3) {
          current++;
          //navigation vers le lien
          window.location = "#" + current;
        }
        break;
      //flèche du haut
      case 38:
        if (current > 1) {
          current--;
          window.location = "#" + current;
        }
        break;
      default:
        return;
    }
    e.preventDefault();
  });

  //ajax pour l'activation de la commande
  $(".checkbox").change(function () {
    var parametre;
    var state = 0;
    if ($(this).is(":checked")) state = 1;
    parametre = "&id=" + $(this).attr("id") + "&new=" + state;
    var retour = $.ajax({
      type: "GET",
      data: parametre,
      url: "/admin/lib/php/ajax/ajaxUpdateEnabled.php",
      dataType: "text",
      success: function (data) {},
    });
  });

  $(".delete").hover(function () {
    if ($(this).attr("id") <= 5) {
      $('[data-toggle="tooltip"]').tooltip();
    }
  });

  //ajax pour la suppresion de la commande sans devoir passer par formulaire
  $(".delete").click(function () {
    if ($(this).attr("id") > 5) {
      parametre = "&id=" + $(this).attr("id");
      var retour = $.ajax({
        type: "GET",
        data: parametre,
        url: "/admin/lib/php/ajax/ajaxDeleteCommand.php",
        dataType: "text",
        success: function (data) {
          location.reload();
        },
      });
    }
  });

  $(".add_command").click(function () {
    if (!$("#return").val() || !$("#command_name").val()) {
      $("#return").addClass("error");
      $("#command_name").addClass("error");
    }
    if ($("#return").val() && $("#command_name").val()) {
      var command = $("#command_name").val();
      if ($("#command_name").val().startsWith("!")) {
        command = $("#command_name").val().substring(1);
      }
      var parametre = "&n=" + command + "&r=" + $("#return").val();

      //ajax pour l'insertion de la commande sans devoir passer par formulaire
      var retour = $.ajax({
        type: "GET",
        data: parametre,
        url: "/admin/lib/php/ajax/ajaxInsertCommand.php",
        dataType: "text",
        success: function (data) {
          location.reload();
        },
      });
    }
  });

  $("*").blur(function () {
    $("#return").removeClass("error");
    $("#command_name").removeClass("error");
  });

  if (location.href.split("/").slice(-1) == "index.php?page=overview") {
    $(".container span").each(function () {
      if ($(this).html().length > 20) {
        var newName = $(this).html().substring(0, 20) + "...";
        $(this).text(newName);
      }
    });
  }

  if (location.href.split("/").slice(-1) == "index.php?page=members") {
    $(document).ready(WindowsSize);
    $(window).resize(WindowsSize);
    var ok = false;
    //en fonction de la taille de l'écran, racccourcir le texte
    var WindowsSize = function () {
      var w = $(window).width();
      $(".container span").each(function () {
        if (ok == false) {
          $(this).data("val", $(this).html());
        }
      });
      ok = true;
      if (w < 768) {
        $(".container span").each(function () {
          if ($(this).html().length > 15) {
            var newName = $(this).html().substring(0, 15) + "...";
            $(this).text(newName);
          }
        });
      } else if (w > 768) {
        $(".container span").each(function () {
          var newName = $(this).data("val");
          $(this).text(newName);
        });
      }
    };
  }

  //ajax pour faire une recherche dynamique en 3 temps (peut être pas le plus opti mais si vous avez une solution, je suis preneur :) )
  //premier temps, valeur par défaut
  var tab = [];
  var search = null;
  var retour = $.ajax({
    type: "GET",
    url: "/admin/lib/php/ajax/ajaxSelectRole.php",
    dataType: "json",
    success: function (data_role) {
      tab = data_role;
    },
  });
  $.ajax({
    type: "GET",
    dataType: "json",
    data: search,
    url: "/admin/lib/php/ajax/ajaxSelectMembersTag.php",
    success: function (data) {
      $("#tdata tr").children().remove();
      data.forEach(function (dt) {
        var member_role;
        if (data) {
          //comme la requête pour ne retourner qu'une seule ligne était fastidieuse (voir VueMembers.class + roleDB.class),
          //j'ai fais deux requêtes séparées qui compare la position de son rôle maximum avec la position du rôle en question
          //et tout ca je met dans member_role
          for (var j = 0; j < tab.length; j++) {
            if (tab[j].pos == dt.pos) {
              member_role = tab[j].name;
            }
          }
          $("#tdata").append(
            '<tr class="liste_membre" data-search = "' +
              dt.tag +
              '">' +
              '<td scope="row" class="avatar" >' +
              '<img class="avatar-icon" id="user_avatar" src="' +
              (dt.avatar ? dt.avatar : "./admin/images/icon.png") +
              '">' +
              '<span class="colname tag">' +
              dt.tag +
              "</span>" +
              "</td>" +
              '<td style="vertical-align:middle" id="account_join" class="colname td-center">' +
              member_role +
              "</td>" +
              '<td style="vertical-align:middle" id="account_join" class="colname td-center">' +
              dt.account_join +
              "</td>" +
              +"</tr>"
          );
        }
      });
    },
  });

  //Tri par colonne
  let tri_tag = 1;
  var tri_role = 1;
  var tri_date = 1;
  $("#arrowtag").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
  $("#arrowr").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
  $("#arrowd").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
  $("#tri span").click(function () {
    var parametre;
    var tab = [];
    var tri;
    var sort;
    tri = $(this).attr("id");

    if (tri == "tag") {
      tri_role = 1;
      tri_date = 1;
      $("#arrowtag").empty();
      $("#arrowr").empty();
      $("#arrowr").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
      $("#arrowd").empty();
      $("#arrowd").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
      if (tri_tag % 2 == 0) {
        $("#arrowtag").append(
          "<i style='font-size:24px' class='fas'>&#xf0de;</i>"
        );
        sort = "ASC";
        tri_tag = 1;
      } else {
        sort = "DESC";
        tri_tag = 2;
        $("#arrowtag").append(
          "<i style='font-size:24px' class='fas'>&#xf0dd;</i>"
        );
      }
    }
    if (tri == "pos") {
      tri_tag = 1;
      tri_date = 1;
      $("#arrowr").empty();
      $("#arrowtag").empty();
      $("#arrowtag").append(
        "<i style='font-size:24px' class='fas'>&#xf0dc;</i>"
      );
      $("#arrowd").empty();
      $("#arrowd").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
      if (tri_role % 2 == 0) {
        $("#arrowr").append(
          "<i style='font-size:24px' class='fas'>&#xf0de;</i>"
        );
        sort = "ASC";
        tri_role = 1;
      } else {
        sort = "DESC";
        tri_role = 2;
        $("#arrowr").append(
          "<i style='font-size:24px' class='fas'>&#xf0dd;</i>"
        );
      }
    }
    if (tri == "account_join") {
      tri_role = 1;
      tri_tag = 1;
      $("#arrowd").empty();
      $("#arrowtag").empty();
      $("#arrowtag").append(
        "<i style='font-size:24px' class='fas'>&#xf0dc;</i>"
      );
      $("#arrowr").empty();
      $("#arrowr").append("<i style='font-size:24px' class='fas'>&#xf0dc;</i>");
      if (tri_date % 2 == 0) {
        $("#arrowd").append(
          "<i style='font-size:24px' class='fas'>&#xf0de;</i>"
        );
        sort = "ASC";
        tri_date = 1;
      } else {
        sort = "DESC";
        tri_date = 2;
        $("#arrowd").append(
          "<i style='font-size:24px' class='fas'>&#xf0dd;</i>"
        );
      }
    }

    parametre = "tri=" + tri + "&sort=" + sort;
    var retour = $.ajax({
      type: "GET",
      url: "/admin/lib/php/ajax/ajaxSelectRole.php",
      dataType: "json",
      success: function (data_role) {
        tab = data_role;
      },
    });
    $.ajax({
      type: "GET",
      data: parametre,
      dataType: "json",
      url: "/admin/lib/php/ajax/ajaxSelectMembersTri.php",
      success: function (data) {
        $("#tdata tr").children().remove();
        data.forEach(function (dt) {
          var member_role;
          if (data) {
            for (var j = 0; j < tab.length; j++) {
              if (tab[j].pos == dt.pos) {
                member_role = tab[j].name;
              }
            }
            $("#tdata").append(
              '<tr class="liste_membre" data-search = "' +
                dt.tag +
                '">' +
                '<td scope="row" class="avatar" >' +
                '<img class="avatar-icon" id="user_avatar" src="' +
                (dt.avatar ? dt.avatar : "./admin/images/icon.png") +
                '">' +
                '<span class="colname tag">' +
                dt.tag +
                "</span>" +
                "</td>" +
                '<td style="vertical-align:middle" id="account_join" class="colname td-center">' +
                member_role +
                "</td>" +
                '<td style="vertical-align:middle" id="account_join" class="colname td-center">' +
                dt.account_join +
                "</td>" +
                +"</tr>"
            );
          }
        });
      },
    });
  });
  //lorsqu'on entre quelques choses au clavier
  var tab = [];
  $("#search").keyup(function () {
    var searchWords = $("#search").val();
    $("tr.liste_membre").each(function (index) {
      var search = $(this).data("search");
      search = search.toUpperCase();
      searchWords = searchWords.toUpperCase();
      var searchSansAccent = search.sansAccent();

      if (
        search.includes(searchWords) ||
        searchSansAccent.includes(searchWords)
      ) {
        $(this).addClass("find");
      }
      $(this).css("display", "none");
    });
    $("tr.liste_membre.find").each(function (index) {
      $(this).css("display", "table-row").removeClass("find");
    });
  });
  String.prototype.sansAccent = function () {
    var accent = [
      /[\300-\306]/g,
      /[\340-\346]/g, // A, a
      /[\310-\313]/g,
      /[\350-\353]/g, // E, e
      /[\314-\317]/g,
      /[\354-\357]/g, // I, i
      /[\322-\330]/g,
      /[\362-\370]/g, // O, o
      /[\331-\334]/g,
      /[\371-\374]/g, // U, u
      /[\321]/g,
      /[\361]/g, // N, n
      /[\307]/g,
      /[\347]/g, // C, c
    ];
    var noaccent = [
      "A",
      "a",
      "E",
      "e",
      "I",
      "i",
      "O",
      "o",
      "U",
      "u",
      "N",
      "n",
      "C",
      "c",
    ];

    var str = this;
    for (var i = 0; i < accent.length; i++) {
      str = str.replace(accent[i], noaccent[i]);
    }

    return str;
  };
  //Set

  const sr1 = ScrollReveal({
    delay: 375,
    duration: 2000,
    reset: true,
  });
  
  sr1.reveal(".accueil .p0", { delay: 300 });
  sr1.reveal(".accueil .p1", { delay: 600 });
  sr1.reveal(".accueil .p2", { delay: 900 });
  sr1.reveal(".accueil .p3", { delay: 1200 });
  sr1.reveal(".accueil .p4", { delay: 1500 });
  sr1.reveal(".tuto h1", { delay: 300 });
  sr1.reveal(".tuto .img1", { delay: 1000 });
  sr1.reveal(".tuto .img2", { delay: 1500 });
});
