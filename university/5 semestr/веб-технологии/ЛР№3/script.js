jndex=-1;
function cl(){
  
    var input = document.getElementById('inputText').value
    var out = document.getElementById('outText')
    var tmp = input

    if (jndex > tmp.length) 
        jndex=-1;

    out.innerHTML = tmp.replaceAt(jndex++);
        
    setTimeout("cl()", 200);
}

setTimeout("cl()",200);

String.prototype.replaceAt = function(index) {
  return this.substr(0, index) + this.charAt(index).toUpperCase + this.substr(index + this.charAt(index).length);
}

function input() {
    var input = document.getElementById('inputText').value;
    document.getElementById('outText').innerHTML = input;
}
