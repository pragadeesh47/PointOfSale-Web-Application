const serviceForm = document.getElementById("service-form"),
serviceBtn  = document.getElementById("service-btn"),
Name = document.getElementById("name"),
mobile = document.getElementById("mobile"),
complaint = document.getElementById("complaint"),
amount = document.getElementById("amount"),
place = document.getElementById("place"),
Status = document.getElementById("status");

serviceForm.addEventListener("submit", function (e){
    e.preventDefault();

})





const serviceFilterForm = document.getElementById("service-form-filter"),
serviceFilterBtn = document.getElementById("service-filter-btn");
const fromDate = document.getElementById("fromDate"),
toDate = document.getElementById("toDate");
console.log(fromDate);

serviceFilterForm.onsubmit = (e) =>{
    e.preventDefault();
}


// serviceFilterBtn.onclick = () => {

//     if(fromDate.value!="" && toDate.value!=""){

//     document.querySelector(".outputFields").style.display = "flex";
//     document.querySelector(".outputFields").style.justifyContent = "column";
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","filterservice.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 document.getElementById("exportData").innerHTML = data;
//                 statusBtn();

//             }
//         }
//     }
//     let formData = new FormData(serviceFilterForm);
//     xhr.send(formData);
// }
// else{
//     alert('Required Fields are missing');
// }
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
//     xhr.open("POST","displayservice.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 document.getElementById("exportData").innerHTML = data;

//             }
//         }
//     }
//     let formData = new FormData(serviceFilterForm);
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