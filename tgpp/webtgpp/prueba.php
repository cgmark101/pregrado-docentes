<!--
    <input type="text" maxLength="10" id="texto" onKeyUp="document.getElementById('cuenta').innerHTML = this.value.length+'/'+this.maxLength;" /><div id="cuenta"></div>
    <script>document.getElementById('cuenta').innerHTML = document.getElementById('texto').value.length+'/'+document.getElementById('texto').maxLength;</script>
    
    <script language="javascript">
    
    function attachEvent(name,elementName,callBack) {
    var element = elementName;
    if(typeof elementName == 'string') {
    element = document.getElementById(elementName);
    }
    if (element.addEventListener) {
    element.addEventListener(name,callBack,false);
    } else if (element.attachEvent) {
    element.attachEvent('on' + name,callBack);
    }
    }
    
    function maxLength()
    {
    
    var field= event != null ? event.srcElement:e.target;
    if(field.maxChars != null) {
    if(field.value.length >= parseInt(field.maxChars)) {
    event.returnValue=false;
    alert("more than " +field.maxChars + "chars");
    return false;
    }
    }
    }
    
    function maxLengthPaste()
    {
    event.returnValue=false;
    var field= event != null ? event.srcElement:e.target;
    if(field.maxChars != null) {
    if((field.value.length + window.clipboardData.getData("Text").length) > parseInt(field.maxChars)) {
    alert("more than " +field.maxChars + " chars");
    return false;
    }
    }
    event.returnValue=true;
    }
    </script>
    -->
    <textarea rows="5" cols="6" maxLength="100" id="textarea1" onKeyUp="document.getElementById('cuenta2').innerHTML=document.getElementById('textarea1').value.length+'/'+document.getElementById('textarea1').maxLength;" ></textarea>
    
    <div id="cuenta2"></div>
    <script>document.getElementById('cuenta2').innerHT ML=document.getElementById('textarea1').value.length+'/'+document.getElementById('textarea1').maxLength;
    attachEvent("keypress","textarea1",maxLength);
    attachEvent("paste","textarea1",maxLengthPaste);
    </script>
    
    
    
    <script language="javascript">
    function setTextAreaListner(eve,func) {
    var ele = document.forms[0].elements;
    for(var i = 0; i <ele.length;i++) {
    element = ele[i];
    if (element.type) {
    switch (element.type) {
    case 'textarea':
    attachEvent(eve,element,func);
    }
    }
    }
    }
    </script>
    <script language="javascript">
    setTextAreaListner("keypress",maxLength);
    setTextAreaListner("paste",maxLengthPaste);
    </script>