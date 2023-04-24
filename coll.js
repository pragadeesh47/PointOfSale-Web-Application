

 
document.addEventListener('DOMContentLoaded', function() {
    // your code here
   
     for(i=0;i<a.length;i++){
        console.log(a[i]);
         a[i].addEventListener('click',function(){
            console.log('hello');
         });
    
    }
 }, false);

 

var a = $("header");
console.log(a);