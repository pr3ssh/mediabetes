$(document).ready(function() {


   var $calendar = $('#calendar');
   var id = 10;

   $calendar.weekCalendar({
      displayOddEven:true,
      timeslotsPerHour : 4,
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      firstDayOfWeek : 1,
      businessHours :{start: 0, end: 24, limitDisplay: true },
      daysToShow : 1,
      switchDisplay: {'1 day': 1, '3 next days': 3, 'work week': 5, 'full week': 7},
      title: function(daysToShow) {
			return daysToShow == 1 ? '%date%' : '%start% - %end%';
      },
      height : function($calendar) {
         return $(window).height() - $("h1").outerHeight() - 1;
      },
      eventRender : function(calEvent, $event) {
         if (calEvent.end.getTime() < new Date().getTime()) {
            $event.css("backgroundColor", "#aaa");
            $event.find(".wc-time").css({
               "backgroundColor" : "#999",
               "border" : "1px solid #888"
            });
         }
      },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {
         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']");
         var bodyField = $dialogContent.find("textarea[name='body']");


         $dialogContent.dialog({
            modal: true,
            title: "New Calendar Event",
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
                  //calEvent.id = id;
                  //id++;
                  calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.title = titleField.val();
                  calEvent.body = bodyField.val();

				ret = $.ajax({type: 'GET',
				url: '/tuuth/calendar_functions.php',
				data: 'op=add_event&start='+Math.round(calEvent.start.getTime()/1000)
						+'&end=' + Math.round(calEvent.end.getTime()/1000)
						+ '&title=' + calEvent.title + '&body=' + calEvent.body,
				cache: false,
				async: false
				}).responseText;
				
				

                  $calendar.weekCalendar("removeUnsavedEvents");
                  $dialogContent.dialog("close");
				  $calendar.weekCalendar("updateEvent", calEvent);
               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));

      },
      eventDrop : function(calEvent, $event) {
	   	 var startField = calEvent.start;
         var endField = calEvent.end;
		 ret = $.ajax({type: 'GET',
				 url: '/tuuth/calendar_functions.php',
				 data: 'op=update_event_resize&start='+Math.round(startField/1000)
						+'&end=' + Math.round(endField/1000) + '&evid=' + calEvent.id,
					cache: false,
					async: false
					}).responseText;

         $calendar.weekCalendar("updateEvent", calEvent); //refresca el calendario, es como hacer f5
        
      },
      eventResize : function(calEvent, $event) {
         var startField = calEvent.start;
         var endField = calEvent.end;
		 ret = $.ajax({type: 'GET',
				 url: '/tuuth/calendar_functions.php',
				 data: 'op=update_event_resize&start='+Math.round(startField/1000)
						+'&end=' + Math.round(endField/1000) + '&evid=' + calEvent.id,
					cache: false,
					async: false
					}).responseText;

         $calendar.weekCalendar("updateEvent", calEvent); //refresca el calendario, es como hacer f5
      },
      eventClick : function(calEvent, $event) {

         if (calEvent.readOnly) {
            return;
         }

         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var titleField = $dialogContent.find("input[name='title']").val(calEvent.title);
         var bodyField = $dialogContent.find("textarea[name='body']");
         bodyField.val(calEvent.body);

         $dialogContent.dialog({
            modal: true,
            title: "Edit - " + calEvent.title,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
				 var tempEvent = {start: new Date(startField.val()), end: new Date(endField.val()), title: titleField.val(), body: bodyField.val()};
				 console.log(tempEvent);
				 ret = $.ajax({type: 'GET',
				 url: '/tuuth/calendar_functions.php',
				 data: 'op=update_event&start='+Math.round(tempEvent.start.getTime()/1000)
						+'&end=' + Math.round(tempEvent.end.getTime()/1000) + '&evid=' + calEvent.id
						+ '&title=' + tempEvent.title + '&body=' + tempEvent.body,
					cache: false,
					async: false
					}).responseText;
					

                  calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.title = titleField.val();
                  calEvent.body = bodyField.val();

                  $calendar.weekCalendar("updateEvent", calEvent); //refresca el calendario, es como hacer f5
                  $dialogContent.dialog("close");
               },
               "delete" : function() {
				  ret = $.ajax({type: 'GET',
				  	url: '/tuuth/calendar_functions.php',
				  	data: 'op=delete_event&evid='+ calEvent.id,
					cache: false,
					async: false
				  }).responseText;
				
				  if (ret != 1) {
						$dialogContent.dialog("close");
						console.log('Ha habido un error y no se ha podido borrar el evento ' + ret,'No se ha podido borrar el evento',true,true);
						return;
					}
                  $calendar.weekCalendar("removeEvent", calEvent.id);
                  $dialogContent.dialog("close");
               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         $(window).resize().resize(); //fixes a bug in modal overlay size ??

      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {

      },
      data : '/tuuth/calendar_functions.php?op=get_events'/*function(start, end, callback) {
         callback(getEventData());
      }*/
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }

   function getEventData() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var day = new Date().getDate();

      return {
         events : [
            {
               "id":1,
               "start": "Sun, 12 Feb 2012 19:00:00 +0100",
               "end": "Sun, 12 Feb 2012 21:00:00 +0100",
               "title":"Lunch with Mike",
				"body":"testeando la ciudad"
            },
            {
               "id":2,
               "start": "2012-02-12 19:00:00",
               "end": "2012-02-12 00:00:00",
               "title":"Dev Meeting"
            },
            {
               "id":3,
               "start": new Date(year, month, day + 1, 17),
               "end": new Date(year, month, day + 1, 17, 45),
               "title":"Hair cut"
            },
            {
               "id":4,
               "start": new Date(year, month, day - 1, 8),
               "end": new Date(year, month, day - 1, 9, 30),
               "title":"Team breakfast"
            },
            {
               "id":5,
               "start": new Date(year, month, day + 1, 14),
               "end": new Date(year, month, day + 1, 15),
               "title":"Product showcase"
            },
            {
               "id":6,
               "start": new Date(year, month, day, 10),
               "end": new Date(year, month, day, 11),
               "title":"I'm read-only",
               readOnly : true
            },
            {
               "id":7,
               "start": new Date(year, month, day + 2, 17),
               "end": new Date(year, month, day + 3, 9),
               "title":"Multiday"
            }
         ]
      };
   }


   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      $startTimeField.empty();
      $endTimeField.empty();

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

         $timestampsOfOptions.start[timeslotTimes[i].startFormatted] = startTime.getTime();
         $timestampsOfOptions.end[timeslotTimes[i].endFormatted] = endTime.getTime();

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");
   var $timestampsOfOptions = {start:[],end:[]};

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function() {
      var startTime = $timestampsOfOptions.start[$(this).find(":selected").text()];
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $timestampsOfOptions.end[$(this).text()];
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });


   var $about = $("#about");

   $("#about_button").click(function() {
      $about.dialog({
         title: "About this calendar demo",
         width: 600,
         close: function() {
            $about.dialog("destroy");
            $about.hide();
         },
         buttons: {
            close : function() {
               $about.dialog("close");
            }
         }
      }).show();
   });


});
