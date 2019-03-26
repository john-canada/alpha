var load_more_btn = document.getElementById("load-more-btn");
var load_more_container = document.getElementById("more_post_container");

if (load_more_btn) {
    load_more_btn.addEventListener("click", function() {

        var ourrequest = new XMLHttpRequest();
        ourrequest.open('GET', magicalData.siteURL + '/wp-json/wp/v2/posts?__embed=true&per_page=2');
        ourrequest.beforeSend = function() {
            document.getElementById("load-more-btn").innerHTML = "Proccessing..";
        }
        ourrequest.onload = function() {
            if (ourrequest.status >= 200 && ourrequest.status < 400) {
                var data = JSON.parse(ourrequest.responseText);
                createHTML(data);
                load_more_btn.remove();
                // console.log(data);
            } else {
                alert("Request error");
            }
        };
        ourrequest.onerror = function() {
            alert("Request error");
        }

        ourrequest.send();
    });
}

function createHTML(postdata) {
    var ourstring = "";
    for (i = 0; i < postdata.length; i++) {
        ourstring += '<img width=150 height-150 src=' + postdata[i].jetpack_featured_media_url + ' />';
        ourstring += '<h4 >' + postdata[i].title.rendered + '<h4>';
        ourstring += postdata[i].content.rendered;
    }
    load_more_container.innerHTML = ourstring;
}