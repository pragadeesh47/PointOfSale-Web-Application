const purchaseForm = document.getElementById("purchase-form"),
purchaseBtn  = document.getElementById("purchase-btn"),
shop = document.getElementById("shop"),
price = document.getElementById("price"),
particular = document.getElementById("particular");



const searchForm  = document.querySelector(".example");
searchForm.onsubmit = (e) =>{
    e.preventDefault();
}

purchaseForm.onsubmit = (e) =>{
    e.preventDefault();
}


// purchaseBtn.onclick = () => {
//     if(shop.value!="" && price.value!="" && particular.value!=""){
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST","purchase.php",true);
//         xhr.onload = () =>{
//             if(xhr.readyState === XMLHttpRequest.DONE){
//                 if(xhr.status === 200){
//                     let data = xhr.response;
//                     document.getElementById("exportData").innerHTML = data;
//                     document.querySelector(".modal").style.display = "none";
//                     shop.value="";
//                     particular.value = "";
//                     price.value = "";
                   
//                 }
//             }
//         }
//         let formData = new FormData(purchaseForm);
//         xhr.send(formData);
//     }
//     else{
//         alert("Required Fields are missing");
//     }
    
// };


window.addEventListener("load", function (){
    let url = window.location.href;
    if(url.includes("purchase")){
        displayTable();
     
        // statusBtn();
        // $('#exportData').DataTable({
        //     dom : 'Bfrtip',
        //     destroy : true,
        //     buttons : [
        //       'copy', 'csv','excel','pdf','print'
        //     ]
        //   });
    }
    

})


// $(".history-btn").each(function(){
//     // Test if the div element is empty
//     $(this).click(function(){
//         var dataID = $(this).attr('data-id');
//         localStorage.setItem('dataID',dataID);
//         window.open("purchasehistory.html","_blank");
//     })
// });
function history(){
    const historyBtn = document.querySelectorAll(".history-btn");
    historyBtn.forEach(btn =>{
        btn.onclick = () =>{
            var dataId = btn.dataset.id;
            localStorage.setItem('dataId',dataId);
            window.open("purchasehistory.html","_blank");
        }
    })
}


const displayTable = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","displaypurchase.php",true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                document.getElementById("exportData").innerHTML = data;
                statusBtn();
                history();
                $('#exportData').DataTable({
                    dom : 'Bfrtip',
                    pagingType : "simple",
                    buttons : [
                      'pageLength','copy', 'csv','excel','pdf','print',
                    ]
                  });
                  $(".del-img").each(function(){
                    // Test if the div element is empty
                    $(this).click(function(){
                        dialog.showModal();

                        // var id = $(this).attr('data-del');
                        // var which = 0;
                        // console.log("clicked")
                        // $.ajax({
                        //     url : "delete.php",
                        //     method : "POST",
                        //     data : {
                        //         id : id,
                        //         which : which
                        //     },
                        //     success : function(data){
                        //         $('#'+id ).remove();
                        //         console.log("deleted")
 
                        //     }
                        // })
                    })
                });
            }
        }
    }
    let formData = new FormData(purchaseForm);
    xhr.send(formData);
};


const purchaseFilterForm = document.getElementById("purchase-form-filter"),
purchaseFilterBtn = document.getElementById("purchase-filter-btn");


const fromDate = document.getElementById("fromDate"),
toDate = document.getElementById("toDate");

purchaseFilterForm.onsubmit = (e) =>{
    e.preventDefault();
}


// purchaseFilterBtn.onclick = () => {

//     if(fromDate.value!="" && toDate.value!=""){
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST","filterpurchase.php",true);
//         xhr.onload = () =>{
//             if(xhr.readyState === XMLHttpRequest.DONE){
//                 if(xhr.status === 200){
//                     let data = xhr.response;
//                     document.getElementById("exportData").innerHTML = data;
//                   statusBtn();
//                   history();

    
//                 }
//             }
//         }
//         let formData = new FormData(purchaseFilterForm);
//         xhr.send(formData);
//     }
//     else{
//         alert("Required Fields are missing");
//     }
    

// };


// const hideBtn = document.getElementById("hide-btn");
// const showBtn  = document.getElementById("show-btn");
// hideBtn.onclick = () =>{
//     document.querySelector(".outputFields").style.display = "none";
// }

// showBtn.onclick = () =>{
//     document.querySelector(".outputFields").style.display = "flex";
//     document.querySelector(".outputFields").style.justifyContent = "column";
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","displaypurchase.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 document.getElementById("exportData").innerHTML = data;

//             }
//         }
//     }
//     let formData = new FormData(purchaseFilterForm);
//     xhr.send(formData);

// }


function statusBtn(){
    var buttons = document.querySelectorAll(".status-btn");
    buttons.forEach(btn =>{
        btn.onclick = () =>{
            var data_id = btn.dataset.id;
            document.getElementById("id01").style.display = "block";
            document.getElementById("data-id").value = data_id;
        }
    })
    
    }