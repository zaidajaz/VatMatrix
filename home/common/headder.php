<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>VAT MATRIX v1.0</title>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />    
    <meta name="description" content="Template CMS admin area" />
    <link rel="icon" href="http://localhost/ns/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="http://localhost/ns/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="templates/css/style.css" media="all" type="text/css" />
    <link rel="stylesheet" href="templates/css/layout.css" />
    <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

    <script type="text/javascript" src="templates/js/jquery.js"></script>
    <script type="text/javascript" src="templates/js/template-cms.js"></script>
    <script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

   
   
   <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"

		});
	};
</script>

   <script type="text/javascript">
	function cal(){
		new JsDatePick({
			useMode:2,
			target:"inputField2",
			dateFormat:"%Y-%m-%d"

		});
	};
</script>

    
    
    <script type="text/javascript">
	function toggle(){
		var rate=document.forms.new_bill.new_rate;
		var total=document.forms.new_bill.new_total;
		
		if(rate.disabled==false){
			rate.disabled=true;
			total.disabled=false;
			
		}
		else{
			rate.disabled=false;
			total.disabled=true;
			
		}
	}
	function calculate(){
		var rate=document.forms.new_bill.new_rate;
		var qty=document.forms.new_bill.new_qty;
		var amt=document.forms.new_bill.new_amt;
		var vatp=document.forms.new_bill.new_vatp;
		var vatamt=document.forms.new_bill.new_vatamt;
		var total=document.forms.new_bill.new_total;
		var extra=document.forms.new_bill.new_extra;
		var discount=document.forms.new_bill.new_discount;
		var more=document.forms.new_bill.add;
		var nodiscount;
		var discountvar;
		var extravar;
		
		if(discount.value==''){
			discountvar=0;
		}
		else{
			discountvar=parseFloat(discount.value);
		}
		
		if(extra.value==''){
			extravar=0;
			
		}
		else{
			extravar=parseFloat(extra.value);
		}
		
		if(rate.disabled==false){
			amt.value=(parseFloat(rate.value)*parseInt(qty.value)).toFixed(2);
			vatamt.value=(parseFloat(amt.value)*parseFloat(vatp.value)/100).toFixed(2);
			nodiscount=(parseFloat(amt.value)+parseFloat(vatamt.value)+extravar).toFixed(2);
			total.value=nodiscount-discountvar;	
			add.disabled=false;	
		}
		else{
			var t=parseFloat(total.value);
			var q=parseInt(qty.value);
			var a=1+parseFloat(vatp.value)/100;
			
			var r=((t+discountvar)-extravar)/(q*a);
			var am=q*r;
			var vatam=(a-1)*am;
			
			rate.value=r.toFixed(2);
			amt.value=am.toFixed(2);
			vatamt.value=vatam.toFixed(2);
			
			add.disabled=false;
			
		}
		
	}

	function valid(){
		var rate=document.forms.new_bill.new_rate;
		var total=document.forms.new_bill.new_total;
		var vatamt=document.forms.new_bill.new_vatamt;
		var amt=document.forms.new_bill.new_amt;
		
		
			rate.disabled=false;
			total.disabled=false;
			amt.disabled=false;
			vatamt.disabled=false;
		
	}
</script>
<?php
	error_reporting(0);
	if(!isset($_SESSION)){
		session_start();
		session_regenerate_id(true);
		if(!isset($_SESSION['NSTEBS'])){
			$_SESSION['NSTEBS']=array('bill_no');
		}
	}
?>
    
    
    
    <style>
                #pages-other {
                    margin-left:10px;
                    width:780px;
                }
                #pages-other-toggle {
                    -webkit-border-bottom-right-radius: 5px;
                    -webkit-border-bottom-left-radius: 5px;
                    -moz-border-radius-bottomright: 5px;
                    -moz-border-radius-bottomleft: 5px;
                    border-bottom-right-radius: 5px;
                    border-bottom-left-radius: 5px                    
                    background:#EEEEEE;
                    border:1px solid #ccc;
                    cursor:pointer;
                    font-size: 0.8em;
                    text-align:center;                    
                }
                #pages-other-toggle:hover {
                    background:#E9EAEA;
                }
                #pages-other-box {                    
                    border-left:1px solid #ccc;
                    border-right:1px solid #ccc;
                    display:none;
                    padding:15px;
                }

              .error-none {display:none;}

              </style>
              <script>
               $().ready(function() {
                    $("#pages-other-toggle").click(function() {                        
                        $("#pages-other-box").slideToggle("slow");                        
                    });                      
               });
              </script>
                <style type="text/css">
                    .filesmanager-main {
                        color:#737373;
                        float:left;
                        width:600px;
                    }

                    .filesmanager-tr {
                        border-bottom:1px solid #f2f2f2;
                    }

                    .filesmanager-tr:hover {
                        background:#FBF4DF;
                    }

                    .filesmanager-td {
                        padding-left:5px;
                        padding-right:5px;
                        padding-top:5px;
                        padding-bottom:5px;
                    }

                    #filesmanager-upload {
                        border:1px solid #DDD;
                        float:right;
                        margin-left:20px;
                        padding:10px 20px;
                        width:250px;
                    }

                    input.file {
                        position: relative;
                        text-align: right;
                        -moz-opacity:0 ;
                        filter:alpha(opacity: 0);
                        opacity: 0;
                        z-index: 2;
                    }
                    .file-ext {
                        -moz-border-radius:3px;
                        -webkit-border-radius:3px;
                        background:#F2F2F2;
                        border-radius:3px;
                        border: 1px solid #ccc;
                        color:#4E4131;
                        font-weight:bold;
                        padding:10px;
                        text-align:center;
                        line-height:10px;
                    }
                    .file-ext:hover {
                        background:#E5DED7;
                        color:#000;
                    }

                </style>
            <style>
                #snippets {
                    margin-left:10px;
                    margin-top: -16px;
                }
                #snippets-toggle {
                    -webkit-border-bottom-right-radius: 5px;
                    -webkit-border-bottom-left-radius: 5px;

                    -moz-border-radius-bottomright: 5px;
                    -moz-border-radius-bottomleft: 5px;

                    border-bottom-right-radius: 5px;
                    border-bottom-left-radius: 5px
                    
                    
                    background:#EEEEEE;
                    border:1px solid #ccc;
                    cursor:pointer;
                    font-size: 0.8em;
                    text-align:center;
                }
                #snippets-toggle:hover {
                    background:#E9EAEA;
                }
                #snippets-box {                    
                    border-left:1px solid #ccc;
                    border-right:1px solid #ccc;
                    display:none;
                    padding-top:15px;
                }
              </style>
              <script>
               $().ready(function() {
                    $("#snippets-toggle").click(function() {                        
                        $("#snippets-box").slideToggle("slow");                        
                    });                    
               });
              </script>
          <link rel="stylesheet" type="text/css" href="http://localhost/ns/plugins/box/cleditor/cleditor/jquery.cleditor.css" />
          <script type="text/javascript" src="http://localhost/ns/plugins/box/cleditor/cleditor/jquery.cleditor.min.js"></script>
          <script type="text/javascript" src="http://localhost/ns/plugins/box/cleditor/cleditor/jquery.cleditor.plugins.js"></script>    
          <script type="text/javascript">
            // CLEditor plusimage Plugin v1.0
            (function($) {
              // Constants this must be updated with your Path and Text
              var 
              PATH = window.location.host,//without Slash (/) at the end
              //Translation
              VALUETEXT = "Click to Call KCFinder",
              BUTTONTEXT = "Submit",
              TITLETEXT = "Insert image from the server",
              PROMPTTEXT = "Cleditor link";        
              // Define the plusimage button
              $.cleditor.buttons.plusimage = {
                name: "plusimage",
                image: "plusimage.gif",    
                title: TITLETEXT,    
                command: "insertimage",
                popupName: "Plusimage",
                popupClass: "cleditorPrompt",
                popupContent:         
                  PROMPTTEXT + "<br>" +
                  "<input type=\"text\" readonly=\"readonly\" onclick=\"openKCFinder(this)\" value=\"" + VALUETEXT + "\" style=\"width:300px;cursor:pointer\" /><br>" +
                  "<input type=button value=\"" + BUTTONTEXT + "\">",
                buttonClick: plusimageButtonClick
              };
              // Add the button to the default controls
              $.cleditor.defaultOptions.controls = $.cleditor.defaultOptions.controls
                .replace("rule image", "rule plusimage");
              // plusimage button click event handler
              function plusimageButtonClick(e, data) {
                // Wire up the submit button click event handler
                $(data.popup).children(":button")
                  .unbind("click")
                  .bind("click", function(e) {
                    // Get the editor
                    var editor = data.editor;
                    // Get the value
                    var $text = $(data.popup).find(":text"),
                      image_path = "http://" + PATH + $text[0].value;
                    // Insert the html
                    editor.execCommand(data.command, image_path, null, data.button);
                    // Reset the text, hide the popup and set focus
                    $text.val(VALUETEXT);
                    editor.hidePopups();
                    editor.focus();
                  });
                }
            })(jQuery);

            $(document).ready(function() {        
                $("#editor_area").cleditor({        
                    width:        "auto", 
                    height:       400, 
                    controls:    
                                  "bold italic underline strikethrough subscript superscript | font size " +
                                  "style | color highlight removeformat | bullets numbering | outdent " +
                                  "indent | alignleft center alignright justify | undo redo | " +
                                  "rule table image plusimage link unlink | pastetext | source",
                    colors:      
                                  "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
                                  "CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
                                  "BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C " +
                                  "999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C " +
                                  "666 900 C60 C93 990 090 399 33F 60C 939 " +
                                  "333 600 930 963 660 060 366 009 339 636 " +
                                  "000 300 630 633 330 030 033 006 309 303",    
                    fonts:       
                                  "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond," +
                                  "Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana",
                    sizes:       
                                  "1,2,3,4,5,6,7",
                    styles:      
                                  [["Paragraph", "<p>"], ["Header 1", "<h1>"], ["Header 2", "<h2>"],
                                  ["Header 3", "<h3>"],  ["Header 4","<h4>"],  ["Header 5","<h5>"],
                                  ["Header 6","<h6>"]],
                   
                    useCSS:       false,

                    docCSSFile: "", 
                    bodyStyle: "margin:4px; font:10pt Arial,Verdana; cursor:text"
               });
            });

            function openKCFinder(field) {
              window.KCFinder = {
                  callBack: function(url) {
                      window.KCFinder = null;
                      field.value = url;
                  }
              };

              window.open("http://localhost/ns/plugins/box/cleditor/kcfinder/browse.php?type=image&lang=en", "kcfinder_textbox",
                  "status=0, toolbar=0, location=0, menubar=0, directories=0, " +
                  "resizable=0, scrollbars=0, width=800, height=600"
              );
            }
           </script></head>
<body>
    <!-- Block_wrapper -->
    <div id="header-inside-buttons">

        <!-- Top navigation for third party plugins -->
        <a href="" ><?php require_once(INCLUDES.'getdetails.php'); echo $com_name.", ".$com_adr;?></a>&nbsp;        <!-- / -->

        <!-- Top navigation for system plugin only -->
        <a href="clear.php">Clear Session</a>&nbsp;&nbsp;        <!-- / --> 
       
    </div>    
    <!-- Block_header -->
    <div id="header">
        <div id="header-inside">

            <!-- Block_logo -->
            <div id="logo">
                <img src="templates/img/tcms2.png" alt="" />
            </div>
            <!-- /Block_logo -->

            <!-- Block_menu -->
            <ul id="menu" >
                <li><a href="index.php" class="">Add to Bill</a></li><li><a href="view.php">View Bill</a></li><li><a href="edit.php">Edit Bill</a></li><li><a href="delete.php" >Delete Bill</a></li><li><a href="print.php" >Print Bill</a></li><li><a href="output.php" >Output Register</a></li><li><a href="settings.php">Settings</a> </li>           </ul>
            <!-- /Block_menu -->

            <!-- Block_sub_menu -->
            <ul id="sub-menu">
                <li><a href="" class="sub-current">Last Reference: <?php require_once(INCLUDES.'last.php');if(isset($last)){echo $last;} ?></a></li>
             	<li><a href="" class="current">Current Reference: <?php if(isset($_SESSION['NSTEBS']['bill_no'])){echo $_SESSION['NSTEBS']['bill_no'];} ?></a></li>  
             </ul>
            <!-- /Block_sub_menu -->

        </div>
    </div>
    <!-- /Block_header -->

    <div style="clear:both;"></div>

    <div>
            </div>