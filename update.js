const form1 = document.getElementById("form-submit");
const form2 = document.getElementById("form-filter");
const updateBtn = document.getElementById("update-btn");
const showBtn = document.getElementById("show-btn");
const hideBtn = document.getElementById("hide-btn");
let table = document.getElementById("exportData");
const filterBtn = document.getElementById("filter-btn");


form1.onsubmit = (e) => {
    e.preventDefault();
} 
form2.onsubmit = (e) => {
    e.preventDefault();
} 


// updateBtn.onclick = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","update.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 $.ajax({
//                     url : "saleitem.php",
//                     method : "POST",
//                     success : function(data){
//                       $("select").html(data);
//                     }
//                   })
//                 if(data === "success"){
//                    console.log("hello");
//                 }
//                 else{
                   
//                     console.log(data);
//                     console.log("hii");
//                 }
//             }
//         }
//     }
//     let formData = new FormData(form1);
//     xhr.send(formData);
// };

showBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST","display.php",true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                total =  data.split(".")
                table.innerHTML = total[0];
                console.log(data);
                document.querySelector(".outputFields").classList.add("show");
                document.querySelector(".amount").textContent = total[1];
                document.querySelector(".strong").style.opacity = 0;
            }
        }
    }
    
    xhr.send();
};
hideBtn.onclick = ()=>{
    document.querySelector(".outputFields").classList.remove("show");
}

// filterBtn.onclick = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","display.php",true);
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 total =  data.split(".")
//                 table.innerHTML = total[0];
//                 document.querySelector(".outputFields").classList.add("show");
//                 document.querySelector(".strong").style.opacity = 1;
//                 document.querySelector(".amount").textContent = total[1];
//                 document.querySelector(".cashIn").textContent = total[2];
//                 console.log(total[1]);
//                 console.log(total[2]);
//             }
//             else{
//                 document.querySelector(".outputFields").classList.add("show");
//                 document.querySelector(".strong").style.opacity = 1;
//                 document.querySelector(".amount").textContent = 0;
//                 document.querySelector(".cashIn").textContent = 0;
//                 console.log(total[2]);
//             }
//         }
//     }
//     let formData = new FormData(form2);
//     xhr.send(formData);
// };


const cashForm = document.getElementById("cash-form");
const cashBtn = document.getElementById("cash-update-btn");
const cashAmount = document.getElementById("cash");

cashForm.onsubmit = (e) =>{
    e.preventDefault();
}


cashBtn.onclick = () => {
    if(cashAmount.value !=""){
        let xhr = new XMLHttpRequest();
        xhr.open("POST","cashinhand.php",true);
        xhr.onload = () =>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data === "success"){
                       console.log("hello");
                    }
                    else{
                       
                        console.log(data);
                        console.log("hii");
                    }
                }
            }
        }
        let formData = new FormData(cashForm);
        xhr.send(formData);
        cashAmount.value = "";
    }
    else{
        alert("Required fields are required");
    }

};