<<<<<<< HEAD
$(document).ready(function(){
    if(showTextInline==1) {
        /* Enable all the browse divs, and fill with data */
        $('.statisticsbrowsebutton').each( function (){
            if (!$(this).hasClass('numericalbrowse')) {
                loadBrowse(this.id,'');
            }
        });
    }
     $('.statisticsbrowsebutton').click( function(){
         if($(this).hasClass('numericalbrowse')) {
             var destinationdiv=$('#columnlist_'+this.id);
             var extra='';
             if(destinationdiv.parents("td:first").css("display") == "none") {
                 extra='sortby/'+this.id+'/sortmethod/asc/sorttype/N/'
             }
             loadBrowse(this.id, extra);
         } else {
            loadBrowse(this.id,'');
         }

     });
     $(".sortorder").live("click", function(e) {
         var details=this.id.split('_');
         var order='sortby/'+details[2]+'/sortmethod/'+details[3]+'/sorttype/'+details[4];
         loadBrowse(details[1],order);
     });

     function loadBrowse(id,extra) {
         var destinationdiv=$('#columnlist_'+id);
         if(extra=='') {
             destinationdiv.parents("td:first").toggle();
         } else {
             destinationdiv.parents("td:first").show();
         }
         if(destinationdiv.parents("td:first").css("display") != "none") {
             $.post(listColumnUrl+'/'+id+'/sql/'+sql+'/'+extra, function(data) {
                 destinationdiv.html(data);
             });
         }
     }
     $('#usegraph').click( function(){
        if ($('#grapherror').length>0)
        {
            $('#grapherror').show();
            $('#usegraph').attr('checked',false);
        }
     });
     $('#viewsummaryall').click( function(){
        if ($('#viewsummaryall').attr('checked')==true)
        {
            $('#filterchoices input[type=checkbox]').attr('checked', true);
        }
        else
        {
            $('#filterchoices input[type=checkbox]').attr('checked', false);

        }
     });

    /* Show and hide the three major sections of the statistics page */
    /* The response filters */
    $('#hidefilter').click( function(){
        $('#statisticsresponsefilters').hide(1000);
        $('#filterchoices').hide();
        $('#filterchoice_state').val('1');
        $('#vertical_slide2').hide();
    });
    $('#showfilter').click( function(){
        $('#statisticsresponsefilters').show(1000);
        $('#filterchoices').show();
        $('#filterchoice_state').val('');
        $('#vertical_slide2').show();
    });
    /* The general settings/filters */
    $('#hidegfilter').click( function(){
        $('#statisticsgeneralfilters').hide(1000);
    });
    $('#showgfilter').click( function(){
        $('#statisticsgeneralfilters').show(1000);
    });
    /* The actual statistics results */
    $('#hidesfilter').click( function(){
        $('#statisticsoutput').hide(1000);
    });
    $('#showsfilter').click( function(){
        $('#statisticsoutput').show(1000);
    });
    function showhidefilters(value) {
     if(value == true) {
       hide('filterchoices');
     } else {
       show('filterchoices');
     }
    }
     /* End of show/hide sections */

     if (typeof aGMapData == "object") {
         for (var i in aGMapData) {
     		gMapInit("statisticsmap_" + i, aGMapData[i]);
	     }
	 }

	 if (typeof aStatData == "object") {
	    for (var i in aStatData) {
	        statInit(aStatData[i]);
        }
	 }

	 $(".stats-hidegraph").click (function ()
	 {

        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id).html(getWaiter());
        graphQuery(id, 'hidegraph', function (res) {
            if (!res) {
                ajaxError();
                return;
            }

            data = JSON.parse(res);

            if (!data || !data.ok) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sg = false;
            statInit(aStatData[id]);
        });
	 });

	 $(".stats-showgraph").click(function ()
	 {
        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id).html(getWaiter()).show();
	    graphQuery(id, 'showgraph', function (res) {
            if (!res) {
                ajaxError();
                return;
            }
            data = JSON.parse(res);

            if (!data || !data.ok || !data.chartdata) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sg = true;
            statInit(aStatData[id]);

            $("#statzone_" + id).append("<img border='1' src='" + temppath +"/"+data.chartdata + "' />");

            if (aStatData[id].sm) {
                if (!data.mapdata) {
                    ajaxError();
                    return;
                }

                $("#statzone_" + id).append("<div id=\"statisticsmap_" + id + "\" class=\"statisticsmap\"></div>");
                gMapInit('statisticsmap_' + id, data.mapdata);
            }

            $("#statzone_" + id + " .wait").remove();

	    });
     });

	 $(".stats-hidemap").click (function ()
	 {
        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id + ">div").replaceWith(getWaiter());

	    graphQuery(id, 'hidemap', function (res) {
            if (!res) {
                ajaxError();
                return;
            }

            data = JSON.parse(res);

            if (!data || !data.ok) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sm = false;
            statInit(aStatData[id]);

            $("#statzone_" + id + " .wait").remove();
	    });
	 });

	 $(".stats-showmap").click(function ()
	 {
        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id).append(getWaiter());

	    graphQuery(id, 'showmap', function (res) {
            if (!res) {
                ajaxError();
                return;
            }

            data = JSON.parse(res);

            if (!data || !data.ok || !data.mapdata) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sm = true;
            statInit(aStatData[id]);

            $("#statzone_" + id + " .wait").remove();
            $("#statzone_" + id).append("<div id=\"statisticsmap_" + id + "\" class=\"statisticsmap\"></div>");

            gMapInit('statisticsmap_' + id, data.mapdata);
	    });
	 });

	 $(".stats-showbar").click(function ()
	 {
	    changeGraphType('showbar', this.parentNode);
	 });

	 $(".stats-showpie").click(function ()
     {
	    changeGraphType('showpie', this.parentNode);
	 });
});

var isWaiting = {};

function getWaiter()
{
    return "<img style='margin:auto;display:block;'class='wait' src='"+imgpath+"/ajax-loader.gif'/>";
}

function graphQuery (id, cmd, success) {
    $.ajax({
        type: "POST",
        url: graphUrl,
        data: {
            'id': id,
            'cmd': cmd,
        },
        success: success,
        error: function (res)
        {
                ajaxError();
        }
    });
}

function ajaxError()
{
    alert ("An error occured! Please reload the page!");
}

function selectCheckboxes(Div, CheckBoxName, Button)
{
	var aDiv = document.getElementById(Div);
	var nInput = aDiv.getElementsByTagName("input");
	var Value = document.getElementById(Button).checked;
	//alert(Value);

	for(var i = 0; i < nInput.length; i++)
	{
		if(nInput[i].getAttribute("name")==CheckBoxName)
		nInput[i].checked = Value;
	}
}

function nographs()
{
	document.getElementById('usegraph').checked = false;
}

function gMapInit(id, data)
{
    if (!data || !data["coord"] || !data["zoom"] ||
        !data.width || !data.height || typeof google == "undefined")
    {
        return;
    }

    $("#" + id).width(data.width);
    $("#" + id).height(data.height);

    var latlng;
    if (data["coord"].length > 0) {
        var c = data["coord"][0].split(" ");
        latlng = new google.maps.LatLng(parseFloat(c[0]), parseFloat(c[1]));
    } else {
        latlng = new google.maps.LatLng(0.1, 0.1);
    }

    var myOptions = {
        zoom: parseFloat(data["zoom"]),
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(id), myOptions);

    for (var i = 0; i < data["coord"].length; ++i) {
        var c = data["coord"][i].split(" ");

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(c[0]), parseFloat(c[1])),
            map: map
        });
    }
}

function statGetId(elem)
{
    var id = $(elem).attr("id");

    if (id.substr(0, 6) == "stats_") {
        return id.substr(6, id.length);
    }

    if (id == '' || isWaiting[id]) {
        return false;
    }

    isWaiting[id] = true;
    return id;
}

function statInit(data)
{
    var elem = $("#stats_" + data.id);

    elem.children().hide();

    if (data.sg) {
        $("#statzone_" + data.id).show();
        $(".stats-hidegraph", elem).show();

        if (data.ap) {
            $(".stats-" + (data.sp ? "showbar" : "showpie"), elem).show();
        }

        if (data.am) {
            $(".stats-" + (data.sm ? "hidemap" : "showmap"), elem).show();
        }
    } else {
        $("#statzone_" + data.id).hide();
        $(".stats-showgraph", elem).show();
    }
}

function changeGraphType (cmd, id) {
    id = statGetId(id);
    if (!id) {
        return;
    }

    if (!aStatData[id]) {
        alert('Error');
    }

    if (!aStatData[id].ap) {
        return;
    }

    $("#statzone_" + id).append(getWaiter());

    graphQuery(id, cmd, function (res) {
        if (!res) {
            ajaxError();
            return;
        }

        data = JSON.parse(res);

        if (!data || !data.ok || !data.chartdata) {
            ajaxError();
            return;
        }

        isWaiting[id] = false;
        aStatData[id].sp = (cmd == 'showpie');
        statInit(aStatData[id]);

        $("#statzone_" + id + " .wait").remove();
        $("#statzone_" + id + ">img:first").attr("src", temppath +"/"+data.chartdata);
    });

}
=======
$(document).ready(function(){
    if(showTextInline==1) {
        /* Enable all the browse divs, and fill with data */
        $('.statisticsbrowsebutton').each( function (){
            if (!$(this).hasClass('numericalbrowse')) {
                loadBrowse(this.id,'');
            }
        });
    }
     $('.statisticsbrowsebutton').click( function(){
         if($(this).hasClass('numericalbrowse')) {
             var destinationdiv=$('#columnlist_'+this.id);
             var extra='';
             if(destinationdiv.parents("td:first").css("display") == "none") {
                 extra='sortby/'+this.id+'/sortmethod/asc/sorttype/N/'
             }
             loadBrowse(this.id, extra);
         } else {
            loadBrowse(this.id,'');
         }

     });
     $(".sortorder").live("click", function(e) {
         var details=this.id.split('_');
         var order='sortby/'+details[2]+'/sortmethod/'+details[3]+'/sorttype/'+details[4];
         loadBrowse(details[1],order);
     });

     function loadBrowse(id,extra) {
         var destinationdiv=$('#columnlist_'+id);
         if(extra=='') {
             destinationdiv.parents("td:first").toggle();
         } else {
             destinationdiv.parents("td:first").show();
         }
         if(destinationdiv.parents("td:first").css("display") != "none") {
             $.post(listColumnUrl+'/'+id+'/sql/'+sql+'/'+extra, function(data) {
                 destinationdiv.html(data);
             });
         }
     }
     $('#usegraph').click( function(){
        if ($('#grapherror').length>0)
        {
            $('#grapherror').show();
            $('#usegraph').attr('checked',false);
        }
     });
     $('#viewsummaryall').click( function(){
        if ($('#viewsummaryall').attr('checked')==true)
        {
            $('#filterchoices input[type=checkbox]').attr('checked', true);
        }
        else
        {
            $('#filterchoices input[type=checkbox]').attr('checked', false);

        }
     });

    /* Show and hide the three major sections of the statistics page */
    /* The response filters */
    $('#hidefilter').click( function(){
        $('#statisticsresponsefilters').hide(1000);
        $('#filterchoices').hide();
        $('#filterchoice_state').val('1');
        $('#vertical_slide2').hide();
    });
    $('#showfilter').click( function(){
        $('#statisticsresponsefilters').show(1000);
        $('#filterchoices').show();
        $('#filterchoice_state').val('');
        $('#vertical_slide2').show();
    });
    /* The general settings/filters */
    $('#hidegfilter').click( function(){
        $('#statisticsgeneralfilters').hide(1000);
    });
    $('#showgfilter').click( function(){
        $('#statisticsgeneralfilters').show(1000);
    });
    /* The actual statistics results */
    $('#hidesfilter').click( function(){
        $('#statisticsoutput').hide(1000);
    });
    $('#showsfilter').click( function(){
        $('#statisticsoutput').show(1000);
    });
    function showhidefilters(value) {
     if(value == true) {
       hide('filterchoices');
     } else {
       show('filterchoices');
     }
    }
     /* End of show/hide sections */

     if (typeof aGMapData == "object") {
         for (var i in aGMapData) {
     		gMapInit("statisticsmap_" + i, aGMapData[i]);
	     }
	 }

	 if (typeof aStatData == "object") {
	    for (var i in aStatData) {
	        statInit(aStatData[i]);
        }
	 }

	 $(".stats-hidegraph").click (function ()
	 {

        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id).html(getWaiter());
        graphQuery(id, 'hidegraph', function (res) {
            if (!res) {
                ajaxError();
                return;
            }

            data = JSON.parse(res);

            if (!data || !data.ok) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sg = false;
            statInit(aStatData[id]);
        });
	 });

	 $(".stats-showgraph").click(function ()
	 {
        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id).html(getWaiter()).show();
	    graphQuery(id, 'showgraph', function (res) {
            if (!res) {
                ajaxError();
                return;
            }
            data = JSON.parse(res);

            if (!data || !data.ok || !data.chartdata) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sg = true;
            statInit(aStatData[id]);

            $("#statzone_" + id).append("<img border='1' src='" + temppath +"/"+data.chartdata + "' />");

            if (aStatData[id].sm) {
                if (!data.mapdata) {
                    ajaxError();
                    return;
                }

                $("#statzone_" + id).append("<div id=\"statisticsmap_" + id + "\" class=\"statisticsmap\"></div>");
                gMapInit('statisticsmap_' + id, data.mapdata);
            }

            $("#statzone_" + id + " .wait").remove();

	    });
     });

	 $(".stats-hidemap").click (function ()
	 {
        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id + ">div").replaceWith(getWaiter());

	    graphQuery(id, 'hidemap', function (res) {
            if (!res) {
                ajaxError();
                return;
            }

            data = JSON.parse(res);

            if (!data || !data.ok) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sm = false;
            statInit(aStatData[id]);

            $("#statzone_" + id + " .wait").remove();
	    });
	 });

	 $(".stats-showmap").click(function ()
	 {
        var id = statGetId(this.parentNode);
        if (!id) {
            return;
        }

	    $("#statzone_" + id).append(getWaiter());

	    graphQuery(id, 'showmap', function (res) {
            if (!res) {
                ajaxError();
                return;
            }

            data = JSON.parse(res);

            if (!data || !data.ok || !data.mapdata) {
                ajaxError();
                return;
            }

            isWaiting[id] = false;
            aStatData[id].sm = true;
            statInit(aStatData[id]);

            $("#statzone_" + id + " .wait").remove();
            $("#statzone_" + id).append("<div id=\"statisticsmap_" + id + "\" class=\"statisticsmap\"></div>");

            gMapInit('statisticsmap_' + id, data.mapdata);
	    });
	 });

	 $(".stats-showbar").click(function ()
	 {
	    changeGraphType('showbar', this.parentNode);
	 });

	 $(".stats-showpie").click(function ()
     {
	    changeGraphType('showpie', this.parentNode);
	 });
});

var isWaiting = {};

function getWaiter()
{
    return "<img style='margin:auto;display:block;'class='wait' src='"+imgpath+"/ajax-loader.gif'/>";
}

function graphQuery (id, cmd, success) {
    $.ajax({
        type: "POST",
        url: graphUrl,
        data: {
            'id': id,
            'cmd': cmd,
        },
        success: success,
        error: function (res)
        {
                ajaxError();
        }
    });
}

function ajaxError()
{
    alert ("An error occured! Please reload the page!");
}

function selectCheckboxes(Div, CheckBoxName, Button)
{
	var aDiv = document.getElementById(Div);
	var nInput = aDiv.getElementsByTagName("input");
	var Value = document.getElementById(Button).checked;
	//alert(Value);

	for(var i = 0; i < nInput.length; i++)
	{
		if(nInput[i].getAttribute("name")==CheckBoxName)
		nInput[i].checked = Value;
	}
}

function nographs()
{
	document.getElementById('usegraph').checked = false;
}

function gMapInit(id, data)
{
    if (!data || !data["coord"] || !data["zoom"] ||
        !data.width || !data.height || typeof google == "undefined")
    {
        return;
    }

    $("#" + id).width(data.width);
    $("#" + id).height(data.height);

    var latlng;
    if (data["coord"].length > 0) {
        var c = data["coord"][0].split(" ");
        latlng = new google.maps.LatLng(parseFloat(c[0]), parseFloat(c[1]));
    } else {
        latlng = new google.maps.LatLng(0.1, 0.1);
    }

    var myOptions = {
        zoom: parseFloat(data["zoom"]),
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(id), myOptions);

    for (var i = 0; i < data["coord"].length; ++i) {
        var c = data["coord"][i].split(" ");

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(c[0]), parseFloat(c[1])),
            map: map
        });
    }
}

function statGetId(elem)
{
    var id = $(elem).attr("id");

    if (id.substr(0, 6) == "stats_") {
        return id.substr(6, id.length);
    }

    if (id == '' || isWaiting[id]) {
        return false;
    }

    isWaiting[id] = true;
    return id;
}

function statInit(data)
{
    var elem = $("#stats_" + data.id);

    elem.children().hide();

    if (data.sg) {
        $("#statzone_" + data.id).show();
        $(".stats-hidegraph", elem).show();

        if (data.ap) {
            $(".stats-" + (data.sp ? "showbar" : "showpie"), elem).show();
        }

        if (data.am) {
            $(".stats-" + (data.sm ? "hidemap" : "showmap"), elem).show();
        }
    } else {
        $("#statzone_" + data.id).hide();
        $(".stats-showgraph", elem).show();
    }
}

function changeGraphType (cmd, id) {
    id = statGetId(id);
    if (!id) {
        return;
    }

    if (!aStatData[id]) {
        alert('Error');
    }

    if (!aStatData[id].ap) {
        return;
    }

    $("#statzone_" + id).append(getWaiter());

    graphQuery(id, cmd, function (res) {
        if (!res) {
            ajaxError();
            return;
        }

        data = JSON.parse(res);

        if (!data || !data.ok || !data.chartdata) {
            ajaxError();
            return;
        }

        isWaiting[id] = false;
        aStatData[id].sp = (cmd == 'showpie');
        statInit(aStatData[id]);

        $("#statzone_" + id + " .wait").remove();
        $("#statzone_" + id + ">img:first").attr("src", temppath +"/"+data.chartdata);
    });

}
>>>>>>> refs/remotes/origin/master
