/*
$( document ).ready(function() {
    
});
*/
function moreInfo(id){
    if(document.getElementById("patient"+id).style.display == "block"){
        document.getElementById("patient"+id).style.display="none";
        document.getElementById("click"+id).textContent="Show more";
    }
    else{
        document.getElementById("patient"+id).style.display="block";
        document.getElementById("click"+id).textContent="Show less";
    }
}