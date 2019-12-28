<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } session_start();
$ruta = "../../../php/"; include("../../../php/iniciar.php"); include('../../../php/admin.php'); $ad = new admin(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../estilo/editor.css" rel="stylesheet" type="text/css">
    <title>imagen</title>
    <script src="../../../js/jquery.1.9.1.js" type="text/javascript"></script>
    
    <script src="libreria/js/reflection.js" type="text/javascript"></script>
    <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="../../../js/bootstrap.min.js"></script>
    <style type="text/css">
        #inpImgURL, #inpTitle, #inpURL, #inpKeywords {
	        border:1px inset #ddd;
	        font-size:12px;
	        -moz-border-radius:3px;
	        -webkit-border-radius:3px;
	        padding-left:7px;
            }
        select {font-size:10pt;padding:3px;
            border: 1px solid #adadad;
            background:#ffffff;
            }
        .item {width:115px;min-height:100px;display:-moz-inline-stack;display:inline-block;vertical-align:top;zoom:1; *display: inline; _height: 100px;
        margin:0px 10px 5px -5px;cursor:pointer;padding:10px 5px;text-align:center;vertical-align:middle;
        }
        .itemFilter {width:50px;min-height:50px;display:-moz-inline-stack;display:inline-block;vertical-align:top;zoom:1; *display: inline; _height: 50px;
        margin:5px 0px 5px 10px;cursor:pointer;padding:10px 5px;text-align:center;vertical-align:middle;white-space:nowrap;
        }
    </style>
    <script src="libreria/js/comun.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">


function getTxt(s) {
    switch (s) {
        case "DEFAULT SIZE": return "DEFAULT SIZE";
        case "Heading 1": return "Heading 1";
        case "Heading 2": return "Heading 2";
        case "Heading 3": return "Heading 3";
        case "Heading 4": return "Heading 4";
        case "Heading 5": return "Heading 5";
        case "Heading 6": return "Heading 6";
        case "Preformatted": return "Preformatted";
        case "Normal": return "Normal";
    }
}

        function getQueryString() {
            var result = {}, queryString = location.search.substring(1), re = /([^&=]+)=([^&]*)/g, m;

            while (m = re.exec(queryString)) {
                result[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            return result;
        }

        jQuery(document).ready(function ($) {
            renderEffect("libreria/imagen/sample.png");

            I_RealtimeImage();
            parent.oUtil.onSelectionChanged = new Function("I_RealtimeImage()");

            /*  ASSET MANAGER HERE */
            if (parent.oUtil.obj.fileBrowser != "") {
                $("#tab1").css("display", "block");
                $("#frameFiles").attr("src", parent.oUtil.obj.fileBrowser + "?img=yes");
            }
            else {
                $("#spanSaveAsNew").css("display", "none");
            }

            if (parent.oUtil.obj.enableLightbox == false) {
                $("#divFlickrLarger").css("visibility", "hidden");
            }
            tabClick(2);
            $("#div0").css("display", "block");
        });

        function fileclick(src) {
            document.getElementById("inpImgURL").value = src;

            document.getElementById("divFlickrSize").style.display = "none";
            document.getElementById("divFlickrLarger").style.display = "none";
            document.getElementById("divImageSize").style.display = "block";

            renderEffect(src, 100);

            loadImageIntoCanvas(src);

            var clickedImg = new Image();

            clickedImg.onload = function() {
				document.getElementById("inpWidth").value = this.width;
				document.getElementById("inpHeight").value = this.height;
				document.getElementById("hidWidth").value = this.width;
				document.getElementById("hidHeight").value = this.height;

            }
            clickedImg.src = src;

        }

        function setSelectedIndex(s, v) {
            for (var i = 0; i < s.options.length; i++) {
                if (s.options[i].value == v) {
                    s.options[i].selected = true;
                    return;
                }
            }
        }

        function I_RealtimeImage() {
            if (parent.oUtil + '' == 'undefined') return;

            var oEditor = parent.oUtil.oEditor;

            var obj = parent.oUtil.obj;
            //obj.setFocus();

            var src;

            /* Source */
            document.getElementById('inpImgURL').value = "";

            /* Alt/Title */
            document.getElementById('inpTitle').value = "";

            /* Align */
            document.getElementsByName('optAlign')[0].selected = true;

            /* Flickr */
            document.getElementById("divFlickrSize").style.display = "none";
            document.getElementById("divFlickrLarger").style.display = "none";
            document.getElementById("divImageSize").style.display = "block";

            /* Dimension */
            document.getElementById("inpWidth").value = "";
            document.getElementById("inpHeight").value = "";

            /* OPEN LARGER IMAGE IN A LIGHTBOX */
            document.getElementById('chkOpenLarger').checked = false;

            /* HREF */
            document.getElementById('inpURL').value = "http://";

            /* OPEN IN A NEW WINDOW */
            document.getElementById('chkNewWindow').checked = false;

            /* Button */
            //document.getElementById('btnInsert').value = getTxt("insert");

            var oSel;
            var oEl;
            if (navigator.appName.indexOf('Microsoft') != -1) {
                oSel = oEditor.document.selection.createRange();
                if (oSel.parentElement) oEl = GetElement(oSel.parentElement(), "IMG");
                else oEl = GetElement(oSel.item(0), "IMG");
            }
            else {
                if (!oEditor.getSelection()) return;
                oSel = oEditor.getSelection();
                oEl = GetElement(parent.getSelectedElement(oSel), "IMG");
            }

            if (oEl) {
                if (oEl.nodeName == "IMG") {

                    if (navigator.appName.indexOf('Microsoft') != -1) {
                        try {
                            var range = oEditor.document.body.createTextRange();
                            range.moveToElementText(oEl);
                            range.select();
                        } catch (e) { return; }
                    }
                    else {
                        /*var range = oEditor.document.createRange();
                        range.selectNode(oEl);
                        oSel.removeAllRanges();
                        oSel.addRange(range);*/
                        var range = oEditor.document.createRange();
                        range.selectNodeContents(oEl);
                        oSel.addRange(range);
                    }

                    /* Source */
                    src = oEl.getAttribute("SRC");
                    document.getElementById('inpImgURL').value = src;
                    loadImageIntoCanvas(src);

                    /* Title */
                    if (oEl.getAttribute("ALT") != null) document.getElementById('inpTitle').value = oEl.getAttribute("ALT");

                    /* Align */
                    if (oEl.style.cssFloat == "") document.getElementsByName('optAlign')[0].selected = true;
                    if (oEl.style.cssFloat == "left" || oEl.style.float == "left") document.getElementsByName('optAlign')[1].selected = true;
                    if (oEl.style.cssFloat == "right" || oEl.style.float == "right") document.getElementsByName('optAlign')[2].selected = true;

                    /* Margin */
                    setSelectedIndex(document.getElementById("selMarginTop"), parseInt(oEl.style.marginTop));
                    setSelectedIndex(document.getElementById("selMarginRight"), parseInt(oEl.style.marginRight));
                    setSelectedIndex(document.getElementById("selMarginBottom"), parseInt(oEl.style.marginBottom));
                    setSelectedIndex(document.getElementById("selMarginLeft"), parseInt(oEl.style.marginLeft));

                    /* Flickr */
                    if (src.indexOf("flickr.com") != -1) {
                        document.getElementById("divFlickrSize").style.display = "block";
                        document.getElementById("divFlickrLarger").style.display = "block";
                        document.getElementById("divImageSize").style.display = "none";

                        document.getElementById("inpWidth").value = "";
                        document.getElementById("inpHeight").value = "";
                    }
                    else {
                        document.getElementById("divFlickrSize").style.display = "none";
                        document.getElementById("divFlickrLarger").style.display = "none";
                        document.getElementById("divImageSize").style.display = "block";

                        if (oEl.style.width == "") {
                            document.getElementById("inpWidth").value = "";
                            document.getElementById("hidWidth").value = "";
                        } else {
                            document.getElementById("inpWidth").value = parseInt(oEl.style.width);
                            document.getElementById("hidWidth").value = parseInt(oEl.style.width);
                        }
                        if (oEl.style.height == "") {
                            document.getElementById("inpHeight").value = "";
                            document.getElementById("hidHeight").value = "";
                        } else {
                            document.getElementById("inpHeight").value = parseInt(oEl.style.height);
                            document.getElementById("hidHeight").value = parseInt(oEl.style.height);
                        }


                        var ori = new Image();
                       	ori.onload = function() {
                       		if(document.getElementById("hidWidth").value == "") {
                       			document.getElementById("hidWidth").value = this.width;
                       		}
                       		if(document.getElementById("hidHeight").value == "") {
							    document.getElementById("hidHeight").value = this.height;
                       		}
                       	}
                       	ori.src = src;

                    }

                    if (src.indexOf("flickr.com") != -1 && src.indexOf("_s.jpg") != -1) { document.getElementById('rdoSize1').checked = true; }
                    if (src.indexOf("flickr.com") != -1 && src.indexOf("_t.jpg") != -1) document.getElementById('rdoSize2').checked = true;
                    if (src.indexOf("flickr.com") != -1 && src.indexOf("_m.jpg") != -1) { document.getElementById('rdoSize3').checked = true; }
                    if (src.indexOf("flickr.com") != -1 && src.indexOf("_z.jpg") != -1) document.getElementById('rdoSize5').checked = true;
                    if (src.indexOf("flickr.com") != -1 && src.indexOf("_b.jpg") != -1) document.getElementById('rdoSize6').checked = true;

                    if (oEl.parentNode.nodeName == "A" && oEl.parentNode.childNodes.length == 1) {
                        var oLink = oEl.parentNode;

                        /* Align */
                        if (oLink.style.cssFloat == "") document.getElementsByName('optAlign')[0].selected = true;
                        if (oLink.style.cssFloat == "left" || oLink.style.float == "left") document.getElementsByName('optAlign')[1].selected = true;
                        if (oLink.style.cssFloat == "right" || oLink.style.float == "right") document.getElementsByName('optAlign')[2].selected = true;

                        /* OPEN LARGER IMAGE IN A LIGHTBOX */
                        if (oLink.getAttribute("rel") == "lightbox") {
                            document.getElementById('chkOpenLarger').checked = true;
                        }

                        /* HREF */
                        document.getElementById('inpURL').value = oLink.getAttribute("href")

                        /* OPEN IN A NEW WINDOW */
                        if (oLink.getAttribute("target") == "_blank") {
                            document.getElementById('chkNewWindow').checked = true;
                        }

                    }

                    /* Button */
                    //document.getElementById('btnInsert').value = getTxt("change");

                }
            }
        }

        function showUserphotos(username) {
            var url = "http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=4e9ec6da6433b84b027dae437ec8b9de&username=" + username;
            $.getJSON(url + "&format=json&jsoncallback=?", function (data) {
                var user_id = data.user.id;
                url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=4e9ec6da6433b84b027dae437ec8b9de&user_id=" + user_id + "&safe_search=1&per_page=18&page=" + document.getElementById("hidPage").value;
                var src;
                $.getJSON(url + "&format=json&jsoncallback=?", function (data) {
                    $.each(data.photos.photo, function (i, item) {
                        src = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_s.jpg";
                        $("<img/>").attr("src", src).attr("style", "cursor:pointer;margin:15px;float:left;border:#fff 7px solid;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);box-shadow:0 1px 4px rgba(0, 0, 0, 0.3)").appendTo("#images").click(function () {
                            view("http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_");
                        });
                    });
                });
            });
        }

        function showPhotos(key) {
            var user_id = "";
            var url = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=4e9ec6da6433b84b027dae437ec8b9de&tags=" + key + "&user_id=" + user_id + "&safe_search=1&per_page=20&page=" + document.getElementById("hidPage").value;
            var src;
            $.getJSON(url + "&format=json&jsoncallback=?", function (data) {
                $.each(data.photos.photo, function (i, item) {
                    src = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_s.jpg";
                    $("<img/>").attr("src", src).attr("class", 'img').attr("style", "cursor:pointer;margin:15px;float:left;border:#fff 7px solid;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);box-shadow:0 1px 4px rgba(0, 0, 0, 0.3)").appendTo("#images").click(function () {
                        view("http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_");
                    });
                });
            });
        }

        function search(bNew) {
            if (bNew) {
                document.getElementById("hidPage").value = 1; /*Reset Paging*/
                document.getElementById("images").innerHTML = "";
            }
            var key = $("#inpKeywords").val().replace(" ", "+");
            var username = $("#inpUsername").val().replace(" ", "+");

            if (username != "") {
                showUserphotos(username);
            }
            else if (key != "") {
                showPhotos(key);
            }
            else {
                showUserphotos(parent.oUtil.obj.flickrUser);
            }
        }

        function loadmore() {
            document.getElementById("hidPage").value = (document.getElementById("hidPage").value * 1) + 1;
            search(false);
        }

        function view(src) {
            var size;
            var rdoSizes = document.getElementsByName("rdoSize")
            for (i = 0; i < rdoSizes.length; i++) if (rdoSizes[i].checked == true) size = rdoSizes[i].value;
            //if (size == "z" || size == "b") size = "m";
            //$("<img/>").attr("src", src + size + '.jpg').appendTo("#preview");
            document.getElementById("inpImgURL").value = src + size + '.jpg';

            for (var i = 0; i < document.getElementById("images").childNodes.length; i++) {
                document.getElementById("images").childNodes[i].style.border = "#ffffff 7px solid";
                if(document.getElementById("images").childNodes[i].src == src + 's.jpg')
                document.getElementById("images").childNodes[i].style.border = "#e9ed03 7px solid";
            }

            document.getElementById("divFlickrSize").style.display = "block";
            document.getElementById("divFlickrLarger").style.display = "block";
            document.getElementById("divImageSize").style.display = "none";
            document.getElementById("inpWidth").value = "";
            document.getElementById("inpHeight").value = "";

            renderEffect(src + "t" + '.jpg');

            /* CANVAS EFFECTS */
            document.getElementById('imgmsg').innerHTML = getTxt("notsupported");
            $("#imgpreview").css("display", "none");
            bImageRetouched = false;
            document.getElementById('btnSaveAsNew').style.display = "none";
            document.getElementById('btnRestore').style.display = "none";
        }

        function renderEffect(src, width) {
            var sw = "";
            if (width) sw = 'width:'+ width + 'px;';

            $("#box1").html("").attr("style", "background:none;");
            $("#box2").html("").attr("style", "background:none;");
            $("#box3").html("").attr("style", "background:none;");
            $("#box4").html("").attr("style", "background:none;");
            $("#box5").html("").attr("style", "background:none;");
            $("#box6").html("").attr("style", "background:none;");
            $("#box7").html("").attr("style", "background:none;");
            $("#box8").html("").attr("style", "background:none;");
            $("#box9").html("").attr("style", "background:none;");
            $("#box10").html("").attr("style", "background:none;");
            size = "t";
            $("<img/>").attr("src", src).attr("style", sw + "").appendTo("#box1").click(function () {
                $("#box1").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(1);
            });
            $("<img/>").attr("src", src).attr("style", sw + "border:#fff 7px solid;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);box-shadow:0 1px 4px rgba(0, 0, 0, 0.3)").appendTo("#box2").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(2);
            });
            $("<img/>").attr("src", src).attr("style", sw + "border:#fff 7px solid;-webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);").appendTo("#box3").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(3);
            });
            $("<img/>").attr("src", src).attr("style", sw + "-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;").appendTo("#box4").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(4);
            });
            $("<img/>").attr("src", src).attr("style", sw + "border:#fff 7px solid;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-border-radius:7px;border-radius:7px;").appendTo("#box5").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(5);
            });
            $("<img/>").attr("src", src).attr("style", sw + "border:#fff 7px solid;-webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);-moz-border-radius:7px;border-radius:7px;").appendTo("#box6").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(6);
            });
            $("<img/>").attr("src", src).attr("style", sw + "float:right;margin-right:15px").attr("class", "reflect").appendTo("#box7").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(7);
            });
            $("<img/>").attr("src", src).attr("style", sw + "padding: 5px;border: solid 1px #ddd;").appendTo("#box8").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "");
                $("#hidEffect").val(8);
            });
            $("<img/>").attr("src", src).attr("style", sw + "padding: 5px;border: solid 1px #ddd;-webkit-border-radius: 50em;-moz-border-radius: 50em;border-radius: 50em;").appendTo("#box9").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#box10").attr("style", "");
                $("#hidEffect").val(9);
            });
            $("<img/>").attr("src", src).attr("style", sw + "padding: 5px;border: solid 1px #ddd;-webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5);-moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5);box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5);").appendTo("#box10").click(function () {
                $("#box1").attr("style", "");
                $("#box2").attr("style", "");
                $("#box3").attr("style", "");
                $("#box4").attr("style", "");
                $("#box5").attr("style", "");
                $("#box6").attr("style", "");
                $("#box7").attr("style", "");
                $("#box8").attr("style", "");
                $("#box9").attr("style", "");
                $("#box10").attr("style", "background:#e9ed03;-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;");
                $("#hidEffect").val(10);
            });
            $('img.reflect').reflect();
        }

        function changeSize() {
            var sURL = document.getElementById("inpImgURL").value;
            if (sURL == "") return;
            var size;
            var rdoSizes = document.getElementsByName("rdoSize")
            for (i = 0; i < rdoSizes.length; i++) if (rdoSizes[i].checked == true) size = rdoSizes[i].value;

            var ss = document.getElementById("inpImgURL").value.substr(0, document.getElementById("inpImgURL").value.length - 5);
            document.getElementById("inpImgURL").value = ss + size + '.jpg';
        }

       /* jQuery(document).ready(function ($) {

            parent.oUtil.obj.setFocus();
            if (!parent.oUtil.obj.checkFocus()) { parent.oUtil.obj.setFocus(); alert(0) } //Focus stuff
            var oEditor;
            if (parent.oUtil + '' == 'undefined') oEditor = (window.opener ? window.opener : openerWin).oUtil.oEditor;
            else oEditor = parent.oUtil.oEditor;

            var oSaveSel = parent.oUtil.obj.oSel;
            var oSaveRange = oSaveSel.getRangeAt(0);

            var oSel = oEditor.getSelection();
            oSel.removeAllRanges();
            oSel.addRange(oSaveRange);

            //I_RealtimeLink();
            //parent.oUtil.onSelectionChanged = new Function("I_RealtimeLink()");
            //
            //Di parent:
            //oEdit1.onSelectionChanged = function () {
            //    var obj = oUtil.obj;
            //    obj.oSel = oEditor.getSelection();
            //};

        });*/

        function I_Change(oEl) {
            var obj = parent.oUtil.obj;
            obj.setFocus();

            var oEditor = parent.oUtil.oEditor;

            var oSel;
            if (navigator.appName.indexOf('Microsoft') != -1) {
                oSel = oEditor.document.selection.createRange();
            }
            else {
                oSel = oEditor.getSelection();
            }

            /* Source */
            var src = document.getElementById('inpImgURL').value;
            oEl.setAttribute("SRC", src);

            /* RETOUCH IMAGE */
            applyRetouchedImage(oEl);

            /* Title */
            oEl.setAttribute("ALT", document.getElementById('inpTitle').value);

            /* Effect */
            var nEff = $("#hidEffect").val();
            if (nEff != "") { oEl.style.cssText = ""; }
            applyEffect(oEl)

            /* Margin */
            var nMarginTop = document.getElementById("selMarginTop").value;
            var nMarginRight = document.getElementById("selMarginRight").value;
            var nMarginBottom = document.getElementById("selMarginBottom").value;
            var nMarginLeft = document.getElementById("selMarginLeft").value;
            if (document.getElementById("selAlign").value == "left")
                oEl.style.cssText = oEl.style.cssText + ";float:left;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
            else if (document.getElementById("selAlign").value == "right")
                oEl.style.cssText = oEl.style.cssText + ";float:right;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
            else {
                oEl.style.cssText = oEl.style.cssText + ";float:none;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
            }

            var bAbs = getQueryString()["abs"];
            if (bAbs == "true")
                if (document.getElementById("selAlign").value == "left") {
                    oEl.align = "left";
                    oEl.hspace = "7";
                    oEl.vspace = "7";
                }
                else if (document.getElementById("selAlign").value == "right") {
                    oEl.align = "right";
                    oEl.hspace = "7";
                    oEl.vspace = "7";
                }
                else {
                    oEl.hspace = "7";
                    oEl.vspace = "7";
                }

            /* Dimension */
            if (document.getElementById("inpWidth").value != "") {
                oEl.style.cssText = oEl.style.cssText + ";width:" + document.getElementById("inpWidth").value + "px;";
            }
            if (document.getElementById("inpHeight").value != "") {
                oEl.style.cssText = oEl.style.cssText + ";height:" + document.getElementById("inpHeight").value + "px;";
            }

            /* Flickr */
            if (src.indexOf("flickr.com") != -1) {
                document.getElementById("divFlickrSize").style.display = "block";
                document.getElementById("divFlickrLarger").style.display = "block";
                document.getElementById("divImageSize").style.display = "none";

                document.getElementById("inpWidth").value = "";
                document.getElementById("inpHeight").value = "";
            }
            else {
                document.getElementById("divFlickrSize").style.display = "none";
                document.getElementById("divFlickrLarger").style.display = "none";
                document.getElementById("divImageSize").style.display = "block";
            }

            /* Link URL */
            var sLinkURL = "";
            if (document.getElementById("inpImgURL").value.indexOf("flickr.com") != -1 && document.getElementById("chkOpenLarger").checked) {
                var ss = document.getElementById("inpImgURL").value.substr(0, document.getElementById("inpImgURL").value.length - 5);
                sLinkURL = ss + 'z.jpg';
            }
            else {
                sLinkURL = document.getElementById("inpURL").value;
                if (sLinkURL == "http://") sLinkURL = "";
            }

            if (oEl.parentNode.nodeName == "A" && oEl.parentNode.childNodes.length == 1) {

                var oLink = oEl.parentNode;

                if (sLinkURL == "") {
                    oLink.setAttribute("style", "");
                    oEditor.document.execCommand("unlink", false, null);
                    obj.cleanEmptySpan()
                    return;
                }

                /* Title */
                oLink.setAttribute("title", document.getElementById('inpTitle').value);

                /* Align */
                oLink.style.cssFloat = document.getElementById('selAlign').value; /*TODO: Di IE7 jadi cssFloat:left/right, tp tdk problem*/

                /* OPEN LARGER IMAGE IN A LIGHTBOX */
                if (document.getElementById('chkOpenLarger').checked) {
                    oLink.setAttribute("rel", "lightbox");
                    oLink.setAttribute("target", "");
                }

                /* HREF */
                oLink.setAttribute("href", document.getElementById('inpURL').value);

                /* OPEN IN A NEW WINDOW */
                if (document.getElementById('chkNewWindow').checked) {
                    oLink.setAttribute("target", "_blank");
                    oLink.setAttribute("rel", "");
                }
            }
            else {

                if (sLinkURL == "") return;

                /* Link Title */
                var sTitle = document.getElementById("inpTitle").value;

                /* Link Css Style */
                var sCssStyle = "";
                var nMarginTop = document.getElementById("selMarginTop").value;
                var nMarginRight = document.getElementById("selMarginRight").value;
                var nMarginBottom = document.getElementById("selMarginBottom").value;
                var nMarginLeft = document.getElementById("selMarginLeft").value;
                if (document.getElementById("selAlign").value == "left")
                    sCssStyle = "float:left;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
                else if (document.getElementById("selAlign").value == "right")
                    sCssStyle = "float:right;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
                else
                    sCssStyle = "margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";

                if (navigator.userAgent.indexOf('Safari') != -1) {
                    var range = oSel.getRangeAt(0);
                    var newA = oEditor.document.createElement("A");
                    newA.href = sLinkURL;
                    range.selectNode(oEl);
                    range.surroundContents(newA);

                    range.selectNodeContents(oEl);
                    range.setEndAfter(oEl);

                    oSel.removeAllRanges();
                    oSel.addRange(range);
                }
                else {
                    oEditor.document.execCommand("CreateLink", false, sLinkURL); //tdk jalan di SAFARI
                }

                var oElement;
                if (navigator.appName.indexOf('Microsoft') != -1) {
                    oSel = oEditor.document.selection.createRange();
                    if (oSel.parentElement) oElement = GetElement(oSel.parentElement(), "A");
                    else oElement = GetElement(oSel.item(0), "A");
                }
                else {
                    oSel = oEditor.getSelection();
                    oElement = GetElement(parent.getSelectedElement(oSel), "A");
                }

                if (oElement) {
                    oElement.setAttribute("title", sTitle)
                    oElement.setAttribute("style", sCssStyle)
                    if (document.getElementById("chkNewWindow").checked) {
                        oElement.setAttribute("rel", "");
                        oElement.setAttribute("target", "_blank");
                    }
                    if (document.getElementById("chkOpenLarger").checked) {
                        oElement.setAttribute("rel", "lightbox");
                        oElement.setAttribute("target", "");
                    }
                }
            }
        }

        function I_Insert() {
            if (document.getElementById("inpImgURL").value == "") return false;

            var obj = parent.oUtil.obj;
            obj.setFocus();
            var oEditor = parent.oUtil.oEditor;

            var oSel;
            var oEl;
            if (navigator.appName.indexOf('Microsoft') != -1) {

                var oSel = oEditor.document.selection.createRange();

                if (oSel.parentElement) oEl = GetElement(oSel.parentElement(), "IMG");
                else oEl = GetElement(oSel.item(0), "IMG");

                if (oEl) {
                    I_Change(oEl);
                    return;
                }
            }
            else {
                oSel = oEditor.getSelection();
                oEl = GetElement(parent.getSelectedElement(oSel), "IMG");

                if (oEl) {
                    if (oEl.nodeName == "IMG") {
                        I_Change(oEl);
                        return;
                    }
                }
            }

            /* Link URL */
            var sLinkURL = "";
            if (document.getElementById("chkOpenLarger").checked) {
                var ss = document.getElementById("inpImgURL").value.substr(0, document.getElementById("inpImgURL").value.length - 5);
                sLinkURL = ss + 'z.jpg';
            }
            else {
                sLinkURL = document.getElementById("inpURL").value;
                if (sLinkURL == "http://") sLinkURL = "";
            }

            /* Link Title */
            var sTitle = document.getElementById("inpTitle").value;

            /* Link Target */
            var sTarget = "";
            if (document.getElementById("chkNewWindow").checked) sTarget = "_blank";

            /* Link Css Style */
            var sCssStyle = "";
            var nMarginTop = document.getElementById("selMarginTop").value;
            var nMarginRight = document.getElementById("selMarginRight").value;
            var nMarginBottom = document.getElementById("selMarginBottom").value;
            var nMarginLeft = document.getElementById("selMarginLeft").value;
            if (document.getElementById("selAlign").value == "left")
                sCssStyle = "float:left;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
            else if (document.getElementById("selAlign").value == "right")
                sCssStyle = "float:right;margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";
            else
                sCssStyle = "margin-top:" + nMarginTop + "px;margin-right:" + nMarginRight + "px;margin-bottom:" + nMarginBottom + "px;margin-left:" + nMarginLeft + "px;";

            /* Dimension */
            if (document.getElementById("inpWidth").value != "") {
                sCssStyle += ";width:" + document.getElementById("inpWidth").value + "px;";
            }
            if (document.getElementById("inpHeight").value != "") {
                sCssStyle += ";height:" + document.getElementById("inpHeight").value + "px;";
            }

            /* Image URL */
            var sImgURL = document.getElementById("inpImgURL").value;

            /* Image Css Class */
            var sImgCssClass = "";
//            if (document.getElementById("chkReflection").checked) sImgCssClass = "reflect";

            /* Image Css Style */
            var sImgCssStyle = "";
            if (sLinkURL == "") sImgCssStyle = sCssStyle;

            /* INSERT IMAGE */
            var oImg = I_InsertImage(sImgURL, sTitle, sImgCssClass, sImgCssStyle);

            var bAbs = getQueryString()["abs"];
            if (bAbs == "true")
                if (document.getElementById("selAlign").value == "left") {
                    oImg.align = "left";
                    oImg.hspace = "7";
                    oImg.vspace = "7";
                }
                else if (document.getElementById("selAlign").value == "right") {
                    oImg.align = "right";
                    oImg.hspace = "7";
                    oImg.vspace = "7";
                }
                else {
                    oImg.hspace = "7";
                    oImg.vspace = "7";
                }

            /* RETOUCH IMAGE */
            applyRetouchedImage(oImg);

            /* INSERT LINK */
            if (sLinkURL != "") {
                var oElement = I_CreateLink(sLinkURL, sTitle, sTarget, "", sCssStyle);

                /* Append Image to Link, Add Lightbox */
                if (oElement) {
                    if (navigator.appName.indexOf('Microsoft') != -1) {
                        if (document.getElementById("chkOpenLarger").checked) {
                            oElement.rel = "lightbox";
                            oElement.target = "";
                        }
                    }
                    else {
                        oElement.innerHTML = "";
                        oElement.appendChild(oImg);
                        if (document.getElementById("chkOpenLarger").checked) {
                            oElement.setAttribute("rel", "lightbox");
                            oElement.setAttribute("target", "");
                        }
                    }
                }
            }

            /* EFFECTS */
            applyEffect(oImg)

            /* PENTING: Update Selection (sebenarnya utk IE saja) */
            var obj = parent.oUtil.obj;
            parent.editorDoc_onkeyup(obj.oName);

            return true;
        }

        function applyEffect(oImg) {
            var nEff = $("#hidEffect").val();

            if (nEff == "") {return;}

            if (nEff == 1) {
                oImg.style.cssText = oImg.style.cssText + ";" + "";
            }
            if (nEff == 2) {
                oImg.style.cssText = oImg.style.cssText + ";" + "border:#fff 7px solid;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);box-shadow:0 1px 4px rgba(0, 0, 0, 0.3)";
            }
            if (nEff == 3) {
                oImg.style.cssText = oImg.style.cssText + ";" + "border:#fff 7px solid;-webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);";
            }
            if (nEff == 4) {
                oImg.style.cssText = oImg.style.cssText + ";" + "-webkit-border-radius: 7px;-moz-border-radius: 7px;border-radius: 7px;";
            }
            if (nEff == 5) {
                oImg.style.cssText = oImg.style.cssText + ";" + "border:#fff 7px solid;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);-moz-border-radius:7px;border-radius:7px;";
            }
            if (nEff == 6) {
                oImg.style.cssText = oImg.style.cssText + ";" + "border:#fff 7px solid;-webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);-moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);-moz-border-radius:7px;border-radius:7px;";
            }
            if (nEff == 7) {
                if (navigator.appName.indexOf('Microsoft') != -1) {
                    oImg.style.className = "reflect";
                }
                else {
                    oImg.setAttribute("class", "reflect");
                }
            }
            if (nEff == 8) {
                oImg.style.cssText = oImg.style.cssText + ";" + "padding: 5px;border: solid 1px #ddd;";
            }
            if (nEff == 9) {
                oImg.style.cssText = oImg.style.cssText + ";" + "padding: 5px;border: solid 1px #ddd;-webkit-border-radius: 50em;-moz-border-radius: 50em;border-radius: 50em;";
            }
            if (nEff == 10) {
                oImg.style.cssText = oImg.style.cssText + ";" + "padding: 5px;border: solid 1px #ddd;-webkit-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5);-moz-box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5);box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5);";
            }
        }

        /* IMAGE EFFECTS */

        var canvas; var context;
        var bImageRetouched = false;

        jQuery(document).ready(function ($) {
            canvas = document.getElementById('mycanvas');

            //if (canvas.getContext) {
            //    context = canvas.getContext('2d');
            //} else {
                $("#tab3").css("display", "none");

            //}
        });

        function isCanvasSupported() {
            var elem = document.createElement('canvas');
            return !!(elem.getContext && elem.getContext('2d'));
        }

        function loadImageIntoCanvas(sUrl) {
            if (!isCanvasSupported()) return;

            if (sUrl.substr(0, 1) == "/" || sUrl.substr(0, 5) == "data:") {
                document.getElementById('imgmsg').innerHTML = "";

                $("#imgpreview").css("display", "block");
            }
            else {
                //document.getElementById('imgmsg').innerHTML = getTxt("notsupported");
                $("#imgpreview").css("display", "none");
                return;
            }
            var imgObj = new Image();
            imgObj.onload = function () {
                canvas.width = this.width;
                canvas.height = this.height;
                context.drawImage(this, 0, 0, this.width, this.height, 0, 0, canvas.width, canvas.height);
                //context.drawImage(this, 0, 0, canvas.width, canvas.height);

                bImageRetouched = false;
                document.getElementById('btnSaveAsNew').style.display = "none";
                document.getElementById('btnRestore').style.display = "none";

                previewImage();
            }
            imgObj.src = sUrl;
        }

        function previewImage() {
            var imgOriW = parseInt(canvas.width);
            var imgOriH = parseInt(canvas.height);
            var containerW = 378;
            var containerH = 220;
            var oImg = document.getElementById('imgpreview');
            if (imgOriW <= containerW && imgOriH <= containerH) {
                oImg.style.width = imgOriW + "px";
                oImg.style.height = imgOriH + "px";
            }
            else {
                if (imgOriW / containerW <= imgOriH / containerH) {
                    oImg.style.width = ((containerH * imgOriW) / imgOriH) + "px";
                    oImg.style.height = containerH + "px";
                    oImg.style.marginLeft = ((415 - parseInt(oImg.style.width)) / 2) - 5 + "px";
                }
                else {
                    oImg.style.width = containerW + "px";
                    oImg.style.height = ((containerW * imgOriH) / imgOriW) + "px";
                    oImg.style.marginTop = ((312 - parseInt(oImg.style.height)) / 2) - 5 + "px";
                }
            }

            oImg.src = canvas.toDataURL("image/png");
        }

        function retouchImage(sFilter) {
            if (sFilter == "") {
                loadImageIntoCanvas(document.getElementById('inpImgURL').value);
                return;
            }

            if (sFilter == "vintage") {
                processVintage(false);
                previewImage();
            }
            else if (sFilter == "vintage-vignette") {
                processVintage(true);
                previewImage();
            }
            else if (sFilter == "grayscale") {
                var imgObj = new Image();
                imgObj.onload = function () {
                    processGrayscale(false);
                    processSharpen(imgObj, 0.03);
                    previewImage();
                }
                imgObj.src = document.getElementById('imgpreview').src;
            }
            else if (sFilter == "grayscale-vignette") {
                var imgObj = new Image();
                imgObj.onload = function () {
                    processGrayscale(true);
                    processSharpen(imgObj, 0.03);
                    previewImage();
                }
                imgObj.src = document.getElementById('imgpreview').src;
            }
            else if (sFilter == "gaussian-blur") {
                processGaussianBlur(2);
                previewImage();
            }
            else if (sFilter == "sharpen") {
                var imgObj = new Image();
                imgObj.onload = function () {
                    processSharpen(imgObj, 0.05);
                    previewImage();
                }
                imgObj.src = document.getElementById('imgpreview').src;
            }
            else if (sFilter == "emboss") {

                var imgObj = new Image();
                imgObj.onload = function () {
                    processEmboss(imgObj, 0.25);
                    previewImage();
                }
                imgObj.src = document.getElementById('imgpreview').src;
            }

            else if (sFilter == "sepia") {
                Caman(canvas.toDataURL("image/png"), "#mycanvas", function () {
                    this.saturation(20).gamma(1.4).vintage().contrast(5).exposure(15).vignette(300, 60).render(function () {
                        previewImage();
                    });
                });
            }
            else {
                processFilter(sFilter);
            }

            if($("#imgpreview").css("display") != "none") {
                bImageRetouched = true;
                document.getElementById('btnSaveAsNew').style.display = "inline";
                document.getElementById('btnRestore').style.display = "inline";
            }
        }

	    function applyRetouchedImage(oImg) {
	        if(bImageRetouched) oImg.src = canvas.toDataURL('image/jpeg');
	    }

	    function saveImage() {
	        var image = canvas.toDataURL("image/png");
	        //image = image.replace("data:image/png;base64,", "");
	        image = image.replace(/^data:image\/(png|jpg);base64,/, "");
	        $('#hidImage').val(image);

	        var path = document.getElementById("inpImgURL").value;
            path=path.substr(0, path.lastIndexOf('/') + 1);
            $('#hidPath').val(path);

            var filename = document.getElementById("inpImgURL").value;
            filename = filename.match(/([^\/]+)(?=\.\w+$)/)[0];
            $('#hidFile').val(filename);

            var ext = parent.oUtil.obj.fileBrowser.split('.').pop();
            var postpath = parent.oUtil.obj.fileBrowser.replace("/asset.", "/server/saveimage.")
            document.getElementById("canvasform").action = postpath;
            /*
            alert(postpath);
            if (ext == "aspx") document.getElementById("canvasform").action = "../../assetmanager/server/saveimage.aspx";
            if (ext == "asp") document.getElementById("canvasform").action = "../../assetmanager/server/saveimage.asp";
            if (ext == "php") document.getElementById("canvasform").action = "../../assetmanager/server/saveimage.php";
            */
	        document.getElementById("canvasform").submit();
	    }
	    function imageSaved(s) {
	        loadImageIntoCanvas(s);
	        document.getElementById("inpImgURL").value = s;
	    }

	    function resetImage() {
	    	var src = document.getElementById("inpImgURL").value;
	    	if(src!="") {
	    		var img = new Image();
	    		img.onload = function() {
					document.getElementById("inpWidth").value = this.width;
					document.getElementById("inpHeight").value = this.height;
					document.getElementById("hidWidth").value = this.width;
					document.getElementById("hidHeight").value = this.height;
	    		};
	    		img.src = src;
	    	}
	    }

	    function dimChange(attr, elm) {
	    	if(!document.getElementById("chkRatio").checked) return;
	    	if(elm.value=="") return;

			var hw = document.getElementById("hidWidth");
			var hh = document.getElementById("hidHeight");

			if(hw.value=="" || hh.value=="") return;

			if(attr == "width") {
				document.getElementById("inpHeight").value = Math.round((elm.value*hh.value)/hw.value);
			} else {
				document.getElementById("inpWidth").value = Math.round((elm.value*hw.value)/hh.value);
			}
	    }

	    /* /IMAGE EFFECTS */

        var storeBgColor, storeColor;
        function over(me, hover) {
            storeBgColor = me.style.backgroundColor;
            if (!hover) me.style.backgroundColor = '#c90000';
            else me.style.backgroundColor = hover;
            storeColor = me.style.color;
            me.style.color = '#fff';
        }
        function out(me) {
            me.style.backgroundColor = storeBgColor;
            me.style.color = storeColor;
        }

        function tabClick(n) {
            $("#div0").css("display", "none");
            $("#tab0").css("background", "#ccc");
            $("#div1").css("display", "none");
            $("#tab1").css("background", "#ccc");
            $("#div2").css("display", "none");
            $("#tab2").css("background", "#ccc");
            $("#div3").css("display", "none");
            $("#tab3").css("background", "#ccc");

            $("#div" + n).css("display", "block");
            $("#tab" + n).css("background", "#fcfcfc");
        }
    </script>

</head>
<body style="margin-top:12px;margin-left:10px">
<input id="hidPage" type="hidden" value="1" />
<input id="hidEffect" type="hidden" value="" />
<div style="clear:left"></div>
<table cellpadding="0" cellspacing="0" style="margin-left:7px;">
<tr>
<td>
    <div id="div0" style="color:#000;padding:0px;padding-right:0px;width:415px;height:480px;overflow:auto;border-top:none;background:#fcfcfc;display:block;">
        <div style="margin-top:20px;margin-left:15px">
        <div id="box1" class="item">
        </div>
        <div id="box2" class="item">
        </div>
        <div id="box3" class="item">
        </div>
        <div id="box4" class="item">
        </div>
        <div id="box5" class="item">
        </div>
        <div id="box6" class="item">
        </div>
        <!--<div id="box7" class="item">
        </div>-->
        <div id="box8" class="item">
        </div>
        <div id="box10" class="item">
        </div>
        <div id="box9" class="item">
        </div>
        </div>
    </div>
</td>
<td style="padding-left:20px;height:395px;font-family:Arvo;text-shadow:1px 1px 1px rgba(255,255,255,0.6);color:#000;" valign="top">


    <div style="margin-bottom:7px;font-size:10px;letter-spacing:1px" id="lblImgSrc">Url De La Imagen:</div>
    <input id="inpImgURL" type="text" style="width:250px;height:23px;" onblur="loadImageIntoCanvas(this.value)" />
    <br /><br />

    <div style="margin-bottom:7px;font-size:10px;letter-spacing:1px" id="lblTitle">Título:</div>
    <input id="inpTitle" type="text" style="width:250px;height:23px;" />
    <br /><br />

    <table cellpadding="0" cellspacing="0">
    <tr>
    <td>
        <div style="margin-bottom:7px;font-size:10px;letter-spacing:1px" id="lblAlign">Alinear texto:</div>
        <select id="selAlign">
            <option value="" id="optAlign" name="optAlign"></option>
            <option value="left" id="optAlign" name="optAlign">De izquierda a derecha</option>
            <option value="right" id="optAlign" name="optAlign">De derecha a izquierda</option>
        </select>
    </td>
    </tr>
    </table>
    <br />


<div class="modal fade" id="modo_elegir" tabindex="-1" role="dialog" aria-labelledby="modo_elegirLabel" aria-hidden="true">
    <div id="ver_imagen_caja_texto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Elegir imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel panel-warning"><div class="panel-heading">Ver Imágenes</div><div class="panel-body">
            
            <?php 
            $arbica = array(); 
            $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
            while($regcr=$ini->fetch_object($sqlcr)){ 
                $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); 
            } ?>
            <form action="" method="post" id="formcambiacar">
                <input type="hidden" name="elcarpeta" value="activo" />
                <p>Mostrar carpeta: 
                    <select name="carpetabs" class="seleccarpeta">
                        <option value="todas">todas</option>
                        <?php foreach($arbica as $e=>$val){ ?>
                            <option value="<?php echo $arbica[$e][0]; ?>"<?php if(isset($_POST['carpetabs']) and $_POST['carpetabs'] == $arbica[$e][0]){ ?> selected="selected"<?php } ?>><?php echo $arbica[$e][2]; ?></option>
                        <?php } ?>
                    </select>
                </p>
            </form>
            <?php 
            if(isset($_POST['elcarpeta'])){ 
                $arbica = array();
                $sql = $ini->consulta("select id, carpeta, nombre_amg from carpetas"); 
                while($reg=$ini->fetch_object($sql)){
                    if($reg->id == $_POST['carpetabs'] or $_POST['carpetabs'] == "todas"){ 
                        $arbica[$reg->id] = array($reg->id,$reg->carpeta,$reg->nombre_amg); 
                    } 
                } 
            } ?>
            <div class="row">
            <?php 
            $c = 0; 
            foreach($arbica as $e=>$val){ 
                foreach(glob("../../../../imagen".$arbica[$e][1]."*") as $archivos_carpeta){ 
                    if(!is_dir($archivos_carpeta)){ 
                        $c++;
                        $wh = getimagesize($archivos_carpeta);  
                        $archivos_carpeta = str_replace("../../../../",$urlppal,$archivos_carpeta); ?>
                        <div class="col-sm-6 col-md-3">
                            <a href="#" class="thumbnail selecimg" id="<?php echo $archivos_carpeta; ?>" data-dismiss="modal" target="_blank">
                                <img src="<?php echo $archivos_carpeta; ?>" />
                            </a>
                        </div>
                        <?php 
                    } 
                } 
            } ?>
            </div>


            <script type="text/javascript">
                $(document).ready(function () {
                    $('.seleccarpeta').change(function(){
                        var url = "../../../admin/php/muestra_imagen_caja_texto.php";
                        $.ajax({ type: "POST", url: url, data: $('#formcambiacar').serialize(), success: function(data){ $('#ver_imagen_caja_texto').html(data); } });
                    });
                    $('.selecimg').click(function(){
                        document.getElementById('inpImgURL').value = this.id;
                    });
                });
            </script>


            
        </div>
    </div>
    <?php if($c == 0){ ?> - Sin Imágenes - <?php } ?>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        
        <form id="confirmar_form_img" action="" method="post">
            <input type="hidden" name="url_img" value="" id="url_img_form">
            <input type="hidden" name="carpeta" value="" id="carpeta_form">
        </form>
      </div>
    </div>
  </div>
</div></div>


    <table cellpadding="0" cellspacing="0">
    <tr>
    <td>
        <div style="margin-bottom:7px;font-size:10px;letter-spacing:1px" id="lblAlign"><a data-toggle="modal" class="func_ver_url" data-target="#modo_elegir" href="#">Buscar imagen en servidor</a></div>
    </td>
    </tr>
    </table>
    <br />   

    <table cellpadding="0" cellspacing="0">
    <tr>
    <td>
        <div style="margin-bottom:7px;font-size:10px;letter-spacing:1px" id="lblMargin">Margen: (Arriba / Derecha / Abajo / Izquierda)</div>
        <select id="selMarginTop">
            <option value="0"></option>
            <option value="1">1px</option>
            <option value="2">2px</option>
            <option value="3">3px</option>
            <option value="4">4px</option>
            <option value="5">5px</option>
            <option value="6">6px</option>
            <option value="7">7px</option>
            <option value="8">8px</option>
            <option value="9">9px</option>
            <option value="10">10px</option>
            <option value="11">11px</option>
            <option value="12">12px</option>
            <option value="13">13px</option>
            <option value="14">14px</option>
            <option value="15">15px</option>
            <option value="16">16px</option>
            <option value="17">17px</option>
            <option value="18">18px</option>
            <option value="19">19px</option>
            <option value="20">20px</option>
            <option value="25">25px</option>
            <option value="30">30px</option>
            <option value="35">35px</option>
            <option value="40">40px</option>
        </select>
        <select id="selMarginRight">
            <option value="0"></option>
            <option value="1">1px</option>
            <option value="2">2px</option>
            <option value="3">3px</option>
            <option value="4">4px</option>
            <option value="5">5px</option>
            <option value="6">6px</option>
            <option value="7">7px</option>
            <option value="8">8px</option>
            <option value="9">9px</option>
            <option value="10">10px</option>
            <option value="11">11px</option>
            <option value="12">12px</option>
            <option value="13">13px</option>
            <option value="14">14px</option>
            <option value="15">15px</option>
            <option value="16">16px</option>
            <option value="17">17px</option>
            <option value="18">18px</option>
            <option value="19">19px</option>
            <option value="20">20px</option>
            <option value="25">25px</option>
            <option value="30">30px</option>
            <option value="35">35px</option>
            <option value="40">40px</option>
        </select>
        <select id="selMarginBottom">
            <option value="0"></option>
            <option value="1">1px</option>
            <option value="2">2px</option>
            <option value="3">3px</option>
            <option value="4">4px</option>
            <option value="5">5px</option>
            <option value="6">6px</option>
            <option value="7">7px</option>
            <option value="8">8px</option>
            <option value="9">9px</option>
            <option value="10">10px</option>
            <option value="11">11px</option>
            <option value="12">12px</option>
            <option value="13">13px</option>
            <option value="14">14px</option>
            <option value="15">15px</option>
            <option value="16">16px</option>
            <option value="17">17px</option>
            <option value="18">18px</option>
            <option value="19">19px</option>
            <option value="20">20px</option>
            <option value="25">25px</option>
            <option value="30">30px</option>
            <option value="35">35px</option>
            <option value="40">40px</option>
        </select>
        <select id="selMarginLeft">
            <option value="0"></option>
            <option value="1">1px</option>
            <option value="2">2px</option>
            <option value="3">3px</option>
            <option value="4">4px</option>
            <option value="5">5px</option>
            <option value="6">6px</option>
            <option value="7">7px</option>
            <option value="8">8px</option>
            <option value="9">9px</option>
            <option value="10">10px</option>
            <option value="11">11px</option>
            <option value="12">12px</option>
            <option value="13">13px</option>
            <option value="14">14px</option>
            <option value="15">15px</option>
            <option value="16">16px</option>
            <option value="17">17px</option>
            <option value="18">18px</option>
            <option value="19">19px</option>
            <option value="20">20px</option>
            <option value="25">25px</option>
            <option value="30">30px</option>
            <option value="35">35px</option>
            <option value="40">40px</option>
        </select>
    </td>
    </tr>
    </table>

    <div style="margin-top:12px;margin-bottom:7px;height:50px">
        <div id="divFlickrSize" style="display:none;">
            <input id="rdoSize1" name="rdoSize" type="radio" value="s" group="size" onclick="changeSize()" /><label for="rdoSize1" id="lblSize1">SMALL SQUARE</label>
            <input id="rdoSize2" name="rdoSize" type="radio" value="t" group="size" onclick="changeSize()" /><label for="rdoSize2" id="lblSize2">THUMBNAIL</label>
            <input id="rdoSize3" name="rdoSize" type="radio" value="m" group="size" onclick="changeSize()" checked="checked" /><label for="rdoSize3" id="lblSize3">SMALL</label><br />
            <input id="rdoSize5" name="rdoSize" type="radio" value="z" group="size" onclick="changeSize()" /><label for="rdoSize5" id="lblSize5">MEDIUM</label>
            <input id="rdoSize6" name="rdoSize" type="radio" value="b" group="size" onclick="changeSize()" /><label for="rdoSize6" id="lblSize6">LARGE</label>
        </div>
        <div id="divImageSize" style="display:none;font-size:10px;letter-spacing:1px">
        	<input type="hidden" id="hidWidth" value="" />
        	<input type="hidden" id="hidHeight" value="" />
            <label id="lblWidthHeight" for="inpWidth">Anchura x Altura:</label>
            <input id="inpWidth" type="text" value="" style="width:50px;height:23px;" onblur="dimChange('width', this)" /> x
            <input id="inpHeight" type="text" value="" style="width:50px;height:23px;" onblur="dimChange('height', this)" /> px
        	<div style="margin-top:5px;">
        		<input type="checkbox" id="chkRatio" name="chkRatio" checked="checked"/><label for="chkRatio" id="lblMaintainRatio">Mantener relación entre altura y anchura</label>
        		&nbsp;&nbsp;&nbsp;
        		<a href="#" onclick="resetImage();return false;"><span id="resetdimension">Resetear dimensiones</span></a>
        	</div>
        </div>
    </div>


    <div style="border-top:#fff 1px solid;border-bottom:#ccc 1px solid;margin-top:15px;margin-bottom:15px;margin-left:0px;width:265px"></div>

    <div style="height:30px">
        <div id="divFlickrLarger" style="display:none;">
        <div style="margin-bottom:15px;font-size:10px;letter-spacing:1px">
        <input id="chkOpenLarger" type="checkbox" /><label for="chkOpenLarger" id="lblOpenLarger">Abrir imagen grande en una caja de luz</label>
        </div>
        </div>
    </div>

    <div style="margin-bottom:7px;font-size:10px;letter-spacing:1px" id="lblLinkToUrl">URL:</div>
    <input id="inpURL" type="text" value="http://" style="width:250px;height:23px;"/>

    <div style="margin-top:7px;margin-bottom:20px;font-size:10px;letter-spacing:1px">
    <input id="chkNewWindow" type="checkbox" /><label for="chkNewWindow" id="lblNewWindow">Abrir en una nueva ventana.</label>
    </div>


    <input type="button" name="btnCancel" id="btnCancel" value="Cancelar" onclick="I_Close()" class="inpBtn" style="width:120px;height:33px" onmouseover="this.className='inpBtnOver';" onmouseout="this.className='inpBtnOut'" />
    <input type="button" name="btnInsert" id="btnInsert" value="Aceptar" onclick="I_Insert();I_Close()" class="inpBtn" style="width:120px;height:33px"  />



</td>
</tr>
</table>

</body>
</html>
