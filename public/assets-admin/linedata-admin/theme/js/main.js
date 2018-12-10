/* Some fake data, just for the test */
var holidays = [
    "01-01-2018",
    "03-20-2018",
    "04-09-2018",
    "05-01-2018",
    "06-15-2018",
    "07-25-2018",
    "08-13-2018",
    "08-21-2018",
    "08-22-2018",
    "09-11-2018",
    "10-15-2018",
    "11-20-2018"
  ],
  daysOff = [
    "04-02-2018",
    "04-30-2018",
    "05-08-2018",
    "05-10-2018",
    "05-21-2018",
    "06-25-2018",
    "06-26-2018",
    "06-27-2018",
    "06-28-2018",
    "06-29-2018",
    "07-23-2018",
    "07-24-2018",
    "07-26-2018",
    "07-27-2018",
    "08-14-2018",
    "08-15-2018",
    "08-16-2018",
    "08-17-2018"
  ];

$(function() {
  var pageLoaded = false;
  $(window).on("load", function() {
    loadPage();
  });
  setTimeout(function() {
    if (!pageLoaded) loadPage();
  }, 2000);

  var loadPage = function() {
    pageLoaded = true;
    $("body").addClass("loaded");
    if ($(window).width() > 1200) $("#wrapper").addClass("menu-opened");

    intiNiceScroll();
  };

  function intiNiceScroll() {
    $("body").niceScroll({
      cursorcolor: "#bfc6d0",
      cursoropacitymin: 0.2,
      cursoropacitymax: 0.6,
      bouncescroll: true,
      cursorborder: 0,
      scrollspeed: 160,
      zindex: 1000,
      horizrailenabled: false
    });
    $("#main-menu").niceScroll({
      cursorcolor: "transparent",
      cursoropacitymin: 0,
      cursoropacitymax: 0,
      bouncescroll: true,
      cursorborder: 0,
      scrollspeed: 160,
      zindex: 1000,
      horizrailenabled: false
    });
  }
  $(window).resize(function() {
    $("body, main-menu")
      .getNiceScroll()
      .resize();
    if ($(window).width() > 1200) $("#wrapper").addClass("menu-opened");
    else $("#wrapper").removeClass("menu-opened");
  });

  $("#menu-toggle").on("click", function() {
    $("#wrapper").toggleClass("menu-opened");
    setTimeout(function() {
      $("body, main-menu")
        .getNiceScroll()
        .resize();
    }, 500);
  });

  $(".header-toggle").on("click", function() {
    $("#wrapper").toggleClass("header-visible");
  });

  /* Calendar */

  var $yearlyCalendar = $("#yearly-calendar");
  if ($yearlyCalendar.length > 0) {
    var calYear = $yearlyCalendar.data("year");

    for (var i = 1; i <= 12; i++) {
      // console.log(i + ' : ' + monthDays(i, calYear));
      for (var j = 1; j <= monthDays(i, calYear); j++) {
        var classes = "day",
          dayDate = new Date(calYear, i - 1, j),
          dayIndex = dayDate.getDay();
        var _date = {
          day: j < 10 ? "0" + j : j,
          month: i < 10 ? "0" + i : i,
          year: calYear
        };
        var date_str = _date.month + "-" + _date.day + "-" + _date.year;

        if (dayIndex === 6 || dayIndex === 0) classes += " weekend";

        if ($.inArray(date_str, daysOff) !== -1) {
          classes += " dayoff";
        }
        if ($.inArray(date_str, holidays) !== -1) {
          classes += " holiday";
        }

        $(".month-col[data-month=" + i + "]").append(
          '<a href="#" data-toggle="modal" data-target="#edittimeModalLong" class="' + classes + '"></a>'
        );
      }
    }
  }

  function monthDays(month, year) {
    return new Date(year, month, 0).getDate();
  }

  /* Range Double values  */
  $(".doubleslider").slider({ tooltip: "always", tooltip_split: true });

  /* Sortable */
  var dropAction = $(".droppable").closest('.list').data('action');
  $(".draggable").draggable({
    handle: '.dragHandler',
    revert: "invalid",
    stop: function() {
      $(this).draggable("option", "revert", "invalid");
    }
  });
  $(".droppable").droppable({
    accept: "li.item",
    hoverClass: "hovered",

    drop: function(event, ui) {
      dropAction = ui.draggable.attr('data-action');
      var _this = $(this);
      var family_id = $(this).data('id');
      console.log(family_id);
      if($(event.target).find(ui.draggable).length > 0){
        ui.draggable.draggable("option", "revert", true);
      }
      else{

        if(dropAction != undefined & dropAction != ''){
          $.ajax({
            url: dropAction,
            data: {familyID: family_id},
            method: 'GET',
          }).done(function(){
            cloned = ui.helper.clone().css({ position: "", top: "", left: "" }).removeClass('ui-draggable-dragging');
            setDraggable(cloned, false);
            
            _this
            .addClass("opened")
            .find(".disciplines")
            .append(cloned);
            ui.helper.hide();
          });
        }
        else{
          console.log(dropAction);
          cloned = ui.helper.clone().css({ position: "", top: "", left: "" }).removeClass('ui-draggable-dragging');
          setDraggable(cloned, false);
          
          $(this)
          .addClass("opened")
          .find(".disciplines")
          .append(cloned);
          ui.helper.hide();
          }
        }
      }
  });

  function setDraggable(el, doClone) {
    el.draggable({
      helper: doClone ? "clone" : "original",
      revert: true
    });
  }

  $(".sortable, .draggable").disableSelection();

  /* disciplines */
  $(".tree").on("click", ".toggle-disciplies", function(e) {
    e.preventDefault();
    if (
      $(this)
        .closest(".item")
        .find(".disciplines").length > 0
    ) {
      $(this)
        .closest(".item")
        .toggleClass("opened");
    }
    $("body, main-menu")
      .getNiceScroll()
      .resize();
  });

  /* Autocomplete */
  var selected_skills = [];
  var dataSource = $("#skills").data('source');
  $("#skills").autocomplete({
    // source: "ws/search.php?skills",
    source: function (request, response) {
      $.getJSON(
        dataSource,
        {
          term: request.term,
          s_values: selected_skills
        },
        response
      );
    },
    minLength: 2,
    select: function (event, ui) {
      console.log(selected_skills);
      selected_skills.push(ui.item.value);
      var itemId = $("#selected-skills").children().length;
      $("#selected-skills").append('<div class="item" data-id="' + itemId + '"><div class="item-inner"><div class="row"><a href="#" class="col-6 title toggle-disciplies">' + ui.item.value + '</a><div class="col-4 row"><div class="checkbox-group horizontal-group group-sm"><input type="radio" name="level-'+ itemId +'" id="l-'+ itemId +'-1"><label for="l-'+ itemId +'-1">1</label><input type="radio" name="level-'+ itemId +'" id="l-'+ itemId +'-2"><label for="l-'+ itemId +'-2">2</label><input type="radio" name="level-'+ itemId +'" id="l-'+ itemId +'-3"><label for="l-'+ itemId +'-3">3</label><input type="radio" name="level-'+ itemId +'" id="l-'+ itemId +'-4"><label for="l-'+ itemId +'-4">4</label><input type="radio" name="level-'+ itemId +'" id="l-'+ itemId +'-5"><label for="l-'+ itemId +'-5">5</label></div></div><div class="col-2"><select class="form-control auto-height"><option>Key</option><option>Major</option><option>Minor</option></select></div</div></div></div>');
      $("#skills").val('');
      $("body, main-menu")
        .getNiceScroll()
        .resize();
      event.preventDefault();
    }
  });
  /* Wysiwyg */
  $('.editor').summernote();
});
