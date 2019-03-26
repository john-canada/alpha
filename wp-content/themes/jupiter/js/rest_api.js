var dataholder = document.getElementById('dataholder');
var ourRequest = new XMLHttpRequest();
ourRequest.open('GET', 'http://localhost/alpha/wp-json/wp/v2/posts?_embed');
ourRequest.onload = function() {
    if (ourRequest.status >= 200 && ourRequest.status <= 400) {
        var data = JSON.parse(ourRequest.responseText);
        createHTML(data);
    }

}

ourRequest.send();

function createHTML(postsdata) {
    var html = 'testst';
    for (i = 0; i < postsdata.length; i++) {
        html += "<h2>Title :" + postsdata[i].title.rendered + "</h2>";
        html += "<p>content :" + postsdata[i].content.rendered + "</p>";
    }

    dataholder.innerHTML = html;
}