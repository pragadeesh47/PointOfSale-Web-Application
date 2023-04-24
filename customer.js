const customerForm = document.querySelector(".customer-form");
const customerFormBtn = document.querySelector(".customer-submit-btn");
const searchForm = document.querySelector(".example");
const historyBtn = document.getElementById("show-history");


const Name = document.getElementById("name"),
mobile = document.getElementById("mobile"),
particular = document.getElementById("particular"),
balance = document.getElementById("balance");


searchForm.onsubmit = (e) =>{
    e.preventDefault();
}

customerForm.addEventListener("submit", function (e){
    e.preventDefault();
    document.getElementById("myModal").style.display = "none";

})


customerFormBtn.onclick = () => {
    if(Name.value!="" && mobile.value!="" && particular.value!="" && balance.value!=""){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","customerupdate.php",true);
        xhr.onload = () =>{ 
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data.length==30){
                       alert(data); 
                       console.log(data);
                       Name.value="";
                       particular.value = "";
                       mobile.value = "";
                       balance.value = "";
                    }
                    else{
                    document.getElementById("exportData").innerHTML = data;
                    var modal = document.getElementById("myModal");
                    modal.style.display = "none";
                    Name.value="";
                    particular.value = "";
                    mobile.value = "";
                    balance.value = "";
                    collBtn();
                    $(".del-img").each(function(){
                        // Test if the div element is empty
                        $(this).click(function(){
                            var id = $(this).attr('data-del');
                            var which = 2;
                            console.log("clicked")
                            $.ajax({
                                url : "delete.php",
                                method : "POST",
                                data : {
                                    id : id,
                                    which : which
                                },
                                success : function(data){
                                    $('#'+id ).remove();
                                    console.log("deleted")
     
                                }
                            })
                        })
                    });
                    $(".history-btn").each(function(){
                        // Test if the div element is empty
                        $(this).click(function(){
                            var dataID = $(this).attr('data-id');
                            localStorage.setItem('dataID',dataID);
                            window.open("customerhistory.html","_blank");
                        })
                    });
                    $('#exportData').DataTable({
                        dom : 'Bfrtip',
                        pagingType : "simple",
                        destroy : true,
                        buttons : [
                          'pageLength','copy', 'csv','excel','pdf','print',
                        ]
                      });
                 
                }
                }

            }
        }
        let formData = new FormData(customerForm);
        xhr.send(formData);
    }
    else{
        alert("Required Fields are missing");
    }
   
};


window.addEventListener("load", function (){
    let url = window.location.href;
    if(url.includes("credits")){
        // displayTable();
       
    }
    

})


// const displayTable = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","displaycustomers.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 document.getElementById("exportData").innerHTML = data;
//                 collBtn();
//                 $(".del-img").each(function(){
//                     // Test if the div element is empty
//                     $(this).click(function(){
//                         var id = $(this).attr('data-del');
//                         var which = 2;
//                         console.log("clicked")
//                         $.ajax({
//                             url : "delete.php",
//                             method : "POST",
//                             data : {
//                                 id : id,
//                                 which : which
//                             },
//                             success : function(data){
//                                 $('#'+id ).remove();
//                                 console.log("deleted")
 
//                             }
//                         })
//                     })
//                 });
//                     // Loop through each div element with the class box
//                     $(".history-btn").each(function(){
//                         // Test if the div element is empty
//                         $(this).click(function(){
//                             var dataID = $(this).attr('data-id');
//                             localStorage.setItem('dataID',dataID);
//                             window.open("customerhistory.html","_blank");
//                         })
//                     });
//                     $('#exportData').DataTable({
//                         dom : 'Bfrtip',
//                         pagingType : "simple",
//                         destroy : true,
//                         buttons : [
//                           'pageLength','copy', 'csv','excel','pdf','print',
//                         ]
//                       });
//             }
//         }
//     }
//     let formData = new FormData(customerForm);
//     xhr.send(formData);
// };



function collBtn(){
    var buttons = document.querySelectorAll(".coll-btn");
    buttons.forEach(btn =>{
        btn.onclick = () =>{
            var data_id = btn.dataset.id;
            document.getElementById("id01").style.display = "block";
            document.getElementById("data-id").value = data_id;
            console.log("Coll-btn")
        }
    })
    
    }
    




function myFunction(){
    
    displayTable();

}

var a = $("header");
console.log(a);