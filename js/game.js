$(document).onload(function () {
    //var t = document.createTextNode(COUNTER_START);
    var p = document.createElement('P');
    p.appendChild(t);
    p.setAttribute('id', 'counter');

    var body = document.getElementsByTagName('BODY')[0];
    var firstChild = body.getElementsByTagName('*')[0];

    body.insertBefore(p, firstChild);
    tick();
});

function tick() {
    if (document.getElementById('counter').firstChild.data > 0) {
        document.getElementById('counter').firstChild.data = document.getElementById('counter').firstChild.data - 1
        setTimeout('tick()', 1000)
    } else {
        document.getElementById('counter').firstChild.data = 'done'
    }
}
