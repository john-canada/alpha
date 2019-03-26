var dataholder = document.querySelector('#holder');
var ourrequest = new XMLHttpRequest();
           ourrequest.open('GET', megadata.siteURL + '/wp-json/wp/v2/posts?per_page=3');
           ourrequest.onload=function(){
 
            if(ourrequest.status>=200 && ourrequest.status < 400){ 
          var data = JSON.parse(ourrequest.responseText);
              createHTML(data);
              btnjupiter.remove();
          }else{
          alert("Request error");
        }
       };
    ourrequest.onerror=function(){
       alert("Request error");
    }
 ourrequest.send();
 
function createHTML(postdata){
    var ourstring="";
     for(i=0; i<postdata.length; i++){
        ourstring += '<h4 class="posttitle"> Post Title :' + postdata[i].title.rendered + '</h4>'; 
        ourstring += '<p class="postdata"> Post Date :' + postdata[i].date + '</p>' ;
        ourstring += '<p> Post content :' + postdata[i].content.rendered + '</p>' ;
      } 
      dataholder.innerHTML = ourstring
   }