jQuery(document).ready(function($){

    function payformInsertTextAtCursor(el, text) {
        var val = el.value, endIndex, range;
        if (typeof el.selectionStart != "undefined" && typeof el.selectionEnd != "undefined") {
            endIndex = el.selectionEnd;
            el.value = val.slice(0, el.selectionStart) + text + val.slice(endIndex);
            el.selectionStart = el.selectionEnd = endIndex + text.length;
        } else if (typeof document.selection != "undefined" && typeof document.selection.createRange != "undefined") {
            el.focus();
            range = document.selection.createRange();
            range.collapse(false);
            range.text = text;
            range.select();
        }
    }

    function payformFinish(payformId){
        if (edCanvas.style.display=="none") {
            tinymce.activeEditor.execCommand('mceInsertContent', false, " [payform="+payformId+"] ");
        } else {
            edCanvas.focus();
            payformInsertTextAtCursor(edCanvas," [payform="+payformId+"] ")
        }
    }

    $('#add-payform').click(function(e){
        e.stopPropagation();
        $('#payform-popup').css('display', 'inline-block');
    });

    if ($('#add-payform').length > 0) {
        $(window).click(function(){
            if (!$(this).is('#add-payform')) { 
                $('#payform-popup').css('display', 'none'); 
            } 
        })
    }

    window.onmessage = function (e) {
      if (e.data.substring(0, 8) == "payform-") {
        var mensaje = e.data.split('-');
        payformFinish(mensaje[1]);
         $('#payform-popup').css('display', 'none');
      }
    };


});


