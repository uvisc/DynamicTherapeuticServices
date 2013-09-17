$(document).ready(function () {
  var $allVideos = $("iframe, object, embed"),
    $fluidEl = $("figure");
        
  $allVideos.each(function() {
  
    $(this)
      // jQuery .data does not work on object/embed elements
      .attr('data-aspectRatio', this.height / this.width)
      .removeAttr('height')
      .removeAttr('width');
  
  });
  
  $(window).resize(function() {
  
    var newWidth = $fluidEl.width();
    $allVideos.each(function() {
    
      var $el = $(this);
      $el
          .width(newWidth)
          .height(newWidth * $el.attr('data-aspectRatio'));
    
    });
  
  }).resize();

  $('.menuCategory > li p').click(function() {
    $('.menuCategory > li > ul').hide();
    $(this).parent().find('ul').toggle();
  });

  var msgSubject = $("#msgSubject"),
    msgDesc = $("#msgDesc"),
    allFields = $( [] ).add( msgSubject ).add( msgDesc ),
    tips = $( ".validateTips" );
 
  function updateTips( t ) {
    tips
      .text( t )
      .addClass( "ui-state-highlight" );
    setTimeout(function() {
      tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
  }
 
  function checkLength( o, n ) {
    if ( o.val() == "" ) {
      o.addClass( "ui-state-error" );
      updateTips( n + " cannot be empty." );
      return false;
    } else {
      return true;
    }
  }
    
  $("#dialog-form").dialog({
    autoOpen: false,
    height: 450,
    width: 400,
    modal: true,
    buttons: {
      "Contact Us": function() {
        var bValid = true;
        allFields.removeClass( "ui-state-error" );
        bValid = bValid && checkLength( msgSubject, "Subject" );
        bValid = bValid && checkLength( msgDesc, "Message" );
           
        if ( bValid ) {
          var parameters = "subject=" + msgSubject + '&msgDesc=' + msgDesc + '&name=' + $('#msgUserName').val() + '&email=' + $('#msgUserEmail').val();

          $.ajax({
            type: "POST",
            url: "sendEmail.php",
            data: parameters,
            dataType: "JSON",
            success: function(oJSON)
            {
              if (oJSON == 1)
              {
                $('#showMsg').text("Your email has been successfully sent. An admin will contact you shortly.");  
                $('#showMsg').addClass("successMessage");
              }
              else
              {
                $('#showMsg').text("There was an error sending email. Please try again later.");  
                $('#showMsg').addClass("errorMessage");
              }
            },
            complete: function () {
              console.clear();
            }
          });
          $( this ).dialog( "close" );
        }
      },
      Cancel: function() {
        $( this ).dialog( "close" );
        $(msgSubject).val("Incorrect personal details");
      }
    },
    close: function() {
      allFields.val( "" ).removeClass( "ui-state-error" );
      $(msgSubject).val("Incorrect personal details");
    }
  });
    
  $('#horizontalTab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion           
    width: 'auto', //auto or any width like 600px
    fit: true,   // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    activate: function(event) { // Callback function if tab is switched
      var $tab = $(this);
      var $info = $('#tabInfo');
      var $name = $('span', $info);
      $name.text($tab.text());

      $info.show();
    }
  });

  $('#searchGeneric').autocomplete({
    serviceUrl: 'findTherapistGeneric.php',
    minChars: 2,
    delimiter: /(,|;)\s*/, // regex or character
    maxHeight:400,
    width:300,
    zIndex: 9999,
    deferRequestBy: 0,
    dataType: 'json'
  });

  $('#searchState').change( function () {
    var parameters = "state=" + $('#searchState').val();
    $.ajax({
      type: "POST",
      url: "findBorough.php",
      data: parameters,
      dataType: "JSON",
      success: function(oJSON)
      {
        if (oJSON.Boroughs.length > 0)
        {
          $('#searchBorough').html("");
          $('#searchBorough').append('<option value="" selected="selected">Search By Borough</option>');
          for (var i = 0; i < oJSON.Boroughs.length; i++){
            if ($('#getBorough').val() == oJSON.Boroughs[i].value)
            {
              $('#searchBorough').append('<option value="' + oJSON.Boroughs[i].value + '" selected="selected">' + oJSON.Boroughs[i].value + '</option>');
            }
            else
              {
                $('#searchBorough').append('<option value="' + oJSON.Boroughs[i].value + '">' + oJSON.Boroughs[i].value + '</option>');
              }
            }
          }
          else
          {
            $('#searchBorough').html("");
            $('#searchBorough').append('<option value="" selected="selected">Search By Borough</option>');
          }
        }
      });

      $.ajax({
        type: "POST",
        url: "findCounty.php",
        data: parameters,
        dataType: "JSON",
        success: function(oJSON)
        {
          if (oJSON.County.length > 0)
          {
            $('#searchCounty').html("");
            $('#searchCounty').append('<option value="" selected="selected">Search By County</option>');

            for (var i = 0; i < oJSON.County.length; i++){
              if ($('#getCounty').val() == oJSON.County[i].value)
              {
                $('#searchCounty').append('<option value="' + oJSON.County[i].value + '" selected="selected">' + oJSON.County[i].value + '</option>');
              }
              else
              {
                $('#searchCounty').append('<option value="' + oJSON.County[i].value + '">' + oJSON.County[i].value + '</option>');
              } 
            }
          }
          else
          {
            $('#searchCounty').html("");
            $('#searchCounty').append('<option value="" selected="selected">Search By County</option>');
          }
        }
      });
    });
    
    $('.filterDropDown').change(function () {  
      if($('.filterDropDown').val() == "") 
        $('.filterDropDown').addClass("empty");
      else 
        $(".filterDropDown").removeClass("empty")
    });

    $(".filterDropDown").change();

    var textMsg = $("#textMsg"),
    allFields = $( [] ).add( textMsg ),
    tips = $( ".validateTips" );
 
  function updateTips( t ) {
    tips
      .text( t )
      .addClass( "ui-state-highlight" );
    setTimeout(function() {
      tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
  }
 
  function checkLength( o, n ) {
    if ( o.val() == "" ) {
      o.addClass( "ui-state-error" );
      updateTips( n + " cannot be empty." );
      return false;
    } else {
      return true;
    }
  }
    
  $("#textMsgDialogForm").dialog({
    autoOpen: false,
    height: 450,
    width: 400,
    modal: true,
    buttons: {
      "Send Text Message": function() {
        var bValid = true;
        allFields.removeClass( "ui-state-error" );
        bValid = bValid && checkLength( textMsg, "Text Message" );
           
        if ( bValid ) {
          var parameters = 'subject=Text Message from Dynamic Therapeutic Services&msgDesc=' + textMsg + '&name=&email=' + $('#msgUserEmail').val() + '&emailType=T';

          $.ajax({
            type: "POST",
            url: "sendEmail.php",
            data: parameters,
            dataType: "JSON",
            success: function(oJSON)
            {
              if (oJSON == 1)
              {
                $( "#confirmationMessage" ).dialog( "open" );

                $('#confirmationMsg').text("Your text message was sent successfully.");  
                $('#confirmationMsg').addClass("successMessage");

                setTimeout(function(){
                  $( "#confirmationMessage" ).dialog( "close" );
                },2000);
              }
              else
              {
                $( "#confirmationMessage" ).dialog( "open" );

                $('#confirmationMsg').text("There was an error sending the text message. Please try again later.");  
                $('#confirmationMsg').addClass("errorMessage");

                setTimeout(function(){
                  $( "#confirmationMessage" ).dialog( "close" );
                },2000);
              }
            },
            complete: function () {
              console.clear();
            }
          });
          $( this ).dialog( "close" );
        }
      },
      Cancel: function() {
        $( this ).dialog( "close" );
        $(msgSubject).val("Incorrect personal details");
      }
    },
    close: function() {
      allFields.val( "" ).removeClass( "ui-state-error" );
      $(msgSubject).val("Incorrect personal details");
    }
  });

  $( "#confirmationMessage" ).dialog({
    modal: true
  });

  $( "#confirmationMessage" ).dialog( "close" );
});

function goTo()
{
    if(document.formMenu.Menu.value != 0)
    {
        window.location = document.formMenu.Menu.value;
        return false;
    }
}

function redirectPage(pageName)
{
    window.location = pageName;
}

function openEmail()
{
  $( "#dialog-form" ).dialog( "open" );
}

$(window).load(function() {
  $('#loading').hide();
});

function loadVideo(menuName, videoID) {
  if (videoID == "")
  {
    $('#videoFrame').html("<p style='padding-top:20px;'>No video present.</p>");
    $('#youtubeVideo').css('display', 'none');
  }
  else
  {
    //alert($(this).text());
    //$('#videoFrame').val();
    var videoDisp = "http://www.youtube.com/embed/" + videoID + "?modestbranding=1&controls=0&rel=0&autohide=1&showinfo=0";
    $('#videoFrame').html('<p style="padding-top:20px; font-weight:bold;">' + menuName + '</p>');
    $('#youtubeVideo').css('display', 'block');
    $('#youtubeVideo').attr('src', videoDisp);
  }
}

function deleteThera(therapistID) {
  $('#deleteTherapist' + therapistID).submit();
}

function openTextMsgBox (recipientID) {
  $( "#textMsgDialogForm" ).dialog( "open" );  
  var recipientEmail = $('#therapistCell' + recipientID).val();
  $('#msgUserEmail').val(recipientEmail);
}